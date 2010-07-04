<?php 
  $this->CI =& get_instance();
  //$this->CI->db->get_where($view);
  
  /*$query = $this->CI->db->get('residents',100,0);*/
  $query = $this->CI->db->get_where('residents',
    array(
      'category' => $view
    ), 
    100, 0
  );
  $c = 0;
?>
  
<div id="resident_list">
  <table id="resident_table">
    <thead class="table_header">
      <tr>
	<!--<th class="res_id">Res ID</th>'-->
	<th class="res_name">Name</th>
	<th class="res_barangay">Barangay</th>
	<th class="res_precinct">Precinct</th>
	<th class="res_sex">Sex</th>
	<th class="res_status">Status</th>
	<th class="res_birthday">Birthday</th>
	<th class="res_request">Requests</th>
      </tr>
    </thead>
    <tbody class="table_header">

    <?php foreach ($query->result() as $row): ?>
    <?php $val = ($c++%2==1) ? 'odd' : 'even'; ?>
      <tr class="<?=$val?>'">
	<td class="res_name"><a href="<?=site_url('resident/index/'.$row->id)?>" target="_blank"><?=$row->name?></a></td>
	<td class="res_barangay"><?=$row->barangay?></td>
	<td class="res_precinct"><?=$row->precinct?></td>
	<td class="res_sex"><?=$row->sex?></td>
	<td class="res_status"><?=$row->status?></td>
	<td class="res_birthday"><?=$row->birthday?></td>
	<td class="res_request"><?=$row->requests?></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>