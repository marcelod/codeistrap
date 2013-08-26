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


	public function create()
	{
		$this->load->helper('assets');

		$data_modal = array(
			'title_modal'   => "Cadatrar usuário",
			'content_modal' => $this->load->view('admin/users/create', '', TRUE),
			'buttons_modal' => array('close' => 'Fechar', 'save' => 'Salvar'),
			'js'			=> load_js(array('jquery.validate.min', 'valid/admin/user_create'))
		);

		$this->load->view('layouts/modal', $data_modal);
	}

	public function send()
	{
		
		if($this->form_validation->run() == FALSE) {
			echo cAlerts('Erro ao registrar! Verifique os campos obrigatórios.', 'alert-danger');
        } else {
        	$this->load->helper('texto');
            $this->load->library('encrypt');

            $dados = array(
                'name'              => $this->input->post('name'),
                'username'          => $this->input->post('username'),
                'email'             => $this->input->post('email'),
                'password'          => $this->encrypt->encode($this->input->post('password')),
                'nickname'          => $this->input->post('username'),
                'gender'            => $this->input->post('gender'),
                'confirmation_code' => gera_str(rand(20, 200), 'num_str'),
                'created_at'        => date($this->config->item('log_date_format')),
                'updated_at'        => date($this->config->item('log_date_format'))
            );

            $this->load->model('user_m');
            $register = $this->user_m->register($dados);
            if($register == FALSE)
            {
                echo cAlerts('Erro ao registrar! Por favor tente novamente.', 'alert-danger');
            }
            else
            {
            	if($this->input->post('send_mail')) {
            		$dados['token'] = gera_str(rand(45, 60), 'num_str');

	                $this->load->model('users_mailing_m');
	                $this->users_mailing_m->add_list($this->input->post('acept'), $dados);
	                
	                $this->load->library('email');
	                
	                $this->email->from(EMAIL_FROM, NAME_FROM);
	                $this->email->to($dados['email']);
	                
	                $this->email->subject('Confirmação de cadastro no site: ' . SITE_NAME);
	                
	                $message = $this->load->view('email/confirmation_register_user', $dados, TRUE);
	                $this->email->message($message);
	                
	                if($this->email->send()) {
	                	echo true;                    
	                } else {
	                    echo $this->email->print_debugger();                    
	                }	
            	}

            	echo true;                
            }
        }

	}

}

/* End of file users.php */
/* Location: ./application/controllers/admin/users.php */