<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BarangKeluar extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model('BarangKeluar_model');
  }

  public function datacount($id){
    $results = $this->BarangKeluar_model->countBK($id);
    header('Content-Type: application/json');
    echo json_encode($results);
  }

  public function formatsk($id) {
    $data['get_id']= $this->BarangKeluar_model->getWhere($id);
    $data['detail']= $this->BarangKeluar_model->detailprint($id);
    $this->load->view('print/formatsk',$data);
  }

  public function index()
  {
    $data['setcabang'] = $this->BarangKeluar_model->getCabang();
    $data['content'] = $this->load->view('inventaris/barangkeluar', $data, true);
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
          margin-top:-2%; !important;
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
    <script src="' . base_url('assets/js/additional-js/ibarangk.js') . '"></script>
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

  public function loadstore(){
    $searchTerm = $this->input->get('q');
    $results = $this->BarangKeluar_model->getCabang($searchTerm);
    header('Content-Type: application/json');
    echo json_encode($results);
  }

  public function loadbrgb() {
    $searchTerm = $this->input->get('q');
    $results = $this->BarangKeluar_model->getBrgb($searchTerm);
    header('Content-Type: application/json');
    echo json_encode($results);    
  }

  public function loadbrgk() {
    $searchTerm = $this->input->get('q');
    $results = $this->BarangKeluar_model->getBrgk($searchTerm);
    header('Content-Type: application/json');
    echo json_encode($results);    
  }

  public function addmb() {
    if ($this->input->is_ajax_request()) {
      $data = [
        'id_masuk'      => $this->input->post('prodbaru'),
        'id_toko'      => $this->input->post('cabangbaru'),
        'tgl_keluar'      => $this->input->post('tglbaru'),
        'no_surat_keluar'      => $this->input->post('nosuratb'),
        'status'      => '1',
      ];
      $inserted = $this->BarangKeluar_model->create($data);
      if ($inserted) {
        echo json_encode(['status' => 'success']);
      } else {
        echo json_encode(['status' => 'exists']);
      }
    } else {
      redirect('barang-keluar');
    }
  }

  public function addmk() {
    if ($this->input->is_ajax_request()) {
      $data = [
        'id_masuk'      => $this->input->post('prodbekas'),
        'id_toko'      => $this->input->post('cabangbekas'),
        'tgl_keluar'      => $this->input->post('tglbekas'),
        'no_surat_keluar'      => $this->input->post('nosuratk'),
        'status'      => '1',
      ];
      $inserted = $this->BarangKeluar_model->create($data);
      if ($inserted) {
        $this->barcode($this->input->post('snbekas'));
        echo json_encode(['status' => 'success']);
      } else {
        echo json_encode(['status' => 'exists']);
      }
    } else {
      redirect('barang-keluar');
    }
  }

  public function deletepost($id) {
    $result = $this->BarangKeluar_model->delete($id);
    echo json_encode($result);
  }

  public function groupsk(){
    $this->load->library('datatables');
    $this->datatables->select('id_keluar,tgl_keluar, no_surat_keluar, nama_toko, status');
    $this->datatables->from('vbarangkeluar');
    $this->datatables->group_by('no_surat_keluar');
    return print_r($this->datatables->generate());    
  }

  public function loadbk(){
    $this->load->library('datatables');
    $this->datatables->select('id_keluar,tgl_keluar,no_surat_keluar,nama_toko,sn_brg,nama_brg,spek,kondisi,status');
    $this->datatables->from('vbarangkeluar');
    return print_r($this->datatables->generate());    
  }
  public function getsk($ns){
    $this->load->library('datatables');
    $this->datatables->select('id_keluar,tgl_keluar,no_surat_keluar,nama_toko,sn_brg,nama_brg,merk,jenis,spek,kondisi,status');
    $this->datatables->from('vbarangkeluar');
    $this->datatables->where('no_surat_keluar',$ns);
    return print_r($this->datatables->generate());    
  }

  public function getdetailsk($id){
    $data['get_id']= $this->BarangKeluar_model->getWhere($id);
    echo json_encode($data);
  }

}


/* End of file BarangKeluar.php */
/* Location: ./application/controllers/BarangKeluar.php */