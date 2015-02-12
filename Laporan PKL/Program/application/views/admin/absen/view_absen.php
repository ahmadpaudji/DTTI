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
						if ($this->session->flashdata('notif'))
						{
					?>
						<div class="alert alert-<?php echo $this->session->flashdata('alert');?>">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<?php echo $this->session->flashdata('notif'); ?>
						</div>
					<?php
						}
						$tgl_upl = array();
						for ($u = 21; $u <= 27 ; $u++)
						{
							$tgl_upl[] = $u;
						}

						date_default_timezone_set("Asia/Jakarta");
						if (in_array(date("d"),$tgl_upl))
						{
					?>
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-edit"></i>Upload Terakhir<br/>
								<?php
									if (!is_null($last_upload->tanggal))
									{
										$tgl = explode('-', $last_upload->tanggal);
										echo "(<font color='red'>".$tgl[2].'-'.$tgl[1].'-'.$tgl[0]."</font>)";
									}
								?>
								</h3>
							</div>
							<div class="box-content">
								<?php
									echo form_open_multipart('admin/upload');
								?>
								<div class="control-group">
									<label for="file" class="control-label">File-input</label>
									<div class="controls">
										<input type="file" name="userfile" id="file" class="input-block-level">
										<span class="help-block">Hanya .xls (maks. 1 MB)</span>
										<button type="submit" class="btn btn-primary">Upload</button>
									</div>
								</div>
								<?php 
									echo form_close();
								?>
							</div>
						<?php
						}
						else
						{
							echo "Silahkan upload setiap tanggal 20 - 27.";
						}
						?>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div> <?php //akhir div container content ?>
	</body>

	</html>