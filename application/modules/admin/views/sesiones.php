<script>
$(function(){ 
	$(".btn-success").click(function () {	
			var oID = $(this).attr("id");
            $.ajax ({
                type: 'POST',
				url: base_url + 'admin/cargarModalSesiones',
                data: {'idGrupo': oID, 'idSesion': 'x'},
                cache: false,
                success: function (data) {
                    $('#tablaDatos').html(data);
                }
            });
	});	
	
	$(".btn-danger").click(function () {	
			var oID = $(this).attr("id");
            $.ajax ({
                type: 'POST',
				url: base_url + 'admin/cargarModalSesiones',
                data: {'idGrupo': '', 'idSesion': oID},
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
					<i class="fa fa-gear fa-fw"></i> CONFIGURACIONES - SESIONES
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
					<i class="fa fa-gears "></i> LISTA DE SESIONES
				</div>
				<div class="panel-body">
				
					<div class="row">
						<div class="col-lg-12">
						
							<div class="row" align="center">
								<div style="width:50%;" align="center">
									<div class="alert alert-success"> <span class="glyphicon glyphicon-pushpin">&nbsp;</span>
										<strong>GRUPO DE TRABAJO: </strong>
										<?php echo $infoGrupo[0]['nombre_grupo_instrumentos']; ?>
									</div>
								</div>
							</div>	
						
						</div>
					</div>
				
					<button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#modal" id="<?php echo $infoGrupo[0]['id_grupo_instrumentos']; ?>">
							<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar Sesiones
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
								<th class="text-center">Nombre Sitio</th>
								<th class="text-center">Dirección</th>
								<th class="text-center">Barrio</th>
								<th class="text-center">Editar</th>
								<th class="text-center">Teléfono</th>
								<th class="text-center">Fax</th>
								<th class="text-center">Celuar</th>
								<th class="text-center">Email</th>
								<th class="text-center">Codigo Postal</th>
								<th class="text-center">Nombre Organización</th>
								<th class="text-center">Region</th>
								<th class="text-center">Dpto DIVIPOLA</th>
								<th class="text-center">Mpio DIVIPOLA</th>
								<th class="text-center">Zona</th>
								<th class="text-center">Nombre Contacto</th>
							</tr>
						</thead>
						<tbody>							
						<?php
							foreach ($info as $lista):
									echo "<tr>";
									echo "<td>" . $lista['nombre_sitio'] . "</td>";
									echo "<td>" . $lista['direccion_sitio'] . "</td>";
									echo "<td>" . $lista['barrio_sitio'] . "</td>";
									echo "<td class='text-center'>";
						?>
									<button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal" id="<?php echo $lista['id_sitio']; ?>" >
										Editar <span class="glyphicon glyphicon-edit" aria-hidden="true">
									</button>
						<?php
									echo "</td>";
									echo "<td class='text-center'>" . $lista['telefono_sitio'] . "</td>";
									echo "<td class='text-center'>" . $lista['fax_sitio'] . "</td>";
									echo "<td class='text-center'>" . $lista['celular_sitio'] . "</td>";
									echo "<td>" . $lista['email_sitio'] . "</td>";
									echo "<td class='text-center'>" . $lista['codigo_postal_sitio'] . "</td>";
									echo "<td>" . $lista['nombre_organizacion'] . "</td>";
									echo "<td>" . $lista['nombre_region'] . "</td>";
									echo "<td>" . $lista['dpto_divipola_nombre'] . "</td>";
									echo "<td>" . $lista['mpio_divipola_nombre'] . "</td>";
									echo "<td>" . $lista['nombre_zona'] . "</td>";
									echo "<td>" . $lista['cotacto_nombres'] . " " . $lista['cotacto_apellidos'] . "</td>";
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
		"pageLength": 25
	});
});
</script>