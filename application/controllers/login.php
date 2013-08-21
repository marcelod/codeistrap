<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller {
    
    public function __construct()
    {
        parent::__construct();        
    }
 
    /**
     * verifica se exite sessao criada
     * caso não exista chama tela para usuario efetuar login
     */
    public function index($msg = NULL)
    {
        $this->data['msg'] = $msg;

        if( ! $this->session->userdata('logged'))
        {
            $this->load->helper('assets');
            $this->data['js'] = load_js(array('jquery.validate.min', 'valid/login'));

            $this->site();
        } 
        else
        {
            redirect('logado', 'refresh');
        }        
    }

    /**
     * verificacao dos dados enviados
     */
    public function send()
    {
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data['login']    = $this->input->post('login');
            $data['password'] = $this->input->post('password');

            $this->valid_login($data);
        }
    }

    /**
     * validacao do login e senha
     */
    protected function valid_login($dados)
    {
        $this->load->library('encrypt');

        $this->load->model('user_m');
        $vLogin = $this->user_m->get_login($dados['login']);
        
        // caso exista o login ou e-mail passado e já tenha confirmado por e-mail e a senha esteja correta
        if ($vLogin && $vLogin[0]->confirmed == 1 && $dados['password'] === $this->encrypt->decode($vLogin[0]->password))
        {
            $this->logado($vLogin);
        } else {
            $msg = cAlerts('Nome de usu&aacute;rio ou senha inv&aacute;lido.', 'alert-warning');
            $this->index($msg);
        }
    }
    

    /**
     * cria as sessos necesssarias para se manter no sistema
     */
    protected function logado($user)
    {
        $this->load->library('Sessao');
        $this->sessao->set_session($user[0]);

        if( ! $this->session->userdata('logged'))
        {
            $this->session->set_userdata($newdata);
        }
        
        $this->index();
    } 
    
    
     

}