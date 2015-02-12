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
			<img src="<?php echo base_url("assets/img/kop_surat.jpg"); ?>" alt="">
		</div>
		<div class="row" style="margin-top :50px;margin-bottom:25px;">
			<p class="text-center"style="font-size:24px;">Laporan Pengajuan<br/>Izin Presensi</p>
		</div>		

		<div class="row">
			<table class="table">
				<tbody>
					<tr>
						<td>Tanggak Awal</td>
						<td> : </td>
						<td>
							10-November-2014
						</td>
					</tr>
					<tr>
						<td>Tanggak Akhir</td>
						<td> : </td>
						<td>
							10-November-2014
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
					<th>Tanggal Pengajuan</th>
					<th>Jenis</th>
					<th>Tanggal Absen</th>
					<th>Status</th>
				</thead>
				<tbody>
					<tr>
						<td>1</td>
						<td>Ismail Zakky</td>
						<td>13-November-2014</td>
						<td>Sakit/Izin/Cuti/Tugas</td>
						<td>14-November-2014</td>
						<td>Status</td>
					</tr>
				</tbody>
			</table>
		</div>
		
		<div class="row" style="margin-top:100px;">
			
			<table class='' style="width:100%">
				<thead style="border : none;border-color:white;">
					<th>Pengaju</u></th>
					<th colspan="3">Disetujui</th>
				</thead>
				<tbody style="border : none;border-color:white;margin-top:100px;">
					<tr style="border : none;border-color:white;">
						<td class="text-center" style="margin-top:100px;"><p style="margin-top:100px;"><u><?php echo $direktur['kepala']->nma_lkp_pgw;?></u><br> Kepala Sekretariat </p></td>
						<td class="text-center" style="margin-top:100px"><p style="margin-top:100px;"><u><?php echo $direktur['direktur marketing']->nma_lkp_pgw;?></u><br>Direktur Marketing</p></td>
						<td class="text-center" style="margin-top:100px;"><p style="margin-top:100px;"><u><?php echo $direktur['direktur operasional']->nma_lkp_pgw;?></u><br>Direktur Operasional</p></td>
						<td class="text-center" style="margin-top:100px;"><p style="margin-top:100px;"><u><?php echo $direktur['direktur utama']->nma_lkp_pgw;?></u></p><br>Direktur Utama</p></td>
				</tbody>
			</table>

		</div>
		
	</body> 
</html>