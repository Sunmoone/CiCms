<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article extends Front_Controller {
	/**
	 * 前台内容页
	 *
	 * @access public
	 * @return void
	 */
	public function index()
	{
		$id = $this->uri->segment(2);
		if ($id)
		{
			$article = $this->contents->get_content_by_id($id);
			if ($article)
			{
				$this->data['article'] = $article[0];
				$this->data['breadcrumbs'] = $this->tree->breadcrumbs($article[0]['category_id']);
			}
			else
			{
				show_error('文章不存在或已被删除！');
			}
		}
		else
		{
			show_error('非法操作，禁止访问！');
		}
		$this->layout->view('article_view', $this->data);
	}

}