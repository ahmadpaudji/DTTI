<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Key Performance Indicator</h1>
						<?php
							$disabled = 'disabled';
							for ($i=21; $i <= 27 ; $i++)
							{ 
								$tgl[] = $i;
							}

							if (in_array(date("d"),$tgl))
							{
								$disabled = '';
							}

							if ($this->session->userdata['hak'] == "admin")
							{
						?>

						<a href="<?php echo base_url(); ?>admin/kpi/generate" data-trigger="hover" rel="popover" class="btn btn-primary" data-content="Catatan : Tombol hanya bisa di tekan saat tanggal 21 sampai 27." <?php echo $disabled; ?>>Generate KPI</a>
						<br />
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
									Data KPI Divisi
								</h3>
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin dataTable table-bordered">
									<thead>
										<tr>
											<th>No.</th>
											<th>Divisi</th>
											<th class='hidden-350'>Kedisiplinan</th>
											<th class='hidden-350'>Muhasabah</th>
											<th class='hidden-350'>Total</th>
											<th class='hidden-350'>Aksi</th>
										</tr>
									</thead>
									<tbody>
									<?php
										$i = 0;
										foreach ($kpi->divisi as $k)
										{
											$i++;
									?>
										<tr>
											<td>
											<?php echo $i;?>
											</td>
											<td>
												<?php echo $k['divisi'];?>
											</td>
											<td>
												<?php echo number_format($k['kpi_prs'],2);?> %
											</td>
											<td class='hidden-350'>
												<?php echo number_format($k['kpi_mhb'],2);?> %
											</td>
											<td class='hidden-350'>
												<?php echo number_format((($k['kpi_mhb'] + $k['kpi_prs']) * 0.15),2);?> %
											</td>
											<td class="btn-group">
												<a href="<?php echo base_url('admin/kpi/pegawai/'.$k['divisi']);?>" style="margin-left:2px" class="btn btn-primary"><i class="icon-eye-open"></i></a>
												<a href="<?php echo base_url('admin/kpi/chart/'.$k['divisi']);?>" style="margin-left:2px" class="btn btn-primary"><i class="icon-bar-chart"></i></a>
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
				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-title">
								<h3>
									<i class="icon-table"></i>
									KPI Perusahaan Tahun Ini
								</h3>
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin">
									<thead>
										<tr>
											<th>KPI</th>
											<th>Jan</th>
											<th>Feb</th>
											<th>Mar</th>
											<th>Apr</th>
											<th>Mei</th>
											<th>Jun</th>
											<th>Jul</th>
											<th>Agust</th>
											<th>Sept</th>
											<th>Okt</th>
											<th>Nov</th>
											<th>Des</th>
											<th>Total</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Pelatihan</td>
											<?php
												$t_pelatihan = 0;
												foreach ($kpi->pelatihan as $p)
												{
											?>
											<td>
											<?php
												echo number_format($p['kpi'],2).' %';
												$t_pelatihan = $t_pelatihan + number_format($p['kpi'],2);
											?>
											</td>
											<?php
												}
											?>
											<td>
												<?php
													echo number_format(($t_pelatihan/12),2).' %';
												?>
											</td>
										</tr>
										<tr>
											<td>Kedisiplinan</td>
											<?php
												$t_presensi = 0;
												foreach ($kpi->presensi as $pr)
												{
											?>
											<td>
											<?php
												echo number_format($pr['kpi'],2).' %';
												$t_presensi = $t_presensi + number_format($pr['kpi'],2);
											?>
											</td>
											<?php
												}
											?>
											<td>
												<?php
													echo number_format(($t_presensi/12),2).' %';
												?>
											</td>
										</tr>
										<tr>
											<td>Muhasabah</td>
											<?php
												$t_muhasabah = 0;
												foreach ($kpi->muhasabah as $mh)
												{
											?>
											<td>
											<?php
												echo number_format($mh['kpi'],2).' %';
												$t_muhasabah = $t_muhasabah + number_format($mh['kpi'],2);
											?>
											</td>
											<?php
												}
											?>
											<td>
												<?php
													echo number_format(($t_muhasabah/12),2).' %';
												?>
											</td>
										</tr>

									</tbody>
								</table>
							</div>
							
					<div>
								<a href="<?php echo base_url("admin/kpi/cetak");?>" style="margin-left:2px" class="btn btn-primary">CETAK</a>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div> <?php //akhir div container content ?>
	</body>

	</html>