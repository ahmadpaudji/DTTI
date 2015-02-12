<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_formal extends Model_tambahan 
{
    public $formal_rules = array(
        'tempat' => array(
            'field' => 'tempat',
            'rules' => 'trim|required|xss_clean',
            ),
        'tahun' => array(
            'field' => 'tahun',
            'rules' => 'trim|required|xss_clean',
            )
        );

    //DROPDOWN
    function pendidikan()
    {
        return $this->db->get('tb_formal')->result();
    }
    //AKHIR DROPDOWN

    function index()
    {
        $this->db->select('');
        $this->db->from('tb_detil_formal');
        $this->db->join('tb_formal','tb_formal.id_pnd_formal = tb_detil_formal.id_pnd_formal');
        $this->db->join('tb_pegawai','tb_pegawai.id_pgw = tb_detil_formal.id_pgw');
        $result = $this->db->get()->result();

        return $result;
    }

    function aksi_tambah($upload = null)
    {
        $formal = array (
            'id_pnd_formal' => $this->input->post('pendidikan'),
            'id_pgw' => $this->input->post('pegawai'),
            'nma_dtl_formal' => $this->input->post('tempat'),
            'thn_dtl_formal' => $this->input->post('tahun'),
            'stat_dtl_formal' => $this->input->post('status'),
            'pc_ijzh' => $upload
            );

        if ($this->db->insert('tb_detil_formal',$formal)) 
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function ubah($id_dtl_formal)
    {
        return $this->db->get_where('tb_detil_formal',array('id_dtl_formal' => $id_dtl_formal))->row();
    }

    function aksi_ubah($id_dtl_formal,$upload = null)
    {
        if ($upload == null && $this->input->post('ijazah') != null)
        {
            $upload = $this->input->post('ijazah');
        }

        $formal = array (
            'id_pnd_formal' => $this->input->post('pendidikan'),
            'id_pgw' => $this->input->post('pegawai'),
            'nma_dtl_formal' => $this->input->post('tempat'),
            'thn_dtl_formal' => $this->input->post('tahun'),
            'stat_dtl_formal' => $this->input->post('status'),
            'pc_ijzh' => $upload
            );

        if ($this->db->where('id_dtl_formal',$id_dtl_formal)->update('tb_detil_formal',$formal)) 
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function download($id_dtl_formal)
    {
        return $this->db->get_where("tb_detil_formal",array('id_dtl_formal' => $id_dtl_formal))->row();
    }
}