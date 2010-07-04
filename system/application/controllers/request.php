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
}
  
 /*function edit($rid = "") {
    
  }*/
  
?>