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
					<i class="fa fa-gears"></i> Respuesta Alerta por el Coordinador 
				</div>
				<div class="panel-body">
				
		<div class="col-lg-6">				
			<div class="panel panel-danger">
				<div class="panel-heading">
					<i class="fa fa-calendar fa-fw"></i> ALERTA
				</div>
				<div class="panel-body">
					<div class="col-lg-12">	
						
						<div class="alert alert-danger ">
							<strong>Descripción Alerta: </strong><?php echo $info[0]['descripcion_alerta']; ?><br>
							<strong>Mensaje Alerta: </strong><?php echo $info[0]['mensaje_alerta']; ?><br>
							<strong>Nombre de Prueba: </strong><?php echo $info[0]['nombre_prueba']; ?><br>
							<strong>Grupo Instrumentos: </strong><?php echo $info[0]['nombre_grupo_instrumentos']; ?><br>
							<strong>Fecha: </strong><?php echo $info[0]['fecha']; ?><br>
							<strong>Sesión Prueba: </strong><?php echo $info[0]['sesion_prueba']; ?><br>
							<strong>Número de Citados: </strong><?php echo $info[0]['numero_citados']; ?><br>
					<br>
<form  name="form" id="<?php echo "form_" . $info[0]["id_sitio_sesion"]; ?>" class="form-horizontal" method="post" action="<?php echo base_url("report/registro_informativo_by_coordinador"); ?>" >
	<input type="hidden" id="hddIdAlerta" name="hddIdAlerta" value="<?php echo $info[0]["id_alerta"]; ?>"/>
	<input type="hidden" id="hddIdSitioSesion" name="hddIdSitioSesion" value="<?php echo $info[0]["id_sitio_sesion"]; ?>"/>
	<input type="hidden" id="hddIdUserDelegado" name="hddIdUserDelegado" value="<?php echo $info[0]["fk_id_user_delegado"]; ?>"/>

	<div class="form-group">
		<div class="row" align="center">
			<div style="width:50%;" align="center">
				<input type="submit" id="btnSubmit" name="btnSubmit" value="Aceptar" class="btn btn-danger"/>
			</div>
		</div>
	</div>
</form>	
							
						</div>
					</div>
				</div>
			</div>
		</div>



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