<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Settings extends My_Web {

    public function __construct() {
        parent::__construct();
        page_view();
        $this->load->model('settings_model');
    }

    public function index() {
        $this->dynamic_load->add_css(array('href' => asset_url('global', 'plugins/datatables/datatables.min.css'), 'rel' => 'stylesheet', 'type' => 'text/css'));
        $this->dynamic_load->add_css(array('href' => asset_url('global', 'plugins/datatables/plugins/bootstrap/datatables.bootstrap.css'), 'rel' => 'stylesheet', 'type' => 'text/css'));
        $this->dynamic_load->add_js('footer', array('src' => asset_url('global', 'plugins/datatables/dataTables.min.js'), 'type' => 'text/javascript'));
        $this->dynamic_load->add_js('footer', array('src' => asset_url('global', 'plugins/datatables/plugins/bootstrap/datatables.bootstrap.js'), 'type' => 'text/javascript'));
        $this->dynamic_load->add_js('footer', array('src' => asset_url('global', 'plugins/moment.min.js'), 'type' => 'text/javascript'));
        $this->dynamic_load->add_js('footer', array('src' => asset_url('pages', 'scripts/form-repeater.js'), 'type' => 'text/javascript'));
        $this->dynamic_load->add_js('footer', array('src' => asset_url('global', 'plugins/jquery-validation/js/jquery.validate.min.js'), 'type' => 'text/javascript'));
        $this->dynamic_load->add_js('footer', array('src' => asset_url('global', 'plugins/jquery-validation/js/additional-methods.min.js'), 'type' => 'text/javascript'));
		$this->dynamic_load->add_js('footer', array('src' => asset_url('custom_js', 'custom_js/settings.js'), 'type' => 'text/javascript'));
        $data['header_menu'] = 'dashboard';
        $data['total_users'] = $this->settings_model->totalusers();
        //$data['total_restaurants'] = $this->admindashboard_model->totalrestaurants();
        //$data['total_invites'] = $this->admindashboard_model->totalinvites();
        //$data['total_subscription_plans'] = $this->admindashboard_model->subscription_plans();
        $this->template->view(backend_view() . 'settings',$data);
    }
	
	
	public function update_settings(){
		$opencart_websiteurl = $this->input->post('opencart_websiteurl');
        $opencart_database = $this->input->post('opencart_database');
		$opencart_dbpassword = $this->input->post('opencart_dbpassword');
		$opencart_dbhost = $this->input->post('opencart_dbhost');
		$magento_websiteurl = $this->input->post('magento_websiteurl');
		$magento_database = $this->input->post('magento_database');
		$magento_dbpassword = $this->input->post('magento_dbpassword');
		$magento_dbhost = $this->input->post('magento_dbhost');
		
		

	}
}
