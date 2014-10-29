<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Kendaraan Bermotor</h1>
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
								<h3><i class="icon-edit"></i>Ubah Kendaraan Bermotor</h3>
							</div>
							<div class="box-content">
								<form action="<?php echo base_url() ; ?>admin/kendaraan/aksi_ubah/<?php echo $kendaraan->id_kdr_mtr;?>" method="POST" class='form-horizontal form-validate' id="bb">
									<div class="control-group">
										<label for="textfield" class="control-label">Nama</label>
										<div class="controls">
											<div class="input-xlarge">
												<select name="pegawai" id="pegawai" class='chosen-select'>
												<?php
													foreach ($pegawai as $pgw)
													{
														if ($pgw->id_pgw == $kendaraan->id_pgw)
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
										<label for="textfield" class="control-label">Merk</label>
										<div class="controls">
											<input type="text" name="merk" id="merk" placeholder="Contoh : Honda" value="<?php echo $kendaraan->merk_kdr_mtr; ?>" class="input-xlarge" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="49">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">No. Polisi</label>
										<div class="controls">
											<input type="text" name="no_pol" id="no_pol" placeholder="Contoh : D 6291 A" value="<?php echo $kendaraan->nopol_kdr_mtr; ?>" class="input-xlarge" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="10">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Stiker</label>
										<div class="controls">
											<div class="input-xlarge">
												<select name="status" id="status" class='chosen-select'>
												<?php
													$sdh = '';
													$blm = '';

													if ($kendaraan->stat_kdr_mtr == "sudah")
													{
														$sdh = "selected";
													}
													else
													{
														$blm = "selected";
													}
												?>
													<option value="sudah" <?php echo $sdh; ?>>Sudah</option>
													<option value="belum" <?php echo $blm; ?>>Belum</option>
												</select>
											</div>
										</div>
									</div>
									<div class="form-actions">
										<button type="submit" class="btn btn-primary">Simpan</button>
										<a href="<?php echo base_url(); ?>admin/kendaraan" class="btn">Batal</a>
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