<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Pendidikan Informal</h1>
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
								<h3><i class="icon-edit"></i>Tambah Pendidikan Informal Pegawai</h3>
							</div>
							<div class="box-content">
								<form action="<?php echo base_url() ; ?>admin/informal/aksi_tambah" method="POST" enctype="multipart/form-data" class='form-horizontal form-validate' id="bb">
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
										<label for="textfield" class="control-label">Pendidikan</label>
										<div class="controls">
											<div class="input-xlarge">
												<select name="pendidikan" id="pendidikan" class='input-medium'>
												<?php
													foreach ($pendidikan as $pdk)
													{
												?>
													<option value="<?php echo $pdk->id_pnd_informal; ?>"><?php echo $pdk->nma_pnd_informal; ?></option>
												<?php
													}
												?>
												</select>
											</div>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Nama Tempat</label>
										<div class="controls">
											<input type="text" name="tempat" id="tempat" placeholder="Contoh : UNIKOM" class="input-xlarge" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="99">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Photo Kopi Sertifikat</label>
										<div class="controls">
											<input class="file" type="file" accept="image/*" name="userfile" /><br/>
										</div>
									</div>
									<div class="form-actions">
										<button type="submit" class="btn btn-primary">Simpan</button>
										<a href="<?php echo base_url(); ?>admin/informal" class="btn">Batal</a>
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