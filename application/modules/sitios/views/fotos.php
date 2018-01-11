<div id="page-wrapper">
	<br>

	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-warning">
				<div class="panel-heading">
					<a class="btn btn-warning btn-xs" href=" <?php echo base_url().'sitios/salones/' . $idSitio; ?> "><span class="glyphicon glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Regresar </a> 
					<i class="fa fa-photo"></i> Fotos
				</div>
				<div class="panel-body">
					
					<div class="col-lg-6">	
						<div class="alert alert-warning">
							<strong>Sitio: </strong><?php echo $infoSitio[0]['nombre_sitio']; ?><br>
							<strong>Código DANE: </strong><?php echo $infoSitio[0]['codigo_dane']; ?><br>
						</div>
					</div>
					<div class="col-lg-6">	
						<div class="alert alert-warning">
							<strong>Departemanto: </strong><?php echo $infoSitio[0]['dpto_divipola_nombre']; ?><br>
							<strong>Municipio: </strong><?php echo $infoSitio[0]['mpio_divipola_nombre']; ?>
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
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-warning">

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

		<form  name="form_map" id="form_map" class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url("sitios/do_upload_fotos"); ?>">
		<input type="hidden" id="hddIdSitio" name="hddIdSitio" value="<?php echo $idSitio; ?>"/>
				
				<div class="form-group">
					<label class="col-sm-4 control-label" for="description">Description: *</label>
					<div class="col-sm-5">
						<input type="text" class="form-control" id="description" name="description" />
					</div>
				</div>
				
				<div class="col-lg-6">				
					<div class="form-group">					
						<label class="col-sm-5 control-label" for="hddTask">Adjuntar imagen</label>
						<div class="col-sm-5">
							 <input type="file" name="userfile" />
						</div>
					</div>
				</div>
					
				<div class="col-lg-6">				
					<div class="form-group">
						<div class="row" align="center">
							<div style="width:50%;" align="center">
								<button type="submit" id="btnSubmit" name="btnSubmit" class='btn btn-primary'>
										Save <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true">
								</button>
							</div>
						</div>
					</div>
				</div>
		</form>

					<?php if($error){ ?>
					<div class="col-lg-12">
						<div class="alert alert-danger">
						<?php 
							echo "<strong>Error :</strong>";
							pr($error); 
						?><!--$ERROR MUESTRA LOS ERRORES QUE PUEDAN HABER AL SUBIR LA IMAGEN-->
						</div>
					</div>
					<?php } ?>
					
				<div class="col-lg-12">
					<div class="alert alert-danger">
							<strong>Nota :</strong><br>
							Formato permitido: gif - jpg - png<br>
							Tamaño máximo: 3000 KB<br>
							Tamaño mínimo: 2024 pixels<br>
							Peso máximo: 2008 pixels<br>
							
					</div>
				</div>

					<?php 
						if($fotos){
					?>
					<table class="table table-bordered table-striped table-hover table-condensed">
						<tr class="dafault">
							<td><p class="text-center"><strong>Descripción</strong></p></td>
							<td><p class="text-center"><strong>Foto</strong></p></td>
							<td><p class="text-center"><strong>Eliminar</strong></p></td>
						</tr>
						<?php
							foreach ($fotos as $data):
								echo "<tr>";					
								echo "<td ><small>" . $data['descripcion_foto'] . "</small></td>";
								echo "<td class='text-center'><center>";

?>
<a href="<?php echo base_url( $data['foto_sitio']) ?>" target="_blank">Foto</a>
<?php 

								echo "</center></td>";
								echo "<td class='text-center'><small>";
						?>
							<center>
							<a class='btn btn-danger' href='<?php echo base_url('sitios/deleteFoto/' . $data['id_sitio_foto'] . '/' . $data['fk_id_sitio']) ?>' id="btn-delete">
									<span class="glyphicon glyphicon-remove" aria-hidden="true"> </span>  Delete
							</a>
							</center>
						<?php
								echo "</small></td>";                     
								echo "</tr>";
							endforeach;
						?>
					</table>
					<?php } ?>
					<!--FIN HAZARDS -->
					
					<!-- /.row (nested) -->
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