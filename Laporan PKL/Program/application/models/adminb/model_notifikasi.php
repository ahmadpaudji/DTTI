<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_notifikasi extends Model_tambahan 
{
    function index()
    {
        $this->db->join('tb_pegawai', 'tb_pegawai.id_pgw = tb_notif.id_pgw');
        $this->db->order_by("id_notif","desc");
        if ($this->session->userdata("hak") == "admin")
        {
        	return $this->db->get_where('tb_notif',array('jenis_notif' => "peringatan"))->result();
    	}
    	else if ($this->session->userdata("hak") == "user")
    	{
    		return $this->db->get_where('tb_notif',array('tb_notif.id_pgw' => $this->session->userdata("id_pgw"),'jenis_notif' => "peringatan"))->result();
    	}
    }
}