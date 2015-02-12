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
								<h3><i class="icon-edit"></i>Persentase</h3>
							</div>
							<div class="box-content">
							<form action="<?php echo base_url() ; ?>admin/muhasabah/persentase/cari" method="POST" class='form-horizontal form-validate'>
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
											<th>Nama Pegawai</th>
											<th class='hidden-350'>Al-Qur'an</th>
											<th class='hidden-350'>Tahajud</th>
											<th class='hidden-350'>Shodaqoh</th>
											<th class='hidden-350'>Puasa</th>
											<th class='hidden-350'>Total</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$i = 1;
											foreach ($persentase as $pr) 
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
													echo $pr['nma_lkp_pgw'];
												?>
											</td>
											<td class='hidden-350'>
												<?php
													echo $pr['alq_mhb'].'%';
												?>
											</td>
											<td class='hidden-350'>
												<?php
													echo $pr['alq_mhb'].'%';
												?>
											</td>
											<td class='hidden-350'>
												<?php
													echo $pr['sdq_mhb'].'%';
												?>
											</td>
											<td class='hidden-350'>
												<?php
													echo $pr['psa_mhb'].'%';
												?>
											</td>
											<td class='hidden-350'>
												<?php
													$hsl = $pr['alq_mhb'] + $pr['alq_mhb'] + $pr['sdq_mhb'] + $pr['psa_mhb'];
													echo $hsl.'%';
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
			</div>
		</div>

	</div> <?php //akhir div container content ?>
	</body>
	</html>