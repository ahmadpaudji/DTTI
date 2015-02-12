<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sim extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/model_sim');
	}

	public function index()
	{
		if ($this->session->userdata("hak") != "user")
		{
			$data['sim'] = $this->model_sim->index();
			$aktif['nav'] = "pegawai";
			$aktif['notif'] = $this->model_sim->notif();

			$this->load->view('admin/view_head');
			$this->load->view('admin/view_navigation',$aktif);
			$this->load->view('admin/view_left');
			$this->load->view('admin/pegawai/sim/view_sim',$data);
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
			$data['pegawai'] = $this->model_sim->pegawai();
			$aktif['nav'] = "pegawai";
			$aktif['notif'] = $this->model_sim->notif();

			$this->load->view('admin/view_head');
			$this->load->view('admin/view_navigation',$aktif);
			$this->load->view('admin/view_left');
			$this->load->view('admin/pegawai/sim/view_tambah_sim',$data);
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
			$this->form_validation->set_rules($this->model_sim->tambah_sim_rules);
			$this->form_validation->set_message('is_unique', 'Nomor SIM sudah digunakan.');
			$upload = null;
			
			if($_FILES['userfile']['name'] != '')
			{
				if (!$this->photo_copy())
				{
					$this->session->set_flashdata('errors', "Ukuran file tidak lebih dari 2 MB dan berformat (*.jpg)");

					redirect('admin/sim/tambah');
				}
				else
				{
					$upload = $this->photo_copy();
				}
			}

			if($this->form_validation->run() == TRUE)
			{
				if ($this->model_sim->aksi_tambah($upload)) 
				{
					redirect('admin/sim?sukses=ya');
				}
				else
				{
					redirect('admin/sim?sukses=tidak');
				}
			}
			else
			{
				$this->session->set_flashdata('errors', validation_errors());

				redirect('admin/sim/tambah');
			}
		}
		else
		{
			redirect();
		}
	}

	public function ubah($id_sim = null)
	{
		if ($id_sim != null && $this->session->userdata("hak") == "admin")
		{
			$data['pegawai'] = $this->model_sim->pegawai();
			$data['sim'] = $this->model_sim->ubah($id_sim);
			$aktif['nav'] = "pegawai";
			$aktif['notif'] = $this->model_sim->notif();

			$this->load->view('admin/view_head');
			$this->load->view('admin/view_navigation',$aktif);
			$this->load->view('admin/view_left');
			$this->load->view('admin/pegawai/sim/view_ubah_sim',$data);
		}
		else
		{
			redirect();
		}
	}

	public function aksi_ubah($id_sim = null)
	{
		if ($id_sim != null && $this->session->userdata("hak") == "admin")
		{
			$this->form_validation->set_rules($this->model_sim->sim_rules);
			$this->form_validation->set_message('is_unique', 'Nomor SIM sudah digunakan.');
			$upload = null;

			if($_FILES['userfile']['name'] != '')
			{
				if (!$this->photo_copy())
				{
					$this->session->set_flashdata('errors', "Ukuran file tidak lebih dari 2 MB dan berformat (*.jpg)");

					redirect('admin/sim/ubah/'.$id_sim);
				}
				else
				{
					$upload = $this->photo_copy();
				}
			}

			if($this->form_validation->run() == TRUE)
			{
				if ($this->model_sim->aksi_ubah($id_sim,$upload))
				{
					redirect('admin/sim?sukses_ubah=ya');
				}
				else
				{
					redirect('admin/sim?sukses=tidak');
				}
			}
			else
			{
				$this->session->set_flashdata('errors', validation_errors());

				redirect('admin/sim/ubah/'.$id_sim);
			}
		}
		else
		{
			redirect();
		}
	}

	public function photo_copy()
	{
		if (!file_exists('./images/sim/'))
		{
    		mkdir('./images/sim/', 0777, true);
		}

		$config['upload_path'] = 'images/sim/';
		$config['allowed_types'] = 'jpg|jpeg';
		$config['max_size']	= '2048';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			return false;
		}
		else
		{
			date_default_timezone_set("Asia/Jakarta");
			$date = date("dmYhis");
			$data = array('upload_data' => $this->upload->data());
			$file = $data['upload_data']['file_name'];
			
			$config['image_library'] = 'gd2';
			$config['source_image'] = 'images/sim/'.$file;
			$config['new_image'] = 'images/sim/'.$date.'.jpg';
			$config['maintain_ratio'] = TRUE;
			$config['quality'] = "100%";
			$config['width'] = 600;
			$config['height'] = 380;
			
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();

			unlink($config['source_image']);

			return $config['new_image'];
		}
	}

	public function download($id_sim)
	{
		$data['download'] = $this->model_sim->download($id_sim);
		force_download("pc_sim.jpg", file_get_contents($data['download']->pc_sim));
	}
}