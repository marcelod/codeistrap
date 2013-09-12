<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_mailing_m extends MY_Model {

    
    public function __construct(){
        parent::__construct();
        
        $this->table = "users_mailing";
    }


    public function add_list($acept, $data)
    {
        if($acept == TRUE && is_array($data))
        {
            $dados = array(
                'name'       => $data['name'],
                'email'      => $data['email'],
                'token'      => $data['token'],
                'created_at' => $data['created_at'],
                'updated_at' => $data['created_at']
                );

            $this->save($dados);
        }

        return FALSE;
    }
}
