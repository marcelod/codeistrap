<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Instalar extends CI_Controller {

    public function __construct()
    {
        parent::__construct();        
    }

    public function index()
    {
        $ret = $this->exec_func('current');
        echo $ret;
    }

    private function exec_func($func, $id = NULL)
    {
        $this->load->library('migration');

        if ( ! $this->migration->{$func}($id) )
        {
            return $this->migration->error_string();
        }

        return "<p>Migra&ccedil;&atilde;o bem sucedida!</p>";        
    }

}