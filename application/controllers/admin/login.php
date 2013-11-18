<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

     public function __construct()
     {
          parent::__construct();

          $this->load->helper('form');
     }

	/**
      * 默认执行函数
      * 
      * @access public
      * @return void
      */
	public function index() 
  {
    if ($this->session->userdata('admin_user'))
    {
      redirect('admin/dashboard', 'refresh');
    }
          
		$this->load->view('admin/login_view');
	}

	/**
  * 用户登出
  * 
  * @access public
  * @return void
  */
	public function logout() 
     {
          $this->session->unset_userdata('admin_user');
          $this->session->sess_destroy();
          redirect('admin/login', 'refresh');
	}
}