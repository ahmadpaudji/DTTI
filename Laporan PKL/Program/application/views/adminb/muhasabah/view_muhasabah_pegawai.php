<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Muhasabah</h1>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-edit"></i>Data Muhasabah</h3>
							</div>
							<div class="box-content">
							<?php
									if ($this->session->userdata("hak") == "admin")
									{
										$link = "admin/muhasabah/cari";
									}
									else
									{
										$link = "admin/muhasabah/lihat/cari";
									}
							?>
							<form action="<?php echo base_url().$link ; ?>" method="POST" class='form-horizontal form-validate'>
								<?php
									if ($this->session->userdata("hak") == "admin")
									{
								?>
								<div class="control-group">
									<label for="textfield" class="control-label">Nama</label>
									<div class="controls">
										<div class="input-xlarge">
											<select name="pegawai" id="pegawai" class='chosen-select'>
												<option value="">Semua</option>
												<?php
												foreach ($pegawai as $pgw)
												{
													?>
													<option value="<?php echo $pgw->id_pgw; ?>"><?php echo $pgw->nma_lkp_pgw; ?></option>
													<?php
												}
												?>
											</select>
										</div>
									</div>
								</div>
								<?php
									}
								?>
								<div class="control-group">
									<label for="textfield" class="control-label">Tanggal Awal</label>
									<div class="controls">
										<input type="text" name="tanggal_awal" class="input-medium datepick">
									</div>
								</div>
								<div class="control-group">
									<label for="textfield" class="control-label">Tanggal Akhir</label>
										<div class="controls">
											<input type="text" name="tanggal_akhir" class="input-medium datepick">
										</div>
								</div>
								<div class="control-group">
									<div class="controls">
									<button type="submit" class="btn btn-primary">Cari</button>
									</div>
								</div>
							</form>
								<div class="control-group">
									Catatan : Tidak perlu diisi jika tidak diperlukan
								</div>
							</div>
							
						</div>
					</div>
				</div>
				<?php
					if ($tampil == "true")
						{
				?>
				<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="icon-table"></i>
									Data Muhasabah
								</h3>
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin dataTable table-bordered">
									<thead>
										<tr>
											<th>No.</th>
											<?php
												if ($this->session->userdata("hak") == "admin")
												{
											?>
											<th>Nama Pegawai</th>
											<?php
												}
											?>
											<th class='hidden-350'>Tanggal</th>
											<th class='hidden-350'>Al-Qur'an</th>
											<th class='hidden-350'>Tahhajud</th>
											<th class='hidden-350'>Shodaqoh</th>
											<th class='hidden-350'>Puasa</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$i = 1;
											foreach ($muhasabah as $mhb) 
											{
										?>
										<tr>
											<td>
												<?php
													echo $i++;
												?>
											</td>
											<?php
												if ($this->session->userdata("hak") == "admin")
												{
											?>
											<td>
												<?php
													echo $mhb->nma_lkp_pgw;
												?>
											</td>
											<?php
												}
											?>
											<td class='hidden-350'>
												<?php
													$tgl_mhb = explode('-', $mhb->tgl_mhb);
													echo $tgl_mhb[2].'-'.$tgl_mhb[1].'-'.$tgl_mhb[0];
												?>
												
											</td>
											<td class='hidden-350'>
												<?php
													if ($mhb->alq_mhb == 'Y')
													{
														echo '<i class="icon-ok"></i>';
													}
													else
													{
														echo '<i class="icon-remove"></i>';
													}
												?>
											</td>
											<td class='hidden-350'>
												<?php
													if ($mhb->thj_mhb == 'Y')
													{
														echo '<i class="icon-ok"></i>';
													}
													else
													{
														echo '<i class="icon-remove"></i>';
													}
												?>
											</td>
											<td class='hidden-350'>
												<?php
													if ($mhb->sdq_mhb == 'Y')
													{
														echo '<i class="icon-ok"></i>';
													}
													else
													{
														echo '<i class="icon-remove"></i>';
													}
												?>
											</td>
											<td class='hidden-350'>
												<?php
													if ($mhb->psa_mhb == 'Y')
													{
														echo '<i class="icon-ok"></i>';
													}
													else
													{
														echo '<i class="icon-remove"></i>';
													}
												?>
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
				<?php
					}
				?>
			</div>
		</div>

	</div> <?php //akhir div container content ?>
	</body>

	</html>