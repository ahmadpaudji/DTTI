<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Presensi</h1>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-edit"></i>Data Presensi</h3>
							</div>
							<div class="box-content">
							<form action="<?php echo base_url() ; ?>admin/presensi/cari" method="POST" class='form-horizontal form-validate'>
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
									<label for="nama" class="control-label">Status</label>
									<div class="controls">
										<div class="input-xlarge">
											<select name="status" id="status" class='input-small'>
												<option value="">Semua</option>
												<option value="alpha">Alpha</option>
												<option value="cuti">Cuti</option>
												<option value="hadir">Hadir</option>
												<option value="ijin">Ijin</option>
												<option value="libur">Libur</option>
												<option value="sakit">Sakit</option>
												<option value="tugas">Tugas</option>
											</select>
										</div>
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
									Daftar Kehadiran
								</h3>
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin dataTable table-bordered">
									<thead>
										<tr>
											<th>No.</th>
											<th>Nama</th>
											<th class='hidden-350'>Status</th>
											<th class='hidden-350'>Tanggal</th>
											<th class='hidden-350'>Jam Masuk</th>
											<th class='hidden-350'>Telat</th>
											<th class='hidden-350'>Jam Keluar</th>
											<th class='hidden-350'>Lama Kerja</th>
											<th class='hidden-350'>Aksi</th>
										</tr>
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
													echo $pres->nma_lkp_pgw;
												?>
											</td>
											<td>
												<?php
													echo $pres->stat_prs;
												?>
											</td>
											<td class='hidden-350'>
												<?php
													$tgl_prs = explode('-', $pres->tgl_prs);
													echo $tgl_prs[2].'-'.$tgl_prs[1].'-'.$tgl_prs[0];
												?>
											</td>
											<td class='hidden-350'>
												<?php
													if ($pres->jm_msk_prs == null)
													{
														echo '<i class="icon-minus"></i>';
													}
													else
													{
														echo $pres->jm_msk_prs;
													}
												?>
											</td>
											<td class='hidden-350'>
												<?php
													if ($pres->tlt_prs == "00:00:00" || $pres->tlt_prs == null)
													{
														echo '<i class="icon-remove"></i>';
													}
													else
													{
														echo '<i class="icon-ok"></i>';
													}
												?>
											</td>
											<td class='hidden-350'>
												<?php
													if ($pres->jm_klr_prs == null)
													{
														echo '<i class="icon-minus"></i>';
													}
													else
													{
														echo $pres->jm_klr_prs;
													}
												?>
											</td>
											<td class='hidden-350'>
												<?php
													if ($pres->wkt_krj == null)
													{
														echo '<i class="icon-minus"></i>';
													}
													else
													{
														echo $pres->wkt_krj;
													}
												?>
											</td>
											<td class="btn-group">
												<a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle"><i class="icon-cogs"></i> <span class="caret"></span></a>
												<ul class="dropdown-menu">
													<li>
														<a href="<?php echo base_url(); ?>admin/absen/ubah/<?php echo $pres->id_prs; ?>">Ubah</a>
													</li>
												</ul>
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