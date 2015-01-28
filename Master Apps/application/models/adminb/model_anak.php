<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_anak extends Model_tambahan
{
    public $anak_rules = array(
        'nama' => array(
            'field' => 'nama',
            'rules' => 'trim|required|xss_clean',
            ),
        'tempat' => array(
            'field' => 'tempat',
            'rules' => 'trim|required|xss_clean',
            )
        );

    function index()
    {
        $this->db->select('');
        $this->db->from('tb_anak');
        $this->db->join('tb_pegawai','tb_pegawai.id_pgw = tb_anak.id_pgw');
        $result = $this->db->get()->result();

        return $result;
    }

    function aksi_tambah()
    {
        $tgl_exp = explode('/', $this->input->post('tanggal'));
        $tanggal = $tgl_exp[2].'-'.$tgl_exp[0].'-'.$tgl_exp[1];

        $anak = array (
            'id_pgw' => $this->input->post('pegawai'),
            'no_urut_anak' => $this->input->post('no_urut'),
            'nma_anak' => $this->input->post('nama'),
            'jk_anak' => $this->input->post('jk'),
            'tmp_lhr_anak' => $this->input->post('tempat'),
            'tgl_lhr_anak' => $tanggal
            );

        if ($this->db->insert('tb_anak',$anak)) 
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function ubah($id_anak)
    {
        return $this->db->get_where('tb_anak',array('id_anak' => $id_anak))->row();
    }

    function aksi_ubah($id_anak)
    {
        $tgl_exp = explode('/', $this->input->post('tanggal'));
        $tanggal = $tgl_exp[2].'-'.$tgl_exp[0].'-'.$tgl_exp[1];

        $anak = array (
            'id_pgw' => $this->input->post('pegawai'),
            'no_urut_anak' => $this->input->post('no_urut'),
            'nma_anak' => $this->input->post('nama'),
            'jk_anak' => $this->input->post('jk'),
            'tmp_lhr_anak' => $this->input->post('tempat'),
            'tgl_lhr_anak' => $tanggal
            );

        if ($this->db->where('id_anak',$id_anak)->update('tb_anak',$anak)) 
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}