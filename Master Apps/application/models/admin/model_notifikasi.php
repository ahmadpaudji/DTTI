<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_notifikasi extends Model_tambahan 
{
    function index()
    {
        $this->db->join('tb_pegawai', 'tb_pegawai.id_pgw = tb_notif.id_pgw');
        return $this->db->get_where('tb_notif',array('jenis_notif' => "peringatan", 'status_notif' => 'n'))->result();
    }
}