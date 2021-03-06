<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Pelatihan</h1>
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
								<h3><i class="icon-edit"></i>Ubah Pelatihan</h3>
							</div>
							<div class="box-content">
								<form action="<?php echo base_url() ; ?>admin/pelatihan/aksi_ubah/<?php echo $pelatihan->lth->id_lth; ?>" method="POST" class='form-horizontal form-validate' id="bb">
									
									<div class="control-group">
										<label for="textfield" class="control-label">Nama Pelatihan</label>
										<div class="controls">
											<input type="text" name="nama" id="nama" value="<?php echo $pelatihan->lth->nma_lth; ?>" placeholder="Contoh : Pelatihan Sesuatu" class="input-xlarge" data-rule-required="true" data-rule-minlength="5" data-rule-maxlength="99">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Tanggal Awal</label>
										<div class="controls">
										<?php
											$tgl_awal = explode('-',$pelatihan->lth->waktu_lth_awal);
											$tanggal_awal = $tgl_awal[1].'/'.$tgl_awal[2].'/'.$tgl_awal[0];
										?>
											<input type="text" name="tanggal_awal" id="tanggal_awal" value="<?php echo $tanggal_awal; ?>" class="input-medium datepick" data-rule-required="true">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Tanggal Akhir</label>
										<div class="controls">
										<?php
											$tgl_akhir = explode('-',$pelatihan->lth->waktu_lth_akhir);
											$tanggal_akhir = $tgl_akhir[1].'/'.$tgl_akhir[2].'/'.$tgl_akhir[0];
										?>
											<input type="text" name="tanggal_akhir" id="tanggal_akhir" value="<?php echo $tanggal_akhir; ?>" class="input-medium datepick" data-rule-required="true">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Alamat</label>
										<div class="controls">
											<input type="text" name="tempat" id="tempat" value="<?php echo $pelatihan->lth->tmp_lth; ?>" placeholder="Contoh : Bandung" class="input-xlarge" data-rule-required="true" data-rule-minlength="4" data-rule-maxlength="99">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Anggota</label>
										<div class="controls">
											<select multiple="multiple" id="anggota" name="anggota[]" class='multiselect'>
											<?php
												$agt = array();
												foreach ($pelatihan->anggota as $plth)
												{
													$agt[] = $plth->id_pgw;
												}

												foreach ($pegawai as $pgw)
												{
													$selected = '';
													if (in_array($pgw->id_pgw, $agt))
													{
														$selected = "selected";
													}
											?>
												<option value='<?php echo $pgw->id_pgw; ?>' <?php echo $selected;?>><?php echo $pgw->nma_lkp_pgw; ?></option>
											<?php
												}
											?>
											</select>
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
	</body>

	</html>