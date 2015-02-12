<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Izin extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/model_izin');
	}

	public function index($cari = null,$notif = null)
	{
		$this->model_izin->get_email();
		$data['pegawai'] = $this->model_izin->pegawai();
		$aktif['nav'] = "pengajuan";
		$aktif['notif'] = $this->model_izin->notif();
		if ($cari == "cari")
		{
			$data['izin'] = $this->model_izin->index($notif);
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

	public function rekap()
	{
		if ($this->session->userdata('hak') != "user")
		{
			$aktif['nav'] = "pengajuan";
			$aktif['notif'] = $this->model_izin->notif();
			$data['izin'] = $this->model_izin->rekap();

			$this->load->view('admin/view_head');
			$this->load->view('admin/view_navigation',$aktif);
			$this->load->view('admin/view_left');
			$this->load->view('admin/izin/view_rekap_izin',$data);
		}
		else
		{
			redirect();
		}
	}

	public function konfirmasi($cari = null,$notif = null)
	{
		$jbt_konf = ['manajer','direktur utama','direktur operasional','direktur marketing'];
		if (in_array($this->session->userdata('jabatan'), $jbt_konf) || $this->session->userdata("hak") == "admin")
		{
			if ($this->session->userdata("jabatan") == "direktur utama")
			{
				$jabatan = "direksi utama";
			}
			else
			{
				$jabatan = 'y';
			}

			$data['pegawai'] = $this->model_izin->pegawai($jabatan);
			
			if ($this->session->userdata("hak") == "admin")
			{
				$aktif['nav'] = "pengajuan";
			}
			else
			{
				$aktif['nav'] = "konfirmasi";
			}

			$aktif['notif'] = $this->model_izin->notif();

			if ($cari == "cari")
			{
				$data['izin'] = $this->model_izin->konfirmasi($notif);
				$data['tampil'] = "true";
			}
			else
			{
				$data['tampil'] = "false";
			}

			$this->load->view('admin/view_head');
			$this->load->view('admin/view_navigation',$aktif);
			$this->load->view('admin/view_left');
			$this->load->view('admin/izin/view_izin_konfirmasi',$data);	
		}
		else
		{
			redirect();
		}
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
        date_default_timezone_set("Asia/Jakarta");
		$this->form_validation->set_rules($this->model_izin->izin_rules);
		$upload = null;

		$sekarang = date("Y-m-d");

		$tgl_mulai = explode('/', $this->input->post('tanggal_mulai'));
        $tanggal_mulai = $tgl_mulai[2].'-'.$tgl_mulai[0].'-'.$tgl_mulai[1];

        $tgl_akhir = explode('/', $this->input->post('tanggal_akhir'));
        $tanggal_akhir = $tgl_akhir[2].'-'.$tgl_akhir[0].'-'.$tgl_akhir[1];

		if ($tanggal_mulai <= $sekarang || $tanggal_akhir <= $sekarang)
		{
			$this->session->set_flashdata('errors', "Maaf pengisian izin harus dilakukan H-1.");

			redirect('admin/izin/tambah');
		}

		if($_FILES['userfile']['name'] != '')
		{
			if (!$this->photo_copy())
			{
				$this->session->set_flashdata('errors', "Ukuran file tidak lebih dari 2 MB dan berformat (*.jpg)");

				redirect('admin/izin/tambah');
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
				$email = $this->model_izin->get_email();
				
				$tgl_awal = explode('/', $this->input->post('tanggal_mulai'));
				$tgl_akhir = explode('/', $this->input->post('tanggal_akhir'));
            	$tanggal = $tgl_awal[1].'-'.$tgl_awal[0].'-'.$tgl_awal[2]." sampai ".$tgl_akhir[1].'-'.$tgl_akhir[0].'-'.$tgl_akhir[2];

				$this->email($email->email_pgw,$email->nma_lkp_pgw,$this->session->userdata("nama"),$this->input->post('jenis'),$tanggal);
				
				redirect('admin/izin/cari?sukses=ya');
			}
			else
			{
				redirect('admin/izin?sukses=tidak');
			}
		}
		else
		{
			redirect();
		}
	}

	public function detail($id_abs = null,$nav = null)
	{
		if ($id_abs != null && $nav != null)
		{
			$data['izin'] = $this->model_izin->detail($id_abs);
			$aktif['nav'] = $nav;
			$aktif['notif'] = $this->model_izin->notif();

			$this->load->view('admin/view_head');
			$this->load->view('admin/view_navigation',$aktif);
			$this->load->view('admin/view_left');
			$this->load->view('admin/izin/view_detail_izin',$data);
		}
		else
		{
			redirect();
		}
	}

	public function ubah($id_abs = null)
	{
		if ($id_abs != null)
		{
			$data['izin'] = $this->model_izin->ubah($id_abs);
			$aktif['nav'] = "pengajuan";
			$aktif['notif'] = $this->model_izin->notif();

			$this->load->view('admin/view_head');
			$this->load->view('admin/view_navigation',$aktif);
			$this->load->view('admin/view_left');
			$this->load->view('admin/izin/view_ubah_izin',$data);
		}
		else
		{
			redirect();
		}
	}

	public function aksi_ubah($id_abs = null)
	{
		if ($id_abs != null)
		{
			$this->form_validation->set_rules($this->model_izin->izin_rules);
			$upload = null;

			$sekarang = date("Y-m-d");

			$tgl_mulai = explode('/', $this->input->post('tanggal_mulai'));
	        $tanggal_mulai = $tgl_mulai[2].'-'.$tgl_mulai[0].'-'.$tgl_mulai[1];

	        $tgl_akhir = explode('/', $this->input->post('tanggal_akhir'));
	        $tanggal_akhir = $tgl_akhir[2].'-'.$tgl_akhir[0].'-'.$tgl_akhir[1];

			if ($tanggal_mulai <= $sekarang || $tanggal_akhir <= $sekarang)
			{
				$this->session->set_flashdata('errors', "Maaf pengisian izin harus dilakukan H-1.");

				redirect('admin/izin/ubah/'.$id_abs);
			}

			if($_FILES['userfile']['name'] != '')
			{
				if (!$this->photo_copy())
				{
					$this->session->set_flashdata('errors', "Ukuran file tidak lebih dari 2 MB dan berformat (*.jpg)");

					redirect('admin/izin/ubah/'.$id_abs);
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
			else
			{
				redirect();
			}
		}
		else
		{
			redirect();
		}
	}

	public function setuju($id_abs,$status)
	{
		if ($this->model_izin->setuju($id_abs,$status))
		{
			$this->session->set_flashdata('notif', "Berhasil mengkonfirmasi izin absen.");
			$this->session->set_flashdata('alert', "success");
			redirect('admin/izin/konfirmasi/cari');
		}
		else
		{
			$this->session->set_flashdata('notif', "Gagal. Terjadi kesalahan pada sistem.");
			$this->session->set_flashdata('alert', "error");
			redirect('admin/izin/konfirmasi/cari');
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

	public function email($email,$nama_penerima,$nama,$status,$tanggal)
	{
    	$psn = "Assalamu'alaikum Wr. Wb,<br/>
    			<br/>
    			Hai, ".strtoupper($nama_penerima)."<br/>
    			Permintaan persetujuan izin presensi :<br/>
    			Nama    : ".strtoupper($nama)."<br/>
    			Jabatan : ".strtoupper($this->session->userdata('jabatan'))."<br/>
    			Status  : ".strtoupper($status)."<br/>
    			Selama  : ".$tanggal."<br/>
    			Silahkan berikan konfirmasi segera.<br/>
    			<br/>
    			Berikut ini link konfirmasi izin presensi dan silahkan klik link ini : <br/>
    			<a href='http://dti.ozan-soft.com/admin/izin/konfirmasi/cari'>LINK</a> <br/>
    			Jazakumullah Khairan Katsiran,<br/>
    			Wassalamu'alaikum Wr. Wb,<br/>
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
    	$this->email->subject("[NO REPLY] Permintaan Izin");
    	$this->email->message($psn);

    	$this->email->set_newline("\r\n"); // require this, otherwise sending via gmail times out

    	$this->email->send();
	}

	public function cetak()
	{
		$data['izin'] = $this->model_izin->rekap();
		$data['direktur'] = $this->model_izin->get_direktur();
		
		$html = $this->load->view('pdf/cetak_pengajuanizinpresensi',$data,true);
		// Get output html
		// Load library
		$this->load->library('dompdf_gen');
		
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("Rekap_Izin_presensi.pdf");

		//redirect('admin/pegawai/detail/'.$id_pgw);
	}

	public function cetakIzin($id_abs = null)
	{
		$data['izin'] = $this->model_izin->detail($id_abs);
		$data['direktur'] = $this->model_izin->get_direktur();
		
		$html = $this->load->view('pdf/cetak_izinpresensi',$data,true);
		// Get output html
		// Load library
		$this->load->library('dompdf_gen');
		
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("Izin_presensi.pdf");

		//redirect('admin/pegawai/detail/'.$id_pgw);
	}
}