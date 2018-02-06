<script>
$(function(){ 
	
	$(".btn-primary").click(function () {	
			var oID = $(this).attr("id");
            $.ajax ({
                type: 'POST',
				url: base_url + 'sitios/cargarModalComputadores',
                data: {'idSalon': oID, 'idComputador': 'x'},
                cache: false,
                success: function (data) {
                    $('#tablaDatosComputador').html(data);
                }
            });
	});

	$(".btn-default").click(function () {	
			var oID = $(this).attr("id");
            $.ajax ({
                type: 'POST',
				url: base_url + 'sitios/cargarModalComputadores',
                data: {'idSalon': '', 'idComputador': oID},
                cache: false,
                success: function (data) {
                    $('#tablaDatosComputador').html(data);
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
					<a class="btn btn-info btn-xs" href=" <?php echo base_url().'sitios/salones/' . $idSitio; ?> "><span class="glyphicon glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Regresar </a> 
					<i class="glyphicon glyphicon-screenshot"></i> Salon
				</div>
				<div class="panel-body">
					
					<div class="col-lg-4">	
						<div class="alert alert-info">
							<strong>Sitio: </strong><?php echo $infoSitio[0]['nombre_sitio']; ?><br>
							<strong>Código DANE: </strong><?php echo $infoSitio[0]['codigo_dane']; ?><br>
						</div>
					</div>
					<div class="col-lg-4">	
						<div class="alert alert-info">
							<strong>Departemanto: </strong><?php echo $infoSitio[0]['dpto_divipola_nombre']; ?><br>
							<strong>Municipio: </strong><?php echo $infoSitio[0]['mpio_divipola_nombre']; ?>
						</div>
					</div>
					<div class="col-lg-4">	
						<div class="alert alert-info">
							<strong>Bloque: </strong><?php echo $inforSalon[0]['nombre_salon']; ?><br>
							<strong>Salón: </strong><?php echo $inforSalon[0]['nombre_bloque']; ?>
						</div>
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

	<div class="row">
		<div class="col-lg-12">				
			<div class="panel panel-info">
				<div class="panel-heading">
					<strong>Computadores</strong>
				</div>
				<div class="panel-body">
									
				<button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal_computador" id="<?php echo $infoSitio[0]['id_sitio']; ?>">
						<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar computador
				</button>					
					
<?php
	if($information){
?>
					<table width="100%" class="table table-striped table-hover" >
						<thead>
							<tr>
								<th class='text-center'>ID</th>
								<th class='text-center'>CPU</th>
								<th class='text-center'>OS</th>
								<th class='text-center'>Memoria del sistema</th>
								<th class='text-center'>Resolución de la pantalla</th>
								<th class='text-center'>¿Está funcionando Skype?</th>
								<th class='text-center'>Velocidad de transferecia de datos a la USB</th>
								<th class='text-center'>Virus SCAN</th>
								<th class='text-center'>Unidad USB </th>
								<th class='text-center'>¿El computador es adecuado? </th>
								<th class='text-center'>Edit</th>
							</tr>
						</thead>
						<tbody>							
						<?php
							foreach ($information as $lista):
							
									echo "<tr>";
									echo "<td class='text-center'>" . $lista['id_sitio_computador'] . "</td>";
									
									switch ($lista['cpu']) {
										case 1:
											$cpu = 'Ok';
											break;
										case 2:
											$cpu = 'Falló';
											break;
									}
									echo "<td class='text-center'>" . $cpu . "</td>";
									
									switch ($lista['os']) {
										case 1:
											$os = 'Ok';
											break;
										case 2:
											$os = 'Falló';
											break;
									}
									echo "<td class='text-center'>" . $os . "</td>";
									
									switch ($lista['memoria']) {
										case 1:
											$memoria = 'Ok';
											break;
										case 2:
											$memoria = 'Al límite';
											break;
										case 3:
											$memoria = 'Falló';
											break;
									}
									echo "<td class='text-center'>" . $memoria . "</td>";
									
									switch ($lista['resolucion']) {
										case 1:
											$resolucion = 'Ok';
											break;
										case 2:
											$resolucion = 'Falló';
											break;
									}
									echo "<td class='text-center'>" . $resolucion . "</td>";
									
									switch ($lista['skype']) {
										case 1:
											$skype = 'Ok';
											break;
										case 2:
											$skype = 'Falló';
											break;
									}
									echo "<td class='text-center'>" . $skype . "</td>";
									
									switch ($lista['transferencia_usb']) {
										case 1:
											$transferencia_usb = 'Ok';
											break;
										case 2:
											$transferencia_usb = 'Falló';
											break;
									}
									echo "<td class='text-center'>" . $transferencia_usb . "</td>";
									
									switch ($lista['virus_scan']) {
										case 1:
											$virus_scan = 'Ok';
											break;
										case 2:
											$virus_scan = 'Falló';
											break;
									}
									echo "<td class='text-center'>" . $virus_scan . "</td>";
									
									switch ($lista['unidad_usb']) {
										case 1:
											$unidad_usb = 'Ok';
											break;
										case 2:
											$unidad_usb = 'Falló, pero se corrigió';
											break;
										case 3:
											$unidad_usb = 'Falló';
											break;
									}
									echo "<td class='text-center'>" . $unidad_usb . "</td>";
									
									switch ($lista['adecuado']) {
										case 1:
											$adecuado = 'Ok';
											break;
										case 2:
											$adecuado = 'Falló';
											break;
									}
									echo "<td class='text-center'>" . $adecuado . "</td>";
									
									echo "<td class='text-center'>";									
						?>
									<button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modal_computador" id="<?php echo $lista['id_sitio_computador']; ?>" >
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
					
				</div>
			</div>
		</div>
	</div>


</div>
<!-- /#page-wrapper -->

<!--INICIO Modal Computadores-->
<div class="modal fade text-center" id="modal_computador" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">    
	<div class="modal-dialog" role="document">
		<div class="modal-content" id="tablaDatosComputador">

		</div>
	</div>
</div>                       
<!--FIN Modal Computadores-->