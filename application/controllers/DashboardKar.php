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
			<link rel="stylesheet" type="text/css" href="' . base_url('assets/css/vendors/calendar.css') . '">
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
				#rescheduleShift + .select2-container {
					width: auto !important;
					min-width: 30% !important;
					float: right;
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
				<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
				<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales-all.min.js"></script>
				<script src="' . base_url('assets/js/calendar/fullcalendar-custom.js?v=' . time()) . '"></script>
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
		$this->datatables->select('id_user,nama_lengkap,senin,selasa,rabu,kamis,jumat,sabtu,minggu');
		$this->datatables->from('vkaryawanshift');
		return print_r($this->datatables->generate());
	}
	public function getSettingShift(){
		$this->datatables->select('id,nama,concat(shift_in," - ",shift_out) as waktu_shift');
		$this->datatables->from('tb_user_shift');
		return print_r($this->datatables->generate());
	}
	public function getTimelineAbsen(){
		$this->datatables->select('id_user,nama_lengkap,tanggal_update');
		$this->datatables->from('vfingerlistabsen');
		$this->datatables->where('date(tanggal_update) >=', $this->startDateFormatted);
		$this->datatables->where('date(tanggal_update) <=', $this->endDateFormatted);
		return print_r($this->datatables->generate());
	}
	public function getDetailAbsen($id){
		$this->datatables->select('id_user,nama_lengkap,tanggal,shift,absen_masuk,absen_pulang,durasi_terlambat,durasi_kerja');
		$this->datatables->from('vfingerdetailabsen');
		$this->datatables->where('date(tanggal) >=', $this->startDateFormatted);
		$this->datatables->where('date(tanggal) <=', $this->endDateFormatted);
		$this->datatables->where('id_user',$id);
		return print_r($this->datatables->generate());
	}
	public function getTimelineRest(){
		$this->datatables->select('nama_lengkap,shift,tanggal,durasi_istirahat');
		$this->datatables->from('vfingerdetailistirahat');
		$this->datatables->where('tanggal >=', $this->startDateFormatted);
		$this->datatables->where('tanggal <=', $this->endDateFormatted);
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
		$this->db->select(['id', 'CONCAT(nama, " (", DATE_FORMAT(shift_in, "%H:%i"), " - ", DATE_FORMAT(shift_out, "%H:%i"), ")") AS nama']);
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
	public function saveOrUpdateShiftKaryawan() {
		$id_user  = $this->input->post('id_user');
		$id_shift = $this->input->post('id_shift');
		$work_day = strtolower($this->input->post('work_day')); // normalize to lowercase

		if (!$id_user || !$id_shift || !$work_day) {
			echo json_encode(['status' => 'error', 'message' => 'Invalid data']);
			return;
		}

		// check if already exists
		$exists = $this->db->get_where('tb_finger_schedule', [
			'id_user' => $id_user,
			'work_day' => $work_day
		])->row();

		if ($exists) {
			// update existing record
			$this->db->where('id_user', $id_user);
			$this->db->where('work_day', $work_day);
			$this->db->update('tb_finger_schedule', ['id_shift' => $id_shift]);
		} else {
			// insert new record
			$this->db->insert('tb_finger_schedule', [
				'id_user' => $id_user,
				'id_shift' => $id_shift,
				'work_day' => $work_day
			]);
		}

		echo json_encode(['status' => 'success']);
	}
	public function deleteShiftKaryawan() {
		$id_user  = $this->input->post('id_user');
		$work_day = strtolower($this->input->post('work_day'));

		if (!$id_user || !$work_day) {
			echo json_encode(['status' => 'error', 'message' => 'Invalid data']);
			return;
		}

		$this->db->where('id_user', $id_user);
		$this->db->where('work_day', $work_day);
		$this->db->delete('tb_finger_schedule');

		echo json_encode(['status' => 'success']);
	}
	public function getSchedule() {
		$start = $this->input->get('start'); 
		$end   = $this->input->get('end');   

		// 1. Ambil semua data schedule dari view
		$query = $this->db->query("SELECT * FROM vfingerschedule");
		$schedules = $query->result();

		// Group by user
		$byUser = [];
		foreach ($schedules as $row) {
			$byUser[$row->id_user][] = $row;
		}

		// 2. Expand tiap hari di range
		$events = [];
		$period = new DatePeriod(
			new DateTime($start),
			new DateInterval('P1D'),
			(new DateTime($end))->modify('+1 day')
		);

		foreach ($period as $date) {
			$dayName = $date->format('l');  
			$dateStr = $date->format('Y-m-d');

			foreach ($byUser as $userSchedules) {
				$shift = null;
				$nama_lengkap = null;
				$id_schedule = null;
				$id_user = null;
				$is_rescheduled = 0;
				$chosen = null;

				foreach ($userSchedules as $row) {
					// ✅ Rule 1: reschedule selalu prioritas
					if ($row->reschedule_date === $dateStr) {
						$shift        = $row->reschedule_shift ?: 'OFF';
						$nama_lengkap = $row->nama_lengkap;
						$id_schedule  = $row->id_schedule;
						$id_user      = $row->id_user;
						$is_rescheduled = 1;
						$chosen = $row;
						break; 
					}

					// ✅ Rule 2: base schedule
					if (!$shift && $row->work_day === $dayName && $row->base_shift) {
						$shift        = $row->base_shift;
						$nama_lengkap = $row->nama_lengkap;
						$id_schedule  = $row->id_schedule;
						$id_user      = $row->id_user;
						$is_rescheduled = 0;
						$chosen = $row;
					}
				}

				if ($shift) {
					// mapping warna shift
					$colorMap = [
						'P-1' => 'bg-info text-white border-0',
						'P-2' => 'bg-success text-white border-0',
						'W-1' => 'bg-warning text-white border-0',
						'W-2' => 'bg-primary text-dark border-0',
						'W-3' => 'bg-dark text-white border-0',
						'OFF' => 'bg-danger text-white border-0'
					];

					$className = $colorMap[$shift] ?? 'bg-secondary text-white border-0';

					$events[] = [
						'title' => $nama_lengkap . ' ' . $shift,
						'start' => $dateStr,
						'className' => $className,
						'extendedProps' => [
							'nama_lengkap' => $nama_lengkap,
							'shift'       => $shift,
							'base_shift'  => $chosen->base_shift ?? 'OFF',
							'base_waktu_shift' => $chosen->base_waktu_shift ?? '',
							'reschedule_shift' => $chosen->reschedule_shift ?: 'OFF',
							'reschedule_waktu_shift' => $chosen->reschedule_waktu_shift ?? '',
							'id_schedule' => $id_schedule,
							'id_user'     => $id_user,
							'is_rescheduled' => $is_rescheduled
						]
					];
				} else {
					// ✅ fallback OFF kalau tidak ada schedule sama sekali
					$first = reset($userSchedules);
					$events[] = [
						'title' => $first->nama_lengkap . ' OFF',
						'start' => $dateStr,
						'className' => 'bg-danger text-white border-0',
						'extendedProps' => [
							'nama_lengkap' => $first->nama_lengkap,
							'base_shift'        => 'OFF',
							'id_schedule'  => null,
							'reschedule_shift' => 'OFF',
							'id_user'      => $first->id_user,
							'is_rescheduled' => 0
						]
					];
				}
			}
		}

		echo json_encode($events);
	}
	public function saveReschedule() {
		$id_schedule = $this->input->post('id_schedule');
		$id_user     = $this->input->post('id_user');
		$id_shift    = $this->input->post('id_shift');
		$work_date   = $this->input->post('work_date');
		$note        = $this->input->post('note');

		// Cek apakah sudah ada data dengan user + tanggal yg sama
		$exists = $this->db->get_where('tb_finger_reschedule', [
			'id_user'   => $id_user,
			'work_date' => $work_date
		])->row();

		$data = [
			'id_schedule' => $id_schedule,
			'id_shift'    => $id_shift,
			'note'        => $note,
			'created_at'  => date('Y-m-d H:i:s'),
		];

		if ($exists) {
			// ✅ Update
			$this->db->where('id', $exists->id);
			$this->db->update('tb_finger_reschedule', $data);
			$status = "updated";
		} else {
			// ✅ Insert
			$data['id_user'] = $id_user;
			$data['work_date'] = $work_date;
			$this->db->insert('tb_finger_reschedule', $data);
			$status = "inserted";
		}

		echo json_encode(['status' => $status]);
	}
	public function getRescheduleByDate() {
		$id_user   = $this->input->get('id_user');
		$work_date = $this->input->get('work_date');

		$this->db->select('tb_finger_reschedule.*, COALESCE(CONCAT(tb_user_shift.nama, " (", DATE_FORMAT(tb_user_shift.shift_in, "%H:%i"), " - ", DATE_FORMAT(tb_user_shift.shift_out, "%H:%i"), ")"),"OFF") AS shift_name');
		$this->db->from('tb_finger_reschedule');
		$this->db->join('tb_user_shift', 'tb_user_shift.id = tb_finger_reschedule.id_shift', 'left');
		$this->db->where('tb_finger_reschedule.id_user', $id_user);
		$this->db->where('tb_finger_reschedule.work_date', $work_date);
		$res = $this->db->get()->row();

		if ($res) {
			echo json_encode([
				'exists' => true,
				'id_shift' => $res->id_shift,
				'shift_name' => $res->shift_name,
				'note'     => $res->note,
				'id_schedule' => $res->id_schedule
			]);
		} else {
			echo json_encode(['exists' => false]);
		}
	}

}


/* End of file DashboardKar.php */
/* Location: ./application/controllers/DashboardKar.php */