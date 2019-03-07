<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    public function totalusers() {
        $this->db->select('*');
        $this->db->from('users');
        $query = $this->db->get();
        return $query->num_rows();
    }
}
