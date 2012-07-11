<?php
class User extends CI_Model
{  
    function login($username, $password)
    {
        $sql = "SELECT * FROM users WHERE Email=".$this->db->escape($username);
        $query = $this->db->query($sql);
        //the account exists...  
        if($query->num_rows() > 0)
        {
            $result = $query->row();//only a single row SHOULD be returned

            //password has matched
            if($password == $result->Password)
            {
                if($result->Status == 1)//status is OK!!
                {
                    $this->UserID = $result->UserID;
                    $this->UserType = $result->UserType;
                    $this->FirstName = $result->FirstName;
                    $this->LastName = $result->LastName;
                    $this->Department = $result->Department;
                    $this->Roll = $result->Roll;
                    $this->errorCode = 0;
                }
                else//accoutn frozen >:(
                {
                    $this->errorCode = 1011;
                }
            }
            else//acount exists but password is incorrect
            {
                $this->errorCode = 1013;
            }
        }
        else//username or password invalid
        {
            $this->errorCode = 1012;
        }
        
        return $this;
    }//end of login()
	
    /*--- checkEmail ---*/
    function fetchUserID($email)
    {
        $sql = "SELECT UserID FROM users WHERE Email=".$this->db->escape($email);
        $query = $this->db->query($sql);

        if($query->num_rows() > 0)
            return $query->row()->UserID;
        else
            return 0;
    }
    //end of checkEmail()
    
    /*--- register---*/
    function register($data, $type)
    {
        $this->UserID = time();
        $this->UserType = $type;
        $this->error=false;

        $sql = "SELECT UserID FROM users WHERE Email=".$this->db->escape($data['Email']);
        $query = $this->db->query($sql);
        
        if($query->num_rows() > 0)
            $this->error=true;
        else
        {    
        
            $sql = "INSERT INTO users VALUES(".
                    $this->UserID.",".
                    $this->db->escape($type).",".
                    $this->db->escape($data['FirstName']).",".
                    $this->db->escape($data['LastName']).",".
                    $this->db->escape($data['Department']).",".
                    $data['Roll'].",".
                    $this->db->escape($data['Email']).",".
                    $this->db->escape($data['Password']).",1)";

            $this->db->query($sql);
        }

        
        if($type == 'student')
        {
            $sql = "UPDATE codesetsinfo set UserID=".$this->UserID." where Code=".$data['Code'];
            $this->db->query($sql);
        }
        
        return $this;
    }//end of register()
    
    /*--- fetchDepartments ---*/
    function fetchDepartments()
    {
        $sql = "SELECT Code FROM departments WHERE type='academic'";
        $query = $this->db->query($sql);

        return $query->result_array();
    }
    
    function revokeCR($uid)
    {
        $sql = "UPDATE users SET UserType='student' WHERE UserID=".$this->db->escape($uid);
        $this->db->query($sql);
    }
    
    function modifyCR($Department, $Year, $Room, $Email)
    {
        $sql = "SELECT UserID FROM users WHERE Email=".$this->db->escape($Email);
        $query = $this->db->query($sql);
        
        $UID = $query->result_array();
        
        $sql = "UPDATE blocksinfo SET CRID=NULL WHERE CRID=".$this->db->escape($UID[0]['UserID']);
        $query = $this->db->query($sql);
        
        $sql = "UPDATE blocksinfo SET CRID=".$this->db->escape($UID[0]['UserID'])." WHERE Department=".$this->db->escape($Department)." AND Year=".$this->db->escape($Year)." AND Room=".$this->db->escape($Room);
        $query = $this->db->query($sql);
    }
    
    function makeCR($d, $y, $r, $email)
    {
        $sql = "UPDATE users SET UserType='cr' WHERE Email=".$this->db->escape($email);
        $this->db->query($sql);
        
        $sql = "SELECT UserID FROM users WHERE Email=".$this->db->escape($email);
        $UID = $this->db->query($sql);
        $UID = $UID->result_array();
        
        
        $sql = "UPDATE blocksinfo SET CRID=".$this->db->escape($UID[0]['UserID'])." WHERE Department=".$this->db->escape($d)." AND Year=".$this->db->escape($y)." AND Room=".$this->db->escape($r);
        $this->db->query($sql);
    }
    
    function hasCR($dept, $year, $room)
    {
        $sql = "SELECT UserID, FirstName, LastName FROM blocksinfo, users WHERE UserID=CRID AND users.Department=".$this->db->escape($dept)." AND Year=".$this->db->escape($year)."AND Room=".$this->db->escape($room);
//        echo "********".$sql;
        $query = $this->db->query($sql);
        
        $arr = $query->result_array();
        return $arr;
    }
    
    function userDept($email)
    {
        $sql = "SELECT Department from users where Email=".$this->db->escape($email);
        
        $query = $this->db->query($sql);
        
        $query = $query->result_array();
        
        return $query[0]['Department'];
    }
    
    function checkDept($username, $department)
    {
        $sql = "SELECT Email from users where Department=".$this->db->escape($department)." and Email=".$this->db->escape($username);
        
        $query = $this->db->query($sql);
        
        if($query->num_rows() > 0)
            return true;
        else
            return false;
    }
    
    function isCR($username)
    {
        $sql = "SELECT UserType from users where UserType='cr' and Email=".$this->db->escape($username);
        
        $query = $this->db->query($sql);
        
        if($query->num_rows() > 0)
            return true;
        else
            return false;
    }
    
    //end of fetchDepartments()
    function changePassword($UserID, $oldPass, $newPass)
    {
        $sql = "SELECT UserID FROM users WHERE UserID=".$UserID." AND Password=".$this->db->escape($oldPass);
        $query = $this->db->query($sql);
        
        if($query->num_rows() > 0)
        {
             $sql = "UPDATE users SET Password=".$this->db->escape($newPass)." WHERE UserID=".$UserID;
             $query = $this->db->query($sql);
             return true;
        }
        return false;
    }
    
    function allUsers()
    {
        $sql = "SELECT * FROM users";
        $query = $this->db->query($sql);
        $users = $query->result_array();
        return $users;
    }
    
    function getCredits($UID)
    {
        $sql = 'SELECT Unit, Amount, Department, EventName, Social FROM credits WHERE UserID='.$this->db->escape($UID);
        $query = $this->db->query($sql);
        
        return $query->result_array();
    }
    
    function searchUsers($keyword)
    {
        $sql = "SELECT UserID, FirstName, LastName from users WHERE UserType != 'dept' AND UserType != 'system' AND (FirstName like '%".$keyword."%' OR LastName like '%".$keyword."%')";
        $query = $this->db->query($sql);
        
        return $query->result_array();
    }
    
    function search($keywords)
    {
        $sql = "";
        $c = count($keywords);
        for($i=0; $i < $c-1; $i++)
        $sql = "(SELECT UserID, FirstName, LastName from users WHERE UserType != 'system' AND (((UserType='student' OR UserType='cr') AND (FirstName like '%".$keywords[$i]."%' OR LastName like '%".$keywords[$i]."%')) OR (UserType='dept' AND (FirstName like '%".$keywords[$i]."%' OR LastName like '%".$keywords[$i]."%' OR Department like '%".$keywords[$i]."%') )))UNION".$sql;
        $sql = $sql."(SELECT UserID, FirstName, LastName from users WHERE UserType != 'system' AND (((UserType='student' OR UserType='cr') AND (FirstName like '%".$keywords[$i]."%' OR LastName like '%".$keywords[$i]."%')) OR (UserType='dept' AND (FirstName like '%".$keywords[$i]."%' OR LastName like '%".$keywords[$i]."%' OR Department like '%".$keywords[$i]."%') )))";

        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    function userDetails($UID)
    {
        $sql = "SELECT * from users WHERE UserID=".$this->db->escape($UID);
        $query = $this->db->query($sql);
        
        $arr = $query->result_array();
//        print_r($arr);
        
        if(count($arr) != 0 && $arr[0]['UserType'] == 'dept')
        {
            $sql = "SELECT * from events WHERE open='1' AND Department=".$this->db->escape($arr[0]['Department']);
            $query = $this->db->query($sql);
            $arr['events'] = $query->result_array();
        }
        return $arr;
    }
    
}
/* End of file user.php */
/* Location: ./system/models/user.php */