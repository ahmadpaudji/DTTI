<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_beranda extends Model_tambahan
{
    function index()
    {
        date_default_timezone_set("Asia/Jakarta");
        $hari_ini = date("Y-m-d");
        $bln_ini = date('m');
        $thn_ini = date('Y');
        
        if ($this->session->userdata("hak") == 'admin')
        {
            //Presensi
            $alpha_b = $this->db->get_where("tb_presensi",array('stat_prs' => 'alpha', 'MONTH(tgl_prs)' => $bln_ini))->result();
            $alpha_t = $this->db->get_where("tb_presensi",array('stat_prs' => 'alpha', 'YEAR(tgl_prs)' => $thn_ini))->result();

            $cuti_b = $this->db->get_where("tb_presensi",array('stat_prs' => 'cuti', 'MONTH(tgl_prs)' => $bln_ini))->result();
            $cuti_t = $this->db->get_where("tb_presensi",array('stat_prs' => 'cuti', 'YEAR(tgl_prs)' => $thn_ini))->result();

            $hadir_b = $this->db->get_where("tb_presensi",array('stat_prs' => 'hadir', 'MONTH(tgl_prs)' => $bln_ini))->result();
            $hadir_t = $this->db->get_where("tb_presensi",array('stat_prs' => 'hadir', 'YEAR(tgl_prs)' => $thn_ini))->result();

            $ijin_b = $this->db->get_where("tb_presensi",array('stat_prs' => 'ijin', 'MONTH(tgl_prs)' => $bln_ini))->result();
            $ijin_t = $this->db->get_where("tb_presensi",array('stat_prs' => 'ijin', 'YEAR(tgl_prs)' => $thn_ini))->result();

            $sakit_b = $this->db->get_where("tb_presensi",array('stat_prs' => 'sakit', 'MONTH(tgl_prs)' => $bln_ini))->result();
            $sakit_t = $this->db->get_where("tb_presensi",array('stat_prs' => 'sakit', 'YEAR(tgl_prs)' => $thn_ini))->result();

            $tugas_b = $this->db->get_where("tb_presensi",array('stat_prs' => 'tugas', 'MONTH(tgl_prs)' => $bln_ini))->result();
            $tugas_t = $this->db->get_where("tb_presensi",array('stat_prs' => 'tugas', 'YEAR(tgl_prs)' => $thn_ini))->result();

            $telat_b = $this->db->get_where("tb_presensi",array('tlt_prs >' => '00:00:00', 'MONTH(tgl_prs)' => $bln_ini))->result();
            $telat_t = $this->db->get_where("tb_presensi",array('tlt_prs >' => '00:00:00', 'YEAR(tgl_prs)' => $thn_ini))->result();

            //pelatihan
            $setuju_h = $this->db->get_where("tb_pelatihan",array('stat_lth' => 'Y', 'tgl_pjn_lth' => $hari_ini))->result();
            $setuju_b = $this->db->get_where("tb_pelatihan",array('stat_lth' => 'Y', 'MONTH(tgl_pjn_lth)' => $bln_ini))->result();
            $setuju_t = $this->db->get_where("tb_pelatihan",array('stat_lth' => 'Y', 'YEAR(tgl_pjn_lth)' => $thn_ini))->result();

            $tolak_h = $this->db->get_where("tb_pelatihan",array('stat_lth' => 'T', 'tgl_pjn_lth' => $hari_ini))->result();
            $tolak_b = $this->db->get_where("tb_pelatihan",array('stat_lth' => 'T', 'MONTH(tgl_pjn_lth)' => $bln_ini))->result();
            $tolak_t = $this->db->get_where("tb_pelatihan",array('stat_lth' => 'T', 'YEAR(tgl_pjn_lth)' => $thn_ini))->result();

            $blm_h = $this->db->get_where("tb_pelatihan",array('stat_lth' => 'N', 'tgl_pjn_lth' => $hari_ini))->result();
            $blm_b = $this->db->get_where("tb_pelatihan",array('stat_lth' => 'N', 'MONTH(tgl_pjn_lth)' => $bln_ini))->result();
            $blm_t = $this->db->get_where("tb_pelatihan",array('stat_lth' => 'N', 'YEAR(tgl_pjn_lth)' => $thn_ini))->result();

            $this->db->select("no_akun_pgw,tb_akun.id_pgw,nma_lkp_pgw");
            $this->db->from("tb_akun");
            $this->db->join("tb_pegawai","tb_pegawai.id_pgw = tb_akun.id_pgw");
            $pegawai = $this->db->get()->result_array();
            
            $hari = explode('-', $hari_ini);
            if ($hari[2] >= 21)
            {
                $tgl_awal = $thn_ini.'-'.$bln_ini.'-21';
                $tgl_akhir = $thn_ini.'-'.($bln_ini+1).'-20';
            }
            else
            {
                $tgl_awal = $thn_ini.'-'.($bln_ini-1).'-21';
                $tgl_akhir = $thn_ini.'-'.$bln_ini.'-20';
            }

            $i = 0;
            $status = array('alpha','telat');
            foreach ($pegawai as $k)
            {
                foreach($status as $stat)
                {
                    $this->db->where("tgl_prs >=",$tgl_awal);
                    $this->db->where("tgl_prs <=",$tgl_akhir);
                    
                    $this->db->where('no_akun_pgw', $k['no_akun_pgw']);
                    
                    $this->db->where("stat_prs", 'alpha');
                    $this->db->or_where("tlt_prs >", '00:00:00');
                    
                    $pegawai[$i][$stat] = count($this->db->get('tb_presensi')->result_array());
                }

                $i++;
            }
        }
        else if ($this->session->userdata("hak") == 'user')
        {
            $id_pgw = $this->session->userdata('id_pgw');
            $no_akun_pgw = $this->db->get_where("tb_akun",array('id_pgw' => $id_pgw))->row()->no_akun_pgw;

            //Presensi
            $alpha_b = $this->db->get_where("tb_presensi",array('stat_prs' => 'alpha', 'MONTH(tgl_prs)' => $bln_ini, 'no_akun_pgw' => $no_akun_pgw))->result();
            $alpha_t = $this->db->get_where("tb_presensi",array('stat_prs' => 'alpha', 'YEAR(tgl_prs)' => $thn_ini, 'no_akun_pgw' => $no_akun_pgw))->result();

            $cuti_b = $this->db->get_where("tb_presensi",array('stat_prs' => 'cuti', 'MONTH(tgl_prs)' => $bln_ini, 'no_akun_pgw' => $no_akun_pgw))->result();
            $cuti_t = $this->db->get_where("tb_presensi",array('stat_prs' => 'cuti', 'YEAR(tgl_prs)' => $thn_ini, 'no_akun_pgw' => $no_akun_pgw))->result();

            $hadir_b = $this->db->get_where("tb_presensi",array('stat_prs' => 'hadir', 'MONTH(tgl_prs)' => $bln_ini, 'no_akun_pgw' => $no_akun_pgw))->result();
            $hadir_t = $this->db->get_where("tb_presensi",array('stat_prs' => 'hadir', 'YEAR(tgl_prs)' => $thn_ini, 'no_akun_pgw' => $no_akun_pgw))->result();

            $ijin_b = $this->db->get_where("tb_presensi",array('stat_prs' => 'ijin', 'MONTH(tgl_prs)' => $bln_ini, 'no_akun_pgw' => $no_akun_pgw))->result();
            $ijin_t = $this->db->get_where("tb_presensi",array('stat_prs' => 'ijin', 'YEAR(tgl_prs)' => $thn_ini, 'no_akun_pgw' => $no_akun_pgw))->result();

            $sakit_b = $this->db->get_where("tb_presensi",array('stat_prs' => 'sakit', 'MONTH(tgl_prs)' => $bln_ini, 'no_akun_pgw' => $no_akun_pgw))->result();
            $sakit_t = $this->db->get_where("tb_presensi",array('stat_prs' => 'sakit', 'YEAR(tgl_prs)' => $thn_ini, 'no_akun_pgw' => $no_akun_pgw))->result();

            $tugas_b = $this->db->get_where("tb_presensi",array('stat_prs' => 'tugas', 'MONTH(tgl_prs)' => $bln_ini, 'no_akun_pgw' => $no_akun_pgw))->result();
            $tugas_t = $this->db->get_where("tb_presensi",array('stat_prs' => 'tugas', 'YEAR(tgl_prs)' => $thn_ini, 'no_akun_pgw' => $no_akun_pgw))->result();

            $telat_b = $this->db->get_where("tb_presensi",array('tlt_prs >' => '00:00:00', 'MONTH(tgl_prs)' => $bln_ini, 'no_akun_pgw' => $no_akun_pgw))->result();
            $telat_t = $this->db->get_where("tb_presensi",array('tlt_prs >' => '00:00:00', 'YEAR(tgl_prs)' => $thn_ini, 'no_akun_pgw' => $no_akun_pgw))->result();
        }

        $data = new stdClass();
        $data->alpha_b = count($alpha_b);
        $data->alpha_t = count($alpha_t);
        $data->cuti_b = count($cuti_b);
        $data->cuti_t = count($cuti_t);
        $data->hadir_b = count($hadir_b);
        $data->hadir_t = count($hadir_t);
        $data->ijin_b = count($ijin_b);
        $data->ijin_t = count($ijin_t);
        $data->sakit_b = count($sakit_b);
        $data->sakit_t = count($sakit_t);
        $data->tugas_b = count($tugas_b);
        $data->tugas_t = count($tugas_t);
        $data->telat_b = count($telat_b);
        $data->telat_t = count($telat_t);

        if ($this->session->userdata("hak") == 'admin')
        {
            $data->setuju_h = count($setuju_h);
            $data->setuju_b = count($setuju_b);
            $data->setuju_t = count($setuju_t);
            $data->tolak_h = count($tolak_h);
            $data->tolak_b = count($tolak_b);
            $data->tolak_t = count($tolak_t);
            $data->blm_h = count($blm_h);
            $data->blm_b = count($blm_b);
            $data->blm_t = count($blm_t);
            $data->pegawai = $pegawai;
        }

        return $data;
    }
}