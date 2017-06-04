<script type="text/javascript" src="<?php echo base_url("assets/js/validate/anulaciones/anulaciones_aprobar.js"); ?>"></script>

<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="exampleModalLabel">Formulario para Aprobar Anulaciones
	</h4>
</div>

<div class="modal-body">

	<p class="text-danger text-left">Los campos con * son obligatorios.</p>

	<form name="form" id="form" role="form" method="post" >
		<input type="hidden" id="hddId" name="hddId" value="<?php echo $information?$information[0]["id_anulacion"]:""; ?>"/>

		<div class="form-group text-left">
			<label class="control-label" for="aprobar">Aprobar / Desaprobar</label>
			<select name="aprobar" id="aprobar" class="form-control" required>
				<option value="">Select...</option>
				<option value=1 <?php if($information[0]["aprobada"] == 1) { echo "selected"; }  ?>>Aprobar</option>
				<option value=2 <?php if($information[0]["aprobada"] == 2) { echo "selected"; }  ?>>Desaprobar</option>
			</select>
		</div>
						
		<div class="row">
			<div class="col-sm-12">
				<div class="form-group text-left">
					<label class="control-label" for="observacion">Observación : </label>
					<textarea id="observacion" name="observacion" class="form-control" rows="1"><?php echo $information?$information[0]["observacion_aprobacion"]:""; ?></textarea>
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