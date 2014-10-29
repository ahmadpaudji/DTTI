<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usaha extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/model_usaha');
	}

	public function index()
	{
		$data['usaha'] = $this->model_usaha->index();
		$aktif['nav'] = "pegawai";
		$aktif['notif'] = $this->model_usaha->notif();

		$this->load->view('admin/view_head');
		$this->load->view('admin/view_navigation',$aktif);
		$this->load->view('admin/view_left');
		$this->load->view('admin/pegawai/usaha/view_usaha',$data);
	}

	public function tambah()
	{
		$data['pegawai'] = $this->model_usaha->pegawai();
		$aktif['nav'] = "pegawai";
		$aktif['notif'] = $this->model_usaha->notif();

		$this->load->view('admin/view_head');
		$this->load->view('admin/view_navigation',$aktif);
		$this->load->view('admin/view_left');
		$this->load->view('admin/pegawai/usaha/view_tambah_usaha',$data);
	}

	public function aksi_tambah()
	{
		if ($this->model_usaha->aksi_tambah()) 
		{
			redirect('admin/usaha');
		}
		else
		{
			return false;
		}
	}

	public function ubah($id_ush_akt)
	{
		$data['pegawai'] = $this->model_usaha->pegawai();
		$data['usaha'] = $this->model_usaha->ubah($id_ush_akt);
		$aktif['nav'] = "pegawai";
		$aktif['notif'] = $this->model_usaha->notif();

		$this->load->view('admin/view_head');
		$this->load->view('admin/view_navigation',$aktif);
		$this->load->view('admin/view_left');
		$this->load->view('admin/pegawai/usaha/view_ubah_usaha',$data);
	}

	public function aksi_ubah($id_ush_akt)
	{
		if ($this->model_usaha->aksi_ubah($id_ush_akt)) 
		{
			redirect('admin/usaha');
		}
		else
		{
			return false;
		}
	}
}