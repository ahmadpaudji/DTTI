<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Libur</h1>
						<a href="<?php echo base_url(); ?>admin/libur/tambah" class="btn btn-primary">Tambah</a>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span7">
					<?php
						if ($this->session->flashdata('pesan'))
						{
					?>
					<div class="alert alert-<?php echo $this->session->flashdata("alert");?>">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<?php echo $this->session->flashdata("pesan");?>.
					</div>
					<?php
						}
					?>
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="icon-table"></i>
									Daftar Libur
								</h3>
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin dataTable table-bordered">
									<thead>
										<tr>
											<th>No.</th>
											<th>Tanggal</th>
											<th class='hidden-350'>Nama</th>
											<th>Aksi</th>
										</tr>
										
									</thead>
									<tbody>
										<?php
											$i = 1;
											foreach ($libur as $lbr) 
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
												$tanggal = explode('-', $lbr->tgl_libur);
													echo $tanggal[2].'-'.$tanggal[1].'-'.$tanggal[0];
												?>
											</td>
											<td class='hidden-350'>
												<?php
													echo $lbr->nama_libur;
												?>
											</td>
											<td class="btn-group">
												<a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle"><i class="icon-cogs"></i> <span class="caret"></span></a>
												<ul class="dropdown-menu">
													<li>
														<a href="<?php echo base_url(); ?>admin/libur/ubah/<?php echo $lbr->id_libur; ?>">Ubah</a>
													</li>
													<li>
														<a href="<?php echo base_url(); ?>admin/libur/hapus/<?php echo $lbr->id_libur; ?>">Hapus</a>
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