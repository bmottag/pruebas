<script type="text/javascript" src="<?php echo base_url("assets/js/validate/anulaciones/anulaciones.js"); ?>"></script>

<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="exampleModalLabel">Formulario de Anulaciones
	<br><small>Adicionar/Editar Anulaciones</small>
	</h4>
</div>

<div class="modal-body">

	<p class="text-danger text-left">Los campos con * son obligatorios.</p>

	<form name="form" id="form" role="form" method="post" >
		<input type="hidden" id="hddId" name="hddId" value="<?php echo $information?$information[0]["id_anulacion"]:""; ?>"/>
		<input type="hidden" id="hddIdSitio" name="hddIdSitio" value="<?php echo $infoSitoDelegado[0]["id_sitio"]; ?>"/>
		<input type="hidden" id="hddIdMunicipio" name="hddIdMunicipio" value="<?php echo $infoSitoDelegado[0]["fk_mpio_divipola"]; ?>"/>
		<input type="hidden" id="hddCodigoDane" name="hddCodigoDane" value="<?php echo $infoSitoDelegado[0]["codigo_dane"]; ?>"/>
		
		<div class="row">
			<div class="col-sm-12">
				<div class="form-group text-left">
					<label for="type" class="control-label">Prueba / Grupo de Instrumentos / Fecha / Sesión : *</label>
					<select name="sesion" id="sesion" class="form-control" >
						<option value=''>Select...</option>
						<?php for ($i = 0; $i < count($infoSesiones); $i++) { ?>
							<option value="<?php echo $infoSesiones[$i]["id_sesion"]; ?>" <?php if($information[0]["fk_id_sesion"] == $infoSesiones[$i]["id_sesion"]) { echo "selected"; }  ?>><?php echo $infoSesiones[$i]["nombre_prueba"] . " / " . $infoSesiones[$i]["nombre_grupo_instrumentos"] . " / " . $infoSesiones[$i]["fecha"] . " / " . $infoSesiones[$i]["sesion_prueba"]; ?></option>	
						<?php } ?>
					</select>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-sm-12">
				<div class="form-group text-left">
					<label for="type" class="control-label">Motivo anulación : *</label>
					<select name="motivo" id="motivo" class="form-control" >
						<option value=''>Select...</option>
						<?php for ($i = 0; $i < count($motivos); $i++) { ?>
							<option value="<?php echo $motivos[$i]["id_motivo_anulacion"]; ?>" <?php if($information[0]["fk_id_motivo"] == $motivos[$i]["id_motivo_anulacion"]) { echo "selected"; }  ?>><?php echo $motivos[$i]["nombre_motivo_anulacion"]; ?></option>	
						<?php } ?>
					</select>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-sm-6 text-left">
				<label class="control-label text-left" for="consecutivo">Registro examinando : *</label>
			</div>
			
			<div class="col-sm-6 text-left">
				<label class="control-label text-left" for="confirmarConsecutivo">Confirmar registro examinando : *</label>
			</div>
		</div>
			
			
	<?php if(!$information){ ?>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group input-group">
					<span class="input-group-addon">SNP</span>
					<input type="password" id="consecutivo" name="consecutivo" class="form-control" value="" placeholder="Registro" required >
				</div>
			</div>

			<div class="col-sm-6">
				<div class="form-group input-group">
					<span class="input-group-addon">SNP</span>
					<input type="password" id="confirmarConsecutivo" name="confirmarConsecutivo" class="form-control" value="" placeholder="Confirmar" required >
				</div>
			</div>
		</div>
		
	<?php }else{ ?>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group input-group">
					<span class="input-group-addon">SNP</span>
					<input type="text" id="consecutivo" name="consecutivo" class="form-control" value="<?php echo $information?$information[0]["consecutivo"]:""; ?>" placeholder="Registro" required >
				</div>
			</div>

			<div class="col-sm-6">
				<div class="form-group input-group">
					<span class="input-group-addon">SNP</span>
					<input type="text" id="confirmarConsecutivo" name="confirmarConsecutivo" class="form-control" value="<?php echo $information?$information[0]["consecutivo"]:""; ?>" placeholder="Confirmar" required >
				</div>
			</div>
		</div>
	<?php } ?>
				
		<div class="row">
			<div class="col-sm-12">
				<div class="form-group text-left">
					<label class="control-label" for="observacion">Observación : *</label>
					<textarea id="observacion" name="observacion" class="form-control" rows="1"><?php echo $information?$information[0]["observacion"]:""; ?></textarea>
				</div>
			</div>
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
				<div class="alert alert-danger"><span class="glyphicon glyphicon-remove" id="span_msj"></span></div>
			</div>	
		</div>
			
	</form>
</div>