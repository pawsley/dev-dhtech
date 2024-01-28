<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function index()
	{
		$data['content'] = $this->load->view('dashboard/index', '', true);
		$data['modal'] = '';
		$data['css'] = '';
		$data['js'] = '<script src="' . base_url() . 'assets/js/chart/apex-chart/apex-chart.js"></script>
			<script src="' . base_url() . 'assets/js/chart/apex-chart/stock-prices.js"></script>
			<script src="' . base_url() . 'assets/js/counter/jquery.waypoints.min.js"></script>
			<script src="' . base_url() . 'assets/js/counter/jquery.counterup.min.js"></script>
			<script src="' . base_url() . 'assets/js/counter/counter-custom.js"></script>
			<script src="' . base_url() . 'assets/js/dashboard/dashboard_2.js"></script>
			<script src="' . base_url() . 'assets/js/animation/wow/wow.min.js"></script>
			<script>new WOW().init();</script>';
		$this->load->view('layout/base', $data);		
	}
	public function finansial()
	{
		$data['content'] = $this->load->view('dashboard/index', '', true);
		$data['modal'] = '';
    	$data['css'] = '';
		$data['js'] = '';
		$this->load->view('layout/base', $data);
	}
	public function produk()
	{
		$data['content'] = $this->load->view('dashboard/index', '', true);
    	$data['css'] = '';
		$data['js'] = '';
		$this->load->view('layout/base', $data);
	}		
}
