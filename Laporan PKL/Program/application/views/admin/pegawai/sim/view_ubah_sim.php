<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>SIM</h1>
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
								<h3><i class="icon-edit"></i>Ubah SIM Pegawai</h3>
							</div>
							<div class="box-content">
								<form action="<?php echo base_url() ; ?>admin/sim/aksi_ubah/<?php echo $sim->id_sim; ?>" method="POST" enctype="multipart/form-data" class='form-horizontal form-validate' id="bb">
									<div class="control-group">
										<label for="textfield" class="control-label">Nama</label>
										<div class="controls">
											<div class="input-xlarge">
												<select name="pegawai" id="pegawai" class='chosen-select'>
												<?php
													foreach ($pegawai as $pgw)
													{
														if ($pgw->id_pgw == $sim->id_pgw)
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
											<select name="jns" id="jns" class='input-large'>
											<?php
												$a = '';
												$b = '';
												$b1 = '';
												$b2 = '';
												$c = '';

												if ($sim->jns_sim == 'A')
												{
													$a = "selected";
												}
												else if ($sim->jns_sim == 'B')
												{
													$b = "selected";
												}
												else if ($sim->jns_sim == 'B1')
												{
													$b1 = "selected";
												}
												else if ($sim->jns_sim == 'B2')
												{
													$b2 = "selected";
												}
												else if ($sim->jns_sim == 'C')
												{
													$c = "selected";
												}
											?>
												<option value="A" <?php echo $a; ?>>A</option>
												<option value="B" <?php echo $b; ?>>B</option>
												<option value="B1" <?php echo $b1; ?>>B1</option>
												<option value="B2" <?php echo $b2; ?>>B2</option>
												<option value="C" <?php echo $c; ?>>C</option>
											</select>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Nomor</label>
										<div class="controls">
											<input type="text" name="no_sim" id="no_sim" placeholder="Contoh : 341241257212" value="<?php echo $sim->no_sim; ?>" class="input-xlarge" data-rule-required="true" data-rule-digits="true" data-rule-minlength="12" data-rule-maxlength="12">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Photo Kopi SIM</label>
										<?php
											if ($sim->pc_sim != null)
											{
										?>
										<input type="hidden" name="sim" id="sim" value="<?php echo $sim->pc_sim; ?>">
										<?php
											}
										?>
										<div class="controls">
											<input class="file" type="file" accept="image/*" name="userfile" /><br/>
										</div>
									</div>
									<div class="form-actions">
										<button type="submit" class="btn btn-primary">Simpan</button>
										<a href="<?php echo base_url(); ?>admin/sim" class="btn">Batal</a>
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