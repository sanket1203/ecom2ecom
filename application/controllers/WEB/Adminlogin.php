<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Adminlogin extends My_Web {

    public function __construct() {
        parent::__construct();
        $this->load->model('adminlogin_model');
        
        if(isset($this->session->userdata['user_data']['id']) && $this->session->userdata['user_data']['id'] && $this->router->method == 'index')
        redirect(WEB_URL.'dashboard');   
    }

    public function index() {
        $this->dynamic_load->add_js('footer', array('src' => asset_url('global', 'plugins/jquery.sparkline.min.js'), 'type' => 'text/javascript'));
        $data = array('page_title' => 'COAN | Admin Login', 'login_view' => true, 'error' => $this->session->flashdata('error'));
        $this->load->view(backend_view() . 'login');
    }

    public function login_check() {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $return = array();
        if (!empty($email) && !empty($password)) {
            $email = $this->secure_data($email);
            $password = md5($this->secure_data($password));
            $authenticate = $this->adminlogin_model->authenticate($email, $password);
            if ($authenticate) {
                if(isset($remember) && !empty($remember))
                {
                    $cookie_pass = $this->input->post('password');
                    setcookie('user_name', $email, time() + (86400 * 30), "/");
                    setcookie('password',$cookie_pass, time() + (86400 * 30), "/");
                }
                $user_data = array();
                $session_keys = array('id', 'first_name', 'last_name', 'email');
                foreach ($session_keys as $session_key) :
                    $user_data[$session_key] = $authenticate->$session_key;
                endforeach;
                $user_data['is_login'] = 1;
                $session_data['user_data'] = $user_data;
                $this->session->set_userdata($session_data);
                
                $return['success'] = true;
                $return['data'] = $user_data;
            }
            else {
                $return['success'] = false;
            }
            echo json_encode($return);
        }
    }

    public function adminprofile($id = '') {
        page_view();
        $this->dynamic_load->add_css(array('href' => asset_url('custom_css', 'custom_css/profile.min.css'), 'rel' => 'stylesheet', 'type' => 'text/css'));
        $this->dynamic_load->add_css(array('href' => asset_url('custom_css', 'custom_css/cropper.min.css'), 'rel' => 'stylesheet', 'type' => 'text/css'));
        $this->dynamic_load->add_js('footer', array('src' => asset_url('custom_js', 'custom_js/profile.min.js'), 'type' => 'text/javascript'));
        $this->dynamic_load->add_js('footer', array('src' => asset_url('global', 'plugins/jquery.sparkline.min.js'), 'type' => 'text/javascript'));
        $this->dynamic_load->add_js('footer', array('src' => asset_url('global', 'plugins/jquery-validation/js/jquery.validate.min.js'), 'type' => 'text/javascript'));
        $this->dynamic_load->add_js('footer', array('src' => asset_url('global', 'plugins/jquery-validation/js/additional-methods.min.js'), 'type' => 'text/javascript'));
        $this->dynamic_load->add_js('footer', array('src' => asset_url('custom_js', 'custom_js/cropper.min.js'), 'type' => 'text/javascript'));
        $this->dynamic_load->add_js('footer', array('src' => asset_url('custom_js', 'custom_js/admin.js'), 'type' => 'text/javascript'));
        if (!empty($id)) {
            $data['records'] = $this->adminlogin_model->Getprofile($id);
            if (!empty($data['records'])) {
                $data['u_id'] = $id;
                $this->template->view(backend_view() . 'adminprofile', $data);
            } else {
                $this->load->view(backend_view() . '/404');
            }
        } else {
            $this->template->view(backend_view() . 'adminprofile');
        }
    }

    public function update_profile() {
        $return = array();
        $u_id = $this->input->post('u_id');
        $profile_data = array();
        //$old_image = $this->input->post('old_image');
        $fields = array('first_name', 'last_name', 'email');
        foreach ($fields as $field) {
            $profile_data[$field] = $this->input->post($field);
        }
       /* if (isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
            // unlink old image
            if (isset($old_image) && !empty($old_image)) {
                $is_exist = ADMIN_IMAGE_PATH.$old_image;
                if(file_exists($is_exist))
                {
                    unlink(ADMIN_IMAGE_URL . $old_image);
                    unlink(ADMIN_IMAGE_URL . '/thumb/' . $old_image);
                }
            }
            $file_name = time() . $_FILES['image']['name'];
            $tmp_file_name = $_FILES['image']['tmp_name'];
            $x = (int) $this->input->post('x1');
            $y = (int) $this->input->post('y1');
            $w = (int) $this->input->post('w');
            $h = (int) $this->input->post('h');
            $this->image_upload($file_name, $tmp_file_name, $w, $h, $x, $y);
            $profile_data['image'] = $file_name;
        } */
        $status = $this->adminlogin_model->Editprofile($profile_data, $u_id);
        if ($status == TRUE) {
            //Set updated data to session
            $getdata = $this->adminlogin_model->Getprofile($u_id);
            $user_data = array();
            $session_keys = array('id', 'first_name', 'last_name', 'email');
            foreach ($session_keys as $session_key) :
                $user_data[$session_key] = $getdata->$session_key;
            endforeach;
            $user_data['is_login'] = 1;
            $session_data['user_data'] = $user_data;
            $this->session->set_userdata($session_data);
            //Set updated data to session end
            $return['success'] = true;
        } else {
            $return['success'] = false;
        }
        echo json_encode($return);
    }

    public function change_password() {
        $current_password = $this->input->post('current_password');
        $new_password = $this->input->post('new_password');
        $session_data = $this->session->userdata('user_data');
        $password_info = $this->adminlogin_model->current_password_check($current_password, $session_data['id'], $session_data['email']);
        if (isset($password_info) && !empty($password_info)) {
            $user_new_data = array('password' => md5($new_password));
            $user_id = $session_data['id'];
            $this->adminlogin_model->update_password($user_new_data,$user_id);
            return TRUE;
        } else {
            echo "error";
        }
    }

    private function random_password($length = 8) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $password = substr(str_shuffle($chars), 0, $length);
        return $password;
    }
    
    public function forget_password() {
        
        $email = $this->input->post('email');
        $result = $this->adminlogin_model->check_mail($email);
        $return = array();
        if ($result != '') {
            $data['name'] = $result->first_name . ' ' . $result->last_name;
            $data['coded_email'] = base64_encode($email);
            $data['token'] = base64_encode(rand(100, 999));
            $result = $this->adminlogin_model->updated_token($data['token'], $email);
            $message = $this->load->view(backend_view() . 'email_template', $data, TRUE);
            $sendmail_status = $this->send_mail($email, $message);
            if ($sendmail_status) {
                $return['success'] = true;
            }
        }
        else
        {
            $return['success'] = false;
        }
        echo json_encode($return);
    }
    
    public function reset_password() {
        $data['q1'] = $this->input->get('q1');
        $data['token'] = $this->input->get('token');
        $status = $this->adminlogin_model->check_token($data['token']);
        if ($status == TRUE) {
            $this->load->view(backend_view() . '/resetpassword', $data);
        } else {
            $result_data['icon'] = 'fa fa-warning';
            $result_data['text'] = 'Sorry this link is already used..!!';
            $this->load->view(backend_view() . '/thankyou', $result_data);
        }
    }

    public function resetpassword_process() {
        $q1 = $this->input->post('q1');
        $token = $this->input->post('token');
        $new_password = $this->input->post('new_password');
        $return = array();
        $status = $this->adminlogin_model->passwordreset($q1, $token, $new_password);
        if ($status) {
            $return['success'] = true;
        }
        else
        {
            $return['success'] = false;
        }
        echo json_encode($return);
    }

    private function send_mail($email, $message) {
        $this->email->initialize(array(
            'protocol' => 'smtp',
            'smtp_host' => 'mail.example.com',
            'smtp_user' => $this->config->item('smtp_user'),
            'smtp_pass' => $this->config->item('smtp_pass'),
            'smtp_port' => $this->config->item('smtp_port'),
            'mailtype' => 'html',
            'crlf' => "\r\n",
            'newline' => "\r\n"
        ));

        $this->email->from($this->config->item('emailaddress'), $this->config->item('name'));
        $this->email->to($email);
        $this->email->subject('Forgot password');
        $this->email->message($message);
        $status = $this->email->send();
        //return $this->email->print_debugger();
        return $status;
    }

    public function thankyou() {
        $data['icon'] = 'fa fa-thumbs-o-up';
        $data['text'] = 'Your passowrd changed successfully. Now you may login..!!';
        $data['back_login'] = '<a href="login" class="btn red"><i class="fa fa-arrow-left"></i> Back to login </a>';
        $this->load->view(backend_view() . '/thankyou', $data);
    }

    public function load_404() {
        $this->load->view(backend_view() . '/404');
    }

    public function logout() {
        $this->load->library('session');
        $this->session->sess_destroy();

        redirect(WEB_URL.'web');
    }
    
    private function image_upload($file_name, $tmp_file_name, $w, $h, $x, $y) {
        $config['upload_path'] = './uploads/admin_profile_pic/';
        $config['allowed_types'] = 'jpeg|jpg|png';
        $config['image_library'] = 'gd2';
        $config['overwrite'] = TRUE;
        $config['source_image'] = $tmp_file_name;
        $config['create_thumb'] = FALSE;
        $config['new_image'] = ADMIN_IMAGE_PATH . $file_name;
        $config['maintain_ratio'] = FALSE;
        $config['width'] = $w;
        $config['height'] = $h;
        $config['x_axis'] = $x;
        $config['y_axis'] = $y;

        //load image library
        $this->load->library('image_lib', $config);
        $return_array = array();
        //crop the selected image from original image
        if (!$this->image_lib->crop()) {
            $return_array['error'] = $this->image_lib->display_errors();
        } else {
            $config['allowed_types'] = 'jpeg|jpg|png';
            $config_thumb['image_library'] = 'gd2';
            $config_thumb['source_image'] = $config['new_image'];
            $config_thumb['create_thumb'] = TRUE;
            $config_thumb['new_image'] = ADMIN_IMAGE_PATH . 'thumb/' . $file_name;
            $config_thumb['maintain_ratio'] = TRUE;
            $config_thumb['thumb_marker'] = "";
            $config_thumb['overwrite'] = TRUE;
            $config_thumb['width'] = 200;
            //$config_thumb['height'] = 200;
            $this->image_lib->initialize($config_thumb);

            if (!$this->image_lib->resize()) {
                $return_array['error'] = $this->image_lib->display_errors();
            } else {
                $this->load->library('upload', $config_thumb);
                $this->upload->do_upload('image');
            }
        }
        return $return_array;
    }

}
