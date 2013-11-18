<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_role extends CI_Model {

	/**
	 * 获取所有的角色
	 *
	 * @access public
	 * @return array 
	 */
	public function get_roles($limit=NULL, $offset=NULL)
	{
		if ($limit)
		{
			$this->db->limit($limit);
		}
		if ($offset)
		{
			$this->db->offset($offset);
		}
		$this->db->order_by('id', 'desc');

		$query = $this->db->get('role');

		if ($query->num_rows > 0)
		{
			return array(
				'data' => $query->result_array(),
				'num_rows' => $this->db->count_all_results('role')
			);
		}
		else
		{
			return false;
		}
	}
	/**
	 * 获取单个角色信息
	 *
	 * @access public
	 * @return array - 角色信息
	 */
	public function get_role_by_id($id)
	{
		$this->db->where('id', intval($id));
		$query = $this->db->get('role');

		if ($query->num_rows() == 1)
		{
			return $query->result_array();
		}
		else
		{
			return FALSE;
		}

	}
	/**
     * 添加一个角色
     * 
     * @access public
	 * @param int - $data 角色信息
     * @return bool - success/fail
     */	
	public function add_role($data)
	{
		$this->db->insert('role', $data);

		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}
	/**
     * 修改角色信息
     * 
     * @access public
     * @param int - $id 角色ID
	 * @param array - $data 角色信息
     * @return bool - success/fail
     */	
	public function update_role($id, $data)
	{
		$this->db->where('id', intval($id));
		$this->db->update('role', $data);

		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}
	/**
     * 删除一个用户
     * 
     * @access public
	 * @param  int - $id 用户id
     * @return bool - success/fail
     */
	public function delete_role($id)
	{
		$this->db->delete('role', array('id' => intval($id))); 
		
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}
	/**
	 * 检查是否存在相同的名称
	 *
	 * @access public
	 * @param string - $key 
	 * @param string - $value 
	 * @param int    - $exclude_id 需要排除的id
	 * @return bool  - success/fail 
	 */
	public function check_exist($key = 'name', $value = '', $exclude_id = 0)
	{
		if (!empty($value))
		{
			$this->db->select('id')->from('role')->where($key, $value);
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
	/**
     * 授权许可
     * 
     * @access public
     * @param  int $id - 角色ID
	 * @param  string - $permission
     * @return bool - success/fail
     */
	public function auth_permission($id, $permission)
	{
		$this->db->where('id', intval($id));
		$this->db->update('role', array('permission'=>$permission));

		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}
}