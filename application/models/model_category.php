<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_category extends CI_Model {

	public function record_count()
	{
		return $this->db->count_all('category');
	}
	/**
	 * 获取所有分类
	 *
	 * @access public
	 * @return array
	 */
	public function get_category_list($limit=NULL, $offset=NULL)
	{
		if ($limit) {
			$this->db->limit($limit, $offset);
		}
		$this->db->order_by('id', 'asc');
		$query = $this->db->get('category');
		if ($query->num_rows > 0)
		{
			foreach($query->result_array() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}
	/**
	 * 获取单个分类信息
	 *
	 * @access public
	 * @param int $id
	 * @return array 
	 */
	public function get_category_by_id($id)
	{
		$this->db->where('id', intval($id));
		$query = $this->db->get('category');

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
	 * 获取多个分类的信息
	 *
	 * @access public
	 * @param string $id
	 * @return array 
	 */
	public function get_categorys_by_id($id)
	{
		$this->db->where_in('id', $id);
		$query = $this->db->get('category');

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
	 * 获取单个分类的父级分类信息
	 *
	 * @access public
	 * @param int $id
	 * @return array 
	 */
	public function get_category_by_pid($pid)
	{
		$this->db->where('id', intval($pid));
		$query = $this->db->get('category');

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
	 * 根据slug获取分类信息
	 *
	 * @access public
	 * @param int $id
	 * @return bool
	 */
	public function get_category_by_slug($slug)
	{
		$this->db->where('slug', (string)$slug);
		$query = $this->db->get('category');
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
	 * 获取某个分类的所有子类
	 *
	 * @access public
	 * @param int $id
	 * @return bool
	 */
	public function get_childs_by_id($id)
	{
		$this->db->where('pid', intval($id));
		$query = $this->db->get('category');

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
	 * 添加一个分类
	 *
	 * @access public
	 * @param array $data
	 * @return array
	 */
	public function add_category($data)
	{
		$this->db->insert('category', $data);

		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}
	/**
     * 修改分类信息
     * 
     * @access public
     * @param int - $id 分类ID
	 * @param array - $data 分类信息
     * @return bool - success/fail
     */	
	public function update_category($id, $data)
	{
		$this->db->where('id', intval($id));
		$this->db->update('category', $data);

		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}
	/**
     * 删除一个分类
     * 
     * @access public
	 * @param  int - $id 分类id
     * @return bool - success/fail
     */
	public function delete_category($id)
	{
		$this->db->delete('category', array('id' => intval($id))); 
		
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}
}
