<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    function __construct(){
		parent::__construct();
		$this->load->model('login_model');
	}

	public function index()
	{
		$this->load->view('login_page');
	}

    public function cek_user(){
		$user = $this->input->post('user');
		$pass = $this->input->post('pass');
        $cek = $this->login_model->cek_user($user, $pass);
		if ($cek->num_rows() > 0) {
			$newdata = array(
                   'user' => $user,
                   'logged_in' => TRUE
               );

			$this->session->set_userdata($newdata);
			redirect('dashboard');
		}
		else{
			$this->session->set_flashdata('info', 'User atau Password salah!');
			redirect('login');
		}
	}	
}
