<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

	public function index()
	{
		$this->set_title(SITE_NAME . " | " . "Administração" . " | " . "Home");
		$this->set_view('admin/home');
		$this->admin();
	}
	
}

/* End of file home.php */
/* Location: ./application/controllers/admin/home.php */