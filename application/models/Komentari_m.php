<?php

class Komentari_m extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function insert($creatorUsername , $predID) {
        $data = array(
            'Tekst' => $this->input->post('Tekst'),
            'PredID' => $predID,
            'Username' => $creatorUsername
        );
        $this->db->insert('komentar', $data);
        return $this->db->insert_id();
    }

    public function find($predID) {
        $query = $this->db->get_where('komentar', array('PredID' => $predID));
        return $query->result_array();
    }
    
    public function findIDs($predID) {
        $this->db->select('KomID');
        $query = $this->db->get_where('komentar', array('PredID' => $predID));
        return $query->result_array();
    }

    public function removeOne($id) {
        $this->db->delete('komentar', array('KomID' => $id));
    }

}
