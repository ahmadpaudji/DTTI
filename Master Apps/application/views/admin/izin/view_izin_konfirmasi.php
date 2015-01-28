<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Izin Presensi</h1>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span12">
						<?php
						if ($this->session->flashdata("notif"))
						{
						?>
						<div class="alert alert-<?php echo $this->session->flashdata('alert');?>">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<?php echo $this->session->flashdata('notif');?>
						</div>
						<?php
							}
						?>
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-edit"></i>Data Izin Presensi</h3>
							</div>
							<div class="box-content">
							<form action="<?php echo base_url()."admin/izin/konfirmasi/cari" ; ?>" method="POST" class='form-horizontal form-validate'>
								
								<div class="control-group">
									<label for="textfield" class="control-label">Nama</label>
									<div class="controls">
										<div class="input-xlarge">
											<select name="pegawai" id="pegawai" class='chosen-select'>
												<option value="">Semua</option>
												<?php
												foreach ($pegawai as $pgw)
												{
													?>
													<option value="<?php echo $pgw->id_pgw; ?>"><?php echo $pgw->nma_lkp_pgw; ?></option>
													<?php
												}
												?>
											</select>
										</div>
									</div>
								</div>
								<div class="control-group">
									<label for="textfield" class="control-label">Tanggal Awal</label>
									<div class="controls">
										<input type="text" name="tanggal_awal" class="input-medium datepick">
									</div>
								</div>
								<div class="control-group">
									<label for="textfield" class="control-label">Tanggal Akhir</label>
									<div class="controls">
										<input type="text" name="tanggal_akhir" class="input-medium datepick">
									</div>
								</div>
								<div class="control-group">
									<div class="controls">
									<button type="submit" class="btn btn-primary">Cari</button>
									</div>
								</div>
							</form>
								<div class="control-group">
									Catatan : Tidak perlu diisi jika tidak diperlukan
								</div>
							</div>
							
						</div>
					</div>
				</div>
				<?php
					if ($tampil == "true")
					{
				?>
				<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="icon-table"></i>
									Data Izin Presensi
								</h3>
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin dataTable table-bordered">
									<thead>
										<tr>
											<th>No.</th>
											<th>Nama Pegawai</th>
											<th class='hidden-350'>Tanggal Pengajuan</th>
											<th class='hidden-350'>Jenis</th>
											<th class='hidden-350'>Tanggal Absen</th>
											<th class='hidden-350'>Status</th>
											<th class='hidden-350'>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$i = 1;
											foreach ($izin as $iz) 
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
													echo $iz->nma_lkp_pgw;
												?>
											</td>
											<td class='hidden-350'>
												<?php
													$tgl = explode('-', $iz->tgl_pjn_abs);
            										$tanggal = $tgl[2].'-'.$tgl[1].'-'.$tgl[0];
													echo $tanggal;
												?>
											</td>
											<td class='hidden-350'>
												<?php
													echo $iz->jns_abs;
												?>
											</td>
											<td class='hidden-350'>
												<?php
													$tgl_mulai = explode('-', $iz->wkt_abs_awl);
            										$tanggal_mulai = $tgl_mulai[2].'-'.$tgl_mulai[1].'-'.$tgl_mulai[0];
            										$tgl_akhir = explode('-', $iz->wkt_abs_akr);
            										$tanggal_akhir = $tgl_akhir[2].'-'.$tgl_akhir[1].'-'.$tgl_akhir[0];
													echo $tanggal_mulai.' - '.$tanggal_akhir;
												?>
											</td>
											<td class='hidden-350'>
												<?php
												if ($iz->stat_abs == 'Y')
												{
													echo "<font color='red'>Diterima</font>";
												}
												else if ($iz->stat_abs == 'T')
												{
													echo "<font color='red'>Ditolak</font>";
												}
												else if ($iz->stat_abs == 'N')
												{
													echo "<font color='red'>Belum dikonfirmasi</font>";
												}
												?>
											</td>
											<td class="btn-group">
												<a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle"><i class="icon-cogs"></i> <span class="caret"></span></a>
												<ul class="dropdown-menu">
												<?php
												if ($iz->stat_abs == 'N')
												{
												?>
													<li>
														<a href="<?php echo base_url(); ?>admin/izin/setuju/<?php echo $iz->id_abs.'/Y'; ?>">Setujui</a>
													</li>
													<li>
														<a href="<?php echo base_url(); ?>admin/izin/setuju/<?php echo $iz->id_abs.'/T'; ?>">Tolak</a>
													</li>
												<?php
												}
												else if ($iz->stat_abs == 'T' || $iz->stat_abs == 'Y')
												{
												?>
													<li>
														<a>Tidak ada</a>
													</li>
												<?php
												}
												?>
												</ul>
												<a href="<?php echo base_url(); ?>admin/izin/detail/<?php echo $iz->id_abs; ?>/konfirmasi" style="margin-left:2px" class="btn btn-primary"><i class="icon-eye-open"></i></a>
											</td>
										</tr>
										<?php
											}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<?php
					}
				?>
			</div>
		</div>

	</div> <?php //akhir div container content ?>
	</body>

	</html>