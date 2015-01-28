<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Beranda</h1>
					</div>
					<div class="pull-right">
						
						<ul class="stats">
							<li class='lightred'>
								<i class="icon-calendar"></i>
								<div class="details">
									<span class="big"><?php date_default_timezone_set("Asia/Jakarta"); echo date("d-m-Y"); ?></span>
									<span><?php echo date("H:i:s"); ?></span>
								</div>
							</li>
							<?php
								if ($this->session->userdata("hak") == "admin")
								{
							?>
							<li class='blue'>
								<a href="<?php echo base_url("admin/db");?>" onclick = "return confirm('Anda yakin ingin membackup database ?');">
									<i class="icon-hdd"></i>
									<div class="details">
									<span class="big">Backup</span>
									<span>Database</span>
									</div>
								</a>
							</li>
							<?php
								}
								
							if ($this->session->userdata("hak") == "user")
							{
							?>
							<li class='satgreen'>
								<i class="icon-user"></i>
								<div class="details">
									<span class="big">Sisa Cuti</span>
									<?php
										$sisa_cuti = 0;

										if (($rkp->alpha_t + $rkp->cuti_t + $rkp->ijin_t + $rkp->sakit_t) != 0)
										{
											$sisa_cuti = ($rkp->alpha_t + $rkp->cuti_t + $rkp->ijin_t + $rkp->sakit_t);
										}
									?>
									<span><?php echo $sisa_cuti;?> dari 12</span>
								</div>
							</li>

							<li class='lightgrey'>
								<i class="icon-trophy"></i>
								<div class="details">
									<span class="big">Reward</span>
									<span><?php echo $repu->reward['khusust'] + $repu->reward['teladant'];?></span>
								</div>
							</li>
							<li class='lightred'>
								<i class="icon-warning-sign"></i>
								<div class="details">
									<span class="big">Punishment</span>
									<span><?php echo $repu->punishment['SP1t'] + $repu->punishment['SP2t'] + $repu->punishment['SP3t'];?></span>
								</div>
							</li>
							<?php
							}
							?>
							
						</ul>
						
					</div>
					
				</div>
				<?php
					if ($this->session->userdata('level') == "admin" && $this->session->userdata('hak') == "admin" ) 
					{
						$tgl_rem = array();
						for ($u=20; $u < 27 ; $u++)
						{
							$tgl_rem[] = $u;
						}
						date_default_timezone_set("Asia/Jakarta");
						if (in_array(date("d"),$tgl_rem))
						{
					?>
						<div class="alert">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							Silahkan konfigurasi tanggal libur ! Sebelum upload presensi.
						</div>
					<?php
						}
					}
				?>
				<div class="row-fluid">
					
					<div class="span6">
						<div class="box">
							<div class="box-title">
								<h3>
									<i class="icon-table"></i>
									Pegawai Teladan
								</h3>
							</div>
							<div class="box-content nopadding">
								<div class='form-horizontal form-bordered'>

								<div class="control-group">
									<label class="control-label">
										<?php
											$foto = 'img/no_image.png';

											if ($teladan['foto'] != '')
											{
												$foto = $teladan['foto'];
											}
										?>
										<img class="pasfoto" src="<?php echo base_url($foto); ?>" />
									</label>
									<div class="controls">
									<table style="text-transform:uppercase;">
										<tr>
										<td>Nama</td>
										<td>:</td>
										<td>
										<?php
											if ($teladan['nama'] != '')
											{ 
												echo $teladan['nama'];
											}
											else
											{
												echo 'Tidak ada';
											}
										?>
										</td>
										</tr>

										<tr>
										<td>NIK</td>
										<td>:</td>
										<td>
										<?php
											if ($teladan['nik'] != '')
											{ 
												echo $teladan['nik'];
											}
											else
											{
												echo 'Tidak ada';
											}
										?>
										</td>
										</tr>

										<tr>
										<td>Jabatan</td>
										<td>:</td>
										<td>
										<?php
											if ($teladan['jabatan'] != '')
											{ 
												echo $teladan['jabatan'];
											}
											else
											{
												echo 'Tidak ada';
											}
										?>
										</td>
										</tr>

										<tr>
										<td>Skor</td>
										<td>:</td>
										<td><font color="red">
										<?php
											if ($teladan['kpi_total'] != '')
											{ 
												echo number_format($teladan['kpi_total'],2);
											}
											else
											{
												echo '0';
											}
										?> 
										%</font></td>
										</tr>
									</table>
									</div>

								</div>
							</div>
							</div>
						</div>
					</div>

					<div class="span6">
						<div class="box">
							<div class="box-title">
								<h3>
									<i class="icon-table"></i>
									Pengajuan
								</h3>
								<ul class="tabs">
									<li class="active">
										<a href="#tahun" data-toggle="tab">Tahun ini</a>
									</li>
									<li>
										<a href="#periode" data-toggle="tab">Periode ini</a>
									</li>
								</ul>
							</div>
							<div class="box-content">
								<div class="tab-content">
									<div class="tab-pane active" id="tahun">
										<div class="box-content nopadding">
											<table class="table table-hover table-nomargin">
												<thead>
													<tr>
														<th>Pengajuan</th>
														<th>Tolak</th>
														<th>Terima</th>
														<th>Total</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>Pelatihan</td>
														<td><?php echo $pgj->pelatihan['TT'];?></td>
														<td><?php echo $pgj->pelatihan['YT'];?></td>
														<td><?php echo $pgj->pelatihan['YT']+$pgj->pelatihan['TT'];?></td>
													</tr>
													<tr>
														<td>Izin</td>
														<td><?php echo $pgj->izin['TT'];?></td>
														<td><?php echo $pgj->izin['YT'];?></td>
														<td><?php echo $pgj->izin['YT']+$pgj->izin['TT'];?></td>
													</tr>
													<tr>
														<td>SPPD</td>
														<td><?php echo $pgj->sppd['TT'];?></td>
														<td><?php echo $pgj->sppd['YT'];?></td>
														<td><?php echo $pgj->sppd['YT']+$pgj->sppd['TT'];?></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="tab-pane" id="periode">
										<div class="box-content nopadding">
											<table class="table table-hover table-nomargin">
												<thead>
													<tr>
														<th>Pengajuan</th>
														<th>Tolak</th>
														<th>Terima</th>
														<th>Total</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>Pelatihan</td>
														<td><?php echo $pgj->pelatihan['T'];?></td>
														<td><?php echo $pgj->pelatihan['Y'];?></td>
														<td><?php echo $pgj->pelatihan['Y']+$pgj->pelatihan['T'];?></td>
													</tr>
													<tr>
														<td>Izin</td>
														<td><?php echo $pgj->izin['T'];?></td>
														<td><?php echo $pgj->izin['Y'];?></td>
														<td><?php echo $pgj->izin['Y']+$pgj->izin['T'];?></td>
													</tr>
													<tr>
														<td>SPPD</td>
														<td><?php echo $pgj->sppd['T'];?></td>
														<td><?php echo $pgj->sppd['Y'];?></td>
														<td><?php echo $pgj->sppd['Y']+$pgj->sppd['T'];?></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
					if ($this->session->userdata('hak') == "Buka")
					{
				?>
				<div class="row-fluid">
					<div class="span6">
						<div class="box">
								<div class="box-title">
									<h3>
										<i class="icon-table"></i>
										Key Performance Indicator
									</h3>
								</div>
							<div id="kpi" class='flot'></div>
						</div>
					</div>
					<div class="span6">
						<div class="box">
							<div class="box-title">
								<h3>
									<i class="icon-table"></i>
									Key Performance Indicator
								</h3>
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin">
									<thead>
										<tr>
											<th>Jangka</th>
											<th>TPSDM</th>
											<th>TDK</th>
											<th>TM</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Periode ini</td>
											<td><?php echo $rkp->alpha_b;?></td>
											<td><?php echo $rkp->cuti_b;?></td>
											<td><?php echo $rkp->hadir_b;?></td>
										</tr>
										<tr>
											<td>Tahun ini</td>
											<td><?php echo $rkp->alpha_t;?></td>
											<td><?php echo $rkp->cuti_t;?></td>
											<td><?php echo $rkp->hadir_t;?></td>
										</tr>
									</tbody>
								</table>
							</div>
							<b>Catatan</b> : <br />
							- TPSDM (Tingkat Pelatihan SDM) <br />
							- TDK (Tingkat Disiplin Kehadiran) <br />
							- TM (Tingkat Muhasabah)
						</div>
					</div>
				</div>
				<?php
					}
				?>
				<div class="row-fluid">
					<div class="span6">
						<div class="box">
								<div class="box-title">
									<h3>
										<i class="icon-table"></i>
										Muhasabah
									</h3>
								</div>
							<div id="mhb" class='flot'></div>
								
						</div>
					</div>
					<div class="span6">
						<div class="box">
							<div class="box-title">
								<h3>
									<i class="icon-table"></i>
									Muhasabah
								</h3>
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin">
									<thead>
										<tr>
											<th>Jangka</th>
											<th>Al-Qur'an</th>
											<th>Tahajud</th>
											<th>Shodaqoh</th>
											<th>Puasa</th>
											<th>Total</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Bulan ini</td>
											<td><?php echo number_format($rkp->alquran_p,2);?> %</td>
											<td><?php echo number_format($rkp->tahajud_p,2);?> %</td>
											<td><?php echo number_format($rkp->sodaqoh_p,2);?> %</td>
											<td><?php echo number_format($rkp->puasa_p,2);?> %</td>
											<td><?php echo number_format($rkp->total_p,2);?> %</td>
										</tr>
										<tr>
											<td>Tahun ini</td>
											<td><?php echo number_format($rkp->alquran_t,2);?> %</td>
											<td><?php echo number_format($rkp->tahajud_t,2);?> %</td>
											<td><?php echo number_format($rkp->sodaqoh_t,2);?> %</td>
											<td><?php echo number_format($rkp->puasa_t,2);?> %</td>
											<td><?php echo number_format($rkp->total_t,2);?> %</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					
					<div class="span6">
						<div class="box">
								<div class="box-title">
									<h3>
										<i class="icon-table"></i>
										Presensi
									</h3>
								</div>
							<div id="prs" class='flot'></div>
						</div>
					</div>
				
					<div class="span6">
						<div class="box">
							<div class="box-title">
								<h3>
									<i class="icon-table"></i>
									Presensi
								</h3>
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin">
									<thead>
										<tr>
											<th>Jangka</th>
											<th>Alpha</th>
											<th>Cuti</th>
											<th>Hadir</th>
											<th>Ijin</th>
											<th>Sakit</th>
											<th>Tugas</th>
											<th>Telat</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Periode sebelumnya</td>
											<td><?php echo $rkp->alpha_b;?></td>
											<td><?php echo $rkp->cuti_b;?></td>
											<td><?php echo $rkp->hadir_b;?></td>
											<td><?php echo $rkp->ijin_b;?></td>
											<td><?php echo $rkp->sakit_b;?></td>
											<td><?php echo $rkp->tugas_b;?></td>
											<td><?php echo $rkp->telat_b;?></td>
										</tr>
										<tr>
											<td>Tahun ini</td>
											<td><?php echo $rkp->alpha_t;?></td>
											<td><?php echo $rkp->cuti_t;?></td>
											<td><?php echo $rkp->hadir_t;?></td>
											<td><?php echo $rkp->ijin_t;?></td>
											<td><?php echo $rkp->sakit_t;?></td>
											<td><?php echo $rkp->tugas_t;?></td>
											<td><?php echo $rkp->telat_t;?></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					
					<div class="span6">
						<div class="box">
							<div class="box-title">
								<h3>
									<i class="icon-table"></i>
									Reward
								</h3>
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin">
									<thead>
										<tr>
											<th>Jangka</th>
											<th>Khusus</th>
											<th>Teladan</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Periode Sebelumnya</td>
											<td><?php echo $repu->reward['khusus'];?></td>
											<td><?php echo $repu->reward['teladan'];?></td>
										</tr>
										<tr>
											<td>Tahun ini</td>
											<td><?php echo $repu->reward['khusust'];?></td>
											<td><?php echo $repu->reward['teladant'];?></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="span6">
						<div class="box">
							<div class="box-title">
								<h3>
									<i class="icon-table"></i>
									Punishment
								</h3>
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin">
									<thead>
										<tr>
											<th>Jangka</th>
											<th>SP1</th>
											<th>SP2</th>
											<th>SP3</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Periode Sebelumnya</td>
											<td><?php echo $repu->punishment['SP1'];?></td>
											<td><?php echo $repu->punishment['SP2'];?></td>
											<td><?php echo $repu->punishment['SP3'];?></td>
										</tr>
										<tr>
											<td>Tahun ini</td>
											<td><?php echo $repu->punishment['SP1t'];?></td>
											<td><?php echo $repu->punishment['SP2t'];?></td>
											<td><?php echo $repu->punishment['SP3t'];?></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>

				</div>
			</div>

	</div> <?php //akhir div container content ?>
	</body>
<script type="text/javascript">
	(function ($) {
		var i = 0
		var series = [{
			data: [
			['1', <?php echo number_format($rkp->alquran_p,2); ?>],
			['2', <?php echo number_format($rkp->tahajud_p,2); ?>],
			['3', <?php echo number_format($rkp->sodaqoh_p,2); ?>],
			['4', <?php echo number_format($rkp->puasa_p,2); ?>]
			],
			label: 'Muhasabah Bulan Ini (%)'
		}];

		var options = {
			xaxis: {
				ticks: [
				['1', 'Al-Quran'],
				['2', 'Tahajud'],
				['3', 'Shodaqoh'],
				['4', 'Puasa']
				]
			},
			series: {
				bars: {
					show: true,
					barWidth: .9,
					align: "center"
				},
				stack: 0
			}
		};

		$.plot("#mhb", series, options);
	})(jQuery);

	(function ($) {
		var i = 0
		var series = [{
			data: [
			['1', <?php echo number_format($rkp->alquran_p,2); ?>],
			['2', <?php echo number_format($rkp->tahajud_p,2); ?>],
			['3', <?php echo number_format($rkp->sodaqoh_p,2); ?>],
			['4', <?php echo number_format($rkp->puasa_p,2); ?>],
			['5', <?php echo number_format($rkp->alquran_p,2); ?>],
			['6', <?php echo number_format($rkp->tahajud_p,2); ?>],
			['7', <?php echo number_format($rkp->sodaqoh_p,2); ?>],
			['8', <?php echo number_format($rkp->puasa_p,2); ?>],
			['9', <?php echo number_format($rkp->alquran_p,2); ?>],
			['10', <?php echo number_format($rkp->tahajud_p,2); ?>],
			['11', <?php echo number_format($rkp->sodaqoh_p,2); ?>],
			['12', <?php echo number_format($rkp->puasa_p,2); ?>]
			],
			label: 'KPI Tahun Ini (%)'
		}];

		var options = {
			xaxis: {
				ticks: [
				['1', 'Jan'],
				['2', 'Feb'],
				['3', 'Mar'],
				['4', 'Apr'],
				['5', 'Mei'],
				['6', 'Juni'],
				['7', 'Juli'],
				['8', 'Agust'],
				['9', 'Sept'],
				['10', 'Okt'],
				['11', 'Nov'],
				['12', 'Des']
				]
			},
			series: {
				lines: {
					show: true,
					barWidth: .9,
					align: "center"
				},
				stack: 0
			}
		};

		$.plot("#kpi", series, options);
	})(jQuery);

</script>
<script>
	var data = [
	{ label: "Alpha",  data: <?php echo $rkp->alpha_b; ?>, color: "#4572A7"},
	{ label: "Cuti",  data: <?php echo $rkp->cuti_b; ?>, color: "#80699B"},
	{ label: "Hadir",  data: <?php echo $rkp->hadir_b; ?>, color: "#AA4643"},
	{ label: "Ijin",  data: <?php echo $rkp->ijin_b; ?>, color: "#3D96AE"},
	{ label: "Sakit",  data: <?php echo $rkp->sakit_b; ?>, color: "#89A54E"},
	{ label: "Tugas",  data: <?php echo $rkp->tugas_b; ?>, color: "#3D96AE"},
	{ label: "Telat",  data: <?php echo $rkp->telat_b; ?>, color: "#3D923E"}
	];

	$(document).ready(function () {
		$.plot($("#prs"), data, {
			series: {
				pie: {
					show: true	
				}
			},
			legend: {
				show: false
			}
		});
	});
</script>

	</html>
            