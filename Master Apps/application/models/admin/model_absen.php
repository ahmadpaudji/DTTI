<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_absen extends Model_tambahan
{
    function last_upload()
    {
        $this->db->select("MAX(id_last_upload), MAX(tanggal) as tanggal");
        $this->db->from("tb_last_upload");
        return $this->db->get()->row();
    }

    function index($halaman)
    {
        if ($halaman == "admin")
        {
            date_default_timezone_set("Asia/Jakarta");
            $this->db->select();
            $this->db->from('tb_presensi');
            $result = $this->db->get()->result();
        }
        else if ($halaman == "user")
        {
            $this->db->select();
            $this->db->from("tb_presensi");
            $this->db->join("tb_akun","tb_akun.no_akun_pgw = tb_presensi.no_akun_pgw");
            $this->db->join("tb_pegawai","tb_pegawai.id_pgw = tb_akun.id_pgw");
            if ($this->input->post("tanggal_awal") != '')
            {
                $tgl_awal = explode('/', $this->input->post('tanggal_awal'));
                $tanggal_awal = $tgl_awal[2].'-'.$tgl_awal[0].'-'.$tgl_awal[1];
                $this->db->where("tgl_prs >=",$tanggal_awal);
            }
            if ($this->input->post("tanggal_akhir") != '')
            {
                $tgl_akhir = explode('/', $this->input->post('tanggal_akhir'));
                $tanggal_akhir = $tgl_akhir[2].'-'.$tgl_akhir[0].'-'.$tgl_akhir[1];
                $this->db->where("tgl_prs <=",$tanggal_akhir);
            }
            if ($this->input->post("status") != '')
            {
                $this->db->where("stat_prs",$this->input->post("status"));
            }
            $this->db->where("tb_pegawai.id_pgw",$this->session->userdata('id_pgw'));
            $this->db->order_by("id_prs","desc");
            $result = $this->db->get()->result();
        }

        return $result;
    }

    function presensi()
    {
        $this->db->select();
        $this->db->from("tb_presensi");
        $this->db->join("tb_akun","tb_akun.no_akun_pgw = tb_presensi.no_akun_pgw");
        $this->db->join("tb_pegawai","tb_pegawai.id_pgw = tb_akun.id_pgw");
        if ($this->input->post("tanggal_awal") != '')
        {
            $tgl_awal = explode('/', $this->input->post('tanggal_awal'));
            $tanggal_awal = $tgl_awal[2].'-'.$tgl_awal[0].'-'.$tgl_awal[1];
            $this->db->where("tgl_prs >=",$tanggal_awal);
        }
        if ($this->input->post("tanggal_akhir") != '')
        {
            $tgl_akhir = explode('/', $this->input->post('tanggal_akhir'));
            $tanggal_akhir = $tgl_akhir[2].'-'.$tgl_akhir[0].'-'.$tgl_akhir[1];
            $this->db->where("tgl_prs <=",$tanggal_akhir);
        }
        if ($this->input->post("pegawai") != '')
        {
            $this->db->where("tb_pegawai.id_pgw",$this->input->post("pegawai"));
        }
        if ($this->input->post("status") != '')
        {
            $this->db->where("stat_prs",$this->input->post("status"));
        }
        $this->db->order_by("id_prs","desc");
        return $this->db->get()->result();
    }

    function ubah($id_prs)
    {
        return $this->db->get_where('tb_presensi',array('id_prs' => $id_prs))->row();
    }

    function aksi_ubah($id_prs)
    {
        if ($this->input->post('status') == "hadir")
        {
            $masuk = strtotime("07.30");
            $telat1 = strtotime("08.30");
            $telat2 = strtotime("09.30");
            $telat3 = strtotime("10.30");
            $alpha = strtotime("12.00");

            $jam_masuk = $this->input->post('jam');
            $jam_keluar = $this->input->post('jamklr');
            $tlt_prs = "00:00";

            if (strtotime($jam_masuk) >= $telat3)
            {
                $tlt_prs = date("H:i",strtotime($jam_masuk)-$masuk);
            }
            else if (strtotime($jam_masuk) >= $telat2)
            {
                $tlt_prs = date("H:i",strtotime($jam_masuk)-$masuk);
            }
            else if (strtotime($jam_masuk) >= $telat1)
            {
                $tlt_prs = date("H:i",strtotime($jam_masuk)-$masuk); 
            }

            $presensi = array (
                'jm_msk_prs' => $jam_masuk,
                'jm_klr_prs'=> $jam_keluar,
                'tlt_prs' => $tlt_prs,
                'stat_prs' => $this->input->post('status'),
                'wkt_krj' => date("H:i",strtotime($jam_keluar)-strtotime($jam_masuk))
                );

            if ($this->db->where('id_prs',$id_prs)->update('tb_presensi',$presensi))
            {
                return true;
            }
            else
            {
                return false;
            }

        }
        else
        {
            $presensi = array (
                'stat_prs' => $this->input->post('status')
                );

            if ($this->db->where('id_prs',$id_prs)->update('tb_presensi',$presensi)) 
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    }

    function upload($dataarray)
    {
        date_default_timezone_set("Asia/Jakarta");
        $masuk = strtotime("07.30");
        $telat1 = strtotime("08.00");
        $telat2 = strtotime("09.30");
        $telat3 = strtotime("10.30");
        $alpha = strtotime("12.00");
        $berhasil = false;
        
        $result = $this->db->get('tb_akun')->result();
        $result2 = $this->db->get('tb_presensi')->result();
        $result3 = $this->db->get('tb_tanggal_libur')->result();
        $akun = array();
        $jumlah_tanggal = array();
        $tanggal_ada = array();
        $bln_thn = array();
        $bln = array();
        $tgl = array();
        $tgl_input = array();
        $libur = array();
        $tanggal_excel = array();
        $i_tgl = array();

        for ($i=1; $i < 10 ; $i++)
        {
            $i_tgl[] = $i;
        }

        for($i=1;$i<count($dataarray);$i++)
        {
            $tanggal[] = $dataarray[$i]['tgl_prs'];
        }

        foreach ($result as $res)
        {
            $akun[] = $res->no_akun_pgw;
        }

        foreach ($result2 as $res2)
        {
            if (!in_array($res2->tgl_prs, $tanggal_ada))
            {
                $tanggal_ada[] = $res2->tgl_prs;
            }
        }

        foreach ($result3 as $res)
        {
            $libur[] = $res->tgl_libur;
        }

        for($i=1;$i<=count($dataarray);$i++)
        {
            $bulan = explode('-', $dataarray[$i]['tgl_prs']);
            if (!in_array($bulan[1], $bln))
            {
                $bln_thn[] = $bulan[0].'-'.$bulan[1];
                $bln[] = $bulan[1];
            }
        }

        $max_tgl_bln_f = date('t',mktime(0,0,0,$bln[0],1,date('Y')));
        $max_tgl_bln_l = date('t',mktime(0,0,0,$bln[1],1,date('Y')));

        for ($i=21 ; $i <= $max_tgl_bln_f ; $i++)
        {
            $tgl_input[] = $bln_thn[0].'-'.$i;
        }

        for ($i=1 ; $i <= 20 ; $i++)
        {
            if (in_array($i, $i_tgl))
            {
                $tgl_input[] = $bln_thn[1].'-0'.$i;
            }
            else
            {
                $tgl_input[] = $bln_thn[1].'-'.$i;
            }
        }
       
        for($i=0;$i<count($tgl_input);$i++)
        {
            if (!in_array($tgl_input[$i], $jumlah_tanggal) && !in_array($tgl_input[$i], $tanggal_ada))
            {
                $jumlah_tanggal[] = $tgl_input[$i];
            }
        }

        foreach ($jumlah_tanggal as $tg)
        {
            foreach ($akun as $akn)
            {
                if (in_array($tg, $libur))
                {
                    $stat_prs = 'libur';
                }
                else
                {
                    $stat_prs = 'alpha';
                }

                $data = array(
                    'no_akun_pgw' => $akn,
                    'tgl_prs' => $tg,
                    'stat_prs' => $stat_prs
                    );

                $this->db->insert('tb_presensi', $data);
            }
        }

        for($i=1;$i<count($dataarray);$i++)
        {
            $status = "";
            $tlt_prs = "00:00";

            if (strtotime($dataarray[$i]['jm_msk_prs']) <= $alpha)
            {
                $status = "hadir";
            }
            else
            {
                $status = "alpha";
            }

            if (strtotime($dataarray[$i]['jm_msk_prs']) >= $telat3)
            {
                $tlt_prs = date("H:i",strtotime($dataarray[$i]['jm_msk_prs'])-$masuk);
            }
            else if (strtotime($dataarray[$i]['jm_msk_prs']) >= $telat2)
            {
                $tlt_prs = date("H:i",strtotime($dataarray[$i]['jm_msk_prs'])-$masuk);
            }
            else if (strtotime($dataarray[$i]['jm_msk_prs']) >= $telat1)
            {
                $tlt_prs = date("H:i",strtotime($dataarray[$i]['jm_msk_prs'])-$masuk); 
            }
            
            $data = array(
                'jm_msk_prs' => $dataarray[$i]['jm_msk_prs'],
                'jm_klr_prs'=> $dataarray[$i]['jm_klr_prs'],
                'tlt_prs' => $tlt_prs,
                'stat_prs' => $status,
                'wkt_krj' => date("H:i",strtotime($dataarray[$i]['jm_klr_prs'])-strtotime($dataarray[$i]['jm_msk_prs']))
                );

            if (in_array($dataarray[$i]['tgl_prs'], $jumlah_tanggal))
            {
                if ($this->db->where('no_akun_pgw',$dataarray[$i]['no_akun_pgw'])->where('tgl_prs',$dataarray[$i]['tgl_prs'])->update('tb_presensi',$data))
                {
                    $berhasil = true;
                }
                else
                {
                    return false;
                }
            }
            else
            {
                $berhasil = true;
            }
        }

        if ($berhasil)
        {
            date_default_timezone_set("Asia/Jakarta");
            $up = array(
                    'tanggal' => date("Y-m-d",now())
                    );

            $this->db->insert('tb_last_upload', $up);
            if ($jumlah_tanggal != null)
            {
            $this->db->select("no_akun_pgw,tb_akun.id_pgw,nma_lkp_pgw");
            $this->db->from("tb_akun");
            $this->db->join("tb_pegawai","tb_pegawai.id_pgw = tb_akun.id_pgw");
            $pegawai = $this->db->get()->result_array();

            $i = 0;
            $status = array('alpha','cuti','hadir','ijin','sakit','tugas');
            foreach ($pegawai as $k)
            {
                foreach($status as $stat)
                {
                    $this->db->where("tgl_prs >=",min($jumlah_tanggal));
                    $this->db->where("tgl_prs <=",max($jumlah_tanggal));

                    $this->db->where('no_akun_pgw', $k['no_akun_pgw']);

                    $this->db->where("stat_prs", $stat);
                    $pegawai[$i][$stat] = count($this->db->get('tb_presensi')->result_array());
                }

                $i++;
            }

                foreach ($pegawai as $pgw)
                {
                    $status = '';
                    $peringatan = '';

                    if ($pgw["alpha"] > 5 || $pgw["telat"] > 16)
                    {
                        $peringatan = "SP 3";

                        if ($pgw["alpha"] > 5)
                        {
                            $status = "tidak masuk selama ".$pgw["alpha"]." hari";
                        }
                        else
                        {
                            $status = "terlambat masuk selama".$pgw["telat"]." hari";
                        }
                    }
                    else if ($pgw["alpha"] > 3 || $pgw["telat"] > 13)
                    {
                        $peringatan = "SP 2";

                        if ($pgw["alpha"] > 3)
                        {
                            $status = "tidak masuk selama ".$pgw["alpha"]." hari";
                        }
                        else
                        {
                            $status = "terlambat masuk selama".$pgw["telat"]." hari";
                        }
                    }
                    else if ($pgw["alpha"] > 1 || $pgw["telat"] > 6)
                    {
                        $peringatan = "SP 1";

                        if ($pgw["alpha"] > 1)
                        {
                            $status = "tidak masuk selama ".$pgw["alpha"]." hari";
                        }
                        else
                        {
                            $status = "terlambat masuk selama".$pgw["telat"]." hari";
                        }
                    }
                    else if ($pgw["alpha"] == 1 || $pgw["telat"] > 2)
                    {
                        $peringatan = "Teguran";

                        if ($pgw["alpha"] == 1)
                        {
                            $status = "tidak masuk selama ".$pgw["alpha"]." hari";
                        }
                        else
                        {
                            $status = "terlambat masuk selama".$pgw["telat"]." hari";
                        }
                    }

                    if ($status != '')
                    {
                        $ntf = array(
                            'id_pgw' => $pgw['id_pgw'],
                            'waktu_notif' => unix_to_human(now(),TRUE,'eu'),
                            'ket_notif' => $peringatan." karena ".$status,
                            'status_notif' => 'n',
                            'jenis_notif' => 'peringatan'
                            );

                        $this->db->insert('tb_notif', $ntf);
                    }
                }
            }

            return true;
        }
        else
        {
            return false;
        }
    }

    function rekap()
    {
        if ($this->input->post("pegawai") != '')
        {
            $this->db->select("no_akun_pgw,tb_akun.id_pgw,nma_lkp_pgw");
            $this->db->from("tb_akun");
            $this->db->join("tb_pegawai","tb_pegawai.id_pgw = tb_akun.id_pgw");
            $this->db->where('tb_akun.id_pgw',$this->input->post('pegawai'));
            $pegawai = $this->db->get()->result_array();
        }
        else
        {
            $this->db->select("no_akun_pgw,tb_akun.id_pgw,nma_lkp_pgw");
            $this->db->from("tb_akun");
            $this->db->join("tb_pegawai","tb_pegawai.id_pgw = tb_akun.id_pgw");
            $pegawai = $this->db->get()->result_array();
        }
        
        $i = 0;
        $status = array('alpha','cuti','hadir','ijin','sakit','tugas');
        foreach ($pegawai as $k)
        {
            foreach($status as $stat)
            {
                if ($this->input->post("tanggal_awal") != '')
                {
                    $tgl_awal = explode('/', $this->input->post('tanggal_awal'));
                    $tanggal_awal = $tgl_awal[2].'-'.$tgl_awal[0].'-'.$tgl_awal[1];
                    $this->db->where("tgl_prs >=",$tanggal_awal);
                }
                if ($this->input->post("tanggal_akhir") != '')
                {
                    $tgl_akhir = explode('/', $this->input->post('tanggal_akhir'));
                    $tanggal_akhir = $tgl_akhir[2].'-'.$tgl_akhir[0].'-'.$tgl_akhir[1];
                    $this->db->where("tgl_prs <=",$tanggal_akhir);
                }  
                
                $this->db->where('no_akun_pgw', $k['no_akun_pgw']);
                
                $this->db->where("stat_prs", $stat);
                $pegawai[$i][$stat] = count($this->db->get('tb_presensi')->result_array());
            }

            $i++;
        }
        return $pegawai;
    }
}