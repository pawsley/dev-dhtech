<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mkategori_model extends CI_Model {

  public function create($kode, $nk)
  {
    $data = array(
      'kode' => $kode,
      'nama_kategori' => $nk
    );  
    $this->db->insert('tb_kategori',$data);
  }

  public function delete($id)
  {
    // return $this->db->delete('tb_kategori', array("id_kategori" => $id));
    $success = $this->db->delete('tb_kategori', array("id_kategori" => $id));
    $message = $success ? 'Data berhasil dihapus' : 'Gagal dihapus';
    return array('success' => $success, 'message' => $message);
  }

}

/* End of file Mkategori_model.php */
/* Location: ./application/models/Mkategori_model.php */