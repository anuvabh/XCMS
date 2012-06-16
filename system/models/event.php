<?php

class Event extends CI_Model
{
    function create($data, $update=0)
    {
        if($update == 1)
        {
            $sql = "UPDATE events SET ".
                "StartDate=".$this->db->escape($data['stdt']).
                ",EndDate=".$this->db->escape($data['edt']).
                ",EventName=".$this->db->escape($data['eName']).
                ",Details=".$this->db->escape($data['eDetails']).
                ",SocialCredit=".$this->db->escape($data['social']).
                ",Unit=".$this->db->escape($data['creditType']).
                " WHERE EventID=".$this->db->escape($data['EID']);
            $this->db->query($sql);
        
            $sql = "DELETE FROM eventRolesInfo WHERE EventID=".$this->db->escape($data['EID']);
            $this->db->query($sql);
            
            for($i=0; $i<$data['roleCount'];$i++)
            {
                $sql = "INSERT INTO eventrolesinfo VALUES(".$data['EID'].
                    ",".$this->db->escape($data['roles'][$i]).
                    ",".$this->db->escape($data['credits'][$i]).
                    ",".$this->db->escape($data['visible'][$i]).
                    ")";
                $this->db->query($sql);
        
            }

            
            return;
        }
        $id = time();
        
        $sql = "INSERT INTO events VALUES(".$id.
                ",".$this->db->escape($data['dept']).
                ",".$this->db->escape($data['stdt']).
                ",".$this->db->escape($data['edt']).
                ",".$this->db->escape($data['eName']).
                ",".$this->db->escape($data['eDetails']).
                ",".$this->db->escape($data['social']).
                ",".$this->db->escape($data['creditType']).
                ")";
        $this->db->query($sql);
        
        for($i=0; $i<$data['roleCount'];$i++)
        {
            $sql = "INSERT INTO eventrolesinfo VALUES(".$id.
                    ",".$this->db->escape($data['roles'][$i]).
                    ",".$this->db->escape($data['credits'][$i]).
                    ",".$this->db->escape($data['visible'][$i]).
                    ")";
            $this->db->query($sql);
        
        }
    }
    
    function details($UserDept=-1, $UserType=-1)
    {
        if($UserDept != -1)
        {
            if($UserType == 'dept' || $UserType == 'system')
            {
                $sql = "SELECT * FROM events WHERE Department=".$this->db->escape($UserDept);
                $query = $this->db->query($sql);
                
                return $query->result_array();
            }
        }
    }
    
    function getRoles($EID)
    {
        $sql = "SELECT Role, Credit, Visible FROM eventrolesinfo WHERE EventID=".$this->db->escape($EID);
        $query = $this->db->query($sql);
        $roles = $query->result_array();
        
        $sql = "SELECT Department, StartDate, EndDate, EventName, Details, SocialCredit, Unit FROM events where EventID=".$this->db->escape($EID);
        $query = $this->db->query($sql);
        $details = $query->result_array();
        
        $result = array(
            'roles' => $roles,
            'details' => $details
        );
        
        return $result;
        
    }
    function delete($EID)
    {
        $sql = "DELETE from events WHERE EventID=".$this->db->escape($EID);
        $query = $this->db->query($sql);
    }
    
    function all()
    {
        $sql = "SELECT EventID, Department, StartDate, EndDate, EventName FROM events";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    function getDepartment($EID)
    {
        $sql = "SELECT Department FROM events where EventID=".$this->db->escape($EID);
        $query = $this->db->query($sql);
            
        return $query->row_array();
    }
}