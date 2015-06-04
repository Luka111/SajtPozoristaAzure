<?php

class Pozorista_m extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function insert($creatorUsername, $fileName) {
        if (!$creatorUsername
                || !$this->input->post('naziv')
                || !$this->input->post('adresa')
                || !$this->input->post('telefon')
                || !$this->input->post('email')
                || !$this->input->post('opis')
        ) {
            return FALSE;
        }
        $data = array(
            'Naziv' => $this->input->post('naziv'),
            'Adresa' => $this->input->post('adresa'),
            'Telefon' => $this->input->post('telefon'),
            'Email' => $this->input->post('email'),
            'Slika' => $fileName,
            'Opis' => $this->input->post('opis'),
            'Username' => $creatorUsername
        );
        return $this->db->insert('pozoriste', $data);
    }

    public function findOne($id) {
        if (!$id) {
            return FALSE;
        }
        $query = $this->db->get_where('pozoriste', array('PozID' => $id));
        return $query->row_array();
    }

    public function find() {
        $this->db->select('PozID, Naziv, Slika');
        $query = $this->db->get('pozoriste');
        return $query->result_array();
    }

    public function findNaziv($id) {
        if (!$id) {
            return FALSE;
        }
        $this->db->select('Naziv');
        $query = $this->db->get_where('pozoriste', array('PozID' => $id));
        return $query->row_array();
    }

    public function removeOne($id) {
        if (!$id) {
            return FALSE;
        }
        $this->db->delete('pozoriste', array('PozId' => $id));
    }

    public function update($fileName) {
        if (!$this->input->post('naziv')
                || !$this->input->post('adresa')
                || !$this->input->post('telefon')
                || !$this->input->post('email')
                || !$this->input->post('opis')
        ) {
            return FALSE;
        }
        $data = array(
            'Naziv' => $this->input->post('naziv'),
            'Adresa' => $this->input->post('adresa'),
            'Telefon' => $this->input->post('telefon'),
            'Email' => $this->input->post('email'),
            'Opis' => $this->input->post('opis'),
        );
        if ($fileName) {
            $data['Slika'] = $fileName;
        }
        $this->db->where('PozID', $this->input->post('PozID'));
        $this->db->update('pozoriste', $data);
    }

}
