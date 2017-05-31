<script type="text/javascript" src="<?php echo base_url("assets/js/validate/novedades/cambio_cuadernillo.js"); ?>"></script>

<script>
$(function(){ 
	$(".btn-success").click(function () {	
			var oID = $(this).attr("id");
            $.ajax ({
                type: 'POST',
				url: base_url + '/novedades/cargarModalCambioCuadernillo',
                data: {'identificador': oID},
                cache: false,
                success: function (data) {
                    $('#tablaDatos').html(data);
                }
            });
	});	
});
</script>


<div id="page-wrapper">
	<br>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4 class="list-group-item-heading">
					<i class="fa fa-bug fa-fw"></i> NOVEDADES - CAMBIO DE CUADERNILLO
					</h4>
				</div>
			</div>
		</div>
		<!-- /.col-lg-12 -->				
	</div>
	
	<div class="row">
		<div class="col-md-4">
			<div class="panel panel-info">
				<div class="panel-heading">
					<strong>Nombre Sitio: </strong><?php echo $infoSitio[0]['nombre_sitio']; ?>
					<br><strong>Dirección: </strong><?php echo $infoSitio[0]['direccion_sitio']; ?>
					<br><strong>Contacto: </strong><br><?php echo $infoSitio[0]['contacto_nombres'] . " " . $infoSitio[0]['contacto_apellidos']; ?>
					<br><strong>Celular: </strong><?php echo $infoSitio[0]['contacto_celular']; ?>
				</div>
			</div>
		</div>
		
		<div class="col-md-4">
			<div class="panel panel-info">
				<div class="panel-heading">
					<strong>Nodo o Región: </strong><?php echo $infoSitio[0]['nombre_region']; ?>
					<br><strong>Departamento: </strong><?php echo $infoSitio[0]['dpto_divipola_nombre']; ?>
					<br><strong>Municipio: </strong><?php echo $infoSitio[0]['mpio_divipola_nombre']; ?>
					<br><strong>Zona: </strong><?php echo $infoSitio[0]['nombre_zona']; ?>
				</div>
			</div>
		</div>
		
		<div class="col-md-4">
			<div class="panel panel-info">
				<div class="panel-heading">
					<strong>Delegado: </strong><br>
					<?php 
					if($infoSitio[0]['fk_id_user_delegado']){
						echo "C.C. " . $infoSitio[0]['cedula_delegado'] . " " . $infoSitio[0]['nom_delegado'] . " "  . $infoSitio[0]['ape_delegado'];
						echo "<br><strong>Celular: </strong>" . $infoSitio[0]['celular_delegado']; 
					} else { echo "Falta asignar Delegado.";}
					?>

					<br><strong>Coordinador: </strong><br>
					<?php 
					if($infoSitio[0]['fk_id_user_coordinador']){
						echo "C.C. " . $infoSitio[0]['cedula_coordinador'] . " " . $infoSitio[0]['nom_coordinador'] . " "  . $infoSitio[0]['ape_coordiandor'];
						echo "<br><strong>Celular: </strong>" . $infoSitio[0]['celular_coordinador']; 
					} else { echo "Falta asignar Coordinador.";}
					?>
				</div>
			</div>
		</div>
	</div>
	
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-bug"></i> LISTA DE CAMBIO DE CUADERNILLOS
				</div>
				<div class="panel-body">
					<button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#modal" id="x">
							<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar Cambio de Cuadernillo
					</button><br>
<?php
$retornoExito = $this->session->flashdata('retornoExito');
if ($retornoExito) {
    ?>
	<div class="col-lg-12">	
		<div class="alert alert-success ">
			<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
			<?php echo $retornoExito ?>		
		</div>
	</div>
    <?php
}

$retornoError = $this->session->flashdata('retornoError');
if ($retornoError) {
    ?>
	<div class="col-lg-12">	
		<div class="alert alert-danger ">
			<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
			<?php echo $retornoError ?>
		</div>
	</div>
    <?php
}
?> 
				<?php
					if($info){
				?>				
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
						<thead>
							<tr>
								<th class="text-center">Sesión</th>
								<th class="text-center">SNP Examinando</th>
								<th class="text-center">Editar</th>
								<th class="text-center">Motivo cambio cuadernillo</th>
								<th class="text-center">Observación</th>
							</tr>
						</thead>
						<tbody>							
						<?php
							foreach ($info as $lista):
									echo "<tr>";
									
									echo "<td>";
									echo "<strong>Prueba: </strong>" . $lista['nombre_prueba'];
									echo "<br><strong>Grupo de Instrumentos: </strong>" . $lista['nombre_grupo_instrumentos'];
									echo "<br><strong>Sesión: </strong>" . $lista['sesion_prueba'];
									echo "<br><strong>Fecha: </strong>" . $lista['fecha'];
									echo "<br><strong>Hora Inicial: </strong>" . $lista['hora_inicio_prueba'];
									echo "<br><strong>Hora Final: </strong>" . $lista['hora_fin_prueba'];
									echo "</td>";
									
									echo "<td class='text-center'>";
									echo '<p class="text-primary"><strong>' . $lista['snp'] . '</strong></p>';
									echo "</td>";
									
									echo "<td class='text-center'>";
						?>
									<button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal" id="<?php echo $lista['id_cambio_cuadernillo']; ?>" >
										Editar <span class="glyphicon glyphicon-edit" aria-hidden="true">
									</button>
									
									<br><br>

<button type="button" class="btn btn-danger btn-xs" id="<?php echo $lista['id_cambio_cuadernillo']; ?>" >
	Eliminar <span class="fa fa-times fa-fw" aria-hidden="true">
</button>
						<?php
									echo "</td>";
									echo "<td>" . $lista['nombre_motivo_novedad'] . "</td>";

									
									
									echo "<td>" . $lista['observacion'] . "</td>";
									echo "</tr>";
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
		
				
<!--INICIO Modal para adicionar HAZARDS -->
<div class="modal fade text-center" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">    
	<div class="modal-dialog" role="document">
		<div class="modal-content" id="tablaDatos">

		</div>
	</div>
</div>                       
<!--FIN Modal para adicionar HAZARDS -->

<!-- Tables -->
<script>
$(document).ready(function() {
	$('#dataTables').DataTable({
		responsive: true,
		"order": [[ 0, "asc" ]],
		"pageLength": 25
	});
});
</script>