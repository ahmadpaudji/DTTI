<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Muhasabah</h1>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-edit"></i>Tambah</h3>
							</div>
							<div class="box-content">
								<form action="<?php echo base_url(); ?>admin/muhasabah/aksi_tambah/<?php echo $tgl.'/'.$bln; ?>" method="POST" class='form-horizontal'>
								<div class="control-group">
									<div class="controls-label">
										<div class="check-demo-col">
											<div class="check-line">
												<input name="tahajud" type="checkbox" class='icheck-me' data-skin="square" data-color="blue">
												<label class='inline'>Shalat Tahajud</label>
											</div>
										</div>
									</div>
								</div>
								<div class="control-group">
									<div class="controls-label">
										<div class="check-demo-col">
											<div class="check-line">
												<input name="tadarus" type="checkbox" class='icheck-me' data-skin="square" data-color="blue">
												<label class='inline'>Membaca Al-Qur'an</label>
											</div>
										</div>
									</div>
								</div>
								<div class="control-group">
									<div class="controls-label">
										<div class="check-demo-col">
											<div class="check-line">
												<input name="shodaqoh" type="checkbox" class='icheck-me' data-skin="square" data-color="blue">
												<label class='inline'>Memberikan Shodaqoh</label>
											</div>
										</div>
									</div>
								</div>
								<div class="control-group">
									<div class="controls-label">
										<div class="check-demo-col">
											<div class="check-line">
												<input name="shaum" type="checkbox" class='icheck-me' data-skin="square" data-color="blue">
												<label class='inline'>Shaum Sunnat</label>
											</div>
										</div>
									</div>
								</div>
									<button type="submit" class="btn btn-primary">Simpan</button>
								
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