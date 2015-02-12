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
								<h3><i class="icon-edit"></i>Rekapitulasi</h3>
							</div>
							<div class="box-content">
							<form action="<?php echo base_url() ; ?>admin/muhasabah/rekap/cari" method="POST" class='form-horizontal form-validate'>
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
							if ($pegawai != '')
							{
								$this->session->set_flashdata("pegawai",$pegawai);
							}

							if ($tgl_awl != '')
							{
								$this->session->set_flashdata("tgl_awl",$tgl_awl);
							}

							if ($tgl_akh != '')
							{
								$this->session->set_flashdata("tgl_akh",$tgl_akh);
							}
				?>
				<div class="row-fluid">
					<div class="span12">
					<?php
					if ($this->session->userdata("hak") == "admin")
					{
						?>
						<div>
							<a href="<?php echo base_url("admin/muhasabah/cetak");?>">
								<button type="submit" class="btn btn-primary">CETAK</button>
							</a>
						</div>
					<?php
					}
					?>
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
											<td>
												<?php
													echo $mhb['nma_lkp_pgw'];
												?>
											</td>
											<td class='hidden-350'>
												<?php
													echo $mhb['alq_mhb'];
												?>
											</td>
											<td class='hidden-350'>
												<?php
													echo $mhb['thj_mhb'];
												?>
											</td>
											<td class='hidden-350'>
												<?php
													echo $mhb['sdq_mhb'];
												?>
											</td>
											<td class='hidden-350'>
												<?php
													echo $mhb['psa_mhb'];
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