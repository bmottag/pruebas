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
                    $('#tablaDatosSalon').html(data);
                }
            });
	});
	
	$(".btn-primary").click(function () {	
			var oID = $(this).attr("id");
            $.ajax ({
                type: 'POST',
				url: base_url + 'sitios/cargarModalSalones',
                data: {'idSitio': oID, 'idBloque': 'x'},
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
						<strong>Sitios: </strong><?php echo $infoSitio[0]['nombre_sitio']; ?>
					</div>					
								
					<button type="button" class="btn btn-outline btn-success btn-block" data-toggle="modal" data-target="#modal" id="<?php echo $infoSitio[0]['id_sitio']; ?>">
							<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar bloque
					</button><br>
					
					<br>
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
				
				
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
						<thead>
							<tr>
								<th>Nombre</th>
								<th>Estado</th>
								<th>Observaciones</th>
								<th>Edit</th>
							</tr>
						</thead>
						<tbody>							
						<?php
							foreach ($infoBloques as $lista):
									echo "<tr>";
									echo "<td>" . $lista['nombre_bloque'] . "</td>";
									echo "<td class='text-center'>" . $lista['estado_bloque'] . "</td>";
									echo "<td>" . $lista['observacion_bloque'] . "</td>";
									
									echo "<td class='text-center'>";									
						?>
									<button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal" id="<?php echo $lista['id_sitio_bloque']; ?>" >
										Editar <span class="glyphicon glyphicon-edit" aria-hidden="true">
									</button>									
						<?php
									echo "</td>";
									echo "</tr>";
							endforeach;
						?>
						</tbody>
					</table>
				<?php } ?>
				
				

					<button type="button" class="btn btn-outline btn-primary btn-block" data-toggle="modal" data-target="#modal_salon" id="<?php echo $infoSitio[0]['id_sitio']; ?>">
							<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar salon
					</button><br>
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				

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
 