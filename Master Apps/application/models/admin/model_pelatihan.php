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

    function index($notif = null)
    {
        $this->db->select();
        $this->db->from("tb_pelatihan");
        $this->db->join("tb_pegawai","tb_pegawai.id_pgw = tb_pelatihan.id_pgw");

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

        if ($this->session->userdata("hak") == "user" || $this->session->userdata("hak") == "super user")
        {
            $this->db->where("tb_pegawai.id_pgw",$this->session->userdata('id_pgw'));
        }
        else if ($this->session->userdata("hak") == "admin")
        {
            if ($this->input->post("pegawai") != '')
            {
                $this->db->where("tb_pegawai.id_pgw",$this->input->post("pegawai"));
            }
        }

        if ($notif == "notif")
        {
            $this->db->order_by("tgl_pjn_lth","desc");
            $this->db->order_by("stat_lth","desc");
        }
        else
        {
            $this->db->order_by("id_lth","desc");
        }

        return $this->db->get()->result();
    }

    function rekap()
    {
        $tgl = date("d");
        $bln = date("m");
        $thn = date("Y");
        $lth = array();

        if ($tgl >= 21 && $bln != 12)
        {
            $tanggal_awal = $thn.'-'.$bln.'-21';
            $tanggal_akhir = $thn.'-'.($bln+1).'-20';
        }
        else if ($tgl < 21 && $bln != 1)
        {
            $tanggal_awal = $thn.'-'.($bln-1).'-21';
            $tanggal_akhir = $thn.'-'.$bln.'-20';
        }
        else if ($tgl >= 21 && $bln == 12)
        {
            $tanggal_awal = $thn.'-'.$bln.'-21';
            $tanggal_akhir = ($thn+1).'-1-20';
        }
        else if ($tgl < 21 && $bln == 1)
        {
            $tanggal_awal = ($thn-1).'-12-21';
            $tanggal_akhir = $thn.'-'.$bln.'-20';
        }

        $pegawai = $this->db->get("tb_pegawai")->result_array();

        $i = 0;
        foreach ($pegawai as $p)
        {
            $lth[$i]['nama'] = $p['nma_lkp_pgw'];

            $this->db->where('id_pgw', $p['id_pgw']);
            $this->db->where('stat_lth', 'Y');
            $this->db->where('tgl_pjn_lth >=', $tanggal_awal);
            $this->db->where('tgl_pjn_lth <=', $tanggal_akhir);
            $lth[$i]['terima'] = count($this->db->get('tb_pelatihan')->result());
            
            $i++;
        }

        $data = new stdClass();
        $data->lth = $lth;
        $data->tanggal_awal = $tanggal_awal;
        $data->tanggal_akhir = $tanggal_akhir;

        return $data;
    }

    function konfirmasi($notif = null)
    {
        $this->db->select();
        $this->db->from("tb_pelatihan");
        $this->db->join("tb_pegawai","tb_pegawai.id_pgw = tb_pelatihan.id_pgw");
        $this->db->join("tb_jabatan","tb_jabatan.id_jbtn = tb_pegawai.id_jbtn");

        if ($this->input->post("tanggal_awal") != '')
        {
            $tgl_awal = explode('/', $this->input->post('tanggal_awal'));
            $tanggal_awal = $tgl_awal[2].'-'.$tgl_awal[0].'-'.$tgl_awal[1];
            $this->db->where("tgl_pjn_abs >=",$tanggal_awal);
        }

        if ($this->input->post("tanggal_akhir") != '')
        {
            $tgl_akhir = explode('/', $this->input->post('tanggal_akhir'));
            $tanggal_akhir = $tgl_akhir[2].'-'.$tgl_akhir[0].'-'.$tgl_akhir[1];
            $this->db->where("tgl_pjn_abs <=",$tanggal_akhir);
        }

        if ($this->session->userdata("hak") == "user" && $this->session->userdata("jabatan") == "manajer")
        {
            if ($this->input->post("pegawai") != '')
            {
                $this->db->where("tb_pegawai.id_pgw",$this->input->post("pegawai"));
            }
            else
            {
                $this->db->where("tb_jabatan.div_jbtn",$this->session->userdata("divisi"));
                $this->db->where("tb_jabatan.nma_jbtn !=",$this->session->userdata("jabatan"));
            }
        }
        else if ($this->session->userdata("hak") == "admin" && $this->session->userdata("jabatan") == "kepala")
        {
            if ($this->input->post("pegawai") != '')
            {
                $this->db->where("tb_pegawai.id_pgw",$this->input->post("pegawai"));
            }
            else
            {
                $this->db->where("tb_jabatan.div_jbtn",$this->session->userdata("divisi"));
                $this->db->where("tb_jabatan.nma_jbtn !=",$this->session->userdata("jabatan"));
            }
        }
        else if ($this->session->userdata("hak") == "super user")
        {
            if ($this->session->userdata("jabatan") == "direktur utama")
            {
                if ($this->input->post("pegawai") != '')
                {
                    $this->db->where("tb_pegawai.id_pgw",$this->input->post("pegawai"));
                }
                else
                {
                    $this->db->where("tb_jabatan.nma_jbtn","manajer");
                    $this->db->where("tb_jabatan.div_jbtn","operasional");
                    $this->db->or_where("tb_jabatan.nma_jbtn","kepala");
                    $this->db->where("tb_jabatan.nma_jbtn !=",$this->session->userdata("jabatan"));
                }
            }
            else if ($this->session->userdata("jabatan") == "direktur marketing")
            {
                if ($this->input->post("pegawai") != '')
                {
                    $this->db->where("tb_pegawai.id_pgw",$this->input->post("pegawai"));
                }
                else
                {
                    $this->db->where("tb_jabatan.nma_jbtn","manajer");
                    $this->db->where("tb_jabatan.div_jbtn","marketing");
                    $this->db->where("tb_jabatan.nma_jbtn !=",$this->session->userdata("jabatan"));
                }   
            }
            else if ($this->session->userdata("jabatan") == "direktur operasional")
            {
                if ($this->input->post("pegawai") != '')
                {
                    $this->db->where("tb_pegawai.id_pgw",$this->input->post("pegawai"));
                }
                else
                {
                    $this->db->where("tb_jabatan.nma_jbtn","manajer");
                    $this->db->where("tb_jabatan.div_jbtn","operasional");
                    $this->db->where("tb_jabatan.nma_jbtn !=",$this->session->userdata("jabatan"));
                }   
            }
        }

        if ($notif == "notif")
        {
            $this->db->order_by("stat_lth = 'N'","desc");
        }
        else
        {
            $this->db->order_by("id_lth","desc");
        }

        $result = $this->db->get()->result();

        return $result;
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
            'id_pgw' => $this->session->userdata('id_pgw'),
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

            $dtl = array (
                'id_lth' => $id_lth,
                'id_pgw' => $this->session->userdata('id_pgw')
                );

            $this->db->insert('tb_detil_pelatihan',$dtl);

            foreach ($this->input->post('anggota') as $id_pgw)
            {
                $detil = array (
                'id_lth' => $id_lth,
                'id_pgw' => $id_pgw
                );

                $this->db->insert('tb_detil_pelatihan',$detil);
            }

            $ntf = array(
                    'id_pgw' => $this->session->userdata('id_pgw'),
                    'waktu_notif' => unix_to_human(now(),TRUE,'eu'),
                    'ket_notif' => "Pengajuan pelatihan.",
                    'status_notif' => 'n',
                    'jenis_notif' => "pelatihan"
                );

            $this->db->insert('tb_notif',$ntf);

            return $id_lth;
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

            
            $dtl = array (
                'id_lth' => $id_lth,
                'id_pgw' => $this->session->userdata('id_pgw')
                );

            $this->db->insert('tb_detil_pelatihan',$dtl);

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

    function get_email()
    {
        $jabatan = $this->session->userdata("jabatan");
        $result = null;

        $this->db->select();
        $this->db->from("tb_jabatan");
        $this->db->where("nma_jbtn like","sv%");
        $this->db->or_where("nma_jbtn like","staff%");
        $jbt_d = $this->db->get()->result();

        foreach ($jbt_d as $jbt_df)
        {
            $jabatan_sv_st[] = $jbt_df->nma_jbtn;
        }

        if (in_array($jabatan, $jabatan_sv_st))
        {
            $this->db->select("nma_lkp_pgw,email_pgw");
            $this->db->from("tb_pegawai");
            $this->db->join("tb_jabatan","tb_jabatan.id_jbtn = tb_pegawai.id_jbtn");
            $this->db->where("tb_jabatan.nma_jbtn","manajer");
            $this->db->or_where("tb_jabatan.nma_jbtn","kepala");
            $this->db->where("tb_jabatan.div_jbtn",$this->session->userdata("divisi"));
            $result = $this->db->get()->row();
        }
        else if ($jabatan == "manajer" || $jabatan == "kepala")
        {
            if ($divisi = "operasional")
            {
                $this->db->select("nma_lkp_pgw,email_pgw");
                $this->db->from("tb_pegawai");
                $this->db->join("tb_jabatan","tb_jabatan.id_jbtn = tb_pegawai.id_jbtn");
                $this->db->where("tb_jabatan.nma_jbtn","direktur operasional");
            }
            else if ($divisi = "marketing")
            {
                $this->db->select("nma_lkp_pgw,email_pgw");
                $this->db->from("tb_pegawai");
                $this->db->join("tb_jabatan","tb_jabatan.id_jbtn = tb_pegawai.id_jbtn");
                $this->db->where("tb_jabatan.nma_jbtn","direktur marketing");
            }
            else
            {
                $this->db->select("nma_lkp_pgw,email_pgw");
                $this->db->from("tb_pegawai");
                $this->db->join("tb_jabatan","tb_jabatan.id_jbtn = tb_pegawai.id_jbtn");
                $this->db->where("tb_jabatan.nma_jbtn","direktur utama");
            }
            $result = $this->db->get()->row();   
        }
        
        return $result;
    }
}