<?php

class Login extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('', '');
    $this->load->model('Main');
    $this->load->model('Login_model');
    $this->load->library('bcrypt');

  }

  public function index()
  {
    $this->load->view('welcome_message');
  }
  

  public function login_process()
	{

		extract($this->input->post());
		
		 $user_details = $this->Login_model->check_username($username);

     $response['success'] = FALSE;

        if(!empty($user_details))
        {
          $p_word = md5($password.$user_details['salt']);
          
          if($p_word === $user_details['password'])
          {

              $user_data = ["user_id"=>$user_details['uid'],
                            "access"=>$user_details['access'],
                            "logged_in"=>TRUE];

              $this->session->set_userdata($user_data);
                      $response['success'] = TRUE;
          }

        }
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

  public function logout()
  {
    session_destroy();
    redirect(base_url() . 'login');
  }
}
