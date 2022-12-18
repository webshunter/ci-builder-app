<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
	private $username = "admin";
	private $password = "admin";
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
        $data['admin'] = "admin";
		$this->load->view('login', $data);
	}

	public function prosses()
	{
		
		// default password admin

		$username = $_POST['username'];
		$password = $_POST['password'];


		if ($username == $this->username && $password == $this->password) {
	
			create_session('login', 'admin');

			return redirect('admin/magama');

		}else{
			return redirect('login');
		}


	}


	public function out()
	{
		destroy_session('login');
		return redirect('login');
	}


}
