<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InventoriStok_model extends CI_Model {

  public function getSupp($searchTerm = null) {
    $this->db->select(['id_supplier', 'nama_supplier']);
    $this->db->from('tb_supplier');
    $this->db->where_in('status', ['1']);

    if ($searchTerm) {
        $this->db->group_start();
        $this->db->like('nama_supplier', $searchTerm);
        $this->db->or_like('id_supplier', $searchTerm);
        $this->db->group_end();
    }

    $this->db->order_by('id_supplier', 'asc');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function getBrg($searchTerm = null) {
    $this->db->select(['id_brg', 'merk','jenis','nama_brg']);
    $this->db->from('tb_barang');
    $this->db->where_in('status', ['1']);

    // Add the search conditions if a search term is provided
    if ($searchTerm) {
        $this->db->group_start();
        $this->db->like('id_brg', $searchTerm);
        $this->db->or_like('merk', $searchTerm);
        $this->db->or_like('jenis', $searchTerm);
        $this->db->or_like('nama_brg', $searchTerm);
        $this->db->group_end();
    }

    $this->db->order_by('nama_brg', 'asc');
    $query = $this->db->get();
    return $query->result_array();    
  }

  public function create($data){
    $existingRecord = $this->db->where('sn_brg', $data['sn_brg'])
                        ->get('tb_brg_masuk')
                        ->row();
    if (!$existingRecord) {
        $this->db->insert('tb_brg_masuk', $data);
        return true;
    } else {
        return false;
    }
  }

  public function delete($id)
  {
    $success = $this->db->delete('tb_brg_masuk', array("id_masuk" => $id));
    $message = $success ? 'Data berhasil dihapus' : 'Gagal dihapus';
    return array('success' => $success, 'message' => $message);
  }
}

/* End of file InventoriStok_model.php */
/* Location: ./application/models/InventoriStok_model.php */