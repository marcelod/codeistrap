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
		$access = $this->sessao->userAccessPermission(array('name' => 'admin'));

		if($access !== FALSE)
		{
            redirect('admin', 'refresh');
		}

    	redirect('home', 'refresh');
	}
	
}

/* End of file logado.php */
/* Location: ./application/controllers/logado.php */