<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{


  public function __construct()
  {
    parent::__construct();
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('', '');
    $this->load->model('Main');
    $this->load->model('Users_model', 'u_model');
    login_authentication();
  }

  public function index()
  {
    $access = $this->session->userdata('access');
    if($access == 1){
      $this->template->title('Users');
      $this->template->set_layout('default');
      $this->template->set_partial('header', 'partials/header');
      $this->template->set_partial('sidebar', 'partials/sidebar');
      $this->template->set_partial('aside', 'partials/aside');
      $this->template->set_partial('footer', 'partials/footer');
      $this->template->append_metadata('<script src="' . base_url("assets/js/pages/libraries/users.js?ver=") . filemtime(FCPATH . "assets/js/pages/libraries/users.js") . '"></script>');
  
      $this->template->build('libraries/users_view');

    }else{
      show_404();
    }
  }

  public function save()
  {
    extract($_POST);
    $user_id = $this->session->userdata('user_id');
    $success = false;

    $salt = $this->generateRandomString();

    $insdata = [
      "username" => $username,
      "password" => md5($password.$salt),
      "salt" => $salt
    ];

    $success =  $this->Main->insert('user', $insdata);

    $response = array(
      'success' => $success,
      'message' => "Successfully Added User",
    );

    response_json($response);

  }

  public function getAllUsers()
  {
    $user_id = $this->session->userdata('uid');

    extract($_GET);

    if ($page == 1) {
      $offset = 0;
    } else {
      $offset = ($page - 1) * $limit;
    }

    //Search
    $condition = ['removed' => 0];

    //Search
    $all_users = $this->u_model->getAllUsers("u.*", $condition, [], $offset, [], $limit);
    $all_users_count = $this->u_model->getAllUsers("u.*", $condition, [], 0, [], 0, TRUE);

    $data = array(
      'count' => $all_users_count,
      'data'  => $all_users,
    );

    response_json($data);
  }

  public function update_user()
  {
    extract($_POST);
    $success = false;

    $salt = $this->generateRandomString();

    $update_data = [
      "username" => $username,
      "password" => md5($password.$salt),
      "salt" => $salt
    ];

    $success =  $this->Main->update('user', ['uid' => $uid], $update_data);

    $response = array(
      'success' => $success,
      'message' => "Successfully Updated User",
    );

    response_json($response);
  }

  public function delete_user()
  {
    extract($_POST);
    $success = false;
    $update_data = ['removed' => 1];

    $success =  $this->Main->update('user', ['uid' => $uid], $update_data);

    $response = array(
      'success' => $success,
      'message' => "Successfully Removed User",
    );
    response_json($response);
  }

  function generateRandomString($length = 10) {
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      return $randomString;
  }
}

/* End of file Dashboard.php */
/* Location: ./application/modules/admin/controllers/Dashboard.php */
