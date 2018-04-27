<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

        public $status;
        public $roles;

        function __construct(){
            parent::__construct();
            $this->load->model('User_model', 'user_model', TRUE);
            $this->load->model('User_model') ;
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            $this->status = $this->config->item('status');
            $this->roles = $this->config->item('roles');
        }
      	public function index()
      	{
                  if(empty($this->session->userdata['email'])){
                      redirect(site_url().'/user/login/');
                  }
                  /*front page*/
                  $data = $this->session->userdata;
                  $data['page'] = 'users/index' ;
                  $this->load->view('menu/content',$data);

      	}
        public function register()
        {

            $this->form_validation->set_rules('firstname', 'First Name', 'required');
            $this->form_validation->set_rules('lastname', 'Last Name', 'required');
            $this->form_validation->set_rules('birthdate', 'Date of Birth');
            $this->form_validation->set_rules('phone', 'Phone number', 'required');
            $this->form_validation->set_rules('country', 'Country', 'required');
            $this->form_validation->set_rules('city', 'City', 'required');
            $this->form_validation->set_rules('street', 'Street', 'required');
            $this->form_validation->set_rules('postalcode', 'Postal Code', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

            if ($this->form_validation->run() == FALSE) {
                $data['page'] = 'users/register' ;
                $this->load->view('menu/content',$data);
            }else{
                if($this->user_model->isDuplicate($this->input->post('email'))){
                    $this->session->set_flashdata('flash_message', 'User email already exists');
                    redirect(site_url().'/user/login');
                }else{

                    $clean = $this->security->xss_clean($this->input->post(NULL, TRUE));
                    $id = $this->user_model->insertUser($clean);
                    $token = $this->user_model->insertToken($id);

                    $qstring = $this->base64url_encode($token);
                    $url = site_url() . '/user/complete/token/' . $qstring;
                    $link = '<a href="' . $url . '">' . $url . '</a>';

                    $message = '';
                    $message .= '<strong>You have signed up with our website</strong><br>';
                    $message .= '<strong>Please click:</strong> ' . $link;

                    echo $message; //send this in email
                    exit;


                };
            }
        }


        protected function _islocal(){
            return strpos($_SERVER['HTTP_HOST'], 'local');
        }

        public function complete()
        {
            $token = base64_decode($this->uri->segment(4));
            $cleanToken = $this->security->xss_clean($token);

            $user_info = $this->user_model->isTokenValid($cleanToken); //either false or array();

            if(!$user_info){
                $this->session->set_flashdata('flash_message', 'Token is invalid or expired');
                redirect(site_url().'/user/login');
            }
            $data = array(
                'firstName'=> $user_info->firstname,
                'email'=>$user_info->email,
                'user_id'=>$user_info->id,
                'token'=>$this->base64url_encode($token)
            );

            $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
            $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');

            if ($this->form_validation->run() == FALSE) {
                $data['page'] = 'users/complete' ;
                $this->load->view('menu/content',$data);
            }else{

                $this->load->library('password');
                $post = $this->input->post(NULL, TRUE);

                $cleanPost = $this->security->xss_clean($post);

                $hashed = $this->password->create_hash($cleanPost['password']);
                $cleanPost['password'] = $hashed;
                unset($cleanPost['passconf']);
                $userInfo = $this->user_model->updateUserInfo($cleanPost);

                if(!$userInfo){
                    $this->session->set_flashdata('flash_message', 'There was a problem updating your record');
                    redirect(site_url().'/user/login');
                }

                unset($userInfo->password);

                foreach($userInfo as $key=>$val){
                    $this->session->set_userdata($key, $val);
                }
                redirect(site_url().'/user/');

            }
        }

        public function login()
        {
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if($this->form_validation->run() == FALSE) {
                $data['page'] = 'users/login' ;
                $this->load->view('menu/content',$data);
            }else{

                $post = $this->input->post();
                $clean = $this->security->xss_clean($post);

                $userInfo = $this->user_model->checkLogin($clean);

                if(!$userInfo){
                    $this->session->set_flashdata('flash_message', 'Invalid email address or password');
                    redirect(site_url().'/user/login');
                }
                foreach($userInfo as $key=>$val){
                    $this->session->set_userdata($key, $val);
                }
                redirect(site_url().'/user/');
            }

        }

        public function logout()
        {
          $this->session->unset_userdata('user_info');
          $this->session->sess_destroy();
            redirect(site_url().'/user/login/');
        }

        public function forgot()
        {

            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

            if($this->form_validation->run() == FALSE) {
                $data['page'] = 'users/forgot' ;
                $this->load->view('menu/content',$data);
            }else{
                $email = $this->input->post('email');
                $clean = $this->security->xss_clean($email);
                $userInfo = $this->user_model->getUserInfoByEmail($clean);

                if(!$userInfo){
                    $this->session->set_flashdata('flash_message', 'We cant find your email address');
                    redirect(site_url().'/user/login');
                }

                if($userInfo->status != $this->status[1]){ //if status is not approved
                    $this->session->set_flashdata('flash_message', 'Your account is not in approved status');
                    redirect(site_url().'/user/login');
                }

                //build token

                $token = $this->user_model->insertToken($userInfo->id);
                $qstring = $this->base64url_encode($token);
                $url = site_url() . '/user/reset_password/token/' . $qstring;
                $link = '<a href="' . $url . '">' . $url . '</a>';

                $message = '';
                $message .= '<strong>A password reset has been requested for this email account</strong><br>';
                $message .= '<strong>Please click:</strong> ' . $link;

                echo $message; //send this through mail
                exit;

            }

        }

        public function reset_password()
        {
            $token = $this->base64url_decode($this->uri->segment(4));
            $cleanToken = $this->security->xss_clean($token);

            $user_info = $this->user_model->isTokenValid($cleanToken); //either false or array();

            if(!$user_info){
                $this->session->set_flashdata('flash_message', 'Token is invalid or expired');
                redirect(site_url().'/user/login');
            }
            $data = array(
                'firstName'=> $user_info->firstName,
                'email'=>$user_info->email,
//                'user_id'=>$user_info->id,
                'token'=>$this->base64url_encode($token)
            );

            $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
            $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');

            if ($this->form_validation->run() == FALSE) {
                $data['page'] ='users/reset_password' ;
                $this->load->view('menu/content', $data);
            }else{

                $this->load->library('password');
                $post = $this->input->post(NULL, TRUE);
                $cleanPost = $this->security->xss_clean($post);
                $hashed = $this->password->create_hash($cleanPost['password']);
                $cleanPost['password'] = $hashed;
                $cleanPost['user_id'] = $user_info->id;
                unset($cleanPost['passconf']);
                if(!$this->user_model->updatePassword($cleanPost)){
                    $this->session->set_flashdata('flash_message', 'There was a problem updating your password');
                }else{
                    $this->session->set_flashdata('flash_message', 'Your password has been updated. You may now login');
                }
                redirect(site_url().'/user/login');
            }
        }
        public function user_profile() {
          $data['user_array'] = $this->User_model->get_user() ;
          $data['page'] = 'users/user_profile' ;
          $this->load->view('menu/content',$data);
        }
        public function edit_user()
        {
          $config['file_name'] = $_FILES['profile_picture']['name'] ;
      	  $config['upload_path'] ='./profile_gallery/' ;
      	  $config['allowed_types'] = 'jpg|jpeg|png|gif' ;
          $config['max_size']   = 1000000;
          $config['max_width']  = 10240;
          $config['max_height'] = 7680;
      	  //Load upliad library and initialize configuration
      	  $this->load->library('upload',$config) ;
      	  $this->upload->initialize($config) ;
      	  $this->upload->do_upload('profile_picture') ;
      	  $data_upload_file = $this->upload-> data() ;
      	  $profileImg = $data_upload_file['file_name'] ;
      	  $id = $this->input->post('id') ;
          $user_update=[] ;
      	  if(!empty($profileImg))
      	  {
            $user_update = array(
      	      'firstname' => $this->input->post('firstname') ,
      	      'lastname' => $this->input->post('lastname') ,
      	      'birthdate' => $this->input->post('birthdate') ,
              'phone' => $this->input->post('phone'),
      	      'country' => $this->input->post('country') ,
              'city' => $this->input->post('city') ,
              'street' => $this->input->post('street') ,
      	      'postalcode' => $this->input->post('postalcode'),
              'profile_picture' => $profileImg
      	    ) ;
      	  }
      	  else {
      	    $user_update = array(
      	      'firstname' => $this->input->post('firstname') ,
      	      'lastname' => $this->input->post('lastname') ,
      	      'birthdate' => $this->input->post('birthdate') ,
              'phone' => $this->input->post('phone'),
      	      'country' => $this->input->post('country') ,
              'city' => $this->input->post('city') ,
              'street' => $this->input->post('street') ,
      	      'postalcode' => $this->input->post('postalcode')
      	    ) ;
      	  }
      	  $success = $this->User_model->update_user($id,$user_update) ;
          $data['message'] = 'You information has been updated' ;
          $data['page'] = 'users/update_user' ;
          $this->load->view('menu/content',$data) ;
          }

          public function base64url_encode($data) {
            return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
          }

          public function base64url_decode($data) {
            return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
          }

}
