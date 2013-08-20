<?php if ( ! defined( 'BASEPATH' ))  exit ( 'No direct script access allowed' );

/*
 * recebe uma string e retorna somente letras e numeros
 */
function limpa_string($str)
{
    if($str != "") {
        return preg_replace("/[^a-zA-Z0-9\s]/", "", $str);
    } 
    
    return $str;
}


/*
 * funcao para gerar string randomica
 * $qtde de caracteres que ira retornar
 * $tipo all para retornar letras, numeros e caracteres especiais
 *       nun para retornar numeros
 *       str para retornar letras
 *       num_str para retornar numeros e letrar
 */
function gera_str($qtde = 8, $tipo = 'all') {
    switch ($tipo) {
        case 'all':
            $cons = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@&#%";
            break;
        
        case 'num':
            $cons = "0123456789";
            break;
        
        case 'str':
            $cons = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
            break;
        
        case 'num_str':
            $cons = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            break;
        
        default :
            $cons = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@&#%";
            break;
    }
    
    
    $gerado = "";
    $length = strlen($cons);
    for($i=0 ; $i<$qtde ; $i++) {
        $pos = rand(1, $length);
        $gerado.= substr($cons, $pos, 1);
    }
    
    return $gerado;
}


function normalize($string) {
    $table = array(
        'Š'=>'S', 'š'=>'s', 'Đ'=>'Dj', 'đ'=>'dj', 'Ž'=>'Z', 'ž'=>'z', 'Č'=>'C', 'č'=>'c', 'Ć'=>'C', 'ć'=>'c',
        'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
        'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O',
        'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss',
        'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'ae', 'ç'=>'c', 'è'=>'e', 'é'=>'e',
        'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o',
        'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b',
        'ÿ'=>'y', 'Ŕ'=>'R', 'ŕ'=>'r', '$'=>'S', '&'=>'E'
    );
   
    return strtr($string, $table);
}

