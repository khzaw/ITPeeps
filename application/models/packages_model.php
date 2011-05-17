<?php

class Packages_model extends Model {

	function getAllPackages($per_page, $segment) {
		
		// SELECT * FROM tour_package LIMIT per_page, segment ORDERY BY id DESC;
		
		$query = $this->db->orderby('id', 'desc');
		$query = $this->db->get('tour_package', $per_page, $segment);
		
		return $query->result_array();	
	}
	
	function insertNewPackage($newpackage) {
	
		$result = $this->db->insert('tour_package', $newpackage);
		
		return $result;
	}
	
	function getPackage($id)
	{
		$sql = "SELECT * FROM tour_package WHERE id = $id;";
		$result = $this->db->query($sql);
		
		return($result->row_array());
	}
	
	function deletePackage($id)
	{
		$sql = "DELETE FROM tour_package WHERE id = $id;";
		$result = $this->db->query($sql);
		
		return $result;
	}
	
}