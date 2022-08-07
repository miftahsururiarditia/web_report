<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function index()
	{
		show_404();
	}

    public function login() {
		$this->load->model('auth_model');
		$this->load->library('form_validation');

		$rules = $this->auth_model->rules();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == FALSE) {
			echo "false";
			return $this->load->view('login_page');
		}

		$email = $this->input->post('email');
		$pass = $this->input->post('pass');

		if ($this->auth_model->login($email, $pass)) {
			redirect('report');
		} else {
			$this->session->set_flashdata('message_login_error', 'Login Gagal, mohon periksa username dan password kembali!');
		}

		$this->load->view('login_page');
		// $user = $this->input->post('email');
		// $pass = $this->input->post('pass');
        // $cek = $this->login_model->cek_user($user, $pass);
		// if ($cek->num_rows() > 0) {
		// 	$newdata = array(
        //            'user' => $user,
        //            'logged_in' => TRUE
        //        );

		// 	$this->session->set_userdata($newdata);
		// 	redirect('dashboard');
		// }
		// else{
		// 	$this->session->set_flashdata('info', 'User atau Password salah!');
		// 	redirect('login');
		// }
	}
	
	public function logout() {
		$this->load->model('auth_model');
		$this->auth_model->logout();
		redirect('login');
	}
}
