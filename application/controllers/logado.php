<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logado extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->init();
	}

	protected function init()
	{
		$this->load->library('Sessao');
		$router = $this->sessao->router_role_init();		

		if($router)
    	{
            redirect('admin', 'refresh');
    	} 
    	else 
    	{
    		redirect('home', 'refresh');
    	}
	}
	
}

/* End of file logado.php */
/* Location: ./application/controllers/logado.php */