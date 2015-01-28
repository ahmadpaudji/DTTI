<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sppd extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("admin/model_sppd");
	}

	public function index($cari = null, $notif = null)
	{
		$aktif['nav'] = "pengajuan";
		$aktif['notif'] = $this->model_sppd->notif();
		if ($cari == "cari")
		{
			$data['sppd'] = $this->model_sppd->index($notif);
			$data['tampil'] = "true";
		}
		else
		{
			$data['tampil'] = "false";
		}

		$this->load->view('admin/view_head');
		$this->load->view('admin/view_navigation',$aktif);
		$this->load->view('admin/view_left');
		$this->load->view('admin/sppd/view_sppd',$data);		
	}

	public function konfirmasi($cari = null, $notif = null)
	{
		$jbt_konf = ['manajer','direktur utama','direktur operasional','direktur marketing'];
		if (in_array($this->session->userdata('jabatan'), $jbt_konf) || $this->session->userdata("hak") == "admin")
		{
			if ($this->session->userdata("hak") == "admin")
			{
				$aktif['nav'] = "pengajuan";
			}
			else
			{
				$aktif['nav'] = "konfirmasi";
			}
			
			$aktif['notif'] = $this->model_sppd->notif();

			if ($cari == "cari")
			{
				$data['sppd'] = $this->model_sppd->konfirmasi($notif);
				$data['tampil'] = "true";
			}
			else
			{
				$data['tampil'] = "false";
			}

			$this->load->view('admin/view_head');
			$this->load->view('admin/view_navigation',$aktif);
			$this->load->view('admin/view_left');
			$this->load->view('admin/sppd/view_sppd_konfirmasi',$data);	
		}
		else
		{
			redirect();
		}
	}

	public function rekap()
	{
		if ($this->session->userdata('hak') != "user")
		{
			$aktif['nav'] = "pengajuan";
			$aktif['notif'] = $this->model_sppd->notif();
			$data['sppd'] = $this->model_sppd->rekap();

			$this->load->view('admin/view_head');
			$this->load->view('admin/view_navigation',$aktif);
			$this->load->view('admin/view_left');
			$this->load->view('admin/sppd/view_rekap_sppd',$data);
		}
		else
		{
			redirect();
		}
	}

	public function tambah()
	{
		$jabatan = "sendiri";
		$data['pegawai'] = $this->model_sppd->pegawai($jabatan);
		$aktif['nav'] = "pengajuan";
		$aktif['notif'] = $this->model_sppd->notif();

		$this->load->view('admin/view_head');
		$this->load->view('admin/view_navigation',$aktif);
		$this->load->view('admin/view_left');
		$this->load->view('admin/sppd/view_tambah_sppd',$data);	
	}

	public function aksi_tambah()
	{
		date_default_timezone_set("Asia/Jakarta"); 
		
		$this->form_validation->set_rules($this->model_sppd->sppd_rules);

		$sekarang = date("Y-m-d");

		$tgl = explode('/',$this->input->post('tanggal'));
		$tanggal = $tgl[2].'-'.$tgl[0].'-'.$tgl[1];

		if ($tanggal <= $sekarang)
		{
			$this->session->set_flashdata('notif', "Maaf pengisian SPPD harus dilakukan H-1.");
			$this->session->set_flashdata('alert', "error");
			redirect('admin/sppd/tambah');
		}

		if($this->form_validation->run() == TRUE)
		{
			$tambah = $this->model_sppd->aksi_tambah();
			
			if ($tambah != false) 
			{
				$email = $this->model_sppd->get_email();
				
				$this->email($email->email_pgw,$email->nma_lkp_pgw,$this->session->userdata("nama"),$tambah);

				$this->session->set_flashdata('notif', "Berhasil menambah SPPD.");
				$this->session->set_flashdata('alert', "success");
				
				redirect('admin/sppd/cari');
			}
			else
			{
				$this->session->set_flashdata('notif', "Gagal. Terjadi kesalahan pada sistem");
				$this->session->set_flashdata('alert', "error");

				redirect('admin/sppd');
			}
		}
		else
		{
			$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('alert', "error");

			redirect('admin/sppd/tambah');
		}
	}

	public function detail($id_sppd= null)
	{
		if ($id_sppd != null)
		{
			if ($this->model_sppd->detail($id_sppd))
			{
				$data['spd'] = $this->model_sppd->detail($id_sppd);
				$data['pegawai'] = $this->model_sppd->pegawai();
				$aktif['nav'] = "pengajuan";
				$aktif['notif'] = $this->model_sppd->notif();

				$this->load->view('admin/view_head');
				$this->load->view('admin/view_navigation',$aktif);
				$this->load->view('admin/view_left');
				$this->load->view('admin/sppd/view_detail_sppd',$data);
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

	public function ubah($id_sppd = null)
	{	
		if ($id_sppd != null)
		{
			$jabatan = "sendiri";
			$data['pegawai'] = $this->model_sppd->pegawai($jabatan);
			$data['spd'] = $this->model_sppd->ubah($id_sppd);
			$aktif['nav'] = "pengajuan";
			$aktif['notif'] = $this->model_sppd->notif();

			$this->load->view('admin/view_head');
			$this->load->view('admin/view_navigation',$aktif);
			$this->load->view('admin/view_left');
			$this->load->view('admin/sppd/view_ubah_sppd',$data);
		}
		else
		{
			redirect();
		}
	}

	public function aksi_ubah($id_sppd = null)
	{
		date_default_timezone_set("Asia/Jakarta");

		if ($id_sppd != null)
		{
			$this->form_validation->set_rules($this->model_sppd->sppd_rules);

			$sekarang = date("Y-m-d");

			$tgl = explode('/',$this->input->post('tanggal'));
			$tanggal = $tgl[2].'-'.$tgl[0].'-'.$tgl[1];

			if ($tanggal <= $sekarang)
			{
				$this->session->set_flashdata('notif', "Maaf pengisian SPPD harus dilakukan H-1.");
				$this->session->set_flashdata('alert', "error");
				
				redirect('admin/sppd/tambah');
			}

			if($this->form_validation->run() == TRUE)
			{
				if ($this->model_sppd->aksi_ubah($id_sppd))
				{
					$this->session->set_flashdata('notif', "Berhasil mengubah SPPD.");
					$this->session->set_flashdata('alert', "success");

					redirect('admin/sppd');
				}
				else
				{
					$this->session->set_flashdata('notif', "Gagal. Terjadi kesalahan pada sistem");
					$this->session->set_flashdata('alert', "error");
					
					redirect('admin/sppd');
				}
			}
			else
			{
				$this->session->set_flashdata('notif', validation_errors());
				$this->session->set_flashdata('alert', "error");

				redirect('admin/sppd/ubah/'.$id_sppd);
			}
		}
		else
		{
			redirect();
		}
	}

	public function aksi_upload($id_sppd)
	{
		if ($this->session->userdata("hak") == "admin")
		{
			$upload = null;
				
			if($_FILES['userfile']['name'] != '')
			{
				if (!$this->photo_copy())
				{
					$this->session->set_flashdata('notif', "Ukuran file tidak lebih dari 2 MB dan berformat (*.jpg).");	
					$this->session->set_flashdata('alert', "error");

					redirect('admin/sppd/detail/'.$id_sppd);
				}
				else
				{
					$upload = $this->photo_copy();
				}
			}
			else
			{
				redirect('admin/sppd/detail/'.$id_sppd);
			}

			if ($this->model_sppd->aksi_upload($id_sppd,$upload)) 
			{
				$this->session->set_flashdata('notif', "Berhasil mengunggah.");
				$this->session->set_flashdata('alert', "success");
				
				redirect('admin/sppd/detail/'.$id_sppd);
			}
			else
			{
				$this->session->set_flashdata('notif', "Terjadi kesalahan pada sistem.");
				$this->session->set_flashdata('alert', "error");
				
				redirect('admin/sppd/detail/'.$id_sppd);
			}
		}
		else
		{
			redirect();
		}
	}

	public function setuju($id_sppd,$status)
	{
		if ($this->model_sppd->setuju($id_sppd,$status))
		{
			$this->session->set_flashdata('notif', "Berhasil mengkonfirmasi SPPD.");
			$this->session->set_flashdata('alert', "success");
			redirect('admin/sppd/konfirmasi/cari');
		}
		else
		{
			$this->session->set_flashdata('notif', "Gagal. Terjadi kesalahan pada sistem.");
			$this->session->set_flashdata('alert', "error");
			redirect('admin/sppd/konfirmasi/cari');
		}
	}

	public function photo_copy()
	{
		if (!file_exists('./images/sppd/'))
		{
    		mkdir('./images/sppd/', 0777, true);
		}

		$config['upload_path'] = 'images/sppd/';
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
			$config['source_image'] = 'images/sppd/'.$file;
			$config['new_image'] = 'images/sppd/'.$date.'.jpg';
			$config['maintain_ratio'] = TRUE;
			$config['quality'] = "100%";
			$config['width'] = 380;
			$config['height'] = 600;
			
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();

			unlink($config['source_image']);

			return $config['new_image'];
		}
	}

	public function cetak($id_sppd)
	{
		date_default_timezone_set("Asia/Jakarta"); 

		$romawi = array(
			array("nomor" => "01", "romawi" => 'I'),
			array("nomor" => "02", "romawi" => 'II'),
			array("nomor" => "03", "romawi" => 'III'),
			array("nomor" => "04", "romawi" => 'IV'),
			array("nomor" => "05", "romawi" => 'V'),
			array("nomor" => "06", "romawi" => 'VI'),
			array("nomor" => "07", "romawi" => 'VII'),
			array("nomor" => "08", "romawi" => 'VIII'),
			array("nomor" => "09", "romawi" => 'IX'),
			array("nomor" => "10", "romawi" => 'X'),
			array("nomor" => "11", "romawi" => 'XI'),
			array("nomor" => "12", "romawi" => 'XII'),
			);

		$bln = date('m');
		$data['bln_romawi'] = "";

		foreach ($romawi as $r)
		{
			if ($r['nomor'] == $bln)
			{
				$data['bln_romawi'] = $r['romawi'];
			}
		}

		$data['spd'] = $this->model_sppd->detail($id_sppd);
		$data['direktur'] = $this->model_sppd->get_direktur();
		
		$html = $this->load->view('pdf/cetak_sppd',$data,true);
		// Get output html
		// Load library
		$this->load->library('dompdf_gen');
		
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("SPPD.pdf");

		//redirect('admin/pegawai/detail/'.$id_pgw);
	}

	public function email($email,$nama_penerima,$nama,$link)
	{
    	$psn = "Assalamu'alaikum Wr. Wb,<br/>
    			<br/>
    			Hai, ".strtoupper($nama_penerima)."<br/>
    			Permintaan persetujuan SPPD :<br/>
    			Nama    : ".strtoupper($nama)."<br/>
    			Jabatan : ".strtoupper($this->session->userdata('jabatan'))."<br/>
    			Silahkan berikan konfirmasi segera.<br/>
    			<br/>
    			Berikut ini link konfirmasi SPPD dan silahkan klik link ini : <br/>
    			<a href='http://dti.ozan-soft.com/admin/sppd/detail/".$link."' target='_blank'>LINK</a> <br/>
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
    	$this->email->subject("[NO REPLY] Permintaan SPPD");
    	$this->email->message($psn);

    	$this->email->set_newline("\r\n"); // require this, otherwise sending via gmail times out

    	$this->email->send();
	}

	public function download($id_sppd)
	{
		$data['download'] = $this->model_sppd->download($id_sppd);
		force_download("pc_bukti_sppd.jpg", file_get_contents($data['download']->lampiran));
	}

	public function cetakRekap()
	{
		$data['sppd'] = $this->model_sppd->rekap();
		$data['direktur'] = $this->model_sppd->get_direktur();
		
		$html = $this->load->view('pdf/cetak_pengajuansppd',$data,true);
		// Get output html
		// Load library
		$this->load->library('dompdf_gen');
		
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("Rekap_SPPD.pdf");

		//redirect('admin/pegawai/detail/'.$id_pgw);
	}
}