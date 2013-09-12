<?php
/**
 * userPermission
 * 
 * verifica se um usuario logado tem permissão a uma detereminada permissão passada
 * $param envidado deve ser um conjunto com a chave e valor da permissão esperada, sendo a chave o nome da coluna
 * 
 * @access  public
 * @param   mixed
 * @return  array
 */
if ( ! function_exists('userPermission'))
{
    function userPermission($permission)
    {
        $CI = _ci();

        $user_id = $CI->session->userdata('user_id');

        $CI->load->model('permissions_m');
        $permissions = $CI->permissions_m->get($permission);

        $CI->load->model('permissions_user_m');
        if( $CI->permissions_user_m->get(array('permission_id' => $permissions[0]->id, 'user_id' => $user_id)) )
        {
            return $permissions[0];
        } 

        return FALSE;
        
    }
}


/**
 * permissionsUser
 *
 * retorna as permissoes do usario logado ou de um usuario passado
 * 
 * @access  public
 * @param   interger
 * @return  array
 */
if ( ! function_exists('permissionsUser'))
{
    function permissionsUser($user_id = FALSE)
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

        $permissions = array();

        $CI->load->model('permissions_user_m');
        $getPermissions = $CI->permissions_user_m->get(array('user_id' => $user_id));
        foreach ($getPermissions as $get) {
            $permissions[] = $get->permission_id;
        }

        return $permissions;
    }
}


/**
 * getPermissionsUserConfig
 * 
 * funcao para gerar o html da parte de Permissões em configurações do usuário
 * 
 * @access public
 * @param array
 * @return html
 */
if ( ! function_exists('getPermissionsUserConfig'))
{
    function getPermissionsUserConfig($permissions)
    {
        $permHtml   = "";
        $menu       = array();
        $outro     = array();

        foreach ($permissions as $permission) {
            if($permission->opt_menu == "1")
            {
                $menu[] = $permission;                
            }
            else
            {
                $outro[] = $permission;
            }
        }


        $permHtml .= panelTabPermission($menu, 1);
        $permHtml .= panelTabPermission($outro, 0);

        return $permHtml;
    }
}

/**
 * panelTabPermission
 * 
 * irá montar os paineis e as navTabs das configurações do usuário 
 * conforme verificação se for parte de menu ou não irá criar a referencia
 * 
 * @access public
 * @param array
 * @param bool
 * @return html
 */
if ( ! function_exists('panelTabPermission'))
{
    function panelTabPermission($permissions, $isMenu = TRUE)
    {
        $ref = $isMenu ? "menu" : "outro";
        
        $local      = "";
        $active     = TRUE;        
        $phtml      = "";
        $navTabs    = "";
        $tabContent = "";
        
        $phtml.= '<div class="panel panel-default">';
        $phtml.= '<div class="panel-heading">' . ucfirst($ref) . '</div>';
        $phtml.= '<div class="panel-body">';
        foreach ($permissions as $permission)
        {
            $refNavTabContent = $ref .'-'. $permission->local;

            $class = isActive($active);
            
            if($permission->local !== $local)
            {
                $navTabs.= '<li class="' . $class . '""><a data-toggle="tab" href="#' . $refNavTabContent . '">' . ucfirst($permission->local) . '</a></li>';

                $tabContent.= '<div class="tab-pane ' . $class . '" id="' . $refNavTabContent . '">';
                $tabContent.= getLabelTabContent($permissions, $permission->local);
                $tabContent.= '</div>';

                $local = $permission->local;
                $active = FALSE;
            }
        }

        $phtml.= '<ul class="nav nav-tabs" data-tabs="tabs">' . $navTabs . '</ul>';
        $phtml.= '<div class="tab-content">' . $tabContent . '</div>';

        $phtml.= '</div>'; // close .panel-body
        $phtml.= '</div>'; // close .panel
        
        return $phtml;
    }
}


/**
 * getLabelTabContent
 * 
 * recebe as permissões e verifica se o usuário tem essa permissão atrelado a ele
 * caso tenha retorna o checkbox marcado, caso contrario retorna desmarcado
 * 
 * @access public
 * @param array
 * @param string
 * @return html
 */
if ( ! function_exists('getLabelTabContent'))
{
    function getLabelTabContent($permissions, $local)
    {
        $labelTabContent = "";

        foreach ($permissions as $permission)
        {
            if($permission->local === $local)
            {
                $checked = $permission->checked !== NULL ? "checked='checked'" : "";

                $labelTabContent.= '<div class="checkbox"><label>';
                $labelTabContent.= '<input type="checkbox" name="permissions_user[]" value="' . $permission->id . '" ' . $checked . '>';
                $labelTabContent.= $permission->display_name;
                $labelTabContent.= '</label></div>';
            }
        }

        return $labelTabContent;
    }
}


