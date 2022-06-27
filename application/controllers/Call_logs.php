<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Call_logs extends CI_Controller
{


  public function __construct()
  {
    parent::__construct();
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('', '');
    $this->load->model('Main');
    $this->load->model('Call_logs_model', 'cl_model');

    login_authentication();
  }

  public function getAllUsers()
  {
    $users = $this->Main->select([
      'select'    => '*',
      'table'     => 'user',
      'type'      => '',
      'array'     => '',
      'condition' => ['removed' => 0, 'status' => 0],
    ]);

    $user_list = array_column($users, 'username', 'uid');
    response_json(['data' => $user_list]);

  }

  public function getAllClients()
  {
    $user_id = $this->session->userdata('uid');

    extract($_GET);

    if ($page == 1) {
      $offset = 0;
    } else {
      $offset = ($page - 1) * $limit;
    }

    //Search
    $search = json_decode($this->input->get('search'), true);
    $condition = [];
    $like = [];
    $like_or = [];
    $condition['deleted'] = 0;

    if (!empty($search['company_name'])) {
      $like['company_name'] = $search['company_name'];
    }
    if (!empty($search['web_address'])) {
      $like['web_address'] = $search['web_address'];
    }
    if (!empty($search['email_address'])) {
      $like['email_address'] = $search['email_address'];
    }
    if (!empty($search['persons_name'])) {
      $like_or['last_name'] = $search['persons_name'];
      $like_or['first_name'] = $search['persons_name'];
    }
    if (!empty($search['sole_trader'])) {
      $like['sole_trader'] = $search['sole_trader'];
    }
    if (!empty($search['address'])) {
      $like['address'] = $search['address'];
    }
    if (!empty($search['land_line'])) {
      $like['land_line'] = $search['land_line'];
    }
    if (!empty($search['mobile'])) {
      $like['mobile'] = $search['mobile'];
    }
    if (!empty($search['field_of_work'])) {
      $like['field_of_work'] = $search['field_of_work'];
    }
    if (!empty($search['added_by'])) {
      $condition['added_by'] = $search['added_by'];
    }
    if (!empty($search['date_added'])) {
      $like['date_added'] = $search['date_added'];
    }
    //Search

    $all_clients = $this->cl_model->getAllClients("u.*,us.username", $condition, $like, $offset, ['col'=>'id','order_by'=>'DESC'], $limit,false,$like_or);
    $all_clients_count = $this->cl_model->getAllClients("u.*,us.username", $condition, $like, 0, [], 0, TRUE,$like_or);

    $data = array(
      'count' => $all_clients_count,
      'data'  => $all_clients,
    );

    response_json($data);
  }

  public function index()
  {

    $this->template->title('Call Logs');
    $this->template->set_layout('default');
    $this->template->set_partial('header', 'partials/header');
    $this->template->set_partial('sidebar', 'partials/sidebar');
    $this->template->set_partial('aside', 'partials/aside');
    $this->template->set_partial('footer', 'partials/footer');
    $this->template->append_metadata('<script src="' . base_url("assets/js/pages/call_logs.js?ver=") . filemtime(FCPATH . "assets/js/pages/call_logs.js") . '"></script>');

    $this->template->build('call_logs_view');
  }

  public function save()
  {
    extract($_POST);
    $user_id = $this->session->userdata('user_id');
    $success = false;

    $msg = '';
    $condition_contact = '';

    //validation
    //validation

    if($msg == ""){
        date_default_timezone_set("Asia/Hong_Kong");
        $date = date("Y-m-d H:i:s");
    
        $insdata = [
          "country"  => $country,
          "city"   => $city,
          "web_address"  => $web_address,
          "email_address"  => $email_address,
          "address"  => $address,
          "phone_number"   => $phone_number,
          "shop_stall"   => $shop_stall,
          "watches"  => $watches,
          "jewelry"  => $jewelry,
          "jewelry_services"   => $jewelry_services,
          "watch_repairs"  => $watch_repairs,
          "polishing"  => $polishing,
          "casting"  => $casting,
          "plating"  => $plating,
          "watch_making"   => $watch_making,
          "wholesale"  => $wholesale,
          "retail"   => $retail,
          "auction"  => $auction,
          "notes"  => $notes,
          'date_added'    => $date,
          'added_by'      => $user_id,
        ];

        $sales_id =  $this->Main->insert('jewelry', $insdata, true)['lastid'];
        $success = true;
        $msg = "Successfully Added Client";
    }

    $response = array(
      'success' => $success,
      'message' => $msg,
    );

    response_json($response);
  }

  public function update_client()
  {
    extract($_POST);
    $success = false;
    $msg = '';
    $condition_contact = '';
    date_default_timezone_set("Asia/Hong_Kong");
    $date = date("Y-m-d H:i:s");

    //validation
    //validation
    if($msg == ""){
      $update_data = [
        "country"  => $country,
        "city"   => $city,
        "web_address"  => $web_address,
        "email_address"  => $email_address,
        "address"  => $address,
        "phone_number"   => $phone_number,
        "shop_stall"   => $shop_stall,
        "watches"  => $watches,
        "jewelry"  => $jewelry,
        "jewelry_services"   => $jewelry_services,
        "watch_repairs"  => $watch_repairs,
        "polishing"  => $polishing,
        "casting"  => $casting,
        "plating"  => $plating,
        "watch_making"   => $watch_making,
        "wholesale"  => $wholesale,
        "retail"   => $retail,
        "auction"  => $auction,
        "notes"  => $notes,
      ];

      $success =  $this->Main->update('jewelry', ['id' => $id], $update_data);
      $success = true;
      $msg = "Successfully Updated Client";
    }
    $response = array(
      'success' => $success,
      'message' => $msg,
    );

    response_json($response);
  }

  public function delete_client()
  {
    extract($_POST);
    $success = false;
    $update_data = ['deleted' => 1];

    $success =  $this->Main->update('jewelry', ['id' => $id], $update_data);

    $response = array(
      'success' => $success,
      'message' => "Successfully Removed Client",
    );
    response_json($response);
  }
 
}

