<?php
  $this->load->helper('form');
  
  $attributes = array('id' => "login_form");
  
  echo form_open('manager/login',$attributes);
  
  $username = array (
    'name' => 'username',
    'id' => 'username',
    'maxlength' => '100',
    'size' => '50',
  );
  $password = array (
    'name' => 'password',
    'id' => 'password',
    'maxlength' => '100',
    'size' => '50',
  );
  
  echo form_label('Username',$username['id']);
  echo form_input($username);
  echo form_label('Password',$password['id']);
  echo form_password($password);
  
  echo form_reset('reset','Reset');
  echo form_submit('login','Login');
  echo form_close();
  
//end of login.php