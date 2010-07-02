<?php
  $this->CI =& get_instance();
  $query = $this->CI->db->get_where('residents',
    array(
      'id' => $rid
    ) 
  );
  
  //TODO:place all of the attributes
  echo $query->row()->name;

//end of view_resident.php