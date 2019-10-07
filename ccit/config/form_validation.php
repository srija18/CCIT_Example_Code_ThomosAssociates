<?php

$config = array(    
       'checkEmail' => array(
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|required|is_unique[users.email]'
        )
    ),
       'checkMobile' => array(
        array(
            'field' => 'mobile_no',
            'label' => 'mobile',
            'rules' => 'trim|required|is_unique[users.mobile_no]'
        )
    ),
   
       'signIn' => array(
        array(
            'field' => 'email',
            'label' => 'email',
            'rules' => 'trim|required'
        ),
            array(
            'field' => 'password',
            'label' => 'password',
            'rules' => 'trim|required'
        ),
    ),
       'forgetpassword' => array(
        array(
            'field' => 'email',
            'label' => 'Email',
           'rules' => 'trim|required|valid_email'
        ),
           ),
      'registerUser' => array(
        array(
            'field' => 'username',
            'label' => 'username',
            'rules' => 'trim|required'
        ),
            array(
            'field' => 'password',
            'label' => 'password',
            'rules' => 'trim|required'
        ),
            array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|required|is_unique[users.email]'
        ),
            array(
            'field' => 'mobile_no',
            'label' => 'mobile',
            'rules' => 'trim|required|is_unique[users.mobile_no]'
        ),
      
          
    ),
   
       
  
);
