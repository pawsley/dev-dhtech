<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PenOrderIn extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model('PenOrderIn_model');
    $this->load->model('BarangKeluar_model');
  }

  public function index(){
    $data['setcabang'] = $this->PenOrderIn_model->countHJ();
    $data['content'] = $this->load->view('kasir/ordermasuk', $data, true);
    $data['modal'] = '';
    $data['css'] = '
    <link rel="stylesheet" type="text/css" href="' . base_url('assets/css/vendors/datatables.css') . '">
    <link rel="stylesheet" type="text/css" href="'.base_url('assets/css/vendors/sweetalert2.css').'">
    <link rel="stylesheet" type="text/css" href="' . base_url('assets/css/vendors/select2.css') . '">
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
    <script src="' . base_url('assets/js/additional-js/porderin.js') . '"></script>
    <script src="' . base_url('assets/js/additional-js/id.js') . '"></script>
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

  public function orderin(){
    $this->load->library('datatables');
    $this->datatables->select('id_keluar,kode_penjualan,sn_brg,DATE_FORMAT(tgl_transaksi, "%d %M %Y %H:%i")AS format_tgl,nama_toko,cara_bayar,bayar,status,tipe_penjualan,nama_rek,total_keranjang,diskon');
    $this->datatables->from('vpenjualan');
    $this->datatables->where_in('status',0);
    $this->datatables->group_by('kode_penjualan');
    return print_r($this->datatables->generate());
  }
  public function detialinv($inv){
    $this->load->library('datatables');
    $this->datatables->select('id_keluar,kode_penjualan,sn_brg,nama_brg,kondisi,harga_jual');
    $this->datatables->from('vpenjualan');
    $this->datatables->where_in('status',0);
    $this->datatables->where('kode_penjualan',$inv);
    return print_r($this->datatables->generate());
  }
  public function detailsales($idt){
    $this->load->library('datatables');
    $currentDate = date('Y-m-d');
    $this->datatables->select('kode_penjualan,sn_brg,nama_brg,
    DATE_FORMAT(tgl_transaksi, "%d %M %Y %H:%i")AS format_tgl,bayar,status,tipe_penjualan,id_toko');
    $this->datatables->from('vpenjualan');
    $this->datatables->where('id_toko',$idt);
    $this->datatables->where('tgl_transaksi', $currentDate);
    $this->datatables->where_in('status',[1,2]);
    return print_r($this->datatables->generate());
  }
  public function filtercab($cab=null){
    $decoded_cab = urldecode($cab);
    $this->load->library('datatables');
    $this->datatables->select('id_keluar,kode_penjualan,sn_brg,DATE_FORMAT(tgl_transaksi, "%d %M %Y %H:%i")AS format_tgl,nama_toko,cara_bayar,bayar,status,tipe_penjualan');
    $this->datatables->from('vpenjualan');
    $this->datatables->where_in('status',0);
    $this->datatables->like('nama_toko', $decoded_cab);
    return print_r($this->datatables->generate());    
  }
  public function datacountHJ($id = null){
    $results = $this->PenOrderIn_model->countHJ($id);
    header('Content-Type: application/json');
    echo json_encode($results);
  }
  public function approve() {
    if ($this->input->is_ajax_request()) {
        $inv = $this->input->post('inv');
        $cek_query = "SELECT cara_bayar, kode_penjualan FROM tb_penjualan WHERE kode_penjualan = ?";
        $cek_result = $this->db->query($cek_query, array($inv))->row();
        if ($cek_result->cara_bayar == 'DP') {
            $invoice = $cek_result->kode_penjualan;
            $data = [
                'status' => '1',
            ];
            $this->PenOrderIn_model->approve($invoice, $data);
            echo json_encode(['status' => 'success']);
        } else if ($cek_result->cara_bayar == 'Transfer' || $cek_result->cara_bayar == 'Tunai' || $cek_result->cara_bayar == 'Trade In') {
            $invoice = $cek_result->kode_penjualan;
            $data = [
                'status' => '2',
            ];
            $this->PenOrderIn_model->approve($invoice, $data);
            echo json_encode(['status' => 'success']);
        }
    } else {
        redirect('order-masuk');
    }
  }
  public function cancel() {
    if ($this->input->is_ajax_request()) {
        $inv = $this->input->post('inv');
        $idk = $this->input->post('idk');
        $data = [
          'status' => '3',
        ];
        $data2 = [
          'status' => '2',
        ];
        $this->PenOrderIn_model->cancel($inv, $data);
        $this->PenOrderIn_model->stok($idk, $data2);
        echo json_encode(['status' => 'success']);
    } else {
        redirect('order-masuk');
    }
  }
}


/* End of file PenOrderIn.php */
/* Location: ./application/controllers/PenOrderIn.php */