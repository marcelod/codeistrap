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


	public function router_role_init()
	{
		if( $this->user_logged )
		{
			$this->CI->load->model('assigned_roles_m');
        	$roles = $this->CI->assigned_roles_m->get(array('user_id' => $this->CI->session->userdata('user_id')));
        	$this->set('role_id', $roles);
        	
        	$ar_roles = $this->get();
        	
        	if(in_array(ROLE_ADM, $ar_roles))
        	{
        	    return true;        		
        	}
        	
    		return false;
		}
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

	
	protected function set($field, $result)
	{
		foreach ($result as $r)
		{
			if(is_object($r))
			{
				if(isset($r->$field))
				{
					$this->values[] = $r->$field;
				}
			}
			elseif (is_array($r))
			{
				if(isset($r[$field]))
				{
					$this->values[] = $r[$field];
				}
			}
		}
	}	


	protected function get()
	{
		return $this->values;
	}

}
