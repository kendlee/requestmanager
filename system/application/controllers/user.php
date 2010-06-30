<?php
class User extends Controller {
  function Manager() {
    parent::Controller();
  }
  
  function add() {
    
  }
  
  function verify() {
    //todo:integrate into database username and password
    
    $this->load->library('input');
    echo 'Hello '.$this->input->post('username').'<br/>';
    echo 'pass: '.$this->input->post('password').'<br/>';
  }
}
?>