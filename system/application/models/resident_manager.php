<?php
class Resident_manager extends Model {
  
  function add_resident($full_name='', $address='', $sex='', $status='', $precinct='', 
      $barangay='', $birthday='', $category='', $remarks='') {

    $this->db->set('name',$full_name);
    $this->db->set('address',$address);
    $this->db->set('sex',$sex);
    $this->db->set('status',$status);
    $this->db->set('precinct',$precinct);
    $this->db->set('barangay',$barangay);
    $this->db->set('birthday',$birthday);
    $this->db->set('category',$category);
    $this->db->set('remarks',$remarks);
    $this->db->insert('residents');
  }

}