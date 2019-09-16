<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class M_workorder extends CI_Model {

    var $table_name = "workorder";
    var $pk = "workorderid";

    function getAll() {
        $this->db->order_by("tanggal_masuk","desc");
        $query = $this->db->get($this->table_name);
        return $query->result();
    }
    
    function getAllBy($kondisi) {
        $query = $this->db->get_where($this->table_name, $kondisi);
        return $query->result();
    }
    
    function getMax() {
        $this->db->select_max($this->pk);
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