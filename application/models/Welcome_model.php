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

  public function countlaba() {
    $this->db->select([
      "(SUM(harga_jual) - COALESCE(SUM(harga_diskon), 0)) as laba_kotor, tgl_transaksi"
    ]);
    $this->db->from('vpenjualan');
    $this->db->where_in('status',[1,2]);
    $this->db->where('MONTH(tgl_transaksi)', $this->currentMonth);
    $this->db->where('YEAR(tgl_transaksi)', $this->currentYear);
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
      "SUM(harga_jual) AS total_penjualan"
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
  public function countTopSales(){
    $this->db->select([
      "SUM(DISTINCT (bayar)) as total_jual, id_ksr, nama_ksr"
    ]);
    $this->db->from('vpenjualan');
    $this->db->where_in('status',[1,2]);
    $this->db->where('MONTH(tgl_transaksi)', $this->currentMonth);
    $this->db->where('YEAR(tgl_transaksi)', $this->currentYear);
    $this->db->group_by('id_ksr');
    $this->db->order_by('total_jual','desc');
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

}

/* End of file Welcome_model.php */
/* Location: ./application/models/Welcome_model.php */