<script type="text/javascript" src="<?php echo base_url("assets/js/validate/sitios/ajaxSalones.js"); ?>"></script>

<script>
$(function(){ 
	$(".btn-success").click(function () {	
			var oID = $(this).attr("id");
			var enlace_regreso = $('#enlace_regreso').val();
            $.ajax ({
                type: 'POST',
				url: base_url + 'admin/cargarModalSitio',
                data: {'identificador': oID, 'enlace_regreso': enlace_regreso},
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
			<div class="panel panel-info">
				<div class="panel-heading">
					<i class="fa fa-briefcase"></i> Lista de sitios
					
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group text-left">
									<label class="control-label" for="depto">Departamento : </label>
									<select name="depto" id="depto" class="form-control" >
										<option value=''>Select...</option>
										<?php for ($i = 0; $i < count($departamentos); $i++) { ?>
											<option value="<?php echo $departamentos[$i]["dpto_divipola"]; ?>" ><?php echo $departamentos[$i]["dpto_divipola_nombre"]; ?></option>	
										<?php } ?>
									</select>
								</div>
							</div>
						
							<div class="col-sm-6">
								<div class="form-group text-left">
									<label class="control-label" for="mcpio">Municipio : </label>
									<select name="mcpio" id="mcpio" class="form-control" required>					
										<?php if($information){ ?>
										<option value=''>Select...</option>
											<option value="<?php echo $information[0]["fk_mpio_divipola"]; ?>" selected><?php echo $information[0]["mpio_divipola_nombre"]; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
						</div>
				</div>
				<div class="panel-body">

				<?php
					if($info){
				?>	<input type="hidden" id="enlace_regreso" name="enlace_regreso" value="sitios"/>				
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
						<thead>
							<tr>				
								<th>Departamento</th>
								<th>Municipio</th>
								<th>Sitio</th>
								<th>Código DANE</th>
								<th class="text-center">Enlaces</th>
							</tr>
						</thead>
						<tbody id="sitios">							
						<?php
							foreach ($info as $lista):
									echo "<tr>";
									echo "<td >" . strtoupper($lista['dpto_divipola_nombre']) . "</td>";
									echo "<td >" . strtoupper($lista['mpio_divipola_nombre']) . "</td>";	
									echo "<td >" . $lista['nombre_sitio'] . "</td>";
									echo "<td class='text-center'>" . $lista['codigo_dane'] . "</td>";
									
									echo "<td class='text-center'>";
						?>
						
								<div class="btn-group">
									<a class='btn btn-default btn-xs' href='<?php echo base_url('sitios/salones/' . $lista['id_sitio']) ?>'>
										Bloques y Salones <span class="fa fa-cube" aria-hidden="true">
									</a>
									
									<button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal" id="<?php echo $lista['id_sitio']; ?>" >
										Editar <span class="glyphicon glyphicon-edit" aria-hidden="true">
									</button>
									
								</div>


						<?php
									echo "</td>";
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
		
<!--INICIO Modal para adicionar SITIOS -->
<div class="modal fade text-center" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">    
	<div class="modal-dialog" role="document">
		<div class="modal-content" id="tablaDatos">

		</div>
	</div>
</div>                       
<!--FIN Modal para adicionar SITIOS -->
		
<!-- Tables -->
<script>
$(document).ready(function() {
	$('#dataTables').DataTable({
		responsive: true,
		"pageLength": 50
	});
});
</script>