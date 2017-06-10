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








<!--INICIO INFO DE LAS ALERTAS -->
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


						
					</div></div>
				</div>
<!--FIN INFO DE LAS ALERTAS -->








					
	<!-- /.row CAJAS DE COLORES -->
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
							<div class="huge"><?php echo $noRegistroInformativa; ?></div>
							<div>Número de respuestas Alerta Informativa</div>
						</div>
					</div>
				</div>
				<a href="<?php echo base_url("report/registros/1/directivo"); ?>">
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
							<div class="huge"><?php echo $noRegistroNotificacion; ?></div>
							<div>Número de respuestas Alerta Notificación</div>
						</div>
					</div>
				</div>
				<a href="<?php echo base_url("report/registros/2/directivo"); ?>">
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
							<div class="huge"><?php echo $noRegistroConsolidacion; ?></div>
							<div>Número de respuestas Alerta Consolidación</div>
						</div>
					</div>
				</div>
				<a href="<?php echo base_url("report/registros/3/directivo"); ?>">
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
echo "<a href='" . base_url('report/mostrarSesiones/' . $lista['id_sitio'] . '/directivo' ) . "'>" . $lista['nombre_sitio'] . "</a>";
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
			"pageLength": 50
        });
		
    });
    </script>