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
								<h3><i class="icon-edit"></i>Ubah SPPD</h3>
							</div>
							<div class="box-content">
								<form action="<?php echo base_url() ; ?>admin/sppd/aksi_ubah/<?php echo $spd->sppd->id_sppd;?>" method="POST" class='form-horizontal form-validate' id="bb">
									
									<div class="control-group">
										<label for="textfield" class="control-label">Tanggal</label>
										<div class="controls">
										<?php
											$tgl = explode('-',$spd->sppd->tgl_plk_sppd);
											$tanggal = $tgl[1].'/'.$tgl[2].'/'.$tgl[0];
										?>
											<input type="text" name="tanggal" id="tanggal" value="<?php echo $tanggal;?>" class="input-medium datepick" data-rule-required="true">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Nama Tamu</label>
										<div class="controls">
											<input type="text" name="tamu" id="tamu" value="<?php echo $spd->sppd->nma_kga_sppd;?>" placeholder="Contoh : Bambang Aji" class="input-xlarge" data-rule-required="true" data-rule-minlength="4" data-rule-maxlength="99">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Jabatan</label>
										<div class="controls">
											<input type="text" name="posisi" id="posisi" value="<?php echo $spd->sppd->posisi_kga_sppd;?>" placeholder="Contoh : Direktur" class="input-xlarge" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="49">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Nama Tempat</label>
										<div class="controls">
											<input type="text" name="tempat" id="tempat" value="<?php echo $spd->sppd->nma_tmp_sppd;?>" placeholder="Contoh : PT. Ozansoft" class="input-xlarge" data-rule-required="true" data-rule-minlength="4" data-rule-maxlength="49">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Alamat</label>
										<div class="controls">
											<textarea name="alamat" id="alamat" placeholder="Contoh : Jalan Sukajadi" class="input-xlarge" data-rule-required="true" data-rule-minlength="4" data-rule-maxlength="100"><?php echo $spd->sppd->almt_tmp_sppd;?></textarea>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Bidang</label>
										<div class="controls">
											<input type="text" name="bidang" id="bidang" value="<?php echo $spd->sppd->bdg_phn_sppd;?>" placeholder="Contoh : IT" class="input-xlarge" data-rule-required="true" data-rule-minlength="4" data-rule-maxlength="49">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Jenis Tempat</label>
										<div class="controls">
											<select name="jenis" id="jenis">
											<?php 
												$instansi = '';
												$kampus = '';
												$lembaga = '';
												$organisasi = '';
												$perusahaan = '';
												$sekolah = '';

												if ($spd->sppd->jns_tmp_sppd == "instansi")
												{
													$instansi = "selected";
												}
												else if ($spd->sppd->jns_tmp_sppd == "kampus")
												{
													$kampus = "selected";
												}
												else if ($spd->sppd->jns_tmp_sppd == "lembaga")
												{
													$lembaga = "selected";
												}
												else if ($spd->sppd->jns_tmp_sppd == "organisasi")
												{
													$organisasi = "selected";
												}
												else if ($spd->sppd->jns_tmp_sppd == "perusahaan")
												{
													$perusahaan = "selected";
												}
												else if ($spd->sppd->jns_tmp_sppd == "sekolah")
												{
													$sekolah = "selected";
												}
											?>
												<option value="instansi" <?php echo $instansi;?>>Instansi</option>
												<option value="kampus" <?php echo $kampus;?>>Kampus</option>
												<option value="lembaga" <?php echo $lembaga;?>>Lembaga</option>
												<option value="organisasi" <?php echo $organisasi;?>>Organisasi</option>
												<option value="perusahaan" <?php echo $perusahaan;?>>Perusahaan</option>
												<option value="sekolah" <?php echo $sekolah;?>>Sekolah</option>
											</select>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Telepon</label>
										<div class="controls">
											<input type="text" name="telepon" id="telepon" value="<?php echo $spd->sppd->tlp_kga_sppd;?>" placeholder="Contoh : 0226443221" class="input-xlarge" data-rule-digits="true" data-rule-required="true" data-rule-minlength="6" data-rule-maxlength="12">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Agenda</label>
										<div class="controls">
											<textarea name="agenda" id="agenda" placeholder="Contoh : Melakukan penyuluhan kebersihan" class="input-xlarge" data-rule-required="true" data-rule-minlength="4" data-rule-maxlength="99"><?php echo $spd->sppd->agenda_sppd;?></textarea>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Anggota</label>
										<div class="controls">
											<select multiple="multiple" id="anggota" name="anggota[]" class='multiselect'>
											<?php
												$agt = array();
												foreach ($spd->anggota as $sp)
												{
													$agt[] = $sp->id_pgw;
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