<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends Admin_Controller 
{
	public function index()
	{
		$data['error'] = FALSE;
		$rules = array(
			'username' => array(
				'field' => 'username',
				'Label' => 'username',
				'rules' => 'trim|required|xss_clean'
				),
			'password' => array(
				'field' => 'password',
				'Label' => 'Password',
				'rules' => 'trim|required|xss_clean'
				),
			);
		
		$this->form_validation->set_rules($rules);

		if($this->form_validation->run() == TRUE)
		{
			if($this->model_login->login($_POST))
			{
				redirect('admin/beranda');
			}
			else
			{
				$data['error'] = TRUE;
			}
		}

		$this->load->view('admin/login/view_login',$data);
	}


}