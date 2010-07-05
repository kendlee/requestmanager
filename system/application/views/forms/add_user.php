<?php
  $this->load->helper('form');
  
  $attributes = array('id' => "adduser_form");
  
  echo form_open('manager/register_user',$attributes);
  
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
  
  $form_element = array (
    form_label('Username',$username['id']).form_input($username),
    form_label('Password',$password['id']).form_password($password),
    form_label('Verify password',$verify['id']).form_password($password),
    form_label('Real name',$real_name['id']).form_input($real_name),
    form_fieldset('Account type').form_radio($type_encoder).form_label('Encoder',$type_encoder['id']).
      form_radio($type_admin).form_label('Administrator',$type_admin['id']).form_fieldset_close()
  );
  
  foreach($form_element as $item) {
    echo '<li>'.$item.'</li>';
  }
  
  echo form_reset('reset','Reset');
  echo form_submit('login','Register');
  echo form_close();
  
//end of adduser.php