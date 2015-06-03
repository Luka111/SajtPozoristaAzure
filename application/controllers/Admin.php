<?php

include_once APPPATH . '/controllers/Base.php';

class Admin extends Base {

    public function __construct() {
        parent::__construct();
        $this->load->model('user');
        $this->load->helper('form');
    }

    protected function obrada($data = NULL) {
        if (!checkPermission(array('admin'), $this->userRole)) {
            redirect(route_url(''));
        } else {
            if (isset($data['korisnici'])) {
                $this->load->view('templates/admin/listaKorisnika', $data);
            } elseif (isset($data['dodajKorisnika'])) {
                $this->load->view('templates/admin/dodajKorisnika', $data);
            } elseif (isset($data['emails'])) {
                $this->load->view('templates/admin/sendEmails', $data);
            } else {
                $this->load->view('templates/admin/adminPanel', $data);
            }
        }
    }

    public function listaKorisnika() {
        if (!checkPermission(array('admin'), $this->userRole)) {
            redirect(route_url(''));
        } else {
            $data['korisnici'] = $this->user->find();
            $this->view($data);
        }
    }

    public function dodajKorisnika() {
        if (!checkPermission(array('admin'), $this->userRole)) {
            redirect(route_url(''));
        } else {
            $data['dodajKorisnika'] = TRUE;
            $this->view($data);
        }
    }

    public function dodajNovogKorisnika() {
        if (!checkPermission(array('admin'), $this->userRole)) {
            redirect(route_url(''));
        } else {
            $this->user->validation();
            if ($this->form_validation->run() === FALSE) {
                $this->dodajKorisnika();
            } else {
                $ret = $this->user->insert();
                if ($ret) {
                    $this->listaKorisnika();
                } else {
                    $data['dberror'] = $this->db->error();
                    $this->dodajKorisnika();
                }
            }
        }
    }

    public function obrisiKorisnika($username) {
        if (!checkPermission(array('admin'), $this->userRole)) {
            redirect(route_url(''));
        } else {
            $this->user->removeOne($username);
            $this->listaKorisnika();
        }
    }

    public function sendEmails() {
        if (!checkPermission(array('admin'), $this->userRole)) {
            redirect(route_url(''));
        } else {
            $data['emails'] = TRUE;
            $this->view($data);
        }
    }

    public function sendEmailToUsers() {
        if (!checkPermission(array('admin'), $this->userRole)) {
            redirect(route_url(''));
        } else {
            $this->validateEmail();
            if ($this->form_validation->run() === FALSE) {
                $this->sendEmails();
            } else {
                //Getting emails from all subscibed users
                $userEmails = $this->user->getUserEmails();
                //Converting to wanted format
                $emailsArray = array();
                foreach ($userEmails as $email) {
                    array_push($emailsArray, $email['Email']);
                }

                //Configuring email
                $config['protocol'] = 'smtp';
                $config['smtp_host'] = 'smtp.gmail.com';
                $config['smtp_port'] = '465';
                $config['_smtp_auth'] = TRUE;
                $config['smtp_user'] = 'smtphost999@gmail.com';
                $config['smtp_pass'] = 'FzvhbHKr';
                $config['smtp_crypto'] = 'ssl';
                $config['smtp_timeout'] = '60';
                $config['charset'] = 'utf-8';
                $config['wordwrap'] = TRUE;
                $config['mailtype'] = "html";

                //Loading email library
                $this->load->library('email', $config);
                $this->email->set_newline("\r\n");

                //Configuring message,subject,recipients and sender
                $this->email->from('lukapetrovicsi@gmail.com', 'Luka Petrovic');
                $this->email->to($emailsArray);

                $this->email->subject($this->input->post('subject'));
                $this->email->message($this->input->post('message'));

                if ($this->email->send()) {

                    $data['successEmail'] = 'You have successfully sent emails!';
                } else {
                    $data['successEmail'] = 'Enable to send email';
                }
                $this->view($data);
            }
        }
    }

    private function validateEmail() {
        $this->form_validation->set_rules('subject', 'Subject', 'required');
        $this->form_validation->set_rules('message', 'Message', 'required');
    }

}
