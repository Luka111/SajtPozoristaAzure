<?php

include_once APPPATH . '/controllers/Base.php';

class Predstave extends Base {

    private $viewIndicator;

    public function __construct() {
        parent::__construct();
        $this->load->model('predstave_m');
        $this->load->model('komentari_m');
        $this->load->model('kritike_m');
        $this->load->model('pozorista_m');
        $this->load->helper('form');
    }

    protected function obrada($data = NULL) {
        if ($this->viewIndicator === 'View') {
            //Load predstava
            $this->load->view('templates/' . $this->userRole . '/predstava', $data);
            $dataKomentar['Username'] = $this->session->username;
            $dataKomentar['Role'] = $this->session->role;
            $dataKomentar['komentari'] = $this->komentari_m->find($data['predstava']['PredID']);
            $dataKomentar['PredID'] = $data['predstava']['PredID'];
            //Load forma za dodavanje komentara
            if (checkPermission(array('moderator', 'admin', 'kriticar', 'registrovan'), $this->userRole)) {
                $this->load->view('templates/dodajKomentar', $dataKomentar);
            }
            //Load komentari za predstavu
            $this->load->view('templates/komentari', $dataKomentar);
            //Load kritike za predstavu
            $dataKritika['kritike'] = $this->kritike_m->find($data['predstava']['PredID']);
            $dataKritika['PredID'] = $data['predstava']['PredID'];
            if (checkPermission(array('moderator', 'admin', 'kriticar', 'registrovan'), $this->userRole)) {
                $this->load->view('templates/kritike', $dataKritika);
            }
        } elseif ($this->viewIndicator === 'Insert') {
            $this->load->view('templates/dodajPredstavu', $data);
        } elseif ($this->viewIndicator === 'Update') {
            $this->load->view('templates/izmeniPredstavu', $data);
        } elseif ($this->viewIndicator === 'InsertKritika') {
            $data['predstava'] = $this->predstave_m->findOne($data['PredID']);
            $this->load->view('templates/dodajKritiku', $data);
        } elseif ($this->viewIndicator === 'ViewKritika') {
            $data['Username'] = $this->session->username;
            $data['Role'] = $this->session->role;
            $this->load->view('templates/kritika', $data);
        } elseif ($this->viewIndicator === 'UpdateKritika') {
            $this->load->view('templates/izmeniKritiku', $data);
        } else {
            redirect(route_url(''));
        }
    }

    public function predstava($id) {
        if (!$id){
            redirect(route_url(''));
        }
        $this->viewIndicator = 'View';
        $data['predstava'] = $this->predstave_m->findOne($id);
        $data['nazivPozorista'] = $this->pozorista_m->findNaziv($data['predstava']['PozID'])['Naziv'];
        $this->view($data);
    }

    public function dodaj($PozID, $NazivPozorista, $data = NULL) {
        if (!$PozID || !$NazivPozorista){
            redirect(route_url(''));
        }
        if (!checkPermission(array('moderator', 'admin'), $this->userRole)) {
            redirect(route_url(''));
        } else {
            $this->viewIndicator = 'Insert';
            $data['PozID'] = $PozID;
            $data['NazivPozorista'] = urldecode($NazivPozorista);
            $this->view($data);
        }
    }

    public function dodajPredstavu() {
        if (!checkPermission(array('moderator', 'admin'), $this->userRole)) {
            redirect(route_url(''));
        } else {
            $this->validation();
            if ($this->form_validation->run() === FALSE) {
                $this->dodaj($this->input->post('pozID'),$this->input->post('NazivPozorista'));
            } else {
                $this->loadUploadLibrary('predstave/');
                //Uploading image is NOT required!
                //So, first I check if the file exists
                //Only if the image IS uploaded AND there is an error in uploading I report error
                //More info https://blog.smalldo.gs/2013/03/optional-file-upload-field-codeigniter/
                if ($_FILES['slika'] && ($_FILES['slika']['size'] > 0) && !$this->upload->do_upload('slika')) {
                    $data = array('error' => $this->upload->display_errors());
                    $this->dodaj($this->input->post('pozID'),$this->input->post('NazivPozorista'),$data);
                } else {
                    $image = $this->upload->data();
                    $PredID = $this->predstave_m->insert($this->session->username, $image['file_name']);
                    if ($PredID) {
                        redirect(route_url('predstave/predstava/' . $PredID));
                    } else {
                        $this->dodaj($this->input->post('pozID'),$this->input->post('NazivPozorista'));
                    }
                }
            }
        }
    }

    public function izmeni($id) {
        if (!$id){
            redirect(route_url(''));
        }
        if (!checkPermission(array('moderator', 'admin'), $this->userRole)) {
            redirect(route_url(''));
        } else {
            $this->viewIndicator = 'Update';
            $data['predstava'] = $this->predstave_m->findOne($id);
            $this->view($data);
        }
    }

    public function izmeniPredstavu() {
        if (!checkPermission(array('moderator', 'admin'), $this->userRole)) {
            redirect(route_url(''));
        } else {
            $this->validation();
            if ($this->form_validation->run() === FALSE) {
                $this->izmeni($this->input->post('PredID'));
            } else {
                $this->loadUploadLibrary('predstave/');
                if ($_FILES['slika'] && ($_FILES['slika']['size'] > 0) && !$this->upload->do_upload('slika')) {
                    $data = array('error' => $this->upload->display_errors());
                    $this->dodaj($data);
                } else {
                    $image = $this->upload->data();
                    $fileName = $image['file_name'] ? $image['file_name'] : $_FILES['slika']['name'];
                    $this->predstave_m->update($fileName);
                    redirect(route_url('predstave/predstava/' . $this->input->post('PredID')));
                }
            }
        }
    }

    private function validation() {
        $this->form_validation->set_rules('naziv', 'Naziv', 'required');
    }

    public function obrisi($id, $PozID) {
        if (!$id || !$PozID){
            redirect(route_url(''));
        }
        $this->predstave_m->obrisiPredstavu($id, $this->userRole, $PozID);
    }

    /* Replacing with AJAX version
      public function dodajKomentar() {
      if (!checkPermission(array('moderator', 'admin', 'kriticar', 'registrovan'), $this->userRole)) {
      redirect(route_url(''));
      } else {
      $this->validateKomentar();
      if ($this->form_validation->run() === FALSE) {
      $this->predstava($this->input->post('PredID'));
      } else {
      $ret = $this->komentari_m->insert($this->session->username, $this->input->post('PredID'));
      if ($ret) {
      redirect(route_url('predstave/predstava/' . $this->input->post('PredID')));
      } else {
      $this->predstava($this->input->post('PredID'));
      }
      }
      }
      }
     */

    public function dodajKomentar() {
        if (!checkPermission(array('moderator', 'admin', 'kriticar', 'registrovan'), $this->userRole)) {
            redirect(route_url(''));
        } else {
            $response = array();
            header("content-type:application/json");
            if (!$this->input->post('Tekst')) {
                $response['status'] = 'nok';
            } else {
                $KomID = $this->komentari_m->insert($this->session->username, $this->input->post('PredID'));
                if ($KomID) {
                    $response['status'] = 'ok';
                    $response['KomID'] = $KomID;
                } else {
                    $response['status'] = 'nok';
                }
            }
            echo json_encode($response);
        }
    }

    private function validateKomentar() {
        $this->form_validation->set_rules('tekst', 'Tekst', 'required|trim');
    }

    public function obrisiKomentar($id, $creatorUsername, $predID) {
        if (!$id || !$creatorUsername || !$predID){
            redirect(route_url(''));
        }
        if ((!checkPermission(array('moderator', 'admin'), $this->userRole)) && $this->session->username !== $creatorUsername) {
            redirect(route_url(''));
        } else {
            $this->komentari_m->removeOne($id);
            redirect(route_url('predstave/predstava/' . $predID));
        }
    }

    public function kritika($id, $predID) {
        if (!$id || !$predID){
            redirect(route_url(''));
        }
        if (!checkPermission(array('moderator', 'admin', 'kriticar', 'registrovan'), $this->userRole)) {
            redirect(route_url(''));
        } else {
            $this->viewIndicator = 'ViewKritika';
            $data['kritika'] = $this->kritike_m->findOne($id);
            $data['PredID'] = $predID;
            $data['predstava'] = $this->predstave_m->findOne($predID);
            $this->view($data);
        }
    }

    public function dodajKritiku($predID) {
        if (!$predID){
            redirect(route_url(''));
        }
        if (!checkPermission(array('admin', 'kriticar'), $this->userRole)) {
            redirect(route_url(''));
        } else {
            $this->viewIndicator = 'InsertKritika';
            $data['PredID'] = $predID;
            $this->view($data);
        }
    }

    public function dodajKritikuSubmit() {
        if (!checkPermission(array('admin', 'kriticar'), $this->userRole)) {
            redirect(route_url(''));
        } else {
            $this->validateKritika();
            if ($this->form_validation->run() === FALSE) {
                $this->dodajKritiku($this->input->post('PredID'));
            } else {
                $ret = $this->kritike_m->insert($this->session->username, $this->input->post('PredID'));
                if ($ret) {
                    redirect(route_url('predstave/predstava/' . $this->input->post('PredID')));
                } else {
                    $this->dodajKritiku($this->input->post('PredID'));
                }
            }
        }
    }

    private function validateKritika() {
        $this->form_validation->set_rules('naslov', 'Naslov', 'required');
        $this->form_validation->set_rules('sadrzaj', 'Sadrzaj', 'required');
    }

    public function obrisiKritiku($id, $creatorUsername, $predID) {
        if (!$id || !$creatorUsername || !$predID){
            redirect(route_url(''));
        }
        if ((!checkPermission(array('admin'), $this->userRole)) && $this->session->username !== $creatorUsername) {
            redirect(route_url(''));
        } else {
            $this->kritike_m->removeOne($id);
            redirect(route_url('predstave/predstava/' . $predID));
        }
    }

    public function izmeniKritiku($id, $creatorUsername, $predID) {
        if (!$id || !$creatorUsername || !$predID){
            redirect(route_url(''));
        }
        if ((!checkPermission(array('admin'), $this->userRole)) && $this->session->username !== $creatorUsername) {
            redirect(route_url(''));
        } else {
            $this->viewIndicator = 'UpdateKritika';
            $data['kritika'] = $this->kritike_m->findOne($id);
            $data['PredID'] = $predID;
            $this->view($data);
        }
    }

    public function izmeniKritikuSubmit() {
        if ((!checkPermission(array('admin'), $this->userRole)) && $this->session->username !== $this->input->post('CreatorUsername')) {
            redirect(route_url(''));
        } else {
            $this->validateKritika();
            if ($this->form_validation->run() === FALSE) {
                $this->izmeniKritiku($this->input->post('KritID'), $this->session->username, $this->input->post('PredID'));
            } else {
                $ret = $this->kritike_m->update();
                redirect(route_url('predstave/kritika/' . $this->input->post('KritID') . '/' . $this->input->post('PredID')));
            }
        }
    }

}
