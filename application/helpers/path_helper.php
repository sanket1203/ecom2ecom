<?php

/**
 * Get asset URL
 *
 * @access  public
 * @return  string
 */
if (!function_exists('asset_url')) {

    function asset_url($type = '', $filename = '') {
        //get an instance of CI so we can access our configuration
        $CI = & get_instance();
        //return the full asset path
        $baseurl = base_url();
        switch ($type) {

            case 'custom_js':
                return $baseurl . $CI->config->item('asset_url') . $CI->config->item('custom_js') . $filename;
                break;
            
            case 'custom_css':
                return $baseurl . $CI->config->item('asset_url') . $CI->config->item('custom_css') . $filename;
                break;
            
            case 'js':
                return $baseurl . $CI->config->item('asset_url') . $CI->config->item('js') . $filename;
                break;

            case 'css':
                return $baseurl . $CI->config->item('asset_url') . $CI->config->item('css') . $filename;
                break;

            case 'global':
                return $baseurl . $CI->config->item('asset_url') . $CI->config->item('global') . $filename;
                break;

            case 'pages':
                return $baseurl . $CI->config->item('asset_url') . $CI->config->item('pages') . $filename;
                break;

            case 'layouts':
                return $baseurl . $CI->config->item('asset_url') . $CI->config->item('layouts') . $filename;
                break;

            case 'images':
                return $baseurl . $CI->config->item('asset_url') . $CI->config->item('images') . $filename;
                break;

            case 'icons':
                return $baseurl . $CI->config->item('asset_url') . $CI->config->item('images') . 'icons/' . $filename;
                break;

            case 'front':
                return $baseurl . $CI->config->item('asset_url') . $CI->config->item('front') . $filename;
                break;

            default:
                return $baseurl . $CI->config->item('asset_url');
                break;
        }
    }

}

if (!function_exists('slug_url')) {

    function slug_url($controller, $id, $title) {
        if ($title != '')
            return base_url($controller . '/' . $title);
        else
            return base_url($controller . '/' . $id);
    }

}

if (!function_exists('backend_path')) {

    function backend_url() {
        //get an instance of CI so we can access our configuration
        $CI = & get_instance();
        //return the full backend path
        return base_url() . $CI->config->item('backend_path');
    }

    function backend_view() {
        //get an instance of CI so we can access our configuration
        $CI = & get_instance();
        //return the full file
        return $CI->config->item('backend_path');
    }

}

if (!function_exists('frontend_path')) {

    function frontend_url() {
        //get an instance of CI so we can access our configuration
        $CI = & get_instance();
        //return the full frontend path
        return base_url() . $CI->config->item('frontend_path');
    }

    function frontend_view() {
        //get an instance of CI so we can access our configuration
        $CI = & get_instance();
        //return the full file
        return $CI->config->item('frontend_path');
    }

}

if (!function_exists('page_view')) {

    function page_view() {
        $CI = & get_instance();
        if (isset($CI->session->userdata['user_data']) && !empty($CI->session->userdata['user_data'])) {
            return TRUE;
        } else {
            $CI->session->set_flashdata('error', 'Sorry, your session has been expired!');
            redirect(WEB_URL.'web');
        }
    }

}