<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MasterKaryawan extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Mkaryawan_model');
  }

  function generateid(){
    $data['lastID'] = $this->Mkaryawan_model->getLastID();
    if (!empty($data['lastID'])) {
      $numericPart = preg_replace('/[^0-9]/', '', is_array($data['lastID']));
      $incrementedNumericPart = sprintf('%04d', intval($numericPart) + 1);
      $data['newID'] = 'DHEMP-' . $incrementedNumericPart;
    }else {
      $data['newID'] = 'DHEMP-0001';
    }
    return $data;
  }

  public function index()
  {
    $data = $this->generateid();
    $data['content'] = $this->load->view('master/masterkaryawan', $data, true);
    $data['modal'] = $this->load->view('master/modal/m_editkar','',true);
    $data['css'] = '<link rel="stylesheet" type="text/css" href="'.base_url('assets/css/vendors/datatables.css').'">
    <link rel="stylesheet" type="text/css" href="'.base_url('assets/css/vendors/sweetalert2.css').'">';
    $data['js'] = '<script>var base_url = "' . base_url() . '";</script>
    <script src="' . base_url('assets/js/additional-js/rajaongkir.js') . '"></script>
    <script src="' . base_url('assets/js/additional-js/serverside.js') . '"></script>
    <script src="' . base_url('assets/js/modalpage/validation-modal.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatables/jquery.dataTables.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatables/datatable.custom.js') . '"></script>
    <script src="' . base_url('assets/js/flat-pickr/flatpickr.js') . '"></script>
    <script src="' . base_url('assets/js/flat-pickr/custom-flatpickr.js') . '"></script>
    <script src="' . base_url('assets/js/additional-js/custom-scripts.js') . '"></script>
    <script src="'.base_url('assets/js/sweet-alert/sweetalert.min.js').'"></script>
    ';
    $this->load->view('layout/base', $data);    
  }

  function edit($id){
    $data['get_id']= $this->Mkaryawan_model->getWhere($id);
    echo json_encode($data);
  }

  function createpost(){
    $id = $this->input->post('id');
    $nl = $this->input->post('nl');
    $tl = $this->input->post('tl');
    $jk = $this->input->post('jk');
    $email = $this->input->post('email');
    $password = $this->input->post('password');
    $prov = $this->input->post('prov_name');
    $kab = $this->input->post('kab_name');
    $kec = $this->input->post('kec_name');
    $kode = $this->input->post('kode_pos');
    $alamat = $this->input->post('alamat');
    $wa = $this->input->post('wa');
    $jabatan = $this->input->post('jabatan');
    $role = $this->input->post('role');
    $gaji = str_replace('.', '', $this->input->post('gaji'));
    $cv = "";
        
    $file_path = realpath(APPPATH . '../assets/dhdokumen/karyawan');
    $config['upload_path'] = $file_path;
    $config['allowed_types'] = 'pdf';
    $config['overwrite'] = true;
    $config['file_name'] = $_FILES['cv']['name'];
    $config['max_size'] = 10048;
        
    $this->load->library('upload', $config);
        
    if (!empty($_FILES['cv']['name'])) {
        if ($this->upload->do_upload('cv')) {
            $data1 = $this->upload->data();
            $cv = $data1['file_name'];
        } else {
            $error = $this->upload->display_errors();
            echo "Upload failed: $error";
        }
    } else {
        echo "No file selected for upload.";
    }
		
		$this->Mkaryawan_model->create($id,$nl,$tl,$jk,$email,$password,$prov,$kab,$kec,$kode,$alamat,$wa,$cv,$jabatan,$role,$gaji);
  }
  public function jsonkar(){
    $this->load->library('datatables');
    $this->datatables->select('id_user, nama_lengkap, jabatan, role_user, gaji, file_cv, no_wa, email, password, status');
    $this->datatables->from('tb_user');
    return print_r($this->datatables->generate());
  }

}


/* End of file MasterKaryawan.php */
/* Location: ./application/controllers/MasterKaryawan.php */