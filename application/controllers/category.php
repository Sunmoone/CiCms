<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends Front_Controller {
	/**
	 * 前台分类列表
	 *
	 * @access public
	 * @return void
	 */
	public function index()
	{
		$slug = trim($this->uri->segment(2));
		if ($slug)
		{
			$category = $this->categorys->get_category_by_slug($slug);
			if ($category)
			{
				$this->data['breadcrumbs'] = $this->tree->breadcrumbs($category[0]['id']);
				$this->data['title'] = $category[0]['name'];
				$childs = $this->tree->scanNodeOfTree($category[0]['id'],0);
				$cats = array($category[0]['id']);
				foreach ($childs as $k => $v) {
					$cats[] = $v['id'];
				}
			
				$article_list = $this->contents->get_contents(NULL,NULL,$cats);
				$this->data['article_list'] = $article_list['data'];
			}
			else
			{
				show_error('分类不存在或已被删除!');
			}
		}
		else
		{
			show_error('非法操作，禁止访问！');
		}
		$this->layout->view('category_view', $this->data);
	}

}