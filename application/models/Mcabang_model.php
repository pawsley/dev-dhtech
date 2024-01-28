<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Mcabang_model extends CI_Model {

  public function __construct()
  {
    parent::__construct();
  }

  public function getLastID() {
    $this->db->select('id_toko');
    $this->db->from('tb_toko');
    $this->db->order_by('id_toko', 'desc');
    $this->db->limit(1);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function getAllKar() {
    $this->db->select(['id_user', 'nama_lengkap']);
    $this->db->from('tb_user');
    $this->db->where_in('status', ['1']);
    $this->db->order_by('id_user', 'asc');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function create($idt, $idk, $nt, $prov, $kab, $kec, $kode, $alamat)
  {
    $data = array(
      'id_toko' => $idt,
      'id_karyawan' => $idk,
      'nama_toko' => $nt,
      'provinsi'=> $prov,
      'kabupaten'=> $kab,
      'kecamatan'=> $kec,
      'kode_pos'=> $kode,
      'alamat' => $alamat,
      'status' => '1'
    );  
    $this->db->insert('tb_toko',$data);
  }

  public function delete($id)
  {
    return $this->db->delete('tb_toko', array("id_toko" => $id));
  }

  public function update($idt, $idk, $nt, $prov, $kab, $kec, $kode, $alamat, $status)
  {
    $data = [
      'id_toko' => $idt,
      'id_karyawan' => $idk,
      'nama_toko' => $nt,
      'provinsi'=> $prov,
      'kabupaten'=> $kab,
      'kecamatan'=> $kec,
      'kode_pos'=> $kode,
      'alamat' => $alamat,
      'status' => $status
    ];
    $this->db->where('id_toko', $idt);
    $this->db->update('tb_toko', $data);
  }

  public function getWhere($id)
  {   
    $query = $this->db->get_where('tb_toko', array('id_toko' => $id));
    return $query->result_array();
  }


}

/* End of file Mcabang_model.php */
/* Location: ./application/models/Mcabang_model.php */