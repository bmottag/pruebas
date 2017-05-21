<script type="text/javascript" src="<?php echo base_url("assets/js/validate/admin/contacto_sitio.js"); ?>"></script>

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
					<i class="fa fa-gears"></i> Contacto del Sitio
				</div>
				<div class="panel-body">

					<form  name="form" id="form" class="form-horizontal" method="post" action="<?php echo base_url("admin/guardar_contacto"); ?>" >
						<input type="hidden" id="hddId" name="hddId" value="<?php echo $infoSitio[0]["id_sitio"]; ?>"/>
						
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
									</div>
								</div>
							</div>		
						
						</div>
					</div>

						<div class="form-group">
							<label class="col-sm-4 control-label" for="nombres">Nombres</label>
							<div class="col-sm-5">
								<input type="text" id="nombres" name="nombres" class="form-control" value="<?php echo $infoSitio?$infoSitio[0]["contacto_nombres"]:""; ?>" placeholder="Nombres" required >
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label" for="apellidos">Apellidos</label>
							<div class="col-sm-5">
								<input type="text" id="apellidos" name="apellidos" class="form-control" value="<?php echo $infoSitio?$infoSitio[0]["contacto_apellidos"]:""; ?>" placeholder="Apellidos" required >
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label" for="telefono">Teléfono fijo</label>
							<div class="col-sm-5">
								<input type="text" id="telefono" name="telefono" class="form-control" value="<?php echo $infoSitio?$infoSitio[0]["contacto_telefono"]:""; ?>" placeholder="Teléfono fijo" >
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label" for="movilNumber">Celular</label>
							<div class="col-sm-5">
								<input type="text" id="movilNumber" name="movilNumber" class="form-control" value="<?php echo $infoSitio?$infoSitio[0]["contacto_celular"]:""; ?>" placeholder="Celular" required >
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label" for="email">Email</label>
							<div class="col-sm-5">
								<input type="text" class="form-control" id="email" name="email" value="<?php echo $infoSitio?$infoSitio[0]["contacto_email"]:""; ?>" placeholder="Email" />
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
