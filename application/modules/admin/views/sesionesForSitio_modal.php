<script type="text/javascript" src="<?php echo base_url("assets/js/validate/admin/sitio_sesion.js"); ?>"></script>

<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="exampleModalLabel">Asociar Sitio con Prueba / Grupo de Instrumento / Sesión
	<br><small>Adicionar/Editar</small>
	</h4>
</div>

<div class="modal-body">
	<form name="form" id="form" role="form" method="post" >
		<input type="hidden" id="hddIdSitio" name="hddIdSitio" value="<?php echo $idSitio; ?>"/>
		<input type="hidden" id="hddId" name="hddId" value="<?php echo $information?$information[0]["id_sitio_sesion"]:""; ?>"/>
		
		<div class="form-group text-left">
			<label for="type" class="control-label">Prueba / Grupo de Instrumento / Sesión : *</label>
			<select name="prueba" id="prueba" class="form-control" >
				<option value=''>Select...</option>
				<?php for ($i = 0; $i < count($infoPruebas); $i++) { ?>
					<option value="<?php echo $infoPruebas[$i]["id_prueba"]; ?>" <?php if($information[0]["fk_id_sesion"] == $infoPruebas[$i]["id_prueba"]) { echo "selected"; }  ?>><?php echo $infoPruebas[$i]["nombre_prueba"] . "/" . $infoPruebas[$i]["nombre_grupo_instrumentos"] . "/" . $infoPruebas[$i]["sesion_prueba"]; ?></option>	
				<?php } ?>
			</select>
		</div>

		<div class="form-group text-left">
			<label for="type" class="control-label">Citados : *</label>
			<input type="text" id="citados" name="citados" class="form-control" value="<?php echo $information?$information[0]["numero_citados"]:""; ?>" placeholder="Citados" required >
		</div>
		

		<div class="form-group">
			<div class="row" align="center">
				<div style="width:50%;" align="center">
					<input type="button" id="btnSubmit" name="btnSubmit" value="Guardar" class="btn btn-primary"/>
				</div>
			</div>
		</div>
		
		<div class="form-group">
			<div id="div_load" style="display:none">		
				<div class="progress progress-striped active">
					<div class="progress-bar" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
						<span class="sr-only">45% completado</span>
					</div>
				</div>
			</div>
			<div id="div_error" style="display:none">			
				<div class="alert alert-danger"><span class="glyphicon glyphicon-remove" id="span_msj">&nbsp;</span></div>
			</div>	
		</div>
			
	</form>
</div>