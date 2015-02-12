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
								<h3><i class="icon-edit"></i>Ubah Anak</h3>
							</div>
							<div class="box-content">
								<form action="<?php echo base_url() ; ?>admin/anak/aksi_ubah/<?php echo $anak->id_anak;?>" method="POST" class='form-horizontal form-validate' id="bb">
									<div class="control-group">
										<label for="textfield" class="control-label">Nama</label>
										<div class="controls">
											<div class="input-xlarge">
												<select name="pegawai" id="pegawai" class='chosen-select'>
												<?php
													foreach ($pegawai as $pgw)
													{
														if ($pgw->id_pgw == $anak->id_pgw)
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
										<label for="textfield" class="control-label">Anak ke-</label>
										<div class="controls">
											<div class="input-xlarge">
												<select name="no_urut" id="no_urut" class='input-small'>
												<?php
													for($i=1;$i<12;$i++)
													{
														if ($i == $anak->no_urut_anak)
														{
												?>
													<option value="<?php echo $i; ?>" selected><?php echo $i; ?></option>
												<?php
														}
														else
														{
												?>
													<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
												<?php
														}
													}
												?>
												</select>
											</div>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Nama Anak</label>
										<div class="controls">
											<input type="text" name="nama" id="nama" placeholder="Contoh : Handoyo" value="<?php echo $anak->nma_anak; ?>" class="input-xlarge" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="100">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Jenis Kelamin</label>
										<div class="controls">
											<?php
												$jkl = '';
												$jkp = '';

												if ($anak->jk_anak == 'L')
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
										<label for="textfield" class="control-label">Tempat Lahir</label>
										<div class="controls">
											<input type="text" name="tempat" id="tempat" placeholder="Contoh : Serang" value="<?php echo $anak->tmp_lhr_anak; ?>" class="input-xlarge" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="100">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Tanggal Lahir</label>
										<div class="controls">
											<?php
												$tgl = explode('-',$anak->tgl_lhr_anak);
												$tanggal = $tgl[1].'/'.$tgl[2].'/'.$tgl[0];
											?>
											<input type="text" name="tanggal" id="tanggal" value="<?php echo $tanggal; ?>" class="input-medium datepick" data-rule-required="true">
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