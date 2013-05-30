<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Paises</title>
		<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.js'); ?>" ></script>
		<style>
		.mensaje{
			padding: 10px;
			width: 90%;
			margin: 10px auto;
		}
		
		.exito{
			background: #0A0;
			color: #0F0;
		}
		
		.error{
			background: #A00;
			color: #F00;
		}
		</style>
	</head>
	<body>
	
		<?php echo anchor('/paises', 'Gestor de Paises'); ?>
		<?php echo anchor('/contactos', 'Gestor de Contactos'); ?>
		<?php echo anchor('/login/logout', 'Cerrar Sesión'); ?>
		
		<?php if($this->session->flashdata('mensajeError')){ ?>
			<div class="mensaje error">
			<?php 	echo $this->session->flashdata('mensajeError'); ?>
			</div>
		<?php } ?>
		<?php if($this->session->flashdata('mensajeExito')){ ?>
			<div class="mensaje exito">
			<?php 	echo $this->session->flashdata('mensajeExito'); ?>
			</div>
		<?php } ?>
		
		<?php $this->load->view($pagina); ?>
		
	</body>
</html>