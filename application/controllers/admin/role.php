<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Role extends admin_Controller {

	private $_id = 0;
	private $_data = array();

	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_role', 'role', TRUE);
		$this->load->model('model_node', 'node', TRUE);
		$this->load->model('model_user', 'user', TRUE);
		$this->load->library('form_validation');
		$this->load->library('tree');
		$this->_data['admin_url'] = uri_string();
		$this->_data['menu'] = $this->menu;
	}

	public function index() 
	{
		$this->load->library('pagination');
		$config['base_url'] = base_url() . 'admin/role/index/';
		$config['total_rows'] = $this->role->record_count();
		$config['per_page'] = 10; 
		$config['uri_segment'] = 4;
		$config['first_link']  = '首页';
        $config['last_link']   = '尾页';
		$config['next_link']   = '下一页';
		$config['prev_link']   = '上一页';
		$config['num_links']  = 1;

		$this->pagination->initialize($config); 
		$this->_data['page'] = $this->pagination->create_links();
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$role_list = $this->role->get_role_list($config['per_page'], $page);
		if ($role_list) {
			$this->_data['role_list'] = $role_list;
		} else {
			$this->_data['role_list'] = array();
		}
		
		$this->layout->view('admin/role_list', $this->_data);
	}
	/**
	 * 添加角色
	 *
	 * @access public
	 * @return void
	 */
	public function create()
	{
		if ($_SERVER['REQUEST_METHOD'] === "POST")
		{
			$this->_load_validation_rules();

			if ($this->form_validation->run() != FALSE)
			{
				$this->role->add_role(
					array(
						'name' => $this->input->post('name', TRUE),
						'status' => $this->input->post('status', TRUE),
						'desc'    => $this->input->post('desc', TRUE),
					)
				);

				$this->session->set_flashdata('success', '成功添加一个角色');
				go_back();
			}
		} 

		$this->layout->view('admin/role_create_view', $this->_data);
	}
	/**
	 * 编辑角色
	 *
	 * @access public
	 * @return void
	 */
	public function update()
	{
		if (is_numeric($this->uri->segment(4)))
		{	
			$this->_id = $this->uri->segment(4);
			$role = $this->role->get_role_by_id($this->uri->segment(4));
			if ($role) {
				$this->_data['role'] = $role;
			} else {
				show_error('角色不存在或已经被删除');
			}
		} else {
			show_404();
		}

		if ($_SERVER['REQUEST_METHOD'] === "POST")
		{
			$this->_load_validation_rules();

			if ($this->form_validation->run() != FALSE)
			{
				$this->role->update_role($this->uri->segment(4),
					array(
						'name' => $this->input->post('name', TRUE),
						'status' => $this->input->post('status', TRUE),
						'desc'    => $this->input->post('desc', TRUE),
					)
				);
				$this->session->set_flashdata('success', '成功修改角色 '. $this->_data['role']['name'] .'的信息');
				go_back();
			}
		}
		$this->layout->view('admin/role_update_view', $this->_data);
	}
	/**
	 * 用户列表
	 *
	 * @access public
	 * @return void
	 */
	public function userlist()
	{
		if (is_numeric($this->uri->segment(4)))
		{
			$user_list = $this->user->get_user_by_role_id($this->uri->segment(4));
			if ($user_list) {
				$this->_data['user_list'] = $user_list;
			} else {
				$this->_data['user_list'] = array();
			}
		} else {
			show_404();
		}
		$role = $this->role->get_role_by_id($this->uri->segment(4));
		if ($role) {
			$this->_data['role'] = $role;
		} else {
			show_error('角色不存在或已经被删除');
		}
		
		$this->layout->view('admin/role_user_list', $this->_data);
	}
	/**
	 * 授权
	 *
	 * @access public
	 * @return void
	 */
	public function authorization()
	{
		if (is_numeric($this->uri->segment(4)))
		{
			$role = $this->role->get_role_by_id($this->uri->segment(4));
			if ($role) {
				$role['permission'] = explode(',', $role['permission']);
				$this->_data['role'] = $role;
			} else {
				show_error('角色不存在或已经被删除');
			}

			$node_list = $this->node->get_node_list();
			if ($node_list) {
				$this->tree->setTree($node_list);
			    $t = $this->tree->getTree();
			    $this->_data['tree'] = $t;
			} else {
				$thsi->_data['tree'] = array();
			}	
		} else {
			show_404();
		}
		
		if ($_SERVER['REQUEST_METHOD'] === "POST")
		{
			$auth = $this->input->post('check', TRUE);
			$permission = implode(',', $auth);
			
			if ($this->role->auth_permission($this->uri->segment(4), $permission))
			{
				$this->session->set_flashdata('success', $this->_data['role']['name'] . '应用授权成功');
				go_back();
			}
			else
			{
				$this->session->set_flashdata('error', $this->_data['role']['name'] . '应用授权失败');
				go_back();
			}
		}

		$this->layout->view('admin/role_authorization', $this->_data);
	}
	/**
	 * 删除角色
	 *
	 * @access public
	 * @return bool
	 */
	public function delete()
	{
		$deleted = 0;
		if ($this->input->server('SERVER_METHOD') == "POST")
		{
			$role_list = $this->input->post('check', TRUE);
			if ($role_list && is_array($role_list))
			{
				foreach ($role_list as $role)
				{ 
					$query = $this->role->delete_role($role);
					if ($query)
					{
						$deleted++;
					}
				}
			}
		} else {
			$role = $this->uri->segment(4);
			if ($this->role->delete_role($role))
			{
				$deleted++;
			}
		}
		$msg = ($deleted > 0) ? '角色已经删除' : '没有角色被删除';
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
		$this->form_validation->set_rules('name', '名称', 'required|trim|callback__check_name|htmlspecialchars');
		$this->form_validation->set_rules('status', '状态', 'required|trim|integer');
		$this->form_validation->set_rules('desc', '描述', 'trim|htmlspecialchars');	
	}


	/**
     * 回调函数：检查Name是否唯一
     * 
     * @access public
     * @param $str 输入值
     * @return bool
     */
	public function _check_name($str)
	{
		if($this->role->check_exist('name', $str, $this->_id))
		{
			$this->form_validation->set_message('_check_name', '已经存在一个为 '.$str.' 的名称');
			
			return FALSE;
		}
		
		return TRUE;
	}
}
