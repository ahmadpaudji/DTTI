<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_beranda extends Model_tambahan
{
    function index()
    {
        date_default_timezone_set("Asia/Jakarta");
        $hari_ini = date("Y-m-d");
        $bln_ini = date('m');
        $thn_ini = date('Y');
        
        if ($this->session->userdata("hak") == 'admin' || $this->session->userdata("hak") == "super user")
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

//Muhasabah periode

        $tgl = date("d");
        $bln = date("m");
        $thn = date("Y");

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

        if ($this->session->userdata('hak') == "user")
        {
            $pegawai = $this->db->select('nma_lkp_pgw,id_pgw')->where('id_pgw',$this->session->userdata('id_pgw'))->get('tb_pegawai')->result_array();
        }
        else
        {
            $pegawai = $this->db->select('nma_lkp_pgw,id_pgw')->get('tb_pegawai')->result_array();
        }

        $total_pgw = count($pegawai);
        $i = 0;
        $muhasabah = array('thj_mhb','sdq_mhb','psa_mhb','alq_mhb');
        foreach ($pegawai as $k)
        {
            foreach($muhasabah as $m)
            {
                $this->db->where("tgl_mhb >=",$tanggal_awal);
                $this->db->where("tgl_mhb <=",$tanggal_akhir);
                $this->db->where('id_pgw', $k['id_pgw']);
                $this->db->where($m, "Y");
                $jml = count($this->db->get('tb_muhasabah')->result_array());
                $hasil = 0;
                $persen = 0.25;

                if ($m == "psa_mhb")
                {
                    if ($jml > 8)
                    {
                        $hasil = (8/8)*$persen;
                    }
                    else
                    {
                        $hasil = ($jml/8)*$persen;
                    }
                }
                else
                {
                    if ($jml > 30)
                    {
                        $hasil = (30/30)*$persen;
                    }
                    else
                    {
                        $hasil = ($jml/30)*$persen;
                    }
                }

                $pegawai[$i][$m] = number_format($hasil*100,2);
            }

            $i++;
        }

        $puasa_p = 0;
        $tahajud_p = 0;
        $sodaqoh_p = 0;
        $alquran_p = 0;

        foreach ($pegawai as $pg)
        {
            $puasa_p = $puasa_p + $pg['psa_mhb'];
            $tahajud_p = $tahajud_p + $pg['thj_mhb'];
            $sodaqoh_p = $sodaqoh_p + $pg['sdq_mhb'];
            $alquran_p = $alquran_p + $pg['alq_mhb'];
        }

        if ($this->session->userdata('hak') == "user")
        {
            $total_p = $puasa_p + $tahajud_p + $sodaqoh_p + $alquran_p;

            $data->puasa_p = $puasa_p;
            $data->tahajud_p = $tahajud_p;
            $data->sodaqoh_p = $sodaqoh_p;
            $data->alquran_p = $alquran_p;
        }
        else
        {
            $total_p = ($puasa_p/$total_pgw) + ($tahajud_p/$total_pgw) + ($sodaqoh_p/$total_pgw) + ($alquran_p/$total_pgw);

            $data->puasa_p = ($puasa_p/$total_pgw);
            $data->tahajud_p = ($tahajud_p/$total_pgw);
            $data->sodaqoh_p = ($sodaqoh_p/$total_pgw);
            $data->alquran_p = ($alquran_p/$total_pgw);
        }
        $data->total_p = $total_p;

//Muhasabah tahun
        if ($this->session->userdata('hak') == "user")
        {
            $pegawai_t = $this->db->select('nma_lkp_pgw,id_pgw')->where('id_pgw',$this->session->userdata('id_pgw'))->get('tb_pegawai')->result_array();
        }
        else
        {
            $pegawai_t = $this->db->select('nma_lkp_pgw,id_pgw')->get('tb_pegawai')->result_array();
        }

        $i = 0;
        foreach ($pegawai_t as $k)
        {
            foreach($muhasabah as $m)
            {
                $this->db->where("year(tgl_mhb) =",$thn);
                $this->db->where('id_pgw', $k['id_pgw']);
                $this->db->where($m, "Y");
                $jml = count($this->db->get('tb_muhasabah')->result_array());
                $hasil = 0;
                $persen = 0.25;

                if ($m == "psa_mhb")
                {
                    if ($jml > 8)
                    {
                        $hasil = (8/8)*$persen;
                    }
                    else
                    {
                        $hasil = ($jml/8)*$persen;
                    }
                }
                else
                {
                    if ($jml > 30)
                    {
                        $hasil = (30/30)*$persen;
                    }
                    else
                    {
                        $hasil = ($jml/30)*$persen;
                    }
                }

                $pegawai_t[$i][$m] = number_format($hasil*100,2);
            }

            $i++;
        }

        $puasa_t = 0;
        $tahajud_t = 0;
        $sodaqoh_t = 0;
        $alquran_t = 0;

        foreach ($pegawai_t as $pg)
        {
            $puasa_t = $puasa_t + $pg['psa_mhb'];
            $tahajud_t = $tahajud_t + $pg['thj_mhb'];
            $sodaqoh_t = $sodaqoh_t + $pg['sdq_mhb'];
            $alquran_t = $alquran_t + $pg['alq_mhb'];
        }

        if ($this->session->userdata('hak') == "user")
        {
            $total_t = $puasa_t + $tahajud_t + $sodaqoh_t + $alquran_t;

            $data->puasa_t = $puasa_t;
            $data->tahajud_t = $tahajud_t;
            $data->sodaqoh_t = $sodaqoh_t;
            $data->alquran_t = $alquran_t;
        }
        else
        {
            $total_t = ($puasa_t/$total_pgw) + ($tahajud_t/$total_pgw) + ($sodaqoh_t/$total_pgw) + ($alquran_t/$total_pgw);

            $data->puasa_t = ($puasa_t/$total_pgw);
            $data->tahajud_t = ($tahajud_t/$total_pgw);
            $data->sodaqoh_t = ($sodaqoh_t/$total_pgw);
            $data->alquran_t = ($alquran_t/$total_pgw);
        }
        $data->total_t = $total_t;

        return $data;
    }
}