<?php
defined('BASEPATH') or exit('No direct script access allowed');

require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
include_once(APPPATH . 'controllers/Auth.php');

class StockOpname extends Auth
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model('StockOpname_model');
    $this->load->model('BarangKeluar_model');
  }

  function generateid(){
    $data['lastID'] = $this->StockOpname_model->getLastKode();
    $numericPart = isset($data['lastID'][0]['kode_opname']) ? preg_replace('/[^0-9]/', '', $data['lastID'][0]['kode_opname']) : '';
    $incrementedNumericPart = sprintf('%04d', intval($numericPart) + 1);
    $data['newID'] = 'OPNM-' . $incrementedNumericPart;
    $data['defID'] = 'OPNM-0001';
    $this->output->set_content_type('application/json')->set_output(json_encode($data));
  }

  public function index()
  {
    $data['setcabang'] = $this->BarangKeluar_model->getCabang();
    $data['content'] = $this->load->view('inventaris/stockopname', $data, true);
    $data['modal'] = '';
    $data['css'] = '
    <link rel="stylesheet" type="text/css" href="' . base_url('assets/css/vendors/datatables.css') . '">
    <link rel="stylesheet" type="text/css" href="' . base_url('assets/css/vendors/select2.css') . '">
    <link rel="stylesheet" type="text/css" href="'.base_url('assets/css/vendors/sweetalert2.css').'">
    <style>
        .select2-selection__rendered {
            line-height: 35px !important;
        }
        .select2-container .select2-selection--single {
            height: 38px !important;
            padding: 2px !important;
        }
        .select2-dropdown--below {
          margin-top:-2% !important;
        }
        .select2-selection__arrow {
            height: 37px !important;
        }
        .select2-container{
          margin-bottom :-6%;
        }
    </style>
    ';
    $data['js'] = '
    <script>var base_url = "' . base_url() . '";</script>
    <script src="' . base_url('assets/js/sweet-alert/sweetalert.min.js').'"></script>
    <script src="' . base_url('assets/js/select2/select2.full.min.js') . '"></script>
    <script src="' . base_url('assets/js/additional-js/istockopname.js') . '"></script>
    <script src="' . base_url('assets/js/additional-js/id.js') . '"></script>
    <script src="' . base_url('assets/js/modalpage/validation-modal.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatables/jquery.dataTables.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatables/datatable.custom.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.buttons.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/jszip.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/buttons.colVis.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/vfs_fonts.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.autoFill.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.select.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/buttons.bootstrap4.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/buttons.html5.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.bootstrap4.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.responsive.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/responsive.bootstrap4.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.keyTable.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.colReorder.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.fixedHeader.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.scroller.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/custom.js') . '"></script>
    ';
    $this->load->view('layout/base', $data);
  }
  public function countpm() {
    $results = $this->StockOpname_model->prodm();
    header('Content-Type: application/json');
    echo json_encode($results);
  }
  public function countpk() {
    $results = $this->StockOpname_model->prodk();
    header('Content-Type: application/json');
    echo json_encode($results);
  }
  public function counttotal() {
    $results = $this->StockOpname_model->totalprod();
    header('Content-Type: application/json');
    echo json_encode($results);
  }
  public function loadriwayat() {
    $this->load->library('datatables');
    $this->datatables->select('id_opname,kode_opname, 
    DATE_FORMAT(tgl_opname, "%d-%M-%Y") AS tgl_opname,
    (SELECT COUNT(id_opname) FROM tb_opname_detail WHERE tb_opname_detail.id_opname = vopname.id_opname) AS total_produk,
    nama_lengkap,id_toko,nama_toko,jabatan,status');
    $this->datatables->from('vopname');
    $this->datatables->where('status','2');
    return print_r($this->datatables->generate());
  }
  public function exportexcel($kode_opname){
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', 'NO');
    $sheet->setCellValue('B1', 'SN PRODUK');
    $sheet->setCellValue('C1', 'NAMA PRODUK');
    $sheet->setCellValue('D1', 'MERK');
    $sheet->setCellValue('E1', 'JENIS');
    
    $detailopname = $this->StockOpname_model->getDetailOpname($kode_opname);
    $no = 1;
    $x = 2;
    foreach($detailopname as $row)
    {
      $sheet->setCellValue('A'.$x, $no++);
      $sheet->setCellValue('B'.$x, $row->sn_brg);
      $sheet->setCellValue('C'.$x, $row->nama_brg);
      $sheet->setCellValue('D'.$x, $row->merk);
      $sheet->setCellValue('E'.$x, $row->jenis);
      $x++;
    }
    $writer = new Xlsx($spreadsheet);
    $filename = 'Laporan-Opname';
    
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
  } 
  public function loaddetail($id_opname) {
    $this->load->library('datatables');
    $this->datatables->select('id_keluar,sn_brg,nama_brg,merk,jenis');
    $this->datatables->from('vopname_dtl');
    $this->datatables->where('id_opname',$id_opname);
    return print_r($this->datatables->generate());
  }     

  // function for opnm_new
  public function addstockopname()
  {
    // $data = $this->generateid();
    $data['content'] = $this->load->view('inventaris/opnamebaru', '', true);
    $data['modal'] = '';
    $data['css'] = '
    <link rel="stylesheet" type="text/css" href="' . base_url('assets/css/vendors/datatables.css') . '">
    <link rel="stylesheet" type="text/css" href="' . base_url('assets/css/vendors/select2.css') . '">
    <link rel="stylesheet" type="text/css" href="'.base_url('assets/css/vendors/sweetalert2.css').'">
    <style>
        .select2-selection__rendered {
            line-height: 35px !important;
        }
        .select2-container .select2-selection--single {
            height: 38px !important;
            padding: 2px !important;
        }
        .select2-dropdown--below {
          margin-top:-2% !important;
        }
        .select2-selection__arrow {
            height: 37px !important;
        }
        .select2-container{
          margin-bottom :-6%;
        }
    </style>
    ';
    $data['js'] = '
    <script>var base_url = "' . base_url() . '";</script>
    <script src="' . base_url('assets/js/sweet-alert/sweetalert.min.js').'"></script>
    <script src="' . base_url('assets/js/select2/select2.full.min.js') . '"></script>
    <script src="' . base_url('assets/js/additional-js/iopnamebaru.js') . '"></script>
    <script src="' . base_url('assets/js/additional-js/id.js') . '"></script>
    <script src="' . base_url('assets/js/modalpage/validation-modal.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatables/jquery.dataTables.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatables/datatable.custom.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.buttons.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/jszip.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/buttons.colVis.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/vfs_fonts.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.autoFill.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.select.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/buttons.bootstrap4.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/buttons.html5.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.bootstrap4.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.responsive.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/responsive.bootstrap4.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.keyTable.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.colReorder.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.fixedHeader.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.scroller.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/custom.js') . '"></script>
    ';
    $this->load->view('layout/base', $data);
  }
  public function loadauditor($id) {
    $searchTerm = $this->input->get('q');
    $results = $this->StockOpname_model->getAuditor($id,$searchTerm);
    header('Content-Type: application/json');
    echo json_encode($results);
  }
  public function loadcabang() {
    $searchTerm = $this->input->get('q');
    $results = $this->StockOpname_model->getCabang($searchTerm);
    header('Content-Type: application/json');
    echo json_encode($results);
  }
  public function createpost(){
    if ($this->input->is_ajax_request()) {
      $data = [
        'kode_opname'      => $this->input->post('idstockopname'),
        'tgl_opname'      => $this->input->post('tanggalwaktubarang'),
        'id_toko'      => $this->input->post('cabang'),
        'id_user'      => $this->input->post('auditor'),
        'status'      => '1',
      ];
      
      $this->StockOpname_model->create($data);
      echo json_encode(['status' => 'success']);
    } else {
      redirect('stock-opname');
    }
  }
  public function addpr() {
    if ($this->input->is_ajax_request()) {
      $data = [
        'id_opname'      => $this->input->post('idopname'),
        'id_keluar'      => $this->input->post('idkeluar'),
      ];
      
      $this->StockOpname_model->createpr($data);
      echo json_encode(['status' => 'success']);
    } else {
      redirect('stock-opname');
    }    
  }
  public function loadopnamelist() {
    $this->load->library('datatables');
    $this->datatables->select('id_opname,kode_opname, DATE_FORMAT(tgl_opname, "%d-%M-%Y") AS tgl_opname,nama_lengkap,id_toko,nama_toko,status');
    $this->datatables->from('vopname');
    $this->datatables->where('status','1');
    return print_r($this->datatables->generate());
  }
  public function loadproduklist($id_toko,$tgl) {
    $this->load->library('datatables');
    $this->datatables->select('id_keluar,sn_brg,nama_brg,merk,jenis');
    $this->datatables->from('vprdop');
    $this->datatables->where('id_toko',$id_toko);
    $this->datatables->where("DATE_FORMAT(tgl_opname, '%Y-%m-%d') = '".$tgl."'");
    return print_r($this->datatables->generate());
  }  
  public function getbarang($id){
    $data['get_id']= $this->StockOpname_model->getWhere($id);
    echo json_encode($data);
  }
  public function approveopnm(){
    if ($this->input->is_ajax_request()) {
      $data = [
        'status'      => '2',
      ];
      $this->StockOpname_model->approveop($data);
      echo json_encode(['status' => 'success']);
    } else {
      redirect('stock-opname');
    }
  }
  public function deletepost($id){
    $result = $this->StockOpname_model->delete($id);
    echo json_encode($result);
  }
}


/* End of file StockOpname.php */
/* Location: ./application/controllers/StockOpname.php */