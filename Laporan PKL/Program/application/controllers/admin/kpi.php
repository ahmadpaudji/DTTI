<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kpi extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/model_kpi');
	}

	public function index()
	{
		$aktif['nav'] = "kpi";
		$aktif['notif'] = $this->model_kpi->notif();
		$data['kpi'] = $this->model_kpi->get_kpi_divisi();

		$this->load->view('admin/view_head');
		$this->load->view('admin/view_navigation',$aktif);
		$this->load->view('admin/view_left');
		$this->load->view('admin/kpi/view_kpi',$data);
	}

	public function pegawai($div_jbtn)
	{
		$aktif['nav'] = "kpi";
		$aktif['notif'] = $this->model_kpi->notif();
		$data['kpi'] = $this->model_kpi->get_kpi_pegawai($div_jbtn);

		$this->load->view('admin/view_head');
		$this->load->view('admin/view_navigation',$aktif);
		$this->load->view('admin/view_left');
		$this->load->view('admin/kpi/view_kpi_pegawai',$data);
	}

	public function chart($div_jbtn = null, $id_pgw = null)
	{
		$aktif['nav'] = "kpi";
		$aktif['notif'] = $this->model_kpi->notif();
		$chart_pgw = false;

		if ($id_pgw != null)
		{
			$data['kpi'] = $this->model_kpi->chart($id_pgw);
			$data['id_pgw'] = $id_pgw;
			$chart_pgw = true;
		}
		else if ($div_jbtn != '')
		{
			$data['kpi'] = $this->model_kpi->chart_divisi($div_jbtn);
		}
		else
		{
			redirect('kpi');
		}

		$data['chart_pgw'] = $chart_pgw;
		$this->load->view('admin/view_head');
		$this->load->view('admin/view_navigation',$aktif);
		$this->load->view('admin/view_left');
		$this->load->view('admin/kpi/view_kpi_chart',$data);
	}

	public function generate()
	{
		for ($i=21; $i <= 27 ; $i++)
		{ 
			$tgl[] = $i;
		}

		$cek = $this->model_kpi->cek_tgl_kpi();		
		$cek_upload = $this->model_kpi->cek_tgl_upload();

		if (in_array(date("d"),$tgl))
		{
			if ($cek_upload)
			{
				$this->model_kpi->presensi();
			
				if (!$cek->pelatihan)
				{
					$this->model_kpi->kpi_pelatihan();
				}

				if(!$cek->muhasabah)
				{
					$this->model_kpi->kpi_muhasabah();
				}

				if (!$cek->presensi)
				{
					$this->model_kpi->kpi_presensi();
				}

				if ($cek->presensi && $cek->pelatihan && $cek->muhasabah)
				{
					$this->session->set_flashdata('notif', "KPI sudah ada.");
					$this->session->set_flashdata('alert', "error");
				}
				else
				{
					$this->session->set_flashdata('notif', "Berhasil Mengkalkulasi KPI. Silahkan tambahkan reward pegawai teladan.");
					$this->session->set_flashdata('alert', "success");
				}

				redirect('admin/kpi');
			}
			else
			{
				$this->session->set_flashdata('notif', "Silahkan upload presensi dahulu.");
				$this->session->set_flashdata('alert', "error");
		
				redirect('admin/kpi');	
			}
		}
		else
		{	
			redirect('admin/kpi');
		}
	}

	public function cetak($divisi = null, $id_pgw = null)
	{
		if ($divisi == null && $id_pgw == null)
		{
			$data['kpi'] = $this->model_kpi->get_kpi_divisi();
			$data['direktur'] = $this->model_kpi->get_direktur();
			
			$html = $this->load->view('pdf/cetak_kpiperusahaan',$data,true);
			// Get output html
			// Load library
			$this->load->library('dompdf_gen');
			
			// Convert to PDF
			$this->dompdf->load_html($html);
			$this->dompdf->render();
			$this->dompdf->stream("Rekap_KPI_Perusahaan.pdf");

			//redirect('admin/pegawai/detail/'.$id_pgw);
		}
		else if ($id_pgw == null)
		{
			$data['kpi'] = $this->model_kpi->chart_divisi($divisi);
			$data['direktur'] = $this->model_kpi->get_direktur();
			
			$html = $this->load->view('pdf/cetak_kpidivisi',$data,true);
			// Get output html
			// Load library
			$this->load->library('dompdf_gen');
			
			// Convert to PDF
			$this->dompdf->load_html($html);
			$this->dompdf->render();
			$this->dompdf->stream("Rekap_KPI_Divisi.pdf");

			//redirect('admin/pegawai/detail/'.$id_pgw);
		}
		else
		{
			$data['kpi'] = $this->model_kpi->chart($id_pgw);
			$data['direktur'] = $this->model_kpi->get_direktur();
			
			$html = $this->load->view('pdf/cetak_kpipersonal',$data,true);
			// Get output html
			// Load library
			$this->load->library('dompdf_gen');
			
			// Convert to PDF
			$this->dompdf->load_html($html);
			$this->dompdf->render();
			$this->dompdf->stream("Rekap_KPI_Pegawai.pdf");

			//redirect('admin/pegawai/detail/'.$id_pgw);
		}
	}
}