<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Permissions_role_m extends MY_Model {
    
    public function __construct(){
        parent::__construct();
        
        $this->table = "permissions_role";
    }



    public function getPermissionName($roles = array(), $permissionName = "")
    {
    	$query = $this->db
                    ->from('permissions_role pr')
                    ->join('permissions p', 'p.id = pr.permission_id')
                    ->where_in('pr.role_id', $roles)
                    ->where('p.name', $permissionName)
                    ->get();

        if ($query->num_rows() == 0)
        {
            return FALSE;
        }

        $display = array();
        $permissions = $query->result();
        foreach ($permissions as $p)
        {
            $display[] = $p->display_name;
        }

        return $display;
    }

}