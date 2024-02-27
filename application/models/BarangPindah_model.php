<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BarangPindah_model extends CI_Model {
    public function update($id, $data) {
        $this->db->where('id_keluar', $id);
        $this->db->update('tb_brg_keluar', $data);
        // $this->db->update_batch('tb_brg_keluar', $data);
    }
}

/* End of file BarangPindah_model.php */
/* Location: ./application/models/BarangPindah_model.php */