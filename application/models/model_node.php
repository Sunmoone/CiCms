<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_node extends CI_Model {
	// 获取总记录数
	public function record_count()
	{
		return $this->db->count_all("node");
	}

	// 获取所有节点 
	public function get_nodes($limit=NULL, $offset=NULL,$where = array())
	{
		$this->db->limit($limit, $offset);
		if ($where) {
			$this->db->where($where[0], $where[1]);
		}
		$this->db->order_by('id', 'desc');
		$this->db->order_by('pid', 'desc');

		$query = $this->db->get('node');

		if ($query->num_rows > 0) {
			foreach($query->result_array() as $row) {
				$data[] = $row;
			}
			return $data;
		} 
		return false;
	}
	
	// 获取单个节点信息
	public function get_node_by_id($id)
	{
		$this->db->where('id', intval($id));
		$query = $this->db->get('node');

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
	 * 获取多个节点的信息
	 *
	 * @access public
	 * @param string $id
	 * @return array 
	 */
	public function get_nodes_by_id($id)
	{
		$this->db->where_in('id', $id);
		$query = $this->db->get('node');

		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return FALSE;
		}
	}
	/**
	 * 获取单个节点的父节点信息
	 *
	 * @access public
	 * @param int $id
	 * @return array 
	 */
	public function get_node_by_pid($pid)
	{
		$this->db->where('id', intval($pid));
		$query = $this->db->get('node');

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
	 * 判断某个节点是否有子节点
	 *
	 * @access public
	 * @param int $id
	 * @return bool
	 */
	public function get_childs_by_id($id)
	{
		$this->db->where('pid', intval($id));
		$query = $this->db->get('node');

		if ($query->num_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	/**
	 * 添加一个节点
	 *
	 * @access private
	 * @param array $data
	 * @return array
	 */
	public function add_node($data)
	{
		$this->db->insert('node', $data);

		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}
	/**
     * 修改节点信息
     * 
     * @access public
     * @param int - $id 节点ID
	 * @param array - $data 节点信息
     * @return bool - success/fail
     */	
	public function update_node($id, $data)
	{
		$this->db->where('id', intval($id));
		$this->db->update('node', $data);

		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}
	/**
     * 删除一个节点
     * 
     * @access public
	 * @param  int - $id 节点id
     * @return bool - success/fail
     */
	public function delete_node($id)
	{
		$this->db->delete('node', array('id' => intval($id))); 
		
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}
}