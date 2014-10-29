<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Muhasabah extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/model_muhasabah');
	}

	public function index($cari = null)
	{
		if ($this->session->userdata['hak'] == "admin")
		{
			$aktif['nav'] = "muhasabah";
			$aktif['notif'] = $this->model_muhasabah->notif();
			$data['pegawai'] = $this->model_muhasabah->pegawai();

			if ($cari == "cari")
			{
				$halaman = "pegawai";
				$data['muhasabah'] = $this->model_muhasabah->index($halaman);
				$data['tampil'] = "true";
			}
			else
			{
				$data['tampil'] = "false";
			}

			$this->load->view('admin/view_head');
			$this->load->view('admin/view_navigation',$aktif);
			$this->load->view('admin/view_left');
			$this->load->view('admin/muhasabah/view_muhasabah_pegawai',$data);
		}
		else if ($this->session->userdata['hak'] == "user")
		{
			$nama_bulan = array(1 => "Januari", 2 => "Februari", 3 => "Maret", 4 => "April", 5 => "Mei", 6 => "Juni", 7 => "July", 8 => "Agustus", 9 => "September", 10 => "Oktober", 11 => "November", 12 => "Desember");

			date_default_timezone_set("Asia/Jakarta"); 
			$bln = date('m');
			$now = date('d');

			$halaman = "user";
			$data['tanggal'] = $this->model_muhasabah->index($halaman);
			$data['bulan'] = date('m');
			$data['tahun'] = date('Y');
			$data['nama_bulan'] = $nama_bulan[(int)$bln];
			$data['nama_bulan_s'] = $nama_bulan[$bln-1];
			$data['date_now'] = $now;
			$aktif['nav'] = "muhasabah";
			$aktif['notif'] = $this->model_muhasabah->notif();

			$this->load->view('admin/view_head');
			$this->load->view('admin/view_navigation',$aktif);
			$this->load->view('admin/view_left');
			$this->load->view('admin/muhasabah/view_muhasabah',$data);
		}
	}

	public function lihat($cari = null)
	{
		$aktif['nav'] = "muhasabah";
		$aktif['notif'] = $this->model_muhasabah->notif();
		$data['pegawai'] = $this->model_muhasabah->pegawai();

		if ($cari == "cari")
		{
			$halaman = "pegawai";
			$data['muhasabah'] = $this->model_muhasabah->index($halaman);
			$data['tampil'] = "true";
		}
		else
		{
			$data['tampil'] = "false";
		}

		$this->load->view('admin/view_head');
		$this->load->view('admin/view_navigation',$aktif);
		$this->load->view('admin/view_left');
		$this->load->view('admin/muhasabah/view_muhasabah_pegawai',$data);
	}


	public function tambah($tgl,$bln)
	{
		$aktif['nav'] = "muhasabah";
		$aktif['notif'] = $this->model_muhasabah->notif();
		$data['tgl'] = $tgl;
		$data['bln'] = $bln;

		if ($this->model_muhasabah->cek_tgl($tgl,$bln))
		{
			redirect('admin/muhasabah');
		}
		else
		{
			$this->load->view('admin/view_head');
			$this->load->view('admin/view_navigation',$aktif);
			$this->load->view('admin/view_left');
			$this->load->view('admin/muhasabah/view_tambah',$data);
		}
		
	}

	public function aksi_tambah($tgl,$bln)
	{
		if ($this->model_muhasabah->aksi_tambah($tgl,$bln)) 
		{
			redirect('admin/muhasabah');
		}
		else
		{
			redirect('admin/muhasabah/tambah');
		}
	}

	public function rekap($cari = null)
	{
		$aktif['nav'] = "muhasabah";
		$aktif['notif'] = $this->model_muhasabah->notif();
		$data['pegawai'] = $this->model_muhasabah->pegawai();

		if ($cari == "cari")
		{
			$data['muhasabah'] = $this->model_muhasabah->rekap();
			$data['tampil'] = "true";
		}
		else
		{
			$data['tampil'] = "false";
		}
		$this->load->view('admin/view_head');
		$this->load->view('admin/view_navigation',$aktif);
		$this->load->view('admin/view_left');
		$this->load->view('admin/muhasabah/view_rekap_muhasabah_pegawai',$data);
	}

	public function persentase($cari = null)
	{
		
		$aktif['nav'] = "muhasabah";
		$aktif['notif'] = $this->model_muhasabah->notif();
		$data['pegawai'] = $this->model_muhasabah->pegawai();

		$data['persentase'] = $this->model_muhasabah->persentase($cari);

		$this->load->view('admin/view_head');
		$this->load->view('admin/view_navigation',$aktif);
		$this->load->view('admin/view_left');
		$this->load->view('admin/muhasabah/view_persentase_muhasabah_pegawai',$data);
		
	}
}