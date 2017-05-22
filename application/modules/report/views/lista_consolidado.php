
        <div id="page-wrapper">

			<br>
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h4 class="list-group-item-heading">
								<i class="fa fa-bar-chart-o fa-fw"></i> REPORTE
							</h4>
						</div>
					</div>
				</div>
				<!-- /.col-lg-12 -->				
			</div>

<?php 
if(!$infoAlerta){
?>
	<div class="alert alert-info">
		<strong>Nota:</strong> 
		No hay información.
	</div>
<?php
}else{
?>
			
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
							<i class="fa fa-life-saver fa-fw"></i> <?php echo $infoAlerta[0]['nombre_tipo_alerta']; ?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
                                <thead>
                                    <tr>
                                        <th>Departmanto</th>
										<th>Municipio</th>
										<th>Sitio</th>
										<th>Prueba</th>
										<th>Grupo Instrumentos</th>
										<th>Sesión</th>
										<th>Alerta</th>
										<th>Encargado</th>
										<th>Cantidad de Ausentes</th>
                                    </tr>
                                </thead>
                                <tbody>							
								<?php
									$total = 0;
									foreach ($infoAlerta as $lista):
											echo "<tr>";
											echo "<td>" . $lista['dpto_divipola_nombre'] . "</td>";
											echo "<td>" . $lista['mpio_divipola_nombre'] . "</td>";
											echo "<td>" . $lista['nombre_sitio'] . "</td>";
											echo "<td>" . $lista['nombre_prueba'] . "</td>";
											echo "<td >" . $lista['nombre_grupo_instrumentos'] . "</td>";
											echo "<td >" . $lista['sesion_prueba'] . "</td>";
											echo "<td >" . $lista['descripcion_alerta'] . "</td>";
											echo "<td >" . $lista['nombres_usuario'] . " " . $lista['apellidos_usuario'] . "</td>";
											echo "<td >" . $lista['ausentes'] . "</td>";
											echo "</tr>";
									endforeach;
								?>
                                </tbody>
                            </table>

                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
<?php } ?>	
        </div>
        <!-- /#page-wrapper -->

    <!-- Tables -->
    <script>
    $(document).ready(function() {
        $('#dataTables').DataTable({
            responsive: true,
			"ordering": false
        });
    });
    </script>