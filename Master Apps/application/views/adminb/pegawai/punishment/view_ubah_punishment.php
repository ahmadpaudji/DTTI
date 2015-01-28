<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Punishment</h1>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span12">
					<?php
						if ($this->session->flashdata("notif"))
						{
					?>
						<div class="alert alert-<?php echo $this->session->flashdata('alert');?>">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<?php echo $this->session->flashdata('notif');?>
						</div>
					<?php
						}
					?>
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-edit"></i>Tambah Punishment</h3>
							</div>
							<div class="box-content">
								<form action="<?php echo base_url() ; ?>admin/punishment/aksi_ubah/<?php echo $punishment->id_pun;?>" method="POST" enctype="multipart/form-data" class='form-horizontal form-validate' id="bb">
									<div class="control-group">
										<label for="textfield" class="control-label">Nama</label>
										<div class="controls">
											<div class="input-xlarge">
												<select name="pegawai" id="pegawai" class='chosen-select'>
												<?php
													foreach ($pegawai as $pgw)
													{
														if ($pgw->id_pgw == $punishment->id_pgw)
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
											<select name="jenis" id="jenis" class='input-small'>
											<?php
												$sp1 = '';
												$sp2 = '';
												$sp3 = '';

												if ($punishment->jns_pun == 'SP1')
												{
													$sp1 = "selected";
												}
												else if ($punishment->jns_pun == 'SP2')
												{
													$sp2 = "selected";
												}
												else if ($punishment->jns_pun == 'SP3')
												{
													$sp3 = "selected";
												}
											?>
												<option value="SP1" <?php echo $sp1;?>>SP1</option>
												<option value="SP2" <?php echo $sp2;?>>SP2</option>
												<option value="SP3" <?php echo $sp3;?>>SP3</option>
											</select>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Keterangan</label>
										<div class="controls">
											<input type="text" name="keterangan" id="keterangan" value="<?php echo $punishment->ket_pun;?>" placeholder="Contoh : Terlambat" class="input-xlarge" data-rule-required="true" data-rule-minlength="4" data-rule-maxlength="40">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Foto Kopi Surat</label>
										<div class="controls">
										<?php
											if ($punishment->surat_pun != null)
											{
										?>
										<input type="hidden" name="punishment" id="punishment" value="<?php echo $punishment->surat_pun; ?>">
										<?php
											}
										?>
											<input class="file" type="file" accept="image/*" name="userfile" /><br/>
										</div>
									</div>
									<div class="form-actions">
										<button type="submit" class="btn btn-primary">Simpan</button>
										<a href="<?php echo base_url(); ?>admin/punishment" class="btn">Batal</a>
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