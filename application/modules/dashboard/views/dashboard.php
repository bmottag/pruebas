<a name="anclaUp"></a>

<div id="page-wrapper">
	<div class="row"><br>
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4 class="list-group-item-heading">
						DASHBOARD
					</h4>
				</div>
			</div>
		</div>
		<!-- /.col-lg-12 -->
	</div>
		
<?php
$retornoExito = $this->session->flashdata('retornoExito');
if ($retornoExito) {
    ?>
	<div class="row">
		<div class="col-lg-12">	
			<div class="alert alert-success ">
				<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
				<strong><?php echo $this->session->userdata("firstname"); ?></strong> <?php echo $retornoExito ?>		
			</div>
		</div>
	</div>
    <?php
}

$retornoError = $this->session->flashdata('retornoError');
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


<!--INICIO ALERTA INFORMATIVA -->
<?php if($infoAlertaInformativa){ ?>
	<div class="row">
		<div class="col-lg-6">				
			<div class="panel panel-danger">
				<div class="panel-heading">
					<i class="fa fa-calendar fa-fw"></i> ALERTA - <?php echo $infoAlertaInformativa[0]['nombre_tipo_alerta']; ?>
				</div>
				<div class="panel-body">

					<div class="col-lg-12">	
						<div class="alert alert-danger ">
							<strong>Descripción Alerta: </strong><?php echo $infoAlertaInformativa[0]['descripcion_alerta']; ?><br>
							<strong>Mensaje Alerta: </strong><?php echo $infoAlertaInformativa[0]['mensaje_alerta']; ?><br>
							<strong>Nombre de Prueba: </strong><?php echo $infoAlertaInformativa[0]['nombre_prueba']; ?><br>
							<strong>Grupo Instrumentos: </strong><?php echo $infoAlertaInformativa[0]['nombre_grupo_instrumentos']; ?><br>
							<strong>Fecha: </strong><?php echo $infoAlertaInformativa[0]['fecha']; ?><br>
							<strong>Sesión Prueba: </strong><?php echo $infoAlertaInformativa[0]['sesion_prueba']; ?><br>
						</div>
					</div>
					
		<div class="form-group">
			<div class="row" align="center">
				<div style="width:50%;" align="center">
					<input type="button" id="btnSubmit" name="btnSubmit" value="Aceptar" class="btn btn-danger"/>
				</div>
			</div>
		</div>
				

				</div>
			</div>
		</div>
	
<?php } ?>
<!--FIN ALERTA -->


<!--INICIO ALERTA NOTIFICACION -->
<?php if($infoAlertaNotificacion){ ?>
	
		<div class="col-lg-6">				
			<div class="panel panel-yellow">
				<div class="panel-heading">
					<i class="fa fa-calendar fa-fw"></i> ALERTA - <?php echo $infoAlertaNotificacion[0]['nombre_tipo_alerta']; ?>
				</div>
				<div class="panel-body">

					<div class="col-lg-12">	
						<div class="alert alert-warning">
							<strong>Descripción Alerta: </strong><?php echo $infoAlertaNotificacion[0]['descripcion_alerta']; ?><br>
							<strong>Mensaje Alerta: </strong><?php echo $infoAlertaNotificacion[0]['mensaje_alerta']; ?><br>
							<strong>Nombre de Prueba: </strong><?php echo $infoAlertaNotificacion[0]['nombre_prueba']; ?><br>
							<strong>Grupo Instrumentos: </strong><?php echo $infoAlertaNotificacion[0]['nombre_grupo_instrumentos']; ?><br>
							<strong>Fecha: </strong><?php echo $infoAlertaNotificacion[0]['fecha']; ?><br>
							<strong>Sesión Prueba: </strong><?php echo $infoAlertaNotificacion[0]['sesion_prueba']; ?><br>
						</div>
					</div>
					
		<div class="form-group">
			<div class="row" align="center">
				<div style="width:50%;" align="center">
					<input type="button" id="btnSubmit" name="btnSubmit" value="Aceptar" class="btn btn-warning"/>
				</div>
			</div>
		</div>
				
				</div>
			</div>
		</div>
	
<?php } ?>
<!--FIN ALERTA -->


<!--INICIO ALERTA CONSOLIDACION -->
<?php if($infoAlertaConsolidacion){ ?>
	
		<div class="col-lg-6">				
			<div class="panel panel-green">
				<div class="panel-heading">
					<i class="fa fa-calendar fa-fw"></i> ALERTA - <?php echo $infoAlertaConsolidacion[0]['nombre_tipo_alerta']; ?>
				</div>
				<div class="panel-body">

					<div class="col-lg-12">	
						<div class="alert alert-success">
							<strong>Descripción Alerta: </strong><?php echo $infoAlertaConsolidacion[0]['descripcion_alerta']; ?><br>
							<strong>Mensaje Alerta: </strong><?php echo $infoAlertaConsolidacion[0]['mensaje_alerta']; ?><br>
							<strong>Nombre de Prueba: </strong><?php echo $infoAlertaConsolidacion[0]['nombre_prueba']; ?><br>
							<strong>Grupo Instrumentos: </strong><?php echo $infoAlertaConsolidacion[0]['nombre_grupo_instrumentos']; ?><br>
							<strong>Fecha: </strong><?php echo $infoAlertaConsolidacion[0]['fecha']; ?><br>
							<strong>Sesión Prueba: </strong><?php echo $infoAlertaConsolidacion[0]['sesion_prueba']; ?><br>
						</div>
					</div>
					
		<div class="form-group">
			<div class="row" align="center">
				<div style="width:50%;" align="center">
					<input type="button" id="btnSubmit" name="btnSubmit" value="Aceptar" class="btn btn-success"/>
				</div>
			</div>
		</div>
				

				</div>
			</div>
		</div>
	</div>
<?php } ?>
<!--FIN ALERTA -->

					

<?php
/**
 * Special MENU for ADMIN
 * @author BMOTTAG
 * @since  18/11/2016
 */
	$userRol = $this->session->rol;
	if($userRol==1){ //If it is an ADMIN user, show an special menu
?>
					
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-3 col-md-6">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-book fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge">52</div>
							<div>Alertas</div>
						</div>
					</div>
				</div>
				<a href="<?php echo base_url("payroll/add_payroll"); ?>">
					<div class="panel-footer">
						<span class="pull-left">Alertas</span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
				
				<a href="#anclaPayroll">
					<div class="panel-footer">
						<span class="pull-left">Lista de alertas</span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
			</div>
		</div>				

		<div class="col-lg-3 col-md-6">
			<div class="panel panel-red">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-life-saver fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge">821</div>
							<div>Notificaciones</div>
						</div>
					</div>
				</div>
				<a href="<?php echo base_url("safety/add_safety"); ?>">
					<div class="panel-footer">
						<span class="pull-left"> Adicionar notificaciones </span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
				<a href="#anclaSafety">
					<div class="panel-footer">
						<span class="pull-left"> Lista de notificaciones </span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
			</div>
		</div>
		
		<div class="col-lg-3 col-md-6">
			<div class="panel panel-yellow">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-truck fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge">23</div>
							<div>###########</div>
						</div>
					</div>
				</div>
				<a href="<?php echo base_url("hauling/add_hauling"); ?>">
					<div class="panel-footer">
						<span class="pull-left">Mas informacion</span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
				<a href="#anclaHauling">
					<div class="panel-footer">
						<span class="pull-left">Listas </span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
			</div>
		</div>	

		<div class="col-lg-3 col-md-6">
			<div class="panel panel-green">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-search fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge">3</div>
							<div>####</div>
						</div>
					</div>
				</div>
				<a href="<?php echo base_url("hauling/add_hauling"); ?>">
					<div class="panel-footer">
						<span class="pull-left">Formulario</span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
				<a href="#anclaPickup">
					<div class="panel-footer">
						<span class="pull-left">Listas</span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
			</div>
		</div>		
	</div>

<?php } ?>
	
		

</div>
<!-- /#page-wrapper -->
