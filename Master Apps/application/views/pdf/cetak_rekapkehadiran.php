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
			<p class=""style="font-size:24px;">Rekapitulasi Kehadiran</p>
		</div>		
		<?php
			if ($tgl_awl != '')
			{
				$tgl_awal = explode('/', $tgl_awl);
	            $tanggal_awal = $tgl_awal[1].'-'.$tgl_awal[0].'-'.$tgl_awal[2];
	        }
	        else
	        {
	        	$tanggal_awal = '-';
	        }

	        if ($tgl_akh != '')
			{
				$tgl_akhir = explode('/', $tgl_akh);
	            $tanggal_akhir = $tgl_akhir[1].'-'.$tgl_akhir[0].'-'.$tgl_akhir[2];
			}
	        else
	        {
	        	$tanggal_akhir = '-';
	        }
		?>
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
						<td>Per-tanggal</td>
						<td>:</td>
						<td><?php echo $tanggal_awal.' sampai '.$tanggal_akhir;?></td>
					</tr>
				</tbody>
			</table>
		</div>


		<div class="row">
			<table class="table table-bordered">
				<thead>
					<th>No</th>
					<th>Nama</th>
					<th>Alpha</th>
					<th>Cuti</th>
					<th>Hadir</th>
					<th>Izin</th>
					<th>Sakit</th>
					<th>Tugas</th>
					<th>Total</th>
				</thead>
				<tbody>
					<?php
					$i = 1;
					foreach ($presensi as $pres) 
					{
						?>
						<tr>
							<td>
								<?php
								echo $i++;
								?>
							</td>
							<td>
								<?php
								echo $pres['nma_lkp_pgw'];
								?>
							</td>
							<td>
								<?php
								echo $pres['alpha'];
								?>
							</td>
							<td>
								<?php
								echo $pres['cuti'];
								?>
							</td>
							<td>
								<?php
								echo $pres['hadir'];
								?>
							</td>
							<td>
								<?php
								echo $pres['ijin'];
								?>
							</td>
							<td>
								<?php
								echo $pres['sakit'];
								?>
							</td>
							<td>
								<?php
								echo $pres['tugas'];
								?>
							</td>
						</tr>
						<?php
					}
					?>
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