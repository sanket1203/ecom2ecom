<?php

class My_WEB extends CI_Controller {
    
     public function __construct() {
        parent::__construct();

        $this->_admin_template();
        $this->_admin_assets();
    }

    public function _admin_template() {
        $this->load->library('template', $this->config->item('backend_path') . 'template');
        $this->template->set_template($this->config->item('backend_path') . 'template');
    }

    public function _admin_assets() {
        $this->load->library('dynamic_load');

        $css_files = array(
            asset_url('global', 'plugins/pace/themes/pace-theme-flash.css'),
            asset_url('global', 'plugins/font-awesome/css/font-awesome.min.css'),
            asset_url('global', 'plugins/simple-line-icons/simple-line-icons.min.css'),
            asset_url('global', 'plugins/bootstrap/css/bootstrap.min.css'),
            asset_url('global', 'css/components-md.min.css'),
            asset_url('global', 'css/plugins-md.min.css'),
            asset_url('layouts', 'layout/css/layout.min.css'),
            asset_url('layouts', 'layout/css/themes/darkblue.min.css"'),
            asset_url('layouts', 'layout/css/custom.min.css'),
            asset_url('global', 'plugins/bootstrap-toastr/toastr.min.css')
        );

        foreach ($css_files as $css_file)
            $this->dynamic_load->add_css(array('href' => $css_file, 'rel' => 'stylesheet', 'type' => 'text/css'));

        $js_files = array(
            asset_url('global', 'plugins/jquery.min.js'),
            asset_url('global', 'plugins/bootstrap/js/bootstrap.min.js'),
            asset_url('global', 'plugins/js.cookie.min.js'),
            asset_url('global', 'plugins/bootstrap-toastr/toastr.min.js'),
            asset_url('custom_js', 'custom_js/app.js'),
            asset_url('layouts', 'layout/scripts/layout.min.js'),
            asset_url('layouts', 'layout/scripts/demo.min.js'),
            asset_url('global', 'plugins/bootbox/bootbox.min.js'),            
            asset_url('global', 'plugins/pace/pace.min.js')
        );

        foreach ($js_files as $js_file)
            $this->dynamic_load->add_js('footer', array('src' => $js_file, 'type' => 'text/javascript'));
    }

    function _curl($data, $method_name) {
        $headers = [
            "devicetokens: website",
            "devicetype: website",
            "language: en",
            "Content-Type:multipart/form-data"
        ];
        $url = REST_API_URL . $method_name;
        $handle = curl_init($url);

        curl_setopt($handle, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($handle, CURLOPT_USERPWD, 'abc:123123');

        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_POST, true);
        curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
        curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($handle);
        curl_close($handle);
        return $result;
    }

    function upload_file($filename, $tmp_path, $upload_path) {
        if (move_uploaded_file($tmp_path, $upload_path)) {
            return true;
        } else {
            api_error("", 401, "File not uploaded try agin latter.");
        }
    }
    
    public function secure_data($data) {
        return $this->security->xss_clean(trim($data));
    }
    
    public function _check_admin_authenticate() {
        $this->load->library('session');
        if ((!isset($this->session->userdata['user_data']['is_login']) OR ! isset($this->session->userdata['user_data']['id'])))
            redirect('web');
    }

}
