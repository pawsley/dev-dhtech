<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once(APPPATH . 'controllers/Auth.php');
class InventoriStok extends Auth
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model('InventoriStok_model');
    $this->load->library('zend');
  }

  public function loadsupp(){
    $searchTerm = $this->input->get('q');
    $results = $this->InventoriStok_model->getSupp($searchTerm);
    header('Content-Type: application/json');
    echo json_encode($results);
  }

  public function loadbrg() {
    $searchTerm = $this->input->get('q');
    $results = $this->InventoriStok_model->getBrg($searchTerm);
    header('Content-Type: application/json');
    echo json_encode($results);    
  }
  public function loadacc() {
    $searchTerm = $this->input->get('q');
    $results = $this->InventoriStok_model->getAcc($searchTerm);
    header('Content-Type: application/json');
    echo json_encode($results);    
  }


  public function loadbm(){
    $this->load->library('datatables');
    $this->datatables->select('id_masuk,tgl_masuk,nama_supplier,sn_brg,no_imei,hrg_hpp,hrg_jual,hrg_cashback,no_fm,nama_brg,spek,kondisi,status');
    $this->datatables->from('vbarangmasuk');
    return print_r($this->datatables->generate());    
  }
  public function gensnacc(){
    $data['lastID'] = $this->InventoriStok_model->getLastKode();
    $numericPart = isset($data['lastID'][0]['sn_brg']) ? preg_replace('/[^0-9]/', '', $data['lastID'][0]['sn_brg']) : '';
    $incrementedNumericPart = sprintf('%04d', intval($numericPart) + 1);
    $data['newID'] = 'ACC-' . $incrementedNumericPart;
    $data['defID'] = 'ACC-0001';
    $this->output->set_content_type('application/json')->set_output(json_encode($data));
  }

  public function bm() {
    $cab = $this->session->userdata('id_toko');
    $data['barangcabang'] = $this->second->barangCabang($cab);
    $data['setcabang'] = $this->first->getCabang();
    $data['content'] = $this->load->view('inventaris/barangmasuk', '', true);
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
    <script src="' . base_url('assets/js/additional-js/ibarangm.js') . '"></script>
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

  public function barcode($sn){
    $this->zend->load('Zend/Barcode');
    $imageResource = Zend_Barcode::factory('code128','image', array('text'=>$sn), array())->draw();
    $imageName = $sn.'.jpg';
        // Define the image path based on the environment
        if ($_SERVER['SERVER_NAME'] == 'localhost') {
          // Path for localhost
          $imagePath = './assets/dhdokumen/snbarcode/';
      } else {
          // Path for server
          $imagePath = $_SERVER['DOCUMENT_ROOT'] . '/assets/dhdokumen/snbarcode/';
      }
    imagejpeg($imageResource, $imagePath.$imageName);    
  }

  public function addmb() {
    if ($this->input->is_ajax_request()) {
      $data = [
        'id_supplier'      => $this->input->post('suppbaru'),
        'id_brg'      => $this->input->post('prodbaru'),
        'tgl_masuk'      => $this->input->post('tglbaru'),
        'no_fm'      => $this->input->post('nofakbaru'),
        'sn_brg'      => $this->input->post('snbaru'),
        'no_imei'      => $this->input->post('imeibaru'),
        'hrg_hpp'      => $this->input->post('hppbaru'),
        'hrg_jual'      => $this->input->post('hjbaru'),
        'spek'      => $this->input->post('spekbaru'),
        'kondisi'      => $this->input->post('kondisi'),
        'status'      => '1',
      ];
      $inserted = $this->InventoriStok_model->create($data);
      if ($inserted) {
        $this->barcode($this->input->post('snbaru'));
        echo json_encode(['status' => 'success']);
      } else {
        echo json_encode(['status' => 'exists']);
      }
    } else {
      redirect('master-barang');
    }
  }

  public function addmk() {
    if ($this->input->is_ajax_request()) {
      $data = [
        'id_supplier'      => $this->input->post('suppbekas'),
        'id_brg'      => $this->input->post('prodbekas'),
        'tgl_masuk'      => $this->input->post('tglbekas'),
        'no_fm'      => $this->input->post('nofakbekas'),
        'sn_brg'      => $this->input->post('snbekas'),
        'no_imei'      => $this->input->post('imeibekas'),
        'hrg_hpp'      => $this->input->post('hppbekas'),
        'hrg_jual'      => $this->input->post('hjbekas'),
        'spek'      => $this->input->post('spekbekas'),
        'kondisi'      => $this->input->post('kondisik'),
        'status'      => '1',
      ];
      $inserted = $this->InventoriStok_model->create($data);
      if ($inserted) {
        $this->barcode($this->input->post('snbekas'));
        echo json_encode(['status' => 'success']);
      } else {
        echo json_encode(['status' => 'exists']);
      }
    } else {
      redirect('master-barang');
    }
  }
  public function addacc() {
    if ($this->input->is_ajax_request()) {
      $data = [
        'id_supplier'      => $this->input->post('suppacc'),
        'id_brg'      => $this->input->post('prodacc'),
        'tgl_masuk'      => $this->input->post('tglacc'),
        'no_fm'      => $this->input->post('nofakacc'),
        'sn_brg'      => $this->input->post('snacc'),
        'hrg_hpp'      => $this->input->post('hppacc'),
        'hrg_jual'      => $this->input->post('hjacc'),
        'kondisi'      => $this->input->post('kondacc'),
        'status'      => '1',
      ];
      $inserted = $this->InventoriStok_model->create($data);
      if ($inserted) {
        $this->barcode($this->input->post('snacc'));
        echo json_encode(['status' => 'success']);
      } else {
        echo json_encode(['status' => 'exists']);
      }
    } else {
      redirect('master-barang');
    }
  }

  public function deletepost($id) {
    // Get the 'sn_brg' value from the database
    $getsn = $this->db->select('sn_brg')->from('tb_brg_masuk')->where('id_masuk', $id)->get();
    $result = $getsn->row(); // Fetch the single row
    $sn_brg = $result->sn_brg; // Extract the 'sn_brg' value
    $deleteResult = $this->InventoriStok_model->delete($id);
    $imagePath = './assets/dhdokumen/snbarcode/';
    $fileName = $imagePath . $sn_brg . '.jpg';
    if (file_exists($fileName)) {
        unlink($fileName);
    }
    echo json_encode($deleteResult);
  }

  public function check(){
    $imagePath = $_SERVER['DOCUMENT_ROOT'] . '/assets/dhdokumen/snbarcode/';
    echo $imagePath;
  }

}


/* End of file InventoriStok.php */
/* Location: ./application/controllers/InventoriStok.php */