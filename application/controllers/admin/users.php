<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Controller {

	public function __construct()
	{
        parent::__construct();		
		$this->load->model('user_m');
	}

	public function index()
	{
		$this->load->helper('assets');
		$this->data['css'] = load_css(array('datatables-bootstrap'));
		$this->data['js']  = load_js(array(
			'jquery.form', 'jquery.dataTables.min', 'datatables-bootstrap', 'datatables.fnReloadAjax', 
			'admin/actionDatatables', 'admin/dtUsers', 
			'jquery.maskedinput.min', 'maskedinput', 'search_zipcode',
			'jquery.validate.min', 'valid/admin/user_create', 'valid/admin/user_edit'));

		$this->set_title(SITE_NAME . " | " . "Administração" . " | " . "Usuários");
		$this->set_view('admin/users/home');
		$this->admin();
	}

	/**
	 * seleciona os usuarios para exibir no DataTables
	 */
	public function getDataTable()
	{
		$dataUsers = $this->user_m->getDataTable();
		echo $dataUsers;
	}

	/**
	 * gera a view (formulário) para criação de um novo usuário
	 * 
	 * @return html
	*/
	public function create()
	{
		$this->load->helper('assets');

		$data_modal = array(
			'title_modal'   => "Cadatrar usuário",
			'content_modal' => $this->load->view('admin/users/create', '', TRUE),
			'buttons_modal' => array('close', 'save')
		);

		$this->load->view('layouts/modal', $data_modal);
	}

	/**
     * validação dos dados enviados
     * 
     * salva na base de dados o novo usuario enviado
     */
	public function send()
	{
        if($this->form_validation->run() == FALSE) {
			$return['success'] = FALSE;
			$return['msg']	   = validation_errors();
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
            if($register === FALSE)
            {
	            $return['success'] = FALSE;
    			$return['msg']	   = cAlerts('Erro ao registrar! Por favor tente novamente.', 'alert-danger');
            }
            else
            {
            	$return['success'] = TRUE;
    			$return['msg']	   = "Usuário criado com sucesso.";

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
	                	$return['success'] = TRUE;
	                } else {
	                	$return['success'] = FALSE;
	                    $return['msg']	   = $this->email->print_debugger();
	                }	
            	}
            }
        }

	    echo json_encode($return);
	}

	public function active($id, $ativo = true)
	{
		$this->user_m->active($id, $ativo);
	}

	/**
	 * gera a view (formulário) para edição de um usuário passado
	 * 
	 * @return html
	*/
	public function edit()
	{
		$this->load->helper(array('assets', 'datetime_format'));
		
		$user_id = $this->input->post('id');
		
		$user = $this->user_m->get_alter($user_id);

		$data_modal = array(
			'title_modal'   => "Editar usuário",
			'content_modal' => $this->load->view('admin/users/edit', array('user' => $user), TRUE),
			'buttons_modal' => array('close', 'saveEdit')
		);

		$this->load->view('layouts/modal', $data_modal);
	}

	/**
     * verificacao dos dados enviados
     * verifica se o login foi alterado com o que era e se o novo login já esta cadastrado
     * 
     * salva na base de dados
     */
    public function editDB()
    {
        if($this->form_validation->run() == FALSE) {
        	$return['success'] = FALSE;
			$return['msg']	   = validation_errors();
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
            	$return['success'] = FALSE;
				$return['msg']	   = cAlerts('O login já esta sendo usado por outro usuário, tente outro por favor!', 'alert-danger');
            } 
            else if($this->user_m->save($dados))
            {
                $this->session->set_userdata(array('user_name' => $dados['name']));

                $return['success'] = TRUE;
				$return['msg']	   = "Dados do usuário alterado com sucesso";
            } 
            else 
            {
            	$return['success'] = FALSE;
				$return['msg']	   = cAlerts('Erro ao alterar os dados! Por favor tente novamente.', 'alert-danger');
            }
        }

        echo json_encode($return);
    }

    /**
	 * gera a view (formulário) para configuração de um usuário passado
	 * 
	 * @return html
	*/
    public function config()
	{
		$this->load->helper(array('assets'));
		
		$user_id = $this->input->post('id');

		// RETORNA OS DADOS DO USUÁRIO
		$user  = $this->user_m->get_alter($user_id);
		
		// ROTORNO AS ROLES QUE EXISTEM NO BANCO
		$this->load->model('roles_m');
		$roles = $this->roles_m->get();

		// RETORNO AS ROLES QUE O USUÁRIO TEM ACESSO
		$this->load->model('assigned_roles_m');
		$roles_user_access = array();
		$roles_user = $this->assigned_roles_m->get('user_id = ' . $user_id, 'role_id');
		foreach ($roles_user as $role) {
			$roles_user_access[] = $role->role_id;
		}

		// ROTORNO AS PERMISSIONS QUE EXISTEM NO BANCO
		$this->load->model('permissions_m');
		$getPermissions = $this->permissions_m->get_permissions_config_user($user_id);
		$permissions = getPermissionsUserConfig($getPermissions);
		

		$data_modal = array(
			'title_modal'   => "Configurações do usuário " . "<em>" . $user->name . "</em>",
			'content_modal' => $this->load->view(
										'admin/users/conf', 
										array(
											'user' => $user,
											'roles' => $roles,
											'roles_user' => $roles_user_access,
											'permissions' => $permissions
										), 
										TRUE),
			'buttons_modal' => array('close', 'saveConfig')
		);

		$this->load->view('layouts/modal', $data_modal);
	}

	/**
     * validação dos dados enviados
     * 
     * remove os registros do usuario em assigned roles
     * remove os registros do usuario em permissions user
     * salva na base de dados as novas roles e permissions
     */
    public function configDB()
    {
        if($this->form_validation->run() == FALSE) {
            echo validation_errors();
        } else {

        	$dataRolesUser = array();
        	$dataPermissionsUser = array();

        	$user_id   = $this->input->post('user_id');
        	$rolesUser = $this->input->post('roles_user');        	
        	$permissionsUser = $this->input->post('permissions_user');
        	
        	foreach ($rolesUser as $role) {
        		$dataRolesUser[] = array('user_id' => $user_id, 'role_id' => $role);
        	}

        	if($permissionsUser !== FALSE)
        	{
	        	foreach ($permissionsUser as $permission) {
	        		$dataPermissionsUser[] = array('user_id' => $user_id, 'permission_id' => $permission);
	        	}        		
        	}

        	$this->load->model('assigned_roles_m');
			$this->assigned_roles_m->delete_user($user_id);
			$this->assigned_roles_m->save_batch($dataRolesUser);

			$this->load->model('permissions_user_m');
			$this->permissions_user_m->delete_user($user_id);
			if($permissionsUser !== FALSE)
			{
				$this->permissions_user_m->save_batch($dataPermissionsUser);				
			}

        	$return['success'] = TRUE;
        	$return['msg']	   = "Configurações realizadas com sucesso.";

	        echo json_encode($return);
        }
    }

    /**
	 * gera a view confirmação de exclusão de um usuário passado
	 * 
	 * @return html
	*/
	public function delete()
	{
		$this->load->helper('assets');
		
		$user_id = $this->input->post('id');

		$user = $this->user_m->get_alter($user_id);	

		$data_modal = array(
			'title_modal'   => "Apagar usuário",
			'content_modal' => $this->load->view('admin/users/delete', array('user' => $user), TRUE),
			'buttons_modal' => array('close' => 'Cancelar', 'delete')
		);

		$this->load->view('layouts/modal', $data_modal);
	}

	/**
	 * remove um usuário da base de dados conforme id passado
	 */
	public function deleteRow()
	{
		$user_id = $this->input->post('id');
		$this->user_m->delete($user_id);
		
		$return['success'] = TRUE;
        // $return['msg']	   = "Usuário apagado com sucesso.";

	    echo json_encode($return);
	}


	public function get_duplicate_login($dados)
    {
        return $this->user_m->get_duplicate_login($dados);
    }



}

/* End of file users.php */
/* Location: ./application/controllers/admin/users.php */