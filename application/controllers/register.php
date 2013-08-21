<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Register extends MY_Controller {
    
    public function __construct() {
        parent::__construct();   
        $this->load->model('user_m');     
    }

 
    /**
     * verifica se exite sessao criada
     * caso não exista chama tela para usuario efetuar login
     */
    public function index($msg = NULL)
    {
        $this->data['msg'] = $msg;

        if( ! $this->session->userdata('logged')) {
            $this->load->helper('assets');
            $this->data['js'] = load_js(array('jquery.validate.min', 'valid/register'));

            $this->set_title(SITE_NAME  . " | Registre-se");
            $this->site();
        } else {
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
                $msg = cAlerts('Erro ao registrar! Por favor tente novamente.', 'alert-danger');
                $this->index($msg);
            }
            else
            {
                $dados['token'] = gera_str(rand(45, 60), 'num_str');

                $this->load->model('users_mailing_m');
                $this->users_mailing_m->add_list($this->input->post('acept'), $dados);
                
                $this->load->library('email');
                
                $this->email->from(EMAIL_FROM, NAME_FROM);
                $this->email->to($dados['email']);
                
                $this->email->subject('Confirmação de cadastro no site: ' . SITE_NAME);
                
                $message = $this->load->view('email/confirmation_register', $dados, TRUE);
                $this->email->message($message);
                
                if($this->email->send()) {
                    redirect('register/confirmation_register', 'refresh');
                } else {
                    echo $this->email->print_debugger();                    
                }
            }
        }
    }


    public function confirmation_register($msg = NULL)
    {
        $this->data['msg'] = $msg;

        $this->load->helper('assets');
        $this->data['js'] = load_js(array('jquery.validate.min', 'valid/confirmation_register'));

        $this->set_title(SITE_NAME  . " | Confirmação de Registro");
        $this->set_view('confirmation_register');
        $this->site();        
    }


    public function send_confirmation_register($codigo = NULL)
    {
        if ($this->form_validation->run() == FALSE && $codigo == NULL) {
            $this->confirmation_register();
        } else {
            if($codigo == NULL) {
                $data['confirmation_code'] = $this->input->post('confirmation_register');
            } else {
                $data['confirmation_code'] = $codigo;                
            }
            
            $result = $this->user_m->get($data);
            if (count($result) == 0) {
                $msg = cAlerts('Código de Confirmação incorreto. Verifique no seu e-mail o código enviado.', 'alert-danger');
                $this->confirmation_register($msg);
            } else {
                // atualiza em user.confirmed para 1
                // crio a sessão do usuario
                // redireciono o usuario para logado
                
                $this->user_m->save(
                    array(
                        'id' => $result[0]->id,
                        'confirmed' => true,
                        'updated_at' => date($this->config->item('log_date_format'))
                    )
                );

                $this->load->library('Sessao');
                $this->sessao->set_session($result[0]);

                redirect('logado', 'refresh');

            }
        }
    }

}