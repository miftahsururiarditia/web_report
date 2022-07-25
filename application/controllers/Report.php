<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {
    function __construct(){
		parent::__construct();
		$this->load->model('report_model');
	}

	public function index()
	{
		$this->load->view('report_page');
	}
}
