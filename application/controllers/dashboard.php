<?php

class Dashboard extends Controller {

	function Dashboard() {
		
		parent::Controller();
		$this->isLoggedIn();
		
	}
	
	function isLoggedIn() {
	
		$isLoggedIn = $this->session->userdata('isLoggedIn');
		
		if(!isset($isLoggedIn) || $isLoggedIn != true) 
		{
			echo 'You do not have permission to view this page';
			die();
		}
	}
	
	function index() {

		$userData = $this->users_model->getUserData($this->session->userdata('email'));
		$userData['isLoggedIn'] = true;
			
		$this->session->set_userdata($userData);
		
		
		$data = array(	
			'sidebar' => 'member/members_sidebar',
			'fullname' => $userData['fullname'],
			'role' => $userData['role']	
			);
		
		echo 'done!';
		
		$hehe = get_cookie('recentPackages');

		
		if($hehe != '') { // if there is no recently viewed packages
			
			$recentPackages = array();
			
			foreach (unserialize(get_cookie('recentPackages')) as $id) {
			
				$recentPackages[] = $this->packages_model->getPackage($id);	
			}			
			
			$data['main_content'] = 'member/main_index';
			$data['recentPackages'] = $recentPackages;
		}
		
		else {
			$data['main_content'] = 'site/main_index';
		}
			
		$this->load->view('includes/template', $data);	
	}
	
	function logout()
	{
		// unsetting all variables
		$array_items = array(
			'fullname' => '', 
			'password' => '', 
			'role' => '', 
			'nationality' => '', 
			'email' => '', 
			'postal code' => '',
			'res_address' => '',
			'country' => '',
			'contact_no' => '',
			'isLoggedIn' => false
			);

		$this->session->unset_userdata($array_items);
		
		$this->session->sess_destroy();	// session is destroyed
		
		delete_cookie('cookieEmail');
		delete_cookie('cookieFullname');
		
		redirect('site/normalArea');
	}	
}