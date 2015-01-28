<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_sppd extends Model_tambahan
{
    public $sppd_rules = array(
        'tamu' => array(
            'field' => 'tamu',
            'rules' => 'trim|required|xss_clean',
            ),
        'posisi' => array(
            'field' => 'posisi',
            'rules' => 'trim|xss_clean',
            ),
        'jenis' => array(
            'field' => 'jenis',
            'rules' => 'trim|required|xss_clean',
            ),
        'tempat' => array(
            'field' => 'tempat',
            'rules' => 'trim|required|xss_clean',
            ),
        'alamat' => array(
            'field' => 'alamat',
            'rules' => 'trim|required|xss_clean',
            ),
        'bidang' => array(
            'field' => 'bidang',
            'rules' => 'trim|required|xss_clean',
            ),
        'telepon' => array(
            'field' => 'telepon',
            'rules' => 'trim|xss_clean',
            ),
        'agenda' => array(
            'field' => 'agenda',
            'rules' => 'trim|required|xss_clean',
            )
        );

    function index($notif = null)
    {
        $this->db->select();
        $this->db->from("tb_sppd");
        $this->db->join("tb_pegawai","tb_pegawai.id_pgw = tb_sppd.id_pgw");

        if ($this->input->post("tanggal_awal") != '')
        {
            $tgl_awal = explode('/', $this->input->post('tanggal_awal'));
            $tanggal_awal = $tgl_awal[2].'-'.$tgl_awal[0].'-'.$tgl_awal[1];
            $this->db->where("tgl_pju_sppd >=",$tanggal_awal);
        }

        if ($this->input->post("tanggal_akhir") != '')
        {
            $tgl_akhir = explode('/', $this->input->post('tanggal_akhir'));
            $tanggal_akhir = $tgl_akhir[2].'-'.$tgl_akhir[0].'-'.$tgl_akhir[1];
            $this->db->where("tgl_pju_sppd <=",$tanggal_akhir);
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
            $this->db->order_by("tgl_pju_sppd","desc");
            $this->db->order_by("apprv_sppd","desc");
        }
        else
        {
            $this->db->order_by("id_sppd","desc");
        }

        return $this->db->get()->result();
    }

    function rekap()
    {
        $tgl = date("d");
        $bln = date("m");
        $thn = date("Y");
        $sppd = array();

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
            $sppd[$i]['nama'] = $p['nma_lkp_pgw'];

            $this->db->where('id_pgw', $p['id_pgw']);
            $this->db->where('apprv_sppd', 'Y');
            $this->db->where('tgl_pju_sppd >=', $tanggal_awal);
            $this->db->where('tgl_pju_sppd <=', $tanggal_akhir);
            $sppd[$i]['terima'] = count($this->db->get('tb_sppd')->result());
            
            $i++;
        }

        $data = new stdClass();
        $data->spd = $sppd;
        $data->tanggal_awal = $tanggal_awal;
        $data->tanggal_akhir = $tanggal_akhir;

        return $data;
    }

    function konfirmasi($notif = null)
    {
        $this->db->select();
        $this->db->from("tb_sppd");
        $this->db->join("tb_pegawai","tb_pegawai.id_pgw = tb_sppd.id_pgw");
        $this->db->join("tb_jabatan","tb_jabatan.id_jbtn = tb_pegawai.id_jbtn");

        if ($this->input->post("tanggal_awal") != '')
        {
            $tgl_awal = explode('/', $this->input->post('tanggal_awal'));
            $tanggal_awal = $tgl_awal[2].'-'.$tgl_awal[0].'-'.$tgl_awal[1];
            $this->db->where("tgl_pju_sppd >=",$tanggal_awal);
        }

        if ($this->input->post("tanggal_akhir") != '')
        {
            $tgl_akhir = explode('/', $this->input->post('tanggal_akhir'));
            $tanggal_akhir = $tgl_akhir[2].'-'.$tgl_akhir[0].'-'.$tgl_akhir[1];
            $this->db->where("tgl_pju_sppd <=",$tanggal_akhir);
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
            $this->db->order_by("apprv_sppd = 'N'","desc");
        }
        else
        {
            $this->db->order_by("id_sppd","desc");
        }

        $result = $this->db->get()->result();

        return $result;
    }

    function detail($id_sppd)
    {
        $this->db->select("nma_lkp_pgw,div_jbtn,nma_jbtn");
        $this->db->from("tb_detil_sppd");
        $this->db->join("tb_pegawai","tb_pegawai.id_pgw = tb_detil_sppd.id_pgw");
        $this->db->join("tb_jabatan","tb_jabatan.id_jbtn = tb_pegawai.id_jbtn");
        $this->db->where("tb_detil_sppd.id_sppd",$id_sppd);
        $result = $this->db->get()->result();

        $data = new stdclass();
        $this->db->join("tb_pegawai","tb_pegawai.id_pgw = tb_sppd.id_pgw");
        $this->db->join("tb_jabatan","tb_jabatan.id_jbtn = tb_pegawai.id_jbtn");
        $data->sppd = $this->db->get_where('tb_sppd',array('id_sppd' => $id_sppd))->row();
        $data->anggota = $result;

        return $data;
    }

    function aksi_tambah()
    {
        date_default_timezone_set("Asia/Jakarta"); 

        $tgl = explode('/',$this->input->post('tanggal'));
        $tanggal = $tgl[2].'-'.$tgl[0].'-'.$tgl[1];

        $sppd = array (
            'id_pgw' => $this->session->userdata('id_pgw'),
            'tgl_pju_sppd' => unix_to_human(now(),TRUE,'eu'),
            'tgl_plk_sppd' => $tanggal,
            'nma_kga_sppd' => $this->input->post('tamu'),
            'posisi_kga_sppd' => $this->input->post('posisi'),
            'jns_tmp_sppd' => $this->input->post('jenis'),
            'nma_tmp_sppd' => $this->input->post('tempat'),
            'almt_tmp_sppd' => $this->input->post('alamat'),
            'bdg_phn_sppd' => $this->input->post('bidang'),
            'tlp_kga_sppd' => $this->input->post('telepon'),
            'agenda_sppd' => $this->input->post('agenda')
            );

        if ($this->db->insert('tb_sppd',$sppd)) 
        {   
            $id_sppd = $this->db->insert_id();

            $dtl = array (
                'id_sppd' => $id_sppd,
                'id_pgw' => $this->session->userdata('id_pgw')
                );

            $this->db->insert('tb_detil_sppd',$dtl);

            foreach ($this->input->post('anggota') as $id_pgw)
            {
                $detil = array (
                'id_sppd' => $id_sppd,
                'id_pgw' => $id_pgw
                );

                $this->db->insert('tb_detil_sppd',$detil);
            }

            $ntf = array(
                    'id_pgw' => $this->session->userdata('id_pgw'),
                    'waktu_notif' => unix_to_human(now(),TRUE,'eu'),
                    'ket_notif' => "Pengajuan SPPD.",
                    'status_notif' => 'n',
                    'jenis_notif' => "sppd"
                );

            $this->db->insert('tb_notif',$ntf);

            return $id_sppd;
        }
        else
        {
            return false;
        }
    }

    function ubah($id_sppd)
    {
        $data = new stdclass();
        $data->sppd = $this->db->get_where('tb_sppd',array('id_sppd' => $id_sppd))->row();
        $data->anggota = $this->db->get_where('tb_detil_sppd',array('id_sppd' => $id_sppd))->result();
        
        return $data;
    }

    function aksi_ubah($id_sppd)
    {
        date_default_timezone_set("Asia/Jakarta"); 

        $tgl = explode('/',$this->input->post('tanggal'));
        $tanggal = $tgl[2].'-'.$tgl[0].'-'.$tgl[1];

        $sppd = array (
            'id_pgw' => $this->session->userdata('id_pgw'),
            'tgl_pju_sppd' => unix_to_human(now(),TRUE,'eu'),
            'tgl_plk_sppd' => $tanggal,
            'nma_kga_sppd' => $this->input->post('tamu'),
            'posisi_kga_sppd' => $this->input->post('posisi'),
            'jns_tmp_sppd' => $this->input->post('jenis'),
            'nma_tmp_sppd' => $this->input->post('tempat'),
            'almt_tmp_sppd' => $this->input->post('alamat'),
            'bdg_phn_sppd' => $this->input->post('bidang'),
            'tlp_kga_sppd' => $this->input->post('telepon'),
            'agenda_sppd' => $this->input->post('agenda')
            );

        if ($this->db->where('id_sppd',$id_sppd)->update('tb_sppd',$sppd)) 
        {
            $this->db->delete('tb_detil_sppd',array('id_sppd' => $id_sppd));

            $dtl = array (
                'id_sppd' => $id_sppd,
                'id_pgw' => $this->session->userdata('id_pgw')
                );

            $this->db->insert('tb_detil_sppd',$dtl);

            foreach ($this->input->post('anggota') as $id_pgw)
            {
                $detil = array (
                'id_sppd' => $id_sppd,
                'id_pgw' => $id_pgw
                );

                $this->db->insert('tb_detil_sppd',$detil);
            }

            return true;
        }
        else
        {
            return false;
        }
    }

    function aksi_upload($id_sppd,$upload)
    {
        if ($upload == null && $this->input->post('sppd') != null)
        {
            $upload = $this->input->post('sppd');
        }

        $sppd = array (
            'stat_kunj' => 'Y',
            'lampiran' => $upload
            );

        if ($this->db->where('id_sppd',$id_sppd)->update('tb_sppd',$sppd)) 
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function setuju($id_sppd,$status)
    {
        $this->db->select();
        $this->db->from("tb_pegawai");
        $this->db->where("tb_pegawai.id_pgw",$this->session->userdata['id_pgw']);
        $this->db->join("tb_jabatan","tb_jabatan.id_jbtn = tb_pegawai.id_jbtn");
        $result = $this->db->get()->row();

        $stat = array(
            'apprv_sppd' => $status,
            'tgl_apprv_sppd' => unix_to_human(now(),TRUE,'eu'),
            'nma_apprv_sppd' => $result->nma_lkp_pgw,
            'jbtn_apprv_sppd' => $result->div_jbtn.'('.$result->nma_jbtn.')'
            );

        if ($this->db->where('id_sppd',$id_sppd)->update('tb_sppd',$stat))
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
        else if ($this->session->userdata("super user"))
        {
            $this->db->select("nma_lkp_pgw,email_pgw");
            $this->db->from("tb_pegawai");
            $this->db->join("tb_jabatan","tb_jabatan.id_jbtn = tb_pegawai.id_jbtn");
            $this->db->where("tb_jabatan.nma_jbtn","kepala");
        }
        
        return $result;
    }


    function download($id_sppd)
    {
        return $this->db->get_where("tb_sppd",array('id_sppd' => $id_sppd))->row();
    }
}