<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once(APPPATH . 'controllers/Auth.php');
class DashboardKar extends Auth
{
	private $currentDay;
	private $startDateFormatted;
	private $endDateFormatted;
	public function __construct()
	{
		parent::__construct();
		$this->load->model('BarangKeluar_model');
		$this->load->library('datatables');
		$this->currentDay = 27;
		$today = new DateTime();
		if ($today->format('d') > 27) {
			$startDate = (clone $today)->setDate($today->format('Y'), $today->format('m'), 28);
					$endDate = (clone $today)->modify('first day of next month')->setDate($today->format('Y'), $today->format('m') + 1, 27);
		} else {
			$startDate = (clone $today)->modify('first day of last month')->setDate($today->format('Y'), $today->format('m') - 1, 28);
					$endDate = (clone $today)->modify('first day of next month')->setDate($today->format('Y'), $today->format('m'), 27);
		}
		$this->startDateFormatted = $startDate->format('Y-m-d');
		$this->endDateFormatted = $endDate->format('Y-m-d');
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
				margin-bottom :-2%;
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
	
	public function getSettingDenda(){
		$this->datatables->select('id,nominal_denda,durasi_denda,status_denda');
		$this->datatables->from('tb_user_denda');
		return print_r($this->datatables->generate());
	}
	public function getFingerData(){
		$this->datatables->select('finger_id,id_user,nama_lengkap,shift,shift_in,shift_out');
		$this->datatables->from('vfingerdata');
		return print_r($this->datatables->generate());
	}
	public function getDendaKaryawan(){
		$this->datatables->select('nama_lengkap,durasi_terlambat,denda,tanggal');
		$this->datatables->from('vdendakaryawanabsen');
		$this->datatables->where('tanggal >=', $this->startDateFormatted);
		$this->datatables->where('tanggal <=', $this->endDateFormatted);
		$this->datatables->where('denda IS NOT NULL');
		$this->datatables->where('denda >', 0);
		return print_r($this->datatables->generate());
	}
	public function getShiftKaryawan(){
		$this->datatables->select('id_user,nama_lengkap,id,shift');
		$this->datatables->from('vkaryawanshift');
		return print_r($this->datatables->generate());
	}
	public function getSettingShift(){
		$this->datatables->select('id,nama,concat(shift_in," - ",shift_out) as waktu_shift');
		$this->datatables->from('tb_user_shift');
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
	public function getShiftData(){
		$searchTerm = $this->input->get('q');
		$this->db->select(['id', 'nama']);
		$this->db->from('tb_user_shift');
		if ($searchTerm) {
		$this->db->group_start();
		$this->db->like('id', $searchTerm);
		$this->db->or_like('nama', $searchTerm);
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
	public function updateShiftKaryawan(){
		if ($this->input->is_ajax_request()) {
		$id_shift = $this->input->post('id_shift');
		$id_user = $this->input->post('id_user');

		$data = array(
		'id_shift' => $id_shift,
		);
		$this->db->where('id_user', $id_user);
		$this->db->update('tb_user', $data);

		echo json_encode(['status' => 'success']);
		} else {
		redirect('dashboard-karyawan');
		}
	}
	public function addShift(){
		if ($this->input->is_ajax_request()) {

			$data = array(
				'nama' => $this->input->post('nama'),
				'shift_in' => $this->input->post('shift_in'),
				'shift_out' => $this->input->post('shift_out'),
			);
			if ($this->db->insert('tb_user_shift', $data)) {
				echo json_encode(['status' => 'success']);
			} else {
				echo json_encode(['status' => 'error']);
			}
		} 
	}
	public function addDenda(){
		if ($this->input->is_ajax_request()) {

			$data = array(
				'nominal_denda' => $this->input->post('nominal'),
				'durasi_denda' => $this->input->post('durasi'),
				'status_denda' => $this->input->post('status'),
			);
			if ($this->db->insert('tb_user_denda', $data)) {
				echo json_encode(['status' => 'success']);
			} else {
				echo json_encode(['status' => 'error']);
			}
		} 
	}
	public function updateShift(){
		if ($this->input->is_ajax_request()) {
			$id = $this->input->post('id');

			$data = array(
				'nama' => $this->input->post('nama'),
				'shift_in' => $this->input->post('shift_in'),
				'shift_out' => $this->input->post('shift_out'),
			);
			$this->db->where('id', $id);

			if ($this->db->update('tb_user_shift', $data)) {
				echo json_encode(['status' => 'success']);
			} else {
				echo json_encode(['status' => 'error']);
			}
		} 
	}
	public function updateDenda(){
		if ($this->input->is_ajax_request()) {
			$id = $this->input->post('id');

			$data = array(
				'nominal_denda' => $this->input->post('nominal'),
				'durasi_denda' => $this->input->post('durasi'),
				'status_denda' => $this->input->post('status'),
			);
			$this->db->where('id', $id);

			if ($this->db->update('tb_user_denda', $data)) {
				echo json_encode(['status' => 'success']);
			} else {
				echo json_encode(['status' => 'error']);
			}
		} 
	}
	public function deleteShift($id){
		if ($this->input->is_ajax_request()) {
			$this->db->where('id', $id);
			if ($this->db->delete('tb_user_shift')) {
				echo json_encode(['status' => 'success']);
			} else {
				echo json_encode(['status' => 'error']);
			}
		} else {
			redirect('dashboard-karyawan');
		}
	}
	public function deleteDenda($id){
		if ($this->input->is_ajax_request()) {
			$this->db->where('id', $id);
			if ($this->db->delete('tb_user_denda')) {
				echo json_encode(['status' => 'success']);
			} else {
				echo json_encode(['status' => 'error']);
			}
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
	public function totalDenda() {
		$this->db->select("COALESCE(SUM(denda), 0) AS total_denda", FALSE);
		$this->db->from('vdendakaryawanabsen');
		$this->db->where('tanggal >=', $this->startDateFormatted);
		$this->db->where('tanggal <=', $this->endDateFormatted);
		$query = $this->db->get();
		
		$result = $query->row();
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
}


/* End of file DashboardKar.php */
/* Location: ./application/controllers/DashboardKar.php */