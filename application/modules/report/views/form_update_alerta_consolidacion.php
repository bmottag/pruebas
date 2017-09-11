
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
					<i class="fa fa-gears"></i> Actualizar la respuesta alerta de consolidación
				</div>
				<div class="panel-body">
				
	<div class="alert alert-info">
		Este formulario es para actualizar los datos ingresados
	</div>


		<div class="col-md-6">
			<div class="panel panel-info">
				<div class="panel-heading">
					<strong>Nombre Sitio: </strong><br><?php echo $info[0]['nombre_sitio']; ?>
					<br><strong>Dirección: </strong><?php echo $info[0]['direccion_sitio']; ?>
					<br><strong>Código DANE: </strong><?php echo $info[0]['codigo_dane']; ?>
					<?php if($info[0]['contacto_nombres']){ ?>
					<br><strong>Contacto: </strong><br><?php echo $info[0]['contacto_nombres'] . " " . $info[0]['contacto_apellidos']; ?>
					<br>Celular: <?php echo $info[0]['contacto_celular']; ?>
					<?php } ?>

					<br><strong>Departamento: </strong><?php echo $info[0]['dpto_divipola_nombre']; ?>
					<br><strong>Municipio: </strong><?php echo $info[0]['mpio_divipola_nombre']; ?>
					<br><strong>Zona: </strong><?php echo $info[0]['nombre_zona']; ?>

					<br><strong>Representante: </strong><br>
					<?php 
					if($info[0]['fk_id_user_delegado']){
						echo "C.C. " . $info[0]['numero_documento'] . " " . $info[0]['nombre_delegado'];
						echo "<br><strong>Celular: </strong>";						
						echo "<a href='tel:".$info[0]['celular_delegado']."'>".$info[0]['celular_delegado']."</a>"; 
						echo "<br><strong>Email: </strong>" . $info[0]['email'];
					} else { echo "Falta asignar Representante.";}
					?>

				</div>
			</div>
		</div>
	
				
				
		<div class="col-lg-6">				
			<div class="panel panel-green">
				<div class="panel-heading">
					<i class="fa fa-calendar fa-fw"></i> ALERTA - <?php echo $info[0]['nombre_tipo_alerta']; ?>
				</div>
				<div class="panel-body">
				
				
				
<?php
$retornoError = $this->session->flashdata('retornoErrorConsolidacion');
if ($retornoError) {
    ?>
	<div class="row">
		<div class="col-lg-12">	
			<div class="alert alert-danger ">
				<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
				<?php echo $retornoError ?>
			</div>
		</div>
	</div>
    <?php
}
?>
				
				
					<div class="col-lg-12">	
						
						<div class="alert alert-success">
							<strong>Mensaje Alerta: </strong><?php echo $info[0]['mensaje_alerta']; ?><br>
							<strong>Nombre de Prueba: </strong><?php echo $info[0]['nombre_prueba']; ?><br>
							<strong>Grupo Instrumentos: </strong><?php echo $info[0]['nombre_grupo_instrumentos']; ?><br>
							<strong>Fecha: </strong><?php echo $info[0]['fecha']; ?><br>
							<strong>Sesión Prueba: </strong><?php echo $info[0]['sesion_prueba']; ?><br>
							<strong>Número de Citados: </strong><?php echo $info[0]['numero_citados']; ?><br>
					<br>



<script>
$( document ).ready( function () {
	$("#ausentes").bloquearTexto().maxlength(5);
	$("#ausentesConfirmar").bloquearTexto().maxlength(5);
});
</script>


<form  name="form" id="form" class="form-horizontal" method="post" action="<?php echo base_url("report/update_registro_consolidacion_by_coordinador"); ?>" >
	<input type="hidden" id="hddIdRol" name="hddIdRol" value="<?php echo $rol; ?>"/>
	<input type="hidden" id="hddIdAlerta" name="hddIdAlerta" value="<?php echo $info[0]["id_alerta"]; ?>"/>
	<input type="hidden" id="hddIdSitioSesion" name="hddIdSitioSesion" value="<?php echo $info[0]["id_sitio_sesion"]; ?>"/>
	<input type="hidden" id="hddIdUserDelegado" name="hddIdUserDelegado" value="<?php echo $info[0]["fk_id_user_delegado"]; ?>"/>
	<input type="hidden" id="citados" name="citados" value="<?php echo $info[0]["numero_citados"]; ?>"/>
	<input type="hidden" id="idRegistro" name="idRegistro" value="<?php echo $infoRespuesta[0]['id_registro']; ?>"/>

	<div class="form-group">
		<label class="col-sm-12 control-label" for="ausentes">Cantidad</label>
		<div class="col-sm-12">
			<input type="text" id="ausentes" name="ausentes" class="form-control" value="<?php echo $infoRespuesta[0]['ausentes']; ?>" required/>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-12 control-label" for="ausentesConfirmar">Confirmar cantidad</label>
		<div class="col-sm-12">
			<input type="text" id="ausentesConfirmar" name="ausentesConfirmar" class="form-control" value="<?php echo $infoRespuesta[0]['ausentes']; ?>" required/>
		</div>
	</div>
	
	
	<div class="form-group">
		<div class="row" align="center">
			<div style="width:50%;" align="center">
				<input type="submit" id="btnSubmit" name="btnSubmit" value="Aceptar" class="btn btn-success"/>
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