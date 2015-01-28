<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Libur</h1>
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
								<h3><i class="icon-edit"></i>Ubah Libur</h3>
							</div>
							<div class="box-content">
								<form action="<?php echo base_url() ; ?>admin/libur/aksi_ubah/<?php echo $libur->id_libur;?>" method="POST" class='form-horizontal form-validate' id="bb">
									<div class="control-group">
										<label for="textfield" class="control-label">Tanggal</label>
										<div class="controls">
											<?php
											$tgl = explode('-',$libur->tgl_libur);
											$tanggal = $tgl[1].'/'.$tgl[2].'/'.$tgl[0];
											?>
											<input type="text" name="tanggal" id="tanggal" value="<?php echo $tanggal;?>" readonly>
										</div>
									</div>
									<div class="control-group">
										<label for="nama" class="control-label">Nama</label>
										<div class="controls">
											<input type="text" name="nama" id="nama" value="<?php echo $libur->nama_libur;?>" placeholder="Contoh : Hari kemerdekaan" class="input-xlarge" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="80">
										</div>
									</div>
									<div class="form-actions">
										<button type="submit" class="btn btn-primary">Simpan</button>
										<a href="<?php echo base_url(); ?>admin/daftarbank" class="btn">Batal</a>
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