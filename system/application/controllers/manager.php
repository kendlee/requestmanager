<?php

class Manager extends Controller {
  public $homepage = '';
  
  function Manager() {
    parent::Controller();
    if (is_logged_in()) {
      $this->homepage = "manager/by_resident/1";
    }
    else {
      $this->homepage = "";
    }
  }
  
  /* simple function to check whether logged in or out*/
  
  /* loads login page */
  function index(/*$page = "", $criteria = "", $asc = ""*/) {
    if (is_logged_in()) {
      redirect($this->homepage,'refresh');
    }
    else {
      //login screen
      $params = array (
	'has_menu' => FALSE,
	'content' => $this->load->view('forms/login','',true)   
      );
      $this->load->view('page',$params);
    }
  }
  
  /* loads default home page (by_resident view)*/
  function by_resident($view = 1) {
    //load main view
    if (is_logged_in()) {
      $display = array (
	'view' => $view
      ); //to select which of the 4 category be shown in the screen

      $params = array (
	'has_menu' => TRUE,
	'content' => $this->load->view('selector','',true).$this->load->view('list_residents',$display,true)
      );
      $this->load->view('page',$params);
    }
    
    else {
      redirect('','refresh');
    }
  }
  
  /* loads by_request view*/
  function by_request($view = 1) {
    $display = array (
      'view' => $view
    );
    
    $params = array (
      'has_menu' => TRUE,
      'content' => $this->load->view('selector','',true).$this->load->view('list_requests',$display,true)
    );
    $this->load->view('page',$params);
  }

  function add_user() {
    //todo: only admin should be able to access
    $params = array (
      'has_menu' => TRUE,
      'content' => $this->load->view('forms/add_user','',true)   
    );
    $this->load->view('page',$params);
  }
  function add_resident() {
    //todo: only logged in user can access
    $params = array (
      'has_menu' => TRUE,
      'content' => $this->load->view('forms/add_resident','',true)   
    );
    $this->load->view('page',$params);
  }
  function add_request() {
    //todo: only logged in user can access
    $this->load->model('Resident_manager','residentdb');
    $resident_id = $this->uri->segment(3);
	//$this->residentdb->
    $request_credentials = array (
      'user_id' => $this->session->userdata('id'),
      'encoder_name' => $this->session->userdata('real_name'), //realname of encoder
      'resident_id' => $resident_id,
      'resident_name' => $this->residentdb->get_resident_name($resident_id),
    );
    
    $params = array (
      'has_menu' => TRUE,
      'content' => $this->load->view('forms/add_request',$request_credentials,true)
    );
    $this->load->view('page',$params);
  }
  
  
  //called to login to the system
  function login() {
    $this->load->model('User_manager','userdb');
    $this->load->library('input');
    $username = $this->input->post('username');
    $password = $this->input->post('password');
    $this->userdb->login($username,$password);
    redirect($this->homepage,'refresh');
  }
  
  function logout() {
    $this->session->sess_destroy();
    $this->homepage = "";
    redirect($this->homepage,'refresh');
  }
  
  /*database-related*/

  /*for users table*/
  function register_user() {
    //todo: only admin should be able to access
    $this->load->model('User_manager','userdb');
    $this->load->library('input');
    $username = $this->input->post('username');
    $password = $this->input->post('password');
    //$verify = $this->input->post('verify');
    $real_name = $this->input->post('realname');
    $type_encoder = $this->input->post('type');
    //TODO:verify password
    $this->userdb->add_user($username,$password,$real_name,$type_encoder);
    redirect($this->homepage,'refresh');
  }
  
  /*for residents table*/
  function register_resident() {
    //todo: only logged in user can access
    $this->load->model('Resident_manager','residentdb');
    $this->load->library('input');

    $full_name = $this->input->post('last_name').', '.$this->input->post('first_name');
    $address = $this->input->post('address');
    $sex = $this->input->post('sex');
    $status = $this->input->post('status');
    $precinct = $this->input->post('precinct');
    $barangay = $this->input->post('barangay');
    $birthday = $this->input->post('year').$this->input->post('month').$this->input->post('day');
    $category = $this->input->post('type');
    $remarks = $this->input->post('remarks');
    
    $this->residentdb->add_resident($full_name, $address, $sex, $status, $precinct, $barangay, $birthday, $category, $remarks);
    redirect($this->homepage,'refresh');
  }
  function update_resident() {
    //todo: only logged in user can access
    $this->load->model('Resident_manager','residentdb');
    $this->load->library('input');
    $id = $this->input->post('id');
    $full_name = $this->input->post('last_name').', '.$this->input->post('first_name');
    $address = $this->input->post('address');
    $sex = $this->input->post('sex');
    $status = $this->input->post('status');
    $precinct = $this->input->post('precinct');
    $barangay = $this->input->post('barangay');
    $birthday = $this->input->post('year').$this->input->post('month').$this->input->post('day');
    $category = $this->input->post('type');
    $remarks = $this->input->post('remarks');
    
    $this->residentdb->update_resident($id,$full_name, $address, $sex, $status, $precinct, $barangay, $birthday, $category, $remarks);
    redirect('resident/index/'.$id,'refresh');
  }

  
  /*for requests table*/
  function register_request() {
    //todo: only logged in user can access
    $this->load->model('Request_manager','requestdb');
    $this->load->library('input');
    
    $create_user_id = $this->input->post('create_user_id'); 
    $mod_user_id = $this->input->post('mod_user_id');
    $resident_id = $this->input->post('resident_id');
    $description = $this->input->post('description');
    $deadline = ($this->input->post('has_deadline') === "1") ? 
      $this->input->post('year').$this->input->post('month').$this->input->post('day') : NULL;
    $status = $this->input->post('status');
    $remarks = $this->input->post('remarks');
    
    $this->requestdb->add_request($create_user_id, $mod_user_id, $resident_id, $description, $status, $remarks, $deadline);
    
    //redirect($this->homepage,'refresh');
  }
}
?>