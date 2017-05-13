<script type="text/javascript" src="<?php echo base_url("assets/js/validate/admin/asignar.js"); ?>"></script>

<div id="page-wrapper">

	<br>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4 class="list-group-item-heading">
						<i class="fa fa-gear fa-fw"></i> CONFIGURACIONES - ASIGNAR SITIO Y PRUEBA
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
					<i class="fa fa-gears"></i> ASIGNAR SITIO Y PRUEBA
				</div>
				<div class="panel-body">

					<form  name="form" id="form" class="form-horizontal" method="post" action="<?php echo base_url("admin/guardar_sitio_prueba"); ?>" >
						<input type="hidden" id="hddId" name="hddId" value="<?php echo $infoUsuario[0]["id_usuario"]; ?>"/>
						<input type="hidden" id="hddUser" name="hddUser" value="<?php echo $infoUsuario[0]["numero_documento"]; ?>"/>
						
					<div class="row">
						<div class="col-lg-12">
						
							<div class="row" align="center">
								<div style="width:50%;" align="center">
									<div class="alert alert-success"> <span class="glyphicon glyphicon-pushpin">&nbsp;</span>
										<strong>Nombres Usuario: </strong>
										<?php echo $infoUsuario[0]['nombres_usuario'] . " " . $infoUsuario[0]['apellidos_usuario']; ?>
										<br><strong>Número de documento: </strong>
										<?php echo $infoUsuario[0]['numero_documento']; ?>
									</div>
								</div>
							</div>	
						
						</div>
					</div>

						
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword">Sitio</label>
							<div class="col-sm-5">
								<select name="sitio" id="sitio" class="form-control" >
									<option value=''>Select...</option>
									<?php for ($i = 0; $i < count($infoSitios); $i++) { ?>
										<option value="<?php echo $infoSitios[$i]["id_sitio"]; ?>" <?php if($infoUsuario[0]["fk_id_sitio"] == $infoSitios[$i]["id_sitio"]) { echo "selected"; }  ?>><?php echo $infoSitios[$i]["nombre_sitio"]; ?></option>	
									<?php } ?>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputConfirm">Prueba</label>
							<div class="col-sm-5">
								<select name="prueba" id="prueba" class="form-control" >
									<option value=''>Select...</option>
									<?php for ($i = 0; $i < count($infoPruebas); $i++) { ?>
										<option value="<?php echo $infoPruebas[$i]["id_prueba"]; ?>" <?php if($infoUsuario[0]["fk_id_prueba"] == $infoPruebas[$i]["id_prueba"]) { echo "selected"; }  ?>><?php echo $infoPruebas[$i]["nombre_prueba"]; ?></option>	
									<?php } ?>
								</select>
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
