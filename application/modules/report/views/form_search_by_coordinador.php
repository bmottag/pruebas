<script type="text/javascript" src="<?php echo base_url("assets/js/validate/admin/ajaxMcpio.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/validate/ajaxAlerta.js"); ?>"></script>

        <div id="page-wrapper">

			<br>
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h4 class="list-group-item-heading">
								<i class="fa fa-bar-chart-o fa-fw"></i> REPORT CENTER
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
                            <i class='fa fa-book fa-fw'></i> Seleccionar uno o varios de las siguientes opciones
                        </div>
                        <div class="panel-body">

									<form  name="form" id="form" role="form" method="post" class="form-horizontal" >
									
									
<!-- INICIO FILTRO POR SESIONES -->
									<?php if($infoSesiones){ ?>
									
									<div class="row">
										<div class="col-sm-12">
										<div class="alert alert-info">
											<div class="form-group">
												<div class="col-sm-8 col-sm-offset-2">
													<label for="type" >Prueba / Grupo de Instrumentos / Fecha / Sesión : *</label>
													<select name="sesion" id="sesion" class="form-control" required>
														<option value=''>Select...</option>
														<?php for ($i = 0; $i < count($infoSesiones); $i++) { ?>
															<option value="<?php echo $infoSesiones[$i]["id_sesion"]; ?>" ><?php echo $infoSesiones[$i]["nombre_prueba"] . " / " . $infoSesiones[$i]["nombre_grupo_instrumentos"] . " / " . $infoSesiones[$i]["fecha"] . " / " . $infoSesiones[$i]["sesion_prueba"]; ?></option>	
														<?php } ?>
													</select>
												</div>
											</div>

											<div class="form-group">
												<div class="col-sm-8 col-sm-offset-2">
													<label for="from">Alerta -----> Inicio Alerta: <small></small></label>
													<select name="alerta" id="alerta" class="form-control">
													
													</select>
												</div>
											</div>
										</div>
										</div>
									</div>

									<?php } ?>
<!-- FIN FILTRO POR SESIONES -->
									


									<div class="row">
										<div class="col-sm-12">
										<div class="alert alert-info">



<!-- INICIO FILTRO POR DEPARTAMENTO -->
									<?php if($listaDepartamentos){ ?>
									
	
											<div class="form-group">
												<div class="col-sm-8 col-sm-offset-2">
													<label for="from">Departamento: <small></small></label>
													<select name="depto" id="depto" class="form-control">
														<option value=''>Select...</option>
														<?php for ($i = 0; $i < count($listaDepartamentos); $i++) { ?>
															<option value="<?php echo $listaDepartamentos[$i]["dpto_divipola"]; ?>" ><?php echo $listaDepartamentos[$i]["dpto_divipola_nombre"]; ?></option>	
														<?php } ?>
													</select>
												</div>
											</div>
											
											<div class="form-group">
												<div class="col-sm-8 col-sm-offset-2">
													<label for="from">Municipio: <small></small></label>
													<select name="mcpio" id="mcpio" class="form-control">
													
													</select>
												</div>
											</div>
										</div>
										</div>
									</div>
					


									<?php } ?>
<!-- FIN FILTRO POR DEPARTAMENTO -->




<div class="row"></div><br>
										<div class="form-group">
											<div class="row" align="center">
												<div style="width80%;" align="center">
													
												 <button type="submit" class="btn btn-primary" id='btnSubmit' name='btnSubmit'><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Buscar </button>
													
												</div>
											</div>
										</div>
										
                                    </form>

								</div>
                                <!-- /.col-lg-6 (nested) -->
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
        </div>
        <!-- /#page-wrapper -->