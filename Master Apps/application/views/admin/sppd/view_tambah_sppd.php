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
						if ($this->session->flashdata('notif'))
						{
					?>
						<div class="alert alert-<?php echo $this->session->flashdata('alert');?>">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<?php echo $this->session->flashdata('notif'); ?>
						</div>
					<?php
						}
					?>
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-edit"></i>Tambah SPPD</h3>
							</div>
							<div class="box-content">
								<form action="<?php echo base_url() ; ?>admin/sppd/aksi_tambah" method="POST" class='form-horizontal form-validate' id="bb">
									
									<div class="control-group">
										<label for="textfield" class="control-label">Tanggal</label>
										<div class="controls">
											<input type="text" name="tanggal" id="tanggal" class="input-medium datepick" data-rule-required="true">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Nama Tamu</label>
										<div class="controls">
											<input type="text" name="tamu" id="tamu" placeholder="Contoh : Bambang Aji" class="input-xlarge" data-rule-required="true" data-rule-minlength="4" data-rule-maxlength="99">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Jabatan</label>
										<div class="controls">
											<input type="text" name="posisi" id="posisi" placeholder="Contoh : Direktur" class="input-xlarge" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="49">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Nama Tempat</label>
										<div class="controls">
											<input type="text" name="tempat" id="tempat" placeholder="Contoh : PT. Ozansoft" class="input-xlarge" data-rule-required="true" data-rule-minlength="4" data-rule-maxlength="49">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Alamat</label>
										<div class="controls">
											<textarea name="alamat" id="alamat" placeholder="Contoh : Jalan Sukajadi" class="input-xlarge" data-rule-required="true" data-rule-minlength="4" data-rule-maxlength="100"></textarea>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Bidang</label>
										<div class="controls">
											<input type="text" name="bidang" id="bidang" placeholder="Contoh : Kehutanan" class="input-xlarge" data-rule-required="true" data-rule-minlength="4" data-rule-maxlength="49">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Jenis Tempat</label>
										<div class="controls">
											<select name="jenis" id="jenis">
												<option value="instansi">Instansi</option>
												<option value="kampus">Kampus</option>
												<option value="lembaga">Lembaga</option>
												<option value="organisasi">Organisasi</option>
												<option value="perusahaan">Perusahaan</option>
												<option value="sekolah">Sekolah</option>
											</select>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Telepon</label>
										<div class="controls">
											<input type="text" name="telepon" id="telepon" placeholder="Contoh : 0226443221" class="input-xlarge" data-rule-digits="true" data-rule-required="true" data-rule-minlength="6" data-rule-maxlength="12">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Agenda</label>
										<div class="controls">
											<textarea name="agenda" id="agenda" placeholder="Contoh : Melakukan penyuluhan kebersihan" class="input-xlarge" data-rule-required="true" data-rule-minlength="4" data-rule-maxlength="99"></textarea>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Anggota</label>
										<div class="controls">
											<select multiple="multiple" id="anggota" name="anggota[]" class='multiselect'>
											<?php
												foreach ($pegawai as $pgw)
												{
											?>
												<option value='<?php echo $pgw->id_pgw; ?>'><?php echo $pgw->nma_lkp_pgw; ?></option>
											<?php
												}
											?>
											</select>
										</div>
									</div>
									<div class="form-actions">
										<button type="submit" class="btn btn-primary">Simpan</button>
										<a href="<?php echo base_url(); ?>admin/sppd" class="btn">Batal</a>
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