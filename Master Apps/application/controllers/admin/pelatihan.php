<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pelatihan extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("admin/model_pelatihan");
	}

	public function index($cari = null)
	{
		$data['pelatihan'] = $this->model_pelatihan->index();
		$aktif['nav'] = "pengajuan";
		$aktif['notif'] = $this->model_pelatihan->notif();
		if ($cari == "cari")
		{
			$data['presensi'] = $this->model_pelatihan->index();
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

	public function tambah()
	{
		$data['pegawai'] = $this->model_pelatihan->pegawai();
		$aktif['nav'] = "pengajuan";
		$aktif['notif'] = $this->model_pelatihan->notif();

		$this->load->view('admin/view_head');
		$this->load->view('admin/view_navigation',$aktif);
		$this->load->view('admin/view_left');
		$this->load->view('admin/pelatihan/view_tambah_pelatihan_pegawai',$data);
	}

	public function aksi_tambah()
	{
		$this->form_validation->set_rules($this->model_pelatihan->pelatihan_rules);

		if($this->form_validation->run() == TRUE)
		{
			if ($this->model_pelatihan->aksi_tambah()) 
			{
				redirect('admin/pelatihan?sukses=ya');
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

	public function detail($id_lth)
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

	public function ubah($id_lth)
	{
		$data['pelatihan'] = $this->model_pelatihan->ubah($id_lth);
		$data['pegawai'] = $this->model_pelatihan->pegawai();
		$aktif['nav'] = "pengajuan";
		$aktif['notif'] = $this->model_pelatihan->notif();

		$this->load->view('admin/view_head');
		$this->load->view('admin/view_navigation',$aktif);
		$this->load->view('admin/view_left');
		$this->load->view('admin/pelatihan/view_ubah_pelatihan_pegawai',$data);
	}

	public function aksi_ubah($id_lth)
	{
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

	public function setuju($id_lth,$status)
	{
		if ($this->model_pelatihan->setuju($id_lth,$status))
		{
			redirect('admin/pelatihan');
		}
		else
		{
			return false;
		}
	}

	public function cetak($id_lth)
	{
		$data['pelatihan'] = $this->model_pelatihan->detail($id_lth);
		$this->load->view('admin/pelatihan/view_cetak_pelatihan_pegawai',$data);
		// Get output html
		$html = $this->output->get_output();
		
		// Load library
		$this->load->library('dompdf_gen');
		
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("Pelatihan.pdf");
	}
}