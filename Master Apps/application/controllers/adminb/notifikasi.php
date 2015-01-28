<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notifikasi extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/model_notifikasi');
	}

	public function index()
	{
		$data['notifikasi'] = $this->model_notifikasi->index();
		$aktif['notif'] = $this->model_notifikasi->notif();
		$aktif['nav'] = "beranda";
		
		$this->load->view('admin/view_head');
		$this->load->view('admin/view_navigation',$aktif);
		$this->load->view('admin/view_left');
		$this->load->view('admin/notifikasi/view_notifikasi',$data);
	}

	public function check($id)
	{
		$data = array(
			'status_notif' => 'y'
			);
		$this->db->where('id_notif', $id);
		$this->db->update('tb_notif', $data);

		redirect("admin/notifikasi");
	}
}