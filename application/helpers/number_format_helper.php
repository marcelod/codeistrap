<?php

/*
 * retorna o valor formatado para guardar no BD 
 */
function num_to_db($num = 0)
{
    if($num != 0) {
        $num = str_replace('.', '', $num);
        $num = str_replace(',', '.', $num);
        
        return number_format($num, 2, '.', '');
    }
    
    return '0.00';
}

function format_num_db($n = 0) {

    if(substr($n, -3, 1) == '.') 
    {
        return str_replace(',', '', $n);
    } 
    else if(substr($n, -3, 1) == ',') 
    {
        $n = str_replace('.', '', $n);
        return str_replace(',', '.', $n);
    }
    else if(substr($n, -3, 1) == ":")
    {
        return str_replace(':', '.', $n);
    }
    else if($n == "") {
        return NULL;
    }
    else
    {
        $casas_decimais = conta_casas_decimais($n, ",");
        if($casas_decimais > 2)
        {
            $n = str_replace('.', '', $n);
            $n = str_replace(',', '', $n);
            return number_format($n, 2, '.', '');
        }
        else
        {
            return $n;
        }
    }
    
    return $n;
}

/*
 * retorna o valor do BD e formata para exibir ao usuario final
 */
function num_to_user($num = 0) {
    if($num != 0) {
        return number_format($num, 2, ',', '.');
    }
    
    return '0,00';
}

/*
 * retorna o valor do BD e formata para exibir ao usuario final sem casas decimais
 */
function num_sem_decimal($num = 0) {
    if($num != 0) {
        return number_format($num, 0, '', '');
    }
    
    return '0';
}

function num_decimal($valor, $casas_decimais = 2){
    $v = num_sem_decimal($valor);
    if($v == 0) {   
        $val = str_pad('0,00', $casas_decimais + 2, '0', STR_PAD_RIGHT);
    } else {
        $div = str_pad(1, $casas_decimais + 1, '0', STR_PAD_RIGHT);
        if(strlen($v) == 1) {
            $val = str_replace("1.", "0,", ($v/$div) + 1);
        } else {
            $val = number_format($v/$div, $casas_decimais, ',', '.');
        }
    }

    return $val;
}


function add_percent($valor)
{
    return $valor . "%";
}