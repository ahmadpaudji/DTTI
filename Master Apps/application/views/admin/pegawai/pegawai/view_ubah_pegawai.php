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
								<h3><i class="icon-edit"></i>Ubah Pegawai</h3>
							</div>
							<div class="box-content">
								<form action="<?php echo base_url() ; ?>admin/pegawai/aksi_ubah/<?php echo $pegawai->id_pgw; ?>" method="POST" enctype="multipart/form-data" class='form-horizontal form-validate' id="bb">
									<div class="control-group">
										<label for="textfield" class="control-label">Username</label>
										<div class="controls">
											<input type="text" name="username" id="username" placeholder="Contoh : caqs123" value="<?php echo $pegawai->uname_pgw; ?>" class="input-xlarge" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="19">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Password</label>
										<div class="controls">
											<input type="password" name="password" id="password" class="input-xlarge" data-rule-minlength="6" data-rule-maxlength="8">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Nama</label>
										<div class="controls">
											<input type="text" name="nama" id="nama" placeholder="Contoh : Handoyo" value="<?php echo $pegawai->nma_lkp_pgw; ?>" class="input-xlarge" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="99">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Tempat Lahir</label>
										<div class="controls">
											<input type="text" name="tempat" id="tempat" placeholder="Contoh : Serang" value="<?php echo $pegawai->tmp_lhr_pgw; ?>" class="input-xlarge" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="49">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Tanggal Lahir</label>
										<div class="controls">
										<?php
											$tgl = explode('-',$pegawai->tgl_lhr_pgw);
											$tanggal = $tgl[1].'/'.$tgl[2].'/'.$tgl[0];
										?>
											<input type="text" name="tanggal" id="tanggal" value="<?php echo $tanggal; ?>" class="input-medium datepick" data-rule-required="true">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Jenis Kelamin</label>
										<div class="controls">
										<?php
											$jkl = '';
											$jkp = '';

											if ($pegawai->jk_pgw == 'L')
											{
												$jkl = "checked";
											}
											else
											{
												$jkp = "checked";
											}
										?>
											<label class='radio'>
												<input type="radio" name="jk" value="L" <?php echo $jkl; ?>> Laki-laki
											</label>
											<label class='radio'>
												<input type="radio" name="jk" value="P" <?php echo $jkp; ?>> Perempuan
											</label>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Alamat</label>
										<div class="controls">
											<textarea name="alamat" id="alamat" placeholder="Contoh : Serang" class="input-block" data-rule-required="true"><?php echo $pegawai->almt_pgw; ?></textarea>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Status</label>
										<div class="controls">
										<?php
											$mnk = '';
											$blm = '';

											if ($pegawai->stat_pgw == 'menikah')
											{
												$mnk = "checked";
											}
											else
											{
												$blm = "checked";
											}
										?>
											<label class='radio'>
												<input type="radio" name="status" value="menikah" class="status" <?php echo $mnk;?>> Menikah
											</label>
											<label class='radio'>
												<input type="radio" name="status" value="belum menikah" class="status" <?php echo $blm; ?>> Belum Menikah
											</label>
										</div>
									</div>
									<div class="control-group" id="pasangan2">
										<label for="textfield" class="control-label">Pasangan</label>
										<div class="controls">
											<input type="text" name="pasangan" placeholder="Contoh : Pasangan" value="<?php echo $pegawai->nma_psg_pgw; ?>" class="input-xlarge">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Golongan Darah</label>
										<div class="controls">
											<select name="gd" id="gd" class='input-small'>
											<?php
											$a = '';
											$ab = '';
											$b = '';
											$o = '';

											if ($pegawai->gol_drh_pgw == 'A')
											{
												$a = "selected";
											}
											else if ($pegawai->gol_drh_pgw == 'AB')
											{
												$ab = "selected";
											}
											else if ($pegawai->gol_drh_pgw == 'B')
											{
												$b = "selected";
											}
											else if ($pegawai->gol_drh_pgw == 'O')
											{
												$o = "selected";
											}
										?>
												<option value="A" <?php echo $a; ?>>A</option>
												<option value="AB" <?php echo $ab; ?>>AB</option>
												<option value="B" <?php echo $b; ?>>B</option>
												<option value="O" <?php echo $o; ?>>O</option>
											</select>
										</div>
									</div>
									<?php
									if ($this->session->userdata("hak") == "admin")
									{
									?>
									<div class="control-group">
										<label for="textfield" class="control-label">Jabatan</label>
										<div class="controls">
											<select name="jabatan" id="jabatan" class='input-large'>
											<?php
												foreach ($jabatan as $jbt)
												{
													if ($jbt->id_jbtn == $pegawai->id_jbtn)
													{
											?>
												<option value="<?php echo $jbt->id_jbtn;?>" selected><?php echo strtoupper($jbt->div_jbtn.' | '.$jbt->nma_jbtn);?></option>
											<?php
													}
													else
													{
											?>
												<option value="<?php echo $jbt->id_jbtn;?>"><?php echo strtoupper($jbt->div_jbtn.' | '.$jbt->nma_jbtn);?></option>
											<?php
													}
												}
											?>
											</select>
										</div>
									</div>
									<?php
									}
									?>
									<div class="control-group">
										<label for="textfield" class="control-label">NIK</label>
										<div class="controls">
											<input type="text" name="nik" id="nik" placeholder="Contoh : 32123" value="<?php echo $pegawai->nik_pgw; ?>" class="input-xlarge" data-rule-required="true" data-rule-digits="true" data-rule-minlength="5" data-rule-maxlength="30">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">No. Akun</label>
										<div class="controls">
											<input type="text" name="no_akun" id="no_akun" placeholder="Contoh : 23" value="<?php echo $pegawai->no_akun_pgw; ?>" class="input-xlarge" data-rule-required="true" data-rule-digits="true" data-rule-minlength="1" data-rule-maxlength="4">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">KTP</label>
										<div class="controls">
											<input type="text" name="no_ktp" id="no_ktp" placeholder="Contoh : 341241257212" value="<?php echo $pegawai->no_ktp_pgw; ?>" class="input-xlarge" data-rule-required="true" data-rule-digits="true" data-rule-minlength="16" data-rule-maxlength="16">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">NPWP</label>
										<div class="controls">
											<input type="text" name="npwp" id="npwp" placeholder="Contoh : 231232441231263" value="<?php echo $pegawai->npwp_pgw; ?>" class="input-xlarge" data-rule-required="true" data-rule-digits="true" data-rule-minlength="15" data-rule-maxlength="15">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">E-Mail</label>
										<div class="controls">
											<input type="text" name="email" id="email" placeholder="Contoh : contoh@gmail.com" value="<?php echo $pegawai->email_pgw; ?>" class="input-xlarge" data-rule-email="true" data-rule-required="true">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Hp</label>
										<div class="controls">
											<input type="text" name="no_hp" id="no_hp" placeholder="Contoh : 081923482576" value="<?php echo $pegawai->hp_pgw; ?>" class="input-xlarge" data-rule-required="true" data-rule-digits="true" data-rule-minlength="10" data-rule-maxlength="12">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Telepon</label>
										<div class="controls">
											<input type="text" name="no_tlp" id="no_tlp" placeholder="Contoh : 204555" value="<?php echo $pegawai->telp_pgw; ?>" class="input-xlarge" data-rule-digits="true" data-rule-minlength="6" data-rule-maxlength="12">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Foto Kopi KTP</label>
										<?php
											if ($pegawai->pc_ktp_pgw != null)
											{
										?>
										<input type="hidden" name="photo" id="photo" value="<?php echo $pegawai->pc_ktp_pgw; ?>">
										<?php
											}
										?>
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