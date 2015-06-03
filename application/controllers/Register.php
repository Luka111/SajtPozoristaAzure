<?php

include_once APPPATH . '/controllers/Base.php';

class Register extends Base {

    public function __construct() {
        parent::__construct();
        $this->load->model('user');
    }

    protected function obrada($data = NULL) {
        //this view is for non-registered users only
        if (!checkPermission(array('neregistrovan'), $this->userRole)){
            redirect(route_url(''));
        }else{
            $this->load->view('register', $data);
        }
    }

    public function registerUser() {
        $this->user->validation();
        if ($this->form_validation->run() === FALSE) {
            $this->view();
        } else {
            $ret = $this->user->insert();
            if ($ret) {
                redirect(route_url('login/successfulRegister'));
            } else {
                $data['dberror'] = $this->db->error();
                $this->view($data);
            }
        }
    }

}
