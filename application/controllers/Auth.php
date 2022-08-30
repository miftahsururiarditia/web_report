<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function index()
	{
		$this->load->model('auth_model');
		if ($this->auth_model->current_user()) {
            redirect('report');
        } else {
			$this->login();
		}
	}

    public function login() {
		$this->load->model('auth_model');
		$this->load->library('form_validation');

		$rules = $this->auth_model->rules();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == FALSE) {
			return $this->load->view('login_page');
		}

		$email = $this->input->post('email');
		$pass = $this->input->post('pass');

		if ($this->auth_model->login($email, $pass)) {
			redirect('report');
		} else {
			$this->session->set_flashdata('message_login_error', 'Login Gagal! Mohon periksa username dan password kembali!');
		}

		$this->load->view('login_page');
	}
	
	public function logout() {
		$this->load->model('auth_model');
		$this->auth_model->logout();
		$this->login();
	}
}
