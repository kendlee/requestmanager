<?php 
  //$query = $this->CI->db->get('requests',100,0);
  //$this->CI->db->select('id AS req_id,create_user_id,creation_date,mod_user_id,modified_date,resident_id,status,remarks,deadline');
  $this->db->select('*');
  $this->db->from('requests');
  $this->db->join('(SELECT id as resid, category, name FROM residents) as residents','requests.resident_id = residents.resid');
  $this->db->where('category',$view);
  $query = $this->db->get();
  //$query = $this->db->query("SELECT * FROM (requests) JOIN (SELECT id as resid, category FROM residents) AS residents ON requests.resident_id = residents.resid WHERE residents.category = 1");
  /*$query = $this->CI->db->get_where('request',
    array(
      'category' => $view
    ), 
    100, 0
  );*/
  $c = 0;
?>
  
<div id="request_list">
  <table id="request_table">
    <thead class="table_header">
      <tr>
	<th class="req_id">Req ID</th>
	<th class="req_date">Date Requested</th>
	<th class="req_resident">Resident</th>
	<th class="req_deadline">Deadline</th>
	<th class="req_status">Status</th>
	<th class="req_description">Description</th>
	<th class="req_remark">Remarks</th>
      </tr>
    </thead>
    <tbody class="table_header">
    <!--id INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    create_user_id int ( 11 ),
    FOREIGN KEY (create_user_id) REFERENCES users(id),
    creation_date TIMESTAMP(8),
    mod_user_id int ( 11 ),
    FOREIGN KEY (mod_user_id) REFERENCES users(id),
    modified_date TIMESTAMP(8),
    resident_id int ( 11 ),
    FOREIGN KEY (resident_id) REFERENCES residents(id),
    description VARCHAR ( 255 ),
    status VARCHAR ( 15 ),
    remarks VARCHAR ( 255 ),
    deadline DATE-->
    <?php foreach ($query->result() as $row): ?>
    <?php //print_r($row); ?>
    <?php $val = ($c++%2==1) ? 'odd' : 'even'; ?>
      <tr class="<?=$val?>'">
	<td class="req_id"><a href="<?=site_url('request/index/'.$row->id)?>"><?=$row->id?></a></td>
	<td class="req_date"><?=$row->creation_date?></td>
	<td class="req_resident"><a href="<?=site_url('resident/index/'.$row->resid)?>"><?=$row->name?></a></td>
	<td class="req_deadline"><?=$row->deadline?></td>
	<td class="req_status"><?=$row->status?></td>
	<td class="req_description"><?=$row->description?></td>
	<td class="req_remark"><?=$row->remarks?></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>