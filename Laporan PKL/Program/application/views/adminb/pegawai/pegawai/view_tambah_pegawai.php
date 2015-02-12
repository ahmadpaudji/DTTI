<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Pegawai</h1>
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
								<h3><i class="icon-edit"></i>Tambah Pegawai</h3>
							</div>
							<div class="box-content">
								<form action="<?php echo base_url() ; ?>admin/pegawai/aksi_tambah" method="POST" enctype="multipart/form-data" class='form-horizontal form-validate' id="bb">
									<div class="control-group">
										<label for="textfield" class="control-label">Username</label>
										<div class="controls">
											<input type="text" name="username" placeholder="Contoh : caqs123" id="username" class="input-xlarge" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="19">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Nama</label>
										<div class="controls">
											<input type="text" name="nama" id="nama" placeholder="Contoh : Handoyo" class="input-xlarge" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="99">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Tempat Lahir</label>
										<div class="controls">
											<input type="text" name="tempat" id="tempat" placeholder="Contoh : Serang" class="input-xlarge" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="49">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Tanggal Lahir</label>
										<div class="controls">
											<input type="text" name="tanggal" id="tanggal" class="input-medium datepick" data-rule-required="true">
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
										<label for="textfield" class="control-label">Alamat</label>
										<div class="controls">
											<textarea name="alamat" id="alamat" placeholder="Contoh : Serang" class="input-block" data-rule-required="true">Alamat</textarea>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Status</label>
										<div class="controls">
											<label class='radio'>
												<input type="radio" name="status" value="menikah" class="status" checked> Menikah
											</label>
											<label class='radio'>
												<input type="radio" class="status" name="status" value="belum menikah"> Belum Menikah
											</label>
										</div>
									</div>
									<div class="control-group" id="pasangan2">
										<label for="textfield" class="control-label">Pasangan</label>
										<div class="controls">
											<input type="text" name="pasangan" placeholder="Contoh : Pasangan" id="pasangan" class="input-xlarge">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Golongan Darah</label>
										<div class="controls">
											<select name="gd" id="gd" class='input-large'>
												<option value="A">A</option>
												<option value="AB">AB</option>
												<option value="B">B</option>
												<option value="O">O</option>
											</select>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Jabatan</label>
										<div class="controls">
											<select name="jabatan" id="jabatan" class='input-large'>
											<?php
												foreach ($jabatan as $jbt)
												{
											?>
												<option value="<?php echo $jbt->id_jbtn;?>"><?php echo strtoupper($jbt->div_jbtn.' | '.$jbt->nma_jbtn);?></option>
											<?php
												}
											?>
											</select>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">NIK</label>
										<div class="controls">
											<input type="text" name="nik" id="nik" placeholder="Contoh : 32123" class="input-xlarge" data-rule-required="true" data-rule-digits="true" data-rule-minlength="5" data-rule-maxlength="30">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">No. Akun</label>
										<div class="controls">
											<input type="text" name="no_akun" id="no_akun" placeholder="Contoh : 23" class="input-xlarge" data-rule-required="true" data-rule-digits="true" data-rule-minlength="1" data-rule-maxlength="4">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">KTP</label>
										<div class="controls">
											<input type="text" name="no_ktp" id="no_ktp" placeholder="Contoh : 341241257212" class="input-xlarge" data-rule-required="true" data-rule-digits="true" data-rule-minlength="16" data-rule-maxlength="16">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">NPWP</label>
										<div class="controls">
											<input type="text" name="npwp" id="npwp" placeholder="Contoh : 231232441231263" class="input-xlarge" data-rule-required="true" data-rule-digits="true" data-rule-minlength="15" data-rule-maxlength="15">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">E-Mail</label>
										<div class="controls">
											<input type="text" name="email" id="email" placeholder="Contoh : contoh@gmail.com" class="input-xlarge" data-rule-email="true" data-rule-required="true">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Level User</label>
										<div class="controls">
											<select name="level" id="level" class='input-large'>
												<option value="admin">ADMINISTRATOR</option>
												<option value="special user">SPECIAL USER</option>
												<option value="user">USER</option>
											</select>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Hp</label>
										<div class="controls">
											<input type="text" name="no_hp" id="no_hp" placeholder="Contoh : 081923482576" class="input-xlarge" data-rule-required="true" data-rule-digits="true" data-rule-minlength="10" data-rule-maxlength="12">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Telepon</label>
										<div class="controls">
											<input type="text" name="no_tlp" id="no_tlp" placeholder="Contoh : 204555" class="input-xlarge" data-rule-digits="true" data-rule-minlength="6" data-rule-maxlength="12">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Foto Kopi KTP</label>
										<div class="controls">
											<input class="file" type="file" accept="image/*" name="userfile" /><br/>
										</div>
									</div>
									<div class="form-actions">
										<button type="submit" class="btn btn-primary">Simpan</button>
										<a href="<?php echo base_url(); ?>admin/pegawai" class="btn">Batal</a>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div> <?php //akhir div container content ?>
	<script>

		$(function(){

			$('.status').on('click',function(){

				if($(this).val() == 'belum menikah'){
					$('#pasangan2').hide();
					$('#pasangan').val('');
				}

				if($(this).val() == 'menikah'){
					$('#pasangan2').show();
					$('#pasangan').val('');
				}
			});

		});

	</script>
	</body>

	</html>