<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Pegawai</h1>
						<a href="<?php echo base_url(); ?>admin/pegawai/tambah" class="btn btn-primary">Tambah</a>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span12">
					<?php
						if ($this->input->get('sukses') == "ya")
						{
					?>
						<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>Berhasil !</strong> Data pegawai berhasil ditambahkan.
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
							<strong>Berhasil !</strong> Mengubah data pegawai.
						</div>
					<?php
						}
					?>
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="icon-table"></i>
									Data Pegawai
								</h3>
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin dataTable table-bordered">
									<thead>
										<tr>
											<th>No.</th>
											<th>NIK</th>
											<th class='hidden-350'>Nama</th>
											<th class='hidden-350'>E-mail</th>
											<th class='hidden-350'>Divisi</th>
											<th class='hidden-350'>Jabatan</th>
											<th class='hidden-350'>Status</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$i = 1;
											foreach ($pegawai as $pgw) 
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
													echo $pgw->nik_pgw;
												?>
											</td>
											<td class='hidden-350'>
												<?php
													echo $pgw->nma_lkp_pgw;
												?>
											</td>
											<td class='hidden-350'>
												<?php
													echo $pgw->email_pgw;
												?>
											</td>
											<td class='hidden-350'>
												<?php
													echo $pgw->div_jbtn;
												?>
											</td>
											<td class='hidden-350'>
												<?php
													echo $pgw->nma_jbtn;
												?>
											</td>
											<td class='hidden-350'>
												<?php
													if ($pgw->stat_akt_pgw == 'Y')
													{
														echo "Aktif";
													}
													else
													{
														echo "Tidak Aktif";
													}
												?>
											</td>
											<td class="btn-group">
												<a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle"><i class="icon-cogs"></i> <span class="caret"></span></a>
												<ul class="dropdown-menu">
													<li>
														<a href="<?php echo base_url(); ?>admin/pegawai/detail/<?php echo $pgw->id_pgw; ?>">Detil</a>
													</li>
													<li>
														<a href="<?php echo base_url(); ?>admin/pegawai/ubah/<?php echo $pgw->id_pgw; ?>">Ubah</a>
													</li>
													<li>
														<?php
															if ($pgw->stat_akt_pgw == 'Y')
															{
																$status_aktif = "Non-Aktifkan";
																$aktifasi = 0;
															}
															else
															{
																$status_aktif = "Aktifkan";
																$aktifasi = 1;
															}
														?>
														<a href="<?php echo base_url(); ?>admin/pegawai/aktifasi/<?php echo $pgw->id_pgw.'/'.$aktifasi; ?>"><?php echo $status_aktif; ?></a>
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