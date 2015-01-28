<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller
{
	public function index()
	{	
		$this->db->select();
        $this->db->from("tb_jabatan");
        $this->db->where("nma_jbtn like","sv%");
        $this->db->or_where("nma_jbtn like","staff%");
        $jbt_d = $this->db->get()->result();

        foreach ($jbt_d as $jbt_df)
        {
            $jabatan_sv_st[] = $jbt_df->nma_jbtn;
        }

		if (in_array($this->session->userdata('jabatan'), $jabatan_sv_st))
		{
			$data = array(
				'status_notif' => 't'
				);
		}
		else
		{
			$data = array(
			'status_notif' => 'y'
			);
		}
		$this->db->where('id_notif', mysql_real_escape_string($this->input->post('id')));
		$this->db->update('tb_notif', $data);
	}

}

/* End of file api.php */
/* Location: ./application/controllers/api.php */