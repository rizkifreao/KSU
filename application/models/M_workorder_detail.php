<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class M_workorder_detail extends CI_Model {

    var $table_name = "workorder_detail";
    var $pk = "detailwoid";
    var $sparepart = "sparepartid";

    function getAll() {
        $query = $this->db->get($this->table_name);
        return $query->result();
    }
    
    function getAllBy($kondisi) {
        $query = $this->db->get_where($this->table_name, $kondisi);
        return $query->result();
    }
    
    function getCountSparepart($id, $status = "") {
        $this->db->select_sum("qty","total");
        $this->db->join('workorder', 'workorder.workorderid = '.$this->table_name.'.workorderid');
        if($status)
            $this->db->where("status", $status);
        $this->db->where($this->sparepart, $id);
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