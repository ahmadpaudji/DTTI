<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Reward</h1>
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
								<h3><i class="icon-edit"></i>Ubah Reward</h3>
							</div>
							<div class="box-content">
								<form action="<?php echo base_url() ; ?>admin/reward/aksi_ubah/<?php echo $reward->id_reward;?>" method="POST" class='form-horizontal form-validate' id="bb">
									<div class="control-group">
										<label for="textfield" class="control-label">Nama</label>
										<div class="controls">
											<div class="input-xlarge">
												<select name="pegawai" id="pegawai" class='chosen-select'>
												<?php
													foreach ($pegawai as $pgw)
													{
														if ($pgw->id_pgw == $reward->id_pgw)
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
												$teladan = '';
												$khusus = '';

												if ($reward->jns_reward == 'teladan')
												{
													$teladan = "selected";
												}
												else if ($reward->jns_reward == 'khusus')
												{
													$khusus = "selected";
												}
											?>
												<option value="teladan" <?php echo $teladan;?>>Teladan</option>
												<option value="khusus" <?php echo $khusus;?>>Khusus</option>
											</select>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Keterangan</label>
										<div class="controls">
											<input type="text" name="keterangan" id="keterangan" value="<?php echo $reward->ket_reward;?>" placeholder="Contoh : Naik haji" class="input-xlarge" data-rule-required="true" data-rule-minlength="4" data-rule-maxlength="40">
										</div>
									</div>
									<div class="form-actions">
										<button type="submit" class="btn btn-primary">Simpan</button>
										<a href="<?php echo base_url(); ?>admin/reward" class="btn">Batal</a>
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