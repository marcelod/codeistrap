<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Forget_password extends MY_Controller {
    
    public function __construct() {
        parent::__construct();   
    }

 
    public function index($msg = NULL)
    {
        $this->data['msg'] = $msg;

        if( ! $this->session->userdata('logged'))
        {
            $this->load->helper('assets');
            $this->data['js'] = load_js(array('jquery.validate.min', 'valid/forget_password'));

            $this->set_title(SITE_NAME  . " | Recuperar Senha");
            $this->site();
        }
        else
        {
            redirect('logado', 'refresh');
        }
    }

    /**
     * verificacao dos dados enviados
     * gera um codigo de confirmação
     * salva na base de dados
     * envia e-mail de confirmação
     */
    public function send()
    {
        if($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $this->load->library('encrypt', 'alert');
            $this->load->model('user_m');            

            $dados['email'] = $this->input->post('email');

            $result = $this->user_m->get($dados);
            if (count($result) == 0) {
                $msg = cAlerts('E-mail não cadastrado.', 'alert-error');
                $this->index($msg);
            } else {
                // salvar um log em password_reminders
                $this->load->model('password_reminders_m');
                $this->password_reminders_m->save(
                    array(
                        'email'      => $dados['email'],
                        'created_at' => date($this->config->item('log_date_format'))
                    )
                );


                $dados['name']     = $result[0]->name;
                $dados['username'] = $result[0]->username;
                
                // decripta a senha
                $this->load->library('encrypt');
                $dados['password'] = $this->encrypt->decode($result[0]->password);                
                
                // prepara e envia o e-mail
                $this->load->library('email');
                
                $this->email->from(EMAIL_FROM, NAME_FROM);
                $this->email->to($dados['email']);
                
                $this->email->subject('Solicitação de Recuperação de Senha do site: ' . SITE_NAME);
                
                $message = $this->load->view('email/forget_password', $dados, TRUE);
                $this->email->message($message);
                
                if($this->email->send()) {
                    $msg = cAlerts('E-mail enviado com sucesso.', 'alert-success');
                    $this->index($msg);
                } else {
                    echo $this->email->print_debugger();                    
                }
            }                
        }
    }



}