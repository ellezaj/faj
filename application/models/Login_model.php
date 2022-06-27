<?php

Class Login_model extends CI_Model {

    public function check_username($username = "")
    {
      $username = strtolower($username);
      $this->db->select("*");
      $this->db->from("user");
      $this->db->where("username",$username);

      $query = $this->db->get();

      return ($query->num_rows() > 0)?$query->row_array():[];
    }

}

?>
