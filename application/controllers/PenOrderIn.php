<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once(APPPATH . 'controllers/Auth.php');
class PenOrderIn extends Auth
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model('PenOrderIn_model');
    $this->load->model('BarangKeluar_model');
  }

  public function index(){
    $cab = $this->session->userdata('id_toko');
    $data['barangcabang'] = $this->second->barangCabang($cab);
    $data['setcabang'] = $this->first->getCabang();
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
    $this->datatables->select('id_keluar,id_toko,kode_penjualan,sn_brg, id_plg, nama_plg, jasa, jml_donasi,
    DATE_FORMAT(tgl_transaksi, "%d %M %Y %H:%i")AS format_tgl,nama_toko,cara_bayar,bayar,
    status,tipe_penjualan,bank_tf,no_rek,total_keranjang,diskon, tunai,bank,kredit,nama_admin,nama_ksr,
    sum(harga_jual) as total_harga_jual, sum(harga_diskon) as total_diskon, sum(harga_cashback) as total_cashback');
    $this->datatables->from('vpenjualan');
    $this->datatables->where_in('status',0);
    $this->datatables->group_by('kode_penjualan');
    return print_r($this->datatables->generate());
  }
  public function detailinv(){
    $inv = $this->input->post('inv');
    $this->load->library('datatables');
    $this->datatables->select('id_keluar,kode_penjualan,sn_brg,nama_brg,jenis,kondisi,harga_jual,harga_diskon,harga_cashback');
    $this->datatables->from('vpenjualan');
    $this->datatables->where_in('status',0);
    if (!empty($inv)) {
      $this->datatables->where('kode_penjualan',$inv);
    }
    return print_r($this->datatables->generate());
  }
  public function detailsales($idt){
    $currentDate = date('Y-m-d');
    $this->load->library('datatables');
    $this->datatables->select('kode_penjualan,sn_brg,nama_brg,
    DATE_FORMAT(tgl_transaksi, "%Y-%m-%d") AS format_tgl,harga_bayar,status,tipe_penjualan,id_toko,nama_admin,nama_ksr');
    $this->datatables->from('vpenjualan');
    $this->datatables->where('id_toko',$idt);
    $this->datatables->where('DATE(tgl_transaksi)', $currentDate);
    $this->datatables->where_in('status',[1,2]);
    return print_r($this->datatables->generate());
  }
  public function filtercab($cab=null){
    $decoded_cab = urldecode($cab);
    $this->load->library('datatables');
    $this->datatables->select('id_keluar,id_toko,kode_penjualan,sn_brg,
    DATE_FORMAT(tgl_transaksi, "%d %M %Y %H:%i")AS format_tgl,nama_toko,cara_bayar,bayar,
    status,tipe_penjualan,bank_tf,no_rek,total_keranjang,diskon, tunai,bank,kredit,
    sum(harga_jual) as total_harga_jual, sum(harga_diskon) as total_diskon, sum(harga_cashback) as total_cashback');
    $this->datatables->from('vpenjualan');
    $this->datatables->where_in('status',0);
    $this->datatables->like('nama_toko', $decoded_cab);
    $this->datatables->group_by('kode_penjualan');
    return print_r($this->datatables->generate());    
  }
  public function datacountHJ($id = null){
    $results = $this->PenOrderIn_model->countHJ($id);
    header('Content-Type: application/json');
    echo json_encode($results);
  }
  public function approve() {
      if (!$this->input->is_ajax_request()) {
          return redirect('order-masuk');
      }

      $inv = $this->input->post('inv', true);

      // Get invoice first
      $current = $this->db->get_where('tb_detail_penjualan', [
          'kode_penjualan' => $inv
      ])->row();

      if (!$current) {
          return $this->output
              ->set_content_type('application/json')
              ->set_output(json_encode(['status' => 'failed', 'message' => 'Invoice tidak ditemukan']));
      }

      // Check status first to prevent double approve/cancel
      if ($current->status != '0') {

          $admin = $this->db->select('nama_lengkap')
                            ->from('tb_user')
                            ->where('id_user', $current->id_admin)
                            ->get()
                            ->row('nama_lengkap');

          $status_text = ($current->status == '2') ? 'disetujui' : 'dibatalkan';

          return $this->output
              ->set_content_type('application/json')
              ->set_output(json_encode([
                  'status' => 'failed',
                  'message' => "Invoice sudah pernah $status_text"
              ]));
      }

      // Get detail for update actions
      $cek_result = $this->db->select('cara_bayar, id_keluar')
                            ->from('vpenjualan')
                            ->where('kode_penjualan', $inv)
                            ->get()->result();

      if (empty($cek_result)) {
          return $this->output
              ->set_content_type('application/json')
              ->set_output(json_encode(['status' => 'failed', 'message' => 'Detail not found']));
      }

      // Start transaction
      $this->db->trans_begin();

      $cara = $cek_result[0]->cara_bayar;

      // Payment type logic
      if ($cara == 'DP') {

          $this->PenOrderIn_model->approve($inv, ['status' => '1']);

      } else if (in_array($cara, ['Transfer', 'Tunai', 'Split Bill'])) {

          $this->PenOrderIn_model->approve($inv, ['status' => '2']);

          // Batch item update
          $id_keluar_list = array_column($cek_result, 'id_keluar');
          $this->db->where_in('id_keluar', $id_keluar_list)
                  ->update('tb_brg_keluar', ['status' => '3']);
      }

      // Commit or rollback
      if ($this->db->trans_status() === FALSE) {
          $this->db->trans_rollback();

          return $this->output
              ->set_content_type('application/json')
              ->set_output(json_encode(['status' => 'failed', 'message' => 'Gagal menyetujui transaksi']));
      }

      $this->db->trans_commit();

      return $this->output
          ->set_content_type('application/json')
          ->set_output(json_encode(['status' => 'success']));
  }
  public function approvegestun() {
    if ($this->input->is_ajax_request()) {
        $inv = $this->input->post('inv');
        $cek_query = "SELECT kode_penjualan, cara_bayar, id_keluar FROM vpenjualan WHERE kode_penjualan = ?";
        $cek_result = $this->db->query($cek_query, array($inv))->result();
        foreach ($cek_result as $row) {
          if ($row->cara_bayar == 'DP') {
            echo json_encode(['status' => 'error']);
            return;
          } else if ($row->cara_bayar == 'Transfer' || $row->cara_bayar == 'Tunai' || $row->cara_bayar == 'Split Bill') {
            $invoice = $row->kode_penjualan;
            $data = ['status' => '9'];
            $datags = ['status' => '9'];
            $this->PenOrderIn_model->approve($invoice, $data);
            $this->PenOrderIn_model->approvegestun($row->id_keluar, $datags);
          }
        }
        echo json_encode(['status' => 'success']);
    } else {
        redirect('order-masuk');
    }
  }
  public function cancel() {
      if (!$this->input->is_ajax_request()) {
          return redirect('order-masuk');
      }

      $inv = $this->input->post('inv', true);

      // Get invoice first
      $current = $this->db->get_where('tb_detail_penjualan', [
          'kode_penjualan' => $inv
      ])->row();

      if (!$current) {
          return $this->output
              ->set_content_type('application/json')
              ->set_output(json_encode(['status' => 'failed', 'message' => 'Invoice tidak ditemukan']));
      }

      // Prevent double cancel/approve
      if ($current->status != '0') {

          $admin = $this->db->select('nama_lengkap')
                            ->from('tb_user')
                            ->where('id_user', $current->id_admin)
                            ->get()
                            ->row('nama_lengkap');

          $status_text = ($current->status == '2') ? 'disetujui' : 'dibatalkan';

          return $this->output
              ->set_content_type('application/json')
              ->set_output(json_encode([
                  'status'  => 'failed',
                  'message' => "Invoice sudah pernah $status_text"
              ]));
      }

      // Get stock + discount detail
      $items = $this->PenOrderIn_model->getidbarang($inv);

      if (empty($items)) {
          return $this->output
              ->set_content_type('application/json')
              ->set_output(json_encode(['status' => 'failed', 'message' => 'Detail barang tidak ditemukan']));
      }

      // Start transaction
      $this->db->trans_begin();

      // Cancel invoice
      $this->PenOrderIn_model->cancel($inv, ['status' => '3']);

      // ✅ Batch restore stock
      $id_keluar_list = array_column($items, 'id_keluar');
      $this->db->where_in('id_keluar', $id_keluar_list)
              ->update('tb_brg_keluar', ['status' => '2']);

      // ✅ Restore discount (cannot batch because values differ per item)
      foreach ($items as $row) {
          if (!empty($row['id_diskon'])) {
              $this->PenOrderIn_model->diskon($row['id_diskon'], [
                  'total_diskon' => $row['total_diskon'],
                  'kuota'        => $row['kuota']
              ]);
          }
      }

      // Commit or rollback
      if ($this->db->trans_status() === FALSE) {
          $this->db->trans_rollback();
          return $this->output
              ->set_content_type('application/json')
              ->set_output(json_encode(['status' => 'failed', 'message' => 'Gagal membatalkan transaksi']));
      }

      $this->db->trans_commit();

      return $this->output
          ->set_content_type('application/json')
          ->set_output(json_encode(['status' => 'success']));
  }
  public function getinv($idkel){
    $results = $this->PenOrderIn_model->getidbarang($idkel);
		header('Content-Type: application/json');
		echo json_encode($results);
  }
}


/* End of file PenOrderIn.php */
/* Location: ./application/controllers/PenOrderIn.php */