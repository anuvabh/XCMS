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
                        
                        echo $this->UserID."<br />".$this->FirstName;
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
	
        function checkEmail($email)
        {
            
            
            $sql = "SELECT UserID FROM users WHERE Email=".$this->db->escape($email);
            $query = $this->db->query($sql);
            
            return $query->num_rows();
        }
	function register($data, $type = 'student')
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
            return $this;
                 
	}//end of register()
	
        function fetchDepartments()
        {
            
            $sql = "SELECT Code FROM departments WHERE type='academic'";
            $query = $this->db->query($sql);
            
            return $query->result_array();
        }
}
/* End of file user.php */
/* Location: ./system/models/user.php */    