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
		if ($this->session->userdata("hak") != "user")
		{
			$data['usaha'] = $this->model_usaha->index();
			$aktif['nav'] = "pegawai";
			$aktif['notif'] = $this->model_usaha->notif();

			$this->load->view('admin/view_head');
			$this->load->view('admin/view_navigation',$aktif);
			$this->load->view('admin/view_left');
			$this->load->view('admin/pegawai/usaha/view_usaha',$data);
		}
		else
		{
			redirect();
		}
	}

	public function tambah()
	{
		if ($this->session->userdata("hak") == "admin")
		{
			$data['pegawai'] = $this->model_usaha->pegawai();
			$aktif['nav'] = "pegawai";
			$aktif['notif'] = $this->model_usaha->notif();

			$this->load->view('admin/view_head');
			$this->load->view('admin/view_navigation',$aktif);
			$this->load->view('admin/view_left');
			$this->load->view('admin/pegawai/usaha/view_tambah_usaha',$data);
		}
		else
		{
			redirect();
		}
	}

	public function aksi_tambah()
	{
		if ($this->session->userdata("hak") == "admin")
		{
			if ($this->model_usaha->aksi_tambah()) 
			{
				redirect('admin/usaha?sukses=ya');
			}
			else
			{
				redirect('admin/usaha?sukses=tidak');
			}
		}
		else
		{
			redirect();
		}
	}

	public function ubah($id_ush_akt = null)
	{
		if ($id_ush_akt != null && $this->session->userdata("hak") == "admin")
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
		else
		{
			redirect();
		}
	}

	public function aksi_ubah($id_ush_akt = null)
	{
		if ($id_ush_akt != null && $this->session->userdata("hak") == "admin")
		{
			if ($this->model_usaha->aksi_ubah($id_ush_akt)) 
			{
				redirect('admin/usaha?sukses_ubah=ya');
			}
			else
			{
				redirect('admin/usaha?sukses=tidak');
			}
		}
		else
		{
			redirect();
		}
	}
}