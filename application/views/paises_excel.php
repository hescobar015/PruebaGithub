<table>
	<tr>
		<th>Nombre</th>
		<th>Población</th>
		<th>Capital</th>
		<th>Continente</th>
	</tr>
<?php foreach($paises as $pais){ ?>
	<tr>
		<td><?php echo $pais['nombre']; ?></td>
		<td><?php echo $pais['poblacion']; ?></td>
		<td><?php echo $pais['capital']; ?></td>
		<td><?php echo $pais['continente']; ?></td>
	</tr>
<?php } ?>
</table>