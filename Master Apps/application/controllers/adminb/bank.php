<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bank extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/model_bank');
	}

	public function index()
	{
		if ($this->session->userdata("hak") != "user")
		{
			$data['bank'] = $this->model_bank->index();
			$aktif['nav'] = "pegawai";
			$aktif['notif'] = $this->model_bank->notif();

			$this->load->view('admin/view_head');
			$this->load->view('admin/view_navigation',$aktif);
			$this->load->view('admin/view_left');
			$this->load->view('admin/pegawai/bank/view_bank',$data);
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
			$data['pegawai'] = $this->model_bank->pegawai();
			$data['bank'] = $this->model_bank->bank();
			$aktif['nav'] = "pegawai";
			$aktif['notif'] = $this->model_bank->notif();

			$this->load->view('admin/view_head');
			$this->load->view('admin/view_navigation',$aktif);
			$this->load->view('admin/view_left');
			$this->load->view('admin/pegawai/bank/view_tambah_bank',$data);
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
			$this->form_validation->set_rules($this->model_bank->tambah_bank_rules);
			$this->form_validation->set_message('is_unique', 'Rekening sudah digunakan.');

			if($this->form_validation->run() == TRUE)
			{
				if ($this->model_bank->aksi_tambah()) 
				{
					redirect('admin/bank?sukses=ya');
				}
				else
				{
					redirect('admin/bank?sukses=tidak');
				}
			}
			else
			{
				$this->session->set_flashdata('errors', validation_errors());

				redirect('admin/bank/tambah');
			}
		}
		else
		{
			redirect();
		}
	}

	public function ubah($id_dtl_bank = null)
	{
		if ($id_dtl_bank != null && $this->session->userdata("hak") == "admin")
		{
			$data['pegawai'] = $this->model_bank->pegawai();
			$data['bank'] = $this->model_bank->bank();
			$data['ubah_bank'] = $this->model_bank->ubah($id_dtl_bank);
			$aktif['nav'] = "pegawai";
			$aktif['notif'] = $this->model_bank->notif();
			
			$this->load->view('admin/view_head');
			$this->load->view('admin/view_navigation',$aktif);
			$this->load->view('admin/view_left');
			$this->load->view('admin/pegawai/bank/view_ubah_bank',$data);
		}
		else
		{
			redirect();
		}
	}

	public function aksi_ubah($id_dtl_bank = null)
	{
		if ($id_dtl_bank != null && $this->session->userdata("hak") == "admin")
		{
			$this->form_validation->set_rules($this->model_bank->bank_rules);

			if($this->form_validation->run() == TRUE)
			{
				if ($this->model_bank->aksi_ubah($id_dtl_bank)) 
				{
					redirect('admin/bank?sukses_ubah=ya');
				}
				else
				{
					redirect('admin/bank?sukses=tidak');
				}
			}
			else
			{
				$this->session->set_flashdata('errors', validation_errors());

				redirect('admin/bank/ubah/'.$id_dtl_bank);
			}
		}
		else
		{
			redirect();
		}
	}
}