<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller
{
	public function index()
	{	
		$data = array(
			'status_notif' => 'y'
			);
		$this->db->where('id_notif', mysql_real_escape_string($this->input->post('id')));
		$this->db->update('tb_notif', $data);
	}

}

/* End of file api.php */
/* Location: ./application/controllers/api.php */