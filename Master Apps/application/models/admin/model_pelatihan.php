<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_pelatihan extends Model_tambahan
{
    public $pelatihan_rules = array(
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
        $this->db->select();
        $this->db->from("tb_pelatihan");

        if ($this->input->post("tanggal_awal") != '')
        {
            $tgl_awal = explode('/', $this->input->post('tanggal_awal'));
            $tanggal_awal = $tgl_awal[2].'-'.$tgl_awal[0].'-'.$tgl_awal[1];
            $this->db->where("tgl_pjn_lth >=",$tanggal_awal);
        }

        if ($this->input->post("tanggal_akhir") != '')
        {
            $tgl_akhir = explode('/', $this->input->post('tanggal_akhir'));
            $tanggal_akhir = $tgl_akhir[2].'-'.$tgl_akhir[0].'-'.$tgl_akhir[1];
            $this->db->where("tgl_pjn_lth <=",$tanggal_akhir);
        }
        $this->db->order_by("id_lth","desc");

        return $this->db->get()->result();
    }

    function detail($id_lth)
    {
        $this->db->select("nma_lkp_pgw,div_jbtn,nma_jbtn");
        $this->db->from("tb_detil_pelatihan");
        $this->db->join("tb_pegawai","tb_pegawai.id_pgw = tb_detil_pelatihan.id_pgw");
        $this->db->join("tb_jabatan","tb_jabatan.id_jbtn = tb_pegawai.id_jbtn");
        $this->db->where("tb_detil_pelatihan.id_lth",$id_lth);
        $result = $this->db->get()->result();

        $data = new stdclass();
        $data->lth = $this->db->get_where('tb_pelatihan',array('id_lth' => $id_lth))->row();
        $data->anggota = $result;

        return $data;
    }

    function aksi_tambah()
    {
        date_default_timezone_set("Asia/Jakarta"); 
        $nama = $this->db->get_where("tb_pegawai",array('id_pgw' => $this->session->userdata['id_pgw']))->row();
        $tgl_awal = explode('/',$this->input->post('tanggal_awal'));
        $tgl_akhir = explode('/',$this->input->post('tanggal_akhir'));
        $tanggal_awal = $tgl_awal[2].'-'.$tgl_awal[0].'-'.$tgl_awal[1];
        $tanggal_akhir = $tgl_akhir[2].'-'.$tgl_akhir[0].'-'.$tgl_akhir[1];

        $pelatihan = array (
            'tgl_pjn_lth' => unix_to_human(now(),TRUE,'eu'),
            'nma_pju_lth' => $nama->nma_lkp_pgw,
            'nma_lth' => $this->input->post('nama'),
            'waktu_lth_awal' => $tanggal_awal,
            'waktu_lth_akhir' => $tanggal_akhir,
            'tmp_lth' => $this->input->post('tempat'),
            'stat_lth' => 'N'
            );

        if ($this->db->insert('tb_pelatihan',$pelatihan)) 
        {   
            $id_lth = $this->db->insert_id();
            foreach ($this->input->post('anggota') as $id_pgw)
            {
                $detil = array (
                'id_lth' => $id_lth,
                'id_pgw' => $id_pgw
                );

                $this->db->insert('tb_detil_pelatihan',$detil);
            }

            return true;
        }
        else
        {
            return false;
        }
    }

    function ubah($id_lth)
    {
        $data = new stdclass();
        $data->lth = $this->db->get_where('tb_pelatihan',array('id_lth' => $id_lth))->row();
        $data->anggota = $this->db->get_where('tb_detil_pelatihan',array('id_lth' => $id_lth))->result();
        
        return $data;
    }

    function aksi_ubah($id_lth)
    {
        date_default_timezone_set("Asia/Jakarta"); 
        $tgl_awal = explode('/',$this->input->post('tanggal_awal'));
        $tgl_akhir = explode('/',$this->input->post('tanggal_akhir'));
        $tanggal_awal = $tgl_awal[2].'-'.$tgl_awal[0].'-'.$tgl_awal[1];
        $tanggal_akhir = $tgl_akhir[2].'-'.$tgl_akhir[0].'-'.$tgl_akhir[1];

        $pelatihan = array (
            'nma_lth' => $this->input->post('nama'),
            'waktu_lth_awal' => $tanggal_awal,
            'waktu_lth_akhir' => $tanggal_akhir,
            'tmp_lth' => $this->input->post('tempat')
            );

        if ($this->db->where('id_lth',$id_lth)->update('tb_pelatihan',$pelatihan)) 
        {
            $this->db->delete('tb_detil_pelatihan',array('id_lth' => $id_lth));

            foreach ($this->input->post('anggota') as $id_pgw)
            {
                $detil = array (
                'id_lth' => $id_lth,
                'id_pgw' => $id_pgw
                );

                $this->db->insert('tb_detil_pelatihan',$detil);
            }

            return true;
        }
        else
        {
            return false;
        }
    }

    function setuju($id_lth,$status)
    {
        $this->db->select();
        $this->db->from("tb_pegawai");
        $this->db->where("tb_pegawai.id_pgw",$this->session->userdata['id_pgw']);
        $this->db->join("tb_jabatan","tb_jabatan.id_jbtn = tb_pegawai.id_jbtn");
        $result = $this->db->get()->row();

        $stat = array(
            'stat_lth' => $status,
            'apprv_lth' => $result->nma_lkp_pgw,
            'jbt_apprv_lth' => $result->div_jbtn.'('.$result->nma_jbtn.')'
            );

        if ($this->db->where('id_lth',$id_lth)->update('tb_pelatihan',$stat))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}