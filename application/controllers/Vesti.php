<?php

include_once APPPATH . '/controllers/Base.php';

class Vesti extends Base {

    private $viewIndicator;

    public function __construct() {
        parent::__construct();
        $this->load->model('vesti_m');
        $this->load->helper('form');
    }

    protected function obrada($data = NULL) {
        if ($this->viewIndicator === 'View') {
            $this->load->view('templates/' . $this->userRole . '/vest', $data);
        } elseif ($this->viewIndicator === 'Insert') {
            $this->load->view('templates/dodajVest', $data);
        } elseif ($this->viewIndicator === 'Update') {
            $this->load->view('templates/izmeniVest', $data);
        } else {
            $data['vesti'] = $this->vesti_m->find();
            $this->load->view('templates/' . $this->userRole . '/vesti', $data);
        }
    }

    public function vest($id) {
        $this->viewIndicator = 'View';
        $data['vest'] = $this->vesti_m->findOne($id);
        $this->view($data);
    }

    public function dodaj($data = NULL) {
        if (!checkPermission(array('moderator', 'admin'), $this->userRole)) {
            redirect(route_url(''));
        } else {
            $this->viewIndicator = 'Insert';
            $this->view($data);
        }
    }

    public function dodajVest() {
        if (!checkPermission(array('moderator', 'admin'), $this->userRole)) {
            redirect(route_url(''));
        } else {
            $this->validation();
            if ($this->form_validation->run() === FALSE) {
                $this->dodaj();
            } else {
                $this->loadUploadLibrary('vesti/');
                //Uploading image is NOT required!
                //So, first I check if the file exists
                //Only if the image IS uploaded AND there is an error in uploading I report error
                //More info https://blog.smalldo.gs/2013/03/optional-file-upload-field-codeigniter/
                if ($_FILES['slika'] && ($_FILES['slika']['size'] > 0) && !$this->upload->do_upload('slika')) {
                    $data = array('error' => $this->upload->display_errors());
                    $this->dodaj($data);
                } else {
                    $image = $this->upload->data();
                    $ret = $this->vesti_m->insert($this->session->username, $image['file_name']);
                    if ($ret) {
                        redirect(route_url('vesti/view'));
                    } else {
                        $this->dodaj();
                    }
                }
            }
        }
    }

    public function izmeni($id) {
        if (!checkPermission(array('moderator', 'admin'), $this->userRole)) {
            redirect(route_url(''));
        } else {
            $this->viewIndicator = 'Update';
            $data['vest'] = $this->vesti_m->findOne($id);
            $this->view($data);
        }
    }

    public function izmeniVest() {
        if (!checkPermission(array('moderator', 'admin'), $this->userRole)) {
            redirect(route_url(''));
        } else {
            $this->validation();
            if ($this->form_validation->run() === FALSE) {
                $this->izmeni($this->input->post('VestID'));
            } else {
                $this->loadUploadLibrary('vesti/');
                if ($_FILES['slika'] && ($_FILES['slika']['size'] > 0) && !$this->upload->do_upload('slika')) {
                    $data = array('error' => $this->upload->display_errors());
                    $this->dodaj($data);
                } else {
                    $image = $this->upload->data();
                    $fileName = $image['file_name'] ? $image['file_name'] : NULL;
                    $this->vesti_m->update($fileName);
                    redirect(route_url('vesti/vest/' . $this->input->post('VestID')));
                }
            }
        }
    }

    private function validation() {
        $this->form_validation->set_rules('naslov', 'Naslov', 'required');
        $this->form_validation->set_rules('sadrzaj', 'Sadrzaj', 'required');
    }

    public function obrisi($id) {
        if (!checkPermission(array('moderator', 'admin'), $this->userRole)) {
            redirect(route_url(''));
        } else {
            $this->vesti_m->removeOne($id);
            redirect('vesti/view');
        }
    }

}
