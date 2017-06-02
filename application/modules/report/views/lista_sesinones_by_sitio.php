<div id="page-wrapper">
	<br>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4 class="list-group-item-heading">
					<i class="fa fa-bar-chart-o fa-fw"></i> REPORTE
					</h4>
				</div>
			</div>
		</div>
		<!-- /.col-lg-12 -->				
	</div>
	
	<div class="row">
		<div class="col-md-4">
			<div class="panel panel-success">
				<div class="panel-heading">
					<strong>Nombre Sitio: </strong><?php echo $infoSitio[0]['nombre_sitio']; ?>
					<br><strong>Dirección: </strong><?php echo $infoSitio[0]['direccion_sitio']; ?>
				</div>
			</div>
		</div>
		
		<div class="col-md-4">
			<div class="panel panel-success">
				<div class="panel-heading">
					<strong>Nodo o Región: </strong><?php echo $infoSitio[0]['nombre_region']; ?>
					<br><strong>Departamento: </strong><?php echo $infoSitio[0]['dpto_divipola_nombre']; ?>
					<br><strong>Municipio: </strong><?php echo $infoSitio[0]['mpio_divipola_nombre']; ?>
					<br><strong>Zona: </strong><?php echo $infoSitio[0]['nombre_zona']; ?>
				</div>
			</div>
		</div>
		
		<div class="col-md-4">
			<div class="panel panel-success">
				<div class="panel-heading">
					<strong>Representante: </strong><br>
					<?php 
					if($infoSitio[0]['fk_id_user_delegado']){
						echo "C.C. " . $infoSitio[0]['cedula_delegado'] . " " . $infoSitio[0]['nom_delegado'] . " "  . $infoSitio[0]['ape_delegado'];
					} else { echo "Falta asignar Representante.";}
					?>

					<br><strong>Coordinador: </strong><br>
					<?php 
					if($infoSitio[0]['fk_id_user_coordinador']){
						echo "C.C. " . $infoSitio[0]['cedula_coordinador'] . " " . $infoSitio[0]['nom_coordinador'] . " "  . $infoSitio[0]['ape_coordiandor'];
					} else { echo "Falta asignar Coordinador.";}
					?>
				</div>
			</div>
		</div>
	</div>
	
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-info">
				<div class="panel-heading">
					<a class="btn btn-success" href=" <?php echo base_url(). $botonRegreso; ?> "><span class="glyphicon glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Regresar </a> 
                    <i class="fa fa-life-saver fa-fw"></i> Lista de Sesiones asociadas con el Sitio 
				</div>
				<div class="panel-body">

					<?php
						if(!$info){
					?>
						<div class="alert alert-danger">
							No hay Sesiones para este Sitio. 
						</div>
					<?php
						}else{
					?>	
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
						<thead>
							<tr>
								<th class="text-center">Sesión</th>
								<th class="text-center">Hora Inicio</th>
								<th class="text-center">Hora Fin</th>
								<th class="text-center">Número de citados</th>
								<th class="text-center">Número de ausentes</th>
								<th class="text-center">Número de presentes</th>
							</tr>
						</thead>
						<tbody>							
						<?php
							foreach ($info as $lista):
									echo "<tr>";
									echo "<td>" . $lista['sesion_prueba'] . "</td>";
									echo "<td>" . $lista['hora_inicio_prueba'] . "</td>";
									echo "<td>" . $lista['hora_fin_prueba'] . "</td>";
									echo "<td>" . $lista['numero_citados'] . "</td>";
									echo "<td>" . $lista['numero_ausentes'] . "</td>";
									echo "<td>" . $lista['numero_presentes_efectivos'] . "</td>";
							endforeach;
						?>
						</tbody>
					</table>
				<?php } ?>
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	
	
	
	
	
<!--INICIO RESPUESTA DEL USUARIO PARA EL SITIO EN EL QUE ESTA ASIGNADO -->
<?php
	if($infoRespuestas){ 
?>	
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-success">
				
				<div class="panel-heading">
					<i class="fa fa-life-saver fa-fw"></i> Notificaciones
				</div>
				
				<div class="panel-body">
				
<a class="btn btn-default btn-circle" href="#anclaUp"><i class="fa fa-arrow-up"></i> </a>
				
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataSafety">
						<thead>
							<tr>
								<th>Alerta</th>
								<th>Respuesta</th>
							</tr>
						</thead>
						<tbody>							
						<?php
							foreach ($infoRespuestas as $lista):
								echo "<tr>";
									echo "<td>";
									echo "<strong>Descripción: </strong>" . $lista['descripcion_alerta'];
									echo "<br><strong>Mensaje: </strong>" . $lista['mensaje_alerta'];
									echo "<p class='" . $lista['clase'] . "'><strong>Tipo Alerta: </strong>" . $lista['nombre_tipo_alerta'] . "</p>";
									echo "<strong>Inicio Alerta: </strong>" . $lista['fecha_inicio'];
									echo "<br><strong>Fin Alerta: </strong>" . $lista['fecha_fin'];
									echo "</td>";
									
									echo "<td>";
									echo "<strong>Respuesta: </strong>";
									echo $acepta = $lista['acepta']==1?"Si":"No";
									echo "<br><strong>Ausentes: </strong>" . $lista['ausentes'];
									echo "<br><strong>Observación: </strong>" . $lista['observacion'];
									echo "<br><strong>Fecha registro: </strong>" . $lista['fecha_registro'];									
									echo "</td>";
								echo "</tr>";
							endforeach;
						?>
						</tbody>
					</table>
			
				</div>
			</div>
		</div>
	</div>
<?php	} ?>
<!-- FIN RESPUESTA DEL USUARIO PARA EL SITIO EN EL QUE ESTA ASIGNADO -->
	
	
	
	
	
	
</div>
<!-- /#page-wrapper -->

<!-- Tables -->
<script>
$(document).ready(function() {
	$('#dataTables').DataTable({
		responsive: true,
		"order": false,
		"pageLength": 25
	});
});
</script>