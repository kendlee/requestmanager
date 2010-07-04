<?php
  $this->CI =& get_instance();
  $query = $this->CI->db->get_where('requests',
    array(
      'id' => $rid
    ) 
  );
  //TODO:place all of the attributes
  echo $query->row()->name;
  /*$form_element = array (
    form_label($first_name['desc'],$first_name['id']).form_input($first_name),
    form_label($last_name['desc'],$last_name['id']).form_input($last_name),
    form_label($address['desc'],$address['id']).form_textarea($address),
    form_fieldset('Sex').form_radio($sex_m).form_label($sex_m['id'],$sex_m['id']).
      form_radio($sex_f).form_label($sex_f['id'],$sex_f['id']).form_fieldset_close(),
    form_fieldset('Civil status').form_radio($status_s).form_label($status_s['id'],$status_s['id']).
      form_radio($status_m).form_label($status_m['id'],$status_m['id']).
      form_radio($status_l).form_label($status_l['id'],$status_l['id']).
      form_radio($status_w).form_label($status_w['id'],$status_w['id']).form_fieldset_close(),
    form_label($precinct['desc'],$precinct['id']).form_input($precinct),
    form_label($barangay['desc'],$barangay['id']).form_input($barangay),
    '<label>Birthday</label>'.$formdate->selectMonth().$formdate->selectDay().$formdate->selectYear(),
    form_fieldset('Category').form_radio($type_1).form_label($type_1['desc'],$type_1['id']).
      form_radio($type_2).form_label($type_2['desc'],$type_2['id']).
      form_radio($type_3).form_label($type_3['desc'],$type_3['id']).
      form_radio($type_4).form_label($type_4['desc'],$type_4['id']).form_fieldset_close(),
    form_label($remarks['desc'],$remarks['id']).form_textarea($remarks),
  );*/
?>

<div id="resident_info">
  <a href="<?php echo site_url('manager/add_request/'.$query->row()->id)?>">Add request</a>
  <ul>
    <li>
      <span class="desc">Request id</span>
      <span class="info"><?=$query->row()->id?></span>
    </li>
    <li>
      <span class="desc">Status</span>
      <span class="info"><?=$query->row()->status?></span>
    </li>
    <li>
      <span class="desc">Deadline</span>
      <span class="info"><?=$query->row()->deadline?></span>
    </li>
    <li>
      <span class="desc">Description</span>
      <span class="info"><?=$query->row()->description?></span>
    </li>
    <li>
      <span class="desc">Remarks</span>
      <span class="info"><?=$query->row()->remarks?></span>
    </li>
  </ul>
</div>
