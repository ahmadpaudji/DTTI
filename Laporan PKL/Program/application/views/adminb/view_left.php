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
						<span class="center"><img class="pasfoto" src="<?php echo base_url().$foto; ?>"></span><br/>
						<span class="center"><?php echo $this->session->userdata['username']; ?></span><br/>
						<span class="center"><?php echo $this->session->userdata['nik']; ?></span><br/>
						<span class="center"><b>
						<?php
						if ($this->session->userdata['jabatan'] == "kepala")
						{
						 	echo "kepala sekretariat"; 
						}
						else
						{
							echo $this->session->userdata['jabatan']; 
						}
						?>
						 </b></span>
					</div>
				</div>
			</div>
		</div>