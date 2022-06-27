<?php


if (!function_exists('response_json')) {
  function response_json($data = array())
  {
    $_CI = &get_instance();
    $_CI->output->set_content_type('application/json')->set_output(json_encode($data));
  }
}

function pdie($data = array(), $type = false)
{
  echo "<pre>";
  var_dump($data);
  echo "</pre>";
  if ($type) {
    die();
  }
}

function jsondata()
{
  return json_decode(trim(file_get_contents('php://input')), true);
}

function isPost()
{
  $_CI = &get_instance();
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $_CI = &get_instance();
    $_CI->load->library('user_agent');
    $_CI->load->model('Main');
    $data = $_CI->agent->browser();
    $data .= $_CI->agent->version();
    $data .= $_CI->agent->platform();
    $data .= $_SERVER['HTTP_USER_AGENT'];
    $ip = $_CI->input->ip_address();

    $logdata = array(
      "text" => $data,
      'ip' => $ip,
      'page' => uri_string(),
    );
    $_CI->Main->insert('securitylogs', $logdata);
    exit('No direct script access allowed!');
  }
}

function getLocation($condition = "", $type = "")
{
  $_CI = &get_instance();
  $query = "SELECT
	b.bar_name AS bar_name,
	b.bar_code AS bar_code,	
	m.mun_name AS mun_name,
	m.mun_code AS mun_code,
	p.prov_name AS prov_name,
	p.prov_code AS prov_code
	FROM barangays AS b 		
	LEFT JOIN municipalities AS m 
	ON b.`mun_code`=m.`mun_code` 
	LEFT JOIN provinces AS p
	ON p.`prov_code` = m.`prov_code` WHERE $condition";
  return  $_CI->Main->raw($query, $condition, $type);
}

function getProvinces($select = "*", $condition = array(), $type = false, $offset = array())
{
  $_CI = &get_instance();
  // $offset = checkOffset($offset);
  $provinces_query  = array(
    'select'           => $select,
    'table'            => 'provinces',
    'condition'        => $condition,
    'type'             => $type,
    // 'limit' =>   $offset['limit'],
    // 'offset' =>  $offset['offset'],
  );
  return  $_CI->Main->select($provinces_query);
}


function getMunicipalities($select = "*", $condition = array(), $type = false, $offset = array())
{
  $_CI = &get_instance();
  $offset = checkOffset($offset);
  $municipalities_query  = array(
    'select'           => $select,
    'table'            => 'municipalities',
    'condition'        => $condition,
    'type'             => $type,
    'limit' =>   $offset['limit'],
    'offset' =>  $offset['offset'],
  );
  return  $_CI->Main->select($municipalities_query);
}

function getBarangays($select = "*", $condition = array(), $type = false, $offset = array())
{
  $_CI = &get_instance();
  $offset = checkOffset($offset);
  $municipalities_query  = array(
    'select'           => $select,
    'table'            => 'barangays',
    'condition'        => $condition,
    'type'             => $type,
    'limit' =>   $offset['limit'],
    'offset' =>  $offset['offset'],
    'order' => array(
      'col' => 'bar_name',
      'order_by' => "ASC",
    ),
  );
  return  $_CI->Main->select($municipalities_query);
}

function getUserlogin($column = "")
{
  if (!empty($column)) {
    $data = array(
      'fullname' => 'joji Pacio',
    );
    return $data[$column];
  }
  return $data;
}


function isAjax()
{
  $_CI = &get_instance();

  if (!$_CI->input->is_ajax_request()) {
    show_404();
  }
}

function sesdata($index = "", $rtype = "")
{
  $_CI = &get_instance();
  if (!empty($index)) {
    return $_CI->session->userdata($index);
  }
  if ($rtype == "jsontype") {
    return  json_encode($_CI->session->userdata());
  } else {
    return $_CI->session->userdata();
  }
}

function login_authentication($page = "")
{
  $_CI = &get_instance();


  if (!isset($_CI->session->userdata['logged_in']) || (isset($_CI->session->userdata['logged_in']) && !$_CI->session->userdata['logged_in'])) {
    redirect(base_url() . '404_override');
    show_404();
  }
}

function getFullDateFormat($dateObj)
{

  $monthNames = [
    "January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
  ];

  $date = explode("-", $dateObj);

  if (!empty($dateObj)) {
    return $monthNames[$date[1] - 1] . " " . $date[2] . ", " . $date[0];
  } else {
    return "";
  }
}

function getFullDateTimeFormat($dateObj)
{

  $monthNames = [
    "January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
  ];

  $date = explode("-", $dateObj);
  $time = explode(" ", $date[2]);
  $timem = date("h:i A", strtotime($time[1]));

  if (!empty($dateObj)) {
    return $monthNames[$date[1] - 1] . " " . $time[0] . ", " . $date[0] . " " . $timem;
  } else {
    return "";
  }
}

function getFullDateFormatNoTime($dateObj)
{

  $monthNames = [
    "January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
  ];

  $date = explode("-", $dateObj);
  $time = explode(" ", $date[2]);
  $timem = date("h:i A", strtotime($time[1]));

  if (!empty($dateObj)) {
    return $monthNames[$date[1] - 1] . " " . $time[0] . ", " . $date[0];
  } else {
    return "";
  }
}

function in_array_r($needle, $haystack, $strict = false)
{
  foreach ($haystack as $item) {
    if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
      return true;
    }
  }

  return false;
}


function restrict_user()
{
  $_CI = &get_instance();

  $user = $_CI->session->userdata();

  $response = [];

  if (!in_array($user['status'], [0, 1])) {
    $response['success'] = FALSE;
    $response['error_arr'] = "";
    $response['message'] = "ADDING/UPDATING/DELETING/TAGGING has been disabled in the system for the Final generation of the CERTIFICATION.";
  }

  return $response;
}


function inLog($text = 0, $type = "", $rowid = 0)
{
  if (!empty($text) && !empty($type)) {
    $_CI = &get_instance();
    $data = [
      'text'   => $text,
      'uid' => sesdata('user_id'),
      'date' => date('Y-m-d H:i:s'),
      'type' => $type,
      'rowid' => $rowid,
    ];
    return $_CI->Main->insert('lib_logs', $data);
  }
}


function m_array($arr = [], $col = '')
{
  $new_arr = [];

  if (!empty($arr)) {
    foreach ($arr as $key => $value) {
      $new_arr[$value[$col]][] = $value;
    }
  }

  return $new_arr;
}

function insertLogs($action = "", $module = "", $data = [])
{
  $_CI = &get_instance();
  $data['old_data'] = json_encode($data['old_data']);
  $data['new_data'] = json_encode($data['new_data']);
  $data['uid'] = $_SESSION['user_id'];
  $data['username'] = $_SESSION['name'];
  $data['action'] =  $action;
  $data['module'] =  $module;
  $data['date'] =  date('Y-m-d H:i:s');
  return $_CI->Main->insert('logs', $data);
}

function checkLowestOdsuAssignmentbyEmpID($emp_id)
{

  $_CI = &get_instance();

  $plaDetails = $_CI->Main->raw("SELECT lp.* FROM lib_plantilla lp LEFT JOIN employee e ON lp.pla_id=e.pla_id WHERE emp_id = '$emp_id'", true, "", "hrmisdb");

  $returnDetails = ['odsu_type' => 0, 'odsu_id' => 0];

  if (!empty($plaDetails)) {
    if ($plaDetails->office_id != 0) {
      $returnDetails['odsu_type'] = 1;
      $returnDetails['odsu_id'] = $plaDetails->office_id;
    }

    if ($plaDetails->div_id != 0) {
      $returnDetails['odsu_type'] = 2;
      $returnDetails['odsu_id'] = $plaDetails->div_id;
    }

    if ($plaDetails->sec_id != 0) {
      $returnDetails['odsu_type'] = 3;
      $returnDetails['odsu_id'] = $plaDetails->sec_id;
    }

    if ($plaDetails->unit_id != 0) {
      $returnDetails['odsu_type'] = 4;
      $returnDetails['odsu_id'] = $plaDetails->unit_id;
    }

    if ($plaDetails->area_assignment_id != 0) {
      $returnDetails['odsu_type'] = 5;
      $returnDetails['odsu_id'] = $plaDetails->area_assignment_id;
    }
  }

  return $returnDetails;
}

function arCol($array = [], $colId = "")
{
  $_CI = &get_instance();
  $data = [];
  if (!empty($array)) {
    foreach ($array as $ark => $arv) {
      $data[$arv[$colId]][] = $arv;
    }
  }
  return $data;
}

// function check_targets_encoded()
// {
// 	$_CI = &get_instance();

// 	$mun_code = $_CI->session->userdata['mun_code'];

// 	return $_CI->sac->checkTargets($mun_code);
// }
