<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_usaha extends Model_tambahan
{
    function index()
    {
        $this->db->select('');
        $this->db->from('tb_usaha_aktifitas');
        $this->db->join('tb_pegawai','tb_pegawai.id_pgw = tb_usaha_aktifitas.id_pgw');
        $result = $this->db->get()->result();

        return $result;
    }

    function aksi_tambah()
    {
        $usaha = array (
            'id_pgw' => $this->input->post('pegawai'),
            'jns_ush_akt' => $this->input->post('usaha'),
            'nma_ush_akt' => $this->input->post('nama')
            );

        if ($this->db->insert('tb_usaha_aktifitas',$usaha)) 
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function ubah($id_ush_akt)
    {
        return $this->db->get_where('tb_usaha_aktifitas',array('id_ush_akt' => $id_ush_akt))->row();
    }

    function aksi_ubah($id_ush_akt)
    {
        $usaha = array (
            'id_pgw' => $this->input->post('pegawai'),
            'jns_ush_akt' => $this->input->post('usaha'),
            'nma_ush_akt' => $this->input->post('nama')
            );

        if ($this->db->where('id_ush_akt',$id_ush_akt)->update('tb_usaha_aktifitas',$usaha)) 
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}