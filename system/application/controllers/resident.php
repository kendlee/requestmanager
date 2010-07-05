<?php
class Resident extends Controller {
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
      $this->load->view('view_resident',$params);
    }
    else {
      //goto login screen
      redirect('','refresh');
    }
  }
  
  function edit($rid = "") {
    if (is_admin()) {
      $display = array (
	'access' => TRUE,
	'id' => $rid,
      ); //to enable showing of form
      
      $params = array (
	'has_menu' => TRUE,
	'content' => $this->load->view('forms/edit_resident',$display,true)
      );
      $this->load->view('page',$params);
    }
    else {
      if (is_logged_in()) {
	
	$display = array (
	  'access' => TRUE, //TODO:check admin password data
	  'id' => $rid,
	); 
	
	$params = array (
	  'has_menu' => TRUE,
	  'content' => $this->load->view('forms/edit_resident',$display,true)
	);
	$this->load->view('page',$params);
      }
      else {
	redirect('','refresh');
      }
    }
  }
}
  
 /*function edit($rid = "") {
    
  }*/
  
?>