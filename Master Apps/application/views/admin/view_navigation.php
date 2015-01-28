<?php
	$beranda = '';
	$muhasabah = '';
	$absen = '';
	$pegawai = '';
	$master = '';
	$pengajuan = '';
	$konfirmasi = '';
	$kpi = '';

	if ($nav == "beranda") 
	{
		$beranda = "active";
	}
	else
	if ($nav == "muhasabah") 
	{
		$muhasabah = "active";
	}
	else
	if ($nav == "absen") 
	{
		$absen = "active";
	}
	else
	if ($nav == "pegawai") 
	{
		$pegawai = "active";
	}
	else
	if ($nav == "master") 
	{
		$master = "active";
	}
	else
	if ($nav == "pengajuan") 
	{
		$pengajuan = "active";
	}
	else
	if ($nav == "konfirmasi") 
	{
		$konfirmasi = "active";
	}
	else
	if ($nav == "kpi") 
	{
		$kpi = "active";
	}
?>
<script>
	$(function(){
	    $(".bodybar").on('click','#noti',function(){
	        $.post('<?php echo base_url("api"); ?>',{id:$(this).attr('data-notif')});
			var jml = $('#jml').attr('data-jumlah');
			var hsl = jml - 1;
			$('#jml').attr('data-jumlah',hsl);
			$('#jml span').html($('#jml').attr('data-jumlah'));
	    });

	    $(".bodybar").on('click','#noti_izin',function(){
	        $.post('<?php echo base_url("api"); ?>',{id:$(this).attr('data-notif')});
			var jml = $('#jml_izin').attr('data-jumlah');
			var hsl = jml - 1;
			$('#jml_izin').attr('data-jumlah',hsl);
			$('#jml_izin span').html($('#jml_izin').attr('data-jumlah'));
	    });

	    $(".bodybar").on('click','#noti_pelatihan',function(){
	        $.post('<?php echo base_url("api"); ?>',{id:$(this).attr('data-notif')});
			var jml = $('#jml_pelatihan').attr('data-jumlah');
			var hsl = jml - 1;
			$('#jml_pelatihan').attr('data-jumlah',hsl);
			$('#jml_pelatihan span').html($('#jml_pelatihan').attr('data-jumlah'));
	    });

	    $(".bodybar").on('click','#noti_sppd',function(){
	        $.post('<?php echo base_url("api"); ?>',{id:$(this).attr('data-notif')});
			var jml = $('#jml_sppd').attr('data-jumlah');
			var hsl = jml - 1;
			$('#jml_sppd').attr('data-jumlah',hsl);
			$('#jml_sppd span').html($('#jml_sppd').attr('data-jumlah'));
	    });
	});
</script>
<body class="bodybar">
	<div id="navigation" style="height:40px">
		<div class="container-fluid">
			<a href="<?php echo base_url() ;?>" id="brand" style="font-size:12px">Duta Transformasi Insani</a>
<?php
////////////MENU UTAMA
?>
			<ul class='main-nav'>
				<li class='<?php echo $beranda ;?>'>
					<a href="<?php echo base_url();?>">
						<i class="icon-home"></i>
						<span>Beranda</span>
					</a>
				</li>
				<?php
					if ($this->session->userdata['hak'] == "admin" || $this->session->userdata['hak'] == "super user")
					{
						if ($this->session->userdata['hak'] == "admin")
						{
				?>
				<li class='<?php echo $master ;?>'>
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<i class="icon-home"></i>
						<span>Master Data</span>
					</a>
					<ul class="dropdown-menu">
						<li>
							<a href="<?php echo base_url(); ?>admin/daftarbank">Daftar Bank</a>
						</li>
						<li>
							<a href="<?php echo base_url(); ?>admin/libur">Daftar Libur</a>
						</li>
					</ul>
				</li>
				<?php
						}
				?>
				<li class='<?php echo $pegawai ;?>'>
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<i class="icon-home"></i>
						<span>Pegawai</span>
					</a>
					<ul class="dropdown-menu">
						<li>
							<a href="<?php echo base_url(); ?>admin/pegawai">Data Pegawai</a>
						</li>
						<?php
							if ($this->session->userdata['hak'] == "admin")
							{
						?>
						<li>
							<a href="<?php echo base_url(); ?>admin/sim">Data Sim</a>
						</li>
						<li>
							<a href="<?php echo base_url(); ?>admin/bank">Data Rekening Bank</a>
						</li>
						<li>
							<a href="<?php echo base_url(); ?>admin/formal">Data Pendidikan Formal</a>
						</li>
						<li>
							<a href="<?php echo base_url(); ?>admin/informal">Data Pendidikan Informal</a>
						</li>
						<li>
							<a href="<?php echo base_url(); ?>admin/usaha">Data Usaha/Aktifitas</a>
						</li>
						<li>
							<a href="<?php echo base_url(); ?>admin/anak">Data Anak</a>
						</li>
						<li>
							<a href="<?php echo base_url(); ?>admin/kendaraan">Data Kendaraan</a>
						</li>
						
						<?php
							}
						?>
						<?php
							if ($this->session->userdata['hak'] != "user")
							{
						?>
						<li>
							<a href="<?php echo base_url(); ?>admin/reward">Data Reward</a>
						</li>
						<li>
							<a href="<?php echo base_url(); ?>admin/punishment">Data Punishment</a>
						</li>
						<?php
							}
						?>
					</ul>
				</li>
				<?php
					}
				?>
				<li class='<?php echo $muhasabah ;?>'>
					<a href="<?php echo base_url()."admin/muhasabah";?>" data-toggle="dropdown" class='dropdown-toggle'>
						<i class="icon-home"></i>
						<span>Muhasabah</span>
					</a>
					<ul class="dropdown-menu">
					<?php
						if ($this->session->userdata['hak'] == "admin")
						{
							$mhs = "Data Muhasabah";
						}
						else
						{
							$mhs = "Form Muhasabah";
						}

						if ($this->session->userdata['hak'] == "admin" || $this->session->userdata['hak'] == "user")
						{
					?>
						<li>
							<a href="<?php echo base_url(); ?>admin/muhasabah"><?php echo $mhs; ?></a>
						</li>
					<?php
						}
						if ($this->session->userdata['hak'] == "user")
						{
					?>
						<li>
							<a href="<?php echo base_url(); ?>admin/muhasabah/lihat">Tinjau Muhasabah</a>
						</li>
					<?php
						}
					?>
					<?php
						if ($this->session->userdata['hak'] == "admin")
						{
					?>
						<li>
							<a href="<?php echo base_url(); ?>admin/muhasabah/rekap">Rekapitulasi Muhasabah</a>
						</li>
					<?php
						}
					?>
					<?php
						if ($this->session->userdata['hak'] == "admin" || $this->session->userdata['hak'] == "super user")
						{
					?>
						<li>
							<a href="<?php echo base_url(); ?>admin/muhasabah/persentase">Persentase Muhasabah</a>
						</li>
					<?php
						}
					?>
					</ul>
				</li>
				<li class='<?php echo $absen ;?>'>
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<i class="icon-home"></i>
						<span>Presensi</span>
					</a>
					<ul class="dropdown-menu">
					<?php
						if ($this->session->userdata['hak'] == "admin")
						{
							$abs = "Unggah";
						}
						else
						{
							$abs = "Data Presensi";
						}

						if ($this->session->userdata['hak'] == "admin" || $this->session->userdata['hak'] == "user")
						{
					?>
						<li>
							<a href="<?php echo base_url(); ?>admin/absen"><?php echo $abs; ?></a>
						</li>
					<?php
						}

						if ($this->session->userdata['hak'] == "admin")
						{
					?>
						<li>
							<a href="<?php echo base_url(); ?>admin/presensi">Data Presensi</a>
						</li>
					<?php
						}

						if ($this->session->userdata['hak'] == "admin" || $this->session->userdata['hak'] == "super user")
						{
					?>
						<li>
							<a href="<?php echo base_url(); ?>admin/absen/rekap">Rekapitulasi Presensi</a>
						</li>
						<li>
							<a href="<?php echo base_url(); ?>admin/absen/cuti">Rekapitulasi Cuti</a>
						</li>
					<?php
						}
					?>
					</ul>
				</li>
				<li class='<?php echo $pengajuan ;?>'>
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<i class="icon-home"></i>
						<span>Pengajuan</span>
					</a>
					<ul class="dropdown-menu">
						<?php
							if ($this->session->userdata['hak'] != "super user")
							{
						?>
						<li>
							<a href="<?php echo base_url()."admin/izin"?>">Izin Presensi</a>
						</li>
						<?php
							}
						?>
						<?php
							if ($this->session->userdata("divisi") != "komisaris")
							{
						?>
						<li>
							<a href="<?php echo base_url()."admin/sppd"?>">SPPD</a>
						</li>
						<?php
							}
						?>
						<?php
							if ($this->session->userdata['hak'] == "super user" && $this->session->userdata("divisi") != "komisaris")
							{
						?>
						<li class='dropdown-submenu'>
						<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
							<span>Rekapitulasi</span>
						</a>
						<ul class="dropdown-menu">
							<li>
								<i class="icon-home"></i>
								<span>Rekapitulasi</span>
							</li>
							<li>
								<a href="<?php echo base_url("admin/izin/rekap");?>">Izin Presensi</a>
							</li>
							<li>
								<a href="<?php echo base_url("admin/sppd/rekap");?>">SPPD</a>
							</li>
							<li>
								<a href="<?php echo base_url("admin/pelatihan/rekap");?>">Pelatihan</a>
							</li>
						</ul>
						</li>
						<?php
							}
						?>
						<?php
							if ($this->session->userdata['hak'] != "super user")
							{
						?>
						<li>
							<a href="<?php echo base_url()."admin/pelatihan"?>">Pelatihan</a>
						</li>
						<?php
							}
						?>
						<?php
							if ($this->session->userdata("hak") == "admin")
							{
						?>
						<li class='dropdown-submenu'>
						<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
							<span>Konfirmasi</span>
						</a>
						<ul class="dropdown-menu">
							<li>
								<i class="icon-home"></i>
								<span>Konfirmasi</span>
							</li>
							<li>
								<a href="<?php echo base_url()."admin/izin/konfirmasi"?>">Izin Presensi</a>
							</li>
							<li>
								<a href="<?php echo base_url()."admin/sppd/konfirmasi"?>">SPPD</a>
							</li>
							<li>
								<a href="<?php echo base_url()."admin/pelatihan/konfirmasi"?>">Pelatihan</a>
							</li>
						</ul>
						</li>
						<?php
							}
						?>
						<?php
							if ($this->session->userdata("divisi") == "komisaris")
							{
						?>
						<li>
							<a href="#">Rekap Izin</a>
						</li>

						<li>
							<a href="#">Rekap Pelatihan</a>
						</li>

						<li>
							<a href="#">Rekap SPPD</a>
						</li>
						<?php
							}
						?>
					</ul>
				</li>
				<?php
					$jbt_konf = ['manajer','direktur utama','direktur operasional','direktur marketing'];
					if ($this->session->userdata('hak') == "user" || $this->session->userdata('hak') == "super user" || $this->session->userdata('hak') == "admin")
					{
						if (in_array($this->session->userdata('jabatan'), $jbt_konf))
						{
				?>
				<li class='<?php echo $konfirmasi ;?>'>
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<i class="icon-home"></i>
						<span>Konfirmasi</span>
					</a>
					<ul class="dropdown-menu">
						<li>
							<a href="<?php echo base_url()."admin/izin/konfirmasi"?>">Izin Presensi</a>
						</li>
						<li>
							<a href="<?php echo base_url()."admin/sppd/konfirmasi"?>">SPPD</a>
						</li>
						<li>
							<a href="<?php echo base_url()."admin/pelatihan/konfirmasi"?>">Pelatihan</a>
						</li>
					</ul>
				</li>
				<?php
						}
					}
				?>
				<?php
					if ($this->session->userdata('hak') == "super user" || $this->session->userdata('hak') == "admin")
					{
				?>
				<li class='<?php echo $kpi ;?>'>
					<a href="<?php echo base_url()?>admin/kpi">
						<i class="icon-home"></i>
						<span>KPI</span>
					</a>
					
				</li>
				<?php
					}
				?>
			</ul>
<?php
////////////AKHIR MENU UTAMA

///////////////////NOTIFIKASI
?>
			<div class="user">
				<ul class="icon-nav">
				<?php
					if ($this->session->userdata('hak') == "admin")
					{
				?>
					<li class='dropdown'>
						<a href="#" id="jml" class='dropdown-toggle' data-jumlah="<?php echo count($notif->peringatan);?>" data-toggle="dropdown"><i class="icon-bell"></i><span class="label label-lightred"><?php echo count($notif->peringatan);?></span></a>
						<ul class="dropdown-menu pull-right message-ul">
							<li >
								<a href="<?php echo base_url()."admin/notifikasi";?>" class='more-messages'><b>Peringatan</b></a>
							</li>
							<?php
							foreach ($notif->peringatan as $ntf)
							{
							?>
							<li>
								<button id="noti" type="button" data-notif="<?php echo $ntf->id_notif; ?>" class="close" data-dismiss="alert">&times;</button>
								<a href="#">
								<div class="details">
									<div class="name"><b><?php echo $ntf->nma_lkp_pgw; ?></b></div>
									<div class="message">
										<?php echo $ntf->ket_notif;?>
									</div>
								</div>
								</a>
							</li>
							<?php
							}
							?>

						</ul>
					</li>
					<li class='dropdown'>
						<a href="#" id="jml_izin" class='dropdown-toggle' data-jumlah="<?php echo count($notif->izin);?>" data-toggle="dropdown"><i class="icon-book"></i><span class="label label-lightred"><?php echo count($notif->izin);?></span></a>
						<ul class="dropdown-menu pull-right message-ul">
							<li >
								<a class='more-messages'><b>Izin</b></a>
							</li>
							<?php
							if ($notif->izin != null)
							{ 
							foreach ($notif->izin as $izn)
							{
							?>
							<li>
								<button id="noti_izin" type="button" data-notif="<?php echo $izn->id_notif; ?>" class="close" data-dismiss="alert">&times;</button>
								<a href="<?php echo base_url("admin/izin/konfirmasi/cari/notif");?>">
								<div class="details">
									<div class="name"><b><?php echo $izn->nma_lkp_pgw; ?></b></div>
									<div class="message">
										<?php
										if ($izn->status_notif == 'y')
										{
											echo "(Telah dikonfirmasi) ".$izn->ket_notif;
										}
										else
										{
											echo $izn->ket_notif;
										}

										?>
									</div>
								</div>
								</a>
							</li>
							<?php
							}
							}
							?>
							
						</ul>
					</li>
					<li class='dropdown'>
						<a href="#" id="jml_pelatihan" class='dropdown-toggle' data-jumlah="<?php echo count($notif->pelatihan);?>" data-toggle="dropdown"><i class="icon-group"></i><span class="label label-lightred"><?php echo count($notif->pelatihan);?></span></a>
						<ul class="dropdown-menu pull-right message-ul">
							<li >
								<a class='more-messages'><b>Pelatihan</b></a>
							</li>
							<?php
							if ($notif->pelatihan != null)
							{ 
							foreach ($notif->pelatihan as $pel)
							{
							?>
							<li>
								<button id="noti_pelatihan" type="button" data-notif="<?php echo $pel->id_notif; ?>" class="close" data-dismiss="alert">&times;</button>
								<a href="<?php echo base_url("admin/pelatihan/konfirmasi/cari/notif");?>">
								<div class="details">
									<div class="name"><b><?php echo $pel->nma_lkp_pgw; ?></b></div>
									<div class="message">
										<?php
										if ($pel->status_notif == 'y')
										{
											echo "(Telah dikonfirmasi) ".$pel->ket_notif;
										}
										else
										{
											echo $pel->ket_notif;
										}

										?>
									</div>
								</div>
								</a>
							</li>
							<?php
							}
							}
							?>
						</ul>
					</li>
					<li class='dropdown'>
						<a href="#" id="jml_sppd" class='dropdown-toggle' data-jumlah="<?php echo count($notif->sppd);?>" data-toggle="dropdown"><i class="icon-plane"></i><span class="label label-lightred"><?php echo count($notif->sppd);?></span></a>
						<ul class="dropdown-menu pull-right message-ul">
							<li >
								<a class='more-messages'><b>SPPD</b></a>
							</li>
							<?php
							if ($notif->sppd != null)
							{ 
							foreach ($notif->sppd as $sp)
							{
							?>
							<li>
								<button id="noti_sppd" type="button" data-notif="<?php echo $sp->id_notif; ?>" class="close" data-dismiss="alert">&times;</button>
								<a href="<?php echo base_url("admin/sppd/konfirmasi/cari/notif");?>">
								<div class="details">
									<div class="name"><b><?php echo $sp->nma_lkp_pgw; ?></b></div>
									<div class="message">
										<?php
										if ($sp->status_notif == 'y')
										{
											echo "(Telah dikonfirmasi) ".$sp->ket_notif;
										}
										else
										{
											echo $sp->ket_notif;
										}

										?>
									</div>
								</div>
								</a>
							</li>
							<?php
							}
							}
							?>
						</ul>
					</li>
				<?php
					}
					else if ($this->session->userdata("hak") == "super user" || $this->session->userdata("hak") == "user")
					{
				?>
					<?php
						if ($this->session->userdata("hak") == "user")
						{
					?>
					<li class='dropdown'>
						<a href="#" id="jml" class='dropdown-toggle' data-toggle="dropdown"><i class="icon-bell"></i><span class="label label-lightred"></span></a>
						<ul class="dropdown-menu pull-right message-ul">
							<li >
								<a href="<?php echo base_url()."admin/notifikasi";?>" class='more-messages'><b>Peringatan</b></a>
							</li>
							<?php
							if ($notif->peringatan != null)
							{
							foreach ($notif->peringatan as $ntf)
							{
							?>
							<li>
								<a href="#">
								<div class="details">
									<div class="name"><b><?php echo $ntf->nma_lkp_pgw; ?></b></div>
									<div class="message">
										<?php echo $ntf->ket_notif;?>
									</div>
									<div class="count">
										<i class="icon-angle-left"></i>
										<span>
										<?php
											$wkt_ntf = explode('-', substr($ntf->waktu_notif, 0,10));
											echo $wkt_ntf[2].'-'.$wkt_ntf[1].'-'.$wkt_ntf[0];
										?>
										</span>
									</div>
								</div>
								</a>
							</li>
							<?php
							}
							}
							?>

						</ul>
					</li>
					<?php
						}
					?>
					<li class='dropdown'>
						<a href="#" id="jml_izin" class='dropdown-toggle' data-jumlah="<?php echo count($notif->izin)+count($notif->izin_terima);?>" data-toggle="dropdown"><i class="icon-book"></i><span class="label label-lightred"><?php echo count($notif->izin)+count($notif->izin_terima);?></span></a>
						<ul class="dropdown-menu pull-right message-ul">
							<li >
								<a class='more-messages'><b>Izin</b></a>
							</li>
							<?php
							if ($notif->izin != null)
							{ 
							foreach ($notif->izin as $izn)
							{
							?>
							<li>
								<button id="noti_izin" type="button" data-notif="<?php echo $izn->id_notif; ?>" class="close" data-dismiss="alert">&times;</button>
								<a href="<?php echo base_url("admin/izin/konfirmasi/cari/notif");?>">
								<div class="details">
									<div class="name"><b><?php echo $izn->nma_lkp_pgw; ?></b></div>
									<div class="message">
										<?php
										if ($izn->status_notif == 'y')
										{
											echo "(Telah dikonfirmasi) ".$izn->ket_notif;
										}
										else
										{
											echo $izn->ket_notif;
										}

										?>
									</div>
								</div>
								</a>
							</li>
							<?php
							}
							}
							?>
							<?php
							if ($notif->izin_terima != null)
							{  
							foreach ($notif->izin_terima as $izn)
							{
							?>
							<li>
								<button id="noti_izin" type="button" data-notif="<?php echo $izn->id_notif; ?>" class="close" data-dismiss="alert">&times;</button>
								<a href="<?php echo base_url("admin/izin/index/cari/notif");?>">
								<div class="details">
								<?php
								?>
									<div class="name"><b><?php echo $izn->nma_lkp_pgw; ?></b></div>
									<div class="message">
										<?php
										if ($izn->status_notif == 'y')
										{
											echo "(Telah dikonfirmasi) ".$izn->ket_notif;
										}
										else
										{
											echo $izn->ket_notif;
										}

										?>
									</div>
								</div>
								</a>
							</li>
							<?php
							}
							}
							?>
						</ul>
					</li>
					<li class='dropdown'>
						<a href="#" id="jml_pelatihan" class='dropdown-toggle' data-jumlah="<?php echo count($notif->pelatihan)+count($notif->pelatihan_terima);?>" data-toggle="dropdown"><i class="icon-group"></i><span class="label label-lightred"><?php echo count($notif->pelatihan)+count($notif->pelatihan_terima);?></span></a>
						<ul class="dropdown-menu pull-right message-ul">
							<li >
								<a class='more-messages'><b>Pelatihan</b></a>
							</li>
							<?php
							if ($notif->pelatihan != null)
							{ 
							foreach ($notif->pelatihan as $pel)
							{
							?>
							<li>
								<button id="noti_pelatihan" type="button" data-notif="<?php echo $pel->id_notif; ?>" class="close" data-dismiss="alert">&times;</button>
								<a href="<?php echo base_url("admin/pelatihan/konfirmasi/cari/notif");?>">
								<div class="details">
									<div class="name"><b><?php echo $pel->nma_lkp_pgw; ?></b></div>
									<div class="message">
										<?php
										if ($pel->status_notif == 'y')
										{
											echo "(Telah dikonfirmasi) ".$pel->ket_notif;
										}
										else
										{
											echo $pel->ket_notif;
										}

										?>
									</div>
								</div>
								</a>
							</li>
							<?php
							}
							}
							?>
							<?php
							if ($notif->pelatihan_terima != null)
							{ 
							foreach ($notif->pelatihan_terima as $pel)
							{
							?>
							<li>
								<button id="noti_pelatihan" type="button" data-notif="<?php echo $pel->id_notif; ?>" class="close" data-dismiss="alert">&times;</button>
								<a href="<?php echo base_url("admin/pelatihan/index/cari/notif");?>">
								<div class="details">
									<div class="name"><b><?php echo $pel->nma_lkp_pgw; ?></b></div>
									<div class="message">
										<?php
										if ($pel->status_notif == 'y')
										{
											echo "(Telah dikonfirmasi) ".$pel->ket_notif;
										}
										else
										{
											echo $pel->ket_notif;
										}

										?>
									</div>
								</div>
								</a>
							</li>
							<?php
							}
							}
							?>
						</ul>
					</li>
					<li class='dropdown'>
						<a href="#" id="jml_sppd" class='dropdown-toggle' data-jumlah="<?php echo count($notif->sppd)+count($notif->sppd_terima);?>" data-toggle="dropdown"><i class="icon-plane"></i><span class="label label-lightred"><?php echo count($notif->sppd)+count($notif->sppd_terima);?></span></a>
						<ul class="dropdown-menu pull-right message-ul">
							<li >
								<a class='more-messages'><b>SPPD</b></a>
							</li>
							<?php
							if ($notif->sppd != null)
							{ 
							foreach ($notif->sppd as $sp)
							{
							?>
							<li>
								<button id="noti_sppd" type="button" data-notif="<?php echo $sp->id_notif; ?>" class="close" data-dismiss="alert">&times;</button>
								<a href="<?php echo base_url("admin/sppd/konfirmasi/cari/notif");?>">
								<div class="details">
									<div class="name"><b><?php echo $sp->nma_lkp_pgw; ?></b></div>
									<div class="message">
										<?php
										if ($sp->status_notif == 'y')
										{
											echo "(Telah dikonfirmasi) ".$sp->ket_notif;
										}
										else
										{
											echo $sp->ket_notif;
										}

										?>
									</div>
								</div>
								</a>
							</li>
							<?php
							}
							}
							?>
							<?php
							if ($notif->sppd_terima != null)
							{ 
							foreach ($notif->sppd_terima as $sp)
							{
							?>
							<li>
								<button id="noti_sppd" type="button" data-notif="<?php echo $sp->id_notif; ?>" class="close" data-dismiss="alert">&times;</button>
								<a href="<?php echo base_url("admin/sppd/index/cari/notif");?>">
								<div class="details">
									<div class="name"><b><?php echo $sp->nma_lkp_pgw; ?></b></div>
									<div class="message">
										<?php
										if ($sp->status_notif == 'y')
										{
											echo "(Telah dikonfirmasi) ".$sp->ket_notif;
										}
										else
										{
											echo $sp->ket_notif;
										}

										?>
									</div>
								</div>
								</a>
							</li>
							<?php
							}
							}
							?>
						</ul>
					</li>
					<?php
					}
					?>	
				</ul>
<?php
	///////////////////AKHIR NOTIFIKASI
?>
				<div class="dropdown asdf">
				<?php
						if ($this->session->userdata['foto'] == null)
						{
							$foto = "img/no_image.png";
						}
						else
						{
							$foto = $this->session->userdata['foto'];
						}
					?>
					<a href="#" class='dropdown-toggle' data-toggle="dropdown"><?php echo $this->session->userdata['nama'] ;?><img width="23" src="<?php echo base_url().$foto ;?>" alt=""></a>
					<ul class="dropdown-menu pull-right">
						<li>
							<a href="<?php echo base_url(); ?>admin/pegawai/detail/<?php echo $this->session->userdata['id_pgw'] ; ?>">Profil</a>
						</li>
						<li>
							<a href="<?php echo base_url(); ?>admin/pegawai/ubah/<?php echo $this->session->userdata['id_pgw'] ; ?>">Ubah Profil</a>
						</li>
						<?php
							if ($this->session->userdata['level'] == "admin")
							{
						?>
						<li>
							<?php
								if ($this->session->userdata['hak'] == "admin")
								{
									$logas = "User";
								}
								else
								{
									$logas = "Administrator";
								}
							?>
							<a href="<?php echo base_url(); ?>admin/demo"><?php echo $logas; ?></a>
						</li>
						<?php
							}
						?>
						<li>
							<a href="<?php echo base_url()."admin/logout";?>">Keluar</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
