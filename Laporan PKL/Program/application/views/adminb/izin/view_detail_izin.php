<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Izin Presensi</h1>
						<?php
							if ($this->session->userdata['hak'] == "admin")
							{
						?>
							<a href='#' class='btn btn-primary'>Cetak</a>
						<?php
							}
						?>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6">
						<div class="box box-bordered box-color">
							<div class="box-title">
								<h3><i class="icon-th-list"></i>Detil</h3>
							</div>
							<div class="box-content nopadding">
								<div class='form-horizontal form-bordered'>
									<div class="control-group">
										<label class="control-label">Tanggal Pengajuan</label>
										<div class="controls">
											<?php
												$tgl_pgj = explode('-', $izin->tgl_pjn_abs);
												echo $tgl_pgj[2].'-'.$tgl_pgj[1].'-'.$tgl_pgj[0];
											?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Tanggal Absen</label>
										<div class="controls">
											<?php
												$tgl_mulai = explode('-', $izin->wkt_abs_awl);
												$tgl_akhir = explode('-', $izin->wkt_abs_akr);
												echo $tgl_mulai[2].'-'.$tgl_mulai[1].'-'.$tgl_mulai[0].' - '.$tgl_akhir[2].'-'.$tgl_akhir[1].'-'.$tgl_akhir[0];
											?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Nama</label>
										<div class="controls">
											<?php
												echo $izin->nma_lkp_pgw;
											?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Alasan</label>
										<div class="controls">
											<?php
												echo $izin->als_abs;
											?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Jenis</label>
										<div class="controls">
											<?php
												echo $izin->jns_abs;
											?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Status</label>
										<div class="controls">
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
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Penyetuju</label>
										<div class="controls">
											<?php
												echo $izin->apprv_abs;
											?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Divisi (Jabatan)</label>
										<div class="controls">
											<?php
												echo $izin->jbt_abs;
											?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Download</label>
										<div class="controls">
										<?php
											if ($izin->bukti_abs != '')
											{
										?>
											<a href="<?php echo base_url()."admin/izin/download/".$izin->id_abs;?>">Download</a>
										<?php
											}
											else
											{
												echo "Tidak ada file";
											}
										?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>

	</div> <?php //akhir div container content ?>
	</body>

	</html>