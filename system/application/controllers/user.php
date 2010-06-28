<?php
class User extends Controller {
  function Manager() {
    parent::Controller();
  }
  function verify() {
    //todo:integrate into database username and password
    
    $this->load->library('input');
    echo 'Hello '.$this->input->post('username');
    echo 'pass: '.$this->input->post('password');
  }
}
?>