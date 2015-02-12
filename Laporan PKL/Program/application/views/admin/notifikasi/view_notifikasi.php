<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Notifikasi</h1>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="icon-table"></i>
									Data Peringatan
								</h3>
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin dataTable table-bordered">
									<thead>
										<tr>
											<th>No.</th>
											<th>Nama Pegawai</th>
											<th class='hidden-350'>Tanggal</th>
											<th class='hidden-350'>Keterangan</th>
											<?php
												if ($this->session->userdata("hak") == "admin")
												{
											?>
											<th class='hidden-350'>Aksi</th>
											<?php
												}
											?>	
										</tr>
									</thead>
									<tbody>
										<?php
											$i = 1;
											foreach ($notifikasi as $nt) 
											{
										?>
										
										<tr>
											<td>
												<?php
													echo $i++;
												?>
											</td>
											<td class='hidden-350'>
												<?php
													echo $nt->nma_lkp_pgw;
												?>
											</td>
											<td class='hidden-350'>
												<?php

													$tgl_ntf = explode('-', substr($nt->waktu_notif, 0,10));
													echo $tgl_ntf[2].'-'.$tgl_ntf[1].'-'.$tgl_ntf[0];
												?>
											</td>
											<td class='hidden-350'>
												<?php
													echo $nt->ket_notif;
												?>
											</td>
											<?php
												if ($this->session->userdata("hak") == "admin")
												{
											?>
											<td class='hidden-350'>
												<?php
												if ($nt->status_notif == 'n')
												{
												?>
												<a href="<?php echo base_url()."admin/notifikasi/check/".$nt->id_notif; ?>">
											
												<button class="btn btn-info"><i class="icon-ok"></i></button></a>
												<?php
												}
												else
												{
													echo "<i class='icon-minus'></i>";
												}
												?>
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