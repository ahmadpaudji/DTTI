<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Beranda</h1>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6">
					<?php
					if ($this->session->userdata('level') == "admin" && $this->session->userdata('hak') == "admin" ) 
					{
						date_default_timezone_set("Asia/Jakarta");
						if (date("d",now()) == "21")
						{
					?>
						<div class="alert">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							Silahkan konfigurasi tanggal libur !
						</div>
					<?php
						}
					}
					?>
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
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Bulan ini</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
										</tr>
										<tr>
											<td>Tahun ini</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
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
											<td>Bulan ini</td>
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
				<?php
				    if ($this->session->userdata("hak") == 'admin')
        			{
				?>
				<div class="row-fluid">
					<div class="span6">
						<div class="box">
							<div class="box-title">
								<h3>
									<i class="icon-table"></i>
									Pelatihan
								</h3>
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin">
									<thead>
										<tr>
											<th>Jangka</th>
											<th>Belum Konfirmasi</th>
											<th>Tolak</th>
											<th>Setuju</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Hari ini</td>
											<td><?php echo $rkp->blm_h;?></td>
											<td><?php echo $rkp->tolak_h;?></td>
											<td><?php echo $rkp->setuju_h;?></td>
										</tr>
										<tr>
											<td>Bulan ini</td>
											<td><?php echo $rkp->blm_b;?></td>
											<td><?php echo $rkp->tolak_b;?></td>
											<td><?php echo $rkp->setuju_b;?></td>
										</tr>
										<tr>
											<td>Tahun ini</td>
											<td><?php echo $rkp->blm_t;?></td>
											<td><?php echo $rkp->tolak_t;?></td>
											<td><?php echo $rkp->setuju_t;?></td>
										</tr>
									</tbody>
								</table>
							</div>
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
										Presensi Tahun <?php echo date("Y") ?>
									</h3>
								</div>
							<div id="prs" class='flot'></div>
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
			['1', <?php echo 0; ?>],
			['2', <?php echo 0; ?>],
			['3', <?php echo 0; ?>],
			['4', <?php echo 0; ?>]
			],
			label: 'Tahun <?php echo date("Y") ?>'
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

	var data = [
	{ label: "Alpha",  data: <?php echo $rkp->alpha_t; ?>, color: "#4572A7"},
	{ label: "Cuti",  data: <?php echo $rkp->cuti_t; ?>, color: "#80699B"},
	{ label: "Hadir",  data: <?php echo $rkp->hadir_t; ?>, color: "#AA4643"},
	{ label: "Ijin",  data: <?php echo $rkp->ijin_t; ?>, color: "#3D96AE"},
	{ label: "Sakit",  data: <?php echo $rkp->sakit_t; ?>, color: "#89A54E"},
	{ label: "Tugas",  data: <?php echo $rkp->tugas_t; ?>, color: "#3D96AE"},
	{ label: "Telat",  data: <?php echo $rkp->telat_t; ?>, color: "#3D923E"}
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
            