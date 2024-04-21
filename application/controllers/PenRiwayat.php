<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PenRiwayat extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model('PenRiwayat_model');
  }

  public function index(){
    $data['content'] = $this->load->view('kasir/riwayatsales', '', true);
    $data['modal'] = '';
    $data['css'] = '<link rel="stylesheet" type="text/css" href="'.base_url('assets/css/vendors/datatables.css').'">';
    $data['js'] = '<script>var base_url = "' . base_url() . '";</script>
    <script src="' . base_url('assets/js/additional-js/priwayat.js') . '"></script>
    <script src="' . base_url('assets/js/modalpage/validation-modal.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatables/jquery.dataTables.min.js') . '"></script>
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

  public function laporansales() {
    $this->load->library('datatables');
    $this->datatables->select('id_ksr, nama_ksr, CONCAT(id_ksr, " | ", nama_ksr) AS sales, total_penjualan, total_diskon');
    $this->datatables->from('vsales');
    $this->datatables->where_in('status',[1,2]);
    $this->datatables->group_by('id_ksr');
    return print_r($this->datatables->generate());
  }
  public function detailsales($id) {
    $this->load->library('datatables');
    $this->datatables->select('kode_penjualan,sn_brg,nama_brg,harga_jual,diskon,(harga_jual - diskon) as harga_ril');
    $this->datatables->from('vpenjualan');
    $this->datatables->where_in('status',[1,2]);
    $this->datatables->where('id_ksr',$id);
    return print_r($this->datatables->generate());
  }

}


/* End of file PenRiwayat.php */
/* Location: ./application/controllers/PenRiwayat.php */