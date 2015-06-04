<?php

class User extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function insert() {
        if (!$this->input->post('username')
                || !$this->input->post('password')
                || !$this->input->post('telefon')
                || !$this->input->post('email')
                || !$this->input->post('role')
                || !$this->input->post('posta')
                || !$this->input->post('birthyear')
        ) {
            return FALSE;
        }
        $zeliPostu = $this->input->post('posta') == 'on' ? 1 : 0;
        $starost = date("Y") - $this->input->post('birthyear');
        $data = array(
            'Username' => $this->input->post('username'),
            'Password' => $this->input->post('password'),
            'Email' => $this->input->post('email'),
            'Role' => $this->input->post('role'),
            'ZeliPostu' => $zeliPostu,
            'Telefon' => $this->input->post('telefon'),
            'Starost' => $starost,
        );
        return $this->db->insert('korisnik', $data);
    }

    public function find() {
        $this->db->select('Username, Role, ZeliPostu, Email, Starost');
        $query = $this->db->get('korisnik');
        return $query->result_array();
    }

    public function findOne() {
        if (!$this->input->post('username')) {
            return FALSE;
        }
        $username = $this->input->post('username');
        $query = $this->db->get_where('korisnik', array('Username' => $username));
        return $query->row_array();
    }

    public function removeOne($username) {
        if (!$username) {
            return FALSE;
        }
        $this->db->delete('korisnik', array('Username' => $username));
    }

    public function getUserEmails() {
        $this->db->select('Email');
        $query = $this->db->get_where('korisnik', array('ZeliPostu' => 1));
        return $query->result_array();
    }

    public function makeSession($userData) {
        if (!$userData) {
            return FALSE;
        }
        $this->session->set_userdata($userData);
    }

    public function validation() {
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[20]|is_unique[korisnik.Username]', array(
            'min_length' => 'Minimum length for Username is 5',
            'max_length' => 'Maximum length for Username is 20',
            'is_unique' => 'Username already exists!'
        ));
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[20]', array(
            'min_length' => 'Minimum length for Password is 6',
            'max_length' => 'Maximum length for Password is 20'
        ));
        $this->form_validation->set_rules('passwordagain', 'Ponovite lozinku', 'trim|required|matches[password]', array(
            'matches' => 'Passwords does not match'
        ));
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[30]|is_unique[korisnik.Email]', array(
            'valid_email' => 'Invalid Email',
            'max_length' => 'Maximum length for Email is 30',
            'is_unique' => 'Email already used!'
        ));
        $this->form_validation->set_rules('role', 'Role', 'required');
        $this->form_validation->set_rules('telefon', 'Telefon', 'trim|required|max_length[30]', array(
            'max_length' => 'Maximum length for Telefon is 15'
        ));
        $this->form_validation->set_rules('birthyear', 'Godina rodjenja', 'required');
    }

}
