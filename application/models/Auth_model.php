<?php 

class Auth_model extends CI_Model {

	const SESSION_KEY = 'user_id';

	public function rules() {
		return [
			[
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'required|valid_email|max_length[32]',
			], 
			[
				'field' => 'pass',
				'label' => 'Password',
				'rules' => 'required|max_length[255]',
			]
		];
	}

	public function login($email, $pass){
		$this->db->where('user_email', $email);
		$encrypted_pass = md5($pass);
		$this->db->where('user_pass', $encrypted_pass, NULL, FALSE);
		$user = $this->db->get('wpgy_users');
		$result = $user->row();

		if (!$result) {
			echo 'result empty!';
			return FALSE;
		}

		$this->session->set_userdata([self::SESSION_KEY => $result->ID]);

		return $this->session->has_userdata(self::SESSION_KEY);
	}

	public function current_user() {
		if (!$this->session->has_userdata(self::SESSION_KEY)) {
			return null;
		}

		$user_id = $this->session->userdata(self::SESSION_KEY);
		$query = $this->db->get_where('wpgy_users', ['ID' => $user_id]);
		return $query->row();
	}

	public function logout() {
		$this->session->unset_userdata(self::SESSION_KEY);
		return !$this->session->has_userdata(self::SESSION_KEY);
	}
}