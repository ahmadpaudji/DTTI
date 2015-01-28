<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Key Performance Indicator</h1>
						
					</div>
					
				</div>
				<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="icon-table"></i>
									Data KPI Pegawai
								</h3>
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin dataTable table-bordered">
									<thead>
										<tr>
											<th>No.</th>
											<th>Pegawai</th>
											<th class='hidden-350'>Kedisiplinan</th>
											<th class='hidden-350'>Muhasabah</th>
											<th class='hidden-350'>Total</th>
											<th class='hidden-350'>Aksi</th>
										</tr>
									</thead>
									<tbody>
									<?php
									if (count($kpi) > 1)
									{
										$i = 0;
										foreach ($kpi as $k)
										{
											$i++;
									?>
										<tr>
											<td>
											<?php echo $i;?>
											</td>
											<td>
												<?php echo $k['pegawai'];?>
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
												
												<a href="<?php echo base_url('admin/kpi/chart/0/'.$k['id_pgw']);?>" style="margin-left:2px" class="btn btn-primary"><i class="icon-bar-chart"></i></a>
											</td>
										</tr>
									<?php
										}
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