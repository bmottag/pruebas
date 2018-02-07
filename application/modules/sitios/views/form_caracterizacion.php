<script type="text/javascript" src="<?php echo base_url("assets/js/validate/sitios/ajaxSalones.js"); ?>"></script>

<div id="page-wrapper">
	<br>

	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-info">
				<div class="panel-heading">
					<a class="btn btn-info btn-xs" href=" <?php echo base_url().'sitios'; ?> "><span class="glyphicon glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Regresar </a> 
					<i class="fa fa-cube"></i> <strong>Caracterización</strong>
				</div>
				<div class="panel-body">
					
					<div class="col-lg-6">	
						<div class="alert alert-info">
							<strong>Sitio: </strong><?php echo $infoSitio[0]['nombre_sitio']; ?><br>
							<strong>Código DANE: </strong><?php echo $infoSitio[0]['codigo_dane']; ?>
						</div>
					</div>
					<div class="col-lg-6">	
						<div class="alert alert-info">
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
					<strong>Accesibilidad</strong>
				</div>
				<div class="panel-body">

					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label class="col-sm-4 control-label" for="ubicacion">Ubicación: *</label>
								<div class="col-sm-5">
					<label class="radio-inline">
						<input type="radio" name="ubicacion" id="ubicacion1" value=1 <?php if($information && $information[0]["ubicacion"] == 1) { echo "checked"; }  ?>>Rural
					</label>
					<label class="radio-inline">
						<input type="radio" name="ubicacion" id="ubicacion2" value=2 <?php if($information && $information[0]["ubicacion"] == 2) { echo "checked"; }  ?>>Urbano
					</label>
								</div>
							</div>
						</div>
							
						<div class="col-lg-6">	
							<div class="form-group">
								<label class="col-sm-4 control-label" for="forma_transporte">Forma de transporte: *</label>
								<div class="col-sm-5">
					<label class="radio-inline">
						<input type="radio" name="forma_transporte" id="forma_transporte1" value=1 <?php if($information && $information[0]["forma_transporte"] == 1) { echo "checked"; }  ?>>Directo
					</label>
					<label class="radio-inline">
						<input type="radio" name="forma_transporte" id="forma_transporte2" value=2 <?php if($information && $information[0]["forma_transporte"] == 2) { echo "checked"; }  ?>>Mixto
					</label>								
								</div>
							</div>
						</div>

					</div>
				
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label class="col-sm-4 control-label" for="transporte">Tipo de transporte: *</label>
								<div class="col-sm-5">
									<select name="transporte" id="transporte" class="form-control" required>
										<option value=''>Select...</option>
										<option value=1 <?php if($information[0]["transporte"] == 1) { echo "selected"; }  ?>>Bus</option>
										<option value=2 <?php if($information[0]["transporte"] == 2) { echo "selected"; }  ?>>Lancha</option>
										<option value=3 <?php if($information[0]["transporte"] == 3) { echo "selected"; }  ?>>Taxi</option>
										<option value=4 <?php if($information[0]["transporte"] == 4) { echo "selected"; }  ?>>Transporte animal</option>
										<option value=5 <?php if($information[0]["transporte"] == 5) { echo "selected"; }  ?>>Moto taxi</option>
										<option value=6 <?php if($information[0]["transporte"] == 6) { echo "selected"; }  ?>>Vehículo</option>
										<option value=7 <?php if($information[0]["transporte"] == 7) { echo "selected"; }  ?>>Bici taxi</option>
										<option value=8 <?php if($information[0]["transporte"] == 8) { echo "selected"; }  ?>>Peatonal a partir de 1km</option>
									</select>
								</div>
							</div>
						</div>
							
						<div class="col-lg-6">	
							<div class="form-group">
								<label class="col-sm-4 control-label" for="vias">Vias de acceso: *</label>
								<div class="col-sm-5">
									<select name="vias" id="vias" class="form-control" required>
										<option value=''>Select...</option>
										<option value=1 <?php if($information[0]["vias"] == 1) { echo "selected"; }  ?>>Terrestre</option>
										<option value=2 <?php if($information[0]["vias"] == 2) { echo "selected"; }  ?>>Fluvial</option>
										<option value=3 <?php if($information[0]["vias"] == 3) { echo "selected"; }  ?>>Aéreo</option>
									</select>								
								</div>
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">				
			<div class="panel panel-info">
				<div class="panel-heading">
					<strong>Seguridad</strong>
				</div>
				<div class="panel-body">

					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label class="col-sm-4 control-label" for="riesgo">Riesgo del entorno: *</label>
								<div class="col-sm-5">
									<select name="riesgo" id="riesgo" class="form-control" required>
										<option value=''>Select...</option>
										<option value=1 <?php if($information[0]["riesgo"] == 1) { echo "selected"; }  ?>>Alto</option>
										<option value=2 <?php if($information[0]["riesgo"] == 2) { echo "selected"; }  ?>>Medio</option>
										<option value=3 <?php if($information[0]["riesgo"] == 3) { echo "selected"; }  ?>>Bajo</option>
										<option value=4 <?php if($information[0]["riesgo"] == 4) { echo "selected"; }  ?>>Ninguno</option>
									</select>
								</div>
							</div>
						</div>
							
						<div class="col-lg-6">	
							<div class="form-group">
								<label class="col-sm-4 control-label" for="cerramientos">Cerramientos: *</label>
								<div class="col-sm-5">
									<label class="radio-inline">
										<input type="radio" name="cerramientos" id="cerramientos1" value=1 <?php if($information && $information[0]["cerramientos"] == 1) { echo "checked"; }  ?>>Tiene
									</label>
									<label class="radio-inline">
										<input type="radio" name="cerramientos" id="cerramientos2" value=2 <?php if($information && $information[0]["cerramientos"] == 2) { echo "checked"; }  ?>>No tiene
									</label>
								</div>
							</div>
						</div>

					</div>
				
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label class="col-sm-4 control-label" for="vigilancia_privada">Vigilancia privada: *</label>
								<div class="col-sm-5">
									<label class="radio-inline">
										<input type="radio" name="vigilancia_privada" id="vigilancia_privada1" value=1 <?php if($information && $information[0]["vigilancia_privada"] == 1) { echo "checked"; }  ?>>Tiene
									</label>
									<label class="radio-inline">
										<input type="radio" name="vigilancia_privada" id="vigilancia_privada2" value=2 <?php if($information && $information[0]["vigilancia_privada"] == 2) { echo "checked"; }  ?>>No tiene
									</label>
								</div>
							</div>
						</div>
							
						<div class="col-lg-6">	
							<div class="form-group">
								<label class="col-sm-4 control-label" for="camaras">Cámaras de seguridad: *</label>
								<div class="col-sm-5">
									<label class="radio-inline">
										<input type="radio" name="camaras" id="camaras1" value=1 <?php if($information && $information[0]["camaras"] == 1) { echo "checked"; }  ?>>Tiene
									</label>
									<label class="radio-inline">
										<input type="radio" name="camaras" id="camaras2" value=2 <?php if($information && $information[0]["camaras"] == 2) { echo "checked"; }  ?>>No tiene
									</label>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">				
			<div class="panel panel-info">
				<div class="panel-heading">
					<strong>Infraestructura </strong>
				</div>
				<div class="panel-body">

					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label class="col-sm-4 control-label" for="baterias">Baterías sanitarias: *</label>
								<div class="col-sm-5">
									<select name="baterias" id="baterias" class="form-control" required>
										<option value='' >Select...</option>
										<?php
										for ($i = 0; $i < 30; $i++) {
											?>
											<option value='<?php echo $i; ?>' <?php
											if ($information && $i == $hour) {
												echo 'selected="selected"';
											}
											?>><?php echo $i; ?></option>
										<?php } ?>									
									</select>
								</div>
							</div>
						</div>
							
						<div class="col-lg-6">	
							<div class="form-group">
								<label class="col-sm-4 control-label" for="discapacitados">Acceso a Discapacitados: *</label>
								<div class="col-sm-5">
									<label class="radio-inline">
										<input type="radio" name="discapacitados" id="discapacitados1" value=1 <?php if($information && $information[0]["cerramientos"] == 1) { echo "checked"; }  ?>>Si
									</label>
									<label class="radio-inline">
										<input type="radio" name="discapacitados" id="discapacitados2" value=2 <?php if($information && $information[0]["cerramientos"] == 2) { echo "checked"; }  ?>>No
									</label>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label class="col-sm-4 control-label" for="baterias_discapacitados">Baterías Sanitarias para discapacitados: *</label>
								<div class="col-sm-5">
									<select name="baterias_discapacitados" id="baterias_discapacitados" class="form-control" required>
										<option value='' >Select...</option>
										<?php
										for ($i = 0; $i < 30; $i++) {
											?>
											<option value='<?php echo $i; ?>' <?php
											if ($information && $i == $hour) {
												echo 'selected="selected"';
											}
											?>><?php echo $i; ?></option>
										<?php } ?>									
									</select>
								</div>
							</div>
						</div>
							
						<div class="col-lg-6">	
							<div class="form-group">
								<label class="col-sm-4 control-label" for="administrativa">Áreas administrativas: *</label>
								<div class="col-sm-5">
									<label class="radio-inline">
										<input type="radio" name="cerramientos" id="cerramientos1" value=1 <?php if($information && $information[0]["cerramientos"] == 1) { echo "checked"; }  ?>>Si
									</label>
									<label class="radio-inline">
										<input type="radio" name="cerramientos" id="cerramientos2" value=2 <?php if($information && $information[0]["cerramientos"] == 2) { echo "checked"; }  ?>>No
									</label>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label class="col-sm-4 control-label" for="fotocopiadoras">Fotocopiadoras: *</label>
								<div class="col-sm-5">
									<label class="radio-inline">
										<input type="radio" name="cerramientos" id="cerramientos1" value=1 <?php if($information && $information[0]["cerramientos"] == 1) { echo "checked"; }  ?>>Si
									</label>
									<label class="radio-inline">
										<input type="radio" name="cerramientos" id="cerramientos2" value=2 <?php if($information && $information[0]["cerramientos"] == 2) { echo "checked"; }  ?>>No
									</label>
								</div>
							</div>
						</div>
							
						<div class="col-lg-6">	
							<div class="form-group">
								<label class="col-sm-4 control-label" for="cafeteria_interna">Cafeterías internas *</label>
								<div class="col-sm-5">
									<label class="radio-inline">
										<input type="radio" name="cerramientos" id="cerramientos1" value=1 <?php if($information && $information[0]["cerramientos"] == 1) { echo "checked"; }  ?>>Si
									</label>
									<label class="radio-inline">
										<input type="radio" name="cerramientos" id="cerramientos2" value=2 <?php if($information && $information[0]["cerramientos"] == 2) { echo "checked"; }  ?>>No
									</label>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label class="col-sm-4 control-label" for="cafeteria_externa">Cafeterías externas: *</label>
								<div class="col-sm-5">
									<label class="radio-inline">
										<input type="radio" name="cerramientos" id="cerramientos1" value=1 <?php if($information && $information[0]["cerramientos"] == 1) { echo "checked"; }  ?>>Si
									</label>
									<label class="radio-inline">
										<input type="radio" name="cerramientos" id="cerramientos2" value=2 <?php if($information && $information[0]["cerramientos"] == 2) { echo "checked"; }  ?>>No
									</label>
								</div>
							</div>
						</div>
					</div>
				
					
				</div>
			</div>
		</div>
	</div>
	
	
</div>
<!-- /#page-wrapper -->