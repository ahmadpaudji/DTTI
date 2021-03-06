<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Absen extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/model_absen');
	}

	public function index($cari = null)
	{
		if ($this->session->userdata['hak'] == "admin")
		{
			$halaman = "admin";
			$aktif['nav'] = "absen";
			$aktif['notif'] = $this->model_absen->notif();
			$data['last_upload'] = $this->model_absen->last_upload();

			$this->load->view('admin/view_head');
			$this->load->view('admin/view_navigation',$aktif);
			$this->load->view('admin/view_left');
			$this->load->view('admin/absen/view_absen',$data);
		}
		else
		{
			$halaman = "user";
			$aktif['nav'] = "absen";
			$aktif['notif'] = $this->model_absen->notif();
			if ($cari == "cari")
			{
				$data['presensi'] = $this->model_absen->index($halaman);
				$data['tampil'] = "true";
			}
			else
			{
				$data['tampil'] = "false";
			}

			$this->load->view('admin/view_head');
			$this->load->view('admin/view_navigation',$aktif);
			$this->load->view('admin/view_left');
			$this->load->view('admin/absen/view_absen_pegawai',$data);	
		}
	}

	public function presensi($cari = null)
	{
		$aktif['nav'] = "absen";
		$aktif['notif'] = $this->model_absen->notif();
		$data['pegawai'] = $this->model_absen->pegawai();

		if ($cari == "cari")
		{
			$data['presensi'] = $this->model_absen->presensi();
			$data['tampil'] = "true";
		}
		else
		{
			$data['tampil'] = "false";
		}

		$this->load->view('admin/view_head');
		$this->load->view('admin/view_navigation',$aktif);
		$this->load->view('admin/view_left');
		$this->load->view('admin/absen/view_presensi',$data);
	}

	public function ubah($id_prs = null)
	{
		if ($id_prs != null)
		{
			$aktif['nav'] = "absen";
			$aktif['notif'] = $this->model_absen->notif();
			$data['absen'] = $this->model_absen->ubah($id_prs);
			
			$this->load->view('admin/view_head');
			$this->load->view('admin/view_navigation',$aktif);
			$this->load->view('admin/view_left');
			$this->load->view('admin/absen/view_ubah_absen',$data);
		}
		else
		{
			redirect();
		}
	}

	public function aksi_ubah($id_prs = null)
	{
		if ($id_prs != null)
		{
			if ($this->model_absen->aksi_ubah($id_prs)) 
			{
				$this->session->set_flashdata('notifikasi', "Berhasil diubah !");
				$this->session->set_flashdata('class', "alert alert-success");
				redirect('admin/presensi');
			}
			else
			{
				$this->session->set_flashdata('notifikasi', "Terjadi Kesalahan Sistem !");
				$this->session->set_flashdata('class', "alert alert-error");
				redirect('admin/presensi');
			}
		}
		else
		{
			redirect();
		}
	}

	public function upload()
	{
		if (!file_exists('./files')) 
		{
			mkdir('./files', 0777, true);
		}

		$config['upload_path'] = 'files/';
		$config['allowed_types'] = 'xls';
		//$this->db->get('Table', limit, offset);

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$data = array('error' => $this->upload->display_errors());
			var_dump($data);
		}
		else
		{
            $data = array('error' => false);
			$upload_data = $this->upload->data();

            $this->load->library('excel_reader');
			$this->excel_reader->setOutputEncoding('CP1251');

			$file =  $upload_data['full_path'];
			$this->excel_reader->read($file);
			error_reporting(E_ALL ^ E_NOTICE);

			// Sheet 1
			$data = $this->excel_reader->sheets[0] ;
            $dataexcel = Array();

			for ($i = 2; $i <= $data['numRows']; $i++) 
			{
                if($data['cells'][$i][1] == '') break;
                $dataexcel[$i-1]['no_akun_pgw'] = $data['cells'][$i][1];
                $tanggal = explode('/', $data['cells'][$i][12]);
                //excel asli
                $dataexcel[$i-1]['tgl_prs'] = $tanggal[2].'-'.$tanggal[0].'-'.$tanggal[1];
                //excel yang di edit
                //$dataexcel[$i-1]['tgl_prs'] = $tanggal[2].'-'.$tanggal[1].'-'.($tanggal[0]-1);
                
                $dataexcel[$i-1]['jm_msk_prs'] = $data['cells'][$i][4];
                $dataexcel[$i-1]['jm_klr_prs'] = $data['cells'][$i][5];
			}
			
            delete_files($upload_data['file_path']);
            if ($this->model_absen->upload($dataexcel))
            {
            	$this->session->set_flashdata('notif', "Berhasil Mengunggah.");
            	$this->session->set_flashdata('alert', "success");
            	redirect(base_url().'admin/absen');
            }
            else
            {
            	$this->session->set_flashdata('notif', "Terjadi kesalahan sistem.");
            	$this->session->set_flashdata('alert', "error");
            	redirect(base_url().'admin/absen');
            }   
		} 
	}

	public function upload_baru()
	{
		if (!file_exists('./files')) 
		{
			mkdir('./files', 0777, true);
		}

		$config['upload_path'] = 'files/';
		$config['allowed_types'] = 'xls';
		//$this->db->get('Table', limit, offset);

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$data = array('error' => $this->upload->display_errors());
			var_dump($data);
		}
		else
		{
			$upload_data = $this->upload->data();

			// Load the spreadsheet reader library
			$this->load->library('excel_reader');

			// Read the spreadsheet via a relative path to the document
			// for example $this->excel_reader->read('./uploads/file.xls');
			$this->excel_reader->read($upload_data['full_path']);

			// Get the contents of the first worksheet
			$worksheet = $this->excel_reader->worksheets[0];
			foreach ($worksheet as $w)
			{
				echo date('Y-m-d',strtotime('1899-12-31+'.($w[11]-1).' days'));
			}
		}
	}

	public function rekap($cari = null)
	{
		$aktif['nav'] = "absen";
		$aktif['notif'] = $this->model_absen->notif();
		$data['pegawai'] = $this->model_absen->pegawai();

		if ($cari == "cari")
		{
			if ($this->input->post('pegawai') != '')
			{
				$data['pegawai'] = $this->input->post('pegawai');
			}
			else
			{
				$data['pegawai'] = '';	
			}

			if ($this->input->post('tanggal_awal') != '')
			{
				$data['tgl_awl'] = $this->input->post('tanggal_awal');
			}
			else
			{
				$data['tgl_awl'] = '';	
			}

			if ($this->input->post('tanggal_akhir') != '')
			{
				$data['tgl_akh'] = $this->input->post('tanggal_akhir');
			}
			else
			{
				$data['tgl_akh'] = '';	
			}
			$data['presensi'] = $this->model_absen->rekap();
			$data['tampil'] = "true";
		}
		else
		{
			$data['tampil'] = "false";
		}

		$this->load->view('admin/view_head');
		$this->load->view('admin/view_navigation',$aktif);
		$this->load->view('admin/view_left');
		$this->load->view('admin/absen/view_rekap_absen_pegawai',$data);
	}

	public function cuti($cari = null)
	{
		$aktif['nav'] = "absen";
		$aktif['notif'] = $this->model_absen->notif();

		if ($cari == "cari")
		{
			$data['cuti'] = $this->model_absen->cuti($cari);
			$data['tampil'] = "true";
		}
		else
		{
			$data['tampil'] = "false";
		}

		$this->load->view('admin/view_head');
		$this->load->view('admin/view_navigation',$aktif);
		$this->load->view('admin/view_left');
		$this->load->view('admin/absen/view_cuti_absen',$data);
	}

	public function cetak()
	{
		if ($this->session->flashdata("tgl_awl") != '')
        {
			$data['tgl_awl'] = $this->session->flashdata('tgl_awl');
		}
		else
		{
			$data['tgl_awl'] = '';
		}

		if ($this->session->flashdata("tgl_akh") != '')
        {
			$data['tgl_akh'] = $this->session->flashdata('tgl_akh');
		}
		else
		{
			$data['tgl_akh'] = '';
		}

		$data['presensi'] = $this->model_absen->cetak();
		$data['direktur'] = $this->model_absen->get_direktur();
		
		$html = $this->load->view('pdf/cetak_rekapkehadiran',$data,true);
		// Get output html
		// Load library
		$this->load->library('dompdf_gen');
		
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("Rekap_Presensi.pdf");

		//redirect('admin/pegawai/detail/'.$id_pgw);
	}
}