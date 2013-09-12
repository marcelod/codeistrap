<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
    }


    public function search_zipcode()
    {
        $zipcode = $this->input->get_post('zipcode');
        if( strstr($zipcode, '_') || strlen($zipcode) < 8 )
            $zipcode = '0';
       
        $dados = $this->getZipCodeRepublicaVirtual($zipcode);
        $this->output->set_output($dados);
    }


    protected function getZipCodeRepublicaVirtual($zipcode)
    {
        $zipcode = str_replace('.', '', $zipcode);
        $zipcode = str_replace('-', '', $zipcode);
         
        $url = 'http://republicavirtual.com.br/web_cep.php?cep=' . urlencode($zipcode) . '&formato=json';
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);        
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);        
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_POST, 0);
         
        $resultado = curl_exec($ch);
        curl_close($ch);
         
        if( ! $resultado)
            $resultado = "&resultado=0&resultado_txt=erro+ao+buscar+cep";
            // return false;
         
        // $resultado = urldecode($resultado);
        // $resultado = utf8_encode($resultado);
        // parse_str( $resultado, $retorno);
         
        return $resultado;
    }



    public function getPermissionsRole()
    {
        if($this->input->post('roleId'))
        {
            $arPermissions = array();
            
            $data['role_id']    = $this->input->post('roleId');
            
            $this->load->model('permissions_role_m');
            $permissions = $this->permissions_role_m->get($data, 'permission_id');

            foreach ($permissions as $permission) {
                $arPermissions[] = $permission->permission_id;
            }

            echo json_encode(array(
                'success' => true,
                'permissions' => $arPermissions
            ));
        }

        return FALSE;
    }

    

}