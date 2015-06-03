<?php

include_once APPPATH . '/controllers/Base.php';

class Pozorista extends Base {

    private $viewIndicator;

    public function __construct() {
        parent::__construct();
        $this->load->model('pozorista_m');
        $this->load->model('predstave_m');
        $this->load->helper('form');
    }

    protected function obrada($data = NULL) {
        if ($this->viewIndicator === 'View') {
            $data['predstave'] = $this->predstave_m->findByPozId($data['pozoriste']['PozID']);
            $this->load->view('templates/' . $this->userRole . '/pozoriste', $data);
            $this->load->view('templates/' . $this->userRole . '/predstave', $data);
        } elseif ($this->viewIndicator === 'Insert') {
            $this->load->view('templates/dodajPozoriste', $data);
        } elseif ($this->viewIndicator === 'Update') {
            $this->load->view('templates/izmeniPozoriste', $data);
        } else {
            $data['pozorista'] = $this->pozorista_m->find();
            $this->load->view('templates/' . $this->userRole . '/pozorista', $data);
        }
    }

    
    public function pozoriste($id) {
        $this->viewIndicator = 'View';
        $data['pozoriste'] = $this->pozorista_m->findOne($id);
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

    public function dodajPozoriste() {
        if (!checkPermission(array('moderator', 'admin'), $this->userRole)) {
            redirect(route_url(''));
        } else {
            $this->validation();
            if ($this->form_validation->run() === FALSE) {
                $this->dodaj();
            } else {
                $this->loadUploadLibrary('pozorista/');
                //Uploading image is NOT required!
                //So, first I check if the file exists
                //Only if the image IS uploaded AND there is an error in uploading I report error
                //More info https://blog.smalldo.gs/2013/03/optional-file-upload-field-codeigniter/
                if ($_FILES['slika'] && ($_FILES['slika']['size'] > 0) && !$this->upload->do_upload('slika')) {
                    $data = array('error' => $this->upload->display_errors());
                    $this->dodaj($data);
                } else {
                    $image = $this->upload->data();
                    $ret = $this->pozorista_m->insert($this->session->username, $image['file_name']);
                    if ($ret) {
                        redirect(route_url('pozorista/view'));
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
            $data['pozoriste'] = $this->pozorista_m->findOne($id);
            $this->view($data);
        }
    }

    public function izmeniPozoriste() {
        if (!checkPermission(array('moderator', 'admin'), $this->userRole)) {
            redirect(route_url(''));
        } else {
            $this->validation();
            if ($this->form_validation->run() === FALSE) {
                $this->izmeni($this->input->post('PozID'));
            } else {
                $this->loadUploadLibrary('pozorista/');
                if ($_FILES['slika'] && ($_FILES['slika']['size'] > 0) && !$this->upload->do_upload('slika')) {
                    $data = array('error' => $this->upload->display_errors());
                    $this->dodaj($data);
                } else {
                    $image = $this->upload->data();
                    $fileName = $image['file_name'] ? $image['file_name'] : NULL;
                    $this->pozorista_m->update($fileName);
                    redirect(route_url('pozorista/pozoriste/' . $this->input->post('PozID')));
                }
            }
        }
    }

    private function validation() {
        $this->form_validation->set_rules('naziv', 'Naziv', 'required');
        $this->form_validation->set_rules('adresa', 'Adresa', 'required');
        $this->form_validation->set_rules('telefon', 'Telefon', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('opis', 'Opis', 'required');
    }

    public function obrisi($id) {
        if (!checkPermission(array('moderator', 'admin'), $this->userRole)) {
            redirect(route_url(''));
        } else {
            $PredIDs = $this->predstave_m->findIDsByPozId($id);
            $this->load->model('komentari_m');
            $this->load->model('kritike_m');
            foreach($PredIDs as $PredID){
                $this->predstave_m->obrisiPredstavu($PredID['PredID'], $this->userRole);
            }
            $this->pozorista_m->removeOne($id);
            redirect('pozorista/view');
        }
    }

}
