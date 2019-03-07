<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Adminuser_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    public function blockuser($banner_data,$user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->update('users',$banner_data);

        return true;
    }
    
    public function userdetail($user_id)
    {
        $UserImagePath = base_url().IMAGE_URL;
		$id = base64_decode($user_id);
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('user_id',$id);
        $query = $this->db->get();
        $result = $query->row_array();
        $result['profile_pic'] = imageexists(IMAGE_PATH,$UserImagePath,$result['profile_pic']);
        return $result;
    }
}
