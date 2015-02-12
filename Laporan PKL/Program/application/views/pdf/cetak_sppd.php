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

		<div class="row">
			<p class="text-center">
				<u class=""> SURAT PERINTAH PERJALANAN DINAS</u><br>
				<?php
					date_default_timezone_set("Asia/Jakarta"); 
					$tanggal_cetak =  date("d-m-Y");
					
				?>
				No : <?php echo $spd->sppd->id_sppd;;?>/int/PT DTI/<?php echo $bln_romawi;?>/<?php echo date('Y'); ?>

			</p>	
		</div>

		<div class="row">
			<table style="width:100%">				
				<tbody>
					<tr>
						<td style="width:29%">
							Perusahaan	
						</td>
						<td style="width:71%">
							: 
							<?php
								echo $spd->sppd->nma_tmp_sppd;
							?>
						</td>
					</tr>

					<tr>
						<td style="width:29%">
							Yang bertugas
						</td>
						<td style="width:71%">
							: 
							<?php
								echo $spd->sppd->nma_lkp_pgw;
							?>
						</td>
					</tr>
					<tr>
						<td style="width:29%">
							Posisi	
						</td>
						<td style="width:71%">
							:
							<?php
								echo $spd->sppd->nma_jbtn;
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
					<td valign="top" style="width:29%" rowspan="<?php echo count($spd->anggota);?>">
						Pengikut
					</td>
				<?php
					$i = 1;
					foreach ($spd->anggota as $agt)
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
							Ruang Lingkup Pekerjaan
						</td>
						<td style="width:1%"> : </td>
						<td>
							<?php
								$tgl_plk = explode('-', $spd->sppd->tgl_plk_sppd);

								echo $spd->sppd->agenda_sppd." pada tanggal ".$tgl_plk[2].'-'.$tgl_plk[1].'-'.$tgl_plk[0];
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
						<td style="width:29%">
							Lokasi
						</td>
						<td style="width:1%"> : </td>
						<td>
						<?php
							echo $spd->sppd->almt_tmp_sppd;
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
						<td style="width:29%" >
							Telepon
						</td>
						<td style="width:1%"> : </td>
						<td>
							<?php
								echo $spd->sppd->tlp_kga_sppd;
							?>
						</td>
					</tr>
					<tr>
						<td style="width:29%" >
							Bidang/Sektor Usaha
						</td>
						<td style="width:1%"> : </td>
						<td>
							<?php
								echo $spd->sppd->bdg_phn_sppd;
							?>
						</td>
					</tr>
					<tr>
						<td style="width:29%" >
							Unit/Bag. Tempat Pertemuan
						</td>
						<td style="width:1%"> : </td>
						<td>
							<?php
								echo $spd->sppd->jns_tmp_sppd;
							?>
						</td>
					</tr>
				</tbody>
			</table>
		</div>

		
		
		<div class="row" style="margin-top:50px;margin-left:25%">
			<table class='' style="width:50%">
				<thead style="margin-bottom:100px;border : none;border-color:white;">
					<th class="text-center" colspan="3"><?php echo $tanggal_cetak;?><br>Direktur Utama</th>
					<th class="text-center" colspan="3" style="padding-left:50px;margin-left:0%"><?php echo $tgl_plk[2].'-'.$tgl_plk[1].'-'.$tgl_plk[0];?><br>................</th>
				</thead>
				<tbody style="margin-top:100px;">
					<tr class="text-center">
						<td style="margin-top:100px;" colspan='3'> <p style="margin-top:80px;"><u><?php echo $direktur['direktur utama']->nma_lkp_pgw;?></u></p></td>
						<td style="margin-top:100px; padding-left:50px" colspan="3"> <p style="margin-top:80px;margin-left:10%"><u>................</u></p></td>
					</tr>
				</tbody>
				
			</table>		
	
		</div>

		<div class="row" style="margin-top:50px">
			<table style="width:100%">
				<thead>
					<th style="text-align:left">Catatan:</th>
				</thead>
				<tbody>
					<tr>
						<td style="text-transform: none;font-size : 8px">
							Demikian isi laporan hasil pertemuan dengan klien ini kami laporkan,sebagai salah satu bukti telah mengikuti pertemuan dengan yang dimaksud.<br>
							Perhatian! Form ini harus dikembalikan ke sekretariat perusahaan disertakan dengan bukti laporan perjalanan dinas sebagai bukti pelaksanaan pertemuan.
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		
			


	</body> 
</html>