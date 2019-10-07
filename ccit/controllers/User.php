<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('string');
        $this->load->model('AutModel');
    }
	public function mailSend()
	{
		 $this->load->model('MailModel');
		
		                     if (is_bool($this->MailModel->SendMail('pvenkateshnaidu@gmail.com','saa','ds'))) {
								 echo "send";
							 }else
							 {
								 echo "fail";
							 }
	}
	

    public function index() {
        
    }
    public function apply()
    {
          $randPass = $this->randomString(8, '');
        $array=array(
          "username" => $this->input->post('name'),  
          "mobile_no" => $this->input->post('phonenumber'),  
          "location" => $this->input->post('location'),  
          "availability" => $this->input->post('availability'),  
          "email" => $this->input->post('email'),  
          "password" => $randPass
            
        );
          if($this->BaseModel->inserData('users', $array))
            {
            //  $userPass = $this->BaseModel->featchSingleField('users', 'id', 'email:' . $this->input->post('email'));
               $sessionArray = array(                                   
                    'userWebStatus' => TRUE,
                    'userName' => ucwords($this->input->post('name')),
                    'email' =>$this->input->post('email'),
                    'mobile' => $this->input->post('phonenumber')
                );
                $this->session->set_userdata($sessionArray);
                
            $msg = 'success';
            }else
            {
                 $msg = 'Register Fail';
            }
        
        echo $msg;
        die();
    }
            
    public function signIn() {
    if ($this->form_validation->run('signIn') == FALSE) {
        $updateresult = '';
        $html = $this->load->view('user/signin', $updateresult, TRUE);
        $this->adminTemplet('user', $html);
    }else
    {
        
        $this->checkSignin($this->input->post());
    }
//         }else
//         {
//         $updateresult = $msg =$error= '';
//         $email=$this->input->post('email');
//         $param=array('email' =>$email);
//         $result=$this->BaseModel->featchCountOfRows("users",$param);
//         if(!empty($result))
//         {
//             $fetchResult=$this->BaseModel->featchRow("users",'username,password',$param);
//               $cryptKey  = $fetchResult->password;              
//           
//               $this->load->model('MailModel');
//                $this->MailModel->sendForgetPassword($emailParam);
//               
//               
//         } else {
//          $error="Sorry Email Not Exist";
//         }
//         
    }

    function ForgetPassword() {

        if ($this->form_validation->run('forgetpassword') == FALSE) {
            echo validation_errors();
            $html = $this->load->view('user/forget-password', '', TRUE);
            $this->adminTemplet('user', $html);
        } else {
            $error = $msg = '';
            $userPass = $this->BaseModel->featchSingleField('users', 'password', 'email:' . $this->input->post('email'));
            if (!empty($userPass)) {
                $randPass = $this->randomString(10, '');
                error_reporting(~E_NOTICE);
                $param = array('password' => crypt($randPass));
                if ($this->BaseModel->updateData('users', $param, 'email:' . $this->input->post('email'))) {
                    $param = array(
                        'pass' => $randPass,
                        'to' => $this->input->post('email')
                    );
                    $this->load->model('MailModel');

                    if (is_bool($this->MailModel->forgotPassword($param))) {
                        $msg = 'Password Successfully changed.';
                    } else {
                        $error = 'Error Occured in Mail sending. Please try Again.';
                    }
                } else {
                    $error = 'Error occured. Please try again.';
                }
            } else {
                $error = 'You are not registed with us..!';
            }
            $html = $this->load->view('user/signin', '', TRUE);
            $this->adminTemplet('user', $html, '', $error, $msg);
        }
    }

    public function signUp() {
        $updateresult = '';
        $error = '';
        $msg = '';

        if ($this->form_validation->run('registerUser') == true) {
            $param=$_POST;
            if($this->BaseModel->inserData('users', $param))
            {
            $msg = 'Register Success';
            }else
            {
                 $error = 'Register Fail';
            }
            $html = $this->load->view('pages/login', $updateresult, TRUE);
            $this->adminTemplet('user', $html, '', $error, $msg);
        } else {
            $error = '';
            $html = $this->load->view('pages/login', $updateresult, TRUE);
            $this->adminTemplet('user', $html, '', $error, $msg);
        }
    }

    public function signOut() {
        if ((($this->session->userdata('userWebStatus'))) && ($this->session->userdata('userWebStatus') !== FALSE)) {
        
            //$this->BaseModel->updateData('admin_log', $param, 'adminId:' . $this->session->userdata('aId') . ',sessionId:' . session_id());
            $this->session->sess_destroy();
            unset($_SESSION);
            redirect('/Home/');
        }
    }

    public function registerUser() {

        $updateresult = $error = $msg = '';
        if ($this->form_validation->run('registerUser') == true) {
            error_reporting(~E_NOTICE);
            $randomId = random_string('alnum', 3);
            $id = $this->BaseModel->featchCountOfRows('users', '');
            if (empty($id)) {
                $id = 1;
            } else {
                $id = $id + 1;
            }
            $castecode = $this->BaseModel->featchRow('castes', 'code', 'id:' . $this->input->post('caste'));
            if ($this->input->post('gender') == 'male') {
                $gender = 'M';
            } else {
                $gender = 'F';
            }
            $sid = 11000 + $id;
            $uniqueId = strtoupper($castecode->code) . $gender . $sid . '/' . date('y', strtotime($this->input->post('dateofbirth')));

            $emailParam['requests'] = array(
                'username' => $this->input->post('email'),
                'password' => $this->input->post('password')
            );
            $param = array(
                'unique_id' => $uniqueId,
                'username' => $this->input->post('first_name'),
                'email' => $this->input->post('email'),
                'mobile' => $this->input->post('mobile'),
                'password' => crypt($this->input->post('password')),
                'createdFor' => $this->input->post('createdFor'),
                'gender' => $this->input->post('gender'),
            );
            $param2 = array(
                'caste' => $this->input->post('caste'),
                'dateofbirth' => $this->input->post('dateofbirth'),
                'merital_status' => $this->input->post('merital_status'),
            );
            $this->load->model('UserModel');
            if ($this->UserModel->inserData($param, $param2)) {
                $this->load->model('MailModel');
                $this->MailModel->sendNewUser($emailParam);
                $this->session->set_flashdata('update_token', time());
                redirect('/User/success');
            }
        } else {
            $error = "fail";
            $html = $this->load->view('user/sign-up', $updateresult, TRUE);
            $this->adminTemplet('user', $html, '', $error, $msg);
        }
    }

    public function checkUserEmail() {
        if ($this->form_validation->run('checkEmail') == false) {
            echo 'false';
            die();
        } else {
            echo 'true';
            die();
        }
    }

    public function checkSignUpEmail() {
        if ($this->form_validation->run('checkEmail') == false) {
            echo 'true';
            die();
        } else {
            echo 'false';
            die();
        }
    }

    public function checkUserMobile() {
        if ($this->form_validation->run('checkMobile') == false) {
            echo 'false';
            die();
        } else {
            echo 'true';
            die();
        }
    }

    function about() {
        $updateresult = '';
        $html = $this->load->view('user/about', $updateresult, TRUE);
        $this->adminTemplet('user', $html);
    }

    public function success() {
        $error = $updateresult = $msg = '';
        // Make sure this request came from the index() method...
        if (!$this->session->flashdata('update_token')) {
            redirect('/user/signin');
        }

        $msg = 'Your profile has been successfully Registered';
        // $html = $this->load->view('user/user-registration', $updateresult, TRUE);
        $html = $this->load->view('user/signin', $updateresult, TRUE);
        $this->adminTemplet('user', $html, '', $error, $msg);
    }

    public function checkSignin($data) {
        $error = $msg = $updateresult = '';
      
            if ($this->AutModel->checkUserCredentials($data)) {
                    redirect('Home/index');
               
            }else
            {
                 $html = $this->load->view('pages/login', $updateresult, TRUE);
                $this->adminTemplet('user', $html, '', $error, $msg);
            }
        
    }

    public function userRegistration() {
        $error = $updateresult = $msg = '';
        $html = $this->load->view('user/user-registartion', $updateresult, TRUE);
        $this->adminTemplet('user', $html, '', $error, $msg);
    }

    public function whyus() {
        $error = $updateresult = $msg = '';
        $html = $this->load->view('user/whyus', $updateresult, TRUE);
        $this->adminTemplet('user', $html);
    }

    public function termsandConditions() {
        $error = $updateresult = $msg = '';
        $html = $this->load->view('user/termsandconditions', $updateresult, TRUE);
        $this->adminTemplet('user', $html);
    }

    protected function randomString($length, $type = '') {
        // Select which type of characters you want in your random string
        switch ($type) {
            case 'num':
                // Use only numbers
                $salt = '1234567890';
                break;
            case 'lower':
                // Use only lowercase letters
                $salt = 'abcdefghijklmnopqrstuvwxyz';
                break;
            case 'upper':
                // Use only uppercase letters
                $salt = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;
            default:
                // Use uppercase, lowercase, numbers, and symbols
                $salt = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
                break;
        }
        $rand = '';
        $i = 0;
        while ($i < $length) { // Loop until you have met the length
            $num = rand() % strlen($salt);
            $tmp = substr($salt, $num, 1);
            $rand = $rand . $tmp;
            $i++;
        }
        return $rand; // Return the random string
    }

}
