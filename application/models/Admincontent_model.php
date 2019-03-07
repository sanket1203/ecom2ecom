<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admincontent_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    public function getcontent() {
        $this->db->select('*');
        $this->db->from('content');
        $query = $this->db->get();
        return $query->row_array();
    }
    
    public function updatecontent($updatedata,$content_id) {
               
        $this->db->where('content_id', $content_id);
        $this->db->update('content',$updatedata);

        return true;
    }

}
