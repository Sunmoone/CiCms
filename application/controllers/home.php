<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends Front_Controller {
	/**
	 * 前台首页
	 *
	 * @access public
	 * @return void
	 */
	public function index()
	{
		$this->layout->view('home_view', $this->data);
	}
}
