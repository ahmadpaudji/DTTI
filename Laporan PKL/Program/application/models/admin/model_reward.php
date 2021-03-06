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

    function aksi_tambah()
    {
        date_default_timezone_set("Asia/Jakarta");

        $reward = array (
            'id_pgw' => $this->input->post('pegawai'),
            'tgl_reward' => unix_to_human(now(),TRUE,'eu'),
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

    function cetak()
    {
        $pegawai = $this->db->select('nma_lkp_pgw,id_pgw')->get('tb_pegawai')->result_array();
        
        $i = 0;
        $reward = array('khusus','teladan');
        foreach ($pegawai as $k)
        {
            foreach($reward as $m)
            {   
                $this->db->where('id_pgw', $k['id_pgw']);
                
                $this->db->where("jns_reward", $m);
                $pegawai[$i][$m] = count($this->db->get('tb_reward')->result_array());
            }

            $i++;
        }
        return $pegawai;
    }
}