<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Pegawai</h1>
						<?php
							if ($this->session->userdata['hak'] == "admin")
							{
						?>
							<a href='<?php echo base_url();?>admin/pegawai/cetak/<?php echo $pegawai->id_pgw;?>' class='btn btn-primary'>CETAK</a>
						<?php
							}
						?>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6">
					<?php
						if ($this->session->flashdata('errors'))
						{
					?>
						<div class="alert alert-error">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<?php echo $this->session->flashdata('errors'); ?>
						</div>
					<?php
						}
					?>
						<div class="box box-bordered box-color">
							<div class="box-title">
								<h3><i class="icon-th-list"></i>Detil Pegawai</h3>
							</div>
							<div class="box-content nopadding">
								<div class='form-horizontal form-bordered'>
									<div class="control-group">
										<div class="controls">
											<?php
												$foto = "";

												if (is_null($pegawai->photo_pgw)) 
												{
													$foto = "img/no_image.png";
												}
												else
												{
													$foto = $pegawai->photo_pgw;
												}
											?>
											<img width="100" src="<?php echo base_url().$foto; ?>" />
											<?php
												if ($pegawai->id_pgw == $this->session->userdata['id_pgw'])
												{
											?>
											<form action="<?php echo base_url() ; ?>admin/pegawai/foto" method="POST" enctype="multipart/form-data">
											<input class="file" type="file" accept="image/*" name="userfile" /><br/>
											<button type="submit" class="btn btn-primary">Upload</button>
											</form>
											<?php
												}
											?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Nama</label>
										<div class="controls">
											<?php
												echo $pegawai->nma_lkp_pgw;
											?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">TTL</label>
										<div class="controls">
											<?php
												$tgl = explode('-', $pegawai->tgl_lhr_pgw);
												echo $pegawai->tmp_lhr_pgw.', '.$tgl[2].'-'.$tgl[1].'-'.$tgl[0];
											?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Jenis Kelamin</label>
										<div class="controls">
											<?php
												if ($pegawai->jk_pgw == 'L')
												{
													echo "Laki-laki";
												}
												else
												{
													echo "Perempuan";
												}
											?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Alamat</label>
										<div class="controls">
											<?php
												echo $pegawai->almt_pgw;
											?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Status</label>
										<div class="controls">
											<?php
												echo $pegawai->stat_pgw;
											?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Pasangan</label>
										<div class="controls">
											<?php
												if ($pegawai->nma_psg_pgw != '')
												{
													echo $pegawai->nma_psg_pgw;
												}
												else
												{
													echo '-';
												}
											?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Golongan Darah</label>
										<div class="controls">
											<?php
												echo $pegawai->gol_drh_pgw;
											?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="span6">
						<div class="box box-bordered box-color">
							<div class="box-title">
								<h3><i class="icon-th-list"></i>Detil Lainnya</h3>
							</div>
							<div class="box-content nopadding">
								<form class='form-horizontal form-bordered'>
									<div class="control-group">
										<label class="control-label">Divisi</label>
										<div class="controls">
											<?php
												echo $pegawai->div_jbtn;
											?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Jabatan</label>
										<div class="controls">
											<?php
												echo $pegawai->nma_jbtn;
											?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">NIK</label>
										<div class="controls">
											<?php
												echo $pegawai->nik_pgw;
											?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">KTP</label>
										<div class="controls">
											<?php
												echo $pegawai->no_ktp_pgw;
											?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">NPWP</label>
										<div class="controls">
											<?php
												echo $pegawai->npwp_pgw;
											?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Email</label>
										<div class="controls">
											<?php
												echo $pegawai->email_pgw;
											?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Level user</label>
										<div class="controls">
											<?php
												echo $pegawai->lev_usr_pgw;
											?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Hp</label>
										<div class="controls">
											<?php
												echo $pegawai->hp_pgw;
											?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Telepon</label>
										<div class="controls">
											<?php
												echo $pegawai->telp_pgw;
											?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Foto Kopi KTP</label>
										<div class="controls">
											<?php
												if (is_null($pegawai->pc_ktp_pgw))
												{
													echo "Tidak ada file";
												}
												else
												{
											?>
												<a href="<?php echo base_url()."admin/pegawai/download/".$pegawai->id_pgw;?>">Download</a>
											<?php
												}
											?>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>

	</div> <?php //akhir div container content ?>
	</body>

	</html>