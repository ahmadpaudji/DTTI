	<div class="container-fluid" id="content">
		<div id="left">
			<div class="subnav">
				<div class="subnav-content">
					<div class="pagestats">
					<?php
						if ($this->session->userdata['foto'] == null)
						{
							$foto = "img/no_image.png";
						}
						else
						{
							$foto = $this->session->userdata['foto'];
						}
					?>
						<span class="center"><img width="130px" src="<?php echo base_url().$foto; ?>"></span>
						<span class="center"><?php echo $this->session->userdata['nik']; ?></span><br/>
						<span class="center"><b><?php echo strtoupper($this->session->userdata['jabatan'].' | '.$this->session->userdata['jabatan']); ?></b></span>
					</div>
				</div>
			</div>
		</div>