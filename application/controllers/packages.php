<?php

class Packages extends Controller {

	function Packages() {
	
		parent::Controller();
		$this->isLoggedIn();
	}
	
	function isLoggedIn() {
		$isLoggedIn = $this->session->userdata('isLoggedIn');
		$role = $this->session->userdata('role');
		
		if((!isset($isLoggedIn) || $isLoggedIn == false)) 
		{
			echo 'You do not have permission to view this page! Try logging in first!';
			
			
			$this->noPermission();
			die();
		}
	}
	
	function isAdmin() {
		$role = $this->session->userdata('role');
		
		if($role != 'admin')
		{
			return false;
		}
		
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
	
	function index() {
		
		// make use of pagination to list down all the travel packages

		// load the pagination library
		$this->load->library('pagination');
		
		// setting the configurations
		$config = array(
			
			'base_url' => base_url(). 'packages/index',
			'total_rows' => $this->db->get('tour_package')->num_rows(),
			'per_page' => 4,
			'num_links' => 5,
			'full_tag_open' => '<div id="pagination">',
			'full_tag_close' => '</div>',
			'first_link' => 'First',
			'last_link' => 'Last',
			'next_link' => 'Next',
			'prev_link' => 'Prev'
		);
		
		$this->pagination->initialize($config);
		
		$data['sidebar'] = 'member/members_sidebar';
		$data['packages'] = $this->packages_model->getAllPackages($config['per_page'], $this->uri->segment(3));
		$data['fullname'] = $this->session->userdata('fullname');
		$data['role'] = $this->session->userdata('role');
		
		
		if($this->session->userdata('role') == 'admin') {
			$data['main_content'] = 'admin/packages';
		}
		else {
			$data['main_content'] = 'member/packages';
		}
		$this->load->view('includes/template', $data);	
	}
	
	// this function just simply loads the form View
	function newPackage() {
			
		if(!$this->isAdmin())
		{
			$this->noPermission();
			return;
		}
		
		$data = array(
			
			'sidebar' => 'member/members_sidebar',
			'main_content' => 'admin/add_package',
			'fullname' => $this->session->userdata('fullname'),
			'role' => $this->session->userdata('role')
		
		);
	
		$this->load->view('includes/template', $data);
	
	}
	
	function addPackage() {
	
		// setting form validation rules
		$this->form_validation->set_rules('packagename', 'Package Name', 'trim|required');
		$this->form_validation->set_rules('description', 'Description', 'trim|required');
		$this->form_validation->set_rules('location', 'Location', 'trim|required');
		$this->form_validation->set_rules('price', 'Price', 'trim|required|');
		
		// if server-side form validation failed, go back to the form
		if(($this->form_validation->run()) == FALSE)
		{
			$this->newPackage();
		}
		else {	// if server-side validation is successful
		
			// configurations about the uploaded files
			$config = array(
				'upload_path' => "./images/packages",
				'allowed_types' => 'gif|jpg|jpeg|png'
			);
		
			// loading the upload class to make use of it's function
			$this->load->library('upload', $config);
		
			// actual uploading ( returns a boolean )
			$success = $this->upload->do_upload("imagefile");
		
			if(!$success)	// if uploading is not successful
			{
				// display errros
				echo $this->upload->display_errors();
				$this->newPackage();
			}
			else
			{
				// the array that contains all upload information.
				$finfo = $this->upload->data();		// similar to $_FILES
			
				// uploading successful => insert into database
				$data = array(
					'name' => $this->input->post('packagename'),
					'description' => $this->input->post('description'),
					'location' => $this->input->post('location'),
					'price' => $this->input->post('price'),
					'image' => $finfo['file_name']
				);
			
				// call Packages_moel to insert the $data array
				$result = $this->packages_model->insertNewPackage($data);
			
				if($result)	// if insertion is successful, redirect to allPackages page
				{
					$this->index();
				}
				else // else go back to the form
				{
					$this->newPackage();
				}
			}
		}	
	}
	
	function deletePackage()
	{
		if(!$this->isAdmin())
		{
			$this->noPermission();
			return;
		}
		
		$this->packages_model->deletePackage($this->uri->segment(3));
		redirect('packages/index');
	}
	
	
	function details()
	{
		$package = $this->packages_model->getPackage($this->uri->segment(3));
		
		$cookie = unserialize(get_cookie('recentPackages'));	
		$cookie[] = $package['id']; // array($package['id']);
		
		set_cookie('recentPackages', serialize($cookie), '86400');
		
		
		$data = array(
			'sidebar' => 'member/members_sidebar',
			'package' => $package,
			'main_content' => 'member/package_details',
			'fullname' => $this->session->userdata('fullname'),
			'role' => $this->session->userdata('role')
			
		);
		
		// if logged in user is `admin`, load the `admin` view
		if($this->session->userdata('role') == 'admin') {
			$data['main_content'] = 'admin/package_details';
			
			$this->load->view('includes/template', $data);
		}
		
		else {	
			$this->load->view('includes/template', $data);
		}
	}
}