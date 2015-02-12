<html>
	<head>
		<link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.min.css">
		<style>
			table{
				font-size:10px;
			}
		</style>
	</head>
	<body>
		<div class="row text-center">
			<img src="<?php echo base_url("assets/img/kop_surat.png"); ?>" alt="">
		</div>
		<div class="row" style="margin-top :50px;margin-bottom:25px;">
			<p class="text-center" style="font-size:24px;">Rekapitulasi KPI Perusahaan</p>
		</div>		

		<div class="row">
			<table class="table">
				<tbody>
					<tr>
						<td>Tanggak Cetak</td>
						<td> : </td>
						<td>
							<?php
								date_default_timezone_set("Asia/Jakarta"); 
								echo date("d-m-Y")
							?>
						</td>

					</tr>
					<tr>
						<td>Tahun</td>
						<td>:</td>
						<td><?php echo date("Y");?></td>
					</tr>
				</tbody>
			</table>
		</div>


		<div class="row">
			<table class="table table-bordered">
					<td> </td>
					<td>Jan</td>
					<td>Feb</td>
					<td>Mar</td>
					<td>Apr</td>
					<td>May</td>
					<td>Jun</td>
					<td>Jul</td>
					<td>Aug</td>
					<td>Sept</td>
					<td>Oct</td>
					<td>Nov</td>
					<td>Dec</td>
					<td>Ttl</td>
				<tbody>
					<tr>
						<td>Pelatihan</td>
						<?php
						$t_pelatihan = 0;
						foreach ($kpi->pelatihan as $p)
						{
							?>
							<td>
								<?php
								echo number_format($p['kpi'],2).' %';
								$t_pelatihan = $t_pelatihan + number_format($p['kpi'],2);
								?>
							</td>
							<?php
						}
						?>
						<td>
							<?php
							echo number_format(($t_pelatihan/12),2).' %';
							?>
						</td>
					</tr>
					<tr>
						<td>Kedisiplinan</td>
						<?php
						$t_presensi = 0;
						foreach ($kpi->presensi as $pr)
						{
							?>
							<td>
								<?php
								echo number_format($pr['kpi'],2).' %';
								$t_presensi = $t_presensi + number_format($pr['kpi'],2);
								?>
							</td>
							<?php
						}
						?>
						<td>
							<?php
							echo number_format(($t_presensi/12),2).' %';
							?>
						</td>
					</tr>
					<tr>
						<td>Muhasabah</td>
						<?php
						$t_muhasabah = 0;
						foreach ($kpi->muhasabah as $mh)
						{
							?>
							<td>
								<?php
								echo number_format($mh['kpi'],2).' %';
								$t_muhasabah = $t_muhasabah + number_format($mh['kpi'],2);
								?>
							</td>
							<?php
						}
						?>
						<td>
							<?php
							echo number_format(($t_muhasabah/12),2).' %';
							?>
						</td>
					</tr>
					<tr>
						<td colspan="13" class="text-center">SubTotal</td>
						<td class="text-center">
							<?php
								echo number_format((($t_muhasabah/12) + ($t_presensi/12) + ($t_pelatihan/12)),2).' %';
							?>
						</td>
					</tr>
				</tbody>
				
			</table>
		</div>
		
		<div class="row" style="margin-top:90px;">
			
			<table class='' style="width:100%">
				<thead style="border : none;border-color:white;">
					<th>Pengaju</u></th>
					<th colspan="3">Disetujui,</th>
				</thead>
				<tbody style="border : none;border-color:white;margin-top:100px;">
					<tr style="border : none;border-color:white;">
						<td class="text-center" style="margin-top:100px;"><p style="margin-top:100px;"><u><?php echo $direktur['kepala']->nma_lkp_pgw;?></u><br> Kepala Sekretariat </p></td>
						<td class="text-center" style="margin-top:100px"><p style="margin-top:100px;"><u><?php echo $direktur['direktur marketing']->nma_lkp_pgw;?></u><br>Direktur Marketing</p></td>
						<td class="text-center" style="margin-top:100px;"><p style="margin-top:100px;"><u><?php echo $direktur['direktur operasional']->nma_lkp_pgw;?></u><br>Direktur Operasional</p></td>
						<td class="text-center" style="margin-top:100px;"><p style="margin-top:100px;"><u><?php echo $direktur['direktur utama']->nma_lkp_pgw;?></u><br>Direktur Utama</p></td>
				</tbody>
			</table>

		</div>
		
	</body> 
</html>