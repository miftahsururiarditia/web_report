<?php
defined('BASEPATH') OR exit('No direct script allowed');

class Report extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
    }

    public function index() {
        $this->load->view('all_report');
    }

    public function total_unit() {
        $this->load->view('total_unit');
    }

    public function grosscom_sales_consultant() {
        $this->load->view('grosscom_sales_consultant');
    }

    public function ina_office_revenue() {
        $this->load->view('ina_office_revenue');
    }

    public function ina_principal_report() {
        $this->load->view('ina_principal_report');
    }

    public function ina_sales_consultant() {
        $this->load->view('ina_sales_consultant');
    }
}