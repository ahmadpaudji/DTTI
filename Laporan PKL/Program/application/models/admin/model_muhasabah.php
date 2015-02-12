<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_muhasabah extends Model_tambahan
{
	function index($halaman)
    {
        if ($halaman == "pegawai")
        {
            $this->db->select();
            $this->db->from("tb_muhasabah");
            $this->db->join("tb_pegawai","tb_pegawai.id_pgw = tb_muhasabah.id_pgw");
            if ($this->input->post("tanggal_awal") != '')
            {
                $tgl_awal = explode('/', $this->input->post('tanggal_awal'));
                $tanggal_awal = $tgl_awal[2].'-'.$tgl_awal[0].'-'.$tgl_awal[1];
                $this->db->where("tgl_mhb >=",$tanggal_awal);
            }
            if ($this->input->post("tanggal_akhir") != '')
            {
                $tgl_akhir = explode('/', $this->input->post('tanggal_akhir'));
                $tanggal_akhir = $tgl_akhir[2].'-'.$tgl_akhir[0].'-'.$tgl_akhir[1];
                $this->db->where("tgl_mhb <=",$tanggal_akhir);
            }
            if ($this->input->post("pegawai") != '')
            {
                $this->db->where("tb_muhasabah.id_pgw",$this->input->post("pegawai"));
            }
            if ($this->session->userdata("hak") == "user")
            {
                $this->db->where("tb_muhasabah.id_pgw",$this->session->userdata('id_pgw'));
            }
            $this->db->order_by("id_mhb","desc");
            
            $data = $this->db->get()->result();
        }
        else
        {
            date_default_timezone_set("Asia/Jakarta"); 

            $this->db->select('DAY(tgl_mhb) as tanggal');
            $this->db->from('tb_muhasabah');
            $this->db->where('MONTH(tgl_mhb)', date('m'));
            $this->db->where('id_pgw', $this->session->userdata['id_pgw']);
            $result = $this->db->get()->result();

            $this->db->select('DAY(tgl_mhb) as tanggal');
            $this->db->from('tb_muhasabah');
            $this->db->where('MONTH(tgl_mhb)', date('m')-1);
            $this->db->where('id_pgw', $this->session->userdata['id_pgw']);
            $result2 = $this->db->get()->result();

            $data = new stdclass();
            $data->tgl = $result;
            $data->tgl_before = $result2;
        }
        return $data;
    }

    function aksi_tambah($tgl,$bln)
    {
        $alq = 'T';
        $thj = 'T';
        $sdq = 'T';
        $psa = 'T';

        if ($this->input->post('tahajud') == 'on') 
        {
            $thj = 'Y';
        }

        if ($this->input->post('tadarus') == 'on') 
        {
            $alq = 'Y';
        }

        if ($this->input->post('shodaqoh') == 'on') 
        {
            $sdq = 'Y';
        }

        if ($this->input->post('shaum') == 'on') 
        {
            $psa = 'Y';
        }

        $isi = array (
         'id_pgw' => $this->session->userdata['id_pgw'],
         'tgl_mhb' => unix_to_human(mktime(0, 0, 0, $bln, $tgl, date("Y")),true,'eu'),
         'alq_mhb' => $alq,
         'thj_mhb' => $thj,
         'sdq_mhb' => $sdq,
         'psa_mhb' => $psa
         );

        if ($this->db->insert('tb_muhasabah',$isi))
        {
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
            $pegawai = $this->db->select('nma_lkp_pgw,id_pgw')->get_where('tb_pegawai',array('id_pgw' =>$this->input->post("pegawai")))->result_array();
        }
        else
        {
            $pegawai = $this->db->select('nma_lkp_pgw,id_pgw')->get('tb_pegawai')->result_array();
        }
        
        $i = 0;
        $muhasabah = array('thj_mhb','sdq_mhb','psa_mhb','alq_mhb');
        foreach ($pegawai as $k)
        {
            foreach($muhasabah as $m)
            {
                if ($this->input->post("tanggal_awal") != '')
                {
                    $tgl_awal = explode('/', $this->input->post('tanggal_awal'));
                    $tanggal_awal = $tgl_awal[2].'-'.$tgl_awal[0].'-'.$tgl_awal[1];
                    $this->db->where("tgl_mhb >=",$tanggal_awal);
                }
                if ($this->input->post("tanggal_akhir") != '')
                {
                    $tgl_akhir = explode('/', $this->input->post('tanggal_akhir'));
                    $tanggal_akhir = $tgl_akhir[2].'-'.$tgl_akhir[0].'-'.$tgl_akhir[1];
                    $this->db->where("tgl_mhb <=",$tanggal_akhir);
                }  
                
                $this->db->where('id_pgw', $k['id_pgw']);
                
                $this->db->where($m, "Y");
                $pegawai[$i][$m] = count($this->db->get('tb_muhasabah')->result_array());
            }

            $i++;
        }
        return $pegawai;
    }

    function persentase($cari = null)
    {
        date_default_timezone_set("Asia/Jakarta");
        $tgl = date("d");
        $bln = date("m");
        $thn = date("Y");

        if ($cari == "cari" && $this->input->post('tanggal_periode') != '')
        {
            $tgl_per = explode('/', $this->input->post('tanggal_periode'));
            
            if ($tgl_per[0] != 12)
            {
                $tanggal_awal = $tgl_per[2].'-'.$tgl_per[0].'-21';
                $tanggal_akhir = $tgl_per[2].'-'.($tgl_per[0]+1).'-20';
            }
            else if ($tgl_per[0] == 12)
            {
                $tanggal_awal = $tgl_per[2].'-'.$tgl_per[0].'-21';
                $tanggal_akhir = ($tgl_per[2]+1).'-1-20';
            }
        }
        else if ($cari == "cari" && $this->input->post('tanggal_periode') == '' || $cari == '')
        {
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
        }

        if ($this->input->post("pegawai") != '')
        {
            $pegawai = $this->db->select('nma_lkp_pgw,id_pgw')->get_where('tb_pegawai',array('id_pgw' =>$this->input->post("pegawai")))->result_array();
        }
        else
        {
            $this->db->join('tb_jabatan','tb_jabatan.id_jbtn = tb_pegawai.id_jbtn');

            if ($this->session->userdata("jabatan") == "direktur marketing")
            {
                $this->db->where('tb_jabatan.div_jbtn','marketing');
            }
            else if ($this->session->userdata("jabatan") == "direktur operasional")
            {
                $this->db->where('div_jbtn','operasional');
            }
            
            $pegawai = $this->db->select('nma_lkp_pgw,id_pgw')->get('tb_pegawai')->result_array();
        }
        
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

        return $pegawai;
    }

    function cek_tgl($tgl,$bln)
    {
        $this->db->select();
        $this->db->from('tb_muhasabah');
        $this->db->where('tgl_mhb',unix_to_human(mktime(0, 0, 0, $bln, $tgl, date("Y")),true,'eu'));
        $this->db->where('id_pgw', $this->session->userdata['id_pgw']);
        $result = $this->db->get()->row();

        if ($result) 
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
        if ($this->session->flashdata("pegawai") != '')
        {
            $pegawai = $this->db->select('nma_lkp_pgw,id_pgw')->get_where('tb_pegawai',array('id_pgw' => $this->session->flashdata("pegawai")))->result_array();
        }
        else
        {
            $pegawai = $this->db->select('nma_lkp_pgw,id_pgw')->get('tb_pegawai')->result_array();
        }
        
        $i = 0;
        $muhasabah = array('thj_mhb','sdq_mhb','psa_mhb','alq_mhb');
        foreach ($pegawai as $k)
        {
            foreach($muhasabah as $m)
            {
                if ($this->session->flashdata("tgl_awl") != '')
                {
                    $tgl_awal = explode('/', $this->session->flashdata('tgl_awl'));
                    $tanggal_awal = $tgl_awal[2].'-'.$tgl_awal[0].'-'.$tgl_awal[1];
                    $this->db->where("tgl_mhb >=",$tanggal_awal);
                }
                if ($this->session->flashdata("tgl_akh") != '')
                {
                    $tgl_akhir = explode('/', $this->session->flashdata('tgl_akh'));
                    $tanggal_akhir = $tgl_akhir[2].'-'.$tgl_akhir[0].'-'.$tgl_akhir[1];
                    $this->db->where("tgl_mhb <=",$tanggal_akhir);
                }  
                
                $this->db->where('id_pgw', $k['id_pgw']);
                
                $this->db->where($m, "Y");
                $pegawai[$i][$m] = count($this->db->get('tb_muhasabah')->result_array());
            }

            $i++;
        }
        return $pegawai;
    }
}