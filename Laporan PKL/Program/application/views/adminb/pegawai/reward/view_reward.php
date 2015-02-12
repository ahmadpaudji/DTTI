<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Reward</h1>
						<?php
						if ($this->session->userdata("hak") == "admin")
						{
						?>
						<a href="<?php echo base_url(); ?>admin/reward/tambah" class="btn btn-primary">Tambah</a>
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
									Data Reward
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
											foreach ($reward as $rwd) 
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
													echo $rwd->nma_lkp_pgw;
												?>
											</td>
											<td class='hidden-350'>
												<?php
													echo $rwd->jns_reward;
												?>
											</td>
											<td class='hidden-350'>
												<?php
													echo $rwd->ket_reward;
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
														<a href="<?php echo base_url(); ?>admin/reward/ubah/<?php echo $rwd->id_reward; ?>">Ubah</a>
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