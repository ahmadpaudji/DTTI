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
			<p class="text-center" style="font-size:24px;">REKAPITULASI KPI PERSONAL <?php echo strtoupper($kpi->nama);?></p>
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
								echo date("d-m-Y");
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
				<thead>
					<th> </th>
					<th>Jan</th>
					<th>Feb</th>
					<th>Mar</th>
					<th>Apr</th>
					<th>May</th>
					<th>Jun</th>
					<th>Jul</th>
					<th>Aug</th>
					<th>Sept</th>
					<th>Oct</th>
					<th>Nov</th>
					<th>Dec</th>
					<th>Ttl</th>
				</thead>
				<tbody>
					<tr>
						<td>Muhasabah</td>
						<?php
						$t_muhasabah = 0;
						if (count($kpi->muhasabah) > 0)
						{
							$i = 1;
							foreach ($kpi->muhasabah as $mhb)
							{
						?>
						<td>
							<?php
								echo number_format($mhb['kpi'],2).' %'; 
								$t_muhasabah = $t_muhasabah + number_format($mhb['kpi'],2);
							?>
						</td>
						<?php
							}
						}
						?>
						<td>
							<?php
								echo number_format(($t_muhasabah/12),2).' %';
							?>
						</td>
					</tr>
					<tr>
						<td>Kedisiplinan</td>
						<?php
						$t_presensi = 0;
						if (count($kpi->presensi) > 0)
						{
							$i = 1;
							foreach ($kpi->presensi as $prs)
							{
						?>
						<td>
							<?php
								echo number_format($prs['kpi'],2).' %';
								$t_presensi = $t_presensi + number_format($prs['kpi'],2);
							?>
						</td>
						<?php
							}
						}
						?>
						<td>
							<?php
								echo number_format(($t_presensi/12),2).' %';
							?>
						</td>
					</tr>
					
					<tr>
						<td colspan="13" class="text-center">SubTotal</td>
						<td class="text-center">
							<?php
								echo number_format((($t_muhasabah/12) + ($t_presensi/12)),2).' %';
							?>
						</td>
					</tr>
				</tbody>
				
			</table>
		</div>
		
		<div class="row" style="margin-top:100px;">
			
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