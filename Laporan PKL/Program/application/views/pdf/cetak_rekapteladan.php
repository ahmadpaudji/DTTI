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
			<p class=""style="font-size:24px;">Rekapitulasi Reward Pegawai</p>
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
				</tbody>
			</table>
		</div>


		<div class="row">
			<table class="table table-bordered">
				<thead>
					<th>No</th>
					<th>Nama</th>
					<td>Khusus</td>
					<th>Teladan</th>
				</thead>
				<tbody>
					<?php
						$i = 1;
						foreach ($reward as $rwd)
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
								echo $rwd['nma_lkp_pgw'];
							?>
						</td>
						<td>
							<?php
								echo $rwd['khusus'];
							?>
						</td>
						<td>
							<?php
								echo $rwd['teladan'];
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