<?php
defined('BASEPATH') or exit('No direct script allowed');

class Report extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
    }

    public function index()
    {
        $data['meta'] = ['title' => 'All Report', 'user' => 'Administrator'];
        $this->load->view('all_report', $data);
    }

    public function total_unit()
    {
        $data['meta'] = ['title' => 'Total Unit', 'user' => 'Administrator'];
        $this->load->view('total_unit', $data);
    }

    public function grosscom_sales_consultant()
    {
        $data['meta'] = ['title' => 'Grosscom Sales Consultant', 'user' => 'Administrator'];
        $this->load->view('grosscom_sales_consultant', $data);
    }

    public function ina_office_revenue()
    {
        $data['meta'] = ['title' => 'Ina Office Revenue', 'user' => 'Administrator'];
        $this->load->view('ina_office_revenue', $data);
    }

    public function ina_principal_report()
    {
        $data['meta'] = ['title' => 'Ina Principal Report', 'user' => 'Administrator'];
        $this->load->view('ina_principal_report', $data);
    }

    public function ina_sales_consultant()
    {
        $data['meta'] = ['title' => 'Ina Sales Consultant', 'user' => 'Administrator'];
        $this->load->view('ina_sales_consultant', $data);
    }
}
