<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Bank</h1>
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
								<h3><i class="icon-edit"></i>Ubah Bank</h3>
							</div>
							<div class="box-content">
								<form action="<?php echo base_url() ; ?>admin/daftarbank/aksi_ubah/<?php echo $bank->id_bank; ?>" method="POST" class='form-horizontal form-validate' id="bb">
									<div class="control-group">
										<label for="nama" class="control-label">Nama</label>
										<div class="controls">
											<input type="text" name="nama" id="nama" placeholder="Contoh : Bank Negara Indonesia" value="<?php echo $bank->nma_bank; ?>" class="input-xlarge" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="30">
										</div>
									</div>
									<div class="control-group">
										<label for="singkatan" class="control-label">Singkatan</label>
										<div class="controls">
											<input type="text" name="singkatan" id="singkatan" placeholder="Contoh : BNI" value="<?php echo $bank->sktn_bank; ?>" class="input-xlarge" data-rule-required="true" data-rule-minlength="3" data-rule-maxlength="4">
										</div>
									</div>
									<div class="form-actions">
										<button type="submit" class="btn btn-primary">Simpan</button>
										<a href="<?php echo base_url(); ?>admin/daftarbank" class="btn">Batal</a>
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