<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Anak</h1>
					<?php
					if ($this->session->userdata("hak") == "admin") 
					{
					?>
					<a href="<?php echo base_url(); ?>admin/anak/tambah" class="btn btn-primary">Tambah</a>
					<?php
					}
					?>
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
							<strong>Berhasil !</strong> Data anak berhasil ditambahkan.
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
							<strong>Berhasil !</strong> Mengubah data anak.
						</div>
					<?php
						}
					?>
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="icon-table"></i>
									Data Anak
								</h3>
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin dataTable table-bordered">
									<thead>
										<tr>
											<th>No.</th>
											<th>Nama Pegawai</th>
											<th class='hidden-350'>Anak Ke-</th>
											<th class='hidden-350'>Nama Anak</th>
											<th class='hidden-350'>Jenis Kelamin</th>
											<th class='hidden-350'>Tempat Tanggal Lahir</th>
											<?php
												if ($this->session->userdata("hak") == "admin")
												{
											?>
											<th>Aksi</th>
											<?php
												}
											?>
										</tr>
									</thead>
									<tbody>
										<?php
											$i = 1;
											foreach ($anak as $ank) 
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
													echo $ank->nma_lkp_pgw;
												?>
											</td>
											<td class='hidden-350'>
												<?php
													echo $ank->no_urut_anak;
												?>
											</td>
											<td class='hidden-350'>
												<?php
													echo $ank->nma_anak;
												?>
											</td>
											<td class='hidden-350'>
												<?php
													echo $ank->jk_anak;
												?>
											</td>
											<td class='hidden-350'>
												<?php
													$tanggal = explode('-', $ank->tgl_lhr_anak);
													echo $ank->tmp_lhr_anak.', '.$tanggal[2].'-'.$tanggal[1].'-'.$tanggal[0];
												?>
											</td>
											<?php
												if ($this->session->userdata("hak") == "admin")
												{
											?>
											<td class="btn-group">
												<a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle"><i class="icon-cogs"></i> <span class="caret"></span></a>
												<ul class="dropdown-menu">
													<li>
														<a href="<?php echo base_url(); ?>admin/anak/ubah/<?php echo $ank->id_anak; ?>">Ubah</a>
													</li>
												</ul>
											</td>
											<?php
												}
											?>
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