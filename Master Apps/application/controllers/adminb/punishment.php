<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Punishment extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/model_punishment');
	}

	public function index()
	{
		if ($this->session->userdata("hak") != "user")
		{
			$data['punishment'] = $this->model_punishment->index();
			$aktif['nav'] = "pegawai";
			$aktif['notif'] = $this->model_punishment->notif();

			$this->load->view('admin/view_head');
			$this->load->view('admin/view_navigation',$aktif);
			$this->load->view('admin/view_left');
			$this->load->view('admin/pegawai/punishment/view_punishment',$data);
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
			$data['pegawai'] = $this->model_punishment->pegawai();
			$aktif['nav'] = "pegawai";
			$aktif['notif'] = $this->model_punishment->notif();

			$this->load->view('admin/view_head');
			$this->load->view('admin/view_navigation',$aktif);
			$this->load->view('admin/view_left');
			$this->load->view('admin/pegawai/punishment/view_tambah_punishment',$data);
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
			$this->form_validation->set_rules($this->model_punishment->punishment_rules);
			$upload = null;
			
			if($_FILES['userfile']['name'] != '')
			{
				if (!$this->photo_copy())
				{
					$this->session->set_flashdata('notif', "Ukuran file tidak lebih dari 2 MB dan berformat (*.jpg).");
					$this->session->set_flashdata('alert', "error");

					redirect('admin/punishment/tambah');
				}
				else
				{
					$upload = $this->photo_copy();
				}
			}

			if($this->form_validation->run() == TRUE)
			{
				if ($this->model_punishment->aksi_tambah($upload)) 
				{
					$this->session->set_flashdata('notif', "Berhasil menambah punishment.");
					$this->session->set_flashdata('alert', "success");

					redirect('admin/punishment');
				}
				else
				{
					$this->session->set_flashdata('notif', "Gagal. Terjadi kesalahan pada sistem");
					$this->session->set_flashdata('alert', "error");

					redirect('admin/punishment');
				}
			}
			else
			{
				$this->session->set_flashdata('notif', validation_errors());
				$this->session->set_flashdata('alert', "error");
				redirect('admin/punishment/tambah');
			}
		}
		else
		{
			redirect();
		}
	}

	public function ubah($id_pun = null)
	{
		if ($id_pun != null && $this->session->userdata("hak") == "admin")
		{
			$data['pegawai'] = $this->model_punishment->pegawai();
			$data['punishment'] = $this->model_punishment->ubah($id_pun);
			$aktif['nav'] = "pegawai";
			$aktif['notif'] = $this->model_punishment->notif();
			
			$this->load->view('admin/view_head');
			$this->load->view('admin/view_navigation',$aktif);
			$this->load->view('admin/view_left');
			$this->load->view('admin/pegawai/punishment/view_ubah_punishment',$data);
		}
		else
		{
			redirect();
		}
	}

	public function aksi_ubah($id_pun = null)
	{
		if ($id_pun != null && $this->session->userdata("hak") == "admin")
		{
			$this->form_validation->set_rules($this->model_punishment->punishment_rules);
			$upload = null;
			
			if($_FILES['userfile']['name'] != '')
			{
				if (!$this->photo_copy())
				{
					$this->session->set_flashdata('notif', "Ukuran file tidak lebih dari 2 MB dan berformat (*.jpg).");
					$this->session->set_flashdata('alert', "error");

					redirect('admin/punishment/ubah/'.$id_pun);
				}
				else
				{
					$upload = $this->photo_copy();
				}
			}

			if($this->form_validation->run() == TRUE)
			{
				if ($this->model_punishment->aksi_ubah($id_pun,$upload)) 
				{
					$this->session->set_flashdata('notif', "Berhasil mengubah punishment.");
					$this->session->set_flashdata('alert', "success");

					redirect('admin/punishment');
				}
				else
				{
					$this->session->set_flashdata('notif', "Gagal. Terjadi kesalahan pada sistem");
					$this->session->set_flashdata('alert', "error");

					redirect('admin/punishment');
				}
			}
			else
			{
				$this->session->set_flashdata('notif', validation_errors());
				$this->session->set_flashdata('alert', "error");

				redirect('admin/punishment/ubah/'.$id_pun);
			}
		}
		else
		{
			redirect();
		}
	}

	public function photo_copy()
	{
		if (!file_exists('./images/punishment/'))
		{
    		mkdir('./images/punishment/', 0777, true);
		}

		$config['upload_path'] = 'images/punishment/';
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
			$config['source_image'] = 'images/punishment/'.$file;
			$config['new_image'] = 'images/punishment/'.$date.'.jpg';
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

	public function download($id_pun)
	{
		$data['download'] = $this->model_punishment->download($id_pun);
		force_download("pc_punishment.jpg", file_get_contents($data['download']->surat_pun));
	}
}