<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdiskon_model extends CI_Model {

  public function create($kode, $tipe, $nilai, $kuota, $total)
  {
    $data = array(
      'kode_diskon' => $kode,
      'tipe' => $tipe,
      'nilai' => $nilai,
      'kuota'=> $kuota,
      'total_diskon'=> $total
    );  
    $this->db->insert('tb_diskon',$data);
  }

  public function delete($id)
  {
    return $this->db->delete('tb_diskon', array("kode_diskon" => $id));
  }

  public function update($kode, $tipe, $nilai, $kuota, $total)
  {
    $data = [
      'kode_diskon' => $kode,
      'tipe' => $tipe,
      'nilai' => $nilai,
      'kuota'=> $kuota,
      'total_diskon'=> $total
    ];
    $this->db->where('kode_diskon', $idp);
    $this->db->update('tb_diskon', $data);
  }

  public function getWhere($id)
  {   
    $query = $this->db->get_where('tb_diskon', array('kode_diskon' => $id));
    return $query->result_array();
  }

}

/* End of file Mdiskon_model.php */
/* Location: ./application/models/Mdiskon_model.php */