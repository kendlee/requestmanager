<?php
class User_manager extends Model {
  function add_user($username='',$password='',$realname='',$type='') {
    $this->db->set('username',$username);
    $this->db->set('password',$password);
    $this->db->set('real_name',$realname);
    $this->db->set('type',$type);
    $this->db->insert('users');
  }
}

?>