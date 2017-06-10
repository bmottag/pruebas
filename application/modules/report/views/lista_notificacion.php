
        <div id="page-wrapper">

			<br>
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h4 class="list-group-item-heading">
								<a class="btn btn-success" href=" <?php echo base_url(). "dashboard/" . $rol; ?> "><span class="glyphicon glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Regresar </a> 
								<i class="fa fa-bar-chart-o fa-fw"></i> REPORTE
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
                            <i class="fa fa-thumb-tack fa-fw"></i> <?php echo $titulo; ?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

					<?php
						if(isset($info) && !$info){
					?>
						<div class="alert alert-danger">
							No hay Información
						</div>
					<?php
						}elseif(isset($info)){
					?>	
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
						<thead>
							<tr>
								<th class="text-center">Sitio</th>
								<th class="text-center">Alerta</th>
								<th class="text-center">Sesión</th>
								<th class="text-center">Respuesta</th>
							</tr>
						</thead>
						<tbody>							
						<?php
							foreach ($info as $lista):
									echo "<tr>";
									echo "<td>";
									echo "<strong>Sitio: </strong>";
echo "<a href='" . base_url('report/mostrarSesiones/' . $lista['id_sitio']) . "'>" . $lista['nombre_sitio'] . "</a>";
									echo "<br><strong>Nodo o Región: </strong>" . $lista['nombre_region'];
									echo "<br><strong>Departamento: </strong>" . $lista['dpto_divipola_nombre'];
									echo "<br><strong>Municipio: </strong>" . $lista['mpio_divipola_nombre'];
									echo "<br><strong>Zona: </strong>" . $lista['nombre_zona'];
									echo "<br><strong>Representante: </strong>";
									echo "C.C. " . $lista['cedula_delegado'] . " " . $lista['nom_delegado'] . " "  . $lista['ape_delegado'];
									echo "<br><strong>Celular representante: </strong>";
									echo "<a href='tel:".$lista['celular_delegado']."'>".$lista['celular_delegado']."</a>"; 									
									echo "</td>";


									echo "<td>";
									echo "<strong>Descripción: </strong>" . $lista['descripcion_alerta'];
									echo "<br><strong>Mensaje: </strong>" . $lista['mensaje_alerta'];
									echo "<p class='" . $lista['clase'] . "'><strong>Tipo Alerta: </strong>" . $lista['nombre_tipo_alerta'] . "</p>";
									echo "<strong>Inicio Alerta: </strong>" . $lista['fecha_inicio'];
									echo "<br><strong>Fin Alerta: </strong>" . $lista['fecha_fin'];
									echo "<br><strong>Rol Alerta: </strong>" . $lista['nombre_rol'];
									echo "</td>";
									
									
									
									echo "<td>";
									echo "<strong>Prueba: </strong>" . $lista['nombre_prueba'];
									echo "<br><strong>Grupo de Instrumentos: </strong>" . $lista['nombre_grupo_instrumentos'];
									echo "<br><strong>Sesión: </strong>" . $lista['sesion_prueba'];
									echo "<br><strong>Fecha: </strong>" . $lista['fecha'];
									echo "<br><strong>Hora Inicial: </strong>" . $lista['hora_inicio_prueba'];
									echo "<br><strong>Hora Final: </strong>" . $lista['hora_fin_prueba'];
									echo "</td>";
									
									
									echo "<td>";
									
									//buscar informacion de la respuesta si existe
$ci = &get_instance();
$ci->load->model("general_model");

$arrParam = array(
		"idSitioSesion" => $lista['id_sitio_sesion'],
		"idAlerta" => $lista['id_alerta']
);
$respuestas = $this->general_model->get_respuestas_alertas_vencidas_by($arrParam);

$userRol = $this->session->userdata("rol");
$userID = $this->session->userdata("id");									
									
									if(!$respuestas){ 
										echo "<p class='text-danger text-left'>Alerta sin respuesta.</p>";
										
										//si el usuario logeado es el mismo coordinador de la del sitio
										//si el usuario logeado es el mismo operador de la del sitio
										//entonces puede dar respuesta a la alerta
										//o si es directivo puede dar respuesta

										//si no se dio respuesta entonces|
										//dar respuesta para el directivo o el coordinador o el operador
										if(($userRol == 6 && $lista['fk_id_user_operador'] == $userID) || ($userRol == 3 && $lista['fk_id_user_coordinador'] == $userID) || $userRol == 2 || $userRol == 1){
											//si no existe el representante entonces no se muestra el enlace
											if($lista['fk_id_user_delegado']){											
echo "<a href=" . base_url("report/responder_alerta/" . $lista['id_alerta'] . "/" . $lista['fk_id_user_delegado'] . "/" . $lista['id_sitio_sesion'] . "/" . $rol) . " ><strong>Dar Respuesta</strong> </a>";
											}else{
												echo "<p class='text-danger'>Falta asignar representante para este Sitio</p>";
											}
											
										}
										
									}else{
										echo "<strong>Respuesta: </strong>";
										echo $acepta = $respuestas[0]['acepta']==1?"Si":"No";
										echo "<br><strong>Ausentes: </strong>" . $respuestas[0]['ausentes'];
										echo "<br><strong>Observación: </strong>" . $respuestas[0]['observacion'];
										echo "<br><strong>Fecha registro: </strong>" . $respuestas[0]['fecha_registro'];

//si no se acepta la alerta enotnces se crea enlace para poder aceptarla por parte del coordiandor, director o operador
if($respuestas[0]['acepta']==2){
		if(($userRol == 6 && $lista['fk_id_user_operador'] == $userID) || ($userRol == 3 && $lista['fk_id_user_coordinador'] == $userID) || $userRol == 2 || $userRol == 1){						
echo "<br><a href=" . base_url("report/update_alerta_notificacion/" . $respuestas[0]['id_registro'] . "/" . $rol) . " ><strong>Cambiar Respuesta</strong> </a>";
		}
}
										
									}
									echo "</td>";
							endforeach;
						?>
						</tbody>
					</table>
				<?php } ?>

                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>


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