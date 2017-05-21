<script type="text/javascript" src="<?php echo base_url("assets/js/validate/admin/asignar_delegado.js"); ?>"></script>

<div id="page-wrapper">

	<br>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4 class="list-group-item-heading">
						<i class="fa fa-gear fa-fw"></i> CONFIGURACIONES - SITIO
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
					<i class="fa fa-gears"></i> Asignar <?php echo $rol; ?>
				</div>
				<div class="panel-body">

					<form  name="form" id="form" class="form-horizontal" method="post" action="<?php echo base_url("admin/guardar_delegado"); ?>" >
						<input type="hidden" id="hddId" name="hddId" value="<?php echo $infoSitio[0]["id_sitio"]; ?>"/>
						<input type="hidden" id="hddRol" name="hddRol" value="<?php echo $rol; ?>"/>
						
					<div class="row">
						<div class="col-lg-12">
						
							<div class="row" align="center">
								<div style="width:50%;" align="center">
									<div class="alert alert-success">
										<strong>NOMBRE SITIO: </strong>
										<?php echo $infoSitio[0]['nombre_sitio']; ?>
										<br><strong>DIRECCIÓN: </strong>
										<?php echo $infoSitio[0]['direccion_sitio']; ?>
										<br><strong>REGIÓN: </strong>
										<?php echo $infoSitio[0]['nombre_region']; ?>
										<br><strong>DEPARTAMENTO: </strong>
										<?php echo $infoSitio[0]['dpto_divipola_nombre']; ?>
										<br><strong>MUNICIPIO: </strong>
										<?php echo $infoSitio[0]['mpio_divipola_nombre']; ?>
										
<?php if($infoSitio[0]['fk_id_user_delegado']){  ?>
										<br><strong>DELEGADO C.C.: </strong>
										<?php echo $infoSitio[0]['delegado']; ?>
<?php } ?>
										
<?php if($infoSitio[0]['fk_id_user_delegado']){  ?>
										<br><strong>COORDINADOR C.C.: </strong>
										<?php echo $infoSitio[0]['coordinador']; ?>
<?php } ?>
										
									</div>
								</div>
							</div>		
						
						</div>
					</div>

						<div class="form-group">
							<label class="col-sm-4 control-label" for="usuario">Usuario</label>
							<div class="col-sm-5">

							<?php if($usuarios){ ?>
								
							<select name="usuario" id="usuario" class="form-control" >
								<option value=''>Select...</option>
								<?php for ($i = 0; $i < count($usuarios); $i++) { ?>
									<option value="<?php echo $usuarios[$i]["id_usuario"]; ?>" <?php if($infoSitio[0]["fk_id_user_". $rol] == $usuarios[$i]["id_usuario"]) { echo "selected"; }  ?>><?php echo $usuarios[$i]["nombres_usuario"] . " " . $usuarios[$i]["apellidos_usuario"] . " C.C." . $usuarios[$i]["numero_documento"]; ?></option>
								<?php } ?>
							</select>
							
							<?php }else{ 
									echo "No hay " .  $rol . " disponible."; 
							} ?>
							
							
							</div>
						</div>
												
						<div class="row" align="center">
							<div style="width:50%;" align="center">
								 <button type="submit" class="btn btn-primary" id='btnSubmit' name='btnSubmit'>Guardar </button>
							</div>
						</div>

					</form>

				</div>
				<!-- /.row (nested) -->
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
