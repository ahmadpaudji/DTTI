<html>
	<head>
		<link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.min.css">
		<style>
			html{
				font-size: 5px;
			}

			body{
				font-size: 10px;
			}
			table{
			font-size:10px;
		}
		</style>
	</head>
	<body style="text-transform: uppercase;">
		<div class="row text-center">
			<img src="<?php echo base_url("assets/img/kop_surat.png"); ?>" alt="">
		</div>		

		<div class="row text-center" style="margin-top :50px;margin-bottom:25px;">
			<p class=""style="font-size:24px;">Izin Presensi</p>
		</div>
		<div class="row" style="margin-top:30px;">
			<table style="width:100%">
				<tbody>
					<tr>
						<td style="width:29%" >
							Tanggal Izin
						</td>
						<td style="width:1%"> : </td>
						<td>
							<?php
								$tgl_mulai = explode('-', $izin->wkt_abs_awl);
								$tgl_akhir = explode('-', $izin->wkt_abs_akr);
								echo $tgl_mulai[2].'-'.$tgl_mulai[1].'-'.$tgl_mulai[0].' - '.$tgl_akhir[2].'-'.$tgl_akhir[1].'-'.$tgl_akhir[0];
											
							?>
						</td>
					</tr>
					<tr>
						<td style="width:29%" >
							Nama
						</td>
						<td style="width:1%"> : </td>
						<td>
							<?php
								echo $izin->nma_lkp_pgw;
							?>
						</td>
					</tr>
					<tr>
						<td style="width:29%" >
							Jenis
						</td>
						<td style="width:1%"> : </td>
						<td>
							<?php
								echo $izin->jns_abs;
							?>
						</td>
					</tr>
					<tr>
						<td style="width:29%" >
							Alasan
						</td>
						<td style="width:1%"> : </td>
						<td>
							<?php
								echo $izin->als_abs;
							?>
						</td>
					</tr>
					<tr>
						<td style="width:29%" >
							Status
						</td>
						<td style="width:1%"> : </td>
						<td>
							<?php
								if ($izin->stat_abs == 'Y')
								{
									echo "<font color='red'>Diterima</font>";
								}
								else if ($izin->stat_abs == 'T')
								{
									echo "<font color='red'>Ditolak</font>";
								}
								else if ($izin->stat_abs == 'N')
								{
									echo "<font color='red'>Belum dikonfirmasi</font>";
								}
							?>
						</td>
					</tr>
				</tbody>
			</table>
		</div>

	</body> 
</html>