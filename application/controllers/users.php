<?php

class Users extends Controller
{

	function Users() {
	
		parent::Controller();
		$this->isLoggedIn();
	}
	
	function isLoggedIn() {
		
		$isLoggedIn = $this->session->userdata('isLoggedIn');
		
		if(!isset($isLoggedIn) || $isLoggedIn != true)
		{
			echo 'You do not have permission to view this page! Try logging in first!';
			die();
		}
	}
	
	function __isAdmin() {
		
		$role = $this->session->userdata('role');
		
		if($role != 'admin')
			return false;
		return true;
		
	}	
	
	function noPermission() {
	
		$data = array(
			
			'sidebar' => 'member/members_sidebar',
			'main_content' => 'site/permission_denied',
			'role' => $this->session->userdata('role'),
			'fullname' => $this->session->userdata('fullname')
		);
		
		$this->load->view('includes/template', $data);
	}
	
	function profile() {
	
		$usrArray = $this->users_model->getUserData($this->session->userdata('email'));
		
		$data = array(
		
			'sidebar' => 'member/members_sidebar',
			'main_content' => 'member/user_profile',
			'usrArray' => $usrArray,
			'fullname' => $this->session->userdata('fullname'),
			'role' => $this->session->userdata('role')
		);
		
		$this->load->view('includes/template', $data);
			
	}
	
	function passwordForm() {
		
		$data = array(
		
			'sidebar' => 'member/members_sidebar',
			'main_content' => 'member/change_password',
			'fullname' => $this->session->userdata('fullname'),
			'role' => $this->session->userdata('role')
		);
		
		$this->load->view('includes/template', $data);
	}
	
	function changePassword() {
		
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('confirm', 'Confirm Password', 'trim|required|matches[password]');
		
		if($this->form_validation->run() == FALSE)
			$this->passwordForm();
		
		else {
		
			$password = $this->input->post('password');
			$result = $this->users_model->updatePassword($this->session->userdata('email'),$password);
			
			if($result == 1)			
				redirect('dashboard/index');
			else
				$this->passwordForm();
		}	
		
	}
	
}