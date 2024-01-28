<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Mkaryawan_model extends CI_Model {


  public function __construct()
  {
    parent::__construct();
  }

  public function create($id,$nl,$tl,$jk,$email,$password,$prov,$kab,$kec,$kode,$alamat,$wa,$cv,$jabatan,$role,$gaji)
  {
    $data = array(
      'id_user' => $id,
      'nama_lengkap' => $nl,
      'tanggal_lahir' => $tl,
      'jen_kel' => $jk,
      'email'=> $email,
      'password'=> $password,
      'provinsi'=> $prov,
      'kabupaten'=> $kab,
      'kecamatan'=> $kec,
      'kode_pos'=> $kode,
      'alamat' => $alamat,
      'no_wa' => $wa,
      'file_cv' => $cv,
      'jabatan' => $jabatan,
      'role_user' => $role,
      'gaji' => $gaji,
      'status' => '1'
    );  
    $this->db->insert('tb_user',$data);
  }

  public function delete($id)
  {
    return $this->db->delete('tb_user', array("id_user" => $id));
  }

  public function update($id,$nl,$tl,$jk,$email,$password,$prov,$kab,$kec,$kode,$alamat,$wa,$cv,$jabatan,$role,$gaji,$status){
    $data = [
      'id_user' => $id,
      'nama_lengkap' => $nl,
      'tanggal_lahir' => $tl,
      'jen_kel' => $jk,
      'email'=> $email,
      'password'=> $password,
      'provinsi'=> $prov,
      'kabupaten'=> $kab,
      'kecamatan'=> $kec,
      'kode_pos'=> $kode,
      'alamat' => $alamat,
      'no_wa' => $wa,
      'file_cv' => $cv,
      'jabatan' => $jabatan,
      'role_user' => $role,
      'gaji' => $gaji,
      'status' => $status
    ];
    $this->db->where('id_user', $id);
    $this->db->update('tb_user', $data);
  }

  public function getWhere($id)
  {   
    $query = $this->db->get_where('tb_user', array('id_user' => $id));
    return $query->result_array();
  }

  public function getLastID() {
    $this->db->select('id_user');
    $this->db->from('tb_user');
    $this->db->order_by('id_user', 'desc');
    $this->db->limit(1);
    $query = $this->db->get();
    return $query->result_array();
  }

}

/* End of file Mkaryawan_model.php */
/* Location: ./application/models/Mkaryawan_model.php */