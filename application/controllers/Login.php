<?php

include_once APPPATH . '/controllers/Base.php';

class Login extends Base {

    public function __construct() {
        parent::__construct();
        $this->load->model('user');
    }

    protected function obrada($data = NULL) {
        //this view is for non-registered users only
        if (!checkPermission(array('neregistrovan'), $this->userRole)){
            redirect(route_url(''));
        }else{
            $this->load->view('login', $data);
        }
    }

    public function loginUser() {
        $this->validation();
        if ($this->form_validation->run() === FALSE) {
            $this->view();
        } else {
            $user = $this->user->findOne();
            $ret = $this->validateUser($user);
            if (!is_string($ret)) {
                $this->user->makeSession($ret);
                redirect(route_url(''));
            } else {
                $data['msg'] = $ret;
                $this->view($data);
            }
        }
    }
    
    public function logout(){
        session_destroy();
        redirect(route_url(''));
    }

    private function validateUser($user) {
        $msg;
        if ($user) {
            if ($user['Password'] === $this->input->post('password')) {
                return array(
                    'username' => $user['Username'],
                    'role' => $user['Role'],
                    'email' => $user['Email'],
                    'posta' => $user['Posta'],
                    'starost' => $user['starost'],
                    'logged_in' => TRUE
                );
            }else{
                $msg = 'Wrong password!';
            }
        }else{
            $msg = 'Username does not exist!';
        }
        return $msg;
    }

    private function validation() {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
    }

    public function successfulRegister() {
        $data['msg'] = 'You have successfully created account. Now you can login!';
        $this->view($data);
    }

}