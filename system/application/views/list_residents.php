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
  
  echo '<div id="resident_list">';
  echo '<table id="resident_table">';
  echo '<thead class="table_header">';
  echo '<tr>';
  #echo '<th class="res_id">Res ID</th>';
  echo '<th class="res_name">Name</th>';
  echo '<th class="res_barangay">Barangay</th>';
  echo '<th class="res_precinct">Precinct</th>';
  echo '<th class="res_sex">Sex</th>';
  echo '<th class="res_status">Status</th>';
  echo '<th class="res_birthday">Birthday</th>';
  echo '<th class="res_request">Requests</th>';
  echo '</tr>';
  echo '</thead>';
  
  $c = 0;
  
  echo '<tbody class="table_header">';
  
  foreach ($query->result() as $row) {
    $val = ($c++%2==1) ? 'odd' : 'even';
    echo '<tr class="'.$val.'">';
    echo '<td class="res_name"><a href="'.site_url('resident/index/'.$row->id).'">'.$row->name.'</a></td>';
    echo '<td class="res_barangay">'.$row->barangay.'</td>';
    echo '<td class="res_precinct">'.$row->precinct.'</td>';
    echo '<td class="res_sex">'.$row->sex.'</td>';
    echo '<td class="res_status">'.$row->status.'</td>';
    echo '<td class="res_birthday">'.$row->birthday.'</td>';
    echo '<td class="res_request">'.$row->requests.'</td>';
    echo '</tr>';
  }
  echo '</tbody>';
  
  echo '</table>';
  
  echo '</div>';
//end of list_residents.php