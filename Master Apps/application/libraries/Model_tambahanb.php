<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_tambahan extends CI_Model 
{
    function pegawai($jabatan = null)
    {
        $this->db->select('id_pgw,nik_pgw,nma_lkp_pgw');
        $this->db->from('tb_pegawai');
        if ($jabatan != '')
        {
            if ($jabatan == "direksi utama")
            {
                $this->db->join('tb_jabatan','tb_jabatan.id_jbtn = tb_pegawai.id_jbtn');
                $this->db->where("tb_jabatan.nma_jbtn","manajer");
                $this->db->or_where("tb_jabatan.nma_jbtn","kepala");
                $this->db->where("tb_jabatan.nma_jbtn !=",$this->session->userdata("jabatan"));
            }
            else if ($jabatan == "sendiri")
            {
                $this->db->where("id_pgw !=",$this->session->userdata("id_pgw"));
            }
            else
            {
                $this->db->join('tb_jabatan','tb_jabatan.id_jbtn = tb_pegawai.id_jbtn');
                $this->db->where("tb_jabatan.div_jbtn",$this->session->userdata("divisi"));
                $this->db->where("tb_jabatan.nma_jbtn !=",$this->session->userdata("jabatan"));
            }
        }
        $result = $this->db->get()->result();

        return $result;
    }

    function pelatihan()
    {
        $this->db->join('tb_pegawai', 'tb_pegawai.id_pgw = tb_notif.id_pgw');
        $this->db->join('tb_jabatan','tb_jabatan.id_jbtn = tb_pegawai.id_jbtn');
        $this->db->order_by("id_notif","desc");
        return $this->db->get_where('tb_notif',array('jenis_notif' => "pelatihan", 'status_notif' => 'n'),5)->result();
    }

    function notif()
    {
        $jabatan = $this->session->userdata('jabatan');
        $divisi = $this->session->userdata('divisi');
        $id_pgw = $this->session->userdata('id_pgw');

        $this->db->select();
        $this->db->from("tb_jabatan");
        $this->db->where("nma_jbtn like","sv%");
        $this->db->or_where("nma_jbtn like","staff%");
        $jbt_d = $this->db->get()->result();

        foreach ($jbt_d as $jbt_df)
        {
            $jabatan_sv_st[] = $jbt_df->nma_jbtn;
        }

        $izin_terima = null;
        $pelatihan_terima = null;
        $izin = null;
        $pelatihan = null;
        $peringatan = null;

        if ($jabatan == "kepala")
        {
            if ($this->session->userdata("hak") == "admin")
            {
                $this->db->join('tb_pegawai', 'tb_pegawai.id_pgw = tb_notif.id_pgw');
                $this->db->join('tb_jabatan','tb_jabatan.id_jbtn = tb_pegawai.id_jbtn');
                $this->db->where('tb_jabatan.div_jbtn',$divisi);
                $this->db->where('tb_jabatan.nma_jbtn !=',$jabatan);
                $this->db->order_by("id_notif","desc");
                $izin = $this->db->get_where('tb_notif',array('jenis_notif' => "izin", 'status_notif' => 'n'),5)->result();

                $this->db->join('tb_pegawai', 'tb_pegawai.id_pgw = tb_notif.id_pgw');
                $this->db->join('tb_jabatan','tb_jabatan.id_jbtn = tb_pegawai.id_jbtn');
                $this->db->where('tb_jabatan.div_jbtn',$divisi);
                $this->db->where('tb_jabatan.nma_jbtn !=',$jabatan);
                $this->db->order_by("id_notif","desc");
                $pelatihan = $this->db->get_where('tb_notif',array('jenis_notif' => "pelatihan", 'status_notif' => 'n'),5)->result();
            }
            else if ($this->session->userdata("hak") == "user")
            {
                $this->db->join('tb_pegawai', 'tb_pegawai.id_pgw = tb_notif.id_pgw');
                $this->db->join('tb_jabatan','tb_jabatan.id_jbtn = tb_pegawai.id_jbtn');
                $this->db->where('tb_notif.id_pgw',$id_pgw);
                $this->db->order_by("id_notif","desc");
                $izin_terima = $this->db->get_where('tb_notif',array('jenis_notif' => "izin", 'status_notif' => 'y'),5)->result();
                
                $this->db->join('tb_pegawai', 'tb_pegawai.id_pgw = tb_notif.id_pgw');
                $this->db->join('tb_jabatan','tb_jabatan.id_jbtn = tb_pegawai.id_jbtn');
                $this->db->where('tb_notif.id_pgw',$id_pgw);
                $this->db->order_by("id_notif","desc");
                $pelatihan_terima = $this->db->get_where('tb_notif',array('jenis_notif' => "pelatihan", 'status_notif' => 'y'),5)->result();
            }
        }
        else if ($jabatan == "manajer")
        {
            $this->db->join('tb_pegawai', 'tb_pegawai.id_pgw = tb_notif.id_pgw');
            $this->db->join('tb_jabatan','tb_jabatan.id_jbtn = tb_pegawai.id_jbtn');
            $this->db->where('tb_jabatan.div_jbtn',$divisi);
            $this->db->where('tb_jabatan.nma_jbtn !=',$jabatan);
            $this->db->order_by("id_notif","desc");
            $izin = $this->db->get_where('tb_notif',array('jenis_notif' => "izin", 'status_notif' => 'n'),5)->result();

            $this->db->join('tb_pegawai', 'tb_pegawai.id_pgw = tb_notif.id_pgw');
            $this->db->join('tb_jabatan','tb_jabatan.id_jbtn = tb_pegawai.id_jbtn');
            $this->db->where('tb_notif.id_pgw',$id_pgw);
            $this->db->order_by("id_notif","desc");
            $izin_terima = $this->db->get_where('tb_notif',array('jenis_notif' => "izin", 'status_notif' => 'y'),5)->result();

            $this->db->join('tb_pegawai', 'tb_pegawai.id_pgw = tb_notif.id_pgw');
            $this->db->join('tb_jabatan','tb_jabatan.id_jbtn = tb_pegawai.id_jbtn');
            $this->db->where('tb_jabatan.div_jbtn',$divisi);
            $this->db->where('tb_jabatan.nma_jbtn !=',$jabatan);
            $this->db->order_by("id_notif","desc");
            $pelatihan = $this->db->get_where('tb_notif',array('jenis_notif' => "pelatihan", 'status_notif' => 'n'),5)->result();

            $this->db->join('tb_pegawai', 'tb_pegawai.id_pgw = tb_notif.id_pgw');
            $this->db->join('tb_jabatan','tb_jabatan.id_jbtn = tb_pegawai.id_jbtn');
            $this->db->where('tb_notif.id_pgw',$id_pgw);
            $this->db->order_by("id_notif","desc");
            $pelatihan_terima = $this->db->get_where('tb_notif',array('jenis_notif' => "pelatihan", 'status_notif' => 'y'),5)->result();
        }
        else if ($jabatan == "direktur utama")
        {
            $this->db->join('tb_pegawai', 'tb_pegawai.id_pgw = tb_notif.id_pgw');
            $this->db->join('tb_jabatan','tb_jabatan.id_jbtn = tb_pegawai.id_jbtn');
            $this->db->where('tb_jabatan.nma_jbtn =',"manajer");
            $this->db->or_where('tb_jabatan.nma_jbtn =',"kepala");
            $this->db->where('tb_jabatan.nma_jbtn !=',$jabatan);
            $this->db->order_by("id_notif","desc");
            $izin = $this->db->get_where('tb_notif',array('jenis_notif' => "izin", 'status_notif' => 'n'),5)->result();

            $this->db->join('tb_pegawai', 'tb_pegawai.id_pgw = tb_notif.id_pgw');
            $this->db->join('tb_jabatan','tb_jabatan.id_jbtn = tb_pegawai.id_jbtn');
            $this->db->where('tb_jabatan.nma_jbtn =',"manajer");
            $this->db->or_where('tb_jabatan.nma_jbtn =',"kepala");
            $this->db->where('tb_jabatan.nma_jbtn !=',$jabatan);
            $this->db->order_by("id_notif","desc");
            $pelatihan = $this->db->get_where('tb_notif',array('jenis_notif' => "pelatihan", 'status_notif' => 'n'),5)->result();
        }
        else if (in_array($jabatan, $jabatan_sv_st))
        {
            $this->db->join('tb_pegawai', 'tb_pegawai.id_pgw = tb_notif.id_pgw');
            $this->db->join('tb_jabatan','tb_jabatan.id_jbtn = tb_pegawai.id_jbtn');
            $this->db->where('tb_notif.id_pgw',$id_pgw);
            $this->db->order_by("id_notif","desc");
            $izin_terima = $this->db->get_where('tb_notif',array('jenis_notif' => "izin", 'status_notif' => 'y'),5)->result();

            $this->db->join('tb_pegawai', 'tb_pegawai.id_pgw = tb_notif.id_pgw');
            $this->db->join('tb_jabatan','tb_jabatan.id_jbtn = tb_pegawai.id_jbtn');
            $this->db->where('tb_notif.id_pgw',$id_pgw);
            $this->db->order_by("id_notif","desc");
            $pelatihan_terima = $this->db->get_where('tb_notif',array('jenis_notif' => "pelatihan", 'status_notif' => 'y'),5)->result();
        }
        

        if ($this->session->userdata("hak") == "admin")
        {
        	$this->db->join('tb_pegawai', 'tb_pegawai.id_pgw = tb_notif.id_pgw');
            $this->db->order_by("id_notif","desc");
        	$peringatan = $this->db->get_where('tb_notif',array('jenis_notif' => "peringatan", 'status_notif' => 'n'),5)->result();
        }
        else if ($this->session->userdata("hak") == "user")
        {
            $this->db->join('tb_pegawai', 'tb_pegawai.id_pgw = tb_notif.id_pgw');
            $this->db->order_by("status_notif","desc");
            $this->db->order_by("id_notif","desc");
            $peringatan = $this->db->get_where('tb_notif',array('tb_notif.id_pgw' => $this->session->userdata("id_pgw"),'jenis_notif' => "peringatan"),5)->result();
        }

        $data = new stdclass();
        $data->izin_terima = $izin_terima;
        $data->pelatihan_terima = $pelatihan_terima;
        $data->izin = $izin;
        $data->peringatan = $peringatan;
        $data->pelatihan = $pelatihan;

        return $data;
    }
}