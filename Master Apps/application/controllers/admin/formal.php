<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Formal extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/model_formal');
	}

	public function index()
	{
		$data['formal'] = $this->model_formal->index();
		$aktif['nav'] = "pegawai";
		$aktif['notif'] = $this->model_formal->notif();

		$this->load->view('admin/view_head');
		$this->load->view('admin/view_navigation',$aktif);
		$this->load->view('admin/view_left');
		$this->load->view('admin/pegawai/formal/view_formal',$data);
	}

	public function tambah()
	{
		$data['pegawai'] = $this->model_formal->pegawai();
		$data['pendidikan'] = $this->model_formal->pendidikan();
		$aktif['nav'] = "pegawai";
		$aktif['notif'] = $this->model_formal->notif();

		$this->load->view('admin/view_head');
		$this->load->view('admin/view_navigation',$aktif);
		$this->load->view('admin/view_left');
		$this->load->view('admin/pegawai/formal/view_tambah_formal',$data);
	}

	public function aksi_tambah()
	{
		$this->form_validation->set_rules($this->model_formal->formal_rules);
		$upload = null;

		if($_FILES['userfile']['name'] != '')
		{
			if (!$this->photo_copy())
			{
				$this->session->set_flashdata('errors', "Ukuran file tidak lebih dari 2 MB dan berformat (*.jpg)");

				redirect('admin/formal/tambah');
			}
			else
			{
				$upload = $this->photo_copy();
			}
		}

		if($this->form_validation->run() == TRUE)
		{
			if ($this->model_formal->aksi_tambah($upload)) 
			{
				redirect('admin/formal?sukses=ya');
			}
			else
			{
				redirect('admin/formal?sukses=tidak');
			}
		}
	}

	public function ubah($id_dtl_formal)
	{
		$data['pegawai'] = $this->model_formal->pegawai();
		$data['pendidikan'] = $this->model_formal->pendidikan();
		$data['formal'] = $this->model_formal->ubah($id_dtl_formal);
		$aktif['nav'] = "pegawai";
		$aktif['notif'] = $this->model_formal->notif();

		$this->load->view('admin/view_head');
		$this->load->view('admin/view_navigation',$aktif);
		$this->load->view('admin/view_left');
		$this->load->view('admin/pegawai/formal/view_ubah_formal',$data);
	}

	public function aksi_ubah($id_dtl_formal)
	{
		$this->form_validation->set_rules($this->model_formal->formal_rules);
		$upload = null;
		
		if($_FILES['userfile']['name'] != '')
		{
			if (!$this->photo_copy())
			{
				$this->session->set_flashdata('errors', "Ukuran file tidak lebih dari 2 MB dan berformat (*.jpg)");

				redirect('admin/formal/ubah/'.$id_dtl_formal);
			}
			else
			{
				$upload = $this->photo_copy();
			}
		}

		if($this->form_validation->run() == TRUE)
		{
			if ($this->model_formal->aksi_ubah($id_dtl_formal,$upload)) 
			{
				redirect('admin/formal?sukses_ubah=ya');
			}
			else
			{
				redirect('admin/formal?sukses=tidak');
			}
		}
	}

	public function photo_copy()
	{
		if (!file_exists('./images/ijazah/'))
		{
    		mkdir('./images/ijazah/', 0777, true);
		}

		$config['upload_path'] = 'images/ijazah/';
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
			$config['source_image'] = 'images/ijazah/'.$file;
			$config['new_image'] = 'images/ijazah/'.$date.'.jpg';
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

	public function download($id_dtl_formal)
	{
		$data['download'] = $this->model_formal->download($id_dtl_formal);
		force_download("pc_formal.jpg", file_get_contents($data['download']->pc_ijzh));
	}
}