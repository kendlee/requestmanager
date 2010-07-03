<?php
  $this->load->helper('form');
  $this->load->library('formdate');
  /* id INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  create_user_id int ( 11 ),
  FOREIGN KEY (create_user_id) REFERENCES users(id),
  creation_date DATE,
  mod_user_id int ( 11 ),
  FOREIGN KEY (mod_user_id) REFERENCES users(id),
  modified_date DATE,
  resident_id int ( 11 ),
  FOREIGN KEY (resident_id) REFERENCES residents(id),
  description VARCHAR ( 255 ),
  status VARCHAR ( 15 ),
  remarks VARCHAR ( 255 ),
  deadline DATE
  );*/
  $hidden = array(
    'create_user_id' => $user_id, 
    'mod_user_id' => $user_id,
    'resident_id' => $this->uri->segment(3)
  );
  echo $real_name;
  
  $attributes = array('id' => "addrequest_form");
  
  echo form_open('manager/register_request',$attributes,$hidden);
  
  $description = array (
    'name' => 'description',
    'id' => 'description',
    'maxlength' => '1000',
    'rows' => '10',
    'cols' => '100',
    'desc' => 'Description'
  );
  $has_deadline = array (
    'name' => 'has_deadline',
    'id' => 'has_deadline',
    'value' => 1,
    'checked' => FALSE,
    'desc' => 'Has deadline'
  );
  $remarks = array (
    'name' => 'remarks',
    'id' => 'remarks',
    'maxlength' => '255',
    'rows' => '3',
    'cols' => '100',
    'desc' => 'Remarks'
  );
  
  $formdate = new FormDate();
  $formdate->year['start'] = 2010;
  $formdate->year['end'] = 2010+10; //TODO: auto increment based on system time
  //$formdate->month['values'] = 'numbers';
  
  $form_element = array (
    //form_label($first_name['desc'],$first_name['id']).form_input($first_name),
    form_label($description['desc'],$description['id']).form_textarea($description),
    form_label($has_deadline['desc'],$has_deadline['id']).form_checkbox($has_deadline),
    '<label>Deadine</label>'.$formdate->selectMonth().$formdate->selectDay().$formdate->selectYear(),
    form_label($remarks['desc'],$remarks['id']).form_textarea($remarks),
  );
  
  foreach($form_element as $item) {
    echo '<li>'.$item.'</li>';
  }
  
  
  
  echo form_reset('reset','Reset');
  echo form_submit('login','Register');
  echo form_close();
  
//end of addresident.php