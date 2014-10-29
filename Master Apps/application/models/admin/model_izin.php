<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_izin extends Model_tambahan
{
    public $izin_rules = array(
        'alasan' => array(
            'field' => 'alasan',
            'rules' => 'trim|required|xss_clean',
            )
        );

    function index()
    {
        $jabatan_sv_stf = array();
        $divisi = $this->session->userdata('divisi');
        $jabatan = $this->session->userdata('jabatan');

        $this->db->select();
        $this->db->from("tb_jabatan");
        $this->db->where('nma_jbtn like', 'sv%');
        $this->db->or_where('nma_jbtn like', 'staff%');
        $jbtn_sv_stf = $this->db->get()->result();

        foreach ($jbtn_sv_stf as $jb)
        {
            $jabatan_sv_stf[] = $jb->nma_jbtn;
        }
        
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

        if ($this->session->userdata("hak") == "user" && in_array($this->session->userdata("jabatan"), $jabatan_sv_stf))
        {
            $this->db->where("tb_pegawai.id_pgw",$this->session->userdata('id_pgw'));
        }
        else if ($this->session->userdata("hak") == "user" && in_array($this->session->userdata("jabatan"), $jabatan_sv_stf))
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
        else if ($this->session->userdata("hak") == "super user")
        {
            if ($this->input->post("pegawai") != '')
            {
                $this->db->where("tb_pegawai.id_pgw",$this->input->post("pegawai"));
            }
        }
        $this->db->order_by("id_abs","desc");
        $result = $this->db->get()->result();

        return $result;
    }

    function konfirmasi()
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
        else if ($this->session->userdata("hak") == "user" && $this->session->userdata("jabatan") ==  "kepala")
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
        else if ($this->session->userdata("hak") == "super user" && $this->session->userdata("jabatan") ==  "direktur utama")
        {
            if ($this->input->post("pegawai") != '')
            {
                $this->db->where("tb_pegawai.id_pgw",$this->input->post("pegawai"));
            }
            else
            {
                $this->db->where("tb_jabatan.nma_jbtn","manajer");
                $this->db->or_where("tb_jabatan.nma_jbtn","kepala");
                $this->db->where("tb_jabatan.nma_jbtn !=",$this->session->userdata("jabatan"));
            }
        }
        $this->db->order_by("id_abs","desc");
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
}