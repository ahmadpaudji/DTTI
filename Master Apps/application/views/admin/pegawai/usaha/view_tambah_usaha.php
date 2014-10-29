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
								<h3><i class="icon-edit"></i>Tambah Usaha/Aktifitas Pegawai</h3>
							</div>
							<div class="box-content">
								<form action="<?php echo base_url() ; ?>admin/usaha/aksi_tambah" method="POST" class='form-horizontal form-validate' id="bb">
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
										<label for="textfield" class="control-label">Jenis</label>
										<div class="controls">
											<div class="input-xlarge">
												<select name="usaha" id="usaha" class='input-medium'>
													<option value="agensi">Agensi</option>
													<option value="ormas">Ormas</option>
													<option value="peternakan">Peternakan</option>
													<option value="politik">Politik</option>
													<option value="properti">Properti</option>
												</select>
											</div>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Nama Usaha/Aktifitas</label>
										<div class="controls">
											<input type="text" name="nama" id="nama" placeholder="Contoh : Cipaganti Travel" class="input-xlarge" data-rule-required="true" data-rule-minlength="5" data-rule-maxlength="99">
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