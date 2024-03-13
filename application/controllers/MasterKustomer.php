<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Don't forget include/define REST_Controller path

class MasterKustomer extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Mkustomer_model');
  }

  function generateid(){
    $data['lastID'] = $this->Mkustomer_model->getLastID();
    if (!empty($data['lastID'])) {
      $numericPart = isset($data['lastID'][0]['id_plg']) ? preg_replace('/[^0-9]/', '', $data['lastID'][0]['id_plg']) : '';
      $incrementedNumericPart = sprintf('%04d', intval($numericPart) + 1);
      $data['newID'] = 'DHCS-' . $incrementedNumericPart;
    }else {
      $data['newID'] = 'DHCS-0001';
    }
    return $data;
  }

  public function index()
  {
    $data = $this->generateid();
    $data['content'] = $this->load->view('master/masterkustomer', $data, true);
    $data['modal'] = '';
    $data['css'] = '<link rel="stylesheet" type="text/css" href="'.base_url('assets/css/vendors/datatables.css').'">
    <link rel="stylesheet" type="text/css" href="'.base_url('assets/css/vendors/sweetalert2.css').'">';
    $data['js'] = '<script>var base_url = "' . base_url() . '";</script>
    <script src="' . base_url('assets/js/additional-js/mkustomer.js') . '"></script>
    <script src="' . base_url('assets/js/sweet-alert/sweetalert.min.js').'"></script>
    <script src="' . base_url('assets/js/modalpage/validation-modal.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatables/jquery.dataTables.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatables/datatable.custom.js') . '"></script>
    ';
    $this->load->view('layout/base', $data);    
  }

  function createpost(){
    $idp = $this->input->post('id');
    $np = $this->input->post('nama');
    $wa = $this->input->post('wa');
    $email = $this->input->post('email');
    $alamat = $this->input->post('alamat');
		
		$this->Mkustomer_model->create($idp, $np, $wa, $email, $alamat);

    redirect('master-kustomer');
  }
  public function edit($id){
    $data['get_id']= $this->Mkustomer_model->getWhere($id);
    echo json_encode($data);
  }
  public function updatepost(){
    if ($this->input->is_ajax_request()) {
      $id = $this->input->post('eid');
      $data = [
        'nama_plg'     => $this->input->post('enama'),
        'no_ponsel'   => $this->input->post('ekontak'),
        'email'    => $this->input->post('emailkus'),
        'alamat'   => $this->input->post('ealamat'),
      ];
      
      $this->Mkustomer_model->update($id, $data);
      echo json_encode(['status' => 'success']);
    } else {
      redirect('master-kustomer');
    }
  }
  public function deletepost($id) {
    $result = $this->Mkustomer_model->delete($id);
    echo json_encode($result);
  }  
  public function jsonkus(){
    $this->load->library('datatables');
    $this->datatables->select('id_plg,nama_plg,no_ponsel,email,alamat');
    $this->datatables->from('tb_pelanggan');
    return print_r($this->datatables->generate());
  }

}


/* End of file MasterKustomer.php */
/* Location: ./application/controllers/MasterKustomer.php */