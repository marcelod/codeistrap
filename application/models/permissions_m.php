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

}