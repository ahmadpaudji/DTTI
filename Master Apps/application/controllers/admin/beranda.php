<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Beranda extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/model_beranda');
	}

	public function index()
	{
		$data['rkp'] = $this->model_beranda->index();
		$aktif['notif'] = $this->model_beranda->notif();
		$aktif['nav'] = "beranda";
		
		$this->load->view('admin/view_head');
		$this->load->view('admin/view_navigation',$aktif);
		$this->load->view('admin/view_left');
		$this->load->view('admin/beranda/view_beranda',$data);
	}
}