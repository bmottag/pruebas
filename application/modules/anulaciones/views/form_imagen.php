<div id="page-wrapper">
	<br>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4 class="list-group-item-heading">
					<i class="fa fa-bug fa-fw"></i> ANULACIONES
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
					<i class="fa fa-user"></i> <?php echo strtoupper($tipo); ?>
				</div>
				<div class="panel-body">
				
					<div class="alert alert-info">
						Guardar la foto de evidencia
					</div>				
					
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
						<thead>
							<tr>
								<th><?php echo ucwords($tipo); ?></th>
								<th>SNP Examinando</th>
								<th>Motivo anulación</th>
								<th>Observación</th>
							</tr>
						</thead>
						<tbody>							
						<?php
								echo "<tr>";
								echo "<td class='text-center'>";
								
								if($information[0][$tipo])
								{ 
						?>
<img src="<?php echo base_url($information[0][$tipo]); ?>" class="img-rounded" alt="Evidencia" width="50" height="50" />
						<?php 
								} 

								echo "</td>";
								echo "<td>" . $information[0]["snp"] . "</td>";
								echo "<td>" . $information[0]["nombre_motivo_anulacion"] . "</td>";
								echo "<td>" . $information[0]["observacion"] . "</td>";
								echo "</tr>";
						?>
						</tbody>
					</table>

					<form  name="form" id="form" class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url("anulaciones/do_upload"); ?>">
						<input type="hidden" id="hddId" name="hddId" value="<?php echo $information?$information[0]["id_anulacion"]:""; ?>"/>
						<input type="hidden" id="tipo" name="tipo" value="<?php echo $tipo; ?>"/>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="hddTask">Evidencia</label>
							<div class="col-sm-5">
								 <input type="file" name="userfile" />
							</div>
						</div>
						
						<div class="form-group">
							<div class="row" align="center">
								<div style="width:50%;" align="center">
									<input type="submit" id="btnSubmit" name="btnSubmit" value="Enviar" class="btn btn-primary"/>
								</div>
							</div>
						</div>
						
                    <?php if($error){ ?>
                    <div class="alert alert-danger">
                        <?php 
                            echo "<strong>Error :</strong>";
                            pr($error); 
                        ?><!--$ERROR MUESTRA LOS ERRORES QUE PUEDAN HABER AL SUBIR LA IMAGEN-->
                    </div>
                    <?php } ?>
                    <div class="alert alert-danger">
                            <strong>Nota :</strong><br>
                            Formato permitido: gif - jpg - png<br>
                            Tamaño máximo: 2048 KB<br>
                            Ancho máximo: 1024 pixels<br>
                            Altura máxima: 1008 pixels<br>

                    </div>
						
					</form>
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


    <!-- Tables -->
    <script>
    $(document).ready(function() {
        $('#dataTables').DataTable({
            responsive: true,
			 "ordering": false,
			 paging: false,
			"searching": false,
			"info": false
        });
    });
    </script>