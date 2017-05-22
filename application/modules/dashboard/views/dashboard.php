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

	<div class="row">
<!--INICIO ALERTA INFORMATIVA -->
<?php if($infoAlertaInformativa){ ?>
	
		<div class="col-lg-6">				
			<div class="panel panel-danger">
				<div class="panel-heading">
					<i class="fa fa-calendar fa-fw"></i> ALERTA - <?php echo $infoAlertaInformativa[0]['nombre_tipo_alerta']; ?>
				</div>
				<div class="panel-body">
					
				<?php
					foreach ($infoAlertaInformativa as $lista):
					
					//consultar si ya el usuario dio respuesta a esta alerta
					$ci = &get_instance();
					$ci->load->model("dashboard_model");
					
					$arrParam = array("idAlerta" => $lista["id_alerta"]);
					$existeRegistro = $this->dashboard_model->get_registro_by($arrParam);
					
					if(!$existeRegistro){
				?>
						
					<div class="col-lg-12">	
						<div class="alert alert-danger ">
							<strong>Descripción Alerta: </strong><?php echo $lista['descripcion_alerta']; ?><br>
							<strong>Mensaje Alerta: </strong><?php echo $lista['mensaje_alerta']; ?><br>
							<strong>Nombre de Prueba: </strong><?php echo $lista['nombre_prueba']; ?><br>
							<strong>Grupo Instrumentos: </strong><?php echo $lista['nombre_grupo_instrumentos']; ?><br>
							<strong>Fecha: </strong><?php echo $lista['fecha']; ?><br>
							<strong>Sesión Prueba: </strong><?php echo $lista['sesion_prueba']; ?><br>
							<strong>Número de Citados: </strong><?php echo $lista['numero_citados']; ?><br>
							
					<br>
					<form  name="form" id="<?php echo "form_" . $lista["id_alerta"]; ?>" class="form-horizontal" method="post" action="<?php echo base_url("dashboard/registro_informativo"); ?>" >
						<input type="hidden" id="hddId" name="hddId" value="<?php echo $lista["id_alerta"]; ?>"/>
						<input type="hidden" id="hddIdSitioSesion" name="hddIdSitioSesion" value="<?php echo $lista["id_sitio_sesion"]; ?>"/>
					
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

				<?php
					}
					endforeach;
				?>

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

				<?php
					foreach ($infoAlertaNotificacion as $lista):
					
					//consultar si ya el usuario dio respuesta a esta alerta
					$ci = &get_instance();
					$ci->load->model("dashboard_model");
					
					$arrParam = array("idAlerta" => $lista["id_alerta"]);
					$existeRegistro = $this->dashboard_model->get_registro_by($arrParam);
					
					if(!$existeRegistro){
				?>
						
					<div class="col-lg-12">	
						<div class="alert alert-warning ">
							<strong>Descripción Alerta: </strong><?php echo $lista['descripcion_alerta']; ?><br>
							<strong>Mensaje Alerta: </strong><?php echo $lista['mensaje_alerta']; ?><br>
							<strong>Nombre de Prueba: </strong><?php echo $lista['nombre_prueba']; ?><br>
							<strong>Grupo Instrumentos: </strong><?php echo $lista['nombre_grupo_instrumentos']; ?><br>
							<strong>Fecha: </strong><?php echo $lista['fecha']; ?><br>
							<strong>Sesión Prueba: </strong><?php echo $lista['sesion_prueba']; ?><br>
							<strong>Número de Citados: </strong><?php echo $lista['numero_citados']; ?><br>
							
					<br>
					<form  name="form" id="<?php echo "form_" . $lista["id_alerta"]; ?>" class="form-horizontal" method="post" action="<?php echo base_url("dashboard/registro_notificacion"); ?>" >
						<input type="hidden" id="hddId" name="hddId" value="<?php echo $lista["id_alerta"]; ?>"/>
						<input type="hidden" id="hddIdSitioSesion" name="hddIdSitioSesion" value="<?php echo $lista["id_sitio_sesion"]; ?>"/>
						
						<div class="form-group">
							<label class="col-sm-12 control-label" for="firstName">Si/No</label>
							<div class="col-sm-12">
								<select name="acepta" id="acepta" class="form-control" required>
									<option value=''>Select...</option>
									<option value=1 >Si</option>
									<option value=2 >No</option>
								</select>								
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-12 control-label" for="observacion">Observación</label>
							<div class="col-sm-12">
								<textarea id="observacion" name="observacion" placeholder="Observación"  class="form-control" rows="2"></textarea>
							</div>
						</div>
					
						<div class="form-group">
							<div class="row" align="center">
								<div style="width:50%;" align="center">
									<input type="submit" id="btnSubmit" name="btnSubmit" value="Aceptar" class="btn btn-warning"/>
								</div>
							</div>
						</div>
					</form>	
							
						</div>
					</div>

				<?php
					}
					endforeach;
				?>
				
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

				<?php
					foreach ($infoAlertaConsolidacion as $lista):
					
					//consultar si ya el usuario dio respuesta a esta alerta
					$ci = &get_instance();
					$ci->load->model("dashboard_model");
					
					$arrParam = array("idAlerta" => $lista["id_alerta"]);
					$existeRegistro = $this->dashboard_model->get_registro_by($arrParam);
					
					if(!$existeRegistro){
				?>
						
					<div class="col-lg-12">	
						<div class="alert alert-success">
							<strong>Descripción Alerta: </strong><?php echo $lista['descripcion_alerta']; ?><br>
							<strong>Mensaje Alerta: </strong><?php echo $lista['mensaje_alerta']; ?><br>
							<strong>Nombre de Prueba: </strong><?php echo $lista['nombre_prueba']; ?><br>
							<strong>Grupo Instrumentos: </strong><?php echo $lista['nombre_grupo_instrumentos']; ?><br>
							<strong>Fecha: </strong><?php echo $lista['fecha']; ?><br>
							<strong>Sesión Prueba: </strong><?php echo $lista['sesion_prueba']; ?><br>
							<strong>Número de Citados: </strong><?php echo $lista['numero_citados']; ?><br>
							
					<br>
					<form  name="form" id="<?php echo "form_" . $lista["id_alerta"]; ?>" class="form-horizontal" method="post" action="<?php echo base_url("dashboard/registro_consolidacion"); ?>" >
						<input type="hidden" id="hddId" name="hddId" value="<?php echo $lista["id_alerta"]; ?>"/>
						<input type="hidden" id="hddIdSitioSesion" name="hddIdSitioSesion" value="<?php echo $lista["id_sitio_sesion"]; ?>"/>
						
						<div class="form-group">
							<label class="col-sm-12 control-label" for="ausentes">Cantidad de ausentes</label>
							<div class="col-sm-12">
								<input type="text" id="ausentes" name="ausentes" class="form-control" required/>
							</div>
						</div>
											
						<div class="form-group">
							<div class="row" align="center">
								<div style="width:50%;" align="center">
									<input type="submit" id="btnSubmit" name="btnSubmit" value="Enviar" class="btn btn-success"/>
								</div>
							</div>
						</div>
					</form>	
							
						</div>
					</div>

				<?php
					}
					endforeach;
				?>

				</div>
			</div>
		</div>
	
<?php } ?>
<!--FIN ALERTA -->
	</div>
					

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
							<div class="huge"><?php echo $noPruebasVigentes; ?></div>
							<div>Pruebas</div>
						</div>
					</div>
				</div>
				
				<a href="#anclaPruebas">
					<div class="panel-footer">
						<span class="pull-left">Lista de Pruebas</span>
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
							<div class="huge"><?php echo $noRegistroInformativa; ?></div>
							<div>Alerta Informativa</div>
						</div>
					</div>
				</div>
				<a href="<?php echo base_url("report/registros/1"); ?>">
					<div class="panel-footer">
						<span class="pull-left"> Lista Registros <br>Alerta Informativa </span>
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
							<div class="huge"><?php echo $noRegistroNotificacion; ?></div>
							<div>Alerta Notificación</div>
						</div>
					</div>
				</div>
				<a href="<?php echo base_url("report/registros/2"); ?>">
					<div class="panel-footer">
						<span class="pull-left">Lista Registros <br>Alerta Notificación </span>
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
							<div class="huge"><?php echo $noRegistroConsolidacion; ?></div>
							<div>Alerta Consolidación</div>
						</div>
					</div>
				</div>
				<a href="<?php echo base_url("report/registros/3"); ?>">
					<div class="panel-footer">
						<span class="pull-left">Lista Registros <br>Alerta Consolidación</span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
			</div>
		</div>		
	</div>
	
	
	
	
            <div class="row">

<a name="anclaPruebas" ></a>			
				<div class="col-lg-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-book fa-fw"></i> Lista de Pruebas - Año <?php date('Y'); ?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">


<a class="btn btn-default btn-circle" href="#anclaUp"><i class="fa fa-arrow-up"></i> </a>


<?php
	if(!$infoPruebas){ 
		echo "<a href='#' class='btn btn-danger btn-block'>No hay Pruebas para la vigencia actual</a>";
	}else{
?>						
					
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
						<thead>
							<tr>
								<th>Prueba</th>
								<th>Descripción</th>
								<th>Año</th>
								<th>Semestre</th>
							</tr>
						</thead>
						<tbody>							
						<?php
							foreach ($infoPruebas as $lista):
								echo "<tr>";
								echo "<td >" . $lista['nombre_prueba'] . "</td>";
								echo "<td >" . $lista['descripcion_prueba'] . "</td>";
								echo "<td class='text-center'>" . $lista['anio_prueba'] . "</td>";
								echo "<td class='text-center'>" . $lista['semestre_prueba'] . "</td>";
								echo "</tr>";
							endforeach;
						?>
						</tbody>
					</table>
					
<?php	} ?>					
				</div>
				<!-- /.panel-body -->
			</div>
			
			
		</div>

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

<?php } ?>
	
		

</div>
<!-- /#page-wrapper -->
