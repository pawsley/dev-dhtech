<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PenList_model extends CI_Model {
  public function countHJ($id = null) {
    $this->db->select([
      "REPLACE(REPLACE(FORMAT(SUM(v.hrg_hpp), 0), ',', '.'), '.', '.') as total_asset",
        "stores.id_toko", "stores.nama_toko"
    ]);
    $this->db->from('vtoko AS stores');
    $this->db->join('vbarangkeluar AS v', 'stores.id_toko = v.id_toko', 'LEFT');
    $this->db->group_by('stores.id_toko');
    $this->db->where_in('v.status',[2]);
    if ($id) {
        $this->db->group_start();
        $this->db->like('stores.id_toko', $id);
        $this->db->group_end();
    }
    $query = $this->db->get();
    return $query->result_array();
  }
  public function getWhere($id){   
    $this->db->select('id_keluar,sn_brg,nama_brg,hrg_hpp,hrg_jual,jenis,merk,spek,kondisi,nama_toko,status');
    $query = $this->db->get_where('vbarangkeluar', array('id_keluar' => $id));
    return $query->result_array();
  }
}

/* End of file PenList_model.php */
/* Location: ./application/models/PenList_model.php */