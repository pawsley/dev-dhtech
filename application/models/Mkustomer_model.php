<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mkustomer_model extends CI_Model {


  public function getLastID() {
    $this->db->select('id_plg');
    $this->db->from('tb_pelanggan');
    $this->db->order_by('id_plg', 'desc');
    $this->db->limit(1);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function create($idp, $np, $wa, $email, $alamat)
  {
    $data = array(
      'id_plg' => $idp,
      'nama_plg' => $np,
      'no_ponsel' => $wa,
      'email'=> $email,
      'alamat'=> $alamat
    );  
    $this->db->insert('tb_pelanggan',$data);
  }

  public function delete($id)
  {
    return $this->db->delete('tb_pelanggan', array("id_plg" => $id));
  }

  public function update($idp, $np, $wa, $email, $alamat)
  {
    $data = [
      'id_plg' => $idp,
      'nama_plg' => $np,
      'no_ponsel' => $wa,
      'email'=> $email,
      'alamat'=> $alamat
    ];
    $this->db->where('id_plg', $idp);
    $this->db->update('tb_pelanggan', $data);
  }

  public function getWhere($id)
  {   
    $query = $this->db->get_where('tb_pelanggan', array('id_plg' => $id));
    return $query->result_array();
  }
}

/* End of file Mkustomer_model.php */
/* Location: ./application/models/Mkustomer_model.php */