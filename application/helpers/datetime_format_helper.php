<?php

/**
 * recebe um valor inteiro em segundos e retorna essa quantidade em HORA:MINUTO:SEGUNDO
 */
if ( ! function_exists('seconds_to_time'))
{
    function seconds_to_time($seconds)
    {
        return gmdate("H:i:s", $seconds);
    }
}



/**
 * converte uma data de um formato americano para um formato brasileiro
 */
if ( ! function_exists('data_us_to_br'))
{
    function data_us_to_br($dateUSA)
    {
        if($dateUSA) {
             $ano = substr($dateUSA, 0, 4);
             $mes = substr($dateUSA, 5, 2);
             $dia = substr($dateUSA, 8, 2);
             $dateBR = $dia .'/'. $mes .'/'. $ano;
             return $dateBR;
        } else {
            return NULL;
        }
    }
}


/**
 * converte uma data do banco para o formato brasileiro contendo data e hora
 */
if ( ! function_exists('data_time_to_br'))
{
    function data_time_to_br($date_time)
    {
        if($date_time) {
             $ano = substr($date_time, 0, 4);
             $mes = substr($date_time, 5, 2);
             $dia = substr($date_time, 8, 2);
             $dateBR = $dia .'/'. $mes .'/'. $ano;
             $dateBR.= substr($date_time, -9,9);
             return $dateBR;
        } else {
            return NULL;
        }
    }
}

/**
 * converte de um formato brasileiro para um formato americano
 */
if ( ! function_exists('data_br_to_us'))
{
    function data_br_to_us($dateBR)
    {
        if($dateBR) {
             $ano = substr($dateBR, 6, 4);
             $mes = substr($dateBR, 3, 2);
             $dia = substr($dateBR, 0, 2);
             $dateUSA = $ano .'-'. $mes .'-'. $dia;
             return $dateUSA;
        } else {
            return NULL;
        }
    }
}

/**
 * converte um valor timestamp para formato de data e hora brasileiro
 */
if ( ! function_exists('get_timestamp_to_time'))
{
    function get_timestamp_to_time($timestamp)
    {
        if($timestamp){
            $date = new DateTime();
            $date->setTimestamp($timestamp);
            return $date->format('d/m/Y H:i:s');
        } else {
            return NULL;
        }
    }
}


