<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pegawai extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/model_pegawai');
	}

	public function index()
	{
		if ($this->session->userdata("hak") != "user")
		{
			$data['pegawai'] = $this->model_pegawai->index();
			$aktif['nav'] = "pegawai";
			$aktif['notif'] = $this->model_pegawai->notif();

			$this->load->view('admin/view_head');
			$this->load->view('admin/view_navigation',$aktif);
			$this->load->view('admin/view_left');
			$this->load->view('admin/pegawai/pegawai/view_pegawai',$data);
		}
		else
		{
			redirect();
		}
	}

	public function detail($id_pgw = null)
	{
		if ($id_pgw != null && $this->session->userdata("hak") != "user" || $id_pgw == $this->session->userdata("id_pgw"))
		{
			if ($this->model_pegawai->detail($id_pgw))
			{
				$data['pegawai'] = $this->model_pegawai->detail($id_pgw);
			}
			else
			{
				redirect();
			}
			
			$aktif['nav'] = "pegawai";
			$aktif['notif'] = $this->model_pegawai->notif();

			$this->load->view('admin/view_head');
			$this->load->view('admin/view_navigation',$aktif);
			$this->load->view('admin/view_left');
			$this->load->view('admin/pegawai/pegawai/view_detail_pegawai',$data);
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
			$data['jabatan'] = $this->model_pegawai->jabatan();
			$aktif['nav'] = "pegawai";
			$aktif['notif'] = $this->model_pegawai->notif();

			$this->load->view('admin/view_head');
			$this->load->view('admin/view_navigation',$aktif);
			$this->load->view('admin/view_left');
			$this->load->view('admin/pegawai/pegawai/view_tambah_pegawai',$data);
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
			$this->form_validation->set_rules($this->model_pegawai->tambah_pegawai_rules);
			$this->form_validation->set_message('is_unique', '%s sudah digunakan.');
			$upload = null;
			$random_pass = strtotime(date("d-m-Y h:i:s"));

			if($_FILES['userfile']['name'] != '')
			{
				if (!$this->photo_copy())
				{
					$this->session->set_flashdata('errors', "Ukuran file tidak lebih dari 2 MB dan berformat (*.jpg)");

					redirect('admin/pegawai/tambah');
				}
				else
				{
					$upload = $this->photo_copy();
				}
			}

			if($this->form_validation->run() == TRUE)
			{
				if ($this->model_pegawai->aksi_tambah($upload,$random_pass)) 
				{
					$this->email($this->input->post('email'),$this->input->post('username'),$random_pass);
					redirect('admin/pegawai?sukses=ya');
				}
				else
				{
					redirect('admin/pegawai?sukses=tidak');
				}
			}
			else
			{
				$this->session->set_flashdata('errors', validation_errors());

				redirect('admin/pegawai/tambah');
			}
		}
		else
		{
			redirect();
		}
	}

	public function ubah($id_pgw = null)
	{
		if ($id_pgw != null && $id_pgw  == $this->session->userdata("id_pgw") || $id_pgw != null && $this->session->userdata("hak") == "admin")
		{
			$data['jabatan'] = $this->model_pegawai->jabatan();
			$data['pegawai'] = $this->model_pegawai->ubah($id_pgw);
			$aktif['nav'] = "pegawai";
			$aktif['notif'] = $this->model_pegawai->notif();
			$this->session->set_flashdata('pass', $data['pegawai']->pass_pgw);
			
			$this->load->view('admin/view_head');
			$this->load->view('admin/view_navigation',$aktif);
			$this->load->view('admin/view_left');
			$this->load->view('admin/pegawai/pegawai/view_ubah_pegawai',$data);
		}
		else
		{
			redirect();
		}
	}

	public function aksi_ubah($id_pgw = null)
	{
		if ($id_pgw != null && $id_pgw  == $this->session->userdata("id_pgw") || $id_pgw != null && $this->session->userdata("hak") == "admin")
		{
			$this->form_validation->set_rules($this->model_pegawai->pegawai_rules);
			$upload = null;
			
			if($_FILES['userfile']['name'] != '')
			{
				if (!$this->photo_copy())
				{
					$this->session->set_flashdata('errors', "Ukuran file tidak lebih dari 2 MB dan berformat (*.jpg)");

					redirect('admin/pegawai/ubah/'.$id_pgw);
				}
				else
				{
					$upload = $this->photo_copy();
				}
			}

			if($this->form_validation->run() == TRUE)
			{
				if ($this->model_pegawai->aksi_ubah($id_pgw,$upload)) 
				{
					if ($this->session->userdata("hak") == "admin")
					{
						$this->email($this->input->post('email'),$this->input->post('username'),$this->input->post('password'));
						redirect('admin/pegawai?sukses_ubah=ya');
					}
					else
					{
						redirect();
					}
				}
				else
				{
					redirect('admin/pegawai?sukses=tidak');
				}
			}
			else
			{
				$this->session->set_flashdata('errors', validation_errors());

				redirect('admin/pegawai/ubah/'.$id_pgw);
			}
		}
		else
		{
			redirect();
		}
	}

	public function aktifasi($id_pgw,$status)
	{
		if ($this->session->userdata("hak") == "admin")
		{
			if ($this->model_pegawai->aktifasi($id_pgw,$status))
			{
				redirect('admin/pegawai');
			}
			else
			{
				redirect('admin/pegawai');
			}
		}
		else
		{
			redirect();
		}
	}

	public function foto()
	{
		if (!file_exists('./images/'.$this->session->userdata['id_pgw']))
		{
    		mkdir('./images/'.$this->session->userdata['id_pgw'], 0777, true);
		}

		$config['upload_path'] = 'images/'.$this->session->userdata['id_pgw'];
		$config['allowed_types'] = 'jpg|jpeg';
		$config['max_size']	= '1024';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$this->session->set_flashdata('errors', "Ukuran file tidak lebih dari 1 MB dan berformat (*.jpg)");
			
			redirect('admin/pegawai/detail/'.$this->session->userdata['id_pgw']);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			$file = $data['upload_data']['file_name'];

			$config['image_library'] = 'gd2';
			$config['source_image'] = 'images/'.$this->session->userdata['id_pgw']."/".$file;
			$config['new_image'] = 'images/'.$this->session->userdata['id_pgw']."/".$this->session->userdata['id_pgw'].'.jpg';
			$config['maintain_ratio'] = TRUE;
			$config['quality'] = "100%";
			$config['width'] = 130;
			$config['height'] = 130;

			$this->load->library('image_lib', $config);
			$this->image_lib->resize();

			unlink($config['source_image']);

			$this->model_pegawai->foto();
			
			redirect('admin/pegawai/detail/'.$this->session->userdata['id_pgw']);
		}
	}

	public function photo_copy()
	{
		if (!file_exists('./images/ktp/'))
		{
    		mkdir('./images/ktp/', 0777, true);
		}

		$config['upload_path'] = 'images/ktp/';
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
			$config['source_image'] = 'images/ktp/'.$file;
			$config['new_image'] = 'images/ktp/'.$date.'.jpg';
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

	public function download($id_pgw)
	{
		$data['download'] = $this->model_pegawai->detail($id_pgw);
		force_download("photo.jpg", file_get_contents($data['download']->pc_ktp_pgw));
	}

	public function email($email,$username,$pass)
	{
    	$psn = "Assalamu'alaikum Wr. Wb,<br/>
    			<br/>
    			Selamat anda telah terdaftar sebagai pengguna<br/>
    			aplikasi Sistem Informasi Manajemen SDM PT. Duta Transformasi Insani.<br/>
    			<br/>
    			Berikut data login anda : <br/>
    			<b>Username : ".$username." <br/>
    			Password : ".$pass." </b><br/>
    			<br/>
    			Terima Kasih, <br/>
    			<img src='http://dti.ozan-soft.com/img/logo.jpg' width='70' /><br/>
    			PT. Duta Transformasi Insani<br/>
				Jl. Gegerkalong Girang Baru No. 4 Bandung Jawa Barat 40154<br/>
				Telp. (022) 2008013, 2005415, 70622951 Fax. (022) 2009097, 2009174<br/>
				E-mail: marketing@dtinsani.com<br/>
				Website : <a href='http://dtinsani.com/' target='_blank'>dtinsani.com</a>";

		$config = Array(
			'protocol' => 'smtp',
			'smtp_host' => 'mail.ozan-soft.com',
			'smtp_port' => 26,
			'smtp_user' => 'noreply_dti@ozan-soft.com',
			'smtp_pass' => '123qweasdzxc',
			'mailtype' => 'html',
			'charset' => 'UTF-8',
			'wordwrap' => TRUE
			);

    	$this->load->library('email', $config); 
    	$this->email->from("noreply_dti@ozan-soft.com","Duta Transformasi Insani");
    	$this->email->to($email);
    	$this->email->subject("[NO REPLY] Data Pegawai PT. Duta Transformasi Insani");
    	$this->email->message($psn);

    	$this->email->set_newline("\r\n"); // require this, otherwise sending via gmail times out

    	$this->email->send();
	}

	public function cetak($id_pgw)
	{
		$data['pegawai'] = $this->model_pegawai->cetak($id_pgw);

		$html = $this->load->view('pdf/cetak_biodata',$data,true);
		// Get output html
		// Load library
		$this->load->library('dompdf_gen');
		
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("Pegawai.pdf");

		//redirect('admin/pegawai/detail/'.$id_pgw);
	}
}