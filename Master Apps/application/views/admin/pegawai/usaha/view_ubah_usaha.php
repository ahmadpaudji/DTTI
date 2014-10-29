<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Usaha/Aktifitas</h1>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-edit"></i>Ubah Usaha/Aktifitas Pegawai</h3>
							</div>
							<div class="box-content">
								<form action="<?php echo base_url() ; ?>admin/usaha/aksi_ubah/<?php echo $usaha->id_ush_akt; ?>" method="POST" class='form-horizontal form-validate' id="bb">
									<div class="control-group">
										<label for="textfield" class="control-label">Nama</label>
										<div class="controls">
											<div class="input-xlarge">
												<select name="pegawai" id="pegawai" class='chosen-select'>
												<?php
													foreach ($pegawai as $pgw)
													{
														if ($pgw->id_pgw == $usaha->id_pgw)
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
										<label for="textfield" class="control-label">Jenis</label>
										<div class="controls">
											<div class="input-xlarge">
												<select name="usaha" id="usaha" class='input-medium'>
												<?php
													$agensi = '';
													$ormas = '';
													$peternakan = '';
													$politik = '';
													$properti = '';

													if ($usaha->jns_ush_akt == "agensi")
													{
														$agensi = "selected";
													}
													else if ($usaha->jns_ush_akt == "ormas")
													{
														$ormas = "selected";
													}
													else if ($usaha->jns_ush_akt == "peternakan")
													{
														$peternakan = "selected";
													}
													else if ($usaha->jns_ush_akt == "politik")
													{
														$politik = "selected";
													}
													else if ($usaha->jns_ush_akt == "properti")
													{
														$properti = "selected";
													}
												?>
													<option value="agensi" <?php echo $agensi; ?>>Agensi</option>
													<option value="ormas" <?php echo $ormas; ?>>Ormas</option>
													<option value="peternakan" <?php echo $peternakan; ?>>Peternakan</option>
													<option value="politik" <?php echo $politik; ?>>Politik</option>
													<option value="properti" <?php echo $properti; ?>>Properti</option>
												</select>
											</div>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Nama Usaha/Aktifitas</label>
										<div class="controls">
											<input type="text" name="nama" id="nama" placeholder="Contoh : Cipaganti Travel" value="<?php echo $usaha->nma_ush_akt; ?>" class="input-xlarge" data-rule-required="true" data-rule-minlength="5" data-rule-maxlength="99">
										</div>
									</div>
									<div class="form-actions">
										<button type="submit" class="btn btn-primary">Simpan</button>
										<a href="<?php echo base_url(); ?>admin/usaha" class="btn">Batal</a>
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