<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sppd extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/model_izin');
	}

	public function index($cari = null)
	{
		$data['pegawai'] = $this->model_izin->pegawai();
		$aktif['nav'] = "pengajuan";
		$aktif['notif'] = $this->model_izin->notif();
		if ($cari == "cari")
		{
			$data['izin'] = $this->model_izin->index();
			$data['tampil'] = "true";
		}
		else
		{
			$data['tampil'] = "false";
		}

		$this->load->view('admin/view_head');
		$this->load->view('admin/view_navigation',$aktif);
		$this->load->view('admin/view_left');
		$this->load->view('admin/izin/view_izin',$data);	
	}

	public function tambah()
	{
		$aktif['nav'] = "pengajuan";
		$aktif['notif'] = $this->model_izin->notif();

		$this->load->view('admin/view_head');
		$this->load->view('admin/view_navigation',$aktif);
		$this->load->view('admin/view_left');
		$this->load->view('admin/izin/view_tambah_izin');
	}

	public function aksi_tambah()
	{
		$this->form_validation->set_rules($this->model_izin->izin_rules);
		
		if($this->form_validation->run() == TRUE)
		{
			if ($this->model_izin->aksi_tambah($upload)) 
			{
				redirect('admin/izin?sukses=ya');
			}
			else
			{
				redirect('admin/izin?sukses=tidak');
			}
		}
	}

	public function detail($id_abs = null)
	{
		if ($id_abs != null)
		{
			$data['izin'] = $this->model_izin->detail($id_abs);
			$aktif['nav'] = "pengajuan";
			$aktif['notif'] = $this->model_izin->notif();

			$this->load->view('admin/view_head');
			$this->load->view('admin/view_navigation',$aktif);
			$this->load->view('admin/view_left');
			$this->load->view('admin/izin/view_detail_izin',$data);
		}
		else
		{
			redirect();
		}
	}

	public function ubah($id_abs = null)
	{
		if ($id_abs != null)
		{
			$data['izin'] = $this->model_izin->ubah($id_abs);
			$aktif['nav'] = "pengajuan";
			$aktif['notif'] = $this->model_izin->notif();

			$this->load->view('admin/view_head');
			$this->load->view('admin/view_navigation',$aktif);
			$this->load->view('admin/view_left');
			$this->load->view('admin/izin/view_ubah_izin',$data);
		}
		else
		{
			redirect();
		}
	}

	public function aksi_ubah($id_abs = null)
	{
		if ($id_abs != null)
		{
			$this->form_validation->set_rules($this->model_izin->izin_rules);
			$upload = null;

			if($_FILES['userfile']['name'] != '')
			{
				if (!$this->photo_copy())
				{
					$this->session->set_flashdata('errors', "Ukuran file tidak lebih dari 2 MB dan berformat (*.jpg)");

					redirect('admin/absen/ubah/'.$id_abs);
				}
				else
				{
					$upload = $this->photo_copy();
				}
			}

			if($this->form_validation->run() == TRUE)
			{
				if ($this->model_izin->aksi_ubah($id_abs,$upload)) 
				{
					redirect('admin/izin?sukses_ubah=ya');
				}
				else
				{
					redirect('admin/izin?sukses=tidak');
				}
			}
			else
			{
				redirect('admin/izin?sukses=tidak');
			}
		}
		else
		{
			redirect();
		}
	}

	public function setuju($id_abs,$status)
	{
		if ($this->model_izin->setuju($id_abs,$status))
		{
			redirect('admin/izin');
		}
		else
		{
			redirect('admin/izin?sukses=tidak');
		}
	}
}