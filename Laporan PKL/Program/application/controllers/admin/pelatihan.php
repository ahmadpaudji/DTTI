<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pelatihan extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("admin/model_pelatihan");
	}

	public function index($cari = null, $notif = null)
	{
		$aktif['nav'] = "pengajuan";
		$aktif['notif'] = $this->model_pelatihan->notif();
		if ($cari == "cari")
		{
			$data['pelatihan'] = $this->model_pelatihan->index($notif);
			$data['tampil'] = "true";
		}
		else
		{
			$data['tampil'] = "false";
		}

		$this->load->view('admin/view_head');
		$this->load->view('admin/view_navigation',$aktif);
		$this->load->view('admin/view_left');
		$this->load->view('admin/pelatihan/view_pelatihan_pegawai',$data);		
	}

	public function rekap()
	{
		if ($this->session->userdata('hak') != "user")
		{
			$aktif['nav'] = "pengajuan";
			$aktif['notif'] = $this->model_pelatihan->notif();
			$data['pelatihan'] = $this->model_pelatihan->rekap();

			$this->load->view('admin/view_head');
			$this->load->view('admin/view_navigation',$aktif);
			$this->load->view('admin/view_left');
			$this->load->view('admin/pelatihan/view_rekap_pelatihan',$data);
		}
		else
		{
			redirect();
		}
	}

	public function konfirmasi($cari = null, $notif = null)
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

			if ($this->session->userdata("hak") == "admin")
			{
				$aktif['nav'] = "pengajuan";
			}
			else
			{
				$aktif['nav'] = "konfirmasi";
			}
			
			$aktif['notif'] = $this->model_pelatihan->notif();

			if ($cari == "cari")
			{
				$data['pelatihan'] = $this->model_pelatihan->konfirmasi($notif);
				$data['tampil'] = "true";
			}
			else
			{
				$data['tampil'] = "false";
			}

			$this->load->view('admin/view_head');
			$this->load->view('admin/view_navigation',$aktif);
			$this->load->view('admin/view_left');
			$this->load->view('admin/pelatihan/view_pelatihan_konfirmasi',$data);	
		}
		else
		{
			redirect();
		}
	}

	public function tambah()
	{
		$jabatan = "sendiri";
		$data['pegawai'] = $this->model_pelatihan->pegawai($jabatan);
		$aktif['nav'] = "pengajuan";
		$aktif['notif'] = $this->model_pelatihan->notif();

		$this->load->view('admin/view_head');
		$this->load->view('admin/view_navigation',$aktif);
		$this->load->view('admin/view_left');
		$this->load->view('admin/pelatihan/view_tambah_pelatihan_pegawai',$data);
	}

	public function aksi_tambah()
	{
		date_default_timezone_set("Asia/Jakarta"); 
		$this->form_validation->set_rules($this->model_pelatihan->pelatihan_rules);

		$sekarang = date("Y-m-d");

		$tgl_awal = explode('/',$this->input->post('tanggal_awal'));
        $tgl_akhir = explode('/',$this->input->post('tanggal_akhir'));
        $tanggal_awal = $tgl_awal[2].'-'.$tgl_awal[0].'-'.$tgl_awal[1];
        $tanggal_akhir = $tgl_akhir[2].'-'.$tgl_akhir[0].'-'.$tgl_akhir[1];

		if ($tanggal_awal <= $sekarang || $tanggal_akhir <= $sekarang)
		{
			$this->session->set_flashdata('errors', "Maaf pengisian pelatihan harus dilakukan H-1.");

			redirect('admin/pelatihan/tambah');
		}

		if($this->form_validation->run() == TRUE)
		{
			$tambah = $this->model_pelatihan->aksi_tambah();
			
			if ($tambah != false) 
			{
				$email = $this->model_pelatihan->get_email();
				
				$this->email($email->email_pgw,$email->nma_lkp_pgw,$this->session->userdata("nama"),$tambah);

				redirect('admin/pelatihan/cari?sukses=ya');
			}
			else
			{
				redirect('admin/pelatihan?sukses=tidak');
			}
		}
		else
		{
			$this->session->set_flashdata('errors', validation_errors());

			redirect('admin/pelatihan/tambah');
		}
	}

	public function detail($id_lth = null)
	{
		if ($id_lth != null)
		{
			if ($this->model_pelatihan->detail($id_lth))
			{
				$data['pelatihan'] = $this->model_pelatihan->detail($id_lth);
				$data['pegawai'] = $this->model_pelatihan->pegawai();
				$aktif['nav'] = "pengajuan";
				$aktif['notif'] = $this->model_pelatihan->notif();

				$this->load->view('admin/view_head');
				$this->load->view('admin/view_navigation',$aktif);
				$this->load->view('admin/view_left');
				$this->load->view('admin/pelatihan/view_detail_pelatihan_pegawai',$data);
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

	public function ubah($id_lth = null)
	{	
		if ($id_lth != null)
		{
			$jabatan = "sendiri";
			$data['pegawai'] = $this->model_pelatihan->pegawai($jabatan);
			$data['pelatihan'] = $this->model_pelatihan->ubah($id_lth);
			$aktif['nav'] = "pengajuan";
			$aktif['notif'] = $this->model_pelatihan->notif();

			$this->load->view('admin/view_head');
			$this->load->view('admin/view_navigation',$aktif);
			$this->load->view('admin/view_left');
			$this->load->view('admin/pelatihan/view_ubah_pelatihan_pegawai',$data);
		}
		else
		{
			redirect();
		}
	}

	public function aksi_ubah($id_lth = null)
	{
		if ($id_lth != null)
		{
			date_default_timezone_set("Asia/Jakarta");
			
			$sekarang = date("Y-m-d");

			$tgl_awal = explode('/',$this->input->post('tanggal_awal'));
	        $tgl_akhir = explode('/',$this->input->post('tanggal_akhir'));
	        $tanggal_awal = $tgl_awal[2].'-'.$tgl_awal[0].'-'.$tgl_awal[1];
	        $tanggal_akhir = $tgl_akhir[2].'-'.$tgl_akhir[0].'-'.$tgl_akhir[1];

			if ($tanggal_awal <= $sekarang || $tanggal_akhir <= $sekarang)
			{
				$this->session->set_flashdata('errors', "Maaf pengisian pelatihan harus dilakukan H-1.");

				redirect('admin/pelatihan/ubah/'.$id_lth);
			}

			$this->form_validation->set_rules($this->model_pelatihan->pelatihan_rules);

			if($this->form_validation->run() == TRUE)
			{
				if ($this->model_pelatihan->aksi_ubah($id_lth))
				{
					redirect('admin/pelatihan?sukses_ubah=ya');
				}
				else
				{
					redirect('admin/pelatihan?sukses=tidak');
				}
			}
			else
			{
				$this->session->set_flashdata('errors', validation_errors());

				redirect('admin/pelatihan/ubah/'.$id_lth);
			}
		}
		else
		{
			redirect();
		}
	}

	public function setuju($id_lth,$status)
	{
		if ($this->model_pelatihan->setuju($id_lth,$status))
		{
			$this->session->set_flashdata('notif', "Berhasil mengkonfirmasi pelatihan.");
			$this->session->set_flashdata('alert', "success");
			redirect('admin/pelatihan/konfirmasi/cari');
		}
		else
		{
			$this->session->set_flashdata('notif', "Gagal. Terjadi kesalahan pada sistem.");
			$this->session->set_flashdata('alert', "error");
			redirect('admin/pelatihan/konfirmasi/cari');
		}
	}

	public function cetak($id_lth)
	{
		$data['pelatihan'] = $this->model_pelatihan->detail($id_lth);

		$html = $this->load->view('pdf/cetak_pelatihan',$data,true);
		// Get output html
		// Load library
		$this->load->library('dompdf_gen');
		
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("Pelatihan.pdf");

	}

	public function email($email,$nama_penerima,$nama,$link)
	{
    	$psn = "Assalamu'alaikum Wr. Wb,<br/>
    			<br/>
    			Hai, ".strtoupper($nama_penerima)."<br/>
    			Permintaan persetujuan pelatihan SDM :<br/>
    			Nama    : ".strtoupper($nama)."<br/>
    			Jabatan : ".strtoupper($this->session->userdata('jabatan'))."<br/>
    			Silahkan berikan konfirmasi segera.<br/>
    			<br/>
    			Berikut ini link konfirmasi izin presensi dan silahkan klik link ini : <br/>
    			<a href='http://dti.ozan-soft.com/admin/pelatihan/detail/".$link."' target='_blank'>LINK</a> <br/>
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
    	$this->email->subject("[NO REPLY] Permintaan Pelatihan SDM");
    	$this->email->message($psn);

    	$this->email->set_newline("\r\n"); // require this, otherwise sending via gmail times out

    	$this->email->send();
	}

	public function cetakRekap()
	{
		$data['pelatihan'] = $this->model_pelatihan->rekap();
		$data['direktur'] = $this->model_pelatihan->get_direktur();
		
		$html = $this->load->view('pdf/cetak_pengajuanpelatihan',$data,true);
		// Get output html
		// Load library
		$this->load->library('dompdf_gen');
		
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("Rekap_Pelatihan.pdf");

		//redirect('admin/pegawai/detail/'.$id_pgw);
	}
}