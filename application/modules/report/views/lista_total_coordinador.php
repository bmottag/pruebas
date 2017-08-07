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
	
<!--INFO DE LAS SESIONES -->
	<div class="row">
			
		<div class="col-lg-12">
			<div class="panel panel-primary">
			
				<div class="panel-heading">
					<i class="fa fa-arrow-right fa-fw"></i> <strong>SESIÓN: </strong><?php echo $infoSesiones[0]['nombre_prueba'] . " / " . $infoSesiones[0]["nombre_grupo_instrumentos"] . " / " . $infoSesiones[0]["fecha"] . " / " . $infoSesiones[0]["sesion_prueba"]; ?>
<span class="pull-right text-muted">
<a class="btn btn-info" href=" <?php echo base_url(). $regreso; ?> "><span class="glyphicon glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Regresar </a> 
</span>
					<br><i class="fa fa-arrow-right fa-fw"></i><strong>Total sitios: </strong><?php echo $conteoSitios; ?>
					

					
				</div>
				
				<!-- /.panel-heading -->
				<div class="panel-body">
<?php
	//cargo modelos
	$ci = &get_instance();
	$ci->load->model("specific_model");
	$ci->load->model("general_model");

	//Buscar la alertas para esta sesion y el operador de sesion
	$arrParam = array();
	$alertasVencidas = $this->specific_model->get_alertas_vencidas_totales($arrParam);


	if($alertasVencidas)
	{
		foreach ($alertasVencidas as $lista):
		
			//consultar informacion de la alerta
			$arrParam = array(
				"idAlerta" => $lista["id_alerta"]
			);
			$infoAlerta = $this->specific_model->get_info_alerta($arrParam);
				
if($infoAlerta["fk_id_tipo_alerta"] == 1)//INFORMATIVA
{
//se buscan las alertas INFORMATIVAS que se tienen el OPERADOR a cargo
			$arrParam = array(
							"tipoAlerta" => 1,
							"idAlerta" => $lista["id_alerta"]
						);
			$infoAlertaVencidaInformativa = $this->general_model->get_alertas_vencidas_by($arrParam);

			//recorro las alertas y reviso se se les dio respuesta, si no se le dio respuesta las voy contando
			$contadorInformativaSi = 0;
			$contadorInformativaNo = 0;
			if($infoAlertaVencidaInformativa){
				foreach ($infoAlertaVencidaInformativa as $lista):
					$arrParam = array(
							"idSitioSesion" => $lista['id_sitio_sesion'],
							"idAlerta" => $lista['id_alerta']
					);
					$respuesta = $this->general_model->get_respuestas_alertas_vencidas_by($arrParam);
					
					if($respuesta){
						$contadorInformativaSi++;
					}else{
						$contadorInformativaNo++;
					}
				endforeach;
			}

			//calculo el total
			$total = $contadorInformativaSi + $contadorInformativaNo;
			if($total != 0){
				$porcentajeSi = round((($contadorInformativaSi * 100)/$total), 1);
				$porcentajeNo = round((($contadorInformativaNo * 100)/$total), 1);
			}else{
				$porcentajeSi = 0;
				$porcentajeNo = 0;
			}
				
?>			
			
		<div class="col-lg-6">				
			<div class="row">	
				<div class="col-lg-12">	
					<div class="alert alert-danger">
						<strong>Mensaje Alerta: </strong><?php echo $infoAlerta['mensaje_alerta']; ?><br>
						<strong>Tipo de Alerta: </strong>ALERTA INFORMATIVA<br><br>

						<p>
							<strong>Conteo de respuestas</strong>
							<span class="pull-right text-muted"></span>
						</p>
						
							<div class="progress">
<a href="<?php echo base_url("dashboard/alerta_especifica/" . $lista['id_alerta'] . "/" . $rol  . "/contestaron");?>" >
								<div class="progress-bar progress-bar-info" role="progressbar" style="width:50%">
								Contestaron <?php echo $contadorInformativaSi . " (" . $porcentajeSi . "%)"; ?>
								</div>
</a>
								
<a href="<?php echo base_url("dashboard/alerta_especifica/" . $lista['id_alerta'] . "/" . $rol  . "/no_contestaron");?>" >
								<div class="progress-bar progress-bar-danger" role="progressbar" style="width:50%">
								No contestaron <?php echo $contadorInformativaNo . " (" . $porcentajeNo . "%)"; ?>
								</div>
</a>
							</div> 
						</a>	
					</div>
				</div>
			</div>	
		</div>
<?php } 




if($infoAlerta["fk_id_tipo_alerta"] == 2)//NOTIFICACION
{
//se buscan las alertas NOTIFICACION vencidas que tienen el OPERADOR a cargo			
			$arrParam = array(
							"tipoAlerta" => 2,
							"idAlerta" => $lista["id_alerta"]
			);
			$infoAlertaVencidaNotificacion = $this->general_model->get_alertas_vencidas_by($arrParam);

			//recorro las alertas y reviso se se les dio respuesta, si no se le dio respuesta las voy contando
			$contadorNotificacion = 0;
			
			$contadorNotificacionContestaron = 0;
			$contadorNotificacionSi = 0;
			$contadorNotificacionNoContestaron = 0;
		
			
			if($infoAlertaVencidaNotificacion){
				foreach ($infoAlertaVencidaNotificacion as $lista):
					$arrParam = array(
							"idSitioSesion" => $lista['id_sitio_sesion'],
							"idAlerta" => $lista['id_alerta']
					);
					$respuesta = $this->general_model->get_respuestas_alertas_vencidas_by($arrParam);
					
					if(!$respuesta){
						$contadorNotificacion++;
					}
										
					$arrParam = array(
							"idSitioSesion" => $lista['id_sitio_sesion'],
							"idAlerta" => $lista['id_alerta'],
							"respuestaAcepta" => 1
					);//filtro por los que contestaron que SI
					$respuestaSI = $this->general_model->get_respuestas_alertas_vencidas_by($arrParam);
					
					if($respuestaSI){
						$contadorNotificacionSi++;
					}
					
					if($respuesta){
						$contadorNotificacionContestaron++;
					}else{
						$contadorNotificacionNoContestaron++;
					}

				endforeach;
			}

			//calculo el total
			$contadorNotificacionNo = $contadorNotificacionContestaron - $contadorNotificacionSi;
			$total = $contadorNotificacionNoContestaron + $contadorNotificacionSi + $contadorNotificacionNo;
			$totalNotificacion = $contadorNotificacionSi + $contadorNotificacionNo;
			
			if($total != 0){
				$porcentajeNoContestaron = round((($contadorNotificacionNoContestaron * 100)/$total),1);
				$porcentajeSiContestaron = round((($contadorNotificacionContestaron * 100)/$total),1);
				$porcentajeSi = round((($contadorNotificacionSi * 100)/$total),1);
				$porcentajeNo = round((($contadorNotificacionNo * 100)/$total),1);
			}else{
				$porcentajeNoContestaron = 0;
				$porcentajeSi = 0;
				$porcentajeNo = 0;
			}
						
				
?>			
			
			
		<div class="col-lg-6">				
			<div class="row">	
				<div class="col-lg-12">	
					<div class="alert alert-warning">
						<strong>Mensaje Alerta: </strong><?php echo $infoAlerta['mensaje_alerta']; ?><br>
						<strong>Tipo de Alerta: </strong>ALERTA DE NOTIFICACIÓN<br><br>
						
						<p>
							<strong>Conteo de respuestas</strong>
							<span class="pull-right text-muted"></span>
						</p>
						

							<div class="progress">
<a href="<?php echo base_url("dashboard/alerta_especifica/" . $lista['id_alerta'] . "/" . $rol  . "/contestaron");?>" >
								<div class="progress-bar progress-bar-info" role="progressbar" style="width:50%">
								Contestaron <?php echo $contadorNotificacionContestaron . " (" . $porcentajeSiContestaron . "%)"; ?>
								</div>
</a>
								
<a href="<?php echo base_url("dashboard/alerta_especifica/" . $lista['id_alerta'] . "/" . $rol  . "/no_contestaron");?>" >
								<div class="progress-bar progress-bar-warning" role="progressbar" style="width:50%">
								No contestaron <?php echo $contadorNotificacionNoContestaron . " (" . $porcentajeNoContestaron . "%)"; ?>
								</div>
</a>
							</div> 


						
							<div class="progress">
<a href="<?php echo base_url("dashboard/alerta_especifica/" . $lista['id_alerta'] . "/" . $rol  . "/si");?>" >
								<div class="progress-bar progress-bar-success" role="progressbar" style="width:50%">
								Si <?php echo $contadorNotificacionSi . " (" . $porcentajeSi . "%)"; ?>
								</div>
</a>
								
<a href="<?php echo base_url("dashboard/alerta_especifica/" . $lista['id_alerta'] . "/" . $rol  . "/no");?>" >
								<div class="progress-bar progress-bar-danger" role="progressbar" style="width:50%">
								No <?php echo $contadorNotificacionNo . " (" . $porcentajeNo . "%)"; ?>
								</div>
</a>
							</div> 
						</a>	
					</div>
				</div>
			</div>	
		</div>


<?php } 




if($infoAlerta["fk_id_tipo_alerta"] == 3)//CONSOLIDACION
{
//se buscan las alertas INFORMATIVAS que se tienen el OPERADOR a cargo
			$arrParam = array(
							"tipoAlerta" => 3,
							"idAlerta" => $lista["id_alerta"]
						);
			$infoAlertaVencidaConsolidacion = $this->general_model->get_alertas_vencidas_by($arrParam);
			
			//recorro las alertas y reviso se se les dio respuesta, si no se le dio respuesta las voy contando
			$contadorConsolidacionSi = 0;
			$contadorConsolidacionNo = 0;
			if($infoAlertaVencidaConsolidacion){
				foreach ($infoAlertaVencidaConsolidacion as $lista):
					$arrParam = array(
							"idSitioSesion" => $lista['id_sitio_sesion'],
							"idAlerta" => $lista['id_alerta']
					);
					$respuesta = $this->general_model->get_respuestas_alertas_vencidas_by($arrParam);
					
					if($respuesta){
						$contadorConsolidacionSi++;
					}else{
						$contadorConsolidacionNo++;
					}
					
				endforeach;
			}

			//calculo el total
			$totalConsolidado = $contadorConsolidacionSi + $contadorConsolidacionNo; 
			if($totalConsolidado != 0){
				$porcentajeSi = round((($contadorConsolidacionSi * 100)/$totalConsolidado),1);
				$porcentajeNo = round((($contadorConsolidacionNo * 100)/$totalConsolidado),1);
			}else{
				$porcentajeSi = 0;
				$porcentajeNo = 0;
			}
			
			//numero de citados, ausentes, presentes
			$idSesion = $lista['id_sesion'];
			$conteoCitadosSesion = $this->general_model->get_numero_citados_por_filtro_by_coordinnador($idSesion);

			if($conteoCitadosSesion['citados'] !=0){
				$presentes =  $conteoCitadosSesion['citados'] - $conteoCitadosSesion['ausentes'];
				$porcentajePresentes = round(($presentes * 100)/$conteoCitadosSesion['citados'],1); 
				$porcentajeAusentes = round(($conteoCitadosSesion['ausentes'] * 100)/$conteoCitadosSesion['citados'],1); 
			}else{
				$presentes =  0;
				$porcentajePresentes = 0; 
				$porcentajeAusentes = 0;
			}
?>			
		<div class="col-lg-6">				
			<div class="row">	
				<div class="col-lg-12">	
					<div class="alert alert-success ">
						<strong>Mensaje Alerta: </strong><?php echo $infoAlerta['mensaje_alerta']; ?><br>
						<strong>Tipo de Alerta: </strong>ALERTA DE CONSOLIDACIÓN<br><br>

						<p>
							<strong>Conteo de respuestas</strong>
							<span class="pull-right text-muted"></span>
						</p>
						
						
							<div class="progress">
							
<a href="<?php echo base_url("dashboard/alerta_especifica/" . $lista['id_alerta'] . "/" . $rol  . "/contestaron");?>" >
								<div class="progress-bar progress-bar-info" role="progressbar" style="width:50%">
								Contestaron <?php echo $contadorConsolidacionSi . " (" . $porcentajeSi . "%)"; ?>
								</div>
</a>

<a href="<?php echo base_url("dashboard/alerta_especifica/" . $lista['id_alerta'] . "/" . $rol  . "/no_contestaron");?>" >
								<div class="progress-bar progress-bar-warning" role="progressbar" style="width:50%">
								No contestaron <?php echo $contadorConsolidacionNo . " (" . $porcentajeNo . "%)"; ?>
								</div>
</a>
							</div> 
						</a>	
						
						<p>
							<strong>Número total de citados
							<span class="pull-right"><?php echo number_format($conteoCitadosSesion['citados']); ?></span></strong>
						</p>							
							<div class="progress">
								<div class="progress-bar progress-bar-success" role="progressbar" style="width:50%">
								Presentes <?php echo number_format($presentes) . " (" . $porcentajePresentes . "%)"; ?>
								</div>
								<div class="progress-bar progress-bar-danger" role="progressbar" style="width:50%">
								Ausentes <?php echo number_format($conteoCitadosSesion['ausentes']) . " (" . $porcentajeAusentes . "%)"; ?> 
								</div>
							</div> 
							
					</div>
				</div>
			</div>	
		</div>
<?php } ?>



	
		

			
<?php
		endforeach;
	}
?>	

	
 
				
				
				
					
				</div>
				<!-- /.panel-body -->
			</div>
		</div>

	</div>
<!--INFO DE LAS SESIONES -->






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