<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_sim extends Model_tambahan
{
    public $tambah_sim_rules = array(
        'sim' => array(
            'field' => 'no_sim',
            'rules' => 'trim|required|is_unique[tb_sim.no_sim]|xss_clean',
            )
        );

    public $sim_rules = array(
        'sim' => array(
            'field' => 'no_sim',
            'rules' => 'trim|required|callback__nosim|xss_clean',
            )
        );

    public function _nosim()
    {
        $result = $this->db->get_where('tb_sim','no_sim',$this->input->post('no_sim'));

        if (count($result) >= 1)
        {
            $this->form_validation->set_message('_nosim', 'Nomor SIM sudah digunakan');
            return FALSE;
        }

        return true;
    }

    function index()
    {
        $this->db->select('id_sim,nma_lkp_pgw,jns_sim,no_sim,pc_sim');
        $this->db->from('tb_sim');
        $this->db->join('tb_pegawai','tb_pegawai.id_pgw = tb_sim.id_pgw');
        $result = $this->db->get()->result();

        return $result;
    }

    function aksi_tambah($upload = null)
    {
        $sim = array (
            'id_pgw' => $this->input->post('pegawai'),
            'jns_sim' => $this->input->post('jns'),
            'no_sim' => $this->input->post('no_sim'),
            'pc_sim' => $upload
            );

        if ($this->db->insert('tb_sim',$sim)) 
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function ubah($id_sim)
    {
        return $this->db->get_where('tb_sim',array('id_sim' => $id_sim))->row();
    }

    function aksi_ubah($id_sim, $upload = null)
    {
        if ($upload == null && $this->input->post('sim') != null)
        {
            $upload = $this->input->post('sim');
        }

        $sim = array (
            'id_pgw' => $this->input->post('pegawai'),
            'jns_sim' => $this->input->post('jns'),
            'no_sim' => $this->input->post('no_sim'),
            'pc_sim' => $upload
            );

        if ($this->db->where('id_sim',$id_sim)->update('tb_sim',$sim)) 
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}