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
        $html .= '<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">';
        $html .= 'Ação <span class="caret"></span>';
        $html .= '</button>';
        $html .= '<ul class="dropdown-menu" role="menu">';

        if($conf) 
        {
            $html.= '<li>';
            $html.= '<a data-target="#conf" data-toggle="modal" class="conf_row_dt" data-id="' . $id .'" href="#">';
            $html.= '<span class="glyphicon glyphicon-wrench"></span> Configurar';
            $html.= '</a>';
            $html.= '</li>'; 
        }  
        
        if($edit)
        {
            $html.= '<li>';
            $html.= '<a data-target="#edit" data-toggle="modal" class="edit_row_dt" data-id="' . $id .'" href="#">';
            $html.= '<span class="glyphicon glyphicon-edit"></span> Editar';
            $html.= '</a>';
            $html.= '</li>';
        }

        if($active !== FALSE)
        {
            $html.= '<li>';
            $html.= '<a href="'. $controller .'/active/' . $id .'/' . $active . '" class="active_row_dt">';
            $html.= "<span class='glyphicon glyphicon-";
            $html.= $active ? "minus-sign'></span> Inativar" : "plus-sign'></span> Ativar";
            $html.= '</a>';
            $html.= '</li>';
        } 

        if($delete)
        {
            $html.= '<li>';
            $html.= '<a data-target="#delete" data-toggle="modal" class="delete_row_dt" data-id="' . $id .'" href="#">';
            $html.= '<span class="glyphicon glyphicon-trash"></span> Apagar';
            $html.= '</a>';
            $html.= '</li>';
        }

        $html .= '</ul>';
        $html .= '</div>';

        
        return $html;
    }
}

