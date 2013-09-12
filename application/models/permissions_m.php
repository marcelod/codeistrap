<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Permissions_m extends MY_Model {
    
    public function __construct(){
        parent::__construct();
        
        $this->table = "permissions";
    }

    public function get_menu($local = 'site')
    {
    	$menu = $this->db
            ->select('p.id, p.name, p.display_name, p.permission_id, p.link, pr.role_id')
            ->from('permissions p')
            ->join('permissions_role pr', 'p.id = pr.permission_id', 'left')
            ->where('p.opt_menu', 1)
            ->where('p.local', $local)
            ->order_by('p.ordem')
            ->get();
        
        if ($menu->num_rows() > 0) {
            return $menu->result();
        } else {
            return array();
        }
    }


    public function get_permissions_config_user($user_id)
    {
        $menu = $this->db->query('
                SELECT p.id, p.name, p.display_name, p.opt_menu, p.permission_id, p.local, p.link, 
                (select 1 from permissions_user where user_id = ' . $user_id . ' and permission_id = p.id) as checked
                FROM permissions p
                where p.id in( select permission_id from permissions_user ) 
                ORDER BY p.opt_menu desc, p.local , p.ordem, p.display_name
        ');
        
        if ($menu->num_rows() > 0) {
            return $menu->result();
        } else {
            return array();
        }   
    }

}