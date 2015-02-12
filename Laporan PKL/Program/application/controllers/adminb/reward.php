<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reward extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/model_reward');
	}

	public function index()
	{
		if ($this->session->userdata("hak") != "user")
		{
			$data['reward'] = $this->model_reward->index();
			$aktif['nav'] = "pegawai";
			$aktif['notif'] = $this->model_reward->notif();

			$this->load->view('admin/view_head');
			$this->load->view('admin/view_navigation',$aktif);
			$this->load->view('admin/view_left');
			$this->load->view('admin/pegawai/reward/view_reward',$data);
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
			$data['pegawai'] = $this->model_reward->pegawai();
			$aktif['nav'] = "pegawai";
			$aktif['notif'] = $this->model_reward->notif();

			$this->load->view('admin/view_head');
			$this->load->view('admin/view_navigation',$aktif);
			$this->load->view('admin/view_left');
			$this->load->view('admin/pegawai/reward/view_tambah_reward',$data);
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
			$this->form_validation->set_rules($this->model_reward->reward_rules);

			if($this->form_validation->run() == TRUE)
			{
				if ($this->model_reward->aksi_tambah()) 
				{
					$this->session->set_flashdata('notif', "Berhasil menambah reward.");
					$this->session->set_flashdata('alert', "success");

					redirect('admin/reward');
				}
				else
				{
					$this->session->set_flashdata('notif', "Gagal. Terjadi kesalahan pada sistem");
					$this->session->set_flashdata('alert', "error");

					redirect('admin/reward');
				}
			}
			else
			{
				$this->session->set_flashdata('notif', validation_errors());
				$this->session->set_flashdata('alert', "error");
				redirect('admin/reward/tambah');
			}
		}
		else
		{
			redirect();
		}
	}

	public function ubah($id_reward = null)
	{
		if ($id_reward != null && $this->session->userdata("hak") == "admin")
		{
			$data['pegawai'] = $this->model_reward->pegawai();
			$data['reward'] = $this->model_reward->ubah($id_reward);
			$aktif['nav'] = "pegawai";
			$aktif['notif'] = $this->model_reward->notif();
			
			$this->load->view('admin/view_head');
			$this->load->view('admin/view_navigation',$aktif);
			$this->load->view('admin/view_left');
			$this->load->view('admin/pegawai/reward/view_ubah_reward',$data);
		}
		else
		{
			redirect();
		}
	}

	public function aksi_ubah($id_reward = null)
	{
		if ($id_reward != null && $this->session->userdata("hak") == "admin")
		{
			$this->form_validation->set_rules($this->model_reward->reward_rules);

			if($this->form_validation->run() == TRUE)
			{
				if ($this->model_reward->aksi_ubah($id_reward)) 
				{
					$this->session->set_flashdata('notif', "Berhasil mengubah reward.");
					$this->session->set_flashdata('alert', "success");

					redirect('admin/reward');
				}
				else
				{
					$this->session->set_flashdata('notif', "Gagal. Terjadi kesalahan pada sistem");
					$this->session->set_flashdata('alert', "error");

					redirect('admin/reward');
				}
			}
			else
			{
				$this->session->set_flashdata('notif', validation_errors());
				$this->session->set_flashdata('alert', "error");

				redirect('admin/reward/ubah/'.$id_reward);
			}
		}
		else
		{
			redirect();
		}
	}
}