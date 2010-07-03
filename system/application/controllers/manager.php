<?php
class Manager extends Controller {
  public $homepage = '';
  
  function Manager() {
    parent::Controller();
    if ($this->is_logged_in()) {
      $this->homepage = "manager/by_resident/1";
    }
    else {
      $this->homepage = "";
    }
  }
  
  /* simple function to check whether logged in or out*/
  function is_logged_in() {
    //echo $this->session->userdata('username');
    return $this->session->userdata('username')!='';
  }
  
  /* loads login page */
  function index(/*$page = "", $criteria = "", $asc = ""*/) {
    if ($this->is_logged_in()) {
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
    if ($this->is_logged_in()) {
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
    /*$display = array (
    'view' => $view
    );
    
    $params = array (
    'has_menu' => TRUE,
    'content' => $this->load->view('selector','',true).$this->load->view('list_residents',$display,true)
    );
    $this->load->view('page',$params);*/
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
    $request_credentials = array (
      'user_id' => $this->session->userdata('id'),
      'real_name' => $this->session->userdata('real_name')
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
  /*id INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  create_user_id int ( 11 ),
  FOREIGN KEY (create_user_id) REFERENCES users(id),
  creation_date DATE,
  mod_user_id int ( 11 ),
  FOREIGN KEY (mod_user_id) REFERENCES users(id),
  modified_date DATE,
  resident_id int ( 11 ),
  FOREIGN KEY (resident_id) REFERENCES residents(id),
  description VARCHAR ( 255 ),
  status VARCHAR ( 15 ),
  remarks VARCHAR ( 255 ),
  deadline DATE*/
  
  /*for requests table*/
  function register_request() {
    //todo: only logged in user can access
    $this->load->model('Request_manager','requestdb');
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
}
?>