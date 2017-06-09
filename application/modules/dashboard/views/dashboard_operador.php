<a name="anclaUp"></a>

<script type="text/javascript">
	function reloadPage() {
		location.reload(true)
	}

	setInterval('reloadPage()','30000');//30 segundos
</script>

<?php
	$userRol = $this->session->rol;
?>

<div id="page-wrapper">
	<div class="row"><br>
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4 class="list-group-item-heading">
						DASHBOARD
					</h4>
				</div>
			</div>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	
<?php
$retornoExito = $this->session->flashdata('retornoExito');
if ($retornoExito) {
    ?>
	<div class="row">
		<div class="col-lg-12">	
			<div class="alert alert-success ">
				<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
				<strong><?php echo $this->session->userdata("firstname"); ?></strong> <?php echo $retornoExito ?>		
			</div>
		</div>
	</div>
    <?php
}

$retornoError = $this->session->flashdata('retornoError');
if ($retornoError) {
    ?>
	<div class="row">
		<div class="col-lg-12">	
			<div class="alert alert-danger ">
				<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
				<?php echo $retornoError ?>
			</div>
		</div>
	</div>
    <?php
}
?> 


<!-- INFORMACION DEL SITIO PARA EL DELEGADO SI EXISTE INFORMAION -->
<?php 
//si no esta asignado para un sitio le muestro mensaje
if(!$infoMunicipiosOperador){ 
?>
	<div class="alert alert-info">
		Por favor contactarse con el Encargado, usted no tiene nada asignado.
	</div>
<?php
}else{
	

?>

	<div class="alert alert-info">
		Usted esta asignado como <strong>OPERADOR</strong> para los siguientes MUNICIPIOS:
	</div>

	<div class="row">
	<?php
		foreach($infoMunicipiosOperador as $lista):
	?>
	<div class="col-md-4">
		<div class="alert alert-info">
				<strong>Departamento: </strong><?php echo $lista['dpto_divipola_nombre']; ?>
				</br><strong> Municipio: </strong><?php echo $lista['mpio_divipola_nombre']; ?>		
		</div>
	</div>

	<?php
		endforeach;
	?>
	</div>

<?php } ?>
<!-- INFORMACION DEL SITIO PARA EL DELEGADO SI EXISTE INFORMAION -->











		

	<div class="row">
<!--INICIO ALERTA INFORMATIVA -->
<?php 
if($infoAlertaInformativa)
{
	foreach ($infoAlertaInformativa as $lista):
	
	//consultar si ya el usuario dio respuesta a esta alerta
	$ci = &get_instance();
	$ci->load->model("dashboard_model");
	
	$arrParam = array("idAlerta" => $lista["id_alerta"]);
	$existeRegistro = $this->dashboard_model->get_registro_by($arrParam);
	
	if(!$existeRegistro){
?>	
		<div class="col-lg-6">				
			<div class="panel panel-danger">
				<div class="panel-heading">
					<i class="fa fa-calendar fa-fw"></i> ALERTA - <?php echo $infoAlertaInformativa[0]['nombre_tipo_alerta']; ?>
				</div>
				<div class="panel-body">
						
					<div class="col-lg-12">	
						<div class="alert alert-danger ">
							<strong>Descripción Alerta: </strong><?php echo $lista['descripcion_alerta']; ?><br>
							<strong>Mensaje Alerta: </strong><?php echo $lista['mensaje_alerta']; ?><br>
							<strong>Nombre de Prueba: </strong><?php echo $lista['nombre_prueba']; ?><br>
							<strong>Grupo Instrumentos: </strong><?php echo $lista['nombre_grupo_instrumentos']; ?><br>
							<strong>Fecha: </strong><?php echo $lista['fecha']; ?><br>
							<strong>Sesión Prueba: </strong><?php echo $lista['sesion_prueba']; ?><br>
							<strong>Número de Citados: </strong><?php echo $lista['numero_citados']; ?><br>
							
					<br>
					<form  name="form" id="<?php echo "form_" . $lista["id_alerta"]; ?>" class="form-horizontal" method="post" action="<?php echo base_url("dashboard/registro_informativo"); ?>" >
						<input type="hidden" id="hddId" name="hddId" value="<?php echo $lista["id_alerta"]; ?>"/>
						<input type="hidden" id="hddIdSitioSesion" name="hddIdSitioSesion" value="<?php echo $lista["id_sitio_sesion"]; ?>"/>
					
						<div class="form-group">
							<div class="row" align="center">
								<div style="width:50%;" align="center">
									<input type="submit" id="btnSubmit" name="btnSubmit" value="Aceptar" class="btn btn-danger"/>
								</div>
							</div>
						</div>
					</form>	
							
						</div>
					</div>

				</div>
			</div>
		</div>
<?php
	}
	endforeach;			
} ?>
<!--FIN ALERTA -->


<!--INICIO ALERTA NOTIFICACION -->
<?php 
if($infoAlertaNotificacion)
{
	foreach ($infoAlertaNotificacion as $lista):
	
	//consultar si ya el usuario dio respuesta a esta alerta
	$ci = &get_instance();
	$ci->load->model("dashboard_model");
	
	$arrParam = array("idAlerta" => $lista["id_alerta"]);
	$existeRegistro = $this->dashboard_model->get_registro_by($arrParam);
	
	if(!$existeRegistro){
?>	
		<div class="col-lg-6">				
			<div class="panel panel-yellow">
				<div class="panel-heading">
					<i class="fa fa-calendar fa-fw"></i> ALERTA - <?php echo $infoAlertaNotificacion[0]['nombre_tipo_alerta']; ?>
				</div>
				<div class="panel-body">

<?php
$retornoError = $this->session->flashdata('retornoErrorNotificacion');
if ($retornoError) {
    ?>
	<div class="row">
		<div class="col-lg-12">	
			<div class="alert alert-danger ">
				<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
				<?php echo $retornoError ?>
			</div>
		</div>
	</div>
    <?php
}
?>
				
					<div class="col-lg-12">	
						<div class="alert alert-warning ">
							<strong>Descripción Alerta: </strong><?php echo $lista['descripcion_alerta']; ?><br>
							<strong>Mensaje Alerta: </strong><?php echo $lista['mensaje_alerta']; ?><br>
							<strong>Nombre de Prueba: </strong><?php echo $lista['nombre_prueba']; ?><br>
							<strong>Grupo Instrumentos: </strong><?php echo $lista['nombre_grupo_instrumentos']; ?><br>
							<strong>Fecha: </strong><?php echo $lista['fecha']; ?><br>
							<strong>Sesión Prueba: </strong><?php echo $lista['sesion_prueba']; ?><br>
							<strong>Número de Citados: </strong><?php echo $lista['numero_citados']; ?><br>
							
					<br>
					<form  name="form" id="<?php echo "form_" . $lista["id_alerta"]; ?>" class="form-horizontal" method="post" action="<?php echo base_url("dashboard/registro_notificacion"); ?>" >
						<input type="hidden" id="hddId" name="hddId" value="<?php echo $lista["id_alerta"]; ?>"/>
						<input type="hidden" id="hddIdSitioSesion" name="hddIdSitioSesion" value="<?php echo $lista["id_sitio_sesion"]; ?>"/>
						
						<div class="form-group">							
							<div class="col-sm-12">
								<label class="radio-inline">
									<input type="radio" name="acepta" id="acepta1" value=1>Si
								</label>
								<label class="radio-inline">
									<input type="radio" name="acepta" id="acepta2" value=2>No
								</label>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-12 control-label" for="observacion">Observación</label>
							<div class="col-sm-12">
								<textarea id="observacion" name="observacion" placeholder="Observación"  class="form-control" rows="2"></textarea>
							</div>
						</div>
					
						<div class="form-group">
							<div class="row" align="center">
								<div style="width:50%;" align="center">
									<input type="submit" id="btnSubmit" name="btnSubmit" value="Aceptar" class="btn btn-warning"/>
								</div>
							</div>
						</div>
					</form>	
							
						</div>
					</div>
				
				</div>
			</div>
		</div>
<?php
	}
	endforeach;
} ?>
<!--FIN ALERTA -->


<!--INICIO ALERTA CONSOLIDACION -->
<?php 
if($infoAlertaConsolidacion)
{
	foreach ($infoAlertaConsolidacion as $lista):
	
	//consultar si ya el usuario dio respuesta a esta alerta
	$ci = &get_instance();
	$ci->load->model("dashboard_model");
	
	$arrParam = array("idAlerta" => $lista["id_alerta"]);
	$existeRegistro = $this->dashboard_model->get_registro_by($arrParam);
	
	if(!$existeRegistro){
?>						
		<div class="col-lg-6">				
			<div class="panel panel-green">
				<div class="panel-heading">
					<i class="fa fa-calendar fa-fw"></i> ALERTA - <?php echo $infoAlertaConsolidacion[0]['nombre_tipo_alerta']; ?>
				</div>
				<div class="panel-body">
						
<?php						
$retornoError = $this->session->flashdata('retornoErrorConsolidacion');
if ($retornoError) {
    ?>
	<div class="row">
		<div class="col-lg-12">	
			<div class="alert alert-danger ">
				<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
				<?php echo $retornoError ?>
			</div>
		</div>
	</div>
    <?php
}						
	?>
						
					<div class="col-lg-12">	
						<div class="alert alert-success">
							<strong>Descripción Alerta: </strong><?php echo $lista['descripcion_alerta']; ?><br>
							<strong>Mensaje Alerta: </strong><?php echo $lista['mensaje_alerta']; ?><br>
							<strong>Nombre de Prueba: </strong><?php echo $lista['nombre_prueba']; ?><br>
							<strong>Grupo Instrumentos: </strong><?php echo $lista['nombre_grupo_instrumentos']; ?><br>
							<strong>Fecha: </strong><?php echo $lista['fecha']; ?><br>
							<strong>Sesión Prueba: </strong><?php echo $lista['sesion_prueba']; ?><br>
							<strong>Número de Citados: </strong><?php echo $lista['numero_citados']; ?><br>
							
					<br>
<script>
$( document ).ready( function () {
	$("#ausentes").bloquearTexto().maxlength(5);
});
</script>
					<form  name="formConsolidacion" id="<?php echo "formConsolidacion_" . $lista["id_alerta"]; ?>" class="form-horizontal" method="post" action="<?php echo base_url("dashboard/registro_consolidacion"); ?>">
						<input type="hidden" id="hddId" name="hddId" value="<?php echo $lista["id_alerta"]; ?>"/>
						<input type="hidden" id="hddIdSitioSesion" name="hddIdSitioSesion" value="<?php echo $lista["id_sitio_sesion"]; ?>"/>
						
						<input type="hidden" id="citados" name="citados" value="<?php echo $lista["numero_citados"]; ?>"/>
						
						<div class="form-group">
							<label class="col-sm-12 control-label" for="ausentes">Cantidad de ausentes</label>
							<div class="col-sm-12">
								<input type="text" id="ausentes" name="ausentes" class="form-control" required/>
							</div>
						</div>
											
						<div class="form-group">
							<div class="row" align="center">
								<div style="width:50%;" align="center">
									<input type="submit" id="btnConsolidacion" name="btnConsolidacion" value="Enviar" class="btn btn-success"/>
								</div>
							</div>
						</div>
					</form>	
							
						</div>
					</div>

				</div>
			</div>
		</div>
<?php
	}
	endforeach;
} ?>
<!--FIN ALERTA -->
	</div>


<!-- INICIO NOTIFICACIONES QUE NO SE LE HAN DADO RESPUESTA -->
<?php
	if($contadorInformativaNo!=0)
	{ 
		echo "<div class='alert alert-danger'>
					<strong>Atención</strong>, hay <strong>" . $contadorInformativaNo .  "</strong> Alertas Informativas sin dar respuesta.
					<a href=". base_url("dashboard/respuesta_coordinador/1/operador") ." >RESPONDER </a>
				</div>";
	}
	

	if($contadorNotificacion!=0)
	{ 
		echo "<div class='alert alert-danger'>
					<strong>Atención</strong>, hay <strong>" . $contadorNotificacion .  "</strong> Alertas de Notificación sin dar respuesta.
					<a href=". base_url("dashboard/respuesta_coordinador/2/operador") ." >RESPONDER </a>
				</div>";
	}


	if($contadorConsolidacionNo!=0)
	{ 
		echo "<div class='alert alert-danger'>
					<strong>Atención</strong>, hay <strong>" . $contadorConsolidacionNo .  "</strong> Alertas de Consolidación sin dar respuesta.
					<a href=". base_url("dashboard/respuesta_coordinador/3/operador") ." >RESPONDER </a>
				</div>";
	}
	
?>
<!-- INICIO NOTIFICACIONES QUE NO SE LE HAN DADO RESPUESTA -->








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
						

					
					</div></div>
					
					<div class="col-lg-4">
					<div class="alert alert-danger">
						<strong>Alerta de Notificación</strong><br>
						<?php
							$contadorNotificacionNo = $contadorNotificacionContestaron - $contadorNotificacionSi;
							$total = $contadorNotificacionNoContestaron + $contadorNotificacionSi + $contadorNotificacionNo;
							$totalNotificacion = $contadorNotificacionSi + $contadorNotificacionNo;
							
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
						

					
					</div></div>
					
					<div class="col-lg-4">
					<div class="alert alert-danger">
						<strong>Alerta de Consolidación</strong><br>
						<?php 
							$totalConsolidado = $contadorConsolidacionSi + $contadorConsolidacionNo; 
							if($totalConsolidado != 0){
								$porcentajeSi = round((($contadorConsolidacionSi * 100)/$totalConsolidado),1);
								$porcentajeNo = round((($contadorConsolidacionNo * 100)/$totalConsolidado),1);
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
								$porcentajePresentes = ($presentes * 100)/$conteoCitados['citados']; 
								$porcentajeAusentes = ($conteoCitados['ausentes'] * 100)/$conteoCitados['citados']; 
							}else{
								$presentes =  0;
								$porcentajePresentes = 0; 
								$porcentajeAusentes = 0;
							}
						
						?>
						<br>Número total de citados: <strong><?php echo $conteoCitados['citados']; ?> </strong>
						<br>Número total de presentes: <strong><?php echo $presentes . " (" . $porcentajePresentes . "%)"; ?> </strong>
						<br>Número total de ausentes: <strong><?php echo $conteoCitados['ausentes'] . " (" . $porcentajeAusentes . "%)"; ?> </strong>


						
					</div></div>
				</div>







	<!-- /.row -->
	<div class="row">
		<div class="col-lg-3 col-md-6">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-home fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge"><?php echo $noSitios; ?></div>
							<div>Sitios</div>
						</div>
					</div>
				</div>
				
				<a href="#anclaPruebas">
					<div class="panel-footer">
						<span class="pull-left">Lista de Sitios</span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
			</div>
		</div>				

		<div class="col-lg-3 col-md-6">
			<div class="panel panel-red">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-info fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge"><?php echo $contadorInformativaSi; ?></div>
							<div>Número de respuestas Alerta Informativa</div>
						</div>
					</div>
				</div>
				<a href="<?php echo base_url("report/registros/1/coordinador"); ?>">
					<div class="panel-footer">
						<span class="pull-left"> Lista Registros <br>Alerta Informativa </span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
			</div>
		</div>
		
		<div class="col-lg-3 col-md-6">
			<div class="panel panel-yellow">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-thumb-tack fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge"><?php echo $totalNotificacion; ?></div>
							<div>Número de respuestas Alerta Notificación</div>
						</div>
					</div>
				</div>
				<a href="<?php echo base_url("report/registros/2/coordinador"); ?>">
					<div class="panel-footer">
						<span class="pull-left">Lista Registros <br>Alerta Notificación </span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
			</div>
		</div>	

		<div class="col-lg-3 col-md-6">
			<div class="panel panel-green">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-crosshairs fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge"><?php echo $contadorConsolidacionSi; ?></div>
							<div>Número de respuestas Alerta Consolidación</div>
						</div>
					</div>
				</div>
				<a href="<?php echo base_url("report/registros/3/coordinador"); ?>">
					<div class="panel-footer">
						<span class="pull-left">Lista Registros <br>Alerta Consolidación</span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
			</div>
		</div>		
	</div>
				
				
				
				
				
            <div class="row">
			
				<div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-home fa-fw"></i> Lista de Sitios
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">


<a class="btn btn-default btn-circle" href="#anclaUp"><i class="fa fa-arrow-up"></i> </a>


<?php
	if(!$infoSitios){ 
		echo "<a href='#' class='btn btn-danger btn-block'>No hay Sitios</a>";
	}else{
?>						
					
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
						<thead>
							<tr>
								<th>Departamento</th>
								<th>Municipio</th>
								<th>Sitio</th>
								<th>Código DANE</th>
							</tr>
						</thead>
						<tbody>							
						<?php
							foreach ($infoSitios as $lista):
								echo "<tr>";								
								echo "<td >" . strtoupper($lista['dpto_divipola_nombre']) . "</td>";
								echo "<td >" . strtoupper($lista['mpio_divipola_nombre']) . "</td>";
								echo "<td >";
echo "<a href='" . base_url('report/mostrarSesiones/' . $lista['id_sitio'] . '/coordinador' ) . "'>" . $lista['nombre_sitio'] . "</a>";
								echo "</td>";
								echo "<td class='text-center'>" . $lista['codigo_dane'] . "</td>";
								echo "</tr>";
							endforeach;
						?>
						</tbody>
					</table>
					
<?php	} ?>					
				</div>
				<!-- /.panel-body -->
			</div>
		</div>

	</div>








</div>
<!-- /#page-wrapper -->