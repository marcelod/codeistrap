<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Password_reminders_m extends MY_Model {
    
    public function __construct(){
        parent::__construct();
        
        $this->table = "password_reminders";
    }

}