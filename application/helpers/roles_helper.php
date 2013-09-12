<?php

/**
 * setPermissionsRoleUser
 * 
 * irá verificar quais permissões estão atreladas a role_id
 * e essas permissões atribuir ao usuario
 * 
 * @access  public
 * @param   int
 * @param   int
 * @return  boolean
 */
if ( ! function_exists('setPermissionsRoleUser'))
{
    function setPermissionsRoleUser($role_id, $user_id)
    {
        $CI = _ci();

        $CI->load->model('permissions_role_m');
        $permissions = $CI->permissions_role_m->get(array('role_id' => $role_id), 'permission_id');
        if(count($permissions) > 0)
        {
            $dataPermissionsUser = array();

            foreach ($permissions as $p) {
                $dataPermissionsUser[] = array('user_id' => $user_id, 'permission_id' => $p->permission_id);
            }

            $this->load->model('permissions_user_m');
            $this->permissions_user_m->save_batch($dataPermissionsUser);
        }

        return TRUE;
    }
}
