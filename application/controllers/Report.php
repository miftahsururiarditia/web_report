<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Report extends CI_Controller {
	private $USER_ID;
	private $ROLE_ID;
	private $USER_ROLE;
	private $USER_NAME;

    function __construct(){
		parent::__construct();
		$this->load->model('report_model');
		$this->load->model('auth_model');
        if (!$this->auth_model->current_user()) {
            redirect('login');
        } else {
			$login_data = $this->session->userdata('session_data');

			$role_data = array (
				'1' => 'Admin', 
				'2' => 'Agency',
				'3' => 'Agent'
			);

			$this->USER_ID = $login_data['user_id'];
			$this->ROLE_ID = $login_data['user_role'];
			$this->USER_ROLE = $role_data[$login_data['user_role']];
			$this->USER_NAME = $login_data['username'];
		}
		ini_set('memory_limit', '512M');
	}

	public function index() {
		$data = array();

		$data['meta'] = ['title' => 'Home', 'user' => $this->USER_NAME, 'role' => $this->USER_ROLE];
        $this->load->view('home', $data);
	}

	public function all_report() {
		$this->load->library('pagination');
		$data = array();

		$limit_per_page = 10;
		$offset = $this->input->get('per_page') ? html_escape($this->input->get('per_page')) : 0;
		$data['tgl_awal'] = $this->input->get('tgl_awal') == '' ? date("Y-m-d") : $this->input->get('tgl_awal');
		$data['tgl_akhir'] = $this->input->get('tgl_akhir') == '' ? date("Y-m-d") : $this->input->get('tgl_akhir');
		$result = $this->report_model->get_all_report_data($data['tgl_awal'], $data['tgl_akhir'], FALSE, $this->ROLE_ID, $this->USER_ID, $this->USER_NAME, $limit_per_page, $offset);
		$count = $this->report_model->get_count_all_report_data($data['tgl_awal'], $data['tgl_akhir'], $this->ROLE_ID, $this->USER_ID, $this->USER_NAME);
		$data['result'] = $result;

		$config['base_url'] = site_url('/all_report?tgl_awal='.$data['tgl_awal'].'&tgl_akhir='.$data['tgl_akhir']);
		$config['page_query_string'] = TRUE;
		$config['total_rows'] = $count;
		$config['per_page'] = $limit_per_page;
		$config['full_tag_open'] = '<div class="pagination">';
  		$config['full_tag_close'] = '</div>';

		$this->pagination->initialize($config);
		
		// $this->load->view('report_page', $data);

		$data['meta'] = ['title' => 'All Report', 'user' => $this->USER_NAME, 'role' => $this->USER_ROLE];
        $this->load->view('all_report', $data);
	}

	public function grosscom_sales_consultant()
    {
		$this->load->library('pagination');
		$data = array();

		$limit_per_page = 10;
		$offset = $this->input->get('per_page') ? html_escape($this->input->get('per_page')) : 0;
		$data['tgl_awal'] = $this->input->get('tgl_awal') == '' ? date("Y-m-d") : $this->input->get('tgl_awal');
		$data['tgl_akhir'] = $this->input->get('tgl_akhir') == '' ? date("Y-m-d") : $this->input->get('tgl_akhir');
		$result = $this->report_model->get_data_grosscom($data['tgl_awal'], $data['tgl_akhir'], FALSE, $this->ROLE_ID, $this->USER_ID, $this->USER_NAME, $limit_per_page, $offset);
		$count = $this->report_model->get_count_data_grosscom($data['tgl_awal'], $data['tgl_akhir'], $this->ROLE_ID, $this->USER_ID, $this->USER_NAME);
		$data['result'] = $result;

		$config['base_url'] = site_url('/report/grosscom_sales_consultant?tgl_awal='.$data['tgl_awal'].'&tgl_akhir='.$data['tgl_akhir']);
		$config['page_query_string'] = TRUE;
		$config['total_rows'] = $count;
		$config['per_page'] = $limit_per_page;
		$config['full_tag_open'] = '<div class="pagination">';
  		$config['full_tag_close'] = '</div>';

		$this->pagination->initialize($config);
        $data['meta'] = ['title' => 'Grosscom Sales Consultant', 'user' => $this->USER_NAME, 'role' => $this->USER_ROLE];
        $this->load->view('grosscom_sales_consultant', $data);
    }

	public function total_unit()
    {
		$this->load->library('pagination');
		$data = array();

		$limit_per_page = 10;
		$offset = $this->input->get('per_page') ? html_escape($this->input->get('per_page')) : 0;
		$data['tgl_awal'] = $this->input->get('tgl_awal') == '' ? date("Y-m-d") : $this->input->get('tgl_awal');
		$data['tgl_akhir'] = $this->input->get('tgl_akhir') == '' ? date("Y-m-d") : $this->input->get('tgl_akhir');
		$result = $this->report_model->get_data_total_unit($data['tgl_awal'], $data['tgl_akhir'], FALSE, $this->ROLE_ID, $this->USER_ID, $this->USER_NAME, $limit_per_page, $offset);
		$count = $this->report_model->get_count_data_total_unit($data['tgl_awal'], $data['tgl_akhir'], $this->ROLE_ID, $this->USER_ID, $this->USER_NAME);
		$data['result'] = $result;

		$config['base_url'] = site_url('/report/total_unit?tgl_awal='.$data['tgl_awal'].'&tgl_akhir='.$data['tgl_akhir']);
		$config['page_query_string'] = TRUE;
		$config['total_rows'] = $count;
		$config['per_page'] = $limit_per_page;
		$config['full_tag_open'] = '<div class="pagination">';
  		$config['full_tag_close'] = '</div>';

		$this->pagination->initialize($config);
        $data['meta'] = ['title' => 'Total Unit', 'user' => $this->USER_NAME, 'role' => $this->USER_ROLE];
        $this->load->view('total_unit', $data);
    }

    public function ina_office_revenue()
    {
		$this->load->library('pagination');
		$data = array();

		$limit_per_page = 10;
		$offset = $this->input->get('per_page') ? html_escape($this->input->get('per_page')) : 0;
		$data['tgl_awal'] = $this->input->get('tgl_awal') == '' ? date("Y-m-d") : $this->input->get('tgl_awal');
		$data['tgl_akhir'] = $this->input->get('tgl_akhir') == '' ? date("Y-m-d") : $this->input->get('tgl_akhir');
		$result = $this->report_model->get_data_ina_office_revenue($data['tgl_awal'], $data['tgl_akhir'], FALSE, $this->ROLE_ID, $this->USER_ID, $this->USER_NAME, $limit_per_page, $offset);
		$count = $this->report_model->get_count_ina_office_revenue($data['tgl_awal'], $data['tgl_akhir'], $this->ROLE_ID, $this->USER_ID, $this->USER_NAME);
		$data['result'] = $result;

		$config['base_url'] = site_url('/report/ina_office_revenue?tgl_awal='.$data['tgl_awal'].'&tgl_akhir='.$data['tgl_akhir']);
		$config['page_query_string'] = TRUE;
		$config['total_rows'] = $count;
		$config['per_page'] = $limit_per_page;
		$config['full_tag_open'] = '<div class="pagination">';
  		$config['full_tag_close'] = '</div>';

		$this->pagination->initialize($config);
        $data['meta'] = ['title' => 'Ina Office Revenue', 'user' => $this->USER_NAME, 'role' => $this->USER_ROLE];
        $this->load->view('ina_office_revenue', $data);
    }

    public function ina_sales_consultant()
    {
		$this->load->library('pagination');
		$data = array();

		$limit_per_page = 10;
		$offset = $this->input->get('per_page') ? html_escape($this->input->get('per_page')) : 0;
		$data['tgl_awal'] = $this->input->get('tgl_awal') == '' ? date("Y-m-d") : $this->input->get('tgl_awal');
		$data['tgl_akhir'] = $this->input->get('tgl_akhir') == '' ? date("Y-m-d") : $this->input->get('tgl_akhir');
		$result = $this->report_model->get_data_ina_sales_consultant($data['tgl_awal'], $data['tgl_akhir'], FALSE, $this->ROLE_ID, $this->USER_ID, $this->USER_NAME, $limit_per_page, $offset);
		$count = $this->report_model->get_count_ina_sales_consultant($data['tgl_awal'], $data['tgl_akhir'], $this->ROLE_ID, $this->USER_ID, $this->USER_NAME);
		$data['result'] = $result;

		$config['base_url'] = site_url('/report/ina_sales_consultant?tgl_awal='.$data['tgl_awal'].'&tgl_akhir='.$data['tgl_akhir']);
		$config['page_query_string'] = TRUE;
		$config['total_rows'] = $count;
		$config['per_page'] = $limit_per_page;
		$config['full_tag_open'] = '<div class="pagination">';
  		$config['full_tag_close'] = '</div>';

		$this->pagination->initialize($config);
        $data['meta'] = ['title' => 'Ina Sales Consultant', 'user' => $this->USER_NAME, 'role' => $this->USER_ROLE];
        $this->load->view('ina_sales_consultant', $data);
    }

	public function ina_principal_report()
    {
		$this->load->library('pagination');
		$data = array();

		$limit_per_page = 10;
		$offset = $this->input->get('per_page') ? html_escape($this->input->get('per_page')) : 0;
		$data['tgl_awal'] = $this->input->get('tgl_awal') == '' ? date("Y-m-d") : $this->input->get('tgl_awal');
		$data['tgl_akhir'] = $this->input->get('tgl_akhir') == '' ? date("Y-m-d") : $this->input->get('tgl_akhir');
		$result = $this->report_model->get_data_ina_principal_report($data['tgl_awal'], $data['tgl_akhir'], FALSE, $this->ROLE_ID, $this->USER_ID, $this->USER_NAME, $limit_per_page, $offset);
		$count = $this->report_model->get_count_ina_principal_report($data['tgl_awal'], $data['tgl_akhir'], $this->ROLE_ID, $this->USER_ID, $this->USER_NAME);
		$data['result'] = $result;

		$config['base_url'] = site_url('/report/ina_principal_report?tgl_awal='.$data['tgl_awal'].'&tgl_akhir='.$data['tgl_akhir']);
		$config['page_query_string'] = TRUE;
		$config['total_rows'] = $count;
		$config['per_page'] = $limit_per_page;
		$config['full_tag_open'] = '<div class="pagination">';
  		$config['full_tag_close'] = '</div>';

		$this->pagination->initialize($config);
        $data['meta'] = ['title' => 'Ina Principal Report', 'user' => $this->USER_NAME, 'role' => $this->USER_ROLE];
        $this->load->view('ina_principal_report', $data);
    }

	public function all_report_export($tgl_awal, $tgl_akhir) {
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();    
		
		$sheet->setCellValue('A1', "HARCOURTS INDONESIA");
		$sheet->setCellValue('A2', "FLOW TRANSAKSI");
		// $sheet->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
		$sheet->getStyle('A1:A2')->getFont()->setBold(true); // Set bold kolom A1
		
		// Buat header tabel nya pada baris ke 3
		$sheet->setCellValue('A5', "NO");
		$sheet->mergeCells('A5:A7');
		$sheet->setCellValue('B5', "Sales Consultant");
		$sheet->mergeCells('B5:C5');
		$sheet->setCellValue('B6', "Sales Listing");
		$sheet->setCellValue('C6', "Sales Selling");
		$sheet->mergeCells('B6:B7');
		$sheet->mergeCells('C6:C7');
		$sheet->setCellValue('D5', "Harcourts Office");
		$sheet->mergeCells('D5:D7');
		$sheet->setCellValue('E5', "Alamat Property");
		$sheet->mergeCells('E5:E7');
		$sheet->setCellValue('F5', "Type Transaksi");
		$sheet->mergeCells('F5:G5');
		$sheet->setCellValue('F6', "Jual / Beli");
		$sheet->setCellValue('G6', "Sewa");
		$sheet->mergeCells('F6:F7');
		$sheet->mergeCells('G6:G7');
		$sheet->setCellValue('H5', "Type Pembayaran");
		$sheet->mergeCells('H5:I5');
		$sheet->setCellValue('H6', "Cash");
		$sheet->mergeCells('H6:H7');
		$sheet->setCellValue('I6', "KPR");
		$sheet->mergeCells('I6:J6');
		$sheet->setCellValue('I7', "Plafon");
		$sheet->setCellValue('J7', "Bank");
		$sheet->setCellValue('K5', "Nilai Transaksi");
		$sheet->mergeCells('K5:L5');
		$sheet->setCellValue('K6', "Include PPN (10%)");
		$sheet->setCellValue('L6', "Exclude PPN");
		$sheet->mergeCells('K6:K7');
		$sheet->mergeCells('L6:L7');
		$sheet->setCellValue('M5', "Type Kerjasama Pemasaran");
		$sheet->mergeCells('M5:R5');
		$sheet->setCellValue('M6', "Full");
		$sheet->setCellValue('N6', "Cobrooke");
		$sheet->setCellValue('O6', "Refferal");
		$sheet->setCellValue('P6', "Lead");
		$sheet->setCellValue('Q6', "Commercial");
		$sheet->setCellValue('R6', "Lain");
		$sheet->mergeCells('M6:M7');
		$sheet->mergeCells('N6:N7');
		$sheet->mergeCells('O6:O7');
		$sheet->mergeCells('P6:P7');
		$sheet->mergeCells('Q6:Q7');
		$sheet->mergeCells('R6:R7');
		$sheet->setCellValue('S5', "Net Transaksi");
		$sheet->mergeCells('S5:S7');
		$sheet->setCellValue('T5', "% Comm");
		$sheet->mergeCells('T5:T7');
		$sheet->setCellValue('U5', "UNIT");
		$sheet->mergeCells('U5:W5');
		$sheet->setCellValue('U6', "Jual/Beli");
		$sheet->setCellValue('V6', "Sewa");
		$sheet->setCellValue('W6', "Total");
		$sheet->mergeCells('U6:U7');
		$sheet->mergeCells('V6:V7');
		$sheet->mergeCells('W6:W7');
		$sheet->setCellValue('X5', "Gross Com");
		$sheet->mergeCells('X5:Z5');
		$sheet->setCellValue('X6', "Jual/Beli");
		$sheet->setCellValue('Y6', "Sewa");
		$sheet->setCellValue('Z6', "Total");
		$sheet->mergeCells('X6:X7');
		$sheet->mergeCells('Y6:Y7');
		$sheet->mergeCells('Z6:Z7');
		$sheet->setCellValue('AA5', "Net Com");
		$sheet->mergeCells('AA5:AB5');
		$sheet->setCellValue('AA6', "PPh 23 (2%)");
		$sheet->setCellValue('AB6', "Comm");
		$sheet->mergeCells('AA6:AA7');
		$sheet->mergeCells('AB6:AB7');
		$sheet->setCellValue('AC4', "TERBIT INVOICE");
		$sheet->setCellValue('AC5', "ROYALTI (9%+ppn)");
		$sheet->mergeCells('AC4:AG4');
		$sheet->mergeCells('AC5:AG5');
		$sheet->setCellValue('AC6', "Royalti");
		$sheet->setCellValue('AD6', "PPN (11%)");
		$sheet->setCellValue('AE6', "PPh 23 (15%)");
		$sheet->mergeCells('AC6:AC7');
		$sheet->mergeCells('AD6:AD7');
		$sheet->mergeCells('AE6:AE7');
		$sheet->setCellValue('AF6', "Materai");
		$sheet->setCellValue('AF7', "(Invoice > 5jt)");
		$sheet->setCellValue('AG6', "TOTAL");
		$sheet->mergeCells('AG6:AG7');

		$sheet->getStyle('A4:AG7')->getFont()->setBold(true);

		$sheet2 = $spreadsheet->createSheet();
		$sheet2->setCellValue('B1', "HARCOURTS INDONESIA");
		$sheet2->setCellValue('B2', "National Sales Consultant");
		$sheet2->setCellValue('A5', "NO");
		$sheet2->setCellValue('B5', "Sales Consultant");
		$sheet2->setCellValue('C5', "Harcourts");
		$sheet2->setCellValue('D5', "Gross Com Jual");
		$sheet2->setCellValue('E5', "Gross Com Sewa");
		$sheet2->setCellValue('F5', "TOTAL");
		$sheet2->getStyle('A1:F5')->getFont()->setBold(true);

		$sheet3 = $spreadsheet->createSheet();
		$sheet3->setCellValue('C5', "HARCOURTS INDONESIA - TOTAL UNIT");
		$sheet3->mergeCells('C5:F5');
		$sheet3->setCellValue('A8', "NO");
		$sheet3->setCellValue('B8', "Sales Consultant");
		$sheet3->setCellValue('C8', "Harcourts");
		$sheet3->setCellValue('D8', "Unit Jual");
		$sheet3->setCellValue('E8', "Unit Sewa");
		$sheet3->setCellValue('F8', "TOTAL UNIT");
		$sheet3->getStyle('A1:F8')->getFont()->setBold(true);

		$sheet4 = $spreadsheet->createSheet();
		$sheet4->setCellValue('A1', "HARCOURTS INDONESIA - OFFICE BY REVENUE");
		$sheet4->mergeCells('A1:B1');
		$sheet4->setCellValue('A4', "Harcourts");
		$sheet4->setCellValue('B4', "Rank");
		$sheet4->getStyle('A1:B4')->getFont()->setBold(true);

		$sheet5 = $spreadsheet->createSheet();
		$sheet5->setCellValue('A1', "HARCOURTS INDONESIA - SALES CONSULTANT BY REVENUE");
		$sheet5->mergeCells('A1:D1');
		$sheet5->setCellValue('A4', "Sales Consultant");
		$sheet5->setCellValue('B4', "Harcourts");
		$sheet5->setCellValue('C4', "Career Path");
		$sheet5->setCellValue('D4', "Rank");
		$sheet5->getStyle('A1:D4')->getFont()->setBold(true);

		$sheet6 = $spreadsheet->createSheet();
		$sheet6->setCellValue('A1', "HARCOURTS INDONESIA - PRINCIPAL BY REVENUE");
		$sheet6->mergeCells('A1:C1');
		$sheet6->setCellValue('A4', "Principal Name");
		$sheet6->setCellValue('B4', "Harcourts");
		$sheet6->setCellValue('C4', "Rank");
		$sheet6->getStyle('A1:C4')->getFont()->setBold(true);

		// $limit_per_page = 100;
		// $offset = html_escape($this->input->get('per_page'));
		$datum = $this->report_model->get_all_report_data($tgl_awal, $tgl_akhir, TRUE, $this->ROLE_ID, $this->USER_ID, $this->USER_NAME);
		
		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 8; // Set baris pertama untuk isi tabel adalah baris ke 4

		$no2 = 1;
		$numrow2 = 6;

		$no3 = 1;
		$numrow3 = 9;

		$no4 = 1;
		$numrow4 = 5;

		$no5 = 1;
		$numrow5 = 5;

		$no6 = 1;
		$numrow6 = 5;

		// $row = $this->report_model->count_data_export();
		// $sheet->insertNewRowBefore($numrow, $row);
		foreach($datum as $data) {
			$sheet->setCellValue('A'.$numrow, $no);
			$sheet->setCellValue('B'.$numrow, $data->sales_listing);
			$sheet->setCellValue('C'.$numrow, $data->sales_selling);
			$sheet->setCellValue('D'.$numrow, $data->harcourts_office);
			$sheet->setCellValue('E'.$numrow, $data->alamat_property);
			$sheet->setCellValue('F'.$numrow, $data->tipe_jual);
			$sheet->setCellValue('G'.$numrow, $data->tipe_sewa);
			$sheet->setCellValue('H'.$numrow, '');
			$sheet->setCellValue('I'.$numrow, '');
			$sheet->setCellValue('J'.$numrow, '');
			$sheet->setCellValue('K'.$numrow, $data->include_ppn);
			$sheet->setCellValue('L'.$numrow, '=+K'.$numrow.'/1.1');
			$sheet->setCellValue('M'.$numrow, '');
			$sheet->setCellValue('N'.$numrow, '');
			$sheet->setCellValue('O'.$numrow, '');
			$sheet->setCellValue('P'.$numrow, '');
			$sheet->setCellValue('Q'.$numrow, '');
			$sheet->setCellValue('R'.$numrow, '');
			$sheet->setCellValue('S'.$numrow, '=+L'.$numrow.'*M'.$numrow);
			$sheet->setCellValue('T'.$numrow, '');
			$sheet->setCellValue('U'.$numrow, '');
			$sheet->setCellValue('V'.$numrow, '');
			$sheet->setCellValue('W'.$numrow, '');
			$sheet->setCellValue('X'.$numrow, '=+S'.$numrow.'*T'.$numrow);
			$sheet->setCellValue('Y'.$numrow, '');
			$sheet->setCellValue('Z'.$numrow, '=+X'.$numrow.'+Y'.$numrow);
			$sheet->setCellValue('AA'.$numrow, '=-X'.$numrow.'*2%');
			$sheet->setCellValue('AB'.$numrow, '=+Z'.$numrow.'+AA'.$numrow);
			$sheet->setCellValue('AC'.$numrow, '=+AB'.$numrow.'*9%');
			$sheet->setCellValue('AD'.$numrow, '=+AC'.$numrow.'*11%');
			$sheet->setCellValue('AE'.$numrow, '=-AC'.$numrow.'*15%');
			$sheet->setCellValue('AF'.$numrow, '');
			$sheet->setCellValue('AG'.$numrow, '=+AC'.$numrow.'+AD'.$numrow.'+AE'.$numrow);

			$sheet2->setCellValue('A'.$numrow2, $no2);
			$sheet2->setCellValue('B'.$numrow2, $data->sales_selling);
			$sheet2->setCellValue('C'.$numrow2, $data->harcourts_office);
			$sheet2->setCellValue('D'.$numrow2, "='All Report'!X".$numrow);
			$sheet2->setCellValue('E'.$numrow2, "='All Report'!Y".$numrow);
			$sheet2->setCellValue('F'.$numrow2, '=+D'.$numrow2.'+E'.$numrow2);
			
			$sheet3->setCellValue('A'.$numrow3, $no3);
			$sheet3->setCellValue('B'.$numrow3, $data->sales_selling);
			$sheet3->setCellValue('C'.$numrow3, $data->harcourts_office);
			$sheet3->setCellValue('D'.$numrow3, "='All Report'!U".$numrow);
			$sheet3->setCellValue('E'.$numrow3, "='All Report'!V".$numrow);
			$sheet3->setCellValue('F'.$numrow3, '=+D'.$numrow3.'+E'.$numrow3);
			
			$no++; // Tambah 1 setiap kali looping
			$numrow++; // Tambah 1 setiap kali looping
			$no2++;
			$numrow2++;
			$no3++;
			$numrow3++;
		}

		$sheet->setCellValue('D'.++$numrow, 'Total');
		$sheet->setCellValue('K'.$numrow, '=SUM(K8:K'.intval($numrow-2).')');
		$sheet->setCellValue('L'.$numrow, '=SUM(L8:L'.intval($numrow-2).')');
		$sheet->setCellValue('S'.$numrow, '=SUM(S8:S'.intval($numrow-2).')');
		$sheet->setCellValue('U'.$numrow, '=SUM(U8:U'.intval($numrow-2).')');
		$sheet->setCellValue('V'.$numrow, '=SUM(V8:V'.intval($numrow-2).')');
		$sheet->setCellValue('W'.$numrow, '=SUM(W8:W'.intval($numrow-2).')');
		$sheet->setCellValue('X'.$numrow, '=SUM(X8:X'.intval($numrow-2).')');
		$sheet->setCellValue('Y'.$numrow, '=SUM(Y8:Y'.intval($numrow-2).')');
		$sheet->setCellValue('Z'.$numrow, '=SUM(Z8:Z'.intval($numrow-2).')');
		$sheet->setCellValue('AA'.$numrow, '=SUM(AA8:AA'.intval($numrow-2).')');
		$sheet->setCellValue('AB'.$numrow, '=SUM(AB8:AB'.intval($numrow-2).')');
		$sheet->setCellValue('AC'.$numrow, '=SUM(AC8:AC'.intval($numrow-2).')');
		$sheet->setCellValue('AD'.$numrow, '=SUM(AD8:AD'.intval($numrow-2).')');
		$sheet->setCellValue('AE'.$numrow, '=SUM(AE8:AE'.intval($numrow-2).')');
		$sheet->setCellValue('AF'.$numrow, '=SUM(AF8:AF'.intval($numrow-2).')');
		$sheet->setCellValue('AG'.$numrow, '=SUM(AG8:AG'.intval($numrow-2).')');
		$sheet->getStyle('D'.$numrow.':AG'.$numrow)->getFont()->setBold(true);
		
		$sheet2->setCellValue('C'.$numrow2, 'Total');
		$sheet2->setCellValue('D'.$numrow2, '=SUM(D6:D'.intval($numrow2-1).')');
		$sheet2->setCellValue('E'.$numrow2, '=SUM(E6:E'.intval($numrow2-1).')');
		$sheet2->setCellValue('F'.$numrow2, '=SUM(F6:F'.intval($numrow2-1).')');
		$sheet2->getStyle('C'.$numrow2.':F'.$numrow2)->getFont()->setBold(true);
		
		$sheet3->setCellValue('C'.$numrow3, 'Total');
		$sheet3->setCellValue('D'.$numrow3, '=SUM(D9:D'.intval($numrow3-1).')');
		$sheet3->setCellValue('E'.$numrow3, '=SUM(E9:E'.intval($numrow3-1).')');
		$sheet3->setCellValue('F'.$numrow3, '=SUM(F9:F'.intval($numrow3-1).')');
		$sheet3->getStyle('C'.$numrow3.':F'.$numrow3)->getFont()->setBold(true);
		
		// Set orientasi kertas jadi LANDSCAPE
		// $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
		
		$datum_ina_office_revenue = $this->report_model->get_data_ina_office_revenue($tgl_awal, $tgl_akhir, TRUE, $this->ROLE_ID, $this->USER_ID, $this->USER_NAME);
		foreach($datum_ina_office_revenue as $data_revenue) {
			$sheet4->setCellValue('A'.$numrow4, $data_revenue->harcourts);
			$sheet4->setCellValue('B'.$numrow4, "");
			$numrow4++;
		}

		$datum_ina_sales_consultant = $this->report_model->get_data_ina_sales_consultant($tgl_awal, $tgl_akhir, TRUE, $this->ROLE_ID, $this->USER_ID, $this->USER_NAME);
		foreach($datum_ina_sales_consultant as $data_consultant) {
			$sheet5->setCellValue('A'.$numrow5, $data_consultant->sales_consultant);
			$sheet5->setCellValue('B'.$numrow5, $data_consultant->harcourts);
			$sheet5->setCellValue('C'.$numrow5, "");
			$sheet5->setCellValue('D'.$numrow5, "");
			$numrow5++;
		}

		$datum_ina_pincipal = $this->report_model->get_data_ina_principal_report($tgl_awal, $tgl_akhir, TRUE, $this->ROLE_ID, $this->USER_ID, $this->USER_NAME);
		foreach($datum_ina_pincipal as $data_principal) {
			$sheet6->setCellValue('A'.$numrow6, "");
			$sheet6->setCellValue('B'.$numrow6, $data_principal->harcourts);
			$sheet6->setCellValue('C'.$numrow6, "");
			$numrow6++;
		}

		// Set judul file excel nya
		$sheet->setTitle("All Report");
		$sheet2->setTitle("GrossCom Sales Consultant");
		$sheet3->setTitle("Total Unit");
		$sheet4->setTitle("Ina-Office by Revenue");
		$sheet5->setTitle("Ina Sales Consultant");
		$sheet6->setTitle("Ina - Principal Report");

		$spreadsheet->setActiveSheetIndex(0);
		
		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="All Report.xlsx"'); // Set nama file excel nya
		// header('Cache-Control: max-age=0');
		
		$writer = new Xlsx($spreadsheet);
		$writer->setPreCalculateFormulas(false);
		$writer->save('php://output');
	}

	public function grosscom_sales_consultant_export($tgl_awal, $tgl_akhir) {
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();    
		
		$sheet->setCellValue('B1', "HARCOURTS INDONESIA");
		$sheet->setCellValue('B2', "National Sales Consultant");
		// $sheet->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
		$sheet->getStyle('B1:B2')->getFont()->setBold(true); // Set bold kolom A1
		
		// Buat header tabel nya pada baris ke 3
		$sheet->setCellValue('A5', "NO");
		$sheet->setCellValue('B5', "Sales Consultant");
		$sheet->setCellValue('C5', "Harcourts");
		$sheet->setCellValue('D5', "Gross Com Jual");
		$sheet->setCellValue('E5', "Gross Com Sewa");
		$sheet->setCellValue('F5', "TOTAL");

		$sheet->getStyle('A5:F5')->getFont()->setBold(true);

		$datum = $this->report_model->get_data_grosscom($tgl_awal, $tgl_akhir, TRUE, $this->ROLE_ID, $this->USER_ID, $this->USER_NAME);
		
		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 6; // Set baris pertama untuk isi tabel adalah baris ke 6

		foreach($datum as $data) {
			$sheet->setCellValue('A'.$numrow, $no);
			$sheet->setCellValue('B'.$numrow, $data->sales_consultant);
			$sheet->setCellValue('C'.$numrow, $data->harcourts);
			$sheet->setCellValue('D'.$numrow, $data->grosscom_jual);
			$sheet->setCellValue('E'.$numrow, $data->grosscom_sewa);
			$sheet->setCellValue('F'.$numrow, $data->total);
			
			$no++; // Tambah 1 setiap kali looping
			$numrow++; // Tambah 1 setiap kali looping
		}

		$sheet->setCellValue('C'.$numrow, 'Total');
		$sheet->setCellValue('D'.$numrow, '=SUM(D6:D'.intval($numrow-1).')');
		$sheet->setCellValue('E'.$numrow, '=SUM(E6:E'.intval($numrow-1).')');
		$sheet->setCellValue('F'.$numrow, '=SUM(F6:F'.intval($numrow-1).')');
		$sheet->getStyle('C'.$numrow.':F'.$numrow)->getFont()->setBold(true);
		
		// Set orientasi kertas jadi LANDSCAPE
		// $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
		
		// Set judul file excel nya
		$sheet->setTitle("GrossCom Sales Consultant");

		$spreadsheet->setActiveSheetIndex(0);
		
		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="GrossCom Sales Consultant.xlsx"'); // Set nama file excel nya
		// header('Cache-Control: max-age=0');
		
		$writer = new Xlsx($spreadsheet);
		$writer->setPreCalculateFormulas(false);
		$writer->save('php://output');
	}

	public function total_unit_export($tgl_awal, $tgl_akhir) {
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();    
		
		$sheet->setCellValue('A1', "HARCOURTS INDONESIA");
		$sheet->setCellValue('A2', "Total Unit");
		$sheet->getStyle('A1:A2')->getFont()->setBold(true); // Set bold kolom A1
		$sheet->mergeCells('A1:F1'); // Set Merge Cell pada kolom A1 sampai F1
		$sheet->mergeCells('A2:F2'); // Set Merge Cell pada kolom A2 sampai F2
		
		// Buat header tabel nya pada baris ke 3
		$sheet->setCellValue('A5', "NO");
		$sheet->setCellValue('B5', "Sales Consultant");
		$sheet->setCellValue('C5', "Harcourts");
		$sheet->setCellValue('D5', "Unit Jual");
		$sheet->setCellValue('E5', "Unit Sewa");
		$sheet->setCellValue('F5', "TOTAL");

		$sheet->getStyle('A5:F5')->getFont()->setBold(true);

		$datum = $this->report_model->get_data_total_unit($tgl_awal, $tgl_akhir, TRUE, $this->ROLE_ID, $this->USER_ID, $this->USER_NAME);
		
		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 6; // Set baris pertama untuk isi tabel adalah baris ke 6

		foreach($datum as $data) {
			$sheet->setCellValue('A'.$numrow, $no);
			$sheet->setCellValue('B'.$numrow, $data->sales_consultant);
			$sheet->setCellValue('C'.$numrow, $data->harcourts);
			$sheet->setCellValue('D'.$numrow, $data->unit_jual);
			$sheet->setCellValue('E'.$numrow, $data->unit_sewa);
			$sheet->setCellValue('F'.$numrow, $data->total);
			
			$no++; // Tambah 1 setiap kali looping
			$numrow++; // Tambah 1 setiap kali looping
		}

		$sheet->setCellValue('C'.$numrow, 'Total');
		$sheet->setCellValue('D'.$numrow, '=SUM(D6:D'.intval($numrow-1).')');
		$sheet->setCellValue('E'.$numrow, '=SUM(E6:E'.intval($numrow-1).')');
		$sheet->setCellValue('F'.$numrow, '=SUM(F6:F'.intval($numrow-1).')');
		$sheet->getStyle('C'.$numrow.':F'.$numrow)->getFont()->setBold(true);
		
		// Set orientasi kertas jadi LANDSCAPE
		// $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
		
		// Set judul file excel nya
		$sheet->setTitle("Total Unit");

		$spreadsheet->setActiveSheetIndex(0);
		
		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Total Unit.xlsx"'); // Set nama file excel nya
		// header('Cache-Control: max-age=0');
		
		$writer = new Xlsx($spreadsheet);
		$writer->setPreCalculateFormulas(false);
		$writer->save('php://output');
	}

	public function ina_office_revenue_export($tgl_awal, $tgl_akhir) {
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();    
		
		$sheet->setCellValue('A1', "HARCOURTS INDONESIA - OFFICE BY REVENUE");
		$sheet->setCellValue('A2', "Period $tgl_awal s/d $tgl_akhir");
		$sheet->getStyle('A1:A2')->getFont()->setBold(true); // Set bold kolom A1
		$sheet->mergeCells('A1:B1'); // Set Merge Cell pada kolom A1 sampai F1
		$sheet->mergeCells('A2:B2'); // Set Merge Cell pada kolom A2 sampai F2
		
		// Buat header tabel nya pada baris ke 3
		$sheet->setCellValue('A4', "NO");
		$sheet->setCellValue('B4', "Harcourts");
		$sheet->setCellValue('C4', "Rank");

		$sheet->getStyle('A4:C4')->getFont()->setBold(true);

		$datum = $this->report_model->get_data_ina_office_revenue($tgl_awal, $tgl_akhir, TRUE, $this->ROLE_ID, $this->USER_ID, $this->USER_NAME);
		
		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 5; // Set baris pertama untuk isi tabel adalah baris ke 6

		foreach($datum as $data) {
			$sheet->setCellValue('A'.$numrow, $no);
			$sheet->setCellValue('B'.$numrow, $data->harcourts);
			$sheet->setCellValue('C'.$numrow, '');
			
			$no++; // Tambah 1 setiap kali looping
			$numrow++; // Tambah 1 setiap kali looping
		}
		
		// Set orientasi kertas jadi LANDSCAPE
		// $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
		
		// Set judul file excel nya
		$sheet->setTitle("Ina Office Revenue");

		$spreadsheet->setActiveSheetIndex(0);
		
		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Ina Office Revenue.xlsx"'); // Set nama file excel nya
		// header('Cache-Control: max-age=0');
		
		$writer = new Xlsx($spreadsheet);
		$writer->setPreCalculateFormulas(false);
		$writer->save('php://output');
	}

	public function ina_sales_consultant_export($tgl_awal, $tgl_akhir) {
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();    
		
		$sheet->setCellValue('A1', "HARCOURTS INDONESIA - SALES CONSULTANT BY REVENUE");
		$sheet->setCellValue('A2', "Period $tgl_awal s/d $tgl_akhir");
		$sheet->getStyle('A1:A2')->getFont()->setBold(true); // Set bold kolom A1
		$sheet->mergeCells('A1:E1');
		$sheet->mergeCells('A2:E2');
		
		// Buat header tabel nya pada baris ke 3
		$sheet->setCellValue('A4', "NO");
		$sheet->setCellValue('B4', "Sales Consultant");
		$sheet->setCellValue('C4', "Harcourts");
		$sheet->setCellValue('D4', "Career Path");
		$sheet->setCellValue('E4', "Rank");

		$sheet->getStyle('A4:E4')->getFont()->setBold(true);

		$datum = $this->report_model->get_data_ina_sales_consultant($tgl_awal, $tgl_akhir, TRUE, $this->ROLE_ID, $this->USER_ID, $this->USER_NAME);
		
		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 5; // Set baris pertama untuk isi tabel adalah baris ke 6

		foreach($datum as $data) {
			$sheet->setCellValue('A'.$numrow, $no);
			$sheet->setCellValue('B'.$numrow, $data->sales_consultant);
			$sheet->setCellValue('C'.$numrow, $data->harcourts);
			$sheet->setCellValue('D'.$numrow, '');
			$sheet->setCellValue('E'.$numrow, '');
			
			$no++; // Tambah 1 setiap kali looping
			$numrow++; // Tambah 1 setiap kali looping
		}
		
		// Set orientasi kertas jadi LANDSCAPE
		// $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
		
		// Set judul file excel nya
		$sheet->setTitle("Ina Sales Consultant");

		$spreadsheet->setActiveSheetIndex(0);
		
		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Ina Sales Consultant.xlsx"'); // Set nama file excel nya
		// header('Cache-Control: max-age=0');
		
		$writer = new Xlsx($spreadsheet);
		$writer->setPreCalculateFormulas(false);
		$writer->save('php://output');
	}	

	public function ina_principal_report_export($tgl_awal, $tgl_akhir) {
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();    
		
		$sheet->setCellValue('A1', "HARCOURTS INDONESIA - PRINCIPAL BY REVENUE");
		$sheet->setCellValue('A2', "Period $tgl_awal s/d $tgl_akhir");
		$sheet->getStyle('A1:A2')->getFont()->setBold(true); // Set bold kolom A1
		$sheet->mergeCells('A1:C1');
		$sheet->mergeCells('A2:C2');
		
		// Buat header tabel nya pada baris ke 3
		$sheet->setCellValue('A4', "NO");
		$sheet->setCellValue('B4', "Principal Name");
		$sheet->setCellValue('C4', "Harcourts");
		$sheet->setCellValue('D4', "Rank");

		$sheet->getStyle('A4:D4')->getFont()->setBold(true);

		$datum = $this->report_model->get_data_ina_principal_report($tgl_awal, $tgl_akhir, TRUE, $this->ROLE_ID, $this->USER_ID, $this->USER_NAME);
		
		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 5; // Set baris pertama untuk isi tabel adalah baris ke 6

		foreach($datum as $data) {
			$sheet->setCellValue('A'.$numrow, $no);
			$sheet->setCellValue('B'.$numrow, '');
			$sheet->setCellValue('C'.$numrow, $data->harcourts);
			$sheet->setCellValue('D'.$numrow, '');
			
			$no++; // Tambah 1 setiap kali looping
			$numrow++; // Tambah 1 setiap kali looping
		}
		
		// Set orientasi kertas jadi LANDSCAPE
		// $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
		
		// Set judul file excel nya
		$sheet->setTitle("Ina Principal Report");

		$spreadsheet->setActiveSheetIndex(0);
		
		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Ina Principal Report.xlsx"'); // Set nama file excel nya
		// header('Cache-Control: max-age=0');
		
		$writer = new Xlsx($spreadsheet);
		$writer->setPreCalculateFormulas(false);
		$writer->save('php://output');
	}

}
