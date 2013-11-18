<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends admin_Controller {

	private $_data = array();

	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_category', 'category', TRUE);
		$this->load->library('form_validation');
		$this->load->library('tree');
		$this->_data['admin_url'] = uri_string();
		$this->_data['menu'] = $this->menu;
	}
	/**
	 * 分类列表
	 *
	 * @access private
	 * @return void
	 */
	public function index() 
	{	
		$per_page = 20;
		$categorys = $this->category->get_categorys($per_page, $this->uri->segment(4));
		if($categorys) 
		{
			$this->load->library('pagination');
			$config['base_url'] = base_url() . 'admin/category/index/';
			$config['total_rows'] = $categorys['num_rows'];
			$config['per_page'] = $per_page; 
			$config['uri_segment'] = 4;
			$config['next_link'] = '下一页';
			$config['prev_link'] = '上一页';

			$this->pagination->initialize($config); 
			
			$this->_data['page'] = $this->pagination->create_links();

			$this->tree->tab = "&nbsp;&nbsp;&nbsp;&nbsp;";
			$this->tree->setTree($categorys['data']);
			$cate_tree = $this->tree->getTree();
			$this->_data['category_list'] = $cate_tree;
		}
		else
		{
			$this->_data['category_list'] = array();
		}
		

		$this->layout->view('admin/cate_list', $this->_data);
	}
	/**
	 * 创建分类
	 *
	 * @access private
	 * @return void
	 */
	public function create()
	{	
		$categorys = $this->category->get_categorys();
		if ($categorys) {
			//$this->tree->tab = "&nbsp;&nbsp;&nbsp;&nbsp;";
			$this->tree->setTree($categorys['data']);
			$cate_tree = $this->tree->getTree();
			$this->_data['category_list'] = $cate_tree;
		}
		else
		{
			$this->_data['category_list'] = array();
		}

		if ($_SERVER['REQUEST_METHOD'] === "POST")
		{
			$this->_load_validation_rules();

			if ($this->form_validation->run())
			{
				$this->category->add_category(
					array(
						'name'  => $this->input->post('name', TRUE),
						'slug' => $this->input->post('slug', TRUE),
						'pid'   => $this->input->post('pid', TRUE),
						'desc' => $this->input->post('desc', TRUE),
						'type' => 'category'
					)
				);
				$this->session->set_flashdata('success', '成功添加一个分类');
				go_back();
			}
		} 

		$this->layout->view('admin/cate_create_view', $this->_data);
	}
	/**
	 * 更新分类
	 *
	 * @access public
	 * @return void
	 */
	public function update()
	{
		if (is_numeric($this->uri->segment(4)))
		{	
			$this->_id = $this->uri->segment(4);
			$category = $this->category->get_category_by_id($this->uri->segment(4));
			if ($category)
			{
				$this->_data['category'] = $category[0];
			}
			else
			{
				show_error('分类不存在或已经被删除');
			}
		}
		else
		{
			show_error('禁止访问：危险操作');
		}
		$categorys = $this->category->get_categorys();
		//$this->tree->tab = "&nbsp;&nbsp;&nbsp;&nbsp;";
		$this->tree->setTree($categorys['data']);
		$this->_data['category_list'] = $this->tree->getTree();

		if ($_SERVER['REQUEST_METHOD'] === "POST")
		{
			$this->_load_validation_rules();

			if ($this->form_validation->run() != FALSE)
			{
				$this->category->update_category($this->uri->segment(4),
					array(
						'name'  => $this->input->post('name', TRUE),
						'slug' => $this->input->post('slug', TRUE),
						'pid'   => $this->input->post('pid', TRUE),
						'desc' => $this->input->post('desc', TRUE),
					)
				);
				$this->session->set_flashdata('success', '成功修改分类 '. $this->_data['category']['name']);
				go_back();
			}
		}

		$this->layout->view('admin/cate_update_view', $this->_data);
	}
	/**
	 * 删除分类
	 *
	 * @access public
	 * @return bool
	 */
	public function delete()
	{
		$cats = $this->input->post('check', TRUE);
		$deleted = 0;
		if ($cats && is_array($cats))
		{
			foreach ($cats as $cat)
			{   /* 存在子类 不能删除 */
				if ($this->category->get_childs_by_id($cat))
				{
					continue;
				}
				$query = $this->category->delete_category($cat);
				if ($query)
				{
					$deleted++;
				}
				
			}
		}
		$msg = ($deleted > 0) ? '分类已经删除！' : '没有分类被删除，请删除子类后重试！';
		$notify = ($deleted > 0) ? 'success' : 'error';

		$this->session->set_flashdata($notify, $msg);
		go_back();
	}
	/**
	 * 配置表单验证规则
	 *
	 * @access private
	 * @return void
	 */
	private function _load_validation_rules()
	{
		$this->form_validation->set_rules('name', '分类名称', 'trim|required|htmlspecialchars');
		$this->form_validation->set_rules('slug', '缩略名', 'trim|required|alpha_numeric');
		$this->form_validation->set_rules('pid', '父级分类', 'trim|required|integer');
		$this->form_validation->set_rules('desc', '描述', 'trim|htmlspecialchars');
	}
}
