<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Daftarbank extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/model_daftar_bank');
	}

	public function index()
	{
		if ($this->session->userdata("hak") == "admin")
		{
			$data['daftar_bank'] = $this->model_daftar_bank->index();
			$aktif['nav'] = "master";
			$aktif['notif'] = $this->model_daftar_bank->notif();

			$this->load->view('admin/view_head');
			$this->load->view('admin/view_navigation',$aktif);
			$this->load->view('admin/view_left');
			$this->load->view('admin/master/bank/view_daftar_bank',$data);
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
			$aktif['nav'] = "master";
			$aktif['notif'] = $this->model_daftar_bank->notif();

			$this->load->view('admin/view_head');
			$this->load->view('admin/view_navigation',$aktif);
			$this->load->view('admin/view_left');
			$this->load->view('admin/master/bank/view_tambah_daftar_bank');
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
			$this->form_validation->set_rules($this->model_daftar_bank->tambah_daftarbank_rules);
			$this->form_validation->set_message('is_unique', '%s sudah digunakan.');

			if($this->form_validation->run() == TRUE)
			{
				if ($this->model_daftar_bank->aksi_tambah())
				{
					redirect ('admin/daftarbank?sukses=ya');
				}
				else
				{
					redirect ('admin/daftarbank?sukses=tidak');
				}
			}
			else
			{
				$this->session->set_flashdata('errors', validation_errors());

				redirect('admin/daftarbank/tambah');
			}
		}
		else
		{
			redirect();
		}
	}

	public function ubah($id_bank = null)
	{
		if ($id_bank != null && $this->session->userdata("hak") == "admin")
		{
			$data['bank'] = $this->model_daftar_bank->ubah($id_bank);
			$aktif['nav'] = "master";
			$aktif['notif'] = $this->model_daftar_bank->notif();

			$this->load->view('admin/view_head');
			$this->load->view('admin/view_navigation',$aktif);
			$this->load->view('admin/view_left');
			$this->load->view('admin/master/bank/view_ubah_daftar_bank',$data);
		}
		else
		{
			redirect();
		}
	}

	public function aksi_ubah($id_bank = null)
	{
		if ($id_bank != null && $this->session->userdata("hak") == "admin")
		{
			$this->form_validation->set_rules($this->model_daftar_bank->daftarbank_rules);
			$this->form_validation->set_message('is_unique', '%s sudah digunakan.');

			if($this->form_validation->run() == TRUE)
			{
				if ($this->model_daftar_bank->aksi_ubah($id_bank))
				{
					redirect ('admin/daftarbank?sukses_ubah=ya');
				}
				else
				{
					redirect ('admin/daftarbank?sukses=tidak');
				}
			}
			else
			{
				$this->session->set_flashdata('errors', validation_errors());

				redirect('admin/daftarbank/ubah/'.$id_bank);
			}
		}
		else
		{
			redirect();
		}
	}
}