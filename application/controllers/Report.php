<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Report extends CI_Controller {
    function __construct(){
		parent::__construct();
		$this->load->model('report_model');
	}

	public function index() {
		$this->load->library('pagination');

		$limit_per_page = 100;
		$offset = html_escape($this->input->get('per_page'));
		$result = $this->report_model->get_data($limit_per_page, $offset);
		$count = $this->report_model->get_count_data()->jumlah;
		$data['result'] = $result;

		$config['base_url'] = site_url('/report');
		$config['page_query_string'] = TRUE;
		$config['total_rows'] = $count;
		$config['per_page'] = $limit_per_page;
		$config['full_tag_open'] = '<div class="pagination">';
  		$config['full_tag_close'] = '</div>';

		$this->pagination->initialize($config);
		
		$this->load->view('report_page', $data);
	}

	public function export() {
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
		$sheet->setCellValue('AD6', "PPN (10%)");
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
		$datum = $this->report_model->get_data_export();
		
		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 8; // Set baris pertama untuk isi tabel adalah baris ke 4

		$no2 = 1;
		$numrow2 = 6;

		$no3 = 1;
		$numrow3 = 9;

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
			$sheet->setCellValue('X'.$numrow, '');
			$sheet->setCellValue('Y'.$numrow, '');
			$sheet->setCellValue('Z'.$numrow, '=+X'.$numrow.'+Y'.$numrow);
			$sheet->setCellValue('AA'.$numrow, '=+X'.$numrow.'*2%');
			$sheet->setCellValue('AB'.$numrow, '=+Z'.$numrow.'+AA'.$numrow);
			$sheet->setCellValue('AC'.$numrow, '=+AB'.$numrow.'*9%');
			$sheet->setCellValue('AD'.$numrow, '=+AC'.$numrow.'*10%');
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
		$sheet->setCellValue('K'.$numrow, '=SUM(K8:K'.$numrow.')');
		$sheet->setCellValue('L'.$numrow, '=SUM(L8:L'.$numrow.')');
		$sheet->setCellValue('S'.$numrow, '=SUM(S8:S'.$numrow.')');
		$sheet->setCellValue('U'.$numrow, '=SUM(U8:U'.$numrow.')');
		$sheet->setCellValue('V'.$numrow, '=SUM(V8:V'.$numrow.')');
		$sheet->setCellValue('W'.$numrow, '=SUM(W8:W'.$numrow.')');
		$sheet->setCellValue('X'.$numrow, '=SUM(X8:X'.$numrow.')');
		$sheet->setCellValue('Y'.$numrow, '=SUM(Y8:Y'.$numrow.')');
		$sheet->setCellValue('Z'.$numrow, '=SUM(Z8:Z'.$numrow.')');
		$sheet->setCellValue('AA'.$numrow, '=SUM(AA8:AA'.$numrow.')');
		$sheet->setCellValue('AB'.$numrow, '=SUM(AB8:AB'.$numrow.')');
		$sheet->setCellValue('AC'.$numrow, '=SUM(AC8:AC'.$numrow.')');
		$sheet->setCellValue('AD'.$numrow, '=SUM(AD8:AD'.$numrow.')');
		$sheet->setCellValue('AE'.$numrow, '=SUM(AE8:AE'.$numrow.')');
		$sheet->setCellValue('AF'.$numrow, '=SUM(AF8:AF'.$numrow.')');
		$sheet->setCellValue('AG'.$numrow, '=SUM(AG8:AG'.$numrow.')');
		$sheet->getStyle('D'.$numrow.':AG'.$numrow)->getFont()->setBold(true);
		
		$sheet2->setCellValue('C'.$numrow2, 'Total');
		$sheet2->setCellValue('D'.$numrow2, '=SUM(D6:D'.$numrow2.')');
		$sheet2->setCellValue('E'.$numrow2, '=SUM(E6:E'.$numrow2.')');
		$sheet2->setCellValue('F'.$numrow2, '=SUM(F6:F'.$numrow2.')');
		$sheet2->getStyle('C'.$numrow2.':F'.$numrow2)->getFont()->setBold(true);
		
		$sheet3->setCellValue('C'.$numrow3, 'Total');
		$sheet3->setCellValue('D'.$numrow3, '=SUM(D9:D'.$numrow3.')');
		$sheet3->setCellValue('E'.$numrow3, '=SUM(E9:E'.$numrow3.')');
		$sheet3->setCellValue('F'.$numrow3, '=SUM(F9:F'.$numrow3.')');
		$sheet3->getStyle('C'.$numrow3.':F'.$numrow3)->getFont()->setBold(true);
		
		// Set orientasi kertas jadi LANDSCAPE
		// $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
		
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
		header('Content-Disposition: attachment; filename="Data Laporan.xlsx"'); // Set nama file excel nya
		// header('Cache-Control: max-age=0');
		
		$writer = new Xlsx($spreadsheet);
		$writer->setPreCalculateFormulas(false);
		$writer->save('php://output');
	}
}
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
