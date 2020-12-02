<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {

public function __construct()

	{

		parent::__construct();

		$this->load->helper('url');

		$this->load->library('session');

		$this->load->helper('cookie');

	}

	public function index()

	{

		$this->session->sess_destroy();

		delete_cookie('userid');

		delete_cookie('usertype');

		delete_cookie('password');

		redirect('login', 'refresh');

	}

}

?>