<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('admin/model_login');

		$exception_uris = array('admin/login','admin/logout');
		
		if(in_array(uri_string(),$exception_uris) == FALSE)
		{
			if($this->model_login->loggedin() == FALSE)
			{
				redirect('admin/login');
			}
		}

		$restricted_uris = array('admin/login');

		if($this->model_login->loggedin() == TRUE)
		{
			if(in_array(uri_string(), $restricted_uris) == TRUE)
			{
				redirect('admin');
			}
		}
	}

}