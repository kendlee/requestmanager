<?php $this->load->helper('form'); ?>
<div> 
<a href="<?php echo site_url('request/index/'.$this->uri->segment(3))?>">View</a>

<?php if($access): ?>
  <?php $this->load->library('formdate');
    $this->CI = & get_instance();
    $query = $this->CI->db->get_where('requests',array('id'=>$id));

    $result = $query->row();

    $hidden = array(
      'id' => $id,
      'mod_user_id' => $user_id,
    );
    
    $attributes = array('id' => "updaterequest_form");
    
    echo form_open('manager/update_request',$attributes,$hidden);
    
    $description = array (
      'name' => 'description',
      'id' => 'description',
      'maxlength' => '1000',
      'rows' => '10',
      'cols' => '100',
      'desc' => 'Description',
      'value' => $result->description,
    );
    $has_deadline = array (
      'name' => 'has_deadline',
      'id' => 'has_deadline',
      'value' => 1,
      'checked' => !is_null($result->deadline),
      'desc' => 'Has deadline'
    );
    $remarks = array (
      'name' => 'remarks',
      'id' => 'remarks',
      'maxlength' => '255',
      'rows' => '3',
      'cols' => '100',
      'desc' => 'Remarks',
      'value' => $result->remarks,
    );
    $status_1 = array (
      'name' => 'status',
      'id' => 'stat1',
      'desc' => array_get('STATUS',1),
      'value' => '1',
      'checked' => $result->status==1,
    );
    $status_2 = array (
      'name' => 'status',
      'id' => 'stat2',
      'desc' => array_get('STATUS',4),
      'value' => '4',
      'checked' => $result->status==4,
    );
    $status_3 = array (
      'name' => 'status',
      'id' => 'stat3',
      'desc' => array_get('STATUS',2),
      'value' => '2',
      'checked' => $result->status==2,
    );
    $status_4 = array (
      'name' => 'status',
      'id' => 'stat4',
      'desc' => array_get('STATUS',3),
      'value' => '3',
      'checked' => $result->status==3,
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
    
    if (!is_null($result->deadline)) {
      $fulldate = explode('-',$result->deadline);
      $formdate->year['selected'] = $fulldate[0];
      $formdate->month['selected'] = $fulldate[1];
      $formdate->day['selected'] = $fulldate[2];    
    }
    
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
  ?>
    
  <?php foreach($form_element as $item):?>
    <li><?=$item?></li>
  <?php endforeach;?>

  <?=form_reset('reset','Reset')?>
  <?=form_submit('update','Update')?>
  <?=form_close()?>

<?php else: ?>
<?php endif; ?>
</div>