<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
    $this->hrmisdb = '';
    $this->aicsdb = '';
    $this->portaldb = '';
  }

  public function insert($table, $data, $return = false, $db = "")
  {
    if ($db == "hrmisdb") {
      $db_used = $this->hrmisdb;
    } else if ($db == "aicsdb") {
      $db_used = $this->aicsdb;
    } else if ($db == "portaldb") {
      $db_used = $this->portaldb;
    } else {
      $db_used = $this->db;
    }

    if ($return) {
      $lastid = "";
      $result =  $db_used->insert($table, $data);
      if ($result) {
        $lastid =  $db_used->insert_id();
      }
      return array('success' => $result, 'lastid' => $lastid);
    }
    return $db_used->insert($table, $data);
  }


  public function insertbatch($table = "", $data = array())
  {
    return $this->db->insert_batch($table, $data);
  }

  public function count($table = "", $condition = array())
  {
    $this->db->select("count(*) as total");
    $this->db->from($table);
    if (!empty($condition)) {
      $this->db->where($condition);
    }
    return $this->db->get()->row()->total;
  }

  public function select($data, $like = array(), $db = "")
  {
    if ($db == "hrmisdb") {
      $db_used = $this->hrmisdb;
    } else if ($db == "aicsdb") {
      $db_used = $this->aicsdb;
    } else if ($db == "portaldb") {
      $db_used = $this->portaldb;
    } else {
      $db_used = $this->db;
    }

    $db_used->select($data['select']);
    $db_used->from($data['table']);

    if (!empty($data['condition_group'])) {
      $db_used->group_start();
      foreach ($data['condition_group'] as $key => $value) {

        if ($key != '') {
          if (is_array($value)) {
            $db_used->where_in($key, $value);
          } else {
            $db_used->where($key, $value);
          }
        } else {
          $db_used->or_where($value);
        }
      }
      $db_used->group_end();
    }


    if (!empty($data['condition'])) {
      foreach ($data['condition'] as $key => $value) {
        if (is_array($value)) {
          $db_used->where_in($key, $value);
        } else {
          $db_used->where($key, $value);
        }
      }
    }

    if (!empty($data['limit'])) {
      $offset = 0;
      if (!empty($data['offset'])) {
        $offset = $data['offset'];
      }
      $db_used->limit($data['limit'], $offset);
    }

    if (!empty($like)) {
      $db_used->like($like['column'], $like['data']);
    }

    if (!empty($data['group_by'])) {
      $db_used->group_by($data['group_by']);
    }
    if (!empty($data['order'])) {
      $db_used->order_by($data['order']['col'], $data['order']['order_by']);
    }

    $query = $db_used->get();

    if ($query->num_rows()) {

      if ($data['type'] == "row") {
        return $query->row();
      } elseif ($data['type'] == "count_row") {
        return $query->num_rows();
      } else {
        if (isset($data['array'])) {
          return $query->result_array();
        } else {
          return $query->result();
        }
      }
    }
    return array();
  }

  public function delete($table, $condition)
  {
    foreach ($condition as $key => $value) {
      if (!is_array($value)) {
        $this->db->where($key, $value);
      } else {
        $this->db->where_in($key, $value);
      }
    }


    return $this->db->delete($table);
  }

  public function update($table, $condition, $data, $db = "")
  {
    if ($db == "aicsdb") {
      $db_used = $this->aicsdb;
    } else {
      $db_used = $this->db;
    }

    $db_used->where($condition);
    $r = $db_used->update($table, $data);
    if ($r) {
      return  array('success' => true);
    }
  }

  public function updatebatch($table = "", $data, $id = "")
  {
    return $this->db->update_batch($table, $data, $id);
  }

  public function raw($query, $row = false, $type = "", $db = "")
  {

    if ($db != "hrmisdb") {
      $query = $this->db->query($query);
    } else {
      $query = $this->hrmisdb->query($query);
    }

    if ($type != "update") {
      if ($query->num_rows()) {

        if ($row) {
          return $query->row();
        } else if ($type == "row_array") {
          return $query->row_array();
        } else if ($type == "result_array") {
          return $query->result_array();
        } else {

          return $query->result();
        }
      }
      return null;
    }
  }

  public function emptyData($data = array())
  {
    if (!empty($data)) {
      foreach ($data as $value) {
        $this->db->from($value);
        $this->db->truncate();
      }
    }
  }
}

/* End of file Main.php */
/* Location: ./application/models/Main.php */
