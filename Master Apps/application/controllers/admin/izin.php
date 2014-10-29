<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Izin extends Admin_Controller 
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

	public function konfirmasi($cari = null)
	{
		$data['pegawai'] = $this->model_izin->pegawai();
		$aktif['nav'] = "konfirmasi";
		$aktif['notif'] = $this->model_izin->notif();

		if ($cari == "cari")
		{
			$data['izin'] = $this->model_izin->konfirmasi();
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
		$upload = null;

		if($_FILES['userfile']['name'] != '')
		{
			if (!$this->photo_copy())
			{
				$this->session->set_flashdata('errors', "Ukuran file tidak lebih dari 2 MB dan berformat (*.jpg)");

				redirect('admin/absen/tambah');
			}
			else
			{
				$upload = $this->photo_copy();
			}
		}

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

	public function detail($id_abs)
	{
		$data['izin'] = $this->model_izin->detail($id_abs);
		$aktif['nav'] = "pengajuan";
		$aktif['notif'] = $this->model_izin->notif();

		$this->load->view('admin/view_head');
		$this->load->view('admin/view_navigation',$aktif);
		$this->load->view('admin/view_left');
		$this->load->view('admin/izin/view_detail_izin',$data);
	}

	public function ubah($id_abs)
	{
		$data['izin'] = $this->model_izin->ubah($id_abs);
		$aktif['nav'] = "pengajuan";
		$aktif['notif'] = $this->model_izin->notif();

		$this->load->view('admin/view_head');
		$this->load->view('admin/view_navigation',$aktif);
		$this->load->view('admin/view_left');
		$this->load->view('admin/izin/view_ubah_izin',$data);
	}

	public function aksi_ubah($id_abs)
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

	public function photo_copy()
	{
		if (!file_exists('./images/izin/'))
		{
    		mkdir('./images/izin/', 0777, true);
		}

		$config['upload_path'] = 'images/izin/';
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
			$config['source_image'] = 'images/izin/'.$file;
			$config['new_image'] = 'images/izin/'.$date.'.jpg';
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

	public function download($id_abs)
	{
		$data['download'] = $this->model_izin->download($id_abs);
		force_download("pc_izin.jpg", file_get_contents($data['download']->bukti_abs));
	}
}