<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Rekening Bank</h1>
						<a href="<?php echo base_url(); ?>admin/bank/tambah" class="btn btn-primary">Tambah</a>
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
							<strong>Berhasil !</strong> Data rekening bank berhasil ditambahkan.
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
							<strong>Berhasil !</strong> Mengubah data rekening bank.
						</div>
					<?php
						}
					?>
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="icon-table"></i>
									Data Rekening Bank
								</h3>
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin dataTable table-bordered">
									<thead>
										<tr>
											<th>No.</th>
											<th>Nama</th>
											<th class='hidden-350'>Bank</th>
											<th class='hidden-350'>No. Rekening</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$i = 1;
											foreach ($bank as $bnk) 
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
													echo $bnk->nma_lkp_pgw;
												?>
											</td>
											<td class='hidden-350'>
												<?php
													echo $bnk->sktn_bank;
												?>
											</td>
											<td class='hidden-350'>
												<?php
													echo $bnk->no_rek;
												?>
											</td>
											<td class="btn-group">
												<a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle"><i class="icon-cogs"></i> <span class="caret"></span></a>
												<ul class="dropdown-menu">
													<li>
														<a href="<?php echo base_url(); ?>admin/bank/ubah/<?php echo $bnk->id_dtl_bank; ?>">Ubah</a>
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