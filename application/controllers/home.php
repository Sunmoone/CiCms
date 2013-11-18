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
		$article = $this->content->get_contents(5);
		$this->data['new_list'] = $article['data'];
		
		$this->layout->view('home_view', $this->data);
	}
}
