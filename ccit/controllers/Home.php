<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function index() {
        $updateresult='';
        $html = $this->load->view('pages/home', $updateresult, TRUE);
        $this->adminTemplet('user', $html);
    }
    public function login() {
        $updateresult='';
        $html = $this->load->view('pages/login', $updateresult, TRUE);
        $this->adminTemplet('user', $html);
    }
    public function register() {
        $updateresult='';
        $html = $this->load->view('pages/register', $updateresult, TRUE);
        $this->adminTemplet('user', $html);
    }
    public function contact() {
        $updateresult='';
        $html = $this->load->view('pages/contact', $updateresult, TRUE);
        $this->adminTemplet('user', $html);
    }
    public function careers() {
        $updateresult='';
        $html = $this->load->view('pages/careers', $updateresult, TRUE);
        $this->adminTemplet('user', $html);
    }
    public function about() {
        $updateresult='';
        $html = $this->load->view('pages/about', $updateresult, TRUE);
        $this->adminTemplet('user', $html);
    }
    public function clients() {
        $updateresult='';
        $html = $this->load->view('pages/clients', $updateresult, TRUE);
        $this->adminTemplet('user', $html);
    }
    public function itservices() {
        $updateresult='';
        $html = $this->load->view('pages/itservices', $updateresult, TRUE);
        $this->adminTemplet('user', $html);
    }
  

}
