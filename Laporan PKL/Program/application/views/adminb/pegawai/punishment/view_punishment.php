<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Punishment</h1>
						<?php
						if ($this->session->userdata("hak") == "admin")
						{
						?>
						<a href="<?php echo base_url(); ?>admin/punishment/tambah" class="btn btn-primary">Tambah</a>
						<?php
						}
						?>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span12">
					<?php
						if ($this->session->flashdata("notif"))
						{
					?>
						<div class="alert alert-<?php echo $this->session->flashdata('alert');?>">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<?php echo $this->session->flashdata('notif');?>
						</div>
					<?php
						}
					?>
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="icon-table"></i>
									Data Punishment
								</h3>
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin dataTable table-bordered">
									<thead>
										<tr>
											<th>No.</th>
											<th>Nama</th>
											<th class='hidden-350'>Jenis</th>
											<th class='hidden-350'>Keterangan</th>
											<th class='hidden-350'>Surat</th>
											
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
											foreach ($punishment as $pns) 
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
													echo $pns->nma_lkp_pgw;
												?>
											</td>
											<td class='hidden-350'>
												<?php
													echo $pns->jns_pun;
												?>
											</td>
											<td class='hidden-350'>
												<?php
													echo $pns->ket_pun;
												?>
											</td>
											<td class='hidden-350'>
												<?php
													if (is_null($pns->surat_pun)) 
													{
														echo "Tidak ada file";
													}
													else
													{
												?>
													<a href="<?php echo base_url().'admin/punishment/download/'.$pns->id_pun;?>" target="_blank">Download</a>
												<?php
													}
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
														<a href="<?php echo base_url(); ?>admin/punishment/ubah/<?php echo $pns->id_pun; ?>">Ubah</a>
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