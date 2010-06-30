<?php
class Manager extends Controller {
  function Manager() {
    parent::Controller();
  }
  function index() {
    $this->load->view('forms/login');
  }
  function registerUser() {
    //todo relocated somewhere where admin only can access
    $this->load->view('forms/adduser');
  }
  function register() {
    $this->load->model('User_manager','userdb');
    $this->load->library('input');
    $username = $this->input->post('username');
    $password = $this->input->post('password');
    //$verify = $this->input->post('verify');
    $real_name = $this->input->post('realname');
    $type_encoder = $this->input->post('type');
    
    $this->userdb->add_user($username,$password,$real_name,$type_encoder);
  }
}
?>