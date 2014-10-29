<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_kendaraan extends Model_tambahan
{
    public $tambah_kendaraan_rules = array(
        'merk' => array(
            'field' => 'merk',
            'rules' => 'trim|required|xss_clean',
            ),
        'nopol' => array(
            'field' => 'no_pol',
            'rules' => 'trim|required|is_unique[tb_kendaraan_motor.nopol_kdr_mtr]|xss_clean',
            )
        );

    public $kendaraan_rules = array(
        'merk' => array(
            'field' => 'merk',
            'rules' => 'trim|required|xss_clean',
            ),
        'nopol' => array(
            'field' => 'no_pol',
            'rules' => 'trim|required|callback__nopol|xss_clean',
            )
        );

    public function _nopol()
    {
        $result = $this->db->get_where('tb_kendaraan_motor','nopol_kdr_mtr',$this->input->post('no_pol'));

        if (count($result) >= 1)
        {
            $this->form_validation->set_message('_nopol', 'Nomor polisi sudah digunakan');
            return FALSE;
        }

        return true;
    }

    function index()
    {
        $this->db->select('');
        $this->db->from('tb_kendaraan_motor');
        $this->db->join('tb_pegawai','tb_pegawai.id_pgw = tb_kendaraan_motor.id_pgw');
        $result = $this->db->get()->result();

        return $result;
    }

    function aksi_tambah()
    {
        $kendaraan = array (
            'id_pgw' => $this->input->post('pegawai'),
            'merk_kdr_mtr' => $this->input->post('merk'),
            'nopol_kdr_mtr' => $this->input->post('no_pol'),
            'stat_kdr_mtr' => $this->input->post('status')
            );

        if ($this->db->insert('tb_kendaraan_motor',$kendaraan)) 
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function ubah($id_kdr_mtr)
    {
        return $this->db->get_where('tb_kendaraan_motor',array('id_kdr_mtr' => $id_kdr_mtr))->row();
    }

    function aksi_ubah($id_kdr_mtr)
    {
        $kendaraan = array (
            'id_pgw' => $this->input->post('pegawai'),
            'merk_kdr_mtr' => $this->input->post('merk'),
            'nopol_kdr_mtr' => $this->input->post('no_pol'),
            'stat_kdr_mtr' => $this->input->post('status')
            );

        if ($this->db->where('id_kdr_mtr',$id_kdr_mtr)->update('tb_kendaraan_motor',$kendaraan)) 
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}