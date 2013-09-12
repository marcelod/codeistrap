<?php


/**
 * verifico se ativo, caso ok retorno a string active
 * 
 * @access public
 * 
 * @return string
 */
if ( ! function_exists('isActive'))
{
    function isActive($active = TRUE)
    {
        return $active ? " active " : "";
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