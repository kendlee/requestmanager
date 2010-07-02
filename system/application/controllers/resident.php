<?php
class Resident extends Controller {
  function Manager() {
    parent::Controller();
  }
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
}
  
 /*function edit($rid = "") {
    
  }*/
  
?>