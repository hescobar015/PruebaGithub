<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Paises</title>
		<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.js'); ?>" ></script>
	</head>
	<body>
	
		<?php
		
			if($this->session->flashdata('mensajeError'))
			{ ?>
			<div class="mensaje error">
			<?php 	echo $this->session->flashdata('mensajeError'); ?>
			</div>
		<?php }
		
		?>
	
		<?php echo form_open('/login/validar_datos'); ?>
		Usuario <input type="text" name="usuario" />
		Contraseña <input type="password" name="contrasena" />
		<input type="submit" name="boton" value="Ingresar" />
		<?php echo form_close(); ?>
		
	</body>
</html>