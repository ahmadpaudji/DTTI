<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_bank extends Model_tambahan 
{
    public $tambah_bank_rules = array(
        'rekening' => array(
            'field' => 'no_rek',
            'rules' => 'trim|required|is_unique[tb_rek_bank.no_rek]|xss_clean',
            )
        );

    public $bank_rules = array(
        'rekening' => array(
            'field' => 'no_rek',
            'rules' => 'trim|required|callback__rekening|xss_clean',
            )
        );

    public function _rekening()
    {
        $result = $this->db->get_where('tb_rek_bank','no_rek',$this->input->post('no_rek'));

        if (count($result) >= 1)
        {
            $this->form_validation->set_message('_rekening', 'Rekening sudah digunakan');
            return FALSE;
        }

        return true;
    }

    //DROPDOWN
    function bank()
    {
        return $this->db->get('tb_bank')->result();
    }
    //AKHIR DROPDOWN

    function index()
    {
        $this->db->select('');
        $this->db->from('tb_rek_bank');
        $this->db->join('tb_bank','tb_bank.id_bank = tb_rek_bank.id_bank');
        $this->db->join('tb_pegawai','tb_pegawai.id_pgw = tb_rek_bank.id_pgw');
        $result = $this->db->get()->result();

        return $result;
    }

    function aksi_tambah()
    {
        $bank = array (
            'id_bank' => $this->input->post('bank'),
            'id_pgw' => $this->input->post('pegawai'),
            'no_rek' => $this->input->post('no_rek')
            );

        if ($this->db->insert('tb_rek_bank',$bank)) 
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function ubah($id_dtl_bank)
    {
        return $this->db->get_where('tb_rek_bank',array('id_dtl_bank' => $id_dtl_bank))->row();
    }

    function aksi_ubah($id_dtl_bank)
    {
        $bank = array (
            'id_bank' => $this->input->post('bank'),
            'id_pgw' => $this->input->post('pegawai'),
            'no_rek' => $this->input->post('no_rek')
            );

        if ($this->db->where('id_dtl_bank',$id_dtl_bank)->update('tb_rek_bank',$bank)) 
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}