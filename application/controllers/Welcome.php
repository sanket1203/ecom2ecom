<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller 
{
	public function index()
	{
		$this->load->view('default-view');
	}
	public function web()
	{
		echo "web description";
	}
	public function rest()
	{
		echo "api description";
	}
}
