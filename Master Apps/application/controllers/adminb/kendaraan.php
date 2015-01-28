<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kendaraan extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/model_kendaraan');
	}
	public function index()
	{
		if ($this->session->userdata("hak") != "user")
		{
			$data['kendaraan'] = $this->model_kendaraan->index();
			$aktif['nav'] = "pegawai";
			$aktif['notif'] = $this->model_kendaraan->notif();

			$this->load->view('admin/view_head');
			$this->load->view('admin/view_navigation',$aktif);
			$this->load->view('admin/view_left');
			$this->load->view('admin/pegawai/kendaraan/view_kendaraan',$data);
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
			$data['pegawai'] = $this->model_kendaraan->pegawai();
			$aktif['nav'] = "pegawai";
			$aktif['notif'] = $this->model_kendaraan->notif();

			$this->load->view('admin/view_head');
			$this->load->view('admin/view_navigation',$aktif);
			$this->load->view('admin/view_left');
			$this->load->view('admin/pegawai/kendaraan/view_tambah_kendaraan',$data);
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
			$this->form_validation->set_rules($this->model_kendaraan->tambah_kendaraan_rules);
			$this->form_validation->set_message('is_unique', 'Nomor Polisi sudah digunakan.');

			if($this->form_validation->run() == TRUE)
			{
				if ($this->model_kendaraan->aksi_tambah()) 
				{
					redirect('admin/kendaraan?sukses=ya');
				}
				else
				{
					redirect('admin/kendaraan?sukses=tidak');
				}
			}
			else
			{
				$this->session->set_flashdata('errors', validation_errors());

				redirect('admin/kendaraan/tambah');
			}
		}
		else
		{
			redirect();
		}
	}

	public function ubah($id_kdr_mtr = null)
	{
		if ($id_kdr_mtr != null && $this->session->userdata("hak") == "admin")
		{
			$data['pegawai'] = $this->model_kendaraan->pegawai();
			$data['kendaraan'] = $this->model_kendaraan->ubah($id_kdr_mtr);
			$aktif['nav'] = "pegawai";
			$aktif['notif'] = $this->model_kendaraan->notif();

			$this->load->view('admin/view_head');
			$this->load->view('admin/view_navigation',$aktif);
			$this->load->view('admin/view_left');
			$this->load->view('admin/pegawai/kendaraan/view_ubah_kendaraan',$data);
		}
		else
		{
			redirect();
		}
	}

	public function aksi_ubah($id_kdr_mtr = null)
	{
		if ($id_kdr_mtr != null && $this->session->userdata("hak") == "admin")
		{
			$this->form_validation->set_rules($this->model_kendaraan->kendaraan_rules);

			if($this->form_validation->run() == TRUE)
			{
				if ($this->model_kendaraan->aksi_ubah($id_kdr_mtr)) 
				{
					redirect('admin/kendaraan?sukses_ubah=ya');
				}
				else
				{
					redirect('admin/kendaraan?sukses=tidak');
				}
			}
			else
			{
				$this->session->set_flashdata('errors', validation_errors());

				redirect('admin/kendaraan/ubah/'.$id_kdr_mtr);
			}
		}
		else
		{
			redirect();
		}
	}
}