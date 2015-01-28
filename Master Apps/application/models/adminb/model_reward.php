<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_reward extends Model_tambahan 
{
    public $reward_rules = array(
        'keterangan' => array(
            'field' => 'keterangan',
            'rules' => 'trim|required|xss_clean',
            )
        );

    function index()
    {
        $this->db->select('');
        $this->db->from('tb_reward');
        $this->db->join('tb_pegawai','tb_pegawai.id_pgw = tb_reward.id_pgw');
        $result = $this->db->get()->result();

        return $result;
    }

    function aksi_tambah()
    {
        $reward = array (
            'id_pgw' => $this->input->post('pegawai'),
            'jns_reward' => $this->input->post('jenis'),
            'ket_reward' => $this->input->post('keterangan')
            );

        if ($this->db->insert('tb_reward',$reward)) 
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function ubah($id_reward)
    {
        return $this->db->get_where('tb_reward',array('id_reward' => $id_reward))->row();
    }

    function aksi_ubah($id_reward)
    {
        $reward = array (
            'id_pgw' => $this->input->post('pegawai'),
            'jns_reward' => $this->input->post('jenis'),
            'ket_reward' => $this->input->post('keterangan')
            );

        if ($this->db->where('id_reward',$id_reward)->update('tb_reward',$reward)) 
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}