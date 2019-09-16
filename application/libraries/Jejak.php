<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jejak {

    public function __get($var) {
        return get_instance()->$var;
    }

    public function add($idPenerima, $aksi, $path) {
        date_default_timezone_set("Asia/Jakarta");
        $data = array(
            "idPenerima" => $idPenerima,
            "aksi" => $aksi,
            "waktu" => date("Y-m-d H-i-s"),
            "path" => $path,
            "statusNotif" => "0",
            );
        $this->db->insert("sys_log", $data);
    }

    public function update($id) {
        $this->db->set("statusNotif", "1", FALSE);
        $this->db->where("logid", $id);
        $this->db->update("sys_log");
    }

    public function getDetail($id) {
        $this->db->where("logid", $id);
        $query = $this->db->get("sys_log");
        return $query->row();
    }

    public function getCount() {
        $iduser = $this->session->userdata("id");
        return $this->db->query("SELECT COUNT(logid) as id FROM sys_log WHERE statusNotif = '0' AND idPenerima = $iduser")->row()->id;
    }

    public function getNotif() {
        $iduser = $this->session->userdata("id");
        $this->db->where('idPenerima =', $iduser);
        $this->db->order_by('logid', 'DESC');
        $this->db->where("statusNotif", "0");
        return $this->db->get("sys_log")->result();
    }

}
