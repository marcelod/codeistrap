<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_m extends MY_Model {


    const ROLE_USER = 2;

    
    public function __construct(){
        parent::__construct();
        
        $this->table = "users";
    }


    public function register($dados)
    {
        $user_id = $this->save($dados);
        if($user_id != FALSE) {
            $dados_ar = array(
                'user_id' => $user_id,
                'role_id' => self::ROLE_USER // ROLE USER
            );

            $this->load->model('assigned_roles_m');
            $this->assigned_roles_m->save($dados_ar);

            $this->load->helper('roles');
            return setPermissionsRoleUser(self::ROLE_USER, $user_id);
        }

        return FALSE;               
    }


    public function get_login($login)
    {
        $query = $this->db
                    ->where('username', $login)
                    ->or_where('email', $login)
                    ->get($this->table);

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }


    public function get_user_id($user_id = 0)
    {
        if($user_id === 0)
            $user_id = $this->session->userdata('user_id');
        

        $query = $this->db
                    ->where('id', $user_id)
                    ->get($this->table);

     
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }


    public function get_duplicate_login($dados)
    {
        if(isset($dados['id']))
            $this->db->where('id <> ' . $dados['id']);

        $where = "(username = '" . $dados['username'] . "' OR email = '" . $dados['username'] . "')";
        $query = $this->db->where($where)->get($this->table);
        
        if ($query->num_rows() > 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }


    public function getDataTable()
    {
        $this->load->library('Datatables');
        $this->load->helper('datatables');

        $this->datatables
            ->select('id, name, email, gender, confirmed, active')
            ->from($this->table)
            ->add_column("actions", "$1", "actionsDataTable('id', 'admin/users',1,1,1,'active')");

        return $this->datatables->generate();
    }

    

}
