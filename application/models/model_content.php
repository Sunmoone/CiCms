<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_content extends CI_Model {

	/**
	 * 获取文章列表
	 *
	 * @access public
	 * @return array
	 */
	public function get_contents($limit=NULL, $offset=NULL, $in = array())
	{
		$this->db->select('content.*, category.name as cat_name');
		$this->db->join('category', 'content.category_id = category.id', 'left');
		if ($limit)
		{
			$this->db->limit($limit);
		}
		if ($offset)
		{
			$this->db->offset($offset);
		}
		if ($in)
		{
			$this->db->where_in('category_id', $in);
		}
		$this->db->order_by('id', 'desc');

		$query = $this->db->get('content');

		if ($query->num_rows > 0)
		{
			return array(
				'data' => $query->result_array(),
				'num_rows' => $this->db->count_all_results('content')

			);
		}
		else
		{
			return false;
		}
	}
	/**
	 * 获取单个文章
	 *
	 * @access public
	 * @param int $id
	 * @return array 
	 */
	public function get_content_by_id($id)
	{
		$this->db->where('id', intval($id));
		$query = $this->db->get('content');

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
	 * 添加一篇文章
	 *
	 * @access public
	 * @param array $data
	 * @return array
	 */
	public function add_content($data)
	{
		$this->db->insert('content', $data);

		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}
	/**
     * 修改一篇文章
     * 
     * @access public
     * @param int - $id 文章ID
	 * @param array - $data 
     * @return bool - success/fail
     */	
	public function update_content($id, $data)
	{
		$this->db->where('id', intval($id));
		$this->db->update('content', $data);

		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}
	/**
     * 删除一篇文章
     * 
     * @access public
	 * @param  int - $id 文章id
     * @return bool - success/fail
     */
	public function delete_content($id)
	{
		$this->db->delete('content', array('id' => intval($id))); 
		
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}
}