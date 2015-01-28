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
			<p class="text-center"style="font-size:24px;">REKAPITULASI LAPORAN<br/><br/>PENGAJUAN IZIN PRESENSI</p>
		</div>		

		<div class="row">
			<table align="center" class="table">
				<tbody>
					<tr>
						<td>Tanggak Awal</td>
						<td> : </td>
						<td>
							<?php
								$tgl_awal = explode('-', $izin->tanggal_awal);
								echo $tgl_awal[2].'-'.$tgl_awal[1].'-'.$tgl_awal[0];
							?>
						</td>
					</tr>
					<tr>
						<td>Tanggak Akhir</td>
						<td> : </td>
						<td>
							<?php
								$tgl_akhir = explode('-', $izin->tanggal_akhir);
								echo $tgl_akhir[2].'-'.$tgl_akhir[1].'-'.$tgl_akhir[0];
							?>
						</td>
					</tr>
					<tr>
						<td>Status</td>
						<td>:</td>
						<td>Diterima</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="row">
			<table class="table table-bordered">
				
					<tr>
					<td>NO</td>
					<td>NAMA</td>
					<td>SAKIT</td>
					<td>IZIN</td>
					<td>CUTI</td>
					<td>TOTAL</td>
					</tr>
				
				<tbody>
				<?php
					$i = 1;
					foreach ($izin->izn as $iz)
					{
				?>
					<tr >
						<td align="center">
							<?php
							echo $i++;
							?>
						</td>
						<td>
							<?php
							echo $iz['nama'];
							?>
						</td>
						<td align="center">
							<?php
							echo $iz['sakit'];
							?>
						</td>
						<td align="center">
							<?php
							echo $iz['ijin'];
							?>
						</td>
						<td align="center">
							<?php
							echo $iz['cuti'];
							?>
						</td>
						<td align="center">
							<?php
							echo $iz['sakit'] + $iz['ijin'] + $iz['cuti'];
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