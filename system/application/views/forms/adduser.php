<?php
  $this->load->helper('form');
  
  $attributes = array('id' => "adduser_form");
  
  echo form_open('manager/register',$attributes);
  
  $username = array (
    'name' => 'username',
    'id' => 'username',
    'maxlength' => '64',
    'size' => '50',
  );
  $password = array (
    'name' => 'password',
    'id' => 'password',
    'maxlength' => '64',
    'size' => '50',
  );
  $verify = array (
    'name' => 'verify',
    'id' => 'verify',
    'maxlength' => '64',
    'size' => '50',
  );
  $real_name = array (
    'name' => 'realname',
    'id' => 'realname',
    'maxlength' => '100',
    'size' => '50',
  ); 
  $type_encoder = array (
    'name' => 'type',
    'id' => 'type1',
    'value' => '0'
  );
  $type_admin = array (
    'name' => 'type',
    'id' => 'type2',
    'value' => '1'
  );
  
  
  echo form_label('Username',$username['id']);
  echo form_input($username);
  echo form_label('Password',$password['id']);
  echo form_password($password);
  echo form_label('Verify password',$verify['id']);
  echo form_password($password);
  echo form_label('Real name',$real_name['id']);
  echo form_password($real_name);
  echo form_fieldset('Account type');
    echo form_radio($type_encoder);
    echo form_label('Encoder',$type_encoder['id']);
    echo form_radio($type_admin);
    echo form_label('Administrator',$type_admin['id']);
  echo form_fieldset_close();
  echo form_reset('reset','Reset');
  echo form_submit('login','Register');
  echo form_close();
  
//end of adduser.php