<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Assigned_roles_m extends MY_Model {
    
    public function __construct(){
        parent::__construct();
        
        $this->table = "assigned_roles";
    }   

}