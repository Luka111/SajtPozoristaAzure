<?php

class Vesti_m extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function insert($creatorUsername, $fileName) {
        if (!$creatorUsername || !$this->input->post('naslov') || !$this->input->post('sadrzaj')
        ) {
            return FALSE;
        }
        $data = array(
            'Naslov' => $this->input->post('naslov'),
            'Sadrzaj' => $this->input->post('sadrzaj'),
            'Slika' => $fileName,
            'Username' => $creatorUsername
        );
        return $this->db->insert('vest', $data);
    }

    public function findOne($id) {
        if (!$id) {
            return FALSE;
        }
        $query = $this->db->get_where('vest', array('VestID' => $id));
        return $query->row_array();
    }

    public function find() {
        $this->db->select('VestID, Naslov, Slika');
        $query = $this->db->get('vest');
        return $query->result_array();
    }

    public function removeOne($id) {
        if (!$id) {
            return FALSE;
        }
        $this->db->delete('vest', array('VestId' => $id));
    }

    public function update($fileName) {
        if (!$this->input->post('naslov') || !$this->input->post('sadrzaj')
        ) {
            return FALSE;
        }
        $data = array(
            'Naslov' => $this->input->post('naslov'),
            'Sadrzaj' => $this->input->post('sadrzaj')
        );
        if ($fileName) {
            $data['Slika'] = $fileName;
        }
        $this->db->where('VestID', $this->input->post('VestID'));
        $this->db->update('vest', $data);
    }

}
