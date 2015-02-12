<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Anak</h1>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-edit"></i>Tambah Anak</h3>
							</div>
							<div class="box-content">
								<form action="<?php echo base_url() ; ?>admin/anak/aksi_tambah" method="POST" class='form-horizontal form-validate' id="bb">
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
										<label for="textfield" class="control-label">Anak ke-</label>
										<div class="controls">
											<div class="input-xlarge">
												<select name="no_urut" id="no_urut" class='input-small'>
												<?php
													for($i=1;$i<12;$i++)
													{
												?>
													<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
												<?php
													}
												?>
												</select>
											</div>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Nama Anak</label>
										<div class="controls">
											<input type="text" name="nama" id="nama" placeholder="Contoh : Handoyo" class="input-xlarge" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="100">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Jenis Kelamin</label>
										<div class="controls">
											<label class='radio'>
												<input type="radio" name="jk" value="L" checked> Laki-laki
											</label>
											<label class='radio'>
												<input type="radio" name="jk" value="P"> Perempuan
											</label>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Tempat Lahir</label>
										<div class="controls">
											<input type="text" name="tempat" id="tempat" placeholder="Contoh : Serang" class="input-xlarge" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="100">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Tanggal Lahir</label>
										<div class="controls">
											<input type="text" name="tanggal" id="tanggal" class="input-medium datepick" data-rule-required="true">
										</div>
									</div>
									<div class="form-actions">
										<button type="submit" class="btn btn-primary">Simpan</button>
										<a href="<?php echo base_url(); ?>admin/anak" class="btn">Batal</a>
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