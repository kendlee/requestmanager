<?php
class Resident_manager extends Model {
  
  function add_resident($full_name='', $address='', $sex='', $status='', $precinct='', 
      $barangay='', $birthday='', $category='', $remarks='') {

    /*$this->db->set('name',$full_name);
    $this->db->set('address',$address);
    $this->db->set('sex',$sex);
    $this->db->set('status',$status);
    $this->db->set('precinct',$precinct);
    $this->db->set('barangay',$barangay);
    $this->db->set('birthday',$birthday);
    $this->db->set('category',$category);
    $this->db->set('remarks',$remarks);*/
    
    $resident = array(
      'name'=>$full_name,
      'address'=>$address,
      'sex'=>$sex,
      'status'=>$status,
      'precinct'=>$precinct,
      'barangay'=>$barangay,
      'birthday'=>$birthday,
      'category'=>$category,
      'remarks'=>$remarks,
    );
    
    $this->db->insert('residents',$resident);
  }
  
  function update_resident($id = '',$full_name='', $address='', $sex='', $status='', $precinct='', 
      $barangay='', $birthday='', $category='', $remarks='') {
    
    $resident = array(
      'name'=>$full_name,
      'address'=>$address,
      'sex'=>$sex,
      'status'=>$status,
      'precinct'=>$precinct,
      'barangay'=>$barangay,
      'birthday'=>$birthday,
      'category'=>$category,
      'remarks'=>$remarks,
    );
    $this->db->where('id', $id);
    $this->db->update('residents', $resident); 
  }
  
  function get_resident_name($id = "") {
    $query = $this->db->get_where('residents',array ('id' => $id));
    $this->db->flush_cache();
    return $query->row()->name;
	//return 1;
  }

}