<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Presensi</h1>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span12">
					<?php
						if ($this->session->flashdata('notifikasi'))
						{
					?>
						<div class="<?php echo $this->session->flashdata('class'); ?>">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<?php echo $this->session->flashdata('notifikasi'); ?>
						</div>
					<?php
						}
					?>
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-edit"></i>Ubah Presensi Pegawai</h3>
							</div>
							<div class="box-content">
								<form action="<?php echo base_url() ; ?>admin/absen/aksi_ubah/<?php echo $absen->id_prs; ?>" method="POST" enctype="multipart/form-data" class='form-horizontal form-validate' id="bb">
									<div class="control-group">
										<label for="textfield" class="control-label">Status</label>
										<div class="controls">
											<div class="input-xlarge">
												<select name="status" id="status" class='input-small' onchange="bukti()">
												<?php
													$alpha = "";
													$cuti = "";
													$hadir = "";
													$ijin = "";
													$libur = "";
													$sakit = "";

													if ($absen->stat_prs == "alpha")
													{
														$alpha = "selected";
													}
													else if ($absen->stat_prs == "cuti")
													{
														$cuti = "selected";
													}
													else if ($absen->stat_prs == "hadir")
													{
														$hadir = "selected";
													}
													else if ($absen->stat_prs == "ijin")
													{
														$ijin = "selected";
													}
													else if ($absen->stat_prs == "libur")
													{
														$libur = "selected";
													}
													else if ($absen->stat_prs == "sakit")
													{
														$sakit = "selected";
													}
												?>
													<option value="alpha" <?php echo $alpha; ?>>Alpha</option>
													<option value="cuti" <?php echo $cuti; ?>>Cuti</option>
													<option value="hadir" <?php echo $hadir; ?>>Hadir</option>
													<option value="ijin" <?php echo $ijin; ?>>Ijin</option>
													<option value="libur" <?php echo $libur; ?>>Libur</option>
													<option value="sakit" <?php echo $sakit; ?>>Sakit</option>					
												</select>
											</div>
										</div>
									</div>
									<div class="control-group" id="jam">
										<label for="timepicker" class="control-label">Jam Masuk</label>
										<div class="controls">
											<div class="input-append bootstrap-timepicker">
												<input id="time" name="jam" type="text" class="input-small" value="<?php echo $absen->jm_msk_prs; ?>">
												<span class="add-on">
													<i class="icon-time"></i>
												</span>
											</div>
										</div>
									</div>
									<div class="control-group" id="keluar">
										<label for="timepicker" class="control-label">Jam Keluar</label>
										<div class="controls">
											<div class="input-append bootstrap-timepicker">
												<input id="time_keluar" name="jamklr" type="text" class="input-small" value="<?php echo $absen->jm_klr_prs; ?>">
												<span class="add-on">
													<i class="icon-time"></i>
												</span>
											</div>
										</div>
									</div>
									<div class="form-actions">
										<button type="submit" class="btn btn-primary">Simpan</button>
										<a href="<?php echo base_url(); ?>admin/absen" class="btn">Batal</a>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div> <?php //akhir div container content ?>
	<script>
		$(function() 
		{
			$('#time').timepicker(
				{				
					minuteStep: 1,
					appendWidgetTo: 'body',
					showSeconds: false,
					showMeridian: false,
					defaultTime: false,
					mode: '24h'
				});
		});

		$(function() 
		{
			$('#time_keluar').timepicker(
				{				
					minuteStep: 1,
					appendWidgetTo: 'body',
					showSeconds: false,
					showMeridian: false,
					defaultTime: false,
					mode: '24h'
				});
		});

		$(function bukti()
		{
				if($('#status').val() == 'alpha')
				{
					$('#jam').hide();
					$('#keluar').hide();
				}
				else if($('#status').val() == 'cuti')
				{
					$('#jam').hide();
					$('#keluar').hide();
				}
				else if($('#status').val() == 'hadir')
				{
					$('#jam').show();
					$('#keluar').show();
				}
				else if($('#status').val() == 'ijin')
				{
					$('#jam').hide();
					$('#keluar').hide();
				}
				else if($('#status').val() == 'libur')
				{
					$('#jam').hide();
					$('#keluar').hide();
				}
				else if($('#status').val() == 'sakit')
				{
					$('#jam').hide();
					$('#keluar').hide();
				}
		});

		window.load = function() 
		{
			bukti();
		};

		$(function()
		{
			$('#status').on('click',function()
			{
				if($(this).val() == 'alpha')
				{
					$('#jam').hide();
					$('#keluar').hide();
				}
				else if($(this).val() == 'cuti')
				{
					$('#jam').hide();
					$('#keluar').hide();
				}
				else if($(this).val() == 'hadir')
				{
					$('#jam').show();
					$('#keluar').show();
				}
				else if($(this).val() == 'ijin')
				{
					$('#jam').hide();
					$('#keluar').hide();
				}
				else if($(this).val() == 'libur')
				{
					$('#jam').hide();
					$('#keluar').hide();
				}
				else if($(this).val() == 'sakit')
				{
					$('#jam').hide();
					$('#keluar').hide();
				}
			});
		});
	</script>
	</body>

	</html>