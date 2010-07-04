<?php
  $this->CI =& get_instance();
  $query = $this->CI->db->get_where('residents',
    array(
      'id' => $rid
    ) 
  );
  //TODO:place all of the attributes
  //echo $query->row()->name;
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
  $this->CI->db->flush_cache();
  $req_query =  $this->CI->db->get_where('requests',
    array(
      'resident_id' => $rid
    ) 
  );
  $c=0;
?>

<div id="resident_info">
  <a href="<?php echo site_url('manager/add_request/'.$query->row()->id)?>">Add request</a>
  <ul>
    <li>
      <span class="desc">Name</span>
      <span class="info"><?=$query->row()->name?></span>
    </li>
    <li>
      <span class="desc">Civil Status</span>
      <span class="info"><?=$query->row()->status?></span>
    </li>
    <li>
      <span class="desc">Sex</span>
      <span class="info"><?=$query->row()->sex?></span>
    </li>
    <li>
      <span class="desc">Birthday</span>
      <span class="info"><?=$query->row()->birthday?></span>
    </li>
    <li>
      <span class="desc">Barangay</span>
      <span class="info"><?=$query->row()->barangay?></span>
    </li>
    <li>
      <span class="req_desc">Requests </span>
      <table id="request_table">
	<thead class="table_header">
	  <tr>
	    <th class="req_id">Req ID</th>
	    <th class="req_date">Date Requested</th>
	    <!--<th class="req_resident">Resident</th>-->
	    <th class="req_deadline">Deadline</th>
	    <th class="req_status">Status</th>
	    <th class="req_description">Description</th>
	    <th class="req_remark">Remarks</th>
	  </tr>
	</thead>
	<tbody class="table_header">
	<?php foreach ($req_query->result() as $row): ?>
	<?php //print_r($row); ?>
	<?php $val = ($c++%2==1) ? 'odd' : 'even'; ?>
	  <tr class="<?=$val?>'">
	    <td class="req_id"><a href="<?=site_url('request/index/'.$row->id)?>"><?=$row->id?></a></td>
	    <td class="req_date"><?=$row->creation_date?></td>
	    <!--<td class="req_resident"><a href="<?//=site_url('resident/index/'.$row->id)?>"><?//=$row->name?></a></td>-->
	    <td class="req_deadline"><?=$row->deadline?></td>
	    <td class="req_status"><?=$row->status?></td>
	    <td class="req_description"><?=$row->description?></td>
	    <td class="req_remark"><?=$row->remarks?></td>
	  </tr>
	<?php endforeach; ?>
	</tbody>
      </table>
    </li>
  </ul>
</div>
