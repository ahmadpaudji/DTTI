<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_izin extends Model_tambahan
{
    public $izin_rules = array(
        'alasan' => array(
            'field' => 'alasan',
            'rules' => 'trim|required|xss_clean',
            )
        );

    function index($notif = null)
    {   
        $this->db->select();
        $this->db->from("tb_izin_absen");
        $this->db->join("tb_pegawai","tb_pegawai.id_pgw = tb_izin_absen.id_pgw");

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
            $this->db->order_by("tgl_pjn_abs","desc");
            $this->db->order_by("stat_abs","desc");
        }
        else
        {
            $this->db->order_by("id_abs","desc");
        }
        $result = $this->db->get()->result();

        return $result;
    }

    function rekap()
    {
        $tgl = date("d");
        $bln = date("m");
        $thn = date("Y");
        $izin = array();

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
        $status = array('sakit','ijin','cuti');
        foreach ($pegawai as $p)
        {
            $izin[$i]['nama'] = $p['nma_lkp_pgw'];

            foreach ($status as $s)
            {
                $this->db->where('id_pgw', $p['id_pgw']);
                $this->db->where('jns_abs',$s);
                $this->db->where('stat_abs', 'Y');
                $this->db->where('tgl_pjn_abs >=', $tanggal_awal);
                $this->db->where('tgl_pjn_abs <=', $tanggal_akhir);
                $izin[$i][$s] = count($this->db->get('tb_izin_absen')->result());
            }
            $i++;
        }

        $data = new stdClass();
        $data->izn = $izin;
        $data->tanggal_awal = $tanggal_awal;
        $data->tanggal_akhir = $tanggal_akhir;

        return $data;
    }

    function konfirmasi($notif = null)
    {
        $this->db->select();
        $this->db->from("tb_izin_absen");
        $this->db->join("tb_pegawai","tb_pegawai.id_pgw = tb_izin_absen.id_pgw");
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
            $this->db->order_by("stat_abs = 'N'","desc");
        }
        else
        {
            $this->db->order_by("id_abs","desc");
        }

        $result = $this->db->get()->result();

        return $result;
    }

    function aksi_tambah($upload = null)
    {
        date_default_timezone_set("Asia/Jakarta");
        $tgl_mulai = explode('/', $this->input->post('tanggal_mulai'));
        $tanggal_mulai = $tgl_mulai[2].'-'.$tgl_mulai[0].'-'.$tgl_mulai[1];

        $tgl_akhir = explode('/', $this->input->post('tanggal_akhir'));
        $tanggal_akhir = $tgl_akhir[2].'-'.$tgl_akhir[0].'-'.$tgl_akhir[1];

        $izin = array (
            'id_pgw' => $this->session->userdata('id_pgw'),
            'tgl_pjn_abs' => unix_to_human(now(),TRUE,'eu'),
            'als_abs' => $this->input->post('alasan'),
            'jns_abs' => $this->input->post('jenis'),
            'wkt_abs_awl' => $tanggal_mulai,
            'wkt_abs_akr' => $tanggal_akhir,
            'stat_abs' => 'N',
            'bukti_abs' => $upload
            );

        if ($this->db->insert('tb_izin_absen',$izin)) 
        {
            $ntf = array(
                    'id_pgw' => $this->session->userdata('id_pgw'),
                    'waktu_notif' => unix_to_human(now(),TRUE,'eu'),
                    'ket_notif' => "Pengajuan izin.",
                    'status_notif' => 'n',
                    'jenis_notif' => "izin"
                );

            $this->db->insert('tb_notif',$ntf);
            return true;
        }
        else
        {
            return false;
        }
    }

    function detail($id_abs)
    {
        $this->db->select();
        $this->db->from("tb_izin_absen");
        $this->db->join("tb_pegawai","tb_pegawai.id_pgw = tb_izin_absen.id_pgw");
        $this->db->where("id_abs",$id_abs);

        return $this->db->get()->row();
    }

    function ubah($id_abs)
    {
        return $this->db->get_where("tb_izin_absen",array('id_abs' => $id_abs))->row();
    }

    function aksi_ubah($id_abs,$upload = null)
    {
        $tgl_mulai = explode('/', $this->input->post('tanggal_mulai'));
        $tanggal_mulai = $tgl_mulai[2].'-'.$tgl_mulai[0].'-'.$tgl_mulai[1];

        $tgl_akhir = explode('/', $this->input->post('tanggal_akhir'));
        $tanggal_akhir = $tgl_akhir[2].'-'.$tgl_akhir[0].'-'.$tgl_akhir[1];

        if ($upload != null)
        {
            $izin = array (
                'tgl_pjn_abs' => unix_to_human(now(),TRUE,'eu'),
                'als_abs' => $this->input->post('alasan'),
                'jns_abs' => $this->input->post('jenis'),
                'wkt_abs_awl' => $tanggal_mulai,
                'wkt_abs_akr' => $tanggal_akhir,
                'stat_abs' => 'N',
                'bukti_abs' => $upload
                );
        }
        else
        {
            $izin = array (
                'tgl_pjn_abs' => unix_to_human(now(),TRUE,'eu'),
                'als_abs' => $this->input->post('alasan'),
                'jns_abs' => $this->input->post('jenis'),
                'wkt_abs_awl' => $tanggal_mulai,
                'wkt_abs_akr' => $tanggal_akhir,
                'stat_abs' => 'N'
                );
        }

        if ($this->db->where('id_abs',$id_abs)->update('tb_izin_absen',$izin)) 
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function setuju($id_abs,$status)
    {
        $this->db->select();
        $this->db->from("tb_pegawai");
        $this->db->where("tb_pegawai.id_pgw",$this->session->userdata['id_pgw']);
        $this->db->join("tb_jabatan","tb_jabatan.id_jbtn = tb_pegawai.id_jbtn");
        $result = $this->db->get()->row();

        $izin = array (
            'stat_abs' => $status,
            'apprv_abs' => $result->nma_lkp_pgw,
            'jbt_abs' => $result->div_jbtn.'('.$result->nma_jbtn.')'
            );

        if ($this->db->where('id_abs',$id_abs)->update('tb_izin_absen',$izin)) 
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function download($id_abs)
    {
        return $this->db->get_where("tb_izin_absen",array('id_abs' => $id_abs))->row();
    }

    function get_email()
    {
        $jabatan = $this->session->userdata("jabatan");
        $divisi = $this->session->userdata("divisi");
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