<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_informal extends Model_tambahan
{
    public $informal_rules = array(
        'tempat' => array(
            'field' => 'tempat',
            'rules' => 'trim|required|xss_clean',
            )
        );

    //DROPDOWN
    function pendidikan()
    {
        return $this->db->get('tb_informal')->result();
    }
    //AKHIR DROPDOWN

    function index()
    {
        $this->db->select('');
        $this->db->from('tb_detil_informal');
        $this->db->join('tb_informal','tb_informal.id_pnd_informal = tb_detil_informal.id_pnd_informal');
        $this->db->join('tb_pegawai','tb_pegawai.id_pgw = tb_detil_informal.id_pgw');
        $result = $this->db->get()->result();

        return $result;
    }

    function aksi_tambah($upload = null)
    {
        $informal = array (
            'id_pnd_informal' => $this->input->post('pendidikan'),
            'id_pgw' => $this->input->post('pegawai'),
            'nma_dtl_informal' => $this->input->post('tempat'),
            'pc_srtkt' => $upload
            );

        if ($this->db->insert('tb_detil_informal',$informal)) 
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function ubah($id_dtl_informal)
    {
        return $this->db->get_where('tb_detil_informal',array('id_dtl_informal' => $id_dtl_informal))->row();
    }

    function aksi_ubah($id_dtl_informal,$upload = null)
    {
        if ($upload == null && $this->input->post('sertifikat') != null)
        {
            $upload = $this->input->post('sertifikat');
        }

        $informal = array (
            'id_pnd_informal' => $this->input->post('pendidikan'),
            'id_pgw' => $this->input->post('pegawai'),
            'nma_dtl_informal' => $this->input->post('tempat'),
            'pc_srtkt' => $upload
            );

        if ($this->db->where('id_dtl_informal',$id_dtl_informal)->update('tb_detil_informal',$informal)) 
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function download($id_dtl_informal)
    {
        return $this->db->get_where("tb_detil_informal",array('id_dtl_informal' => $id_dtl_informal))->row();
    }
}