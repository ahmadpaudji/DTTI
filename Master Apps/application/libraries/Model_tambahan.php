<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_tambahan extends CI_Model 
{
    function pegawai()
    {
        $this->db->select('id_pgw,nik_pgw,nma_lkp_pgw');
        $this->db->from('tb_pegawai');
        $result = $this->db->get()->result();

        return $result;
    }

    function notif()
    {
    	$this->db->join('tb_pegawai', 'tb_pegawai.id_pgw = tb_notif.id_pgw');
    	return $this->db->get_where('tb_notif',array('jenis_notif' => "peringatan", 'status_notif' => 'n'))->result();
    }
}