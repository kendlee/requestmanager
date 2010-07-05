<?php
class Request extends Controller {
  function Manager() {
    parent::Controller();
  }
  
  //for viewing single in depth 
  function index($rid = "") {
    //rid auto close if invalid?
    if ($this->session->userdata('username')!='') {
      //load main view
      $params = array (
	'rid' => $rid
      );
      $this->load->view('view_request',$params);
    }
    else {
      //goto login screen
      redirect('','refresh');
    }
  }
  
  function edit($rid = "") {
    $this->load->model('Request_manager','requestdb');
    
    //$resident_id = $this->residentdb->
    
    if (is_admin()) {
      $display = array (
	'access' => TRUE,
	'id' => $rid,
	'user_id' => $this->session->userdata('id'),
	'encoder_name' => $this->session->userdata('real_name'), //realname of encoder
	'resident_name' => $this->requestdb->get_resident_name($rid),
      ); //to enable showing of form
      
      $params = array (
	'has_menu' => TRUE,
	'content' => $this->load->view('forms/edit_request',$display,true)
      );
      $this->load->view('page',$params);
    }
    else {
      if (is_logged_in()) {
	
	$display = array (
	  'access' => TRUE, //TODO:check admin password data
	  'id' => $rid,
	  'user_id' => $this->session->userdata('id'),
	  'encoder_name' => $this->session->userdata('real_name'), //realname of encoder
	  'resident_name' => $this->requestdb->get_resident_name($rid),
	); 
	
	$params = array (
	  'has_menu' => TRUE,
	  'content' => $this->load->view('forms/edit_request',$display,true)
	);
	$this->load->view('page',$params);
      }
      else {
	redirect('','refresh');
      }
    }
  }
  
}
  
  
  
?>