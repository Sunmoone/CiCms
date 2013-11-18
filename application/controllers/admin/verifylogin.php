<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class VerifyLogin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('users', '', TRUE);
		$this->load->model('nodes', '', TRUE);
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

		$user = $this->users->login($username, $password);

		if ($user)
		{
			$sess_array = array();
			foreach($user as $row)
			{
				if (!$row->roles_status)
				{
					$this->session->set_flashdata('error', '你所在的组被限制登录！');
					go_back();
				}
				if (!$row->status)
				{
					$this->session->set_flashdata('error', '你的账号被限制登录！');
					go_back();
				}

				$permission = explode(',', $row->permission);

				$permission = $this->permission_to_array($permission);

				$sess_array = array(
					'id' => $row->id,
					'username' => $row->username,
					'roles_id' => $row->roles_id,
					'permission' => $permission,
				);

				$this->session->set_userdata('admin_user', $sess_array);
				
			}
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
		$result = $this->nodes->get_nodes_by_id($permission);
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
		$b[] = 'admin/dashboard/changePassword';

		return $b;
	}
}