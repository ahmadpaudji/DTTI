<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_punishment extends Model_tambahan 
{
    public $punishment_rules = array(
        'keterangan' => array(
            'field' => 'keterangan',
            'rules' => 'trim|required|xss_clean',
            )
        );

    function index()
    {
        $this->db->select('');
        $this->db->from('tb_punishment');
        $this->db->join('tb_pegawai','tb_pegawai.id_pgw = tb_punishment.id_pgw');
        $this->db->join('tb_jabatan','tb_jabatan.id_jbtn = tb_pegawai.id_jbtn');

        if ($this->session->userdata("jabatan") == "direktur marketing")
        {
            $this->db->where('tb_jabatan.div_jbtn','marketing');
        }
        else if ($this->session->userdata("jabatan") == "direktur operasional")
        {
            $this->db->where('div_jbtn','operasional');
        }
        
        $result = $this->db->get()->result();

        return $result;
    }

    function aksi_tambah($upload = null)
    {
        date_default_timezone_set("Asia/Jakarta");

        $punishment = array (
            'id_pgw' => $this->input->post('pegawai'),
            'tgl_pun' => unix_to_human(now(),TRUE,'eu'),
            'jns_pun' => $this->input->post('jenis'),
            'surat_pun' => $upload,
            'ket_pun' => $this->input->post('keterangan')
            );

        if ($this->db->insert('tb_punishment',$punishment)) 
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function ubah($id_pun)
    {
        return $this->db->get_where('tb_punishment',array('id_pun' => $id_pun))->row();
    }

    function aksi_ubah($id_pun,$upload = null)
    {
        if ($upload == null && $this->input->post('punishment') != null)
        {
            $upload = $this->input->post('punishment');
        }

        $punishment = array (
            'id_pgw' => $this->input->post('pegawai'),
            'jns_pun' => $this->input->post('jenis'),
            'surat_pun' => $upload,
            'ket_pun' => $this->input->post('keterangan')
            );

        if ($this->db->where('id_pun',$id_pun)->update('tb_punishment',$punishment)) 
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function download($id_pun)
    {
        return $this->db->get_where("tb_punishment",array('id_pun' => $id_pun))->row();
    }

    function cetak()
    {
        $pegawai = $this->db->select('nma_lkp_pgw,id_pgw')->get('tb_pegawai')->result_array();
        
        $i = 0;
        $punishment = array('SP1','SP2','SP3');
        foreach ($pegawai as $k)
        {
            foreach($punishment as $p)
            {   
                $this->db->where('id_pgw', $k['id_pgw']);
                
                $this->db->where("jns_pun", $p);
                $pegawai[$i][$p] = count($this->db->get('tb_punishment')->result_array());
            }

            $i++;
        }
        return $pegawai;
    }
}