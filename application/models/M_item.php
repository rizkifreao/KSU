<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class M_item extends CI_Model {

    var $table_name = "item";
    var $pk = "itemid";

    function getAll() {
        $query = $this->db->get($this->table_name);
        return $query->result();
    }
    
    function getAllBy($kondisi) {
        $query = $this->db->get_where($this->table_name, $kondisi);
        return $query->result();
    }
    
    function getCountSparepart($id) {
        $this->db->select_sum("stokakhir","total");
        $this->db->where($this->pk, $id);
        $query = $this->db->get($this->table_name);
        return $query->row();
    }
    
    function getDetail($id) {
        $this->db->where($this->pk, $id);
        $query = $this->db->get($this->table_name);
        return $query->row();
    }

    function add($data) {
        $this->db->insert($this->table_name, $data);
    }
    
    function update($id, $data) {
        $this->db->where($this->pk, $id);
        $this->db->update($this->table_name, $data);
    }
    
    function delete($id) {
        $this->db->where($this->pk, $id);
        $this->db->delete($this->table_name);
    }
}