<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Sessao
{

	private $CI;

	private $user_logged = false;

	private $values = array();


	public function __construct()
	{
		$this->CI =& get_instance();
		
		$this->CI->load->library('session');

		$this->set_user_logged();
	}

	/**
	 * caso exista sessao criada set user_logged como true
	 */
	private function set_user_logged()
	{
		if($this->CI->session->userdata('logged'))
		{
			$this->user_logged = true;
		}
	}
	
	public function set_session($dadosUser)
	{
		$newdata = array(
               'user_id'       => $dadosUser->id,
               'user_name'     => $dadosUser->name,
               'user_email'    => $dadosUser->email,
               'user_image'    => $dadosUser->image,
               'logged'        => TRUE
        	);

        if( $this->user_logged === false )
        {
            $this->CI->session->set_userdata($newdata);
        }        
	}


	public function userAccessPermission($search)
	{
		if( $this->user_logged )
		{
			$this->CI->load->model('permissions_m');
			$permission = $this->CI->permissions_m->get($search, 'id');
			
			$getPermissionUser = array(
				'permission_id' => $permission[0]->id, 
				'user_id' => $this->CI->session->userdata('user_id')
			);
			$this->CI->load->model('permissions_user_m');
			$access = $this->CI->permissions_user_m->get($getPermissionUser);

			if(count($access) > 0)
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}			
		}
		
		return FALSE;
	}

}
