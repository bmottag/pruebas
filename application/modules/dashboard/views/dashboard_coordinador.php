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

	<div class="row">
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
	</div>

<?php } ?>
<!-- INFORMACION DEL SITIO PARA EL DELEGADO SI EXISTE INFORMAION -->









<!-- INICIO NOTIFICACIONES QUE NO SE LE HAN DADO RESPUESTA -->
<?php
	if($contadorInformativaNo!=0)
	{ 
		echo "<div class='alert alert-danger'>
					<strong>Atención</strong>, hay <strong>" . $contadorInformativaNo .  "</strong> Alertas Informativas sin dar respuesta.
					<a href=". base_url("dashboard/respuesta_coordinador/1/coordinador") ." >RESPONDER </a>
				</div>";
	}
	

	if($contadorNotificacion!=0)
	{ 
		echo "<div class='alert alert-danger'>
					<strong>Atención</strong>, hay <strong>" . $contadorNotificacion .  "</strong> Alertas de Notificación sin dar respuesta.
					<a href=". base_url("dashboard/respuesta_coordinador/2/coordinador") ." >RESPONDER </a>
				</div>";
	}


	if($contadorConsolidacionNo!=0)
	{ 
		echo "<div class='alert alert-danger'>
					<strong>Atención</strong>, hay <strong>" . $contadorConsolidacionNo .  "</strong> Alertas de Consolidación sin dar respuesta.
					<a href=". base_url("dashboard/respuesta_coordinador/3/coordinador") ." >RESPONDER </a>
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
						<br><?php echo $rol_busqueda; ?> que no Aceptaron: <strong><?php echo $contadorNotificacionNo . " (" . $porcentajeNo . "%)"; ?> </strong>
						

					
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
						
						<?php echo $rol_busqueda; ?> que contestaron: <strong><?php echo $contadorConsolidacionSi . " (" . $porcentajeSi . "%)"; ?> </strong>
						<br><?php echo $rol_busqueda; ?> que no contestaron: <strong><?php echo $contadorConsolidacionNo . " (" . $porcentajeNo . "%)"; ?> </strong>


						
					</div></div>
				</div>











</div>
<!-- /#page-wrapper -->

