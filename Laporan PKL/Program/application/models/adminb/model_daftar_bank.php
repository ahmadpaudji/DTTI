<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_daftar_bank extends Model_tambahan
{
    public $tambah_daftarbank_rules = array(
        'nama' => array(
            'field' => 'nama',
            'rules' => 'trim|required|is_unique[tb_bank.nma_bank]|xss_clean',
            ),
        'singkatan' => array(
            'field' => 'singkatan',
            'rules' => 'trim|required|is_unique[tb_bank.sktn_bank]|xss_clean',
            )
        );

    public $daftarbank_rules = array(
        'nama' => array(
            'field' => 'nama',
            'rules' => 'trim|required|callback__nama|xss_clean',
            ),
        'singkatan' => array(
            'field' => 'singkatan',
            'rules' => 'trim|required|callback__singkatan|xss_clean',
            )
        );

    public function _singkatan()
    {
        $result = $this->db->get_where('tb_bank','sktn_bank',$this->input->post('singkatan'));

        if (count($result) >= 1)
        {
            $this->form_validation->set_message('_singkatan', '%s sudah digunakan');
            return FALSE;
        }

        return true;
    }

    public function _nama()
    {
        $result = $this->db->get_where('tb_bank','nma_bank',$this->input->post('nama'));

        if (count($result) >= 1)
        {
            $this->form_validation->set_message('_nama', '%s sudah digunakan');
            return FALSE;
        }

        return true;
    }

    function index()
    {
        return $this->db->get('tb_bank')->result();
    }

    function aksi_tambah()
    {
        $bank = array (
            'sktn_bank' => $this->input->post('singkatan'),
            'nma_bank' => $this->input->post('nama')
            );

        if ($this->db->insert('tb_bank',$bank)) 
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function ubah($id_bank)
    {
        return $this->db->get_where('tb_bank',array('id_bank' => $id_bank))->row();
    }

    function aksi_ubah($id_bank)
    {
        $bank = array (
            'sktn_bank' => $this->input->post('singkatan'),
            'nma_bank' => $this->input->post('nama')
            );

        if ($this->db->where('id_bank',$id_bank)->update('tb_bank',$bank)) 
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}