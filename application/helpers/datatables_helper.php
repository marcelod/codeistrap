<?php

/**
 * actionsDataTable
 *
 * Define os elementos, controller para criar as ações para o DataTable
 *
 * @access  public
 * @param   int
 * @param   string
 * @param   boolean
 * @param   boolean
 * @param   boolean
 * @param   mixed       $active default FALSE
 * 
 * caso $active seja diferente de FALSE é que tem a opação para ativar/inativar o elemento
 *      podendo ser 1 ou 0, com isso já sei que 
 *          caso seja passado 1 o elemento esta ativo e tem que dar a opção para inativar
 *          caso seja passado 0 o elemento esta inativo e tem que dar a opção para ativar
 */
if ( ! function_exists('actionsDataTable'))
{
    function actionsDataTable($id, $controller, $delete = TRUE, $edit = TRUE, $config = TRUE, $active = FALSE)
    {
        $actions = array();
    
        if($delete) array_push ($actions, 'delete');
        if($edit)   array_push ($actions, 'edit');
        if($config) array_push ($actions, 'config');
        if($active !== FALSE) array_push ($actions, array('active' => $active));
        
        return actionColumn($id, $controller, $actions);
    }
}



/**
 * actionColumn
 *
 * Create element to actions on DataTables with component button dropdowns
 * http://getbootstrap.com/components/#btn-dropdowns
 *
 * @access  public
 * @param   int
 * @param   string
 * @param   array
 * 
 */
if ( ! function_exists('actionColumn'))
{
    function actionColumn($id, $controller, $actions = array())
    {
        $html = "";
        $delete = FALSE;
        $edit   = FALSE;
        $conf   = FALSE;
        $active = FALSE;
            
        if(is_array($actions) && !empty ($actions))
        {
            foreach ($actions as $value) {
                if(is_array($value)) {
                    $active = array_key_exists('active', $value) ? $value['active'] : $active;                    
                } else {
                    $delete = $value == 'delete' ? TRUE : $delete;
                    $edit = $value == 'edit' ? TRUE : $edit;
                    $conf = $value == 'config' ? TRUE : $conf;
                }
            }

        }

        $html .= '<div class="btn-group">';
        $html .= '<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">';
        $html .= 'Ação <span class="caret"></span>';
        $html .= '</button>';
        $html .= '<ul class="dropdown-menu" role="menu">';
        
        if($delete) $html.= '<li><a href="'. $controller .'/delete/' . $id .'" class="delete_row_dt"><span class="glyphicon glyphicon-trash"> Apagar</span></a></li>';
        if($edit)   $html.= '<li><a href="'. $controller .'/edit/' . $id .'" class="edit_row_dt"><span class="glyphicon glyphicon-pencil"> Editar</span></a></li>';
        if($conf)   $html.= '<li><a href="'. $controller .'/conf/' . $id .'" class="conf_row_dt"><span class="glyphicon glyphicon-wrench"> Configurar</span></a></li>';
        
        if($active !== FALSE)
        {
            $html.= '<li><a href="'. $controller .'/active/' . $id .'/' . $active . '" class="active_row_dt">';
            $html.= "<span class='glyphicon glyphicon-";
            $html.= $active ? "minus-sign'> Inativar" : "plus-sign'> Ativar";
            $html.='</span></a></li>';
        } 

        $html .= '</ul>';
        $html .= '</div>';

        
        return $html;
    }
}

