<?php
    
class Kritike_m extends CI_Model{
    
    public function __construct() {
        $this->load->database();
    }
    
    public function insert($creatorUsername, $predID){
        $data = array(
            'PredID' => $predID,
            'Naslov' => $this->input->post('naslov'),
            'Sadrzaj' => $this->input->post('sadrzaj'),
            'Username' => $creatorUsername
        );
        return $this->db->insert('kritika', $data);
    }
    
     public function findOne($id) {
        $query = $this->db->get_where('kritika', array('KritID' => $id));
        return $query->row_array();
    }
    
     public function find($predID) {
        $this->db->select('KritID, Naslov, Username');
        $query = $this->db->get_where('kritika', array('PredID' => $predID));
        return $query->result_array();
    }
       
    public function findIDs($predID) {
        $this->db->select('KritID');
        $query = $this->db->get_where('kritika', array('PredID' => $predID));
        return $query->result_array();
    }

    public function removeOne($id) {
        $this->db->delete('kritika', array('KritID' => $id));
    }

    public function update() {
        $data = array(
            'Naslov' => $this->input->post('naslov'),
            'Sadrzaj' => $this->input->post('sadrzaj')
        );
        $this->db->where('KritID', $this->input->post('KritID'));
        $this->db->update('kritika', $data);
    }
}

?>