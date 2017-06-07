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
						<br><?php echo $rol_busqueda; ?> que no Aceptaron: <strong><?php echo $contadorNotificacionNo . " (" . $porcentajeNo . "%)"; ?> </strong>
						

					
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
						
						<?php echo $rol_busqueda; ?> que contestaron: <strong><?php echo $contadorConsolidacionSi . " (" . $porcentajeSi . "%)"; ?> </strong>
						<br><?php echo $rol_busqueda; ?> que no contestaron: <strong><?php echo $contadorConsolidacionNo . " (" . $porcentajeNo . "%)"; ?> </strong>


						
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
							<div class="huge"><?php echo $totalConsolidado; ?></div>
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
								echo "<td >" . $lista['dpto_divipola_nombre'] . "</td>";
								echo "<td >" . $lista['mpio_divipola_nombre'] . "</td>";
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



    <!-- Tables -->
    <script>
    $(document).ready(function() {
        $('#dataTables').DataTable({
            responsive: true,
			 "ordering": false,
			 paging: true,
			"searching": true,
			"pageLength": 30
        });
		
    });
    </script>