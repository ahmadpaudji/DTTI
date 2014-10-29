<?php
	$beranda = '';
	$muhasabah = '';
	$absen = '';
	$pegawai = '';
	$master = '';
	$pengajuan = '';

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
	});
</script>
<body class="bodybar">
	<div id="navigation" style="height:40px">
		<div class="container-fluid">
			<a href="<?php echo base_url() ;?>" id="brand" style="font-size:12px">Duta Transformasi Insani</a>
			<ul class='main-nav'>
				<li class='<?php echo $beranda ;?>'>
					<a href="<?php echo base_url();?>">
						<i class="icon-home"></i>
						<span>Beranda</span>
					</a>
				</li>
				<?php
					if ($this->session->userdata['hak'] == "admin" || $this->session->userdata['level'] == "special user")
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
					</ul>
				</li>
				<li class='<?php echo $pegawai ;?>'>
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<i class="icon-home"></i>
						<span>Pegawai</span>
					</a>
					<ul class="dropdown-menu">
						<li>
							<a href="<?php echo base_url(); ?>admin/pegawai">Data Pegawai</a>
						</li>
						<li>
							<a href="<?php echo base_url(); ?>admin/sim">Data Sim</a>
						</li>
						<li>
							<a href="<?php echo base_url(); ?>admin/bank">Rekening Bank</a>
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
							$mhs = "Isi Muhasabah";
						}
					?>
						<li>
							<a href="<?php echo base_url(); ?>admin/muhasabah"><?php echo $mhs; ?></a>
						</li>
					<?php
						if ($this->session->userdata['hak'] == "user")
						{
					?>
						<li>
							<a href="<?php echo base_url(); ?>admin/muhasabah/lihat">Lihat Muhasabah</a>
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
							$abs = "Upload";
						}
						else
						{
							$abs = "Data Presensi";
						}
					?>
						<li>
							<a href="<?php echo base_url(); ?>admin/absen"><?php echo $abs; ?></a>
						</li>
					<?php
						if ($this->session->userdata['hak'] == "admin")
						{
					?>
						<li>
							<a href="<?php echo base_url(); ?>admin/presensi">Data Presensi</a>
						</li>
						<li>
							<a href="<?php echo base_url(); ?>admin/absen/rekap">Rekapitulasi Presensi</a>
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
						<li>
							<a href="<?php echo base_url()."admin/izin"?>">Izin Presensi</a>
						</li>
						<li>
							<a href="#">SPPD</a>
						</li>
						<li>
							<a href="<?php echo base_url()."admin/pelatihan"?>">Pelatihan</a>
						</li>
					</ul>
				</li>
			</ul>
			<div class="user">
				<ul class="icon-nav">
				<?php
					if ($this->session->userdata('hak') == "admin")
					{
				?>
					<li class='dropdown'>
						<a href="#" id="jml" class='dropdown-toggle' data-jumlah="<?php echo count($notif);?>" data-toggle="dropdown"><i class="icon-bell"></i><span class="label label-lightred"><?php echo count($notif);?></span></a>
						<ul class="dropdown-menu pull-right message-ul">
							<li >
								<a href="<?php echo base_url()."admin/notifikasi";?>" class='more-messages'><b>Peringatan</b></a>
							</li>
							<?php
							foreach ($notif as $ntf)
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
				<?php
					}
				?>
					<li class='dropdown'>
						<a href="#" class='dropdown-toggle' data-toggle="dropdown"><i class="icon-book"></i><span class="label label-lightred">4</span></a>
						<ul class="dropdown-menu pull-right message-ul">
							<li >
								<a class='more-messages'><b>Pelatihan</b></a>
							</li>
							<li>
								<a href="#">
								<div class="details">
									<div class="name"><b>awdawd</b></div>
									<div class="message">
										awdd
									</div>
								</div>
								</a>
							</li>
						</ul>
					</li>
					<li class='dropdown'>
						<a href="#" class='dropdown-toggle' data-toggle="dropdown"><i class="icon-plane"></i><span class="label label-lightred">4</span></a>
						<ul class="dropdown-menu pull-right message-ul">
							<li >
								<a class='more-messages'><b>Izin</b></a>
							</li>
							<li>
								<a href="#">
								<div class="details">
									<div class="name"><b>awdawd</b></div>
									<div class="message">
										awdd
									</div>
								</div>
								</a>
							</li>
						</ul>
					</li>
				</ul>
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
