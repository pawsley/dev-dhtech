<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Msupplier_model extends CI_Model {

  public function getLastID() {
    $this->db->select('id_supplier');
    $this->db->from('tb_supplier');
    $this->db->order_by('id_supplier', 'desc');
    $this->db->limit(1);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function create($ids, $ns, $wa, $pic, $prov, $kab, $kec, $alamat)
  {
    $data = array(
      'id_supplier' => $ids,
      'nama_supplier' => $ns,
      'kontak' => $wa,
      'pic'=> $pic,
      'provinsi'=> $prov,
      'kabupaten'=> $kab,
      'kecamatan'=> $kec,
      'alamat'=> $alamat,
      'status'=> '1'
    );  
    $this->db->insert('tb_supplier',$data);
  }

  public function delete($id)
  {
    return $this->db->delete('tb_supplier', array("id_supplier" => $id));
  }

  public function update($ids, $ns, $wa, $pic, $prov, $kab, $kec, $alamat)
  {
    $data = [
      'id_supplier' => $ids,
      'nama_supplier' => $ns,
      'kontak' => $wa,
      'pic'=> $pic,
      'provinsi'=> $prov,
      'kabupaten'=> $kab,
      'kecamatan'=> $kec,
      'alamat'=> $alamat
    ];
    $this->db->where('id_supplier', $ids);
    $this->db->update('tb_supplier', $data);
  }

  public function getWhere($id)
  {   
    $query = $this->db->get_where('tb_supplier', array('id_supplier' => $id));
    return $query->result_array();
  }

}

/* End of file Msupplier_model.php */
/* Location: ./application/models/Msupplier_model.php */