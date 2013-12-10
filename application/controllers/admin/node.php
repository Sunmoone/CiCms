<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Node extends admin_Controller {

	private $_data = array();

	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_node', 'node', TRUE);
		$this->load->library('form_validation');
		$this->load->library('pagination');
		$this->load->library('tree');
		$this->_data['admin_url'] = uri_string();
		$this->_data['menu'] = $this->menu;
	}
	public function page()
	{
		$this->index();
	}
	/**
	 * 节点列表
	 *
	 * @access private
	 * @return void
	 */
	public function index() 
	{	
		$config['base_url']    = base_url() . 'admin/node/page/';
		$config['total_rows']  = $this->node->record_count();
		$config['per_page']    = 10; 
		$config['uri_segment'] = 4;
		$config['first_link']  = '首页';
        $config['last_link']   = '尾页';
		$config['next_link']   = '下一页';
		$config['prev_link']   = '上一页';
		$cionfig['num_links']  = 1;

		$this->pagination->initialize($config); 
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$data = $this->node->get_nodes($config['per_page'], $page);
		$this->_data['page'] = $this->pagination->create_links();

		if ($data) {
			foreach($data as $k => $v) {
				$data[$k]['breadcrumbs'] = $this->breadcrumbs($v['id']);
			}
		}
		
		$this->_data['node_list'] = $data;
		
		$this->layout->view('admin/node_list', $this->_data);
	}
	public function breadcrumbs($id=0)
	{
		$node = $this->node->get_node_by_id($id);
		if($node[0]['pid']>0) {
			return  $this->breadcrumbs($node[0]['pid']) . '/' . $node[0]['name'];
		} else {
			return $node[0]['name'];
		}
	}
	/**
	 * 创建节点
	 *
	 * @access public
	 * @return void
	 */
	public function create()
	{	
		if ($_SERVER['REQUEST_METHOD'] === "POST")
		{
			$this->_load_validation_rules();

			if ($this->form_validation->run())
			{
				$this->node->add_node(
					array(
						'name'  => $this->input->post('name', TRUE),
						'title' => $this->input->post('title', TRUE),
						'pid'   => $this->input->post('pid', TRUE),
						'level' => $this->input->post('level', TRUE),
					)
				);
				$this->session->set_flashdata('success', '成功添加一个节点');
				go_back();
			}
		} 
		$nodes = $this->node->get_nodes(NULL,NULL,array('level !=', 3));
		$this->_data['nodes_list'] = $nodes['data'];

		$this->layout->view('admin/node_create_view', $this->_data);
	}
	/**
	 * 更新节点
	 *
	 * @access public
	 * @return void
	 */
	public function update()
	{
		if (is_numeric($this->uri->segment(4)))
		{	
			$this->_id = $this->uri->segment(4);
			$node = $this->node->get_node_by_id($this->uri->segment(4));
			if ($node)
			{
				$this->_data['node'] = $node[0];
			} else {
				show_error('节点不存在或已经被删除');
			}
		} else {
			show_404();
		}
		$nodes = $this->node->get_nodes(NULL,NULL,array('level !=', 3));
		$this->_data['nodes_list'] = $nodes['data'];

		if ($this->input->server('REQUEST_METHOD') == "POST")
		{
			$this->_load_validation_rules();

			if ($this->form_validation->run() != FALSE)
			{
				$this->node->update_node($this->uri->segment(4),
					array(
						'name'  => $this->input->post('name', TRUE),
						'title' => $this->input->post('title', TRUE),
						'pid'   => $this->input->post('pid', TRUE),
						'level' => $this->input->post('level', TRUE),
					)
				);
				$this->session->set_flashdata('success', '成功修改节点 '. $this->_data['node']['name']);
				go_back();
			}
		}

		$this->layout->view('admin/node_update_view', $this->_data);
	}
	/**
	 * 删除节点
	 *
	 * @access public
	 * @return bool
	 */
	public function delete()
	{
		if ($this->input->server('SERVER_METHOD') == "POST")
		{
			$nodes = $this->input->post('check', TRUE);
			$deleted = 0;
			if ($nodes && is_array($nodes))
			{
				foreach ($nodes as $node)
				{   
					/* 存在子节点 不能删除 */
					if ($this->node->get_childs_by_id($node))
					{
						continue;
					}
					$query = $this->node->delete_node($node);
					if ($query)
					{
						$deleted++;
					}
					
				}
			}
		} else {
			$node = $this->uri->segment(4);
			if ($this->node->delete_node($node))
			{
				$deleted++;
			}
		}
		
		$msg = ($deleted > 0) ? '节点已经删除！' : '没有节点被删除，请删除子节点后重试！';
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
		$this->form_validation->set_rules('name', '节点名称', 'trim|required|alpha_numeric');
		$this->form_validation->set_rules('title', '节点标题', 'trim|required|htmlspecialchars');
		$this->form_validation->set_rules('pid', '父节点', 'trim|required|integer');
		$this->form_validation->set_rules('level', '层级', 'trim|required|integer');
	}
}
