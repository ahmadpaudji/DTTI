<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Pelatihan</h1>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-edit"></i>Rekapitulasi Pelatihan</h3>
							</div>
							<div class="box-content">
							<form class='form-horizontal form-validate'>
								
								<div class="control-group">
									<label for="textfield" class="control-label"><b>Periode Awal</b></label>
									<div class="controls">
										<?php
											$tgl_awal = explode('-', $pelatihan->tanggal_awal);
											echo $tgl_awal[2].'-'.$tgl_awal[1].'-'.$tgl_awal[0];
										?>
									</div>
								</div>
								<div class="control-group">
									<label for="textfield" class="control-label"><b>Periode Akhir</b></label>
									<div class="controls">
										<?php
											$tgl_akhir = explode('-', $pelatihan->tanggal_akhir);
											echo $tgl_akhir[2].'-'.$tgl_akhir[1].'-'.$tgl_akhir[0];
										?>
									</div>
								</div>
								<div class="control-group">
									<label for="textfield" class="control-label"><b>Status</b></label>
										<div class="controls">
											Diterima
										</div>
								</div>
							</form>
							</div>
							
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span12">
						<?php
							if ($this->session->userdata('hak') == "admin")
							{
						?>
							<div>
								<a href="<?php echo base_url("admin/pelatihan/cetakRekap");?>" style="margin-left:2px" class="btn btn-primary">CETAK</a>
								
							</div>
						<?php
							}
						?>
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="icon-table"></i>
									Rekapitulasi
								</h3>
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin dataTable table-bordered">
									<thead>
										<tr>
											<th>No.</th>
											<th>Nama Pegawai</th>
											<th class='hidden-350'>Diterima</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$i = 1;
											foreach ($pelatihan->lth as $l) 
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
													echo $l['nama'];
												?>
											</td>
											<td class='hidden-350'>
												<?php
													echo $l['terima'];
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