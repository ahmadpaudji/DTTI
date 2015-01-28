<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Absen</h1>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-edit"></i>Rekapitulasi Cuti</h3>
							</div>
							<div class="box-content">
							<form action="<?php echo base_url() ; ?>admin/absen/cuti/cari" method="POST" class='form-horizontal form-validate'>
								<div class="control-group">
									<label for="textfield" class="control-label">Periode Bulan</label>
									<div class="controls">
										<input type="text" name="tanggal_periode" class="input-small datepick">
									</div>
								</div>
								<div class="control-group">
									<div class="controls">
										<button type="submit" class="btn btn-primary">Cari</button>
									</div>
								</div>
							</form>
								<div class="control-group">
									Catatan : <br />
									- Tidak perlu diisi jika tidak diperlukan (default periode sekarang) <br />
									- Periode bulan merupakan bulan awal periode, pilihan tanggal tidak berpengaruh
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
									Data Absen
								</h3>
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin dataTable table-bordered">
									<thead>
										<tr>
											<th>No.</th>
											<th>Nama Pegawai</th>
											<th class='hidden-350'>Total Cuti (Periode)</th>
											<th class='hidden-350'>Total Cuti (Tahun)</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$i = 1;
											foreach ($cuti as $ct) 
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
													echo $ct['nma_lkp_pgw'];
												?>
											</td>
											<td class='hidden-350'>
												<?php
													if (($ct['alpha'] + $ct['cuti'] + $ct['ijin'] + $ct['sakit']) != 0)
													{
														$total = ($ct['alpha'] + $ct['cuti'] + $ct['ijin'] + $ct['sakit']);
													}
													else
													{
														$total = 0;
													}
													echo $total.'/3';
												?>
											</td>
											<td class='hidden-350'>
												<?php
													if (($ct['alpha_t'] + $ct['cuti_t'] + $ct['ijin_t'] + $ct['sakit_t']) != 0)
													{
														$total = ($ct['alpha_t'] + $ct['cuti_t'] + $ct['ijin_t'] + $ct['sakit_t']);
													}
													else
													{
														$total = 0;
													}
													echo $total.'/12';
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