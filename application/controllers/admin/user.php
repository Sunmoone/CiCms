<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends admin_Controller {

	private $_id = 0;
	private $_action = 'create';
	private $_data = array();

	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_user', 'user', TRUE);
		$this->load->model('model_role', 'role', TRUE);
		$this->load->library('form_validation');
		$this->_data['admin_url'] = uri_string();
		$this->_data['menu'] = $this->menu;
	}

	public function index() 
	{	
		
		$per_page = 10;
		$users = $this->user->get_users($per_page, $this->uri->segment(4));
		$this->load->library('pagination');
		$config['base_url'] = base_url() . 'admin/user/index/';
		$config['total_rows'] = $users['num_rows'];
		$config['per_page'] = $per_page; 
		$config['uri_segment'] = 4;
		$config['next_link'] = '下一页';
		$config['prev_link'] = '上一页';

		$this->pagination->initialize($config); 
		
		$this->_data['page'] = $this->pagination->create_links();
		$this->_data['users_list'] = $users['data'];

		$this->layout->view('admin/user_list', $this->_data);
	}

	public function create() 
	{
		$roles = $this->role->get_roles();
		$this->_data['roles_list'] = $roles['data'];

		if ($_SERVER['REQUEST_METHOD'] === "POST")
		{
			$this->_load_validation_rules();

			if ($this->form_validation->run() != FALSE)
			{
				$this->user->add_user(
					array(
						'username' => $this->input->post('username', TRUE),
						'password' => $this->input->post('password', TRUE),
						'nickname' => $this->input->post('nickname', TRUE),
						'email'    => $this->input->post('email', TRUE),
						'roles_id' => $this->input->post('roles_id', TRUE),
						'status'   => $this->input->post('status', TRUE),
						'created'  => time()
					)
				);

				$this->session->set_flashdata('success', '成功添加一个用户账号');
				go_back();
			}
		} 

		$this->layout->view('admin/user_create_view', $this->_data);
	}
	/**
	 * 编辑用户
	 *
	 * @access public
	 * @return bool
	 */
	public function update()
	{	
		if (is_numeric($this->uri->segment(4)))
		{	
			$this->_id = $this->uri->segment(4);
			$user = $this->user->get_user_by_id($this->uri->segment(4));
			if ($user)
			{
				$this->_data['user'] = $user[0];
			}
			else
			{
				show_error('用户不存在或已经被删除');
			}
		}
		else
		{
			show_error('禁止访问：危险操作');
		}
		$roles = $this->role->get_roles();
		$this->_data['roles_list'] = $roles['data'];

		if ($_SERVER['REQUEST_METHOD'] === "POST")
		{
			$this->_action = '';
			$this->_load_validation_rules();

			if ($this->form_validation->run() != FALSE)
			{
				$this->user->update_user($this->uri->segment(4),
					array(
						'username' => $this->input->post('username', TRUE),
						'nickname' => $this->input->post('nickname', TRUE),
						'email'    => $this->input->post('email', TRUE),
						'roles_id' => $this->input->post('roles_id', TRUE),
						'status'   => $this->input->post('status', TRUE),
					)
				);
				$this->session->set_flashdata('success', '成功修改用户 '. $this->_data['user']['username'] .'的账号信息');
				go_back();
			}
		}

		$this->layout->view('admin/user_update_view', $this->_data);
	}

	/**
	 * 删除用户
	 *
	 * @access public
	 * @return bool
	 */
	public function delete()
	{
		$users = $this->input->post('check', TRUE);
		$deleted = 0;
		if ($users && is_array($users))
		{
			foreach ($users as $user)
			{   /* 不能删除自己 */
				if ($user == $this->admin_user['id'])
				{
					continue;
				}

				$query = $this->user->delete_user($user);
				if ($query)
				{
					$deleted++;
				}
				
			}
		}
		$msg = ($deleted > 0) ? '用户已经删除' : '没有用户被删除';
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
		$this->form_validation->set_rules('username', '用户名', 'trim|required|alpha_numeric|callback__check_name');
		if($this->_action)
		{
			$this->form_validation->set_rules('password', '密码', 'trim|required|min_length[6]|matches[confirm]');
			$this->form_validation->set_rules('confirm', '确认密码', 'trim|required|min_length[6]');
		}
		$this->form_validation->set_rules('nickname', '昵称', 'trim|required|callback__check_nickName');
		$this->form_validation->set_rules('email', '邮箱', 'trim|required|valid_email|callback__check_email');
		$this->form_validation->set_rules('roles_id', '角色', 'trim|integer');
		$this->form_validation->set_rules('status', '状态', 'required|trim|integer');
	}

	/**
     * 回调函数：检查Userame是否唯一
     * 
     * @access 	public
     * @param 	$str 输入值
     * @return 	bool
     */
	public function _check_name($str)
	{
		if ($this->users->check_exist('username', $str, $this->_id))
		{
			$this->form_validation->set_message('_check_name', '系统已经存在一个为 ' . $str . ' 的用户名！');
			return FALSE;
		}
	}
	/**
     * 回调函数：检查Userame是否唯一
     * 
     * @access 	public
     * @param 	string $str 输入值
     * @return 	bool
     */
	public function _check_email($str)
	{
		if ($this->users->check_exist('email', $str, $this->_id))
		{
			$this->form_validation->set_message('_check_email', '系统已经存在一个为 ' . $str . ' 的邮箱！');
			return FALSE;
		}
	}
	/**
     * 回调函数：检查Email是否唯一
     * 
     * @access 	public
     * @param 	string $str 输入值
     * @return 	bool
     */
	public function _check_nickName($str)
	{
		if ($this->users->check_exist('nickname', $str, $this->_id))
		{
			$this->form_validation->set_message('_check_nickName', '系统已经存在一个为 ' . $str . ' 的昵称！');
			return FALSE;
		}
	}

}