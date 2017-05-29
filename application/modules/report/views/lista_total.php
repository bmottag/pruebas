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
							<br>Número todal de Citados:<strong><?php echo $conteoCitados['citados']; ?> </strong>
							<br>Número todal de Ausentes:<strong><?php echo $conteoCitados['ausentes']; ?> </strong>
					</div>
				
				<div class="row">
					<div class="col-lg-4">
					<div class="alert alert-danger">
						<strong>Alerta Informativa</strong><br>
						<?php echo $rol_busqueda; ?> que Aceptarón: <?php echo $contadorInformativaSi; ?>	
						<br><?php echo $rol_busqueda; ?> que No contestaron: <?php echo $contadorInformativaNo;?>						
						
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
						<?php echo $rol_busqueda; ?> que contestaron: <?php echo $contadorNotificacionContestaron;?>
						<br><?php echo $rol_busqueda; ?> que No contestaron: <?php echo $contadorNotificacionNoContestaron;?>
						<br><?php echo $rol_busqueda; ?> que Aceptarón: <?php echo $contadorNotificacionSi;?>
						<?php $contadorNotificacionNo = $contadorNotificacionContestaron - $contadorNotificacionSi;?>
						<br><?php echo $rol_busqueda; ?> que No Aceptarón: <?php echo $contadorNotificacionNo;?>
						
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
						<?php echo $rol_busqueda; ?> que contestaron: <?php echo $contadorConsolidacionSi;?>
						<br><?php echo $rol_busqueda; ?> que NO contestaron: <?php echo $contadorConsolidacionNo;?>

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
									echo "<strong>Sitio: </strong>";
echo "<a href='" . base_url('report/mostrarSesiones/' . $lista['id_sitio']) . "'>" . $lista['nombre_sitio'] . "</a>";
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
									echo "<p class='" . $lista['clase'] . "'><strong>Tipo Alerta: </strong>" . $lista['nombre_tipo_alerta'] . "</p>";
									echo "<strong>Inicio Alerta: </strong>" . $lista['fecha_inicio'];
									echo "<br><strong>Fin Alerta: </strong>" . $lista['fecha_fin'];
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

									
									
									if(!$respuestas){ 
										echo "<p class='text-danger text-left'>Alerta sin respuesta.</p>";
										
										//si el usuario logeado es el mismo coordinador de la del sition
										//entonces puede dar respuesta a la alerta
										$userID = $this->session->userdata("id");
										
										if($lista['fk_id_user_coordinador'] == $userID){
											
echo "<a href=" . base_url("report/responder_alerta/" . $lista['id_alerta'] . "/" . $lista['fk_id_user_delegado'] . "/" . $lista['id_sitio_sesion']) . " ><strong>Dar Respuesta</strong> </a>";
											
											
										}
										
									}else{
										echo "<strong>Respuesta: </strong>";
										echo $acepta = $respuestas[0]['acepta']==1?"Si":"No";
										echo "<br><strong>Ausentes: </strong>" . $respuestas[0]['ausentes'];
										echo "<br><strong>Observación: </strong>" . $respuestas[0]['observacion'];
										echo "<br><strong>Fecha registro: </strong>" . $respuestas[0]['fecha_registro'];
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