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
	
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<a class="btn btn-success" href=" <?php echo base_url(). $botonRegreso; ?> "><span class="glyphicon glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Regresar </a> 
                    <i class="fa fa-life-saver fa-fw"></i> Lista de Sesiones filtrado por Sitio
				</div>
				<div class="panel-body">
					<div class="alert alert-info">




										<strong>NOMBRE SITIO: </strong>
										<?php echo $infoSitio[0]['nombre_sitio']; ?>
										<br><strong>DIRECCIÓN: </strong>
										<?php echo $infoSitio[0]['direccion_sitio']; ?>
										<br><strong>REGIÓN: </strong>
										<?php echo $infoSitio[0]['nombre_region']; ?>
										<br><strong>DEPARTAMENTO: </strong>
										<?php echo $infoSitio[0]['dpto_divipola_nombre']; ?>
										<br><strong>MUNICIPIO: </strong>
										<?php echo $infoSitio[0]['mpio_divipola_nombre']; ?>
										
<?php if($infoSitio[0]['fk_id_user_delegado']){  ?>
										<br><strong>DELEGADO C.C.: </strong>
										<?php echo $infoSitio[0]['delegado']; ?>
<?php } ?>
										
<?php if($infoSitio[0]['fk_id_user_delegado']){  ?>
										<br><strong>COORDINADOR C.C.: </strong>
										<?php echo $infoSitio[0]['coordinador']; ?>
<?php } ?>
										












						
					</div>
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