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

        $query = $this->db->affected_rows();

        // Should be 1 but still we check...
        if ($query < 1)
        {
            $this->error = TRUE;
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
    
    
    
}
/* End of file user.php */
/* Location: ./system/models/user.php */    