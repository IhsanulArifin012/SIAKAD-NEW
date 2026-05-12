<?php
class Error_access extends CI_Controller {

    function __construct() {
        parent::__construct();
        // We DO NOT call checkAksesModule() here to prevent infinite redirection
    }

    public function index() {
        $this->template->load('template', 'errors/html/error_access');
    }
}
