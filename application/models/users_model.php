<?php

class Users_Model extends Model
{
	/*
	 * Retrieves all the data related to a user
	 * 
	 * @param : $email
	 *
	 */
	 
	function getUserData($email) {
	
		$sql = "SELECT * from user WHERE email = '$email';";
		
		$query = $this->db->query($sql);
		
		if($query->num_rows() > 0) 	// Returns a single row
		{
			$row = $query->row_array();
		}
		
		return $row;	
	}
	
	/*
	 * Check unique email address
	 *
	 * @param : $email
	 *
	 */
	function validateEmail($email) {
		
		$sql = "SELECT * from user WHERE email = '$email';";
		
		$query = $this->db->query($sql);
		
		if($query->num_rows() == 0)
			return true;
		
		return false;
	}
	
	/* 
	 * Insertion of new members
	 *
	 * @param : $data array which contains all the fields
	 *
	 */
	function insertNewMember($data) {
		
		$insert = $this->db->insert('user', $data);		
		return $insert; // returns 1 or 0.		
	}
	
	/* 
	 * Login validation
	 * @param : $usrArry which contains user's email and password
	 *
	 */
	function validate($usrArray) {
		
		$sql = "SELECT email, password FROM user WHERE email = '".$usrArray['email']. "' and password = '".$usrArray['password']."';";
	
		$query = $this->db->query($sql);
		
		if($query->num_rows() == 1)

			return true;
		return false;
	}
	
	
	function checkUserExists($email) {
		
		$sql = "SELECT * FROM user WHERE email = '$email';";
		$query = $this->db->query($sql);
		
		if($query->num_rows() == 1)
			return true;
		return false;
	}
	
	/*
	 * Update Password
	 * 
	 * @param : $newPassword, $email
	 *
	 */
	 function updatePassword($email, $newpassword) {
	 	
	 	$newpassword = md5($newpassword);	 
	 	$sql = "UPDATE user SET password = '$newpassword' WHERE email = '$email'";
	 	$query = $this->db->query($sql);
	 	return $this->db->affected_rows();
	 }
}