<?php

class Auth_model extends CI_Model
{

	const SESSION_KEY = 'user_id';

	public function rules()
	{
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

	public function login($email, $pass)
	{
		$this->db->where('user_email', $email);
		$user = $this->db->get('wpgy_users');
		$result = $user->row();

		if (!password_verify($pass, $result->user_pass)) {
			return false;
		}

		if (!$result) {
			return false;
		}

		$user_role = $this->check_role($result->ID, $email);

		if ($user_role !== '0') {
			$login_data = array(
				'username' => $result->user_nicename,
				'user_id' => $result->ID,
				'user_role' => $user_role,
				'user_email' => $email
			);
			$this->session->set_userdata('session_data', $login_data);
		}
		return $this->session->has_userdata('session_data');
	}

	function isAdmin($id)
	{
		$whitelist_admin = array('13185', '13187', '13461', '13597', '13985', '123456789000');

		if (in_array($id, $whitelist_admin, TRUE)) {
			return true;
		}
		return false;
	}

	function isAgency($email)
	{
		$this->db->where('meta_key', 'agency_email');
		$this->db->where('meta_value', $email);
		$postmeta = $this->db->get('wpgy_postmeta');
		$result_postmeta = $postmeta->row();

		if ($result_postmeta) {
			$this->db->where('ID', $result_postmeta->post_id);
			$posts = $this->db->get('wpgy_posts');
			$result_posts = $posts->row();

			if ($result_posts) {
				return true;
			}
		}

		return false;
	}

	function isAgent($email)
	{
		$this->db->where('meta_key', 'agent_email');
		$this->db->where('meta_value', $email);
		$postmeta = $this->db->get('wpgy_postmeta');
		$result_postmeta = $postmeta->row();

		if ($result_postmeta) {
			$this->db->where('ID', $result_postmeta->post_id);
			$posts = $this->db->get('wpgy_posts');
			$result_posts = $posts->row();

			if ($result_posts) {
				return true;
			}
		}

		return false;
	}

	function check_role($id, $email)
	{
		$is_admin = $this->isAdmin($id);
		if ($is_admin) {
			return '1';
		} else {
			$is_agency = $this->isAgency($email);
			if ($is_agency) {
				return '2';
			} else {
				$is_agent = $this->isAgent($email);
				if ($is_agent) {
					return '3';
				}
			}
		}

		return '0';
	}

	public function current_user()
	{
		if (!$this->session->has_userdata('session_data')) {
			return null;
		}

		return $this->session->has_userdata('session_data');
	}

	public function logout()
	{
		$this->session->unset_userdata('session_data');
		return !$this->session->has_userdata('session_data');
	}
}
