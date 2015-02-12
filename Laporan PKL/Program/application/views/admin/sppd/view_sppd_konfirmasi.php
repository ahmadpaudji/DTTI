<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>SPPD</h1>
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
								<h3><i class="icon-edit"></i>Data SPPD</h3>
							</div>
							<div class="box-content">
							<form action="<?php echo base_url()."admin/sppd/konfirmasi/cari" ; ?>" method="POST" class='form-horizontal form-validate'>
								
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
									Data SPPD
								</h3>
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin dataTable table-bordered">
									<thead>
										<tr>
											<th>No.</th>
											<th>Tanggal Pengajuan</th>
											<th class='hidden-350'>Pegawai</th>
											<th class='hidden-350'>Nama Tempat</th>
											<th class='hidden-350'>Status</th>
											<th class='hidden-350'>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$i = 1;
											foreach ($sppd as $sp) 
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
													$tgl = explode('-', $sp->tgl_pju_sppd);
													echo $tgl[2].'-'.$tgl[1].'-'.$tgl[0];
												?>
											</td>
											<td class='hidden-350'>
												<?php
													echo $sp->nma_lkp_pgw;
												?>
											</td>
											<td class='hidden-350'>
												<?php
													echo $sp->nma_tmp_sppd;
												?>
											</td>
											<td class='hidden-350'>
												<?php
												if ($sp->apprv_sppd == 'Y')
												{
													echo "<font color='red'>Diterima</font>";
												}
												else if ($sp->apprv_sppd == 'T')
												{
													echo "<font color='red'>Ditolak</font>";
												}
												else if ($sp->apprv_sppd == 'N')
												{
													echo "<font color='red'>Belum dikonfirmasi</font>";
												}
												?>
											</td>
											<td class="btn-group">
												<a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle"><i class="icon-cogs"></i> <span class="caret"></span></a>
												<ul class="dropdown-menu">
												<?php
												if ($sp->apprv_sppd == 'N')
												{
												?>
													<li>
														<a href="<?php echo base_url(); ?>admin/sppd/setuju/<?php echo $sp->id_sppd.'/Y'; ?>">Setujui</a>
													</li>
													<li>
														<a href="<?php echo base_url(); ?>admin/sppd/setuju/<?php echo $sp->id_sppd.'/T'; ?>">Tolak</a>
													</li>
												<?php
												}
												else if ($sp->apprv_sppd == 'T' || $sp->apprv_sppd == 'Y')
												{
												?>
													<li>
														<a>Tidak ada</a>
													</li>
												<?php
												}
												?>
												</ul>
												<a href="<?php echo base_url(); ?>admin/sppd/detail/<?php echo $sp->id_sppd; ?>" style="margin-left:2px" class="btn btn-primary"><i class="icon-eye-open"></i></a>
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