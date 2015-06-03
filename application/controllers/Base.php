<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Home
 *
 * @author LukaWin7
 */
abstract class Base extends CI_Controller {

    protected $userRole;

    public function __construct() {
        parent::__construct();
        //Rola korisnika (ako nema - neregistrovan)
        $this->userRole = $this->session->role ? $this->session->role : "neregistrovan";
    }

    abstract protected function obrada();

    public function view($data = NULL) {
        $this->load->view('templates/header');
        $this->load->view('templates/' . $this->userRole . '/menu');
        $this->obrada($data);
        $this->load->view('templates/footer');
    }

    protected function loadUploadLibrary($contentFolder) {
        $config['upload_path'] = './assets/img/' . $contentFolder;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 10000;
        $config['overwrite'] = TRUE;
        //$config['max_width'] = 1024;
        //$config['max_height'] = 768;

        $this->load->library('upload', $config);
    }

}
