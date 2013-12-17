<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_user extends CI_Model {
	/**
	 * 标识用户的唯一键 {username, nickname, email}
	 * 
	 * @access private
	 * @var array
	 */
	private $_unique_key = array('username', 'nickname', 'email');
    // 获取总记录数
	public function record_count()
	{
		return $this->db->count_all("user");
	}
	/**
	 * 用户登录时检查用户是否存在
	 * 
	 * @access public
	 * @return array
	 */
	public function login($username, $password)
	{
		$this->db->select('user.id, user.role_id, user.username, user.password, user.status, role.permission, role.status as role_status');
		$this->db->from('user');
		$this->db->where('username = ' . "'" . $username . "'");
		$this->db->where('password = ' . "'" . sha1($password) . "'");
		$this->db->join('role', 'role.id=user.role_id');
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 1) {
			return $query->row_array();
		}
		return false;
	}
	/**
	 * 获取所有用户信息
	 *
	 * @access public
	 * @return array - 用户信息
	 */
	public function get_user_list($limit=NULL, $offset=NULL) 
	{
		$this->db->select('user.*,role.name');
		$this->db->join('role', 'role.id=user.role_id', 'left');;
		if ($limit) {
			$this->db->limit($limit, $offset);
		}
		$this->db->order_by('user.id', 'desc');
		$query = $this->db->get('user');

		if ($query->num_rows() > 0) {
			foreach($query->result_array() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	// 获取单个用户信息
	public function get_user_by_id($id)
	{
		$this->db->where('id', intval($id));
		$this->db->limit(1);
		$query = $this->db->get('user');

		if ($query->num_rows() == 1) {
			return $query->row_array();
		}
		return FALSE;
	}

	public function get_user_field($uid, $name) 
	{
		$query = $this->db->select($name)->get_where('user', array('id' => $uid));

		if ($query->num_rows > 0) {
			 $user = $query->row_array();
			 return $user[$name];
		}
		return FALSE;
	}
	
	// 获取某个角色的所有用户
	public function get_user_by_role_id($role_id)
	{
		$this->db->where('role_id', intval($role_id));
		$query = $this->db->get('user');
		if ($query->num_rows() > 0) {
			foreach($query->result_array() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return FALSE;
	}
	/**
     * 添加一个用户
     * 
     * @access public
	 * @param int - $data 用户信息
     * @return bool - success/fail
     */	
	public function add_user($data)
	{
		$data['password'] = sha1($data['password']);
	
		$this->db->insert('user', $data);

		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}
	/**
     * 修改用户信息
     * 
     * @access public
     * @param int - $id 用户ID
	 * @param array - $data 用户信息
     * @return bool - success/fail
     */	
	public function update_user($id, $data)
	{
		$this->db->where('id', intval($id));
		$this->db->update('user', $data);

		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}
	/**
     * 删除一个用户
     * 
     * @access public
	 * @param  int - $id 用户id
     * @return bool - success/fail
     */
	public function delete_user($id)
	{
		$this->db->delete('user', array('id' => intval($id))); 
		
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}
	/**
	 * 检查是否存在相同{用户名/昵称/邮箱}
	 *
	 * @access public
	 * @param string - $key {username,nickname,email}
	 * @param string - $value {用户名/昵称/邮箱}
	 * @param int    - $exclude_id 需要排除的id
	 * @return bool  - success/fail 
	 */
	public function check_exist($key = 'username', $value = '', $exclude_id = 0)
	{
		if (in_array($key, $this->_unique_key) && !empty($value))
		{
			$this->db->select('id')->from('user')->where($key, $value);
			if (!empty($exclude_id) && is_numeric($exclude_id))
			{
				$this->db->where('id <>', $exclude_id);
			}
			$query = $this->db->get();
			$num = $query->num_rows();

			$query->free_result();

			return ($num > 0) ? TRUE : FALSE;
		}

		return FALSE;
	}
}
