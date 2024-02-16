<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class StockOpname_model extends CI_Model {

  public function prodm() {
    $this->db->where_in('status', ['1','2']);
    $query = $this->db->get('vbarangmasuk');
    return $query->num_rows();
  }

}

/* End of file StockOpname_model.php */
/* Location: ./application/models/StockOpname_model.php */