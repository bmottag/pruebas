<div id="page-wrapper">
	<br>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4 class="list-group-item-heading">
					<i class="fa fa-legal fa-fw"></i> ANULACIONES
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
					<a class="btn btn-success" href=" <?php echo base_url(). 'anulaciones'; ?> "><span class="glyphicon glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Regresar </a> 
					<i class="fa fa-legal"></i> <?php echo strtoupper($tipo); ?>
				</div>
				<div class="panel-body">
				
					<div class="alert alert-info">
						<?php echo $mensaje; ?>
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
								$tipo2 = "foto_" . $tipo;
								
								if($information[0][$tipo])
								{ 
						?>
						
<a href='<?php echo base_url($information[0][$tipo]); ?>' target="_blanck">
	<img src="<?php echo base_url($information[0][$tipo]); ?>" class="img-rounded" alt="Evidencia" width="50" height="50" />
</a>
						<?php 
								}elseif($information[0][$tipo2]){
						?>

<a href='<?php echo $information[0][$tipo2]; ?>' target="_blanck">
	<img src="<?php echo $information[0][$tipo2]; ?>" class="img-rounded" alt="Evidencia" width="50" height="50" />
</a>

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
					
				<br><br>
				
				
					<form  name="form" id="form" class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url("anulaciones/do_upload"); ?>">
						<input type="hidden" id="hddId" name="hddId" value="<?php echo $information?$information[0]["id_anulacion"]:""; ?>"/>
						<input type="hidden" id="tipo" name="tipo" value="<?php echo $tipo; ?>"/>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="hddTask">Evidencia: </label>
							<div class="col-sm-5">
								 <input type="file" name="userfile" capture="camera" accept="image/*">
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
                            Tamaño máximo: 5 MB<br>
                            Ancho máximo: 3264 pixels<br>
                            Altura máxima: 3008 pixels<br>

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
	
	
<script>
	var img=null;
					
	var sayCheese = new SayCheese('#webcam', { 
					snapshots: true,
					width: 320,
					height: 240
	});
	
	sayCheese.start();
	
	$('#obturador').bind('click', function(e){
		sayCheese.takeSnapshot(320,240);
		return false;
	})
	
	sayCheese.on('snapshot', function(snapshot) {
		// do something with the snapshot
		img = document.createElement('img');
		
		$(img).on('load', function(){
			$('#say-cheese-snapshot').html(img);
		});
		img.src = snapshot.toDataURL('images/png');
	});
	
	$('#guardarFoto').bind('click', function(){
		var src = img.src;
		
		data = {
			src: src,
			tipo: "<?php echo $tipo; ?>",
			idAnulacion: "<?php echo $information[0]["id_anulacion"]; ?>"
		}

		$.ajax({
			url: '<?php echo base_url() ?>anulaciones/ajax',
			data: data,
			type: 'post',
			success: function(respuesta){
					$('#fotoGuardada').attr('src', respuesta).show(300);
			}
		});
	});
</script>