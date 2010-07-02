<?php
class Manager extends Controller {
  function Manager() {
    parent::Controller();
  }
  function index($view = 1/*,$page = "", $criteria = "", $asc = ""*/) {
    if ($this->session->userdata('username')!='') {
      //load main view
      $params = array (
	'view' => $view
      );
      $this->load->view('navigation');
      
      $this->load->view('selector');
      $this->load->view('list_residents',$params);
    }
    else {
      //login screen
      $this->load->view('forms/login');
    }
  }

  function add_user() {
    //todo: only admin should be able to access
    $this->load->view('navigation');
    $this->load->view('forms/add_user');
  }
  function add_resident() {
    //todo: only logged in user can access
    $this->load->view('navigation');
    $this->load->view('forms/add_resident');
  }
  
  //called to login to the system
  function login() {
    $this->load->model('User_manager','userdb');
    $this->load->library('input');
    $username = $this->input->post('username');
    $password = $this->input->post('password');
    $this->userdb->login($username,$password);
    redirect('','refresh');
  }
  
  function logout() {
    $this->session->sess_destroy();
    redirect('','refresh');
  }
  
  /*database-related*/

  /*for users table*/
  //called to add users
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
	//todo: birthday fetching
	$birthday = "1950-01-01"; //yyyy-mm-dd
	$category = $this->input->post('type');
	$remarks = $this->input->post('remarks');
	
	$this->residentdb->add_resident($full_name, $address, $sex, $status, $precinct, $barangay, $birthday, $category, $remarks);
  }
  
}
?>