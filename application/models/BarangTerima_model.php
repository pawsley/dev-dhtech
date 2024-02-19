<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BarangTerima_model extends CI_Model {
    public function approve($sk, $data) {
        $this->db->where('no_surat_keluar', $sk);
        $this->db->update('tb_brg_keluar', $data);
    }
    public function getCabang($searchTerm=null){
        $this->db->select(['id_toko', 'nama_toko']);
        $this->db->from('tb_toko');
        if ($searchTerm) {
            $this->db->group_start();
            $this->db->like('id_toko', $searchTerm);
            $this->db->or_like('nama_toko', $searchTerm);
            $this->db->group_end();
        }
        $query = $this->db->get();
        return $query->result_array();
      }
}

/* End of file BarangTerima_model.php */
/* Location: ./application/models/BarangTerima_model.php */