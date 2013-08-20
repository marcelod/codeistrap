<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
    }

 
    public function index($msg = NULL)
    {
        $this->data['msg'] = $msg;

        $this->load->helper('assets');
        // $this->data['js'] = load_js(array('jquery.validate.min', 'valid/contact'));

        $this->set_title(SITE_NAME  . " | Fale Conosco");
        $this->site();
    }

    /**
     * verificacao dos dados enviados *
     * salva na base de dados *
     * caso setado salvar em users_mailing *
     * envia e-mail agradecendo *
     *      e-mail sempre com opção de cancelar mailing *
     * envia e-mial para EMAIL_FROM *
     *      e-mail com os dados do cadastro *
     */
    public function send()
    {
        if($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $this->load->helper('texto');
            
            $dados = array(
                'name'              => $this->input->post('name'),
                'email'             => $this->input->post('email'),
                'telephone'         => $this->input->post('telephone'),
                'message'           => $this->input->post('message'),
                'user_id'           => $this->session->userdata('user_id'),
                'ip_address'        => $_SERVER['REMOTE_ADDR'],
                'user_agent'        => $this->input->user_agent(),
                'created_at'        => date($this->config->item('log_date_format'))
            );

            $this->load->model('contact_m');
            $register = $this->contact_m->save($dados);

            if($register == FALSE) {
                $msg = cAlerts('Erro ao enviar mensagem! Por favor tente novamente.', 'alert-error');
                $this->index($msg);
            } else {
                $dados['token'] = gera_str(rand(45, 60), 'num_str');

                $this->load->model('users_mailing_m');
                $this->users_mailing_m->add_list($this->input->post('acept'), $dados);

                $this->load->library('email');
                
                $this->email->from(EMAIL_FROM, NAME_FROM);
                $this->email->to($dados['email']);                
                $this->email->subject(SITE_NAME . ' : Agradecemos o contato');

                $message = $this->load->view('email/send_message', $dados, TRUE);
                $this->email->message($message);
                
                if($this->email->send()) {

                    $this->email->to(EMAIL_TO);
                    $this->email->subject(SITE_NAME . ' : Contato do site');
                    $message = $this->load->view('email/contact', $dados, TRUE);
                    $this->email->message($message);
                    $this->email->send();
                    
                    $msg = cAlerts('Agradecemos o contato, em breve entraremos em contato.', 'alert-success');
                    $this->index($msg);                    
                } else {
                    echo $this->email->print_debugger();                    
                }
            }
        }
    }


    public function remove_mailing()
    {
        $token = $this->uri->segment(2);
        if($token !== FALSE)
        {
            $this->load->model('users_mailing_m');
            $result = $this->users_mailing_m->get(array('token' => $token), 'id');
            $dados['id'] = count($result) > 0 ? $result[0]->id : FALSE;
            if($dados['id'] !== FALSE)
            {
                $dados['cancel']     = 1;
                $dados['updated_at'] = date($this->config->item('log_date_format'));
                $this->users_mailing_m->save($dados);
            }            
        }

        redirect('home', 'refresh');
    }



}