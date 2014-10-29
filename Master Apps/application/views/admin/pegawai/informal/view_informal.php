<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Pendidikan Informal</h1>
						<a href="<?php echo base_url(); ?>admin/informal/tambah" class="btn btn-primary">Tambah</a>
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
							<strong>Berhasil !</strong> Data pendidikan informal berhasil ditambahkan.
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
							<strong>Berhasil !</strong> Mengubah data pendidikan informal.
						</div>
					<?php
						}
					?>
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="icon-table"></i>
									Data Pendidikan Informal Pegawai
								</h3>
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin dataTable table-bordered">
									<thead>
										<tr>
											<th>No.</th>
											<th>Nama Pegawai</th>
											<th class='hidden-350'>Pendidikan</th>
											<th class='hidden-350'>Nama Tempat</th>
											<th class='hidden-350'>Foto Copy Sertifikat</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$i = 1;
											foreach ($informal as $ifrm) 
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
													echo $ifrm->nma_lkp_pgw;
												?>
											</td>
											<td class='hidden-350'>
												<?php
													echo $ifrm->nma_pnd_informal;
												?>
											</td>
											<td class='hidden-350'>
												<?php
													echo $ifrm->nma_dtl_informal;
												?>
											</td>
											<td class='hidden-350'>
												<?php
													if (is_null($ifrm->pc_srtkt))
													{
														echo "Tidak ada file";
													}
													else
													{
												?>
												<a href="<?php echo base_url().'admin/informal/download/'.$ifrm->id_dtl_informal;?>">Download</a>
												<?php
													}
												?>
											</td>
											<td class="btn-group">
												<a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle"><i class="icon-cogs"></i> <span class="caret"></span></a>
												<ul class="dropdown-menu">
													<li>
														<a href="<?php echo base_url(); ?>admin/informal/ubah/<?php echo $ifrm->id_dtl_informal; ?>">Ubah</a>
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