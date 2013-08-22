<?php

/**
 * cAlerts
 *
 * Generates an HTML to Component Alerts twitterBootstrap
 * http://getbootstrap.com/components#alerts
 *
 * @access  public
 * @param   string
 * @param   string
 * @param   boolean
 * @param   mixed
 * @return  string
 */
if ( ! function_exists('cAlerts'))
{
    function cAlerts($msg, $tipo = "alert-dismissable", $close = true, $icon = "&times;")
    {
        $box = "<div class='alert " . $tipo . "'>";

        if ($close) 
            $box .= "<button type='button' class='close' data-dismiss='alert'>" . $icon . "</button>";

        $box .= $msg;

        $box .= "</div>";
        
        return $box;
    }
}


/**
 * pageHeader
 *
 * Generates an HTML to pageHeader
 * http://getbootstrap.com/css/#type
 *
 * @access  public
 * @param   string
 * @param   string
 * @return  string
 */
if ( ! function_exists('pageHeader'))
{
    function pageHeader($descryption, $header = "h1")
    {
        $box = "<div>";
        $box .= "<" . $header . ">" . $descryption . "</" . $header . ">";        
        $box .= "</div><hr>";
        
        return $box;
    }
}