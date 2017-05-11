<script type="text/javascript" src="<?php echo base_url("assets/js/validate/admin/alerta.js"); ?>"></script>

<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="exampleModalLabel">Alerta
	<br><small>Adicionar/Editar Alertas</small>
	</h4>
</div>

<div class="modal-body">
	<form name="form" id="form" role="form" method="post" >
		<input type="hidden" id="hddId" name="hddId" value="<?php echo $information?$information[0]["id_alerta"]:""; ?>"/>
		
		<div class="form-group text-left">
			<label class="control-label" for="descripcion">Descripción : *</label>
			<textarea id="descripcion" name="descripcion" class="form-control" rows="3"><?php echo $information?$information[0]["descripcion_alerta"]:""; ?></textarea>
		</div>
		
		<div class="form-group text-left">
			<label for="type" class="control-label">Tipo de Alerta : *</label>
			<select name="tipoAlerta" id="tipoAlerta" class="form-control" >
				<option value=''>Select...</option>
				<?php for ($i = 0; $i < count($tipoAlerta); $i++) { ?>
					<option value="<?php echo $tipoAlerta[$i]["id_tipo_alerta"]; ?>" <?php if($information[0]["fk_id_tipo_alerta"] == $tipoAlerta[$i]["id_tipo_alerta"]) { echo "selected"; }  ?>><?php echo $tipoAlerta[$i]["nombre_tipo_alerta"]; ?></option>	
				<?php } ?>
			</select>
		</div>
		
		<div class="form-group text-left">
			<label class="control-label" for="mensaje">Mensaje : *</label>
			<textarea id="mensaje" name="mensaje" class="form-control" rows="3"><?php echo $information?$information[0]["mensaje_alerta"]:""; ?></textarea>
		</div>

<script>
	$( function() {
		$( "#fechaAlerta" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'yy-mm-dd'
		});
	});
</script>
		<div class="form-group text-left">
			<label class="control-label" for="fechaAlerta">Fecha Alerta : *</label>
			<input type="text" class="form-control" id="fechaAlerta" name="fechaAlerta" value="<?php echo $information?$information[0]["fecha_alerta"]:""; ?>" placeholder="Fecha Alerta" required />
		</div>
		
		<div class="form-group text-left">
			
			<?php 
				if($information){
					$time = explode(":",$information["hora_alerta"]);
					$hour = $time[0];
					$min = $time[1];
				}
			?>
			<div class="col-sm-6">
				<label for="type" class="control-label">Hora : *</label>
				<select name="hour" id="hour" class="form-control" required>
					<option value='' >Select...</option>
					<?php
					for ($i = 0; $i < 24; $i++) {
						?>
						<option value='<?php echo $i; ?>' <?php
						if ($information && $i == $hour) {
							echo 'selected="selected"';
						}
						?>><?php echo $i; ?></option>
					<?php } ?>									
				</select>
			</div>
			
			<div class="col-sm-6">
				<label for="type" class="control-label">Min : *</label>
				<select name="min" id="min" class="form-control" required>
					<option value="00" <?php if($information && $min == "00") { echo "selected"; }  ?>>00</option>
					<option value="15" <?php if($information && $min == "15") { echo "selected"; }  ?>>15</option>
					<option value="30" <?php if($information && $min == "30") { echo "selected"; }  ?>>30</option>
					<option value="45" <?php if($information && $min == "45") { echo "selected"; }  ?>>45</option>
				</select>
			</div>
		</div>
		
		<div class="form-group text-left">
			<label for="type" class="control-label">Duración : *</label>
				<select name="duracion" id="duracion" class="form-control" required>
					<option value="00" <?php if($information && $min == "00") { echo "selected"; }  ?>>00</option>
					<option value="15" <?php if($information && $min == "15") { echo "selected"; }  ?>>15</option>
					<option value="30" <?php if($information && $min == "30") { echo "selected"; }  ?>>30</option>
					<option value="45" <?php if($information && $min == "45") { echo "selected"; }  ?>>45</option>
				</select>
		</div>

		<div class="form-group text-left">
			<label for="type" class="control-label">Rol : *</label>
			<select name="rol" id="rol" class="form-control" >
				<option value=''>Select...</option>
				<?php for ($i = 0; $i < count($roles); $i++) { ?>
					<option value="<?php echo $roles[$i]["id_rol"]; ?>" <?php if($information[0]["fk_id_rol"] == $roles[$i]["id_rol"]) { echo "selected"; }  ?>><?php echo $roles[$i]["nombre_rol"]; ?></option>	
				<?php } ?>
			</select>
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