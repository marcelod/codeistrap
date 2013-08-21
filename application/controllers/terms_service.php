<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Terms_service extends MY_Controller {


	public function index()
	{
		$this->template->set_layout('sticky');

		$this->load->helper('assets');
		$this->data['css'] = load_css(array('sticky'));

		$this->set_title(SITE_NAME  . " | Termos de Serviço");
		$this->site();		
	}
	
}

/* End of file history.php */
/* Location: ./application/controllers/history.php */