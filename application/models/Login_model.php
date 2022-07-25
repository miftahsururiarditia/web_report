<?php 

class Login_model extends CI_Model {

	public function cek_user($user, $pass){
		$this->db->where('username', $user);
		$this->db->where('password', 'md5("'.$user.'")', NULL, FALSE);
		$sql = $this->db->get('users_table');
		return $sql;
	}

}