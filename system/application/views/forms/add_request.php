<?php
  $this->load->helper('form');
  $this->load->library('formdate');
  
  $hidden = array(
    'create_user_id' => $user_id, 
    'mod_user_id' => $user_id,
    'resident_id' => $resident_id
  );
  
  $attributes = array('id' => "addrequest_form");
  
  echo '<h2>Add request</h2>';
  
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
  $status_1 = array (
    'name' => 'status',
    'id' => 'stat1',
    'desc' => array_get('STATUS',1),
    'value' => '1'
  );
  $status_2 = array (
    'name' => 'status',
    'id' => 'stat2',
    'desc' => 'Rejected',
    'value' => '4'
  );
  $status_3 = array (
    'name' => 'status',
    'id' => 'stat3',
    'desc' => 'Pending',
    'value' => '2'
  );
  $status_4 = array (
    'name' => 'status',
    'id' => 'stat4',
    'desc' => 'Complete',
    'value' => '3'
  );
  
  /*  id INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  creation_date DATE,
  modified_date DATE,
  /create_user_id int ( 11 ),
  /mod_user_id int ( 11 ),
  /resident_id int ( 11 ),
  /description VARCHAR ( 255 ),
  /status VARCHAR ( 15 ),
  /remarks VARCHAR ( 255 ),
  /deadline DATE*/
  
  $formdate = new FormDate();
  $formdate->year['start'] = 2010;
  $formdate->year['end'] = 2010+10; //TODO: auto increment based on system time
  //$formdate->month['values'] = 'numbers';
  
  $form_element = array (
    '<div class="desc">Encoder</div><div class="info">'.$encoder_name.'</div>',
    '<div class="desc">Resident</div><div class="info">'.$resident_name.'</div>',
    form_label($description['desc'],$description['id']).form_textarea($description),
    form_label($has_deadline['desc'],$has_deadline['id']).form_checkbox($has_deadline),
    '<label>Deadine</label>'.$formdate->selectMonth().$formdate->selectDay().$formdate->selectYear(),
    form_fieldset('Status').form_radio($status_1).form_label($status_1['desc'],$status_1['id']).
      form_radio($status_2).form_label($status_2['desc'],$status_2['id']).
      form_radio($status_3).form_label($status_3['desc'],$status_3['id']).
      form_radio($status_4).form_label($status_4['desc'],$status_4['id']).form_fieldset_close(),
    form_label($remarks['desc'],$remarks['id']).form_textarea($remarks),
  );
  
  foreach($form_element as $item) {
    echo '<li>'.$item.'</li>';
  }
  
  
  
  echo form_reset('reset','Reset');
  echo form_submit('login','Register');
  echo form_close();
  
//end of addresident.php