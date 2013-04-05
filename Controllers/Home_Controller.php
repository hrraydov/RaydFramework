<?php

class Home_Controller extends \Framework\Base_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->model('Home');
        $row_data = $this->Home->ex();
        $this->load->view('Home/home', $row_data);
    }

}

