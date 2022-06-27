<?php

Class Call_logs_model extends CI_Model {

	public function getAllClients($select = "*", $condition = array(), $like = array(), $offset = 0, $order = array(), $limit = 10,$count =false, $like_or = array())
	{
		$user_id = $this->session->userdata('uid');

		$this->db->select($select);
		$this->db->from("jewelry u");
        $this->db->join("user us","u.added_by=us.uid","left");

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

	 	// if (!empty($like)) {
        //     if (is_array($like['column'])) {
        //         foreach ($like['column'] as $lk => $lv) {
        //             $this->db->or_like($lv, $like['data']);
        //         }
        //     } else {
        //         $this->db->like($like['column'], $like['data']);
        //     }
        // }
		if (!empty($like)) {
			if (is_array($like)) {
				foreach ($like as $lk => $lv) {
					$this->db->like($lk, $lv);
				}
			}
		}
		if (!empty($like_or)) {
			$this->db->group_start();
			if (is_array($like_or)) {
				foreach ($like_or as $lk => $lv) {
					$this->db->or_like($lk, $lv);
				}
			}
			$this->db->group_end();
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
