<script type="text/javascript" src="<?php echo base_url("assets/js/validate/password.js"); ?>"></script>

<div id="page-wrapper">

	<br>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4 class="list-group-item-heading">
						<i class="fa fa-gear fa-fw"></i> CONFIGURACIONES - CAMBIAR CONTRASEÑA
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
					<a class="btn btn-success" href=" <?php echo base_url(). 'admin/users'; ?> "><span class="glyphicon glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Regresar </a> 
					<i class="fa fa-unlock"></i> CAMBIAR CONTRASEÑA
				</div>
				<div class="panel-body">

					<form  name="form" id="form" class="form-horizontal" method="post" action="<?php echo base_url("admin/update_password"); ?>" >
						<input type="hidden" id="hddId" name="hddId" value="<?php echo $information[0]["id_usuario"]; ?>"/>
						<input type="hidden" id="hddUser" name="hddUser" value="<?php echo $information[0]["numero_documento"]; ?>"/>
						
						<div class="form-group">
							<label class="col-sm-4 control-label" for="firstName">Nombres</label>
							<div class="col-sm-5">
								<input type="text" id="firstName" name="firstName" class="form-control" value="<?php echo $information[0]['nombres_usuario']; ?>" disabled >
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label" for="lastName">Apelidos</label>
							<div class="col-sm-5">
								<input type="text" id="lastName" name="lastName" class="form-control" value="<?php echo $information[0]['apellidos_usuario']; ?>" disabled >
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label" for="username">Número de documento</label>
							<div class="col-sm-5">
								<input type="text" id="user" name="user" class="form-control" value="<?php echo $information[0]['numero_documento']; ?>" disabled >
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword">Contraseña</label>
							<div class="col-sm-5">
								<input type="text" id="inputPassword" name="inputPassword" class="form-control" >
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputConfirm">Confirmar contraseña</label>
							<div class="col-sm-5">
								<input type="text" id="inputConfirm" name="inputConfirm" class="form-control" >
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
