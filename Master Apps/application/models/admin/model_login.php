<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_login extends CI_Model 
{
	public function login($data)
	{
		$sql = "select * from tb_pegawai where uname_pgw = ? and pass_pgw = ? and stat_akt_pgw = ?";
		$value = array(
			$data['username'],
			md5($data['password']),
			'Y'
			);
		$query = $this->db->query($sql,$value);

		if ($query->num_rows() > 0) 
		{
			$data = $query->row();
			$this->session->set_userdata('id_pgw',$data->id_pgw);
			$this->session->set_userdata('nik',$data->nik_pgw);
			$this->session->set_userdata('foto',$data->photo_pgw);
			$this->session->set_userdata('nama',$data->nma_lkp_pgw);
			$this->session->set_userdata('level',$data->lev_usr_pgw);
			$jbt = $this->db->get_where("tb_jabatan",array('id_jbtn' => $data->id_jbtn))->row();
			$this->session->set_userdata('divisi',$jbt->div_jbtn);
			$this->session->set_userdata('jabatan',$jbt->nma_jbtn);
			if ($this->session->userdata['level'] == "admin")
			{
				$this->session->set_userdata('hak',"admin");
			}
			else if ($this->session->userdata['level'] == "super user")
			{
				$this->session->set_userdata('hak',"super user");
			}
			else if ($this->session->userdata['level'] == "user")
			{
				$this->session->set_userdata('hak',"user");
			}
			
			$this->session->set_userdata('loggedin',TRUE);
			return TRUE;
		}
		else
		{
			return false;
		}
	}

	public function loggedin()
	{
		return (bool) $this->session->userdata('loggedin');
	}

}