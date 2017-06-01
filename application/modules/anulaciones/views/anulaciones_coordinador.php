<script type="text/javascript" src="<?php echo base_url("assets/js/validate/anulaciones/anulaciones.js"); ?>"></script>

<script>
$(function(){ 
	$(".btn-success").click(function () {	
			var oID = $(this).attr("id");
            $.ajax ({
                type: 'POST',
				url: base_url + '/anulaciones/cargarModalAprobarAnulacion',
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
					<i class="fa fa-bug fa-fw"></i> ANULACIONES
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
					<i class="fa fa-bug"></i> LISTA DE ANULACIONES
				</div>
				<div class="panel-body">
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
								<th class="text-center">Aprobar</th>
								<th class="text-center">Evidencia</th>
								<th class="text-center">Acta</th>

								<th class="text-center">Motivo anulación</th>
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
									<button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal" id="<?php echo $lista['id_anulacion']; ?>" >
										Aprobar <span class="glyphicon glyphicon-edit" aria-hidden="true">
									</button>
									
									
						<?php
									echo "</td>";
									
								echo "<td class='text-center'>";
								
								if($lista["evidencia"])
								{ 
						?>
<img src="<?php echo base_url($lista["evidencia"]); ?>" class="img-rounded" alt="Evidencia" width="50" height="50" />
						<?php 
								} 

								echo "</td>";
								
								echo "<td class='text-center'>";
								
								if($lista["acta"])
								{ 
						?>
<img src="<?php echo base_url($lista["acta"]); ?>" class="img-rounded" alt="Acta" width="50" height="50" />
						<?php 
								} 

								echo "</td>";

									
									
									
									echo "<td>" . $lista['nombre_motivo_anulacion'] . "</td>";
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
		
<!--INICIO Modal -->
<div class="modal fade text-center" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">    
	<div class="modal-dialog" role="document">
		<div class="modal-content" id="tablaDatos">

		</div>
	</div>
</div>                       
<!--FIN Modal -->

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