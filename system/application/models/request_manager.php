<?php
class Request_manager extends Model {
  
  function add_request($create_user_id="", $mod_user_id="", $resident_id="", $description="", $status="", $remarks="", $deadline = NULL) {

    $timestamp = date('Y-m-d H:i:s', time());
    $this->db->set('creation_date',$timestamp);
    $this->db->set('modified_date',$timestamp);
    $this->db->set('create_user_id',$create_user_id);
    $this->db->set('mod_user_id',$mod_user_id);
    $this->db->set('resident_id',$resident_id);
    $this->db->set('description',$description);
    $this->db->set('status',$status);
    $this->db->set('remarks',$remarks);
    if (!is_null($deadline)) {
      $this->db->set('deadline',$deadline);
    }
    $this->db->insert('requests');
  }

}