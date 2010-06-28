<?php
class Manager extends Controller {
  function Manager() {
    parent::Controller();
  }
  function index() {
    $this->load->view('login');
  }
}
?>