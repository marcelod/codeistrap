<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends MY_Controller {

	/**
     *  Destroi as sessoes criadas
     */
	public function index()
	{
        $this->session->sess_destroy();
        redirect(base_url(), 'refresh');
    }
	
}

/* End of file logout.php */
/* Location: ./application/controllers/logout.php */