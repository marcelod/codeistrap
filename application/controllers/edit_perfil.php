<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Edit_perfil extends MY_Controller {
    
    public function __construct() {
        parent::__construct();   
        $this->load->model('user_m');     
    }

 
    /**
     * verifica se exite sessao criada
     * caso não exista chama tela para cadastrar
     */
    public function index($msg = NULL)
    {
        $this->data['msg'] = $msg;

        if( ! $this->session->userdata('logged')) {
            redirect('register', 'refresh');
        } else {
            $this->load->helper(array('assets', 'datetime_format'));
            $this->data['js'] = load_js(array('jquery.validate.min', 'valid/edit_perfil', 'search_zipcode', 'jquery.maskedinput.min', 'maskedinput'));
            
            $this->data['userData'] = $this->user_m->get_user_id();

            $this->set_title(SITE_NAME  . " | Editar Perfil");
            $this->site();
        }        
    }

    /**
     * verificacao dos dados enviados
     * verifica se o login foi alterado com o que era e se o novo login já esta cadastrado
     * 
     * salva na base de dados
     */
    public function send()
    {
        if($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $this->load->helper(array('texto', 'datetime_format'));

            $dados = array(
                'id'                => $this->input->post('id'),
                'name'              => $this->input->post('name'),
                'username'          => $this->input->post('username'),
                'nickname'          => $this->input->post('nickname'),
                'gender'            => $this->input->post('gender'),

                'telephone'         =>  $this->input->post('telephone'),
                'birthdate'         =>  data_br_to_us($this->input->post('birthdate')),
                'zipcode'           =>  $this->input->post('zipcode'),
                'address'           =>  $this->input->post('address'),
                'address_number'    =>  $this->input->post('address_number'),
                'complement'        =>  $this->input->post('complement'),
                'district'          =>  $this->input->post('district'),
                'state'             =>  $this->input->post('state'),
                'city'              =>  $this->input->post('city'),
                
                'updated_at'        => date($this->config->item('log_date_format'))
            );


            // verifica se foi passado alguma senha, caso tenha sido, dai sim faz alteração no campo password
            if($this->input->post('password') != "")
            {
                $this->load->library('encrypt');
                $dados['password']  = $this->encrypt->encode($this->input->post('password'));
            }

            // verifica questão de duplicidade de login e tenta atualizar os dados
            if($this->get_duplicate_login($dados) == false)
            {
                $msg = cAlerts('O login já esta sendo usado por outro usuário, tente outro por favor!', 'alert-error');
                $this->index($msg);
            } 
            else if($this->user_m->save($dados))
            {
                $this->session->set_userdata(array('user_name' => $dados['name']));

                $msg = cAlerts('Dados alterados com sucesso.', 'alert-success');
                $this->index($msg);
            } 
            else 
            {
                $msg = cAlerts('Erro ao alterar os dados! Por favor tente novamente.', 'alert-error');
                $this->index($msg);
            }

        }
    }

    public function get_duplicate_login($dados)
    {
        return $this->user_m->get_duplicate_login($dados);
    }


}