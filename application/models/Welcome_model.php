<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome_model extends CI_Model {

  private $currentDate;
  private $currentYear;
  private $currentMonth;

  public function __construct() {
    $this->currentDate = date('Y-m-d');
    $this->currentYear = date('Y', strtotime($this->currentDate));
    $this->currentMonth = date('m', strtotime($this->currentDate));
  }
  public function countTerjual($id = null) {
    $this->db->select([
      "REPLACE(REPLACE(FORMAT(SUM(vj.harga_bayar), 0), ',', '.'), '.', '.') as total_jual",
        "stores.id_toko", "stores.nama_toko"
    ]);
    $this->db->from('tb_toko AS stores');
    $this->db->join('vbarangkeluar AS v', 'stores.id_toko = v.id_toko', 'LEFT');
    $this->db->join('vpenjualan AS vj', 'v.id_keluar = vj.id_keluar', 'LEFT');
    $this->db->where('MONTH(vj.tgl_transaksi)', $this->currentMonth);
    $this->db->where('YEAR(vj.tgl_transaksi)', $this->currentYear);
    $this->db->where_in('vj.status',[1,2]);
    $this->db->group_by('stores.id_toko');
    if ($id) {
        $this->db->group_start();
        $this->db->like('stores.id_toko', $id);
        $this->db->group_end();
    }
    $query = $this->db->get();
    return $query->result_array();
  }
  public function countlaba() {
    $this->db->select([
      "(SUM(harga_jual) + SUM(DISTINCT jml_donasi) - SUM(harga_diskon) - SUM(harga_cashback)) - SUM(hrg_hpp) as laba_kotor, tgl_transaksi,
      SUM(harga_jual) as total_pen, SUM(harga_diskon) as total_disk, SUM(harga_cashback) total_cb, SUM(hrg_hpp) as total_hpp",
      "COALESCE(SUM(DISTINCT jml_donasi),0) as total_jasa",
      "MONTH(tgl_transaksi) AS bulan","YEAR(tgl_transaksi) AS tahun"
    ]);
    $this->db->from('vpenjualan');
    $this->db->where_in('status',[1,2]);
    $this->db->where('MONTH(tgl_transaksi)', $this->currentMonth);
    $this->db->where('YEAR(tgl_transaksi)', $this->currentYear);
    $query = $this->db->get();
    return $query->result_array();
  }
  public function filtercountlaba($m,$y){
    $this->db->select([
      "COALESCE((SUM(harga_jual) + SUM(DISTINCT jml_donasi) - SUM(harga_diskon) - SUM(harga_cashback)) - SUM(hrg_hpp),0) as laba_kotor, 
      tgl_transaksi,
      COALESCE(SUM(harga_jual),0) as total_pen, 
      COALESCE(SUM(harga_diskon),0) as total_disk, 
      COALESCE(SUM(harga_cashback),0) total_cb, 
      COALESCE(SUM(hrg_hpp),0) as total_hpp,
      COALESCE(SUM(DISTINCT jml_donasi),0) as total_jasa",
    ]);
    $this->db->from('vpenjualan');
    $this->db->where_in('status',[1,2]);
    $this->db->where('MONTH(tgl_transaksi)', $m);
    $this->db->where('YEAR(tgl_transaksi)', $y);
    $query = $this->db->get();
    return $query->result_array();
  }
  public function countasset(){
    $this->db->select([
      "SUM(hrg_hpp) AS total_hpp"
    ]);
    $this->db->from('vbarangkeluar');
    $this->db->where_in('status',[2]);
    $query = $this->db->get();
    return $query->result_array();
  }
  public function countpenjualan(){
    $this->db->select([
      "(SUM(harga_jual) + SUM(DISTINCT jml_donasi) - SUM(harga_diskon) - SUM(harga_cashback))AS total_penjualan",
      "(SUM(harga_jual) - SUM(harga_diskon) - SUM(harga_cashback))AS total_penjualan_no_jasa",
      "COALESCE(SUM(DISTINCT jml_donasi),0) as total_jasa"
    ]);
    $this->db->from('vpenjualan');
    $this->db->where_in('status',[1,2]);
    $this->db->where('MONTH(tgl_transaksi)', $this->currentMonth);
    $this->db->where('YEAR(tgl_transaksi)', $this->currentYear);
    $query = $this->db->get();
    return $query->result_array();
  }
  public function countdiskon(){
    $this->db->select([
      "SUM(harga_diskon) as total_diskon"
    ]);
    $this->db->from('vpenjualan');
    $this->db->where_in('status',[1,2]);
    $this->db->where('MONTH(tgl_transaksi)', $this->currentMonth);
    $this->db->where('YEAR(tgl_transaksi)', $this->currentYear);
    $query = $this->db->get();
    return $query->result_array();
  }
  public function countcust(){
    $this->db->select([
      "COUNT(id_plg) as total_customer"
    ]);
    $this->db->from('tb_pelanggan');
    $query = $this->db->get();
    return $query->result_array();
  }
  public function countcb(){
    $this->db->select([
      "SUM(harga_cashback) as total_cashback","MONTH(tgl_transaksi) AS bulan","YEAR(tgl_transaksi) AS tahun"
    ]);
    $this->db->from('vpenjualan');
    $this->db->where_in('status',[1,2]);
    $this->db->where('MONTH(tgl_transaksi)', $this->currentMonth);
    $this->db->where('YEAR(tgl_transaksi)', $this->currentYear);
    $query = $this->db->get();
    return $query->result_array();
  }
  public function filtercountcb($m,$y){
    $this->db->select([
      "COALESCE(SUM(harga_cashback), 0) as total_cashback"
    ]);
    $this->db->from('vpenjualan');
    $this->db->where_in('status',[1,2]);
    $this->db->where('MONTH(tgl_transaksi)', $m);
    $this->db->where('YEAR(tgl_transaksi)', $y);
    $query = $this->db->get();
    return $query->result_array();
  }
  public function countTopSales(){
    $this->db->select([
      "SUM(harga_bayar) + SUM(DISTINCT jml_donasi) as total_jual", 
      "id_ksr",
      "nama_ksr"
  ]);
    $this->db->from('vpenjualan');
    $this->db->where_in('status',[1,2]);
    $this->db->where('MONTH(tgl_transaksi)', $this->currentMonth);
    $this->db->where('YEAR(tgl_transaksi)', $this->currentYear);
    $this->db->group_by(['id_ksr', 'nama_ksr']);
    $this->db->order_by('total_jual','desc');
    $this->db->limit(5);
    $query = $this->db->get();
    return $query->result_array();
  }
  public function countStockCab(){
    $this->db->select(['id_toko', 'nama_toko','COUNT(id_keluar) as total_produk_toko']);
    $this->db->from('vbarangkeluar');
    $this->db->where_in('status',[2]);
    $this->db->group_by('id_toko');
    $query = $this->db->get();
    return $query->result_array();
  }
  public function countuser() {
    $this->db->select([
      "COUNT(id_user) as total_user"
    ]);
    $this->db->from('tb_user');
    $query = $this->db->get();
    return $query->result_array();
  }
  public function countsupp() {
    $this->db->select([
      "COUNT(id_supplier) as total_supplier"
    ]);
    $this->db->from('tb_supplier');
    $query = $this->db->get();
    return $query->result_array();
  }
  public function updatekar($id, $data) {
    $this->db->where('id_admin', $id);
    $this->db->update('tb_admin', $data);
    // $this->db->update_batch('tb_brg_keluar', $data);
}

}

/* End of file Welcome_model.php */
/* Location: ./application/models/Welcome_model.php */