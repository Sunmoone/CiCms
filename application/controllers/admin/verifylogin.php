<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class VerifyLogin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_user', 'user', TRUE);
		$this->load->model('model_node', 'node', TRUE);
		$this->load->library('tree');
	}

	public function index()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('username', '用户名', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', '密码', 'trim|required|xss_clean|callback_check_database');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('admin/login_view');
		}
		else
		{
			redirect('admin/dashboard', 'refresh');
		}
	}

	public function check_database($password)
	{
		$username = $this->input->post('username');

		$user = $this->user->login($username, $password);

		if ($user)
		{
			if (!$user['role_status'])
			{
				$this->session->set_flashdata('error', '你所在的组被限制登录！');
				go_back();
			}
			if (!$user['status'])
			{
				$this->session->set_flashdata('error', '你的账号被限制登录！');
				go_back();
			}

			$permission = explode(',', $user['permission']);

			$permission = $this->permission_to_array($permission);

			$sess_array = array(
				'id' => $user['id'],
				'username' => $user['username'],
				'role_id' => $user['role_id'],
				'permission' => $permission,
			);

			$this->session->set_userdata('admin_user', $sess_array);
				
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('check_database', '用户名或密码无效！');
			return false;
		}
	}

	private function permission_to_array($permission)
	{
		$tree = new Tree();
		$result = $this->node->get_nodes_by_id($permission);
		$this->tree->setTree($result);
		$a = $this->tree->buildTree();
		$b = array();

		foreach ($a as $val)
		{
			$b[] = $val['name'];
			$val['childs'] = isset($val['childs']) ? $val['childs'] : FALSE;
			if ($val['childs']) {
				foreach ($val['childs'] as $v)
				{
					$b[] = $val['name'] . '/' . $v['name'];
					$v['childs'] = isset($v['childs']) ? $v['childs'] : FALSE;
					
					if ($v['childs']) {
						foreach ($v['childs'] as $s)
						{
							$b[] = $val['name'].'/'.$v['name'].'/'.$s['name'];
						}
					}
				}
			}
		}
		$b[] = 'admin/dashboard';
		return $b;
	}
}
