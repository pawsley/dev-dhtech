<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MasterSupplier extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Msupplier_model');
  }

  function generateid(){
    $data['lastID'] = $this->Msupplier_model->getLastID();
    if (!empty($data['lastID'])) {
      $numericPart = isset($data['lastID'][0]['id_supplier']) ? preg_replace('/[^0-9]/', '', $data['lastID'][0]['id_supplier']) : '';
      $incrementedNumericPart = sprintf('%04d', intval($numericPart) + 1);
      $data['newID'] = 'DHSUPP-' . $incrementedNumericPart;
    }else {
      $data['newID'] = 'DHSUPP-0001';
    }
    return $data;
  }

  public function index()
  {
    $data = $this->generateid();
    $data['content'] = $this->load->view('master/mastersupplier', $data, true);
    $data['modal'] = '';
    $data['css'] = '
    <link rel="stylesheet" type="text/css" href="'.base_url('assets/css/vendors/datatables.css').'">
    ';
    $data['js'] = '<script>var base_url = "' . base_url() . '";</script>
    <script src="' . base_url('assets/js/additional-js/rajaongkir.js') . '"></script>
    <script src="' . base_url('assets/js/additional-js/msupplier.js') . '"></script>
    <script src="' . base_url('assets/js/modalpage/validation-modal.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatables/jquery.dataTables.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatables/datatable.custom.js') . '"></script>
    ';
    $this->load->view('layout/base', $data);    
  }

  function createpost(){
    $ids = $this->input->post('id');
    $ns = $this->input->post('ns');
    $wa = $this->input->post('wa');
    $pic = $this->input->post('pic');
    $prov = $this->input->post('prov_name');
    $kab = $this->input->post('kab_name');
    $kec = $this->input->post('kec_name');
    $alamat = $this->input->post('alamat');
		
		$this->Msupplier_model->create($ids, $ns, $wa, $pic, $prov, $kab, $kec, $alamat);

    redirect('master-supplier');
  }

  public function jsonsup(){
    $this->load->library('datatables');
    $this->datatables->select('id_supplier,nama_supplier,kontak,pic,provinsi,kabupaten,kecamatan,alamat,status');
    $this->datatables->from('tb_supplier');
    return print_r($this->datatables->generate());
  }

}


/* End of file MasterSupplier.php */
/* Location: ./application/controllers/MasterSupplier.php */