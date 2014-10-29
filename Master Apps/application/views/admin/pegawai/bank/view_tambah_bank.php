<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Rekening Bank</h1>
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
								<h3><i class="icon-edit"></i>Tambah Rekening Bank</h3>
							</div>
							<div class="box-content">
								<form action="<?php echo base_url() ; ?>admin/bank/aksi_tambah" method="POST" class='form-horizontal form-validate' id="bb">
									<div class="control-group">
										<label for="textfield" class="control-label">Nama</label>
										<div class="controls">
											<div class="input-xlarge">
												<select name="pegawai" id="pegawai" class='chosen-select'>
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
										<label for="textfield" class="control-label">Bank</label>
										<div class="controls">
											<select name="bank" id="bank" class='input-large'>
											<?php
												foreach ($bank as $bnk)
												{
											?>
												<option value="<?php echo $bnk->id_bank; ?>"><?php echo $bnk->nma_bank; ?></option>
											<?php
												}
											?>
											</select>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">No. Rekening</label>
										<div class="controls">
											<input type="text" name="no_rek" id="no_rek" placeholder="Contoh : 022342423" class="input-xlarge" data-rule-required="true" data-rule-digits="true" data-rule-minlength="9" data-rule-maxlength="16">
										</div>
									</div>
									<div class="form-actions">
										<button type="submit" class="btn btn-primary">Simpan</button>
										<a href="<?php echo base_url(); ?>admin/bank" class="btn">Batal</a>
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