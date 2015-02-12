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
			<p class=""style="font-size:24px;">Pelatihan</p>
		</div>
		<div class="row">
			<table style="width:100%">				
				<tbody>
					<tr>
						<td style="width:29%">
							Pelatihan	
						</td>
						<td style="width:71%">
							: 
							<?php
								echo $pelatihan->lth->nma_lth;
							?>
						</td>
					</tr>

					<tr>
						<td style="width:29%">
							Alamat
						</td>
						<td style="width:71%">
							: 
							<?php
								echo $pelatihan->lth->tmp_lth;
							?>
						</td>
					</tr>
					<tr>
						<td style="width:29%">
							Tanggal Pelaksanaan	
						</td>
						<td style="width:71%">
							:
							<?php
							$tgl_lth_awal = explode('-', $pelatihan->lth->waktu_lth_awal);
							$tgl_lth_akhir = explode('-', $pelatihan->lth->waktu_lth_akhir);

							echo $tgl_lth_awal[2].'-'.$tgl_lth_awal[1].'-'.$tgl_lth_awal[0].' - '.$tgl_lth_akhir[2].'-'.$tgl_lth_akhir[1].'-'.$tgl_lth_akhir[0];
							?>
						</td>
					</tr>

				</tbody>
			</table>
		</div>


		<div class="row" style="margin-top:30px;">
			<table style="width:100%">
				<tbody>
				<tr>
					<td valign="top" style="width:29%" rowspan="<?php echo count($pelatihan->anggota);?>">
						Anggota
					</td>
				<?php
					$i = 1;
					foreach ($pelatihan->anggota as $agt)
					{										
						if ($i == 1)
						{
				?>
					<td style="width:1%"> : </td>
					<td>
						<?php
							echo $i.'. '.$agt->nma_lkp_pgw;
						?>
					</td>
				</tr>
				<?php
						}
						else
						{
				?>
				<tr>
					<td style="width:1%">
							:
					</td>
					<td>
						<?php
							echo $i.'. '.$agt->nma_lkp_pgw;
						?>
					</td>
				</tr>
				<?php
						}
						$i++;
					}
				?>
				</tbody>
			</table>
		</div>

		<div class="row" style="margin-top:30px;">
			<table style="width:100%">
				<tbody>
					<tr>
						<td style="width:29%" rowspan="3">
							Status
						</td>
						<td style="width:1%"> : </td>
						<td>
							<?php
								if ($pelatihan->lth->stat_lth == 'Y')
								{
									echo "<font color='red'>Diterima</font>";
								}
								else if ($pelatihan->lth->stat_lth == 'T')
								{
									echo "<font color='red'>Ditolak</font>";
								}
								else if ($pelatihan->lth->stat_lth == 'N')
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