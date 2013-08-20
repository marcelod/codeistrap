<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class MY_Model extends CI_Model{

    /**
    * table
    *
    * The database table of the model
    *
    * When extending this class, you should set the table name in the constructor
    *
    * @var string
    * @access protected
    */
    protected $table;

    /**
    * primary_key
    *
    * The primary key of the model's table.
    *
    * When extending this class you may want to change it to fit your tables' primary key field.
    *
    * @var string
    * @access protected
    */
    protected $primary_key = 'id';
    
    /**
    * return_type
    *
    * Which type of data methods should return.
    * Options are:
    * - 'array' 
    * - 'object' (Default)
    *
    * If you want methods to return objects, change this value
    * in your Models' constructors.
    *
    * @var mixed
    * @access protected
    */
    protected $return_type = 'object';

   

    // protected $tables_sem_opt_deletado = array('
    //     tb_menu_tipo_user', 'tb_log', 'tb_user_treeview', 'tb_last_log_ficha', 'tb_ci_sessions', 'tb_estat_ficha_diario'
    //     );



    /**
    * constructor method
    */
    public function __construct()
    {
        parent::__construct();
    }


    /**
    * get
    *
    * Method to retrieve data from database
    * This method tries to return just one record, but if it finds
    * more records, it will return all of them in an array, just like
    * the 'filter' method.
    * Useful when you want just one row. For many rows 'filter' is
    * the best option.
    *
    * Examples:
    *
    * $where :
    * 'id = 1'
    * or
    * array('id' => 1, 'other_id' => 2)
    *
    *
    * @param array $where Can be an array or a string
    * @param array $fields Can be an array or an string
    * @access public
    * @return void
    */
    public function get($where = '', $fields = '', $order = '')
    {
        $results = $this->filter($where, $fields, $order);

//        if (count($results) == 1) {
//            return $results[0];
//        }

        return $results;
    }
    
    public function get_alter($id)
    {
        return $this->db
                ->where('id', $id)
                ->get($this->table)
                ->row();
    }
    
    
    public function get_dd($order, $where = '')
    {
        if (is_array($order)) {
            foreach ($order as $f => $t){
                $this->db->order_by($f, $t);
            }
        }
        elseif (strlen($order) > 0) {
            $this->db->order_by($order);
        }
        
        if (is_array($where)) {
            foreach ($where as $f => $w){
                $this->db->where($f, $w);
            }
        }
        elseif (strlen($where) > 0) {
            $this->db->where($where);
        }
        
        $this->db->where('opt_ativo', 1);
        $this->db->where('opt_deletado', 0);
        $query = $this->db->get($this->table);
        
        if ($this->return_type == 'array') {
            $results = $query->result_array();
        }
        else {
            $results = $query->result();
        }
        
        return $results;                
    }
    
    
   
    /**
    * save
    *
    * Method to save data to the database.
    *
    * To update data you must have an {$this->primary_key} element in the given array.
    *
    * This method returns the row id (inserted or updated)
    *
    * @param array $data
    * @access public
    * @return mixed
    */
    public function save($data)
    {
        if (isset($data[$this->primary_key]) AND $data[$this->primary_key] != 0) {
            $this->db->where($this->primary_key, $data[$this->primary_key]);
            $this->db->update($this->table, $data);
        }
        else {
            $this->db->insert($this->table, $data);
            $data[$this->primary_key] = $this->db->insert_id();
        }
        
        return ($this->db->affected_rows() > 0) ? $data[$this->primary_key] : FALSE;
    }
    
    
    public function save_batch($data)
    {
        $this->db->insert_batch($this->table, $data);
    }

    /**
    * filter
    *
    * Method to retrieve data from database.
    * This method will always return an array of results,
    * even if it's just one row.
    *
    * @param array $where Can be an array or a string
    * @param array $fields Can be an array or a string
    * @access public
    * @return array
    */
    public function filter($where = '', $fields = '', $order = '')
    {
        $this->db->from($this->table);

        // if( ! in_array($this->table, $this->tables_sem_opt_deletado) ) { 
        //     $this->db->where('opt_deletado', 0);
        // }        

        if (is_array($where)) {
            foreach ($where as $f => $w){
                $this->db->where($f, $w);
            }
        } elseif (strlen($where) > 0) {
            $this->db->where($where);
        }

        
        if (is_array($fields)) {
            foreach ($fields as $field) {
                $this->db->select($field);
            }
        } elseif (strlen($fields) > 0) {
            $this->db->select($fields);
        }

        if (is_array($order)) {
            foreach ($order as $f => $o){
                $this->db->order_by($f, $o);
            }
        } elseif (strlen($order) > 0) {
            $this->db->order_by($order);
        }

        $query = $this->db->get();

        if ($this->return_type == 'array') {
            $results = $query->result_array();
        } else {
            $results = $query->result();
        }

        return $results;
    }

    /**
    * delete
    *
    * removes a row from database
    * altera o status opt_deletado para 1
    *
    * @param integer $id
    * @access public
    * @return booelan
    */
    public function delete($id)
    {
        if (! is_numeric($id)) {
            return FALSE;
        }
        else {
            $this->db
                    ->where($this->primary_key, $id)
                    ->update($this->table, array('opt_deletado'=>'1'));
//                    ->delete($this->table);

            return TRUE;
        }
    }

    /**
    * count_results
    *
    * Count the number of rows in a table
    *
    * @param array $where
    * @access public
    * @return void
    */
    public function count_results($where = '')
    {
        if (is_array($where)) {
            foreach ($where as $f => $w){
                $this->db->where($f, $w);
            }
        }
        elseif (strlen($where) > 0) {
            $this->db->where($where);
        }

        return $this->db->count_all_results($this->table);
    }

    /**
    * paginate
    *
    * Function to paginate results from the database. It only retrieve the needed rows
    *
    * @param int $offset
    * @param int $quantity
    * @param array $where Can be an array or a string
    * @access public
    * @return array
    */
    public function paginate($offset, $rows = 10, $where = '', $fields = '')
    {
        if (is_array($where)) {
            foreach ($where as $f => $w){
                $this->db->where($f, $w);
            }
        }
        elseif (strlen($where) > 0) {
            $this->db->where($where);
        }

        if (is_array($fields)) {
            foreach ($fields as $field) {
                $this->db->select($field);
            }
        }
        elseif (strlen($fields) > 0) {
            $this->db->select($fields);
        }

        $this->db->limit($quantity, $offset);

        $this->db->get($this->table);

        if ($this->return_type == 'array') {
            $results = $query->result_array();
        }
        else {
            $results = $query->result();
        }

        return $results;
    }

    /**
    * count
    *
    * Returns the number of results
    *
    * @access public
    * @return integer
    */
    public function count()
    {
        return $this->db->count_all_results($this->table);
    }
    
    /**
     * liberar
     * 
     * funcao criada para ativar ou inativar um item.
     * primeiro eh preciso saber como o item esta (1 ou 0)
     * a partir disso ira atualizar a tabela
     * 
     * @param int $cod
     * @access public
     * @return booelan
     */    
    public function liberar($cod)
    {
        $result = $this->get("id = $cod", "opt_ativo");
        
        $data['id'] = $cod;
        $data['opt_ativo'] = $result[0]->opt_ativo == 0 ? 1 : 0;
        
        return $this->save($data);
    }
    
    
    
    public function truncate()
    {
        $this->db->truncate($this->table);
    }
    
    
    public function set_big_select()
    {        
        return $this->db->query('SET SQL_BIG_SELECTS=1');
    }

    
}

/* End of file MY_Model.php */
/* Location: ./application/core/MY_Model.php */