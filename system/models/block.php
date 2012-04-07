<?php

class Block extends CI_Model
{
    function generate($crID, $amount, $blockID)
    {
        $blockSetID = time();
        $sql = "INSERT INTO blocksetsinfo VALUES(".$blockSetID.
                ", ".$blockID.
                ", ".$crID.
                ", 1".
                ", ".$amount.")";
        
        $query = $this->db->query($sql);
        $i = 0;
        while($amount > 0)
        {
            /*$sql = "INSERT INTO codesetsinfo(BlockSetID,Code,Valid,UserID) values(".$blockSetID.
                    ", CAST(RAND()*8999999999+1000000000 AS UNSIGNED)".
                    ",1, NULL)";*/
            
            $sql = "SELECT CAST((RAND()*89) + 10 AS UNSIGNED) AS Code";
            $query = $this->db->query($sql);
            $Code = $query->row()->Code;
            echo $Code."<br />";
            $sql = "SELECT Code FROM codesetsinfo WHERE Code=".$Code;
            $query = $this->db->query($sql);
          
            $i++;
            
            if($query->num_rows() == 0)
            {
                $sql = "INSERT INTO codesetsinfo(BlockSetID,Code,Valid,UserID) values(".$blockSetID.
                    ", ".$Code.
                    ", 1, NULL)";
                $this->db->query($sql);
                $amount--;
            }
            
        }    
        echo $i."asdasdasds";
        return $blockSetID;
    
    }
    function fetchBlockSetsID($blockID)
    {
        $sql = "SELECT BlockSetID FROM blocksetsinfo WHERE BlockID=".$this->db->escape($blockID);
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
    {}
}
/* End of file block.php */
/* Location: ./system/models/block.php */    