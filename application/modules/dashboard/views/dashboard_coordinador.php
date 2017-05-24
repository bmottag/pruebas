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
if(!$infoMunicipiosCoordinador){ 
?>
	<div class="alert alert-info">
		Por favor contactarse con el Encargado, usted no tiene nada asignado.
	</div>
<?php
}else{
	

?>

	<div class="alert alert-info">
		Usted esta asignado como <strong>COORDINADOR</strong> para los siguientes MUNICIPIOS:
	</div>


	<?php
		foreach($infoMunicipiosCoordinador as $lista):
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


<?php } ?>
<!-- INFORMACION DEL SITIO PARA EL DELEGADO SI EXISTE INFORMAION -->











		

	<div class="row">
<!--INICIO ALERTA INFORMATIVA -->
<?php if($infoAlertaInformativa){ ?>
	
		<div class="col-lg-6">				
			<div class="panel panel-danger">
				<div class="panel-heading">
					<i class="fa fa-calendar fa-fw"></i> ALERTA - <?php echo $infoAlertaInformativa[0]['nombre_tipo_alerta']; ?>
				</div>
				<div class="panel-body">
					
				<?php
					foreach ($infoAlertaInformativa as $lista):
					
					//consultar si ya el usuario dio respuesta a esta alerta
					$ci = &get_instance();
					$ci->load->model("dashboard_model");
					
					$arrParam = array("idAlerta" => $lista["id_alerta"]);
					$existeRegistro = $this->dashboard_model->get_registro_by($arrParam);
					
					if(!$existeRegistro){
				?>
						
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

				<?php
					}
					endforeach;
				?>

				</div>
			</div>
		</div>
	
<?php } ?>
<!--FIN ALERTA -->


<!--INICIO ALERTA NOTIFICACION -->
<?php if($infoAlertaNotificacion){ ?>
	
		<div class="col-lg-6">				
			<div class="panel panel-yellow">
				<div class="panel-heading">
					<i class="fa fa-calendar fa-fw"></i> ALERTA - <?php echo $infoAlertaNotificacion[0]['nombre_tipo_alerta']; ?>
				</div>
				<div class="panel-body">

				<?php
					foreach ($infoAlertaNotificacion as $lista):
					
					//consultar si ya el usuario dio respuesta a esta alerta
					$ci = &get_instance();
					$ci->load->model("dashboard_model");
					
					$arrParam = array("idAlerta" => $lista["id_alerta"]);
					$existeRegistro = $this->dashboard_model->get_registro_by($arrParam);
					
					if(!$existeRegistro){
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

				<?php
					}
					endforeach;
				?>
				
				</div>
			</div>
		</div>
	
<?php } ?>
<!--FIN ALERTA -->


<!--INICIO ALERTA CONSOLIDACION -->
<?php if($infoAlertaConsolidacion){ ?>
	
		<div class="col-lg-6">				
			<div class="panel panel-green">
				<div class="panel-heading">
					<i class="fa fa-calendar fa-fw"></i> ALERTA - <?php echo $infoAlertaConsolidacion[0]['nombre_tipo_alerta']; ?>
				</div>
				<div class="panel-body">

				<?php
					foreach ($infoAlertaConsolidacion as $lista):
					
					//consultar si ya el usuario dio respuesta a esta alerta
					$ci = &get_instance();
					$ci->load->model("dashboard_model");
					
					$arrParam = array("idAlerta" => $lista["id_alerta"]);
					$existeRegistro = $this->dashboard_model->get_registro_by($arrParam);
					
					if(!$existeRegistro){
						
						
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

				<?php
					}
					endforeach;
				?>

				</div>
			</div>
		</div>
	
<?php } ?>
<!--FIN ALERTA -->
	</div>





<!-- INICIO NOTIFICACIONES QUE NO SE LE HAN DADO RESPUESTA -->
<?php
	if($infoSesiones){ 
?>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-info">
						
                        <div class="panel-heading">
                            <i class="fa fa-life-saver fa-fw"></i> Lista de Sesiones asociadas con el Sitio asignado
                        </div>
						
                        <div class="panel-body">
						
<a class="btn btn-default btn-circle" href="#anclaUp"><i class="fa fa-arrow-up"></i> </a>
						
							<table width="100%" class="table table-striped table-bordered table-hover" id="dataSafety">
								<thead>
									<tr>
										<th>Sesión</th>
										<th>Fecha</th>
										<th>Hora Inicio</th>
										<th>Hora Fin</th>
										<th>Número de Citados</th>
									</tr>
								</thead>
								<tbody>							
								<?php
									foreach ($infoSesiones as $lista):
										echo "<tr>";
										echo "<td>";
										echo "<strong>Prueba:</strong><br>". $lista['nombre_prueba'];
										echo "<br><strong>Grupo Instrumentos:</strong><br>". $lista['nombre_grupo_instrumentos'];
										echo "<br><strong>Sesión:</strong><br>". $lista['sesion_prueba'];
										echo "</td>";
										echo "<td class='text-center'>" . $lista['fecha'] . "</td>";
										echo "<td class='text-center'>" . $lista['hora_inicio_prueba'] . "</td>";
										echo "<td class='text-center'>" . $lista['hora_fin_prueba'] . "</td>";
										echo "<td class='text-center'>" . $lista['numero_citados'] . "</td>";
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
<!-- INICIO NOTIFICACIONES QUE NO SE LE HAN DADO RESPUESTA -->


</div>
<!-- /#page-wrapper -->