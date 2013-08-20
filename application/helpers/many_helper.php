<?php

/**
 * roleAccessPermission
 * 
 * 
 *
 * 
 * @access  public
 * @param   mixed
 * @return  boolean
 */
if ( ! function_exists('roleAccessPermission'))
{
    function roleAccessPermission($permission = "")
    {
        $CI = _ci();

        if($permission == "")
        {
            return FALSE;
        }

        $roles = rolesUser();

        $CI->load->model('permissions_role_m');
        $names = $CI->permissions_role_m->getPermissionName($roles, $permission);

        if(count($names) == 1)
        {
            return $names[0];
        }
        else if(count($names) > 1)
        {
            return $name;
        }
        else
        {
            return FALSE;
        }

    }
}


/**
 * rolesUser
 *
 * retorna as roles do usario logado ou de um usuario passado
 * 
 * @access  public
 * @param   interger
 * @return  array
 */
if ( ! function_exists('rolesUser'))
{
    function rolesUser($user_id = FALSE)
    {
        $CI = _ci();

        if($user_id === FALSE)
        {
            if( ! $CI->session->userdata('logged'))
            {
                return FALSE;
            }

            $user_id = $CI->session->userdata('user_id');
        }

        $roles = array();

        $CI->load->model('assigned_roles_m');
        $getRoles = $CI->assigned_roles_m->get(array('user_id' => $user_id));
        foreach ($getRoles as $role) {
            $roles[] = $role->role_id;
        }

        return $roles;        
    }
}




/**
 * return instance ci
 * 
 * @access public
 * 
 * @return object
 */
if ( ! function_exists('_ci'))
{
    function _ci()
    {
        $CI =& get_instance();
        return $CI;
    }    
}

/**
 * debug - usado para debugar a aplicação durante o desenvolvimento
 */
if ( ! function_exists('debug'))
{
    function debug($content, $die = TRUE, $print = 'var_dump') {
        echo "<pre>";    
        $print($content);
        echo "</pre>";
        
        if ($die === TRUE) die();
    }
}