<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once(APPPATH . 'controllers/Auth.php');
class DashboardKar extends Auth
{
    
	public function __construct()
	{
		parent::__construct();
		$this->load->model('BarangKeluar_model');
		$this->load->library('datatables');
	}

	public function index()
	{
			$cab = $this->session->userdata('id_toko');
			$data['barangcabang'] = $this->second->barangCabang($cab);
			$data['setcabang'] = $this->BarangKeluar_model->getCabang();
			$data['content'] = $this->load->view('absensi/dashboardkaryawan', $data, true);
			$data['modal'] = '';
			$data['css'] = '<link rel="stylesheet" type="text/css" href="'.base_url('assets/css/vendors/datatables.css').'">
			<link rel="stylesheet" type="text/css" href="' . base_url('assets/css/vendors/select2.css') . '">
			<link rel="stylesheet" type="text/css" href="'.base_url('assets/css/vendors/sweetalert2.css').'">
			<link rel="stylesheet" type="text/css" href="'.base_url('assets/css/vendors/flatpickr/flatpickr.min.css').'">
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
				margin-bottom :-4%;
				}
			</style>
			';
			$data['js'] = '<script>var base_url = "' . base_url() . '";</script>
				<script src="' . base_url() . 'assets/js/counter/jquery.waypoints.min.js"></script>
				<script src="' . base_url() . 'assets/js/counter/jquery.counterup.min.js"></script>
				<script src="' . base_url() . 'assets/js/counter/counter-custom.js"></script>
				<script src="' . base_url('assets/js/select2/select2.full.min.js') . '"></script>
				<script src="' . base_url('assets/js/additional-js/id.js') . '"></script>
				<script src="' . base_url('assets/js/sweet-alert/sweetalert.min.js').'"></script>
				<script src="' . base_url() . 'assets/js/animation/wow/wow.min.js"></script>
				<script src="' . base_url('assets/js/additional-js/dashkaryawan.js?v='.time()) . '"></script>
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
				<script src="' . base_url('assets/js/flat-pickr/flatpickr.js') . '"></script>
				<script>new WOW().init();</script>';
			$this->load->view('layout/base', $data);	
	}

	public function getFingerData(){
		$this->datatables->select('finger_id,id_user,nama_lengkap,shift,shift_in,shift_out');
		$this->datatables->from('vfingerdata');
		return print_r($this->datatables->generate());
	}
	public function getTimelineAbsen(){
		$this->datatables->select('finger_id,nama_lengkap,shift,absen_at,status_absen');
		$this->datatables->from('vfingerlistabsen');
		return print_r($this->datatables->generate());
	}
	public function getTimelineRest(){
		$this->datatables->select('nama_lengkap,shift,tanggal,durasi_istirahat');
		$this->datatables->from('vfingerdetailistirahat');
		return print_r($this->datatables->generate());
	}
	public function getKaryawanData(){
		$searchTerm = $this->input->get('q');
		$this->db->select(['id_user', 'nama_lengkap']);
		$this->db->from('tb_user');
		if ($searchTerm) {
		$this->db->group_start();
		$this->db->like('id_user', $searchTerm);
		$this->db->or_like('nama_lengkap', $searchTerm);
		$this->db->group_end();
		}
		$query = $this->db->get();
		$results = $query->result_array();
		header('Content-Type: application/json');
		echo json_encode($results);
	}
	public function updateFinger(){
		if ($this->input->is_ajax_request()) {
		$finger_id = $this->input->post('finger_id');
		$id_user = $this->input->post('id_user');

		$data = array(
		'id_user' => $id_user,
		);
		$this->db->where('finger_id', $finger_id);
		$this->db->update('tb_finger', $data);

		echo json_encode(['status' => 'success']);
		} else {
		redirect('dashboard-karyawan');
		}
	}
	public function totalFinger() {
		$this->db->select("COUNT(*) as total_finger");
		$this->db->from('tb_finger');
		$query = $this->db->get();
		
		$result = $query->row();
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	public function totalIstirahat() {
		$this->db->select("COUNT(*) as total_istirahat");
		$this->db->from('vfingerdetailistirahat');
		$query = $this->db->get();
		
		$result = $query->row();
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
}


/* End of file DashboardKar.php */
/* Location: ./application/controllers/DashboardKar.php */