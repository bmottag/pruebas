<script type="text/javascript" src="<?php echo base_url("assets/js/validate/sitios/ajaxSalones.js"); ?>"></script>

<script>
$(function(){ 
	$(".btn-success").click(function () {	
			var oID = $(this).attr("id");
            $.ajax ({
                type: 'POST',
				url: base_url + 'sitios/cargarModalBloques',
                data: {'idSitio': oID, 'idBloque': 'x'},
                cache: false,
                success: function (data) {
                    $('#tablaDatos').html(data);
                }
            });
	});	
	
	$(".btn-info").click(function () {	
			var oID = $(this).attr("id");
            $.ajax ({
                type: 'POST',
				url: base_url + 'sitios/cargarModalBloques',
                data: {'idSitio': '', 'idBloque': oID},
                cache: false,
                success: function (data) {
                    $('#tablaDatos').html(data);
                }
            });
	});
	
	$(".btn-primary").click(function () {	
			var oID = $(this).attr("id");
            $.ajax ({
                type: 'POST',
				url: base_url + 'sitios/cargarModalSalones',
                data: {'idSitio': oID, 'idSalon': 'x'},
                cache: false,
                success: function (data) {
                    $('#tablaDatosSalon').html(data);
                }
            });
	});

	$(".btn-default").click(function () {	
			var oID = $(this).attr("id");
            $.ajax ({
                type: 'POST',
				url: base_url + 'sitios/cargarModalSalones',
                data: {'idSitio': '', 'idSalon': oID},
                cache: false,
                success: function (data) {
                    $('#tablaDatosSalon').html(data);
                }
            });
	});
	
});
</script>

<div id="page-wrapper">
	<br>

	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-warning">
				<div class="panel-heading">
					<a class="btn btn-warning btn-xs" href=" <?php echo base_url().'sitios'; ?> "><span class="glyphicon glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Regresar </a> 
					<i class="fa fa-cube"></i> Bloques para un sitio
				</div>
				<div class="panel-body">
				
					<div class="alert alert-warning">
						<strong>Sitio: </strong><?php echo $infoSitio[0]['nombre_sitio']; ?><br>
						<strong>Código DANE: </strong><?php echo $infoSitio[0]['codigo_dane']; ?><br>
						<strong>Departemanto: </strong><?php echo $infoSitio[0]['dpto_divipola_nombre']; ?><br>
						<strong>Municipio: </strong><?php echo $infoSitio[0]['mpio_divipola_nombre']; ?>
					</div>					
									
				</div>
					
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	
<?php
$retornoExito = $this->session->flashdata('retornoExito');
if ($retornoExito) {
    ?>
	<div class="col-lg-12">	
		<div class="alert alert-success">
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
					if($infoBloques){
				?>
				
				
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label for="type" class="control-label">Departamento : *</label>
					<select name="depto" id="depto" class="form-control" >
						<option value=''>Select...</option>
						<?php for ($i = 0; $i < count($infoBloques); $i++) { ?>
							<option value="<?php echo $infoBloques[$i]["id_sitio_bloque"]; ?>" ><?php echo $infoBloques[$i]["nombre_bloque"]; ?></option>	
						<?php } ?>
					</select>
				</div>
			</div>
			
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label for="type" class="control-label">Municipio : *</label>

					<select name="mcpio" id="mcpio" class="form-control" required>					
						<?php if($information){ ?>
						<option value=''>Select...</option>
							<option value="<?php echo $information[0]["fk_mpio_divipola"]; ?>" selected><?php echo $information[0]["nombre_bloque"]; ?></option>
						<?php } ?>
					</select>
				
				</div>
			</div>
		</div>
				
			
		<div class="row">
			<div class="col-lg-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						Listado de bloques
					</div>
					<!-- /.panel-heading -->
					<div class="panel-body">
						<div class="table-responsive">
						
							<table width="100%" class="table table-striped table-hover">
								<thead>
									<tr>
										<th class='text-center'>Nombre</th>
										<th class='text-center'>Estado</th>
										<th class='text-center'>Editar</th>
									</tr>
								</thead>
								<tbody>							
								<?php
									foreach ($infoBloques as $lista):
											echo "<tr>";
											echo "<td>" . $lista['nombre_bloque'] . "</td>";										
											
											echo "<td class='text-center'>";
											switch ($lista['estado_bloque']) {
												case 1:
													$valor = 'Activo';
													$clase = "text-success";
													break;
												case 2:
													$valor = 'Inactivo';
													$clase = "text-danger";
													break;
											}
											echo '<p class="' . $clase . '"><strong>' . $valor . '</strong></p>';
											echo "</td>";
											
											
											
											echo "<td class='text-center'>";									
								?>
											<button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal" id="<?php echo $lista['id_sitio_bloque']; ?>" >
												<span class="glyphicon glyphicon-edit" aria-hidden="true">
											</button>									
								<?php
											echo "</td>";
											echo "</tr>";
									endforeach;
								?>
								</tbody>
							</table>
							
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-lg-6">
				<br>
				<button type="button" class="btn btn-outline btn-success btn-block" data-toggle="modal" data-target="#modal" id="<?php echo $infoSitio[0]['id_sitio']; ?>">
						<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar bloque
				</button>
				
				<br><br>

				<button type="button" class="btn btn-outline btn-primary btn-block" data-toggle="modal" data-target="#modal_salon" id="<?php echo $infoSitio[0]['id_sitio']; ?>">
						<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar salon
				</button><br>
			</div>

		</div>
				<?php } ?>
				
				
				
				<?php
					if($infoSalones){
						$i=0;
				?>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						Listado de salones
					</div>
					<!-- /.panel-heading -->
					<div class="panel-body">
						<div class="table-responsive">
				
							<table width="100%" class="table table-striped table-hover">
								<thead>
									<tr>
										<th class='text-center'>#</th>
										<th class='text-center'>Salón</th>
										<th class='text-center'>Capacidad</th>
										<th class='text-center'>Tipo de salón</th>
										<th class='text-center'>Estado</th>
										<th class='text-center'>Edit</th>
									</tr>
								</thead>
								<tbody>							
								<?php
									foreach ($infoSalones as $lista):
											$i++;
									
											echo "<tr>";
											echo "<td class='text-center'>" . $i . "</td>";
											echo "<td>" . $lista['nombre_salon'] . "</td>";
											echo "<td class='text-center'>" . $lista['capacidad_salon'] . "</td>";
											
											switch ($lista['tipo_salon']) {
												case 1:
													$tipoSalon = 'Arquitectura';
													break;
												case 2:
													$tipoSalon = 'Electrónico';
													break;
												case 2:
													$tipoSalon = 'Papel';
													break;
											}
											echo "<td>" . $tipoSalon . "</td>";
	
											echo "<td class='text-center'>";
											switch ($lista['estado_salon']) {
												case 1:
													$valor = 'Activo';
													$clase = "text-success";
													break;
												case 2:
													$valor = 'Inactivo';
													$clase = "text-danger";
													break;
											}
											echo '<p class="' . $clase . '"><strong>' . $valor . '</strong></p>';
											echo "</td>";
											
											echo "<td class='text-center'>";									
								?>
											<button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modal_salon" id="<?php echo $lista['id_sitio_salon']; ?>" >
												Editar <span class="glyphicon glyphicon-edit" aria-hidden="true">
											</button>									
								<?php
											echo "</td>";
											echo "</tr>";								
									endforeach;
								?>
								</tbody>
							</table>
					
						</div>
					</div>
				</div>
			</div>
		</div>
				<?php } ?>
	
	
</div>
<!-- /#page-wrapper -->

<!--INICIO Modal Bloques-->
<div class="modal fade text-center" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">    
	<div class="modal-dialog" role="document">
		<div class="modal-content" id="tablaDatos">

		</div>
	</div>
</div>                       
<!--FIN Modal Bloques-->

<!--INICIO Modal Salones-->
<div class="modal fade text-center" id="modal_salon" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">    
	<div class="modal-dialog" role="document">
		<div class="modal-content" id="tablaDatosSalon">

		</div>
	</div>
</div>                       
<!--FIN Modal Salones-->


    <!-- Tables -->
    <script>
    $(document).ready(function() {
        $('#dataTables').DataTable({
            responsive: true,
			 "ordering": false,
			 paging: false,
			"searching": false,
			"info": false
        });
    });
    </script>
 