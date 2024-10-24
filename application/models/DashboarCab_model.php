<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboarCab_model extends CI_Model {
  private $currentDate;
  private $currentYear;
  private $currentMonth;

  public function __construct() {
    $this->currentDate = date('Y-m-d');
    $this->currentYear = date('Y', strtotime($this->currentDate));
    $this->currentMonth = date('m', strtotime($this->currentDate));
  }
  public function countlaba($cab) {
    $this->db->select([
      "(SUM(harga_jual) + SUM(DISTINCT jml_donasi) - SUM(harga_diskon) - SUM(harga_cashback)) - SUM(hrg_hpp) as laba_kotor, tgl_transaksi,
      SUM(harga_jual) as total_pen, SUM(harga_diskon) as total_disk, SUM(harga_cashback) total_cb, SUM(hrg_hpp) as total_hpp",
      "COALESCE(SUM(DISTINCT jml_donasi),0) as total_jasa",
      "MONTH(tgl_transaksi) AS bulan","YEAR(tgl_transaksi) AS tahun","nama_toko"
    ]);
    $this->db->from('vpenjualan');
    $this->db->where_in('status',[1,2]);
    $this->db->where('id_toko', $cab);
    $this->db->where('MONTH(tgl_transaksi)', $this->currentMonth);
    $this->db->where('YEAR(tgl_transaksi)', $this->currentYear);
    $query = $this->db->get();
    return $query->result_array();
  }
  public function filtercountlaba($cab,$m,$y){
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
    $this->db->where('id_toko', $cab);
    $this->db->where('MONTH(tgl_transaksi)', $m);
    $this->db->where('YEAR(tgl_transaksi)', $y);
    $query = $this->db->get();
    return $query->result_array();
  }
  public function countTopSales($cab){
    $this->db->select([
      "SUM(DISTINCT harga_bayar) + SUM(DISTINCT jml_donasi) as total_jual, id_ksr, nama_ksr"
    ]);
    $this->db->from('vpenjualan');
    $this->db->where('MONTH(tgl_transaksi)', $this->currentMonth);
    $this->db->where('YEAR(tgl_transaksi)', $this->currentYear);
    $this->db->where('id_toko', $cab);
    $this->db->where_in('status',[1,2]);
    $this->db->group_by('id_ksr');
    $this->db->order_by('total_jual','desc');
    $query = $this->db->get();
    return $query->result_array();
  }
  public function countasset($cab){
    $this->db->select([
      "SUM(hrg_hpp) AS total_hpp"
    ]);
    $this->db->from('vbarangkeluar');
    $this->db->where('id_toko',$cab);
    $this->db->where_in('status',[2]);
    $query = $this->db->get();
    return $query->result_array();
  }
  public function countpenjualan($cab){
    $this->db->select([
      "(SUM(harga_jual) + SUM(DISTINCT jml_donasi) - SUM(harga_diskon) - SUM(harga_cashback))AS total_penjualan",
      "(SUM(harga_jual) - SUM(harga_diskon) - SUM(harga_cashback))AS total_penjualan_no_jasa",
      "COALESCE(SUM(DISTINCT jml_donasi),0) as total_jasa"
    ]);
    $this->db->from('vpenjualan');
    $this->db->where_in('status',[1,2]);
    $this->db->where('id_toko', $cab);
    $this->db->where('MONTH(tgl_transaksi)', $this->currentMonth);
    $this->db->where('YEAR(tgl_transaksi)', $this->currentYear);
    $query = $this->db->get();
    return $query->result_array();
  }
  public function countdiskon($cab){
    $this->db->select([
      "SUM(harga_diskon) as total_diskon"
    ]);
    $this->db->from('vpenjualan');
    $this->db->where_in('status',[1,2]);
    $this->db->where('id_toko', $cab);
    $this->db->where('MONTH(tgl_transaksi)', $this->currentMonth);
    $this->db->where('YEAR(tgl_transaksi)', $this->currentYear);
    $query = $this->db->get();
    return $query->result_array();
  }
  public function countcb($cab){
    $this->db->select([
      "SUM(harga_cashback) as total_cashback","MONTH(tgl_transaksi) AS bulan","YEAR(tgl_transaksi) AS tahun","nama_toko"
    ]);
    $this->db->from('vpenjualan');
    $this->db->where_in('status',[1,2]);
    $this->db->where('id_toko', $cab);
    $this->db->where('MONTH(tgl_transaksi)', $this->currentMonth);
    $this->db->where('YEAR(tgl_transaksi)', $this->currentYear);
    $query = $this->db->get();
    return $query->result_array();
  }
  public function filtercountcb($cab,$m,$y){
    $this->db->select([
      "COALESCE(SUM(harga_cashback), 0) as total_cashback"
    ]);
    $this->db->from('vpenjualan');
    $this->db->where_in('status',[1,2]);
    $this->db->where('id_toko', $cab);
    $this->db->where('MONTH(tgl_transaksi)', $m);
    $this->db->where('YEAR(tgl_transaksi)', $y);
    $query = $this->db->get();
    return $query->result_array();
  }
  public function barangCabang($cab){
    $this->db->select(['id_toko', 'nama_toko']);
    $this->db->from('tb_toko');
    $this->db->where('id_toko',$cab);
    $query = $this->db->get();
    return $query->result_array();
  }
}

/* End of file DashboarCab_model.php */
/* Location: ./application/models/DashboarCab_model.php */