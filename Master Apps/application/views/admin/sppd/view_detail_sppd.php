<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>SPPD</h1>
						<?php
							if ($spd->sppd->apprv_sppd == "Y")
							{
						?>
							<a href='<?php echo base_url(); ?>admin/sppd/cetak/<?php echo $spd->sppd->id_sppd;?>' class='btn btn-primary'>CETAK</a>
						<?php
							}
						?>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6">
						<div class="box box-bordered box-color">
							<div class="box-title">
								<h3><i class="icon-th-list"></i>Detil SPPD</h3>
							</div>
							<div class="box-content nopadding">
								<div class='form-horizontal form-bordered'>
									<div class="control-group">
										<label class="control-label">Tanggal Pengajuan</label>
										<div class="controls">
											<?php
												$tgl = explode('-', $spd->sppd->tgl_pju_sppd);
												echo $tgl[2].'-'.$tgl[1].'-'.$tgl[0];
											?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Tanggal Pelaksanaan</label>
										<div class="controls">
											<?php
												$tgl_plk = explode('-', $spd->sppd->tgl_plk_sppd);

												echo $tgl_plk[2].'-'.$tgl_plk[1].'-'.$tgl_plk[0];
											?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Pegawai</label>
										<div class="controls">
											<?php
												echo $spd->sppd->nma_lkp_pgw;
											?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Tamu</label>
										<div class="controls">
											<?php
												echo $spd->sppd->nma_kga_sppd;
											?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Jabatan</label>
										<div class="controls">
											<?php
												echo $spd->sppd->posisi_kga_sppd;
											?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Perusahaan</label>
										<div class="controls">
											<?php
												echo $spd->sppd->nma_tmp_sppd;
											?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Jenis</label>
										<div class="controls">
											<?php
												echo $spd->sppd->jns_tmp_sppd;
											?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Bidang</label>
										<div class="controls">
											<?php
												echo $spd->sppd->bdg_phn_sppd;
											?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Telepon</label>
										<div class="controls">
											<?php
												echo $spd->sppd->tlp_kga_sppd;
											?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Agenda</label>
										<div class="controls">
											<?php
												echo $spd->sppd->agenda_sppd;
											?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Status</label>
										<div class="controls">
											<?php
											if ($spd->sppd->apprv_sppd == 'Y')
											{
												echo "<font color='red'>Diterima</font>";
											}
											else if ($spd->sppd->apprv_sppd == 'T')
											{
												echo "<font color='red'>Ditolak</font>";
											}
											else if ($spd->sppd->apprv_sppd == 'N')
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
												echo $spd->sppd->nma_apprv_sppd;
											?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Divisi (Jabatan)</label>
										<div class="controls">
											<?php
												echo $spd->sppd->jbtn_apprv_sppd;
											?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Status</label>
										<div class="controls">
											<?php
											if ($spd->sppd->stat_kunj == 'Y')
											{
												echo "<font color='red'>Telah dilaksanakan</font>";
											}
											else if ($spd->sppd->stat_kunj == 'T')
											{
												echo "<font color='red'>Tidak dilaksanakan</font>";
											}
											else if ($spd->sppd->stat_kunj == 'N')
											{
												echo "<font color='red'>Belum dilaksanakan</font>";
											}
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
											foreach ($spd->anggota as $agt)
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
						<?php
							if ($this->session->flashdata('notif'))
							{
						?>
						<div class="alert alert-<?php echo $this->session->flashdata('alert');?>">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<?php echo $this->session->flashdata('notif'); ?>
						</div>
						<?php
							}
						?>
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="icon-table"></i>
									File Bukti
								</h3>
							</div>
							<div class="box-content nopadding">
								<div class='form-horizontal form-bordered'>
									<div class="control-group">
										<label class="control-label">File</label>
										<div class="controls">
											<?php
											if (is_null($spd->sppd->lampiran)) 
											{
												echo "Tidak ada file";
											}
											else
											{
												?>
											<a href="<?php echo base_url().'admin/sppd/download/'.$spd->sppd->id_sppd;?>" target="_blank">Download</a>
											<input type="hidden" name="sppd" id="sppd" value="<?php echo $spd->sppd->lampiran; ?>">										
												<?php
											}
											?>
										</div>
									</div>
									<?php
										if ($this->session->userdata['hak'] == "admin" && $spd->sppd->apprv_sppd == 'Y')
										{
									?>
									<div class="control-group">
										<label class="control-label">Unggah</label>
										<div class="controls">
											<form action="<?php echo base_url("admin/sppd/aksi_upload/".$spd->sppd->id_sppd) ; ?>" method="POST" enctype="multipart/form-data">
												<input class="file" type="file" name="userfile" /><br/>
												<button type="submit" class="btn btn-primary">Upload</button>
											</form>
										</div>
									</div>
									<?php
										}
									?>
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