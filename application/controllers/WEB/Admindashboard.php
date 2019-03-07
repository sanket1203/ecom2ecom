<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admindashboard extends My_Web {

    public function __construct() {
        parent::__construct();
        page_view();
        $this->load->model('admindashboard_model');
    }

    public function index() {
        $this->dynamic_load->add_js('footer', array('src' => asset_url('pages','scripts/dashboard.min.js'), 'type' => 'text/javascript'));
        $this->dynamic_load->add_js('footer', array('src' => asset_url('global','plugins/moment.min.js'), 'type' => 'text/javascript'));
        $this->dynamic_load->add_js('footer', array('src' => asset_url('global','plugins/morris/morris.min.js'), 'type' => 'text/javascript'));
        $this->dynamic_load->add_js('footer', array('src' => asset_url('global','plugins/counterup/jquery.waypoints.min.js'), 'type' => 'text/javascript'));
        $this->dynamic_load->add_js('footer', array('src' => asset_url('global','plugins/counterup/jquery.counterup.min.js'), 'type' => 'text/javascript'));
        $data['header_menu'] = 'dashboard';
        $data['total_users'] = $this->admindashboard_model->totalusers();
        //$data['total_restaurants'] = $this->admindashboard_model->totalrestaurants();
        //$data['total_invites'] = $this->admindashboard_model->totalinvites();
        //$data['total_subscription_plans'] = $this->admindashboard_model->subscription_plans();
        $this->template->view(backend_view() . 'dashboard',$data);
    }
}
