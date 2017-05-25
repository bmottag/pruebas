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
					<a class="btn btn-success" href=" <?php echo base_url(). "report/searchBy"; ?> "><span class="glyphicon glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Regresar </a> 
                    <i class="fa fa-life-saver fa-fw"></i> Lista
				</div>
				<div class="panel-body">
				<div class="row">
					<div class="col-lg-4">
					<div class="alert alert-info">
						<strong>Alerta Informativa</strong><br>
						Delegados que contestaron: <?php echo $contadorInformativaSi;?>
						<br>Delegados que No contestaron: <?php echo $contadorInformativaNo;?>
					
					</div></div>
					
					<div class="col-lg-4">
					<div class="alert alert-info">
						<strong>Alerta de Notificación</strong><br>
						Delegados que contestaron: <?php echo $contadorNotificacionSi;?>
						<br>Delegados que No contestaron: <?php echo $contadorNotificacionNo;?>
					
					</div></div>
					
					<div class="col-lg-4">
					<div class="alert alert-info">
						<strong>Alerta de Consolidación</strong><br>
						Delegados que contestaron: <?php echo $contadorConsolidacionSi;?>
						<br>Delegados que NO contestaron: <?php echo $contadorConsolidacionNo;?>
					
					</div></div>
				</div>
					<?php
						if(!$info){
					?>
						<div class="alert alert-danger">
							No hay Información
						</div>
					<?php
						}else{
					?>	
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
						<thead>
							<tr>
								<th class="text-center">Sitio</th>
								<th class="text-center">Sesión</th>
								<th class="text-center">Alerta</th>
								<th class="text-center">Respuesta</th>
							</tr>
						</thead>
						<tbody>							
						<?php
							foreach ($info as $lista):
									echo "<tr>";
									echo "<td>";
									echo "<strong>Sitio: </strong>" . $lista['nombre_sitio'];
									echo "<br><strong>Nodo o Región: </strong>" . $lista['nombre_region'];
									echo "<br><strong>Departamento: </strong>" . $lista['dpto_divipola_nombre'];
									echo "<br><strong>Municipio: </strong>" . $lista['mpio_divipola_nombre'];
									echo "<br><strong>Zona: </strong>" . $lista['nombre_zona'];
									echo "</td>";
									
									
									echo "<td>";
									echo "<strong>Prueba: </strong>" . $lista['nombre_prueba'];
									echo "<br><strong>Grupo de Instrumentos: </strong>" . $lista['nombre_grupo_instrumentos'];
									echo "<br><strong>Sesión: </strong>" . $lista['sesion_prueba'];
									echo "<br><strong>Fecha: </strong>" . $lista['mpio_divipola_nombre'];
									echo "<br><strong>Hora Inicial: </strong>" . $lista['hora_inicio_prueba'];
									echo "<br><strong>Hora Final: </strong>" . $lista['hora_fin_prueba'];
									echo "</td>";
									
									
									echo "<td>";
									echo "<strong>Descripción: </strong>" . $lista['descripcion_alerta'];
									echo "<br><strong>Mensaje: </strong>" . $lista['mensaje_alerta'];
									echo "<br><strong>Tipo Alerta: </strong>" . $lista['nombre_tipo_alerta'];
									echo "<br><strong>Inicio Alerta: </strong>" . $lista['fecha_inicio'];
									echo "<br><strong>Fin Alerta: </strong>" . $lista['fecha_fin'];
									echo "</td>";
									
									
									echo "<td>";
									if(!$lista['id_registro']){ 
										echo "<p class='text-danger text-left'>Alerta sin respuesta.</p>";
										
										//si el usuario logeado es el mismo coordinador de la del sition
										//entonces puede dar respuesta a la alerta
										$userID = $this->session->userdata("id");
										
										if($lista['fk_id_user_coordinador'] == $userID){
											
echo "<a href=" . base_url("report/responder_alerta/" . $lista['id_alerta'] . "/" . $lista['fk_id_user_delegado'] . "/" . $lista['id_sitio_sesion']) . " ><strong>Dar Respuesta</strong> </a>";
											
											
										}
										
									}else{
										echo "<strong>Respuesta: </strong>";
										echo $acepta = $lista['acepta']==1?"Si":"No";
										echo "<br><strong>Ausente: </strong>" . $lista['ausentes'];
										echo "<br><strong>Observación: </strong>" . $lista['observacion'];
										echo "<br><strong>Fecha registro: </strong>" . $lista['fecha_registro'];
									}
									echo "</td>";
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
		order: false,
		"pageLength": 25
	});
});
</script>