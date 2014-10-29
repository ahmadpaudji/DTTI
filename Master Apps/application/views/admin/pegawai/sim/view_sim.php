<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>SIM</h1>
						<a href="<?php echo base_url(); ?>admin/sim/tambah" class="btn btn-primary">Tambah</a>
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
							<strong>Berhasil !</strong> Data SIM berhasil ditambahkan.
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
							<strong>Berhasil !</strong> Mengubah data SIM.
						</div>
					<?php
						}
					?>
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="icon-table"></i>
									Data SIM
								</h3>
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin dataTable table-bordered">
									<thead>
										<tr>
											<th>No.</th>
											<th>Nama</th>
											<th class='hidden-350'>No. SIM</th>
											<th class='hidden-350'>Jenis SIM</th>
											<th class='hidden-350'>Foto Copy SIM</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$i = 1;
											foreach ($sim as $sm) 
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
													echo $sm->nma_lkp_pgw;
												?>
											</td>
											<td class='hidden-350'>
												<?php
													echo $sm->no_sim;
												?>
											</td>
											<td class='hidden-350'>
												<?php
													echo $sm->jns_sim;
												?>
											</td>
											<td class='hidden-350'>
												<?php
													if (is_null($sm->pc_sim)) 
													{
														echo "Tidak ada file";
													}
													else
													{
												?>
													<a href="<?php echo base_url().$sm->pc_sim;?>" target="_blank">Download</a>
												<?php
													}
												?>
											</td>
											<td class="btn-group">
												<a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle"><i class="icon-cogs"></i> <span class="caret"></span></a>
												<ul class="dropdown-menu">
													<li>
														<a href="<?php echo base_url(); ?>admin/sim/ubah/<?php echo $sm->id_sim; ?>">Ubah</a>
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