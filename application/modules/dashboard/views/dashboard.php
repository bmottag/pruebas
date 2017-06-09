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






					

<?php
	if($userRol==1){ //If it is an ADMIN user, show an special menu
?>
					
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-3 col-md-6">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-book fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge"><?php echo $noPruebasVigentes; ?></div>
							<div>Pruebas</div>
						</div>
					</div>
				</div>
				
				<a href="#anclaPruebas">
					<div class="panel-footer">
						<span class="pull-left">Lista de Pruebas</span>
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
							<div>Alerta Informativa</div>
						</div>
					</div>
				</div>
				<a href="<?php echo base_url("report/registros/1/admin"); ?>">
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
							<div>Alerta Notificación</div>
						</div>
					</div>
				</div>
				<a href="<?php echo base_url("report/registros/2/admin"); ?>">
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
							<div>Alerta Consolidación</div>
						</div>
					</div>
				</div>
				<a href="<?php echo base_url("report/registros/3/admin"); ?>">
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

<a name="anclaPruebas" ></a>			
				<div class="col-lg-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-book fa-fw"></i> Lista de Pruebas - Año <?php date('Y'); ?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">


<a class="btn btn-default btn-circle" href="#anclaUp"><i class="fa fa-arrow-up"></i> </a>


<?php
	if(!$infoPruebas){ 
		echo "<a href='#' class='btn btn-danger btn-block'>No hay Pruebas para la vigencia actual</a>";
	}else{
?>						
					
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
						<thead>
							<tr>
								<th>Prueba</th>
								<th>Descripción</th>
								<th>Año</th>
								<th>Semestre</th>
							</tr>
						</thead>
						<tbody>							
						<?php
							foreach ($infoPruebas as $lista):
								echo "<tr>";
								echo "<td >" . $lista['nombre_prueba'] . "</td>";
								echo "<td >" . $lista['descripcion_prueba'] . "</td>";
								echo "<td class='text-center'>" . $lista['anio_prueba'] . "</td>";
								echo "<td class='text-center'>" . $lista['semestre_prueba'] . "</td>";
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
			
			
<!-- INICIO TABLA DE DAILY INSPECTION -->
<?php	if($infoSesiones){  ?>	
<a name="anclaPickup" ></a>
		<div class="col-lg-6">
			<div class="panel panel-green">
				<div class="panel-heading">
					<i class="fa fa-search fa-fw"></i> Sesiones <?php echo $fechaInicio . " / " . $fechaFin ?>
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">	
				
<a class="btn btn-default btn-circle" href="#anclaUp"><i class="fa fa-arrow-up"></i> </a>

					<table width="100%" class="table table-striped table-bordered table-hover" id="dataSesiones">
						<thead>
							<tr>
								<th>Prueba</th>
								<th>Grupo Instrumentos</th>
								<th>Fecha</th>
								<th>Sesión</th>
								<th>Hora Inicio</th>
								<th>Hora Fin</th>
								<th>Citados</th>
								<th>Ausentes</th>
								<th>Departamento</th>
								<th>Municipio</th>
								<th>Sitio</th>
							</tr>
						</thead>
						<tbody>							
						<?php
							foreach ($infoSesiones as $lista):
								echo "<tr>";
								echo "<td>" . $lista['nombre_prueba'] . "</td>";
								echo "<td>" . $lista['nombre_grupo_instrumentos'] . "</td>";
								echo "<td class='text-center'>" . $lista['fecha'] . "</td>";
								echo "<td class='text-center'>" . $lista['sesion_prueba'] . "</td>";
								echo "<td class='text-center'>" . $lista['hora_inicio_prueba'] . "</td>";
								echo "<td class='text-center'>" . $lista['hora_fin_prueba'] . "</td>";
								echo "<td class='text-center'>" . $lista['numero_citados'] . "</td>";
								echo "<td class='text-center'>" . $lista['numero_ausentes'] . "</td>";
								echo "<td class='text-center'>" . $lista['dpto_divipola_nombre'] . "</td>";
								echo "<td class='text-center'>" . $lista['mpio_divipola_nombre'] . "</td>";
								echo "<td>" . $lista['nombre_sitio'] . "</td>";
								echo "</tr>";
							endforeach;
						?>
						</tbody>
					</table>
				</div>
				<!-- /.panel-body -->
			</div>
<?php	} ?>
<!-- FIN TABLA DE DAILY INSPECTION -->

			
			
		</div>

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
		</div>

<?php } ?>
	
		

</div>
<!-- /#page-wrapper -->


    <!-- Tables -->
    <script>
    $(document).ready(function() {
        $('#dataTables').DataTable({
            responsive: true,
			 "ordering": false,
			 paging: false,
			"searching": false
        });
		
        $('#dataSesiones').DataTable({
            responsive: true,
			 "ordering": false,
			 paging: false,
			"searching": false
        });	

		
		
    });
    </script>