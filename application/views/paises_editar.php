<h1>Editar País</h1>

<?php echo form_open('/paises/editar_registro', null, array('id_pais' => $pais['id_pais'])); ?>

<label>Nombre</label>
<input type="text" name="nombre" id="nombre" value="<?php echo $pais['nombre']; ?>" />

<label>Población</label>
<input type="text" name="poblacion" id="poblacion" value="<?php echo $pais['poblacion']; ?>" />

<label>Capital</label>
<input type="text" name="capital" id="capital" value="<?php echo $pais['capital']; ?>" />

<label>Continente</label>
<select name="continente" id="continente">
	<?php 
	$continentes = obtener_continentes();
	foreach($continentes as $continente){ ?>
		<option value="<?php echo $continente; ?>" <?php echo ($pais['continente'] == $continente) ? 'selected="selected"': null; ?>><?php echo $continente; ?></option>
	<?php } ?>
</select>

<input type="submit" name="enviar" value="Guardar" />
<input type="reset" name="reset" value="Limpiar" />

<?php echo form_close(); ?>