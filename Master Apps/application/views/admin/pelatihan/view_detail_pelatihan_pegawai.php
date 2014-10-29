<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Pelatihan</h1>
						<?php
							if ($this->session->userdata['hak'] == "admin")
							{
						?>
							<a href='<?php echo base_url(); ?>admin/pelatihan/cetak/<?php echo $pelatihan->lth->id_lth;?>' class='btn btn-primary'>Cetak</a>
						<?php
							}
						?>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6">
						<div class="box box-bordered box-color">
							<div class="box-title">
								<h3><i class="icon-th-list"></i>Detil Pelatihan</h3>
							</div>
							<div class="box-content nopadding">
								<div class='form-horizontal form-bordered'>
									<div class="control-group">
										<label class="control-label">Tanggal Pengajuan</label>
										<div class="controls">
											<?php
												$tgl_pgj = explode('-', $pelatihan->lth->tgl_pjn_lth);
												echo $tgl_pgj[2].'-'.$tgl_pgj[1].'-'.$tgl_pgj[0];
											?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Tanggal Pelaksanaan</label>
										<div class="controls">
											<?php
												$tgl_lth_awal = explode('-', $pelatihan->lth->waktu_lth_awal);
												$tgl_lth_akhir = explode('-', $pelatihan->lth->waktu_lth_akhir);

												echo $tgl_lth_awal[2].'-'.$tgl_lth_awal[1].'-'.$tgl_lth_awal[0].' - '.$tgl_lth_akhir[2].'-'.$tgl_lth_akhir[1].'-'.$tgl_lth_akhir[0];
											?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Pegawai</label>
										<div class="controls">
											<?php
												echo $pelatihan->lth->nma_pju_lth;
											?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Nama</label>
										<div class="controls">
											<?php
												echo $pelatihan->lth->nma_lth;
											?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Alamat</label>
										<div class="controls">
											<?php
												echo $pelatihan->lth->tmp_lth;
											?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Status</label>
										<div class="controls">
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
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Penyetuju</label>
										<div class="controls">
											<?php
												echo $pelatihan->lth->apprv_lth;
											?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Divisi (Jabatan)</label>
										<div class="controls">
											<?php
												echo $pelatihan->lth->jbt_apprv_lth;
											?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="span5">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="icon-table"></i>
									Anggota
								</h3>
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin">
									<thead>
										<tr>
											<th>Nama</th>
											<th class='hidden-350'>Divisi</th>
											<th class='hidden-350'>Jabatan</th>
										</tr>
									</thead>
									<tbody>
										<?php
											foreach ($pelatihan->anggota as $agt)
											{
										?>
										<tr>
											<td>
												<?php
													echo $agt->nma_lkp_pgw;
												?>
											</td>
											<td class='hidden-350'>
												<?php
													echo $agt->div_jbtn;
												?>
											</td>
											<td class='hidden-350'>
												<?php
													echo $agt->nma_jbtn;
												?>
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

			</div>
		</div>

	</div> <?php //akhir div container content ?>
	</body>

	</html>