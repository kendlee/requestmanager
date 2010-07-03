<?php
  $this->CI =& get_instance();
  $query = $this->CI->db->get_where('residents',
    array(
      'id' => $rid
    ) 
  );
  //TODO:place all of the attributes
  echo $query->row()->name;
?>
  <a href="<?php echo site_url('manager/add_request/'.$query->row()->id)?>">Add request</a>
