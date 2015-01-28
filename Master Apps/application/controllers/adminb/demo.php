<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Demo extends Admin_Controller
{
	public function index()
	{
		$level = $this->session->userdata['hak'];

		if ($level == "admin") 
		{
			$this->session->set_userdata("hak","user");
		}
		else
		{
			$this->session->set_userdata("hak","admin");
		}

		redirect();
	}
}