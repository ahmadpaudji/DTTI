<!--[ANNIE83E333BF08546819]-->
<!doctype html>
<html>
<head>
	<meta charset="utf8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	

	<!-- Bootstrap -->
	<link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.min.css">
	<!-- Bootstrap responsive -->
	<link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap-responsive.min.css">
	<!-- jQuery UI -->
	<link rel="stylesheet" href="<?php echo base_url();?>css/plugins/jquery-ui/smoothness/jquery-ui.css">
	<link rel="stylesheet" href="<?php echo base_url();?>css/plugins/jquery-ui/smoothness/jquery.ui.theme.css">

	<!-- Theme CSS -->
	<link rel="stylesheet" href="<?php echo base_url();?>css/style.css">
	<!-- Color CSS -->
	<link rel="stylesheet" href="<?php echo base_url();?>css/themes.css">

	<!-- Favicon -->
	<link rel="shortcut icon" href="<?php echo base_url();?>img/favicon.ico" />
	<!-- Apple devices Homescreen icon -->
	<link rel="apple-touch-icon-precomposed" href="<?php echo base_url();?>img/apple-touch-icon-precomposed.png" />

</head>

<body>
	<div id="navigation" style="height:40px">
		<div class="container-fluid">
			<a href="#" id="brand">DTTI</a>
		</div>
	</div>

	<div class="modal-dialog text-center" style="width:40%;margin-left:30%;margin-top:120px;background:#95a5a6;" >
		<div class="modal-content">
			<div class="modal-head">
				<h3>Selamat datang di Sistem Absen</h3>
				<?php if($error) : ?>
				<div class="alert alert-error">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
						Kombinasi <strong>Password dan Email!</strong> Tidak Sesuai
				</div>
				<?php endif; ?>
			</div>
			<div class="modal-body">
			<?php echo validation_errors(); ?>
			<?php echo form_open(); ?>
				<table class="table">
					<tr>
						<td>Username</td>
						<td><?php echo form_input('email'); ?></td>
					</tr>
					<tr>
						<td>Password</td>
						<td> <?php echo form_password('password'); ?> </td>
					</tr>
					<tr>
						<td></td>
						<td> <input type="submit" value="Login" class="btn btn-primary" /> </td>
					</tr>
				</table>
			<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</body>
</html>


