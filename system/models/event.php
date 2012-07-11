<?php

class Event extends CI_Model
{
    function create($data, $update=0)
    {
        if($update == 10)
        {
            $sql = "UPDATE events SET ".
                "StartDate=".$this->db->escape($data['stdt']).
                ",EndDate=".$this->db->escape($data['edt']).
                ",EventName=".$this->db->escape($data['eName']).
                ",Details=".$this->db->escape($data['eDetails']).
                ",SocialCredit=".$this->db->escape($data['social']).
                ",Unit=".$this->db->escape($data['creditType']).
                ",open='1'".
                " WHERE EventID=".$this->db->escape($data['EID']);
            $this->db->query($sql);
            
//            $sql = "DELETE FROM eventRolesInfo WHERE EventID=".$this->db->escape($data['EID']);
//            $this->db->query($sql);
            
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
        
        if($update == 11)
        {
            $sql = "UPDATE events SET ".
                "StartDate=".$this->db->escape($data['stdt']).
                ",EndDate=".$this->db->escape($data['edt']).
                ",EventName=".$this->db->escape($data['eName']).
                ",Details=".$this->db->escape($data['eDetails']).
                ",SocialCredit=".$this->db->escape($data['social']).
                ",Unit=".$this->db->escape($data['creditType']).
                ",open='-1'".
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
        
        if($update == 12)
        {
            $sql = "UPDATE events SET ".
                "StartDate=".$this->db->escape($data['stdt']).
                ",EndDate=".$this->db->escape($data['edt']).
                ",EventName=".$this->db->escape($data['eName']).
                ",Details=".$this->db->escape($data['eDetails']).
                ",SocialCredit=".$this->db->escape($data['social']).
                ",Unit=".$this->db->escape($data['creditType']).
                ",open='1'".
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
        
        if($update == 0)
        {
            $id = time();

            $sql = "INSERT INTO events VALUES(".$id.
                    ",".$this->db->escape($data['dept']).
                    ",".$this->db->escape($data['stdt']).
                    ",".$this->db->escape($data['edt']).
                    ",".$this->db->escape($data['eName']).
                    ",".$this->db->escape($data['eDetails']).
                    ",".$this->db->escape($data['social']).
                    ",".$this->db->escape($data['creditType']).
                    ",1".
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
        if($update == 1)
        {
            $id = time();

            $sql = "INSERT INTO events VALUES(".$id.
                    ",".$this->db->escape($data['dept']).
                    ",".$this->db->escape($data['stdt']).
                    ",".$this->db->escape($data['edt']).
                    ",".$this->db->escape($data['eName']).
                    ",".$this->db->escape($data['eDetails']).
                    ",".$this->db->escape($data['social']).
                    ",".$this->db->escape($data['creditType']).
                    ",-1".
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
        $sql = "SELECT EventID, Department, StartDate, EndDate, EventName FROM events WHERE open='1'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    function getDepartment($EID)
    {
        $sql = "SELECT Department FROM events where EventID=".$this->db->escape($EID);
        $query = $this->db->query($sql);
            
        return $query->row_array();
    }
    
    function getPublicDetails($EID)
    {
        $sql = "SELECT StartDate, EndDate, Department, Details, SocialCredit, EventName, Unit FROM events WHERE EventID=".$this->db->escape($EID);
        $query = $this->db->query($sql);
        $eventDetails = $query->result_array();
        $sql = "SELECT Role, Credit FROM eventrolesinfo WHERE EventID=".$this->db->escape($EID)." AND Visible=1";
        $query = $this->db->query($sql);
        $roles = $query->result_array();
        
        $publicDetails = array('eventDetails' => $eventDetails,
                            'roles' => $roles,
                            'EventID' => $EID);
        
        return $publicDetails;
        
    }
    function close($EID)
    {
        $sql = "UPDATE events SET open=0 WHERE EventID=".$this->db->escape($EID);
        $this->db->query($sql);
        
    }
    function open($EID)
    {
        $sql = "UPDATE events SET open=1 WHERE EventID=".$this->db->escape($EID);
        $this->db->query($sql);
        
    }
    
    function register($EID, $UID, $role)
    {
        $sql = "INSERT INTO eventassociationsinfo VALUES("
            .$this->db->escape($EID).", "
            .$this->db->escape($UID).", "
            .$this->db->escape($role).", "
            ." 'submitted'"
            .")";
        $this->db->query($sql);
    }
    
    function isRegistered($EID, $UID)
    {
        $sql = "SELECT * FROM eventassociationsinfo WHERE State!='rejected' AND EventID=".$this->db->escape($EID)." AND UserID=".$this->db->escape($UID);
        $query = $this->db->query($sql);
        return $query->num_rows >= 1 ? 1 : 0;
    }
    
    function getAssociated($EID)
    {
        $sql = "SELECT events.EventName, users.FirstName, users.UserID, users.LastName, users.Roll, users.Department, eventassociationsinfo.Role, eventassociationsinfo.State FROM eventassociationsinfo, events, users WHERE  eventassociationsinfo.EventID=events.EventID AND eventassociationsinfo.UserID=users.UserID AND eventassociationsinfo.EventID=".$this->db->escape($EID);
        //$sql = "SELECT EventName, FirstName, LastName, Roll, Role, State FROM eventassociationsinfo NATURAL JOIN events NATURAL JOIN users WHERE EventID=".$this->db->escape($EID);
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    function updateState($EID, $role, $state, $UID)
    {
        $sql = "UPDATE eventassociationsinfo SET State=".$this->db->escape($state)." WHERE EventID=".$this->db->escape($EID)." AND UserID=".$this->db->escape($UID);
        $query = $this->db->query($sql);
        $sql = "UPDATE eventassociationsinfo SET Role=".$this->db->escape($role)." WHERE EventID=".$this->db->escape($EID)." AND UserID=".$this->db->escape($UID);
        $query = $this->db->query($sql);
    }
    function getEventName($EID)
    {
        $sql = "SELECT EventName FROM events WHERE EventID=".$this->db->escape($EID);
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    
    function accredit($EID, $UID, $role)
    {
        $sql = "SELECT EventName, SocialCredit, Department, Unit FROM events WHERE EventID=".$this->db->escape($EID);
        $data = $this->db->query($sql);
        $data = $data->result_array();
        $eName = $data[0]['EventName'];
        $social = $data[0]['SocialCredit'];
        $dept = $data[0]['Department'];
        $unit = $data[0]['Unit'];
        
                
        $sql = "SELECT Credit FROM eventrolesinfo WHERE EventID=".$this->db->escape($EID)." AND Role=".$this->db->escape($role);
        $data = $this->db->query($sql);
        $data = $data->result_array();
        $credit = $data[0]['Credit'];
        
        $sql = "INSERT INTO credits VALUES(".$this->db->escape($UID).", ".$this->db->escape($EID).", ".$this->db->escape($EID).", ".$this->db->escape($eName).", ".$this->db->escape($dept).", ".$this->db->escape($unit).", ".$credit.", ".$social.")";
        $this->db->query($sql);
    }
    
    function search($keywords)
    {
        $c = count($keywords);
        $sql = "";
        for($i=0; $i < $c-1; $i++)
            $sql = "(SELECT EventID, EventName FROM events WHERE EventName like '%".$keywords[$i]."%')UNION".$sql;
        $sql = $sql."(SELECT EventID, EventName FROM events WHERE EventName like '%".$keywords[$i]."%')";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    function getStatus($EID)
    {
        $sql = "SELECT open FROM events WHERE EventID=".$this->db->escape($EID);
        $query = $this->db->query($sql);
        $arr = $query->result_array();
        return $arr[0]['open'];
    }
    
    function fetchPopular($num,$dept = '0')
    {
        if($dept == '0')
        {
            $sql = "SELECT EventID, EventName
                        FROM 
                        (
                            (
                                SELECT EventID, EventName, COUNT( * ) AS num
                                FROM EVENTS NATURAL JOIN eventassociationsinfo
                                WHERE OPEN =1
                                GROUP BY EventID
                            )
                            UNION 
                            (
                                SELECT EventID, EventName, 0 AS num
                                FROM EVENTS WHERE OPEN =1
                                AND EventID NOT 
                                IN (
                                    SELECT EventID
                                    FROM eventassociationsinfo
                                )
                            )
                        ) AS popular
                        ORDER BY num DESC
                        LIMIT 0, ".$num;
        }
        else
        {
            $sql = "SELECT EventID, EventName
                    FROM 
                    (
                        (
                            SELECT EventID, EventName, COUNT( * ) AS num
                            FROM EVENTS NATURAL JOIN eventassociationsinfo
                            WHERE OPEN =1 AND Department=".$this->db->escape($dept)."
                            GROUP BY EventID
                        )
                        UNION 
                        (
                            SELECT EventID, EventName, 0 AS num
                            FROM EVENTS WHERE OPEN =1 AND Department=".$this->db->escape($dept)."
                            AND EventID NOT 
                            IN (
                                SELECT EventID
                                FROM EVENTS NATURAL JOIN eventassociationsinfo
                            )
                        )
                    ) AS popular
                    ORDER BY num DESC
                    LIMIT 0, ".$num;
        }
        
        $query = $this->db->query($sql);
        
        return $query->result_array();
        
    }
}