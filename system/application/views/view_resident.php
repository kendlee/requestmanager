<?php
  $this->CI =& get_instance();
  $query = $this->CI->db->get_where('residents',
    array(
      'id' => $rid
    ) 
  );
  //TODO:place all of the attributes
  $this->CI->db->flush_cache();
  $req_query =  $this->CI->db->get_where('requests',
    array(
      'resident_id' => $rid
    ) 
  );
  $c=0;
?>

<div id="resident_info">
  <a href="<?php echo site_url('resident/edit/'.$query->row()->id)?>">Edit details</a>
  <a href="<?php echo site_url('manager/add_request/'.$query->row()->id)?>">Add request</a>
  <ul>
    <li>
      <span class="desc">Name</span>
      <span class="info"><?=$query->row()->name?></span>
    </li>
    <li>
      <span class="desc">Address</span>
      <span class="info"><?=$query->row()->address?></span>
    </li>
    <li>
      <span class="desc">Civil Status</span>
      <span class="info"><?=array_get('CIVIL',$query->row()->status)?></span>
    </li>
    <li>
      <span class="desc">Sex</span>
      <span class="info"><?=array_get('SEX',$query->row()->sex)?></span>
    </li>
    <li>
      <span class="desc">Birthday</span>
      <span class="info"><?=$query->row()->birthday?></span>
    </li>
    <li>
      <span class="desc">Category</span>
      <span class="info"><?=array_get('CATEGORY',$query->row()->category)?></span>
    </li>
    <li>
      <span class="desc">Barangay</span>
      <span class="info"><?=$query->row()->barangay?></span>
    </li>
    <li>
      <span class="desc">Precinct</span>
      <span class="info"><?=$query->row()->precinct?></span>
    </li>
    <li>
      <span class="desc">Remarks</span>
      <span class="info"><?=$query->row()->remarks?></span>
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
	    <td class="req_deadline"><?=is_null($row->deadline)?'n/a':$row->deadline?></td>
	    <td class="req_status"><?=array_get('STATUS',$row->status)?></td>
	    <td class="req_description"><?=$row->description?></td>
	    <td class="req_remark"><?=$row->remarks?></td>
	  </tr>
	<?php endforeach; ?>
	</tbody>
      </table>
    </li>
  </ul>
</div>
