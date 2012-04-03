<?php

class User extends CI_Model
{
	function login($username, $password)
	{
		$this->load->database();
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
				else	//accoutn frozen >:(
				{
					$this->errorCode = 1011;
				}
			}
			else//acount exists but password is incorrect
			{
				$this->errorCode = 1012;
			}
		}
		else//username or password invalid
		{
			$this->errorCode = 1012;
		}
		return $this;
	}//end of login()
	
	function register()
	{
	
	}//end of register()
	
}
/* End of file user.php */
/* Location: ./system/models/user.php */