<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['Main']);
	}

	public function index(){
		$data['app_active'] = true;

		if(isset($this->session->userdata['logged_in']) && $this->session->userdata['logged_in']){

		$this->template->title('User List');
		$this->template->set_layout('default');
	    $this->template->set_partial('header','partials/header');
	    $this->template->set_partial('sidebar','partials/sidebar');
	    $this->template->set_partial('aside','partials/aside');
	    $this->template->set_partial('footer','partials/footer');
	    $this->template->append_metadata('<script src="' . base_url("assets/js/pages/users.js?ver=") . filemtime(FCPATH. "assets/js/pages/users.js") . '"></script>');

	    $this->template->build('user_list',$data);
	
		}
	    else
	    {
	      redirect (base_url().'404_override');
	    }		
	}


	public function registration()
	{

		$data['app_active'] = true;

		$this->template
			->title('Register User')
			->set_layout('reg_layout')
			->set_partial('footer','partials/footer')
			->append_metadata('<script src="' . base_url("assets/js/pages/registration.js?ver=") . filemtime(FCPATH. "assets/js/pages/registration.js") . '"></script>')
			->build('register', $data);
	}

	public function getAllProvince()
	{
		// $this->sac->getAllBarangay();
		$response['success'] = true;

		$provinces = ['select'=>'prov_code,prov_name','table'=>'provinces','type'=>'array'];

		$province = $this->Main->select($provinces);

		$response['province'] = $province;

		response_json($response);
	}

	public function getAllMunicipality()
	{
		$response['success'] = true;
		extract($_POST);

		$municipalities = ['select'=>'mun_code,mun_name','table'=>'municipalities','condition'=>['prov_code'=>$prov_code],'type'=>'array'];

		$municipality = $this->Main->select($municipalities);

		$response['municipality'] = $municipality;

		response_json($response);
	}



	
	public function register()
	{

		extract($_POST);
		$response['success'] = FALSE;
		$response['message'] = 'Something went wrong. Try Again later.';

		$random_number = 0;
		for ($i=0; $i < 78; $i++) {
			$random_number = $random_number + rand();
		}
		
		$rand = md5($random_number);
		$salt = mb_substr($rand, 0, 10);

		$p_word = hash("sha512",$password.$salt);

		$data = ['username'=>$username,
				 'password'=>$p_word,
				 'salt'=>$salt,
				 'first_name'=>$first_name,
				 'last_name'=>$last_name,
				 'middle_name'=>$middle_name,
				 'email'=>$email,
				 'contact_number'=>$contact_number,
				 'prov_code'=>$prov_code,
				 'mun_code'=>$mun_code,
				];

		$data_user = ['select'=>'*','table'=>'users','condition'=>['username'=>$username],'type'=>'count_row'];


		$user_exists = $this->Main->select($data_user);		

		if(empty($user_exists))
		{
			if($this->Main->insert('users',$data))
			{
				$response['success'] = TRUE;
				$response['message'] = "You have successfully Registered an Account.";
			}
		}
		else
		{
			$response['message'] = "Username Already in Use.";
		}


		response_json($response);

	}


	public function getAllUsers()
	{
		$data_user = ['select'=>'user_id,username,user_type,status,head as dept_head','table'=>'users','type'=>''];

		$data_user_type = ['select'=>'id,name','table'=>'user_type','type'=>''];

		$user_types = $this->Main->select($data_user_type);	

		$user_types_by_id = array_column($user_types, 'name','id');


		$all_users = $this->Main->select($data_user);	


		$users = array_map(function ($arr) use ($user_types_by_id) {
			// $stat = [1=>'Active',2=>'Inactive',3=>'Archived'];
		    $arr->ut = ucfirst($arr->user_type);
		    $arr->user_type = ucfirst($user_types_by_id[$arr->user_type]);
		    // $arr->status = $stat[$arr->status];
		    // $arr->dept_head = ($arr->dept_head == 1)?'Yes':'No';
		    return $arr;
		}, $all_users);



		$response['data'] = $users;

		response_json($response);

	}

	public function getAllUserRoles()
	{
		$data_user_type = ['select'=>'id,name','table'=>'user_type','type'=>''];

		$user_types = $this->Main->select($data_user_type);	

		$response['data'] = $user_types;

		response_json($response);

	}


	public function updateUser()
	{
		extract($this->input->post());

		$response['success'] = FALSE;
		
		$condition['user_id'] = $user_id; 
		$data['status'] = 1; 
		$data['user_type'] = $ut; 

		if($this->Main->update('users',$condition,$data,TRUE))
		{
			$response['success'] = TRUE;
			$response['message'] = "You Have Successfully Activated {$username}.";
		}
		else
		{
			$response['message'] = "Something went wrong.Try Again Later.";
		}

		response_json($response);

	}

	public function deleteUser()
	{
		extract($this->input->post());

		$response['success'] = FALSE;
		
		$condition['user_id'] = $user_id; 
		$data['status'] = 3; 

		if($this->Main->update('users',$condition,$data,TRUE))
		{
			$response['success'] = TRUE;
		}
		else
		{
			$response['message'] = "Something went wrong.Try Again Later.";
		}

		response_json($response);

	}

	public function profile()
	{
		$data = [];
		$this->template->title('User Profile');
		$this->template->set_layout('default');
	    $this->template->set_partial('header','partials/header');
	    $this->template->set_partial('sidebar','partials/sidebar');
	    $this->template->set_partial('aside','partials/aside');
	    $this->template->set_partial('footer','partials/footer');
	    $this->template->append_metadata('<script src="' . base_url("assets/js/pages/profile.js?ver=") . filemtime(FCPATH. "assets/js/pages/profile.js") . '"></script>');

	    $this->template->build('profile',$data);
	}

	public function getUserProfile()
	{
		$user_id = $this->session->userdata('user_id');	


		$response['success'] = true;
		$user = $this->Main->select([
            'select'    => '*',
            'type'      => 'row',
            'table'     => 'users',
            'condition' => ['user_id' => $user_id],
        ]);

		$response['user'] = $user;

		response_json($response);
	}

	public function updateProfile()
	{
		extract($this->input->post());
		
		$response['success'] = FALSE;
		$user_id = $this->session->userdata('user_id');	

		$update_data = [
				'username'       => $username,
				'first_name'     => $first_name,
				'last_name'      => $last_name,
				'middle_name'    => $middle_name,
				'email'          => $email,
				'contact_number' => $contact_number,
				'prov_code'      => $prov_code,
				'mun_code'       => $mun_code,
        ];

		if($password != ""){

			$random_number = 0;
			for ($i=0; $i < 78; $i++) {
				$random_number = $random_number + rand();
			}
			
			$rand = md5($random_number);
			$salt = mb_substr($rand, 0, 10);

			$p_word = hash("sha512",$password.$salt);


			$update_data['password'] = $p_word;
			$update_data['salt'] = $salt;

		}

        $response['success'] =  $this->Main->update('users', ['user_id' => $user_id], $update_data);
        $response['message'] =  "Successfully updated your profile.";


		response_json($response);
	}
}

/* End of file Dashboard.php */
/* Location: ./application/modules/admin/controllers/Dashboard.php */