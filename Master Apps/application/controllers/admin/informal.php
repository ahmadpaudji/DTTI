<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Informal extends Admin_Controller
{
	public function __construct()
    {
    	parent::__construct();
		$this->load->model('admin/model_informal');
    }

	public function index()
	{
		$data['informal'] = $this->model_informal->index();
		$aktif['nav'] = "pegawai";
		$aktif['notif'] = $this->model_informal->notif();

		$this->load->view('admin/view_head');
		$this->load->view('admin/view_navigation',$aktif);
		$this->load->view('admin/view_left');
		$this->load->view('admin/pegawai/informal/view_informal',$data);
	}

	public function tambah()
	{
		$data['pegawai'] = $this->model_informal->pegawai();
		$data['pendidikan'] = $this->model_informal->pendidikan();
		$aktif['nav'] = "pegawai";
		$aktif['notif'] = $this->model_informal->notif();

		$this->load->view('admin/view_head');
		$this->load->view('admin/view_navigation',$aktif);
		$this->load->view('admin/view_left');
		$this->load->view('admin/pegawai/informal/view_tambah_informal',$data);
	}

	public function aksi_tambah()
	{
		$this->form_validation->set_rules($this->model_informal->informal_rules);
		$upload = null;

		if($_FILES['userfile']['name'] != '')
		{
			if (!$this->photo_copy())
			{
				$this->session->set_flashdata('errors', "Ukuran file tidak lebih dari 2 MB dan berformat (*.jpg)");

				redirect('admin/informal/tambah');
			}
			else
			{
				$upload = $this->photo_copy();
			}
		}

		if($this->form_validation->run() == TRUE)
		{
			if ($this->model_informal->aksi_tambah($upload)) 
			{
				redirect('admin/informal?sukses=ya');
			}
			else
			{
				redirect('admin/informal?sukses=tidak');
			}
		}
	}

	public function ubah($id_dtl_informal)
	{
		$data['pegawai'] = $this->model_informal->pegawai();
		$data['pendidikan'] = $this->model_informal->pendidikan();
		$data['informal'] = $this->model_informal->ubah($id_dtl_informal);
		$aktif['nav'] = "pegawai";
		$aktif['notif'] = $this->model_informal->notif();

		$this->load->view('admin/view_head');
		$this->load->view('admin/view_navigation',$aktif);
		$this->load->view('admin/view_left');
		$this->load->view('admin/pegawai/informal/view_ubah_informal',$data);
	}

	public function aksi_ubah($id_dtl_informal)
	{
		$this->form_validation->set_rules($this->model_informal->informal_rules);
		$upload = null;
		
		if($_FILES['userfile']['name'] != '')
		{
			if (!$this->photo_copy())
			{
				$this->session->set_flashdata('errors', "Ukuran file tidak lebih dari 2 MB dan berformat (*.jpg)");

				redirect('admin/informal/ubah/'.$id_dtl_informal);
			}
			else
			{
				$upload = $this->photo_copy();
			}
		}

		if($this->form_validation->run() == TRUE)
		{
			if ($this->model_informal->aksi_ubah($id_dtl_informal,$upload)) 
			{
				redirect('admin/informal?sukses_ubah=ya');
			}
			else
			{
				redirect('admin/informal?sukses=tidak');
			}
		}
		else
		{
			echo "ddd";
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

	public function download($id_dtl_informal)
	{
		$data['download'] = $this->model_informal->download($id_dtl_informal);
		force_download("pc_informal.jpg", file_get_contents($data['download']->pc_srtkt));
	}
}