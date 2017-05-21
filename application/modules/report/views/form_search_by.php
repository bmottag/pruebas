<script type="text/javascript" src="<?php echo base_url("assets/js/validate/admin/ajaxMcpio.js"); ?>"></script>


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
                            <?php echo $titulo; ?>
                        </div>
                        <div class="panel-body">
							<div class="alert alert-info">
								<strong>Nota:</strong> 
								Seleccionar <?php echo $subTitulo; ?>
							</div>
									<form  name="form" id="form" role="form" method="post" class="form-horizontal" >

<!-- INICIO FILTRO POR REGION -->
									<?php if($listaRegiones){ ?>
										<div class="form-group">
											<div class="col-sm-5 col-sm-offset-1">
												<label for="from">Regiones: <small></small></label>
												<select name="region" id="region" class="form-control" required>
													<option value=''>Select...</option>
													<?php for ($i = 0; $i < count($listaRegiones); $i++) { ?>
														<option value="<?php echo $listaRegiones[$i]["id_region"]; ?>" ><?php echo $listaRegiones[$i]["nombre_region"]; ?></option>	
													<?php } ?>
												</select>
											</div>
										</div>
									<?php } ?>
<!-- FIN FILTRO POR REGION -->


<!-- INICIO FILTRO POR DEPARTAMENTO -->
									<?php if($listaDepartamentos){ ?>
									
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<div class="col-sm-10 col-sm-offset-1">
													<label for="from">Departamento: <small></small></label>
													<select name="depto" id="depto" class="form-control" required>
														<option value=''>Select...</option>
														<?php for ($i = 0; $i < count($listaDepartamentos); $i++) { ?>
															<option value="<?php echo $listaDepartamentos[$i]["dpto_divipola"]; ?>" ><?php echo $listaDepartamentos[$i]["dpto_divipola_nombre"]; ?></option>	
														<?php } ?>
													</select>
												</div>
											</div>
										</div>
					
										<div class="col-sm-6">
											<div class="form-group">
												<div class="col-sm-10 col-sm-offset-1">
													<label for="from">Municipio: <small></small></label>
													<select name="mcpio" id="mcpio" class="form-control">
													
													</select>
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