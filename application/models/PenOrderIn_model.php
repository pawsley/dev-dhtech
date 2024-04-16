<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PenOrderIn_model extends CI_Model {

  public function countHJ($id = null) {
    $this->db->select([
        'COALESCE(SUM(CASE WHEN v.status IN (1,2) AND DATE(CONVERT_TZ(v.tgl_transaksi, @@global.time_zone, \'+07:00\')) = CURDATE() THEN v.bayar ELSE 0 END), 0) AS total_penjualan',
        'CONVERT_TZ(NOW(), @@global.time_zone, \'+07:00\') AS hari_ini',
        'stores.id_toko', 'stores.nama_toko'
    ]);
    $this->db->from('vtoko AS stores');
    $this->db->join('vpenjualan AS v', 'stores.id_toko = v.id_toko', 'LEFT');
    $this->db->group_by('stores.id_toko');
    if ($id) {
        $this->db->group_start();
        $this->db->like('stores.id_toko', $id);
        $this->db->group_end();
    }
    $query = $this->db->get();
    return $query->result_array();
  }
  public function approve($inv, $data) {
    $this->db->where('kode_penjualan', $inv);
    $this->db->update('tb_penjualan', $data);
  }
  public function cancel($inv, $data) {
    $this->db->where('kode_penjualan', $inv);
    $this->db->update('tb_penjualan', $data);
  }
  public function stok($idk, $data) {
    $this->db->where('id_keluar', $idk);
    $this->db->update('tb_brg_keluar', $data);
  }
}

/* End of file PenOrderIn_model.php */
/* Location: ./application/models/PenOrderIn_model.php */