<?php
class User_manager extends Model {
  function add_user($username='',$password='',$real_name='',$type='') {
    $this->db->set('username',$username);
    $this->db->set('password',md5($password));
    $this->db->set('real_name',$real_name);
    $this->db->set('type',$type);
    $this->db->insert('users');
    echo md5($password);
  }
  function login($username='',$password='') {
    $condition = array (
      'username' => $username,
      'password' => md5($password)
    );
    echo md5($password).'<br/>';
    $query = $this->db->get_where('users',$condition);
    
    // correct username/password
    if ($query->num_rows() == 1) {
      //initialize session
      $user_data = $query->row();
      $user_cookie = array (
	'username' = $user_data->username;
	'real_name' = $user_data->real_name;
	'type' = $user_data->type;
      );
      $this->session->set_userdata($user_cookie);
    }
    else {
      //TODO:redirect to manager/index
      //TODO:display wrong username/password msg
    }
  }
}

?>