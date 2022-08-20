<?php
defined('BASEPATH') or exit('No direct script allowed');

class Report extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
        if (!$this->auth_model->current_user()) {
            redirect('login');
        }
    }

    public function index()
    {
        $login_data = $this->session->userdata('session_data');

        $role_data = array (
            '1' => 'Admin', 
            '2' => 'Agency',
            '3' => 'Agent'
        );

        $user_role = $role_data[$login_data['user_role']];
        $data['meta'] = ['title' => 'All Report', 'user' => $login_data['username'], 'role' => $user_role];
        $this->load->view('all_report', $data);
    }

    public function total_unit()
    {
        $login_data = $this->session->userdata('session_data');

        $role_data = array (
            '1' => 'Admin', 
            '2' => 'Agency',
            '3' => 'Agent'
        );

        $user_role = $role_data[$login_data['user_role']];
        $data['meta'] = ['title' => 'All Report', 'user' => $login_data['username'], 'role' => $user_role];
        $this->load->view('total_unit', $data);
    }

    public function grosscom_sales_consultant()
    {
        $login_data = $this->session->userdata('session_data');

        $role_data = array (
            '1' => 'Admin', 
            '2' => 'Agency',
            '3' => 'Agent'
        );

        $user_role = $role_data[$login_data['user_role']];
        $data['meta'] = ['title' => 'All Report', 'user' => $login_data['username'], 'role' => $user_role];
        $this->load->view('grosscom_sales_consultant', $data);
    }

    public function ina_office_revenue()
    {
        $login_data = $this->session->userdata('session_data');
        
        $role_data = array (
            '1' => 'Admin', 
            '2' => 'Agency',
            '3' => 'Agent'
        );

        $user_role = $role_data[$login_data['user_role']];
        $data['meta'] = ['title' => 'All Report', 'user' => $login_data['username'], 'role' => $user_role];
        $this->load->view('ina_office_revenue', $data);
    }

    public function ina_principal_report()
    {
        $login_data = $this->session->userdata('session_data');
        
        $role_data = array (
            '1' => 'Admin', 
            '2' => 'Agency',
            '3' => 'Agent'
        );

        $user_role = $role_data[$login_data['user_role']];
        $data['meta'] = ['title' => 'All Report', 'user' => $login_data['username'], 'role' => $user_role];
        $this->load->view('ina_principal_report', $data);
    }

    public function ina_sales_consultant()
    {
        $login_data = $this->session->userdata('session_data');
        
        $role_data = array (
            '1' => 'Admin', 
            '2' => 'Agency',
            '3' => 'Agent'
        );

        $user_role = $role_data[$login_data['user_role']];
        $data['meta'] = ['title' => 'All Report', 'user' => $login_data['username'], 'role' => $user_role];
        $this->load->view('ina_sales_consultant', $data);
    }
}
