<?php

class Block extends CI_Model
{
    function createBlock($d, $y, $r)
    {
        
        $blockID = time();
        
        $sql = "INSERT INTO blocksinfo values(".$blockID.
                ", ".$this->db->escape($d).
                ", ".$y.
                ", ".$r.", NULL)";//we might need to use escape for non-numeric (like mcv) rooms
        $query = $this->db->query($sql);
        return $blockID;
    }
    function generate($crID, $amount, $blockID)
    {   
        /*$sql = "SELECT max(BlockSetID) blockSetID FROM blocksetsinfo GROUP BY BlockID HAVING BlockID=".$blockID;
        $query = $this->db->query($sql);*/
        $blockSetID = time();
        
        /*if($query->num_rows() > 0)
            $blockSetID = $query->row()->blockSetID + 1;*/
        
        $sql = "INSERT INTO blocksetsinfo VALUES(".$blockSetID.
                ", ".$blockID.
                ", 1".
                ", ".$amount.")";
        
        $query = $this->db->query($sql);
        $i = 0;
        $codes = "";
        while($amount > 0)
        { 
            $sql = "SELECT CAST((RAND()*8999999999) + 100000000 AS UNSIGNED) AS Code";
            $query = $this->db->query($sql);
            $Code = $query->row()->Code;
            $codes[$i++] = $Code;
            $sql = "SELECT Code FROM codesetsinfo WHERE Code=".$Code;
            $query = $this->db->query($sql);
             
            if($query->num_rows() == 0)
            {
                $sql = "INSERT INTO codesetsinfo(BlockSetID,Code,Valid,UserID) values(".$blockSetID.
                    ", ".$Code.
                    ", 1, NULL)";
                $this->db->query($sql);
             
                $amount--;
            }
            
        }    
        $this->blockSetID = $blockSetID;
        $this->codes = $codes;
        $this->limit = $i;
        
        return $this;
    
    }
    function fetchBlockSetsID($blockID)
    {
        $sql = "SELECT BlockSetID FROM blocksetsinfo WHERE status=1 AND BlockID=".$blockID;
        $query = $this->db->query($sql);
        
        if($query->num_rows() > 0)
            return $query->row()->BlockSetID;
        else
            return 0;
    }
    function fetchBlockID($d, $y, $r)
    {
        $sql = "SELECT BlockID FROM blocksinfo WHERE Department=".$this->db->escape($d).
                "AND Year=".$this->db->escape($y).
                "AND Room=".$this->db->escape($r);
        $query = $this->db->query($sql);
        
        if($query->num_rows() > 0)
            return $query->row()->BlockID;
        else
            return 0;
    }
    function checkValidity($code, $department, $year, $room)
    {
        $sql = "SELECT BlockID FROM blocksinfo WHERE Department=".$this->db->escape($department).
               "AND Year=".$this->db->escape($year).
               "AND Room=".$this->db->escape($room);
        $query = $this->db->query($sql);
        
        if($query->num_rows() <= 0)//such a block does not exist..error codes to be standardised
        {
            $this->error = TRUE;
            $this->errorCode = 2012;
            return $this;
        }
        $query = $query->row(); //validity of codes is one academic year
        $blockID = $query->BlockID;
        
        $sql = "SELECT BlockSetID from codesetsinfo WHERE UserID IS NULL and Valid=1 and Code=".$code;
        
        $query = $this->db->query($sql);
        
        if($query->num_rows() <= 0)//such a code does not exist or is invalid or is already assigned
        {
            $this->error = TRUE;
            $this->errorCode = 2013;
            return $this;
        }
        $query = $query->row(); //validity of codes is one academic year
        $blockSetID = $query->BlockSetID;
        
        $sql = "SELECT BlockID from blocksetsinfo WHERE Status=1 and BlockSetID=".$blockSetID;
        
        $query = $this->db->query($sql);
        
        if($query->num_rows() <= 0)//such a code does not exist or is invalid or is already assigned
        {
            $this->error = TRUE;
            $this->errorCode = 2014;
            return $this;
        }
        $query = $query->row(); //validity of codes is one academic year
        $blockID_sys = $query->BlockID;
        
        if($blockID == $blockID_sys)
        {
            $this->error = FALSE;
            return $this;
        }
        else
        {
            $this->error = TRUE;
            $this->errorCode = 2015;
            return $this;
        }
      
    }    
    function freeze($blockSetID)
    {
        $sql = "UPDATE blocksetsinfo SET status=0 WHERE BlockSetID=".$blockSetID;
        $query = $this->db->query($sql);
        if ($this->db->affected_rows()>0)   //should we make the codes also invalid when we make the code set invalid?
            return true;
        else
            return false;
    }
    
    function checkRoom($room)
    {
        $sql = "SELECT Room FROM blocksinfo";
        $query = $this->db->query($sql);
        $validRooms = $query->result_array();
        
        foreach($validRooms as $x)
        {
            if($room == $x['Room'])
            {
                return true;
            }
        }
        return false;
    }
    
    function blockHasCR($blockID)
    {
        $sql = "SELECT CRID FROM blocksinfo WHERE CRID IS NOT NULL AND BlockID=".$blockID;
        $query = $this->db->query($sql);
        
        if($query->num_rows() == 0)
            return 0;
        else 
            return $query->row()->CRID;
    }
    function assignCRBlock($crID, $blockID)
    {
        $sql = "UPDATE blocksinfo set CRID=".$crID." WHERE BlockID=".$blockID;
        $query = $this->db->query($sql);
    }
    
    function departmentExists($dcode, $dname=false)
    {
        if(!$dname)
        {
            $sql = "SELECT Code FROM departments WHERE Code=".$this->db->escape($dcode);
            $query = $this->db->query($sql);
            if($query->num_rows() == 0)
                return 1;

            return 0;
        }
        else
        {
            $sql = "SELECT Code FROM departments WHERE Code=".$this->db->escape($dcode)." OR Name=".$this->db->escape($dname);
            $query = $this->db->query($sql);

            if($query->num_rows() == 0)
                return 1;

            return 0;
        }
    }
    function createDepartment($Department, $Dcode, $Type)
    {
        $sql = "INSERT INTO departments VALUES(".$this->db->escape($Dcode).",".$this->db->escape($Department).",".$this->db->escape($Type).")";
        $query = $this->db->query($sql);
    }
    function removeDepartment($Dcode)
    {
        $sql = "DELETE FROM departments WHERE Code=".$this->db->escape($Dcode);
        $query = $this->db->query($sql);
    }
}
/* End of file block.php */
/* Location: ./system/models/block.php */    