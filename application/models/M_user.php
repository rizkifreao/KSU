<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class M_user extends CI_Model {

    var $table_name = "sys_user";
    var $pk = "userid";
    var $user = "nama";
    var $password = "password";

    function getAll() {
        $query = $this->db->get($this->table_name);
        return $query->result();
    }
    
    function getAllBy($kondisi) {
        $query = $this->db->get_where($this->table_name, $kondisi);
        return $query->result();
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
    
    function login($user,$pass) {
        $this->db->where($this->user, $user);
        $query = $this->db->get($this->table_name);
        if($query->num_rows()){   
            $password = $query->row()->password;
            if($pass == $this->encrypt->decode($password))
                return $query->row();
        }
        return false;
    }
}