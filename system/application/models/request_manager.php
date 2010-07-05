<?php
class Request_manager extends Model {
  
  function add_request($create_user_id="", $mod_user_id="", $resident_id="", $description="", $status="", $remarks="", $deadline = NULL) {

    /*$timestamp = date('Y-m-d H:i:s', time());
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
    $this->db->insert('requests');*/
    
    $timestamp = date('Y-m-d H:i:s', time());
    $request = array(
      'creation_date'=>$timestamp,
      'modified_date'=>$timestamp,
      'create_user_id'=>$create_user_id,
      'mod_user_id'=>$mod_user_id,
      'resident_id'=>$resident_id,
      'description'=>$description,
      'status'=>$status,
      'remarks'=>$remarks,
      'deadline'=>(!is_null($deadline))?$deadline:NULL,
    );
    
    $this->db->insert('requests',$request);
  }
  
  
  /* get the name of the resident that used created the request
   *
   * @params $id - request id
   * @return name of the requester
   */
  
  function get_resident_name($id = "") {
    /*$query = $this->db->get_where('requests',array ('id' => $id));
    $this->db->flush_cache();
    return array (
      'resident_name' = $query->row()->name,
      'resident_id' = $query->row()
    );*/
    
    $this->db->select('*');
    $this->db->from('requests');
    $this->db->join('(SELECT id as resid, category, name FROM residents) as residents','requests.resident_id = residents.resid');
    $this->db->where('id',$id);
    $query = $this->db->get();
    return $query->row()->name;
  }

}