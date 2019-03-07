<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Adminusers extends My_Web {

    public function __construct() {
        parent::__construct();
        // check if user not login send it to login page 
        page_view();

        $this->dynamic_load->add_css(array('href' => asset_url('global', 'plugins/datatables/datatables.min.css'), 'rel' => 'stylesheet', 'type' => 'text/css'));
        $this->dynamic_load->add_css(array('href' => asset_url('global', 'plugins/datatables/plugins/bootstrap/datatables.bootstrap.css'), 'rel' => 'stylesheet', 'type' => 'text/css'));
        $this->dynamic_load->add_js('footer', array('src' => asset_url('global', 'plugins/datatables/dataTables.min.js'), 'type' => 'text/javascript'));
        $this->dynamic_load->add_js('footer', array('src' => asset_url('global', 'plugins/datatables/plugins/bootstrap/datatables.bootstrap.js'), 'type' => 'text/javascript'));
        $this->dynamic_load->add_js('footer', array('src' => asset_url('custom_js', 'custom_js/user.js'), 'type' => 'text/javascript'));
        // load user model
        $this->load->model('adminuser_model');
        $this->load->library('datatables');
    }

    public function index() {
        $data['header_menu'] = 'user';
        $this->template->view(backend_view() . 'user/user_list', $data);
    }
    
    public function getuserslist() {
        $user_image_path = base_url() . IMAGE_URL;
        $DefaultImage = base_url() . IMAGE_URL . 'base_image.jpg';
        $query  =   "SET @uniqid := 0, @type := NULL";
        $this->db->query($query);
        $this->datatables->select("(@uniqid:=@uniqid+1) AS uniqid,user_id,full_name,user_name,email,phone,promocode,IF(able_to_login = '0','Blocked','Unblocked') as block_status,IF(profile_pic = '','" . $DefaultImage . "',CONCAT('" . $user_image_path . "',profile_pic)) as user_image", false)
            ->from("users");
        echo $this->datatables->generate();        
    }
    
    public function blockuser() {
        $PostData = $this->input->post();
        if (isset($PostData) && count($PostData) > 0) {
            //remove space from post data
            $Params = array_map('trim', $PostData['data']);
            //process data
            extract($Params);
            $banner_data = array();
            if(isset($status) && !empty($status) && $status=='Blocked')
            {
                $banner_data['able_to_login'] ='1';
            }
            if(isset($status) && !empty($status) && $status=='Unblocked')
            {
                $banner_data['able_to_login'] ='0';
            }
            //call function to change status
            $blockuser = $this->adminuser_model->blockuser($banner_data,$user_id);
            //print response
            echo json_encode($blockuser);
        }
        exit;
    }
    
    public function getinvitelist()
    {
        $data = $this->session->all_userdata();
        $this->datatables->select("invite_id,promocode,friend_email,IF(status = '1','Yes','No') as status", false)->from("friend_invite");
             $this->datatables->where('promocode',$data['invite_user_id']);
        echo $this->datatables->generate();
    }
    
    public function userdetail($user_id)
    {
        $data['user_data'] = $this->adminuser_model->userdetail($user_id);
        $this->session->set_userdata(array('invite_user_id'=>$data['user_data']['promocode']));
        $this->template->view(backend_view() . 'user/userdetail',$data);
    }
    
}
