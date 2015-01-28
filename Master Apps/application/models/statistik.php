	<?php

class Statistik extends CI_Model{


	public $awal = '';
	public $akhir = '';
	public $divisi = '';
	public $awal_presensi = '';
	public $akhir_presensi = '';

	public function __construct(){

		$date = date('Y-m-d');
		$date2 = $date;
		$date = explode('-', $date);
		
		if($date[1] > 1){
			$date[1] = (string)$date[1]-1;
			$date[2] = '1';
		}
		elseif($date[1] == 1){
			
			$date[1] = '12';
			$date[0]--;
			$date[2] = '1';
		}

		$akhir = date('t',mktime(0,0,0,$date[1],1,$date[0]));
		$bulan_awal = $date[1];
		$tanggal_awal = $date[2];
		$tahun_awal = $date[0];

		$bulan_akhir = $date[1];
		$tanggal_akhir = $akhir;
		$tahun_akhir = $date[0];
		
		$this->awal = $tahun_awal.'-'.$bulan_awal.'-'.$tanggal_awal;
		$this->akhir = $tahun_akhir.'-'.$bulan_akhir.'-'.$tanggal_akhir;


		
		$date = date('Y-m-d');
		$date = explode('-', $date);
		//var_dump($date);


		if($date[1] > 1){
			//var_dump('ewe');
			$bulan_awal = $date[1]-1;
			$tanggal_awal = '21';
			$tahun_awal = $date[0];

			$bulan_akhir = $date[1];
			$tanggal_akhir = '20';
			$tahun_akhir = $date[0];
					

		}
		elseif($date[1] == 1){
			
			$bulan_awal = '12';
			$tanggal_awal = '21';
			$tahun_awal = $date[0] - 1;

			$bulan_akhir = '01';
			$tanggal_akhir = '20';
			$tahun_akhir = $date[0];
		}
		
		$this->awal_presensi 	= $tahun_awal.'-'.$bulan_awal.'-'.$tanggal_awal;
		$this->akhir_presensi 	= $tahun_akhir.'-'.$bulan_akhir.'-'.$tanggal_akhir;
		var_dump($this->awal_presensi);
		var_dump($this->akhir_presensi);
	}



	public function presensi(){

		if($this->divisi != ''){
			$this->db->join('tb_akun','tb_akun.no_akun_pgw = tb_presensi.no_akun_pgw');
			$this->db->join('tb_pegawai','tb_pegawai.id_pgw = tb_akun.id_pgw');
			$this->db->where('id_jbtn',$this->divisi);
		}
		$this->db->group_by('tb_presensi.no_akun_pgw');
		$this->db->select('tb_presensi.no_akun_pgw AS no_pgw');
		$data = $this->db->get('tb_presensi')->result_array();

		$presensi = array('alpha','ijin','cuti','hadir','libur','sakit');

		foreach ($data as $key => $v) {
			
			$i = 0;
			$this->db->where('tb_akun.no_akun_pgw',$v['no_pgw']);
			$this->db->join('tb_akun','tb_akun.id_pgw = tb_pegawai.id_pgw');
			$this->db->select('nma_lkp_pgw');
			$nama = $this->db->get('tb_pegawai')->row();
			$pgw[$i]['nama'] = $nama->nma_lkp_pgw;
			foreach ($presensi as $key => $p) {
				  $query = $this->db->query('SELECT COUNT(id_prs) AS jumlah FROM tb_presensi WHERE no_akun_pgw = "'.$v['no_pgw'].'" AND stat_prs = "'.$p.'" AND (`tgl_prs`  >= "'.$this->awal.'" AND `tgl_prs` <= "'.$this->akhir.'") ');
				  $pgw[$i][$p] = $query->row_array()['jumlah'];
			}			

		}
		return $pgw;
	}

	public function kpi_pelatihan(){


		$sql = 'SELECT ((jumlah_pelatihan * 100) / jumlah_pegawai) AS kpi
					FROM (
							(
								SELECT (SELECT COUNT(id_dtl_lth) FROM tb_pelatihan JOIN tb_detil_pelatihan USING(id_lth) WHERE waktu_lth_awal	<= "'.$this->akhir.'" AND waktu_lth_awal >= "'.$this->awal.'"  AND stat_lth = "Y") AS jumlah_pelatihan,
									(SELECT COUNT(id_pgw) FROM tb_pegawai WHERE stat_akt_pgw = "Y") AS jumlah_pegawai
							) AS A
					     )';

		

		$query = $this->db->query($sql);
		$kpi_prs = $query->row()->kpi;
		$data = array(
				'periode_lth_prs' => $this->awal,
				'kpi_lth_prs' => $kpi_prs,
			);
		$this->db->insert('tb_pelatihan_perusahaan',$data);
		return intval($kpi_prs);
	}

	public function kpi_muhasabah(){

		$this->db->select('id_mhb,nma_lkp_pgw,tb_muhasabah.id_pgw AS id_pgw,
	COUNT(CASE WHEN alq_mhb = "Y" THEN 1 END) AS "alq",
	COUNT(CASE WHEN thj_mhb = "Y" THEN 1 END) AS "thj",
	COUNT(CASE WHEN sdq_mhb = "Y" THEN 1 END)  AS "sdq",
	COUNT(CASE WHEN psa_mhb = "Y" THEN 1 END) AS "psa"');

		$this->db->group_by('id_pgw');
		if($this->divisi != ''){
			$this->db->where('id_jbtn',"$this->divisi");
		}
		$this->db->join('tb_pegawai','tb_pegawai.id_pgw = tb_muhasabah.id_pgw');
		$this->db->where('tgl_mhb <= ',$this->akhir);
		$this->db->where('tgl_mhb >= ',$this->awal);
		$data = $this->db->get('tb_muhasabah')->result_array();
		

		$akhir = explode('-', $this->akhir)[2];
		
		foreach ($data as $d) {
			$alq = (intval($d['alq']) / $akhir) * 25;
			$thj = (intval($d['thj']) / $akhir) * 25;

			if(intval($d['psa']) >= 8){
				$psa = (8 / 8) * 25;
			}
			elseif(intval($d['psa']) < 8){
				$psa = (intval($d['psa']) / 8) * 25;
			}

			$sdq = (intval($d['sdq']) / $akhir) * 25;

			$mhb = array(
					'id_pgw' => $d['id_pgw'],
					'periode_mhb_pgw' => $this->awal,
					'kpi_mhb_pgw' => $alq+$psa+$thj+$sdq,
				); 

			$this->db->where('periode_mhb_pgw',$this->awal);
			$this->db->where('id_pgw',$d['id_pgw']);
			$pgw = $this->db->get('tb_muhasabah_pegawai')->result();
			if(count($pgw) <= 0){
				$this->db->insert('tb_muhasabah_pegawai',$mhb);
			}			
		}

		$this->db->group_by('div_jbtn');
		$this->db->select('div_jbtn');
		$jbtn = $this->db->get('tb_jabatan')->result_array();
		
		foreach ($jbtn as $j) {
			$this->db->select('SUM(kpi_mhb_pgw)/(SELECT COUNT(id_pgw) FROM tb_pegawai JOIN tb_jabatan USING(id_jbtn) WHERE div_jbtn = "'.$j['div_jbtn'].'") AS kpi_div');
			$this->db->join('tb_pegawai','tb_pegawai.id_pgw = tb_muhasabah_pegawai.id_pgw');
			$this->db->join('tb_jabatan','tb_jabatan.id_jbtn = tb_pegawai.id_jbtn');
			$this->db->where('div_jbtn',$j['div_jbtn']);
			$this->db->where('periode_mhb_pgw',$this->awal);
			$jbt = $this->db->get('tb_muhasabah_pegawai')->row_array();	
			
			if(!is_null($jbt['kpi_div'])){
				//var_dump($jbt);
				$this->db->where('periode_mhb_div', $this->awal);
				$this->db->where('div_jbtn',$j['div_jbtn']);
				$kpi = $this->db->get('tb_muhasabah_divisi')->result();
				if(count($kpi) <= 0){
					$jbt = array(
							'div_jbtn' => $j['div_jbtn'],
							'periode_mhb_div' =>$this->awal,
							'kpi_mhb_div' => $jbt['kpi_div'],

						);	
					$this->db->insert('tb_muhasabah_divisi',$jbt);
				}
				
			}

		}
		$this->db->select('SUM(kpi_mhb_div) as kpi_prs');
		$this->db->where('periode_mhb_div',$this->awal);
		$kpi_div = $this->db->get('tb_muhasabah_divisi')->row_array()['kpi_prs'];
		$sum_kpi_div = floatval($kpi_div) / count($jbtn);
		
		
		$this->db->where('periode_mhb_prs',$this->awal);
		$kpi_prs = $this->db->get('tb_muhasabah_perusahaan')->row();
		if(count($kpi_prs) <= 0){
			$kpi_prs = array(
					'periode_mhb_prs' => $this->awal,
					'kpi_mhb_prs' => $sum_kpi_div,
				);
			$this->db->insert('tb_muhasabah_perusahaan',$kpi_prs);
				
		}
		
		return $data;
	}

	public function kpi_presensi(){

		$this->db->where('awal_periode_presensi_pegawai >= ', $this->awal_presensi);
		$this->db->where('akhir_periode_presensi_pegawai <= ', $this->akhir_presensi);
		$presensi = $this->db->get('tb_presensi_pegawai')->result_array();

		if(count($presensi) <= 0){

			$this->db->select('id_pgw,
								(COUNT(CASE WHEN stat_prs = "alpha" THEN 1 END)/((DATEDIFF("2014-10-20","2014-09-21")+1)-COUNT(CASE WHEN stat_prs = "libur" THEN 1 END))*100 )AS "aplha_presensi_pegawai",
								(COUNT(CASE WHEN stat_prs = "sakit" THEN 1 END)/((DATEDIFF("2014-10-20","2014-09-21")+1)-COUNT(CASE WHEN stat_prs = "libur" THEN 1 END))*100 )AS "sakit_presensi_pegawai",
								(COUNT(CASE WHEN stat_prs = "ijin" THEN 1 END)/((DATEDIFF("2014-10-20","2014-09-21")+1)-COUNT(CASE WHEN stat_prs = "libur" THEN 1 END))*100 )AS "ijin_presensi_pegawai",
								(COUNT(CASE WHEN stat_prs = "hadir" THEN 1 END)/((DATEDIFF("2014-10-20","2014-09-21")+1)-COUNT(CASE WHEN stat_prs = "libur" THEN 1 END))*100 )AS "hadir_presensi_pegawai",
								(COUNT(CASE WHEN stat_prs = "cuti" THEN 1 END)/((DATEDIFF("2014-10-20","2014-09-21")+1)-COUNT(CASE WHEN stat_prs = "libur" THEN 1 END))*100 )AS "cuti_presensi_pegawai"
							');
			$this->db->where('tgl_prs <=', $this->akhir_presensi);
			$this->db->where('tgl_prs >=', $this->awal_presensi);
			$this->db->group_by('tb_presensi.no_akun_pgw');
			$this->db->join('tb_akun', 'tb_akun.no_akun_pgw = tb_presensi.no_akun_pgw');
			$data = $this->db->get('tb_presensi')->result_array();
			
			foreach ($data as $d) {
				
				$data_presensi_pegawai = array(
						'no_akun_pgw' => $d['id_pgw'],
						'awal_periode_presensi_pegawai' => $this->awal_presensi,
						'akhir_periode_presensi_pegawai' => $this->akhir_presensi,
						'alpha_presensi_pegawai' => $d['aplha_presensi_pegawai'],
						'sakit_presensi_pegawai' => $d['sakit_presensi_pegawai'],
						'cuti_presensi_pegawai' => $d['cuti_presensi_pegawai'],
						'hadir_presensi_pegawai' => $d['hadir_presensi_pegawai'],
						'ijin_presensi_pegawai' => $d['ijin_presensi_pegawai'],
					);
				$this->db->insert('tb_presensi_pegawai', $data_presensi_pegawai);
			}

		}

		$this->db->where('awal_periode_presensi_divisi >= ', $this->awal_presensi);
		$this->db->where('akhir_periode_presensi_divisi <= ', $this->akhir_presensi);
		$presensi = $this->db->get('tb_presensi_divisi')->result_array();

		if(count($presensi) <= 0){
			$this->db->select('tb_presensi_pegawai.id_pgw AS id,div_jbtn,
								SUM(alpha_presensi_pegawai)/COUNT(tb_presensi_pegawai.id_pgw) AS alpha,
								SUM(sakit_presensi_pegawai)/COUNT(tb_presensi_pegawai.id_pgw) AS sakit,
								SUM(ijin_presensi_pegawai)/COUNT(tb_presensi_pegawai.id_pgw) AS ijin,
								SUM(hadir_presensi_pegawai)/COUNT(tb_presensi_pegawai.id_pgw) AS hadir,
								SUM(cuti_presensi_pegawai)/COUNT(tb_presensi_pegawai.id_pgw) AS cuti
							');	
			$this->db->join('tb_pegawai', 'tb_pegawai.id_pgw = tb_presensi_pegawai.id_pgw');
			$this->db->join('tb_jabatan', 'tb_jabatan.id_jbtn = tb_pegawai.id_jbtn');
			$this->db->group_by('div_jbtn');
			$data = $this->db->get('tb_presensi_pegawai')->result_array();
			
			foreach ($data as $d) {
				
				$data_presensi_divisi = array(
						'div_jbtn' => $d['div_jbtn'],
						'awal_periode_presensi_divisi' => $this->awal_presensi,
						'akhir_periode_presensi_divisi' => $this->akhir_presensi,
						'alpha_presensi_divisi' => $d['alpha'],
						'ijin_presensi_divisi' => $d['ijin'],
						'hadir_presensi_divisi' => $d['hadir'],
						'sakit_presensi_divisi' => $d['sakit'],
						'cuti_presensi_divisi' => $d['cuti'],
					);
				$this->db->insert('tb_presensi_divisi', $data_presensi_divisi);
			}

		}

		$this->db->where('awal_periode_presensi_perusahaan >= ', $this->awal_presensi);
		$this->db->where('akhir_periode_presensi_perusahaan <= ', $this->akhir_presensi);
		$presensi = $this->db->get('tb_presensi_perusahaan')->result_array();

		if(count($presensi) <=  0){

			$this->db->select('
								SUM(alpha_presensi_divisi)/COUNT(id_presensi_divisi) as alpha,
								SUM(sakit_presensi_divisi)/COUNT(id_presensi_divisi) as sakit,
								SUM(hadir_presensi_divisi)/COUNT(id_presensi_divisi) as hadir,
								SUM(cuti_presensi_divisi)/COUNT(id_presensi_divisi) as cuti,
								SUM(ijin_presensi_divisi)/COUNT(id_presensi_divisi) as ijin,
					
							');

			$this->db->group_by('awal_periode_presensi_divisi');
			$data = $this->db->get('tb_presensi_divisi')->row_array();
			$data_presensi_perusahaan = array(
					'awal_periode_presensi_perusahaan' => $this->awal_presensi,
					'akhir_periode_presensi_perusahaan' => $this->akhir_presensi,
					'alpha_presensi_perusahaan' => $data['alpha'],
					'sakit_presensi_perusahaan' => $data['sakit'],
					'cuti_presensi_perusahaan' => $data['cuti'],
					'hadir_presensi_perusahaan' => $data['hadir'],
					'ijin_presensi_perusahaan' => $data['ijin'],
				);
			$this->db->insert('tb_presensi_perusahaan', $data_presensi_perusahaan);
		}




	}

}