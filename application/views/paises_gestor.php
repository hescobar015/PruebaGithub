<h1>Paises</h1>

<?php echo anchor('/paises/agregar', 'Agregar País'); ?> | 
<?php echo anchor('/paises/exportar_excel', 'Exportar a Excel', array('target' => '_blank')); ?> |
<?php echo anchor('/paises/exportar_pdf', 'Exportar a PDF', array('target' => '_blank')); ?>

<table>
	<tr>
		<th>Nombre</th>
		<th>Población</th>
		<th>Capital</th>
		<th>Continente</th>
		<th></th>
	</tr>
<?php foreach($paises as $pais){ ?>
	<tr>
		<td><?php echo $pais['nombre']; ?></td>
		<td><?php echo $pais['poblacion']; ?></td>
		<td><?php echo $pais['capital']; ?></td>
		<td><?php echo $pais['continente']; ?></td>
		<td>
			<?php echo anchor('/paises/editar/' . $pais['id_pais'] . '/' . $this->Seguridad_modelo->generar_sello($pais['id_pais']), 'Editar'); ?>
			<?php echo anchor('/paises/eliminar/' . $pais['id_pais'] . '/' . $this->Seguridad_modelo->generar_sello($pais['id_pais']), 'Eliminar'); ?>
		</td>
	</tr>
<?php } ?>
</table>

<iframe src="https://maps.google.com.mx/?ll=19.041289,-98.193003&spn=0.249569,0.445976&t=m&z=12&amp;output=embed" width="300" height="300" ></iframe>
