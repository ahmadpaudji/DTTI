<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Izin</h1>
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
								<h3><i class="icon-edit"></i>Ubah Izin Presensi</h3>
							</div>
							<div class="box-content">
								<form action="<?php echo base_url() ; ?>admin/izin/aksi_ubah/<?php echo $izin->id_abs;?>" method="POST" enctype="multipart/form-data" class='form-horizontal form-validate' id="bb">
									
									<div class="control-group">
										<label for="textfield" class="control-label">Tanggal Awal</label>
										<div class="controls">
										<?php
											$tgl_mulai = explode('-',$izin->wkt_abs_awl);
											$tanggal_mulai = $tgl_mulai[1].'/'.$tgl_mulai[2].'/'.$tgl_mulai[0];
										?>
											<input type="text" name="tanggal_mulai" id="tanggal_mulai" value="<?php echo $tanggal_mulai; ?>" class="input-medium datepick" data-rule-required="true">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Tanggal Akhir</label>
										<div class="controls">
										<?php
											$tgl_akhir = explode('-',$izin->wkt_abs_akr);
											$tanggal_akhir = $tgl_akhir[1].'/'.$tgl_akhir[2].'/'.$tgl_akhir[0];
										?>
											<input type="text" name="tanggal_akhir" id="tanggal_akhir" value="<?php echo $tanggal_akhir;?>" class="input-medium datepick" data-rule-required="true">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Jenis</label>
										<div class="controls">
										
											<select name="jenis" id="jenis" class='input-large'>
											<?php
											$cuti = '';
											$sakit = '';
											$ijin = '';

											if ($izin->jns_abs == "cuti")
											{
												$cuti = "selected";
											}
											else if ($izin->jns_abs == "sakit")
											{
												$sakit = "selected";
											}
											else if ($izin->jns_abs == "ijin")
											{
												$ijin = "selected";
											}
										?>
												<option value="cuti" <?php echo $cuti;?>>Cuti</option>
												<option value="ijin" <?php echo $ijin;?>>Izin</option>
												<option value="sakit" <?php echo $sakit;?>>Sakit</option>
											</select>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Alasan</label>
										<div class="controls">
											<textarea type="text" name="alasan" id="alasan" placeholder="Contoh : Sakit batuk dan tidak bisa datang hari ini" class="input-xlarge" data-rule-required="true" data-rule-minlength="5" data-rule-maxlength="99"><?php echo $izin->als_abs; ?></textarea>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Bukti format (*.jpg)</label>
										<div class="controls">
											<input class="file" type="file" accept="image/*" name="userfile" /><br/>
										</div>
									</div>
									<div class="form-actions">
										<button type="submit" class="btn btn-primary">Simpan</button>
										<a href="<?php echo base_url(); ?>admin/izin" class="btn">Batal</a>
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