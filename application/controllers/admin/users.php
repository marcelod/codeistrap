<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Controller {

	public function __construct()
	{
        parent::__construct();		
	}

	public function index()
	{
		$this->load->helper('assets');
		$this->data['css'] = load_css(array('datatables-bootstrap'));
		$this->data['js']  = load_js(array('jquery.dataTables.min', 'datatables-bootstrap', 'datatables.fnReloadAjax', 'admin/dtUsers'));

		$this->set_title(SITE_NAME . " | " . "Administração" . " | " . "Usuários");
		$this->set_view('admin/users/home');
		$this->admin();
	}


	public function getDataTable()
	{
		$this->load->model('user_m');
		$this->user_m->getDataTable();
	}

}

/* End of file users.php */
/* Location: ./application/controllers/admin/users.php */