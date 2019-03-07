<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Adminlogin_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function authenticate($email, $password) {
        if (!empty($email) && !empty($password)) {
            $AdminImagePath = base_url() . ADMIN_IMAGE_URL;
            //$DefaultImage = base_url() . ADMIN_IMAGE_URL . 'base_image.jpg';
            $this->db->select('id,first_name,last_name,email');
            $this->db->from('admin');
            $this->db->where('user_name', $email);
            //$this->db->where('email', $email);
            $this->db->where('password', $password);
            $row = $this->db->get()->row();
            if (!empty($row)) {
                return $row;
            } else {
                return FALSE;
            }
        }
    }

    public function Getprofile($id) {
        $AdminImagePath = base_url() . ADMIN_IMAGE_URL;
        //$DefaultImage = base_url() . ADMIN_IMAGE_URL . 'base_image.jpg';
        $this->db->select('id,first_name,last_name,email');
        $this->db->where('md5(id)', $id);
        $this->db->from('admin');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = $query->row();
            return $data;
        }
    }

    public function Editprofile($profile_data, $u_id) {
        $this->db->where("md5(id)", $u_id);
        $this->db->update("admin", $profile_data);

        return TRUE;
    }

    public function current_password_check($current_password, $id, $email) {
        $this->db->select('id');
        $this->db->from('admin');
        $this->db->where('email', $email);
        $this->db->where('id', $id);
        $this->db->where('password', md5($current_password));
        $row = $this->db->get();
        $data = $row->row();
        if ($row->num_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function check_mail($email) {
        $this->db->select('first_name,last_name');
        $this->db->from('admin');
        $this->db->where('email', $email);
        $row = $this->db->get();
        $data = $row->row();
        if ($row->num_rows() == 1) {
            return $data;
        } else {
            return FALSE;
        }
    }

    public function check_token($token) {
        $decoded_token = base64_decode($token);
        $this->db->select('first_name,last_name');
        $this->db->from('admin');
        $this->db->where('forget_password_token', $decoded_token);
        $row = $this->db->get();
        $data = $row->row();
        if ($row->num_rows() == 1) {
            return TRUE;
        }
    }

    public function passwordreset($q1, $token, $new_password) {
        $email = base64_decode($q1);
        $decoded_token = base64_decode($token);
        $this->db->select('first_name,last_name');
        $this->db->from('admin');
        $this->db->where('email', $email);
        $this->db->where('forget_password_token', $decoded_token);
        $row = $this->db->get();
        $data = $row->row();
        if ($row->num_rows() == 1) {
            $data = array("password" => md5($new_password), "forget_password_token" => "");
            $this->db->where('email', $email);
            $this->db->update("admin", $data);
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function updated_token($token, $email) {
        $data = array('forget_password_token' => $token);
        $this->db->where("email", $email);
        $this->db->update("admin", $data);

        return TRUE;
    }
    
    public function update_password($user_new_data,$user_id) {
        $this->db->where("id", $user_id);
        $this->db->update("admin", $user_new_data);

        return TRUE;
    }
}
