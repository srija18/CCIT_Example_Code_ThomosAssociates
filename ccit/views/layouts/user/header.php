    
        <!DOCTYPE html>
<html>
    <head>

        <!-- /.website title -->
        <title>CCIT</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

        <!-- CSS Files -->
           <link href="<?= adminUrl . 'public/' ?>css/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="<?= adminUrl . 'public/' ?>fonts/font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="<?= adminUrl . 'public/' ?>fonts/css/pe-icon-7-stroke.css" rel="stylesheet">
        <link href="<?= adminUrl . 'public/' ?>css/animate.css" rel="stylesheet" media="screen">
        <link href="<?= adminUrl . 'public/' ?>css/owl.theme.css" rel="stylesheet">
        <link href="<?= adminUrl . 'public/' ?>css/owl.carousel.css" rel="stylesheet">

        <!-- Colors -->
        <link href="<?= adminUrl . 'public/' ?>css/css-index.css" rel="stylesheet" media="screen">
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    </head>

    <body data-spy="scroll" data-target="#navbar-scroll">

        <!-- /.preloader -->
        <div id="preloader"></div>
        <div id="top">
			<div class="container">
      			<ul class="list-inline no-margin topsocial pull-left">
      				<li><a href="https://twitter.com/ccit" target="_blank" ><i class="fa fa-twitter"></i></a></li>
      				<li><a href="https://www.facebook.com/ccitinc" target="_blank"><i class="fa fa-facebook"></i></a></li>
      				<li><a href="https://www.linkedin.com/" target="_blank"><i class="fa fa-linkedin"></i></a></li>
      				
      			</ul>
      			<ul class="list-inline no-margin pull-right loginregister">
      				 <?php   if (($this->session->userdata('userWebStatus') == Null)){ ?>
      				<li><a href="<?= site_url('Home/login'); ?>">Login</a></li>
      				<li><a href="<?= site_url('Home/register'); ?>">Register</a></li>
                   <?php       }else if (($this->session->userdata('userWebStatus') == true)){ ?>
                                <li><a><?php echo $this->session->userdata('userName'); ?></a></li>
      				<li><a href="<?= site_url('user/signOut'); ?>">logout</a></li>
                    <?php     }
                         ?>
      				
      			</ul>
			</div>
       </div>
        
        <div id="menu">
            <nav class="navbar-wrapper navbar-default" role="navigation">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-backyard">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                          <a class="navbar-brand site-name" href="<?= site_url('Home/index'); ?>"><img src="<?= adminUrl . 'public/' ?>images/logo2.png" alt="logo"></a>
                  
                    </div>

                    <div id="navbar-scroll" class="collapse navbar-collapse navbar-backyard navbar-right">
                               <ul class="nav navbar-nav">
                            <li><a href="<?= site_url('Home/index'); ?>" class="<?php
                                if ($this->uri->segment(2) == '') {
                                    echo 'active';
                                }
                                ?>">Home</a></li>
                            <li><a href="<?= site_url('Home/about'); ?>" class="<?php
                                if ($this->uri->segment(2) == 'about') {
                                    echo 'active';
                                }
                                ?>">About US</a></li>
                            <li><a href="<?= site_url('Home/itservices'); ?>" class="<?php
                                if ($this->uri->segment(2) == 'itservices') {
                                    echo 'active';
                                }
                                ?>">IT Services</a></li>
                            <li><a href="<?= site_url('Home/clients'); ?>" class="<?php
                                if ($this->uri->segment(2) == 'clients') {
                                    echo 'active';
                                }
                                ?>">Clients</a></li>
                            <li><a href="<?= site_url('Home/careers'); ?>" class="<?php
                                if ($this->uri->segment(2) == 'careers') {
                                    echo 'active';
                                }
                                ?>">Careers</a></li>
                            <li><a href="<?= site_url('Home/contact'); ?>" class="<?php
                                if ($this->uri->segment(2) == 'contact') {
                                    echo 'active';
                                }
                                ?>">Contacts</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>

   <div class="msg-txt-wraper">
        {error}
        {msg} 
    </div>   