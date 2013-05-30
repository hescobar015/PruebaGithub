<h1>Contactos</h1>

<?php echo anchor('/contactos/agregar', 'Agregar Contacto'); ?>

<table>
	<tr>
		<th>Nombre</th>
		<th>Población</th>
		<th>Capital</th>
		<th>Continente</th>
		<th></th>
	</tr>
<?php foreach($contactos as $pais){ ?>
	<tr>
		<td><?php echo $pais['nombre']; ?></td>
		<td><?php echo $pais['poblacion']; ?></td>
		<td><?php echo $pais['capital']; ?></td>
		<td><?php echo $pais['continente']; ?></td>
		<td>
			<?php echo anchor('/paises/editar/' . $pais['id_pais'], 'Editar'); ?>
			<?php echo anchor('/paises/eliminar/' . $pais['id_pais'], 'Eliminar'); ?>
		</td>
	</tr>
<?php } ?>
</table>