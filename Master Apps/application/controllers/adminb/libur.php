<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Libur extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/model_libur');
	}

	public function index()
	{
		$data['libur'] = $this->model_libur->index();
		$aktif['nav'] = "master";
		$aktif['notif'] = $this->model_libur->notif();

		$this->load->view('admin/view_head');
		$this->load->view('admin/view_navigation',$aktif);
		$this->load->view('admin/view_left');
		$this->load->view('admin/master/libur/view_libur',$data);
	}

	public function tambah()
	{
		$aktif['nav'] = "master";
		$aktif['notif'] = $this->model_libur->notif();

		$this->load->view('admin/view_head');
		$this->load->view('admin/view_navigation',$aktif);
		$this->load->view('admin/view_left');
		$this->load->view('admin/master/libur/view_tambah_libur');
	}

	public function aksi_tambah()
	{
		$this->form_validation->set_rules($this->model_libur->libur_rules);

		if($this->form_validation->run() == TRUE)
		{
			if ($this->model_libur->aksi_tambah()) 
			{
				$this->session->set_flashdata('pesan', "Berhasil menambah tanggal libur");
				$this->session->set_flashdata('alert', "success");
				redirect('admin/libur');
			}
			else
			{
				$this->session->set_flashdata('pesan', "Terjadi kesalahan pada sistem");
				$this->session->set_flashdata('alert', "error");
				redirect('admin/libur');
			}
		}
		else
		{
			$this->session->set_flashdata('errors', validation_errors());

			redirect('admin/libur/tambah');
		}
	}

	public function ubah($id_libur = null)
	{
		if ($id_libur != null)
		{
			$data['libur'] = $this->model_libur->ubah($id_libur);
			$aktif['nav'] = "master";
			$aktif['notif'] = $this->model_libur->notif();
			
			$this->load->view('admin/view_head');
			$this->load->view('admin/view_navigation',$aktif);
			$this->load->view('admin/view_left');
			$this->load->view('admin/master/libur/view_ubah_libur',$data);
		}
		else
		{
			redirect();
		}
	}

	public function aksi_ubah($id_libur = null)
	{
		if ($id_libur != null)
		{
			$this->form_validation->set_rules($this->model_libur->libur_rules);

			if($this->form_validation->run() == TRUE)
			{
				if ($this->model_libur->aksi_ubah($id_libur)) 
				{
					$this->session->set_flashdata('pesan', "Berhasil menambah tanggal libur");
					$this->session->set_flashdata('alert', "success");
					redirect('admin/libur');
				}
				else
				{
					$this->session->set_flashdata('pesan', "Terjadi kesalahan sistem");
					$this->session->set_flashdata('alert', "error");
					redirect('admin/libur');
				}
			}
			else
			{
				$this->session->set_flashdata('errors', validation_errors());
				redirect('admin/libur/ubah/'.$id_libur);
			}
		}
		else
		{
			redirect();
		}
	}

	public function hapus($id_libur = null)
	{
		if ($id_libur != null)
		{
			if ($this->model_libur->hapus($id_libur))
			{
				$this->session->set_flashdata('pesan', "Berhasil menghapus tanggal libur");
				$this->session->set_flashdata('alert', "success");
				redirect('admin/libur');
			}
			else
			{
				$this->session->set_flashdata('pesan', "Terjadi kesalahan pada sistem");
				$this->session->set_flashdata('alert', "error");
				redirect('admin/libur');
			}
		}
		else
		{
			redirect();
		}
	}
}