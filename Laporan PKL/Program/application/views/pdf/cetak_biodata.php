<html>
	<head>
		<link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.min.css">
		<style>
			table{
			font-size:10px;
		}
		</style>
	</head>
	<body style="text-transform: uppercase;">
		<div class="row text-center" style="width:80%;margin-left:10%;height:100px;">
			<img src="<?php echo base_url("assets/img/kop_surat.png"); ?>" alt="" style="width:100%;height:100%">
		</div>
	
		<div class="row" style="margin-top :50px;margin-bottom:25px;">
			<p class=""style="font-size:24px;">Data Pegawai</p>
		</div>		
		<div class="row">
			<table class="table table-stripped">
				<tr>
					<td>Nama</td>
					<td>:</td>
					<td><?php echo $pegawai->pegawai->nma_lkp_pgw;?></td>
				</tr>
				<tr>
					<td>NIK</td>
					<td>:</td>
					<td><?php echo $pegawai->pegawai->nik_pgw;?></td>
				</tr>
				<tr>
					<td>TTL</td>
					<td>:</td>
					<td>
					<?php
						$tanggal = explode('-', $pegawai->pegawai->tgl_lhr_pgw); 
						echo $tanggal[2].'-'.$tanggal[1].'-'.$tanggal[0];
					?>
					</td>
				</tr>
				<tr>
					<td>Alamat</td>
					<td>:</td>
					<td><?php echo $pegawai->pegawai->almt_pgw;?></td>
				</tr>
				<tr>
					<td>Status</td>
					<td>:</td>
					<td><?php echo $pegawai->pegawai->stat_pgw;?></td>
				</tr>
				<tr>
					<td>Pasangan</td>
					<td>:</td>
					<td>
					<?php
						if ($pegawai->pegawai->nma_psg_pgw != null)
						{ 
							echo $pegawai->pegawai->nma_psg_pgw;
						}
						else
						{
							echo '-';
						}
					?>
					</td>
				</tr>
				<tr>
					<td>Gol Darah</td>
					<td>:</td>
					<td><?php echo $pegawai->pegawai->gol_drh_pgw;?></td>
				</tr>
				
				<tr>
					<td>Divisi</td>
					<td>:</td>
					<td><?php echo $pegawai->pegawai->div_jbtn;?></td>
				</tr>
				<tr>
					<td>Jabatan</td>
					<td>:</td>
					<td><?php echo $pegawai->pegawai->nma_jbtn;?></td>
				</tr>
				<tr>
					<td>KTP</td>
					<td>:</td>
					<td><?php echo $pegawai->pegawai->no_ktp_pgw;?></td>
				</tr>
				<tr>
					<td>NPWP</td>
					<td>:</td>
					<td><?php echo $pegawai->pegawai->npwp_pgw;?></td>
				</tr>
				<tr>
					<td>E-Mail</td>
					<td>:</td>
					<td><?php echo $pegawai->pegawai->email_pgw;?></td>
				</tr>
				<tr>
					<td>Hp</td>
					<td>:</td>
					<td><?php echo $pegawai->pegawai->hp_pgw;?></td>
				</tr>
				
			</table>
		</div>
<br />
<br />
<br />
		<div class="row" style="margin-top :50px;margin-bottom:20px;">
			<p class=""style="font-size:24px;">Data SIM</p>
		</div>		

		<div class="row">
			<table class="table">
				<thead>
					<th>No Sim</th>
					<th>Jenis Sim</th>
				</thead>
				<tbody>

				<?php
					if ($pegawai->sim != null)
					{
				?>
					<tr>
						<td><?php echo $pegawai->sim->no_sim;?></td>
						<td><?php echo $pegawai->sim->jns_sim;?></td>
					</tr>
				<?php
					}
					else
					{
				?>
					<tr>
						<td>-</td>
						<td>-</td>
					</tr>
				<?php
					}
				?>
				</tbody>
			</table>
		</div>

		<div class="row" style="margin-top :50px;margin-bottom:25px;">
			<p class=""style="font-size:24px;">Data Rekening Bank</p>
		</div>		

		<div class="row">
			<table class="table">
				<thead>
					<th>Bank</th>
					<th>No Rekening</th>
				</thead>
				<tbody>

				<?php
					if ($pegawai->rekening != null)
					{
				?>
					<tr>
						<td><?php echo $pegawai->rekening->sktn_bank;?></td>
						<td><?php echo $pegawai->rekening->no_rek;?></td>
					</tr>
					<?php
					}
					else
					{
					?>

					<tr>
						<td>-</td>
						<td>-</td>
					</tr>
				<?php
					}
				?>
				</tbody>
			</table>
		</div>

		<div class="row" style="margin-top :50px;margin-bottom:25px;">
			<p class=""style="font-size:24px;">Data Pendidikan Formal</p>
		</div>		

		<div class="row">
			<table class="table">
				<thead>
					<th>No</th>
					<th>Pendidikan</th>
					<th>Tahun Lulus</th>
					<th>Status</th>
				</thead>
				<tbody>

			<?php
				if ($pegawai->formal != null)
				{
			?>
				<?php
					$i = 0;
					foreach ($pegawai->formal as $f)
					{
						$i++;
				?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $f->skt_pnd_formal;?></td>
						<td><?php echo $f->thn_dtl_formal;?></td>
						<td><?php echo $f->stat_dtl_formal;?></td>
					</tr>
				<?php
					}
				}
				else
				{
				?>
					<tr>
						<td>-</td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
					</tr>
				<?php
				}
				?>
				</tbody>
			</table>
		</div>

		<div class="row" style="margin-top :50px;margin-bottom:25px;">
			<p class=""style="font-size:24px;">Data Pendidikan Inforrmal</p>
		</div>		

		<div class="row">
			<table class="table">
				<thead>
					<th>No</th>
					<th>Pendidikan</th>
					<th>Nama Tempat</th>
				</thead>
				<tbody>

					<?php
						if ($pegawai->informal != null)
						{
					?>
						<?php
							$i = 0;
							foreach ($pegawai->informal as $if)
							{
								$i++;
						?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $if->nma_pnd_informal;?></td>
						<td><?php echo $if->nma_dtl_informal;?></td>
					</tr>
					<?php
							}
						}
						else
						{
					?>

					<tr>
						<td>-</td>
						<td>-</td>
						<td>-</td>
					</tr>
					<?php
						}
					?>
				</tbody>
			</table>
		</div>
	

	<div class="row" style="margin-top :50px;margin-bottom:25px;">
			<p class=""style="font-size:24px;">Data Usaha</p>
	</div>		

		<div class="row">
			<table class="table">
				<thead>
					<th>No</th>
					<th>Jenis Usaha</th>
					<th>Nama Usaha</th>
				</thead>
				<tbody>

				<?php
					if ($pegawai->usaha != null)
					{
				?>
				<?php
						$i = 0;
						foreach ($pegawai->usaha as $u)
						{
						$i++;
				?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $u->jns_ush_akt;?></td>
						<td><?php echo $u->nma_ush_akt;?></td>
					</tr>
				<?php
						}
					}
					else
					{
				?>
					<tr>
						<td>-</td>
						<td>-</td>
						<td>-</td>
					</tr>
				<?php
					}
				?>
				</tbody>
			</table>
		</div>

		<div class="row" style="margin-top :60px;margin-bottom:25px;">
			<p class=""style="font-size:24px;">Data Anak</p>
		</div>		

		<div class="row">
			<table class="table">
				<thead>
					<th>No</th>
					<th>Anak Ke -</th>
					<th>Nama Anak</th>
					<th>JK</th>
					<th>TTL</th>
				</thead>
				<tbody>
					<?php
						if ($pegawai->anak != null)
						{
					?>

					<?php
							$i = 0;
							foreach ($pegawai->anak as $a)
							{
								$i++;
					?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $a->no_urut_anak;?></td>
						<td><?php echo $a->nma_anak;?></td>
						<td><?php echo $a->jk_anak;?></td>
						<td><?php echo $a->tmp_lhr_anak.', '.$a->tgl_lhr_anak;?></td>
					</tr>
					<?php
							}
						}
						else
						{
					?>
					<tr>
						<td>-</td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
					</tr>

					<?php
						}
					?>
				</tbody>
			</table>
		</div>

		<div class="row" style="margin-top :50px;margin-bottom:25px;">
			<p class=""style="font-size:24px;">Data Kendaraan</p>
		</div>		

		<div class="row">
			<table class="table">
				<thead>
					<th>Merk</th>
					<th>No Polisi</th>
					<th>Stiker</th>
				</thead>
				<tbody>

					<?php
						if ($pegawai->kendaraan != null)
						{
					?>
					<tr>
						<td><?php echo $pegawai->kendaraan->merk_kdr_mtr;?></td>
						<td><?php echo $pegawai->kendaraan->nopol_kdr_mtr;?></td>
						<td><?php echo $pegawai->kendaraan->stat_kdr_mtr;?></td>
					</tr>
					<?php
						}
						else
						{
					?>
					<tr>
						<td>-</td>
						<td>-</td>
						<td>-</td>
					</tr>

					<?php
						}
					?>
				</tbody>
			</table>
		</div>
	
	</body> 
</html>