<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Pendidikan Formal</h1>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span12">
					<?php
						if ($this->session->flashdata('errors'))
						{
					?>
						<div class="alert alert-error">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<?php echo $this->session->flashdata('errors'); ?>
						</div>
					<?php
						}
					?>
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-edit"></i>Ubah Pendidikan Formal Pegawai</h3>
							</div>
							<div class="box-content">
								<form action="<?php echo base_url() ; ?>admin/formal/aksi_ubah/<?php echo $formal->id_dtl_formal; ?>" method="POST" enctype="multipart/form-data" class='form-horizontal form-validate' id="bb">
									<div class="control-group">
										<label for="textfield" class="control-label">Nama</label>
										<div class="controls">
											<div class="input-xlarge">
												<select name="pegawai" id="pegawai" class='chosen-select'>
												<?php
													foreach ($pegawai as $pgw)
													{
														if ($pgw->id_pgw == $formal->id_pgw)
														{
												?>
													<option value="<?php echo $pgw->id_pgw; ?>" selected><?php echo $pgw->nma_lkp_pgw; ?></option>
												<?php
														}
														else
														{
												?>
													<option value="<?php echo $pgw->id_pgw; ?>"><?php echo $pgw->nma_lkp_pgw; ?></option>
												<?php
														}
													}
												?>
												</select>
											</div>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Pendidikan</label>
										<div class="controls">
											<div class="input-xlarge">
												<select name="pendidikan" id="pendidikan" class='select'>
												<?php
													foreach ($pendidikan as $pdk)
													{
														if ($pdk->id_pnd_formal == $formal->id_pnd_formal)
														{
												?>
													<option value="<?php echo $pdk->id_pnd_formal; ?>" selected><?php echo $pdk->skt_pnd_formal." (".$pdk->nma_pnd_formal.")"; ?></option>
												<?php
														}
														else
														{
												?>
													<option value="<?php echo $pdk->id_pnd_formal; ?>"><?php echo $pdk->skt_pnd_formal." (".$pdk->nma_pnd_formal.")"; ?></option>
												<?php
														}
													}
												?>
												</select>
											</div>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Nama Tempat</label>
										<div class="controls">
											<input type="text" name="tempat" id="tempat" placeholder="Contoh : UNIKOM" value="<?php echo $formal->nma_dtl_formal; ?>" class="input-xlarge" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="99">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Tahun Masuk</label>
										<div class="controls">
											<input type="text" name="tahun" id="tahun" placeholder="Contoh : 2011" value="<?php echo $formal->thn_dtl_formal; ?>" class="input-xmedium" data-rule-required="true" data-rule-digits="true" data-rule-minlength="4" data-rule-maxlength="4">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Status</label>
										<div class="controls">
											<select name="status" id="status" class='input-medium'>
											<?php
												$lls = '';
												$blm = '';

												if ($formal->stat_dtl_formal == "lulus")
												{
													$lls = "selected";
												}
												else
												{
													$blm = "selected";
												}
											?>
												<option value="lulus" <?php echo $lls;?>>Lulus</option>
												<option value="belum lulus" <?php echo $blm;?>>Belum Lulus</option>
											</select>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Photo Kopi Ijazah</label>
										<?php
											if ($formal->pc_ijzh != null)
											{
										?>
										<input type="hidden" name="ijazah" id="ijazah" value="<?php echo $formal->pc_ijzh; ?>">
										<?php
											}
										?>
										<div class="controls">
											<input class="file" type="file" accept="image/*" name="userfile" /><br/>
										</div>
									</div>
									<div class="form-actions">
										<button type="submit" class="btn btn-primary">Simpan</button>
										<a href="<?php echo base_url(); ?>admin/formal" class="btn">Batal</a>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div> <?php //akhir div container content ?>
	</body>

	</html>