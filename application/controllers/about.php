<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class About extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
    }

 
    public function index($msg = NULL)
    {
        $this->set_title(SITE_NAME  . " | Sobre");
        $this->site();
    }

}