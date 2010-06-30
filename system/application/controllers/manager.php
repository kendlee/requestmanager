<?php
class Manager extends Controller {
  function Manager() {
    parent::Controller();
  }
  function index() {
    if ($this->session->userdata('username')!='') {
      //load main view
      echo '<a href="'.site_url('manager/logout').'">Logout</a>';
    }
    else {
      //login screen
      $this->load->view('forms/login');
    }
  }
  function register_user() {
    //todo relocated somewhere where admin only can access
    $this->load->view('forms/adduser');
  }
  
  //called to add users
  function register() {
    //TODO:check user privilege first
    $this->load->model('User_manager','userdb');
    $this->load->library('input');
    $username = $this->input->post('username');
    $password = $this->input->post('password');
    //$verify = $this->input->post('verify');
    $real_name = $this->input->post('realname');
    $type_encoder = $this->input->post('type');
    
    $this->userdb->add_user($username,$password,$real_name,$type_encoder);
  }
  
  //called to login to the system
  function login() {
    $this->load->model('User_manager','userdb');
    $this->load->library('input');
    $username = $this->input->post('username');
    $password = $this->input->post('password');
    echo'k';
    $this->userdb->login($username,$password);
    redirect('','refresh');
  }
  
  function logout() {
    $this->session->sess_destroy();
    redirect('','refresh');
  }
}
?>