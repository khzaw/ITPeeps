<?php

class Site Extends Controller
{

	/* Controller */
	
	function Site() {
		
		parent::Controller();
	}
	
	function normalArea() {
		
		$data = array(
			
			'sidebar' => 'site/sidebar',
			'main_content' => 'site/main_index'
		);
			
		$this->load->view('includes/template', $data);
	}
	
	function index()
	{	
		delete_cookie('cookieEmail');
		delete_cookie('cookieFullname');
		
		// first time login ( no cookie data initially )
		if(get_cookie('cookieEmail') == false && get_cookie('cookieFullname') == false)
		{	
			$usrArray['email'] = $this->input->post('email');
			$usrArray['password'] = md5($this->input->post('password'));
			
			
			$query = $this->users_model->validate($usrArray);
			
			// if user validation is successful ( A Registered User )
			if($query)
			{
				$userData = $this->users_model->getUserData($usrArray['email']);
				$userData['isLoggedIn'] = true;
				$this->session->set_userdata($userData);
				
				if($this->input->post('remember'))
				{
					set_cookie('cookieEmail', $userData['email'], '86400');
					set_cookie('cookieFullname', $userData['fullname'], '86400');
				}
				
				redirect('dashboard/index');
			}
			else
			{
				$this->normalArea();
			}
		}
		
		
		else {

			// If it if the same user as before
			if(get_cookie('cookieEmail'))
			{
		
				$userData = $this->users_model->getUserData(get_cookie('cookieEmail'));
				$userData['isLoggedIn'] = true;
				$this->session->set_userdata($userData);
				redirect('dashboard/index');
			}
			
			// If another use logins in, after the first remembered user logged out!
			else
			{
				$usrArray['email'] = $this->input->post('email');
				$usrArray['password'] = md5($this->input->post('password'));
			
				$query = $this->users_model->validate($usrArray);
			

				if($query)
				{
					$userData = $this->users_model->getUserData($usrArray['email']);
					$userData['isLoggedIn'] = true;
					$this->session->set_userdata($userData);
				
					if($this->input->post('remember'))
					{
						set_cookie('cookieEmail', $userData['email'], '86400');
						set_cookie('cookiePassword', $userData['password'], '86400');
						set_cookie('cookieFullname', $userData['fullname'], '86400');
						set_cookie('cookieRole', $userData['role'], '86400');
					}
				
					redirect('dashboard/index');

				}
			}
		}
	}
		
	// Nothing fanciful, just loading the Register Form	
	function register() 
	{
		
		$data['sidebar'] = 'site/sidebar';
		$data['main_content'] = 'site/registration';
		$this->load->view('includes/template', $data);
	}
	
	function checkEmail($email)
	{
		// if an email has already existed
		echo $this->users_model->validateEmail($email);
		if(!$this->users_model->validateEmail($email))
		{
			$this->form_validation->set_message('Email', 'The email is already been in use');
			return false;	
		}
		else
		{
			return true;
		}
	}
	
	function createNewMember() {
		
		// a bunch of rules for server-side form validation
		$this->form_validation->set_rules('fullname', 'Full Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|check_if_exists');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('confirm', 'Confirm Password', 'trim|required|matches[password]');
		
		$this->form_validation->set_rules('res_address', 'Residential Address', 'trim|required');
		$this->form_validation->set_rules('postal_code', 'Postal Code', 'trim|required');
		$this->form_validation->set_rules('country', 'Country', 'trim|required');
		$this->form_validation->set_rules('contact_number', 'Contact Number', 'trim|required');
		
		
		if(($this->form_validation->run()) == FALSE) {	// load back the form for bad form inputs		
			$this->register();
		}
		else // if form validation is successful
		{
			// try to insert a new reocrd into the `user` table
			$new = array(
				'fullname' => $this->input->post('fullname'),			// similar to $_POST['fullname']
				'password' => md5($this->input->post('password')),
				'email' => $this->input->post('email'),
				'role' => 'user',
				'nationality' => $this->input->post('nationality'),
				'res_address' => $this->input->post('res_address'),
				'postal_code' => $this->input->post('postal_code'),
				'country' => $this->input->post('country'),
				'contact_no' => $this->input->post('contact_no')				
				);
				
			if($this->users_model->insertNewMember($new)) {
				redirect('site/index');
			}
			
			else {
				$this->register();
			}
		}		
	}
	
	function sitemap() {	// load the sitemap page
		
		if($this->session->userdata('isLoggedIn')) {
			
			$data = array(
				
				'sidebar' => 'member/members_sidebar',
				'fullname' => $this->session->userdata('fullname'),
				'role' => $this->session->userdata('role')
			);
		}
		else {
			
			$data['sidebar'] = 'site/sidebar';
		}
		
		$data['main_content'] = 'site/sitemap';
		$this->load->view('includes/template', $data);
	}
	
	function forgotPassword() {
		
		$data = array (
			
			'sidebar' => 'site/sidebar',
			'main_content' => 'site/forgotPassword',
		);
		
		$this->load->view('includes/template', $data);
	}
	
	function passwordProcess() {
		
		$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
		
		if($this->form_validation->run() == FALSE) {	// for invalid inputs
			
			$this->forgotPassword();	// load the form back
			
		} else {
		
			$email = $this->input->post('email');
			
			if($this->users_model->checkUserExists($email)) {
				
				$newpassword = $this->__createRandomPassword();
				
				if($this->users_model->updatePassword($email, $newpassword)) {
					
					$sbj = "Lost Password";
					$message = "Email Address = $email. Your new password is $newpassword";
					$headers = "From ITPeeps ";
					mail($email, $sbj, $message, $headers);
					
					$data = array(
					
					'sidebar' => 'site/sidebar',
					'main_content' => 'site/newpassword'
					);
					
					$this->load->view('includes/template', $data);
				}
				else {
				
					redirect('site/forgotPassword');
				}					
			}
			
		}
	}
	
	/*  
	 *
	 * HELPER FUNCTIONS
	 *
	 */
	
	function __createRandomPassword() {
	
		$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
		$count = 0;
		$password = '';
	
		while($count < 8) {
			$num = mt_rand(0, 58);
			$tmp = substr($chars, $num, 1);
			$password .= $tmp;
			$count++;
		}
	
		return $password;
	}	

	/*
	 * Check unique email address during registration
	 *
	 * @param : $email
	 */
	 
	 function check_if_exists($email) {
	 
	 	if(!$this->users_model->validateEmail($email))	// a new email address
	 		return true;
	 	
	 	else {
	 		
	 		$this->validation->set_message('check_if_exists', 'The email is already in use');
	 		return false;
	 	}	
	 }
}
