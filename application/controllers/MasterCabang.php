<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Don't forget include/define REST_Controller path


class MasterCabang extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Mcabang_model');
  }

  function generateid(){
    $data['lastID'] = $this->Mcabang_model->getLastID();
    if (!empty($data['lastID'])) {
      $numericPart = isset($data['lastID'][0]['id_toko']) ? preg_replace('/[^0-9]/', '', $data['lastID'][0]['id_toko']) : '';
      $incrementedNumericPart = sprintf('%04d', intval($numericPart) + 1);
      $data['newID'] = 'DHC-' . $incrementedNumericPart;
    }else {
      $data['newID'] = 'DHC-0001';
    }
    return $data;
  }

  public function loadkar(){
    $kar = $this->Mcabang_model->getAllKar();
    header('Content-Type: application/json');
    echo json_encode($kar);
  }

  public function index()
  {
    $data = $this->generateid();
    $data['kacab'] = $this->Mcabang_model->getAllKar();
    $data['content'] = $this->load->view('master/mastercabang', $data, true);
    $data['modal'] = '';
    $data['css'] = '
    <link rel="stylesheet" type="text/css" href="'.base_url('assets/css/vendors/datatables.css').'">
    ';
    $data['js'] = '<script>var base_url = "' . base_url() . '";</script>
    <script src="' . base_url('assets/js/additional-js/rajaongkir.js') . '"></script>
    <script src="' . base_url('assets/js/additional-js/mcabang.js') . '"></script>
    <script src="' . base_url('assets/js/modalpage/validation-modal.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatables/jquery.dataTables.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatables/datatable.custom.js') . '"></script>
    ';
    $this->load->view('layout/base', $data);    
  }

  function createpost(){
    $idt = $this->input->post('id');
    $idk = $this->input->post('kc');
    $nt = $this->input->post('nt');
    $prov = $this->input->post('prov_name');
    $kab = $this->input->post('kab_name');
    $kec = $this->input->post('kec_name');
    $kode = $this->input->post('kode_pos');
    $alamat = $this->input->post('alamat');
		
		$this->Mcabang_model->create($idt, $idk, $nt, $prov, $kab, $kec, $kode, $alamat);

    redirect('master-cabang');
  }

  public function jsoncab(){
    $this->load->library('datatables');
    $this->datatables->select('id_toko,nama_lengkap,nama_toko,provinsi,kabupaten,kecamatan,alamat,status');
    $this->datatables->from('vtoko');
    return print_r($this->datatables->generate());
  }

}


/* End of file MasterCabang.php */
/* Location: ./application/controllers/MasterCabang.php */