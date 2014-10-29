<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Anak extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/model_anak');
	}

	public function index()
	{
		$data['anak'] = $this->model_anak->index();
		$aktif['nav'] = "pegawai";
		$aktif['notif'] = $this->model_anak->notif();

		$this->load->view('admin/view_head');
		$this->load->view('admin/view_navigation',$aktif);
		$this->load->view('admin/view_left');
		$this->load->view('admin/pegawai/anak/view_anak',$data);
	}

	public function tambah()
	{
		$data['pegawai'] = $this->model_anak->pegawai();
		$aktif['nav'] = "pegawai";
		$aktif['notif'] = $this->model_anak->notif();

		$this->load->view('admin/view_head');
		$this->load->view('admin/view_navigation',$aktif);
		$this->load->view('admin/view_left');
		$this->load->view('admin/pegawai/anak/view_tambah_anak',$data);
	}

	public function aksi_tambah()
	{
		$this->form_validation->set_rules($this->model_anak->anak_rules);

		if($this->form_validation->run() == TRUE)
		{
			if ($this->model_anak->aksi_tambah()) 
			{
				redirect('admin/anak?sukses=ya');
			}
			else
			{
				redirect('admin/anak?sukses=tidak');
			}
		}
	}

	public function ubah($id_anak)
	{
		$data['pegawai'] = $this->model_anak->pegawai();
		$data['anak'] = $this->model_anak->ubah($id_anak);
		$aktif['nav'] = "pegawai";
		$aktif['notif'] = $this->model_anak->notif();

		$this->load->view('admin/view_head');
		$this->load->view('admin/view_navigation',$aktif);
		$this->load->view('admin/view_left');
		$this->load->view('admin/pegawai/anak/view_ubah_anak',$data);
		
	}

	public function aksi_ubah($id_anak)
	{
		$this->form_validation->set_rules($this->model_anak->anak_rules);

		if($this->form_validation->run() == TRUE)
		{
			if ($this->model_anak->aksi_ubah($id_anak)) 
			{
				redirect('admin/anak?sukses_ubah=ya');
			}
			else
			{
				redirect('admin/anak?sukses=tidak');
			}
		}
	}
}