<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends Admin_Controller {

	private $_data = array();

	public function __construct()
	{
		parent::__construct();

		$this->_data['admin_url'] = uri_string();
		$this->_data['menu'] = $this->menu;
	}

	public function index() 
	{

		$this->layout->view('admin/dashboard', $this->_data);
	}

	public function changePassword()
	{
		$this->load->library('form_validation');
		$this->layout->view('admin/changePassword', $this->_data);
	}

}