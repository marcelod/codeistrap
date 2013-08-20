<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_m extends MY_Model {

    
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
                'role_id' => ROLE_USER
            );

            $this->load->model('assigned_roles_m');
            return $this->assigned_roles_m->save($dados_ar);    
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

    ####################

    

    public function get_duplicate_email($dados)
    {

        if(isset($dados['id']))
            $this->db->where('id <> ' . $dados['id']);

        $where = "(str_login = '" . $dados['str_email'] . "'";
        $where.= " OR str_email = '" . $dados['str_email'] . "'";
        $where.= " OR str_email_secundario = '" . $dados['str_email'] . "'";

        if(isset($dados['str_email_secundario']) && $dados['str_email_secundario'] != "") {
            $where.= " OR str_login = '" . $dados['str_email_secundario'] . "'";
            $where.= " OR str_email = '" . $dados['str_email_secundario'] . "'";
            $where.= " OR str_email_secundario = '" . $dados['str_email_secundario'] . "')";
        } else {
            $where.= ")";
        }

        $query = $this->db->where($where)->get($this->table);

        if ($query->num_rows() > 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
    
    public function get_login_tipo_user($login)
    {
        $where = "(u.str_login = '$login' OR u.str_email = '$login') 
                  AND u.opt_ativo = 1 
                  AND u.opt_deletado = 0
                  AND tu.opt_ativo = 1 
                  AND tu.opt_deletado = 0";
        
        $query = $this->db
                ->select('u.id, u.id_tipo_user, u.str_nome, u.str_sobrenome, u.str_login')
                ->select('u.str_email, u.str_pwd, u.opt_treeview, u.id_theme, u.opt_first_access')
                ->select('u.dt_ini, u.dt_fim')
                ->select('tu.opt_incluir, tu.opt_excluir, tu.opt_atualizar, tu.opt_status')
                ->from("$this->table u")
                ->join('tb_tipo_user tu', 'tu.id = u.id_tipo_user')
                ->where($where)
                ->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }
    
    
    public function get_join() {
        $query = $this->db
                  ->select('u.*, a.str_tipo_user')
                  ->from("$this->table u")
                  ->join('tb_tipo_user a', 'a.id = u.id_tipo_user')
                  ->where('u.opt_deletado','0')
                  ->order_by('u.str_nome ASC')
                  ->get();
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }
    
    
    public function get_data_ajax($tipo) {
        $this->load->library('Datatables');
        $fields = "tb_user.id as id, tb_user.str_nome as nome, tb_user.str_sobrenome as sobrenome, tb_user.str_login, tb_user.str_email";
        $fields.= ",a.str_tipo_user, tb_user.dt_ini as dt_ini, tb_user.dt_fim as dt_fim, tb_user.opt_ativo as opt_ativo";
        $this->datatables
                ->distinct($fields)
                ->select($fields)
                ->from('tb_user')
                ->join('tb_tipo_user a', 'a.id = tb_user.id_tipo_user')
                ->where('tb_user.opt_deletado','0');
        
        // caso o usuario que esteja acessando nao seja um ADM
        // seleciona somente os usuarios da empresa do mesmo que esta acessando
        // e não seleciona os ADM que estejam cadastrados para a empresa
        if($this->session->userdata('id_tipo_user') != ID_ADM ) {
            $id_user = $this->session->userdata('id_user');
            
            $this->datatables->join('tb_cliente_usuario uc', 'uc.id_user = tb_user.id');
            $this->datatables->where("uc.id_cliente in(select id_cliente from tb_cliente_usuario where id_user = $id_user)");
            $this->datatables->where('tb_user.id_tipo_user !=', ID_ADM);
        }
        
        $this->datatables->edit_column('nome', '$1', 'concat(nome, sobrenome)');
        $this->datatables->edit_column('dt_ini', '$1', 'data_us_to_br(dt_ini)');
        $this->datatables->edit_column('dt_fim', '$1', 'data_us_to_br(dt_fim)');
        
        if($tipo == 'actions') {
            $this->datatables->edit_column(
                'opt_ativo', 
                '$1',
                "coluna_acao_ajax('cadastro/usuario', 'id', 'opt_ativo')");
        } else if($tipo == 'comunicacao') {
            $this->datatables->distinct('tb_user.dt_envio, tb_user.opt_first_access');
            $this->datatables->select('tb_user.dt_envio, tb_user.opt_first_access');
            $this->datatables->edit_column(
                'tb_user.dt_envio', 
                '$1',
                "set_coluna_envio_senha('id', 'tb_user.dt_envio', 'tb_user.opt_first_access')");
            $this->datatables->edit_column(
                'tb_user.opt_first_access', 
                '$1',
                "set_user_acessou('tb_user.opt_first_access')");
            $this->datatables->add_column(
                'mensagem', 
                '$1',
                "set_msg_usuario('id')");
        }
        
        echo $this->datatables->generate();
    }
    
    
    public function get_pass($data = NULL) {
        $query = $this->db
                ->select('str_pwd')
                ->where('str_email', $data)
                ->get($this->table);

        if ($query->num_rows() > 0) {
            $row = $query->result();
            return $row[0]->str_pwd;
        }

        return FALSE;
    }
    
    
    public function set_new_pass($data = NULL) {
        $query = $this->db
                ->select('id, opt_first_access')
                ->where('str_email', $data)
                ->get($this->table);
        

        if ($query->num_rows() > 0) {
            $senha_gerada = gera_str(8, 'num_str');
            $this->load->library('encrypt');
            $dados['str_pwd'] = $this->encrypt->encode($senha_gerada);
            
            $row = $query->result();
            
            $dados['id'] = $row[0]->id;
            $dados['opt_first_access'] = 1;
            
            $this->save($dados);
            
            return $senha_gerada;
        }

        return FALSE;
    }
    
    
    public function avatar_user() {
        return $this->db
                ->select('str_image')
                ->where('id', $this->session->userdata('id_user'))
                ->get($this->table)
                ->row();
    }   
    
   

    public function editar($dados)
    {
        $this->db->where('id', $this->session->userdata('id_user'));
        return $this->db->update($this->table, $dados); 
    }    
    

    public function alter_treeview($post_tv) {
        return $this->db
                ->where('id', $this->session->userdata('id_user'))
                ->update($this->table, array('opt_treeview'=>$post_tv));     
    }
    
        
    public function get_all_user($data) {
        $query = $this->db
                ->select('u.id, u.str_nome, u.str_sobrenome, u.str_email')
                ->select("(select distinct 1 from tb_user_treeview ut where ut.id_user = u.id and ut.id_hierarquia = " . $data['id_hierarquia']. ") as id_utv")
                ->select("(select count(distinct ut.id_indicador) from tb_user_treeview ut where ut.id_user = u.id and ut.id_hierarquia = " . $data['id_hierarquia']. ") as tot_indi")                
                ->from("$this->table u")
                ->join('tb_cliente_usuario uc', 'uc.id_user = u.id')
                ->where('uc.id_cliente', $data['id_cliente'])
                ->where('u.opt_deletado', 0)
                ->where('u.opt_ativo', 1)
                ->where('u.id_tipo_user', ID_RES) //buscar apenas usuarios respondentes
                ->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }
    

    public function get_gestores($dados){
        $query = $this->db
                ->distinct()
                ->select('u.id, u.str_nome, u.str_sobrenome')
                ->from("$this->table u")
                ->join('tb_cliente_usuario uc','uc.id_user = u.id')
                ->where('u.opt_deletado', 0)
                ->where('u.opt_ativo', 1)
                ->where('u.id_tipo_user', ID_GES) //buscar apenas usuarios gestores
                ->where('uc.id_cliente', $dados['id_cliente'])
                ->order_by('u.str_nome, u.str_sobrenome')
                ->get();
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }
    
    
    public function get_gestor_ficha($id_hierarquia) {
        $query = $this->db
                ->select('u.id, u.str_nome, u.str_sobrenome, u.str_email, u.str_telefone')
                ->from("$this->table u")
                ->join('tb_hierarquia h','h.id_user = u.id')
                ->where('h.id', $id_hierarquia)
                ->get();
        
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return array();
        }
    }


    public function get_usuario_to_indicador_tree_view($dados) {
        $this->db
            ->distinct()->select('u.id, u.str_nome, u.str_sobrenome')
            ->from('tb_last_log_ficha llf')
            ->join('tb_user u', 'llf.id_user = u.id')
            ->join('tb_hierarquia h', 'llf.id_hierarquia = h.id')
            ->where('u.opt_ativo', 1)
            ->where('u.opt_deletado', 0)
            ->where('h.opt_ativo', 1)
            ->where('h.opt_deletado', 0)
            ->where('h.id_cliente', $dados['id_cliente'])
            ->where('llf.id_indicador', $dados['id_indicador'])
            ->order_by('u.str_nome, u.str_sobrenome ASC');

        if($this->session->userdata('id_tipo_user') == ID_GES) {
            $this->db->where('h.id_user', $this->session->userdata('id_user'));
        }

        if($dados['id_status_ficha'] != "*") {
            $this->db->where('llf.id_status_ficha', $dados['id_status_ficha']);
        }
        
        /*caso esteja na aba gestor deve ser informado o id_user do gestor da hierarquia*/
        if(isset($dados['id_user'])) {
            $this->db->where('h.id_user = ' . $dados['id_user']);
        }

        $query = $this->db->get(); 

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }


    public function get_usuario_to_cliente_treeview($dados) {
        $this->db
            ->distinct()->select('u.id, u.str_nome, u.str_sobrenome')
            ->from('tb_last_log_ficha llf')
            ->join('tb_user u', 'llf.id_user = u.id')
            ->join('tb_hierarquia h', 'llf.id_hierarquia = h.id')
            ->where('u.opt_ativo', 1)
            ->where('u.opt_deletado', 0)
            ->where('h.opt_ativo', 1)
            ->where('h.opt_deletado', 0)
            ->where('h.id_cliente', $dados['id_cliente'])
            ->order_by('u.str_nome, u.str_sobrenome ASC');

        if($dados['id_status_ficha'] != "*") {
            $this->db->where('llf.id_status_ficha', $dados['id_status_ficha']);
        }

        if($this->session->userdata('id_tipo_user') == ID_GES) {
            $this->db->where('h.id_user', $this->session->userdata('id_user')); 
        }

        $query = $this->db->get(); 

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }


    public function get_gestor_to_cliente_treeview($dados) {
        $id_status_ficha = $dados['id_status_ficha'];
        $id_cliente      = $dados['id_cliente'];

        $this->db
            ->distinct()->select('u.id, u.str_nome, u.str_sobrenome')
            ->from("$this->table u")
            ->join('tb_cliente_usuario uc', "u.id = uc.id_user AND uc.id_cliente = " . $id_cliente)
            ->join('tb_hierarquia h', "u.id = h.id_user AND h.id_cliente = " . $id_cliente)
            ->join('tb_user_treeview ut', 'h.id = ut.id_hierarquia')
            ->where('u.opt_deletado', 0)
            ->where('u.opt_ativo', 1)
            ->where('u.id_tipo_user', ID_GES)
            ->order_by('u.str_nome ASC, u.str_sobrenome ASC');

        if($id_status_ficha != "*") {
            $this->db
                ->join('tb_last_log_ficha llf', 'h.id = llf.id_hierarquia AND ut.id_user = llf.id_user AND ut.id_indicador = llf.id_indicador')
                ->where('llf.id_status_ficha', $id_status_ficha);             
        }
        
        $query = $this->db->get(); 

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }


    public function get_user_tipo($id_tipo_user = ID_GES, $id, $table) {
        if($table === 'cliente') {
            $this->db->join('tb_cliente_usuario uc', 'uc.id_user = u.id');
            $this->db->where('uc.id_cliente', $id);
        } else if($table === 'grupo') {
            $this->db->join('tb_cliente_usuario uc', 'uc.id_user = u.id');
            $this->db->join('tb_cliente c', 'c.id = uc.id_cliente');
            $this->db->where('c.id_grupo', $id);
        }

        $this->db
                ->distinct()->select('u.id, u.str_nome, u.str_sobrenome')
                ->from("$this->table u")
                ->where('u.opt_deletado', 0)
                ->where('u.opt_ativo', 1)
                ->where('u.id_tipo_user', $id_tipo_user)
                ->order_by('u.str_nome, u.str_sobrenome');
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }


    public function qtde_ativo_inativo()
    {
        $arr_user = get_users_to_user_logged();

        $this->db
            ->select('u.opt_ativo AS label')
            ->select('count(u.opt_ativo) AS qtde')
            ->from("$this->table u")
            ->group_by('u.opt_ativo')
            ->order_by('count(u.opt_ativo) DESC')
            ->where('u.opt_deletado', 0)
            ->where_in('u.id', $arr_user);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }


    public function qtde_tipo_user()
    {
        $arr_user = get_users_to_user_logged();

        return $this->db
            ->select('tu.str_tipo_user AS label')
            ->select('count(u.id_tipo_user) AS qtde')
            ->from("$this->table u")
            ->join('tb_tipo_user tu', 'u.id_tipo_user = tu.id')
            ->where('u.opt_deletado', 0)
            ->where('tu.opt_deletado', 0)
            ->where_in('u.id', $arr_user)
            ->group_by('tu.str_tipo_user')
            ->order_by('count(u.id_tipo_user) ASC')
            ->get()
            ->result();
    }


    public function get_usuarios_hierarquia($id_hierarquia)
    {
        $query = $this->db
                    ->distinct()
                    ->select('u.id, u.str_nome, u.str_sobrenome')
                    ->from('tb_user_treeview ut')
                    ->join('tb_user u', 'u.id = ut.id_user')
                    ->where('ut.id_hierarquia', $id_hierarquia)
                    ->where('u.opt_ativo = 1 and u.opt_deletado = 0')
                    ->order_by('u.str_nome, u.str_sobrenome')
                    ->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }



}
