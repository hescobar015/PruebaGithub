<h1>Agregar País</h1>

<?php echo form_open('/paises/agregar_registro'); ?>
<input type="hidden" name="token" value="<?php echo $this->session->userdata('token'); ?>" />

<label>Nombre</label>
<input type="text" name="nombre" id="nombre" />

<label>Población</label>
<input type="text" name="poblacion" id="poblacion" />

<label>Capital</label>
<input type="text" name="capital" id="capital" />

<label>Continente</label>
<select name="continente" id="continente">
	<?php 
	$continentes = obtener_continentes();
	foreach($continentes as $continente){ ?>
		<option value="<?php echo $continente; ?>" ><?php echo $continente; ?></option>
	<?php } ?>
</select>

<input type="submit" name="enviar" value="Guardar" />
<input type="reset" name="reset" value="Limpiar" />

<?php echo form_close(); ?>