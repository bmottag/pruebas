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
					<a class="btn btn-success" href=" <?php echo base_url(). $botonRegreso; ?> "><span class="glyphicon glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Regresar </a> 
                    <i class="fa fa-life-saver fa-fw"></i> Lista de Sitios filtrado por <?php echo $subTitulo; ?>
				</div>
				<div class="panel-body">
					<div class="alert alert-info">
						<?php if(isset($infoRegion)){ ?>
							<strong>Región: </strong><?php echo $infoRegion[0]['nombre_region']; ?> 
						<?php } ?>
						
						<?php if(isset($infoDepartamento)){ ?>
							<strong>Departamento: </strong><?php echo $infoDepartamento[0]['dpto_divipola_nombre']; ?> 
						<?php } ?>						
					</div>
					<?php
						if(!$info){
					?>
						<div class="alert alert-danger">
							No hay Sitios para <?php echo $subTitulo; ?> seleccionada. 
						</div>
					<?php
						}else{
					?>	
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
						<thead>
							<tr>
								<th class="text-center">Nombre Sitio</th>
								<th class="text-center">Región</th>
								<th class="text-center">Departamento</th>
								<th class="text-center">Municipio</th>
								<th class="text-center">Zona</th>
								<th class="text-center">Número de Sesiones</th>
								<th class="text-center">Nombre Contacto</th>
								<th class="text-center">Teléfono Contacto</th>
								<th class="text-center">Celular Contacto</th>
								<th class="text-center">Email Contacto</th>
							</tr>
						</thead>
						<tbody>							
						<?php
							foreach ($info as $lista):
							
									//consultar numero de sesiones por sitio
									$ci = &get_instance();
									$ci->load->model("report_model");
									
									$arrParam = array("idSitio" => $lista["id_sitio"]);
									$conteoSesiones = $this->report_model->countSesionesbySitio($arrParam);
									
									echo "<tr>";
									echo "<td>" . $lista['nombre_sitio'] . "</td>";
									echo "<td>" . $lista['nombre_region'] . "</td>";
									echo "<td>" . $lista['dpto_divipola_nombre'] . "</td>";
									echo "<td>" . $lista['mpio_divipola_nombre'] . "</td>";
									echo "<td>" . $lista['nombre_zona'] . "</td>";
									echo "<td class='text-center'>";
echo "<button type='button' class='btn btn-info btn-circle'>" .  $conteoSesiones . "</button>";


?>

<a href="<?php echo base_url("report/mostrarSesiones/" . $lista['id_sitio']); ?>" class='btn btn-info btn-circle'>Ver </a>


<?php




									echo "</td>";
									echo "<td>" . $lista['contacto_nombres'] . " " . $lista['contacto_apellidos'] . "</td>";
									echo "<td>" . $lista['contacto_telefono'] . "</td>";
									echo "<td>" . $lista['contacto_celular'] . "</td>";
									echo "<td>" . $lista['contacto_email'] . "</td>";
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
		"pageLength": 25
	});
});
</script>