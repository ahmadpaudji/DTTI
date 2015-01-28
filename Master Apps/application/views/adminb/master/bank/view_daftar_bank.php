<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Bank</h1>
						<a href="<?php echo base_url(); ?>admin/daftarbank/tambah" class="btn btn-primary">Tambah</a>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6">
					<?php
						if ($this->input->get('sukses') == "ya")
						{
					?>
						<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>Berhasil !</strong> Bank baru berhasil ditambahkan.
						</div>
					<?php
						}
						else if ($this->input->get('sukses') == "tidak")
						{
					?>
						<div class="alert alert-error">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>Gagal !</strong> Terjadi kesalahan pada sistem.
						</div>
					<?php
						}
						else if ($this->input->get('sukses_ubah') == "ya")
						{
					?>
						<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>Berhasil !</strong> Mengubah bank.
						</div>
					<?php
						}
					?>
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="icon-table"></i>
									Daftar Bank
								</h3>
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin dataTable table-bordered">
									<thead>
										<tr>
											<th>No.</th>
											<th>Singkatan</th>
											<th class='hidden-350'>Nama</th>
											<th>Aksi</th>
										</tr>
										
									</thead>
									<tbody>
										<?php
											$i = 1;
											foreach ($daftar_bank as $bnk) 
											{
										?>
										<tr>
											<td>
												<?php
													echo $i++;
												?>
											</td>
											<td>
												<?php
													echo $bnk->sktn_bank;
												?>
											</td>
											<td class='hidden-350'>
												<?php
													echo $bnk->nma_bank;
												?>
											</td>
											<td class="btn-group">
												<a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle"><i class="icon-cogs"></i> <span class="caret"></span></a>
												<ul class="dropdown-menu">
													<li>
														<a href="<?php echo base_url(); ?>admin/daftarbank/ubah/<?php echo $bnk->id_bank; ?>">Ubah</a>
													</li>
												</ul>
											</td>
										</tr>
										<?php
											}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div> <?php //akhir div container content ?>
	</body>

	</html>