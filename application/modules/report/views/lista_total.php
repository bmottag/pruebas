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
					<a class="btn btn-success" href=" <?php echo base_url(). $regreso; ?> "><span class="glyphicon glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Regresar </a> 
                    <i class="fa fa-life-saver fa-fw"></i> Información Alertas <?php echo $rol_busqueda; ?>
				</div>
				<div class="panel-body">
				
					<div class="alert alert-info">
						<?php 
						echo "<strong>Prueba / Grupo de Instrumentos / Fecha / Sesión : </strong><br>";
						echo $infoSesiones[0]['nombre_prueba'] . " / " . $infoSesiones[0]["nombre_grupo_instrumentos"] . " / " . $infoSesiones[0]["fecha"] . " / " . $infoSesiones[0]["sesion_prueba"];
						
						if(isset($infoAlerta)){
							echo "<br><strong>Alerta: </strong><br>" . $infoAlerta[0]['descripcion_alerta'] . " ----> Inicio: " . $infoAlerta[0]['fecha_inicio'];
						}
						
						if(isset($infoRegion)){
							echo "<br><strong>Región: </strong>" . $infoRegion[0]['nombre_region'];
						}
						
						if(isset($infoDepto)){
							echo "<br><strong>Departamento: </strong>" . $infoDepto[0]['dpto_divipola_nombre'];
						}
						
						if(isset($infoMcpio)){
							echo "<br><strong>Mnunicipio: </strong>" . $infoMcpio[0]['mpio_divipola_nombre'];
						}
						
						
						?>
					</div>
					
					<div class="alert alert-info">
							Hay <strong><?php echo $conteoSitios; ?> SITIOS</strong> donde se realiza esta prueba
					</div>
				
				<div class="row">
					<div class="col-lg-4">
					<div class="alert alert-danger">
						<strong>Alerta Informativa</strong><br>
						<?php
							$total = $contadorInformativaSi + $contadorInformativaNo;
							if($total != 0){
								$porcentajeSi = round((($contadorInformativaSi * 100)/$total), 1);
								$porcentajeNo = round((($contadorInformativaNo * 100)/$total), 1);
							}else{
								$porcentajeSi = 0;
								$porcentajeNo = 0;
							}
						?>
						<?php echo $rol_busqueda; ?> que aceptaron: <strong><?php echo $contadorInformativaSi . " (" . $porcentajeSi . "%)"; ?> </strong>
						<br><?php echo $rol_busqueda; ?> que no contestaron: <strong><?php echo $contadorInformativaNo . " (" . $porcentajeNo . "%)"; ?> </strong>
						
<form  name="form" id="form_Informativa" role="form" method="post" class="form-horizontal" >

	<input type="hidden" id="sesion" name="sesion" value="<?php echo $infoSesiones[0]['id_sesion']; ?>"/>
	
	<?php if(isset($infoAlerta)){ ?>
	<input type="hidden" id="alerta" name="alerta" value="<?php echo $infoAlerta[0]['id_alerta']; ?>"/>
	<?php } ?>
	
	<?php if(isset($infoRegion)){ ?>
	<input type="hidden" id="region" name="region" value="<?php echo $infoRegion[0]['id_region']; ?>"/>
	<?php } ?>
	
	<?php if(isset($infoDepto)){ ?>
	<input type="hidden" id="depto" name="depto" value="<?php echo $infoDepto[0]['dpto_divipola']; ?>"/>
	<?php } ?>
	
	<?php if(isset($infoMcpio)){ ?>
	<input type="hidden" id="mcpio" name="mcpio" value="<?php echo $infoMcpio[0]['mpio_divipola']; ?>"/>
	<?php } ?>
	
	<input type="hidden" id="tipoAlerta" name="tipoAlerta" value=1/>

<br>
	<div class="form-group">
		<div class="row" align="center">
			<div style="width80%;" align="center">
				
			 <button type="submit" class="btn btn-danger btn-xs" id='btnSubmit' name='btnSubmit'><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Ver </button>
				
			</div>
		</div>
	</div>
</form>				
					
					</div></div>
					
					<div class="col-lg-4">
					<div class="alert alert-danger">
						<strong>Alerta de Notificación</strong><br>
						<?php
							$contadorNotificacionNo = $contadorNotificacionContestaron - $contadorNotificacionSi;
							$total = $contadorNotificacionNoContestaron + $contadorNotificacionSi + $contadorNotificacionNo;
							
							if($total != 0){
								$porcentajeNoContestaron = round((($contadorNotificacionNoContestaron * 100)/$total),1);
								$porcentajeSi = round((($contadorNotificacionSi * 100)/$total),1);
								$porcentajeNo = round((($contadorNotificacionNo * 100)/$total),1);
							}else{
								$porcentajeNoContestaron = 0;
								$porcentajeSi = 0;
								$porcentajeNo = 0;
							}
						?>
						<?php echo $rol_busqueda; ?> que no contestaron: <strong><?php echo $contadorNotificacionNoContestaron . " (" . $porcentajeNoContestaron . "%)"; ?> </strong>
						<br><?php echo $rol_busqueda; ?> que aceptaron: <strong><?php echo $contadorNotificacionSi . " (" . $porcentajeSi . "%)"; ?> </strong>
						<br><?php echo $rol_busqueda; ?> que no aceptaron: <strong><?php echo $contadorNotificacionNo . " (" . $porcentajeNo . "%)"; ?> </strong>
						
<form  name="form" id="form_Notificacion" role="form" method="post" class="form-horizontal" >

	<input type="hidden" id="sesion" name="sesion" value="<?php echo $infoSesiones[0]['id_sesion']; ?>"/>
	
	<?php if(isset($infoAlerta)){ ?>
	<input type="hidden" id="alerta" name="alerta" value="<?php echo $infoAlerta[0]['id_alerta']; ?>"/>
	<?php } ?>
	
	<?php if(isset($infoRegion)){ ?>
	<input type="hidden" id="region" name="region" value="<?php echo $infoRegion[0]['id_region']; ?>"/>
	<?php } ?>
	
	<?php if(isset($infoDepto)){ ?>
	<input type="hidden" id="depto" name="depto" value="<?php echo $infoDepto[0]['dpto_divipola']; ?>"/>
	<?php } ?>
	
	<?php if(isset($infoMcpio)){ ?>
	<input type="hidden" id="mcpio" name="mcpio" value="<?php echo $infoMcpio[0]['mpio_divipola']; ?>"/>
	<?php } ?>
	
	<input type="hidden" id="tipoAlerta" name="tipoAlerta" value=2/>

<br>
	<div class="form-group">
		<div class="row" align="center">
			<div style="width80%;" align="center">
				
			 <button type="submit" class="btn btn-danger btn-xs" id='btnSubmit' name='btnSubmit'><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Ver </button>
				
			</div>
		</div>
	</div>
</form>
					
					</div></div>
					
					<div class="col-lg-4">
					<div class="alert alert-danger">
						<strong>Alerta de Consolidación</strong><br>
						<?php 
							$total = $contadorConsolidacionSi + $contadorConsolidacionNo; 
							if($total != 0){
								$porcentajeSi = round((($contadorConsolidacionSi * 100)/$total),1);
								$porcentajeNo = round((($contadorConsolidacionNo * 100)/$total),1);
							}else{
								$porcentajeSi = 0;
								$porcentajeNo = 0;
							}
						?>
						Total Sitios: <strong><?php echo $conteoSitios; ?> </strong><br>
						<?php echo $rol_busqueda; ?> que contestaron: <strong><?php echo $contadorConsolidacionSi . " (" . $porcentajeSi . "%)"; ?> </strong>
						<br><?php echo $rol_busqueda; ?> que no contestaron: <strong><?php echo $contadorConsolidacionNo . " (" . $porcentajeNo . "%)"; ?> </strong>
						<?php 
							if($conteoCitados['citados'] !=0){
								$presentes =  $conteoCitados['citados'] - $conteoCitados['ausentes'];
								$porcentajePresentes = round(($presentes * 100)/$conteoCitados['citados'],1);
								$porcentajeAusentes = round(($conteoCitados['ausentes'] * 100)/$conteoCitados['citados'],1);
							}else{
								$presentes =  0;
								$porcentajePresentes = 0; 
								$porcentajeAusentes = 0;
							}
						
						?>
						
						<br>Número total de citados: <strong><?php echo $conteoCitados['citados']; ?> </strong>
						<br>Número total de presentes: <strong><?php echo $presentes . " (" . $porcentajePresentes . "%)"; ?> </strong>
						<br>Número total de ausentes: <strong><?php echo $conteoCitados['ausentes'] . " (" . $porcentajeAusentes . "%)"; ?> </strong>
							

<form  name="form" id="form_Consolidacion" role="form" method="post" class="form-horizontal" >

	<input type="hidden" id="sesion" name="sesion" value="<?php echo $infoSesiones[0]['id_sesion']; ?>"/>
	
	<?php if(isset($infoAlerta)){ ?>
	<input type="hidden" id="alerta" name="alerta" value="<?php echo $infoAlerta[0]['id_alerta']; ?>"/>
	<?php } ?>
	
	<?php if(isset($infoRegion)){ ?>
	<input type="hidden" id="region" name="region" value="<?php echo $infoRegion[0]['id_region']; ?>"/>
	<?php } ?>
	
	<?php if(isset($infoDepto)){ ?>
	<input type="hidden" id="depto" name="depto" value="<?php echo $infoDepto[0]['dpto_divipola']; ?>"/>
	<?php } ?>
	
	<?php if(isset($infoMcpio)){ ?>
	<input type="hidden" id="mcpio" name="mcpio" value="<?php echo $infoMcpio[0]['mpio_divipola']; ?>"/>
	<?php } ?>
	
	<input type="hidden" id="tipoAlerta" name="tipoAlerta" value=3/>

<br>
	<div class="form-group">
		<div class="row" align="center">
			<div style="width80%;" align="center">
				
			 <button type="submit" class="btn btn-danger btn-xs" id='btnSubmit' name='btnSubmit'><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Ver </button>
				
			</div>
		</div>
	</div>
</form>
						
					</div></div>
				</div>
					<?php
						if(isset($info) && !$info){
					?>
						<div class="alert alert-danger">
							No hay Información
						</div>
					<?php
						}elseif(isset($info)){
					?>	
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
						<thead>
							<tr>
								<th class="text-center">Sitio</th>
								<th class="text-center">Alerta</th>
								<th class="text-center">Sesión</th>
								<th class="text-center">Respuesta</th>
							</tr>
						</thead>
						<tbody>							
						<?php
							foreach ($info as $lista):
									echo "<tr>";
									echo "<td>";
									echo "<strong>Sitio: </strong>";
echo "<a href='" . base_url('report/mostrarSesiones/' . $lista['id_sitio']) . "'>" . $lista['nombre_sitio'] . "</a>";
									echo "<br><strong>Nodo o Región: </strong>" . $lista['nombre_region'];
									echo "<br><strong>Departamento: </strong>" . $lista['dpto_divipola_nombre'];
									echo "<br><strong>Municipio: </strong>" . $lista['mpio_divipola_nombre'];
									echo "<br><strong>Zona: </strong>" . $lista['nombre_zona'];
									echo "<br><strong>Representante: </strong>";
									echo "C.C. " . $lista['cedula_delegado'] . " " . $lista['nom_delegado'] . " "  . $lista['ape_delegado'];
									echo "<br><strong>Celular representante: </strong>";
									echo "<a href='tel:".$lista['celular_delegado']."'>".$lista['celular_delegado']."</a>"; 									
									echo "</td>";


									echo "<td>";
									echo "<strong>Descripción: </strong>" . $lista['descripcion_alerta'];
									echo "<br><strong>Mensaje: </strong>" . $lista['mensaje_alerta'];
									echo "<p class='" . $lista['clase'] . "'><strong>Tipo Alerta: </strong>" . $lista['nombre_tipo_alerta'] . "</p>";
									echo "<strong>Inicio Alerta: </strong>" . $lista['fecha_inicio'];
									echo "<br><strong>Fin Alerta: </strong>" . $lista['fecha_fin'];
									echo "<br><strong>Rol Alerta: </strong>" . $lista['nombre_rol'];
									echo "</td>";
									
									
									
									echo "<td>";
									echo "<strong>Prueba: </strong>" . $lista['nombre_prueba'];
									echo "<br><strong>Grupo de Instrumentos: </strong>" . $lista['nombre_grupo_instrumentos'];
									echo "<br><strong>Sesión: </strong>" . $lista['sesion_prueba'];
									echo "<br><strong>Fecha: </strong>" . $lista['fecha'];
									echo "<br><strong>Hora Inicial: </strong>" . $lista['hora_inicio_prueba'];
									echo "<br><strong>Hora Final: </strong>" . $lista['hora_fin_prueba'];
									echo "</td>";
									
									
									echo "<td>";
									
									//buscar informacion de la respuesta si existe
$ci = &get_instance();
$ci->load->model("general_model");

$arrParam = array(
		"idSitioSesion" => $lista['id_sitio_sesion'],
		"idAlerta" => $lista['id_alerta']
);
$respuestas = $this->general_model->get_respuestas_alertas_vencidas_by($arrParam);


									//si el usuario logeado es el mismo coordinador de la del sition
									//entonces puede dar respuesta a la alerta
									$userRol = $this->session->userdata("rol");
									$userID = $this->session->userdata("id");
									
									switch ($userRol) {
										case 1:
											$rol = 'admin';
											break;
										case 2:
											$rol = 'directivo';
											break;
										case 3:
											$rol = 'coordinador';
											break;
										case 6:
											$rol = 'operador';
											break;
									}

									
									
									if(!$respuestas){ 
										echo "<p class='text-danger text-left'>Alerta sin respuesta.</p>";
										


											//si no existe el representante entonces no se muestra el enlace
											if($lista['fk_id_user_delegado']){
echo "<a href=" . base_url("report/responder_alerta/" . $lista['id_alerta'] . "/" . $lista['fk_id_user_delegado'] . "/" . $lista['id_sitio_sesion'] . "/" . $rol) . " ><strong>Dar Respuesta</strong> </a>";
											}else{
												echo "<p class='text-danger'>Falta asignar representante para este Sitio</p>";
											}
																		

										
									}else{
										echo "<strong>Respuesta: </strong>";
										echo $acepta = $respuestas[0]['acepta']==1?"Si":"No";
										echo "<br><strong>Ausentes: </strong>" . $respuestas[0]['ausentes'];
										echo "<br><strong>Observación: </strong>" . $respuestas[0]['observacion'];
										echo "<br><strong>Fecha registro: </strong>" . $respuestas[0]['fecha_registro'];
										
										
										
//si no se acepta la alerta enotnces se crea enlace para poder aceptarla por parte del coordiandor, director o operador
if($respuestas[0]['acepta']==2){
		if(($userRol == 6 && $lista['fk_id_user_operador'] == $userID) || ($userRol == 3 && $lista['fk_id_user_coordinador'] == $userID) || $userRol == 2 || $userRol == 1){						
echo "<br><a href=" . base_url("report/update_alerta_notificacion/" . $respuestas[0]['id_registro'] . "/" . $rol) . " ><strong>Cambiar Respuesta</strong> </a>";
		}
}
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
		"pageLength": 100
	});
});
</script>