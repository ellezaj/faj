<?php

Class Users_model extends CI_Model {

	public function getAllUsers($select = "*", $condition = array(), $like = array(), $offset = 0, $order = array(), $limit = 10,$count =false)
	{
		$user_id = $this->session->userdata('uid');

		$this->db->select($select);
		$this->db->from("user u");

		if (!empty($condition)) {
			foreach ($condition as $key => $value) {
				if(is_array($value))
				{
					$this->db->where_in($key,$value);
				}
				else
				{
					$this->db->where($key,$value);
				}
			}
		}

		if (!empty($limit)) {
            if (!empty($offset)) {
              $offset = $offset;
            }
            $this->db->limit($limit, $offset);
          }

	 	if (!empty($like)) {
            if (is_array($like['column'])) {
                foreach ($like['column'] as $lk => $lv) {
                    $this->db->or_like($lv, $like['data']);
                }
            } else {
                $this->db->like($like['column'], $like['data']);
            }
        }

        if (!empty($order)) {
            $this->db->order_by($order['col'], $order['order_by']);
        }


		$query = $this->db->get();

        if ($count) {
        	return $query->num_rows();
        }

		return ($query->num_rows() > 0)? $query->result_array():[];
	}


}

?>
