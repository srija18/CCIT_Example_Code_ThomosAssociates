<?php

class AutModel extends CI_Model {

    function userCheck($user) 
    {
        $this->db->select('*');
        $this->db->where('email', $user);
       // $this->db->or_where('mobile', $user);
        $query = $this->db->get('users');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return FALSE;
        }
    }

    function checkUserCredentials($param) {
        $pas = $this->BaseModel->featchRow('users', 'id,username,password,mobile_no,email', 'email:' . $param['email']);
        // print_r($pas);
        if ($pas !== FALSE) {
     
            if ($pas->password === $param['password']) {
               
                $sessionArray = array(
                    'userId' => $pas->id,                   
                    'userWebStatus' => TRUE,
                    'userName' => ucwords($pas->username),
                    'email' =>$pas->email,
                    'mobile' =>$pas->mobile_no
                );
                $this->session->set_userdata($sessionArray);
                
                return TRUE;
            
            } else {
                return FALSE;
            }
            }
       
    }

    function changePassword($curPassword) {
        $pas = $this->BaseModel->featchSingleField('users', 'password', 'id:' . $this->session->userdata('userId'));
        if ($pas !== FALSE) {
            if (hash_equals($pas, crypt($curPassword, $pas))) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

}
