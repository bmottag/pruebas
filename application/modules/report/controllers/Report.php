<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {
	
    public function __construct() {
        parent::__construct();
		$this->load->model("report_model");
		//$this->load->library('PHPExcel.php');
    }
	
	/**
	 * Reportes con reportico
     * @since 1/06/2017
	 */
    public function index() 
	{					
			$this->load->view("reportes");
    }
		
	/**
	 * Informacion de los registros
     * @since 21/05/2017
	 */
    public function registros($tipoAlerta, $rol) 
	{
			$data["rol"] = $rol;

			switch ($tipoAlerta) {
				case 1:
					$data["view"] = "lista_informativa";
					$data["titulo"] = "Alerta Informativa";
					break;
				case 2:
					$data["view"] = "lista_notificacion";
					$data["titulo"] = "Alerta Notificación";
					break;
				case 3:
					$data["view"] = "lista_consolidado";
					$data["titulo"] = "Alerta Consolidación";
					break;
			}

			$arrParam = array("tipoAlerta" => $tipoAlerta);
			//$data['infoAlerta'] = $this->report_model->get_consolidado_by($arrParam);
			
			$data['info'] = $this->report_model->get_total_by($arrParam);
			
			
//echo $this->db->last_query();			
//pr($data['infoAlerta']); exit;
						
			$this->load->view("layout", $data);
    }
	
	/**
	 * Buscar por regiones
     * @since 21/05/2017
	 */
    public function searchBy() 
	{
			$data['rol_busqueda'] = "Representantes";
			$data['regreso'] = "report/searchBy";
			$userRol = $this->session->userdata("rol");
			$userID = $this->session->userdata("id");
			
			//Lista Regiones
			$this->load->model("general_model");
			
			$arrParam = array(
				"table" => "param_regiones",
				"order" => "nombre_region",
				"id" => "x"
			);
			$data['listaRegiones'] = $this->general_model->get_basic_search($arrParam);//Lista Regiones
			
			if($userRol == 1){
				$data['rol'] = "admin";
			}elseif($userRol == 2){
				$data['rol'] = "directivo";
			}
			
			
			$data['listaDepartamentos'] = $this->general_model->get_dpto_divipola_by($arrParam);//listado de departamentos
			
			//lista sesiones
			$arrParam = array();
			$data['infoSesiones'] = $this->general_model->get_sesiones($arrParam);//lista sesiones
			
			$data["view"] = "form_search_by";

			if($this->input->post('sesion'))
			{
				$sesion = $this->input->post('sesion');
				
				$alerta = $this->input->post('alerta');
				$alerta = $alerta==""?FALSE:$alerta;
				
				$depto = $this->input->post('depto');
				$depto = $depto==""?FALSE:$depto;
				
				$mcpio = $this->input->post('mcpio');
				$mcpio = $mcpio==""?FALSE:$mcpio;
	
				//lista sesiones
				$arrParam = array("idSesion" => $sesion);
				$data['infoSesiones'] = $this->general_model->get_sesiones($arrParam);//info de sesion que se filtro
				
				//Info Alerta
				if($alerta){
						$arrParam = array(
							"table" => "alertas",
							"order" => "id_alerta",
							"column" => "id_alerta",
							"id" => $alerta
						);
						$data['infoAlerta'] = $this->general_model->get_basic_search($arrParam);//Info Alerta para mostrar la region por la que se filtro
				}
				
				//Info Departamento
				if($depto){
						$arrParam = array(
							"table" => "param_divipola",
							"order" => "dpto_divipola",
							"column" => "dpto_divipola",
							"id" => $depto
						);
						$data['infoDepto'] = $this->general_model->get_basic_search($arrParam);//Info Departamento para mostrar la region por la que se filtro
				}
				
				//Info Municipio
				if($mcpio){
						$arrParam = array(
							"table" => "param_divipola",
							"order" => "mpio_divipola",
							"column" => "mpio_divipola",
							"id" => $mcpio
						);
						$data['infoMcpio'] = $this->general_model->get_basic_search($arrParam);//Info Municipio para mostrar la region por la que se filtro
				}
				
				
				if($this->input->post('tipoAlerta'))
				{				
						$arrParam = array(
									"tipoAlerta" => $this->input->post('tipoAlerta'),
									"respuestaUsuario" => $this->input->post('respuesta')
						);
						$data['info'] = $this->report_model->get_total_by($arrParam);
				}
				
				//conteo de los sitios segun el filtro
				$data['conteoSitios'] = $this->general_model->get_numero_sitios_por_filtro_by_coordinador();
				
				$data['conteoCitados'] = $this->general_model->get_numero_citados_por_filtro_by_coordinnador();
//pr($data['conteoCitados']);
//echo$this->db->last_query();exit;
				
//conteo respuestas para alertas INFORMATIVAS - ROL COORDINADOR
				$arrParam = array(
								'tipoAlerta' => 1, //INFORMATIVA
								'rolAlerta' => 4, //representante
				);
				$infoInformativa = $this->report_model->get_respuestas_registro_by_coordinador($arrParam);//alertas vigentes para los filtros
				
				//recorro las alertas y reviso se se les dio respuesta, si no se le dio respuesta las voy contando
				$data['contadorInformativaSi'] = 0;
				$data['contadorInformativaNo'] = 0;
				if($infoInformativa){
					foreach ($infoInformativa as $lista):
						$arrParam = array(
								"idSitioSesion" => $lista['id_sitio_sesion'],
								"idAlerta" => $lista['id_alerta']
						);
						$respuesta = $this->general_model->get_respuestas_alertas_vencidas_by($arrParam);
						
						if($respuesta){
							$data['contadorInformativaSi']++;
						}else{
							$data['contadorInformativaNo']++;
						}
					endforeach;
				}
				
//conteo respuestas para alertas NOTIFICACION - ROL DELEGADO
				$arrParam = array(
								'tipoAlerta' => 2, //NOTIFICACION
								'rolAlerta' => 4, //representante
				);
				$infoNotificacion = $this->report_model->get_respuestas_registro_by_coordinador($arrParam);
				//recorro las alertas y reviso se se les dio respuesta, si no se le dio respuesta las voy contando
				$data['contadorNotificacionContestaron'] = 0;
				$data['contadorNotificacionSi'] = 0;
				$data['contadorNotificacionNoContestaron'] = 0;
				if($infoNotificacion){
					foreach ($infoNotificacion as $lista):
						$arrParam = array(
								"idSitioSesion" => $lista['id_sitio_sesion'],
								"idAlerta" => $lista['id_alerta']
						);
						$respuesta = $this->general_model->get_respuestas_alertas_vencidas_by($arrParam);
						
						$arrParam = array(
								"idSitioSesion" => $lista['id_sitio_sesion'],
								"idAlerta" => $lista['id_alerta'],
								"respuestaAcepta" => 1
						);//filtro por los que contestaron que SI
						$respuestaSI = $this->general_model->get_respuestas_alertas_vencidas_by($arrParam);
						
						if($respuestaSI){
							$data['contadorNotificacionSi']++;
						}
						
						if($respuesta){
							$data['contadorNotificacionContestaron']++;
						}else{
							$data['contadorNotificacionNoContestaron']++;
						}
					endforeach;
				}
				
//conteo respiestas para alertas CONSOLIDACION - ROL DELEGADO
				$arrParam = array(
								'tipoAlerta' => 3, //CONSOLIDACION
								'rolAlerta' => 4, //representante
				);
				$infoConsolidacion = $this->report_model->get_respuestas_registro_by_coordinador($arrParam);
				//recorro las alertas y reviso se se les dio respuesta, si no se le dio respuesta las voy contando
				$data['contadorConsolidacionSi'] = 0;
				$data['contadorConsolidacionNo'] = 0;
				if($infoConsolidacion){
					foreach ($infoConsolidacion as $lista):
						$arrParam = array(
								"idSitioSesion" => $lista['id_sitio_sesion'],
								"idAlerta" => $lista['id_alerta']
						);
						$respuesta = $this->general_model->get_respuestas_alertas_vencidas_by($arrParam);
						
						if($respuesta){
							$data['contadorConsolidacionSi']++;
						}else{
							$data['contadorConsolidacionNo']++;
						}
					endforeach;
				}


				$data["view"] = "lista_total_coordinador";
			}
			
			$this->load->view("layout", $data);			
    }
	
	/**
	 * Formulario para dar respuesta a la alerta
     * @since 23/5/2017
	 */
	public function responder_alerta($idAlerta, $idDelegado, $idSitioSesion, $rol)
	{
			$this->load->model("general_model");
			$arrParam = array(
					"idSitioSesion" => $idSitioSesion,
					"idAlerta" => $idAlerta
			);
			$data['info'] = $this->general_model->get_informacion_respuestas_alertas_vencidas_by($arrParam);
			
			$data["rol"] = $rol;//se pasa el rol del operador o del coordinador
			$data["view"] = 'form_responder_alerta';
			$this->load->view("layout", $data);
	}
	
	/**
	 * Formulario para actualizar la alerta notificacion cuando no se acepto
     * @since 9/6/2017
	 */
	public function update_alerta_notificacion($idRegistro, $rol)
	{
			$data["rol"] = $rol;
			$this->load->model("general_model");
			//informacion de la respuesta
			$arrParam = array(
					"idRegistro" => $idRegistro
			);
			$data['infoRespuesta'] = $this->general_model->get_respuestas_alertas_vencidas_by($arrParam);
			
			//informacion de la alerta sesion y sitio
			$arrParam = array(
					"idSitioSesion" => $data['infoRespuesta'][0]['fk_id_sitio_sesion'],
					"idAlerta" => $data['infoRespuesta'][0]['fk_id_alerta']
			);
			$data['info'] = $this->general_model->get_informacion_respuestas_alertas_vencidas_by($arrParam);

			$data["view"] = 'form_update_alerta_notificacion';
			$this->load->view("layout", $data);
	}
	
	/**
	 * Registro de la aceptacion de la alerta informativa
	 * @since 23/5/2017
	 */
	public function registro_informativo_by_coordinador()
	{
			$data = array();
						
			$rol = $this->input->post('hddIdRol');
			
			if ($this->report_model->saveRegistroInformativoCoordinador()) {
				$this->session->set_flashdata('retornoExito', "Gracias por su respuesta.");
			} else {
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Contactarse con el Administrador.');
			}

			redirect("/dashboard/" . $rol,"location",301);
	}
	
	/**
	 * Registro de la aceptacion de la alerta notificacion
	 * @since 19/5/2017
	 */
	public function registro_notificacion_by_coordinador()
	{
			$data = array();

			$rol = $this->input->post('hddIdRol');
			$idAlerta = $this->input->post('hddIdAlerta');
			$idSitioSesion = $this->input->post('hddIdSitioSesion');
			$idDelegado = $this->input->post('hddIdUserDelegado');
			
			$acepta = $this->input->post('acepta');
			$observacion = $this->input->post('observacion');

			$error = true;
			if($acepta && $acepta==2 && $observacion == ""){
				$this->session->set_flashdata('retornoErrorConsolidacion', '<strong>Error!!!</strong> Debe indicar la Observación.');
			}elseif($acepta==""){
				$this->session->set_flashdata('retornoErrorConsolidacion', '<strong>Error!!!</strong> Debe indicar su respuesta.');
			}else{
				if ($this->report_model->saveRegistroNotificacionCoordinador()) {
					$error = false;
					$this->session->set_flashdata('retornoExito', "Gracias por su respuesta.");
				} else {
					$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Contactarse con el Administrador.');
				}
			}

			if($error){
				redirect("/report/responder_alerta/" . $idAlerta . "/" . $idDelegado . "/" . $idSitioSesion . "/" . $rol,"location",301);
			}else{
				redirect("/dashboard/" . $rol,"location",301);
			}
	}
	
	/**
	 * Actualizacion de respuesta a la alerta notificacion
	 * @since 9/6/2017
	 */
	public function registro_update_notificacion()
	{
			$data = array();

			$rol = $this->input->post('hddIdRol');
			$idRegistro = $this->input->post('hddIdRegistro');
			
			$acepta = $this->input->post('acepta');
			
			$error = true;
			if($acepta && $acepta==2){
				$this->session->set_flashdata('retornoErrorConsolidacion', '<strong>Error!!!</strong> Este formulario solo es para aceptar la alerta.');
			}elseif($acepta==""){
				$this->session->set_flashdata('retornoErrorConsolidacion', '<strong>Error!!!</strong> Debe indicar su respuesta.');
			}else{
				if ($this->report_model->updateRegistroNotificacion()) {
					$error = false;
					$this->session->set_flashdata('retornoExito', "Gracias por su respuesta.");
				} else {
					$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Contactarse con el Administrador.');
				}
			}

			if($error){
				redirect("/report/update_alerta_notificacion/" . $idRegistro . "/" . $rol,"location",301);
			}else{
				redirect("/dashboard/" . $rol,"location",301);
			}
	}
	
	/**
	 * Registro de la aceptacion de la alerta notificacion
	 * @since 19/5/2017
	 */
	public function registro_consolidacion_by_coordinador()
	{
			$data = array();
			$ausentes = $this->input->post('ausentes');
			$ausentesConfirmar = $this->input->post('ausentesConfirmar');
			$citados = $this->input->post('citados');

			$rol = $this->input->post('hddIdRol');
			$idAlerta = $this->input->post('hddIdAlerta');
			$idSitioSesion = $this->input->post('hddIdSitioSesion');
			$idDelegado = $this->input->post('hddIdUserDelegado');
			
			$error = false;
			
			
			
			if($ausentes == ""){
				$this->session->set_flashdata('retornoErrorConsolidacion', '<strong>Error!!!</strong> Debe indicar los ausentes.');
			}else{
				if($ausentes < 0){
					$this->session->set_flashdata('retornoErrorConsolidacion', '<strong>Error!!!</strong> La cantidad de ausentes no puede ser menor que 0.');
				}else{				
					if($ausentes != $ausentesConfirmar){
						$this->session->set_flashdata('retornoErrorConsolidacion', '<strong>Error!!!</strong> Confirmar la cantidad de ausentes.');
					}else{				
							if($ausentes > $citados){
								$this->session->set_flashdata('retornoErrorConsolidacion', '<strong>Error!!!</strong> La cantidad de ausentes no puede ser mayor a la cantidad de citados.');
							}else{
								if ($this->report_model->saveRegistroConsolidacionCoordinador()) 
								{
									$error = true;
									$this->session->set_flashdata('retornoExito', "Gracias por su respuesta.");
								} else {
									$this->session->set_flashdata('retornoErrorConsolidacion', '<strong>Error!!!</strong> Contactarse con el Administrador.');
								}
							}
					}
				}
			}
			
	if(!$error){
			redirect("/report/responder_alerta/" . $idAlerta . "/" . $idDelegado . "/" . $idSitioSesion . "/" . $rol,"location",301);
	}else{
		      redirect("/dashboard/" . $rol,"location",301);
	}
	}
		
    /**
     * Cargo modal - lista de sesiones
     * @since 21/5/2017
     */
    public function mostrarSesiones($idSitio, $regreso="x") 
	{
			if($regreso == "x"){
				$data["botonRegreso"] = "report/searchBy";
			}elseif($regreso == 'directivo'){
				$data["botonRegreso"] = "dashboard/directivo";
			}elseif($regreso == 'coordinador'){
				$data["botonRegreso"] = "dashboard/coordinador";
			}elseif($regreso == 'operador'){
				$data["botonRegreso"] = "dashboard/operador";
			}elseif($regreso == 'admin'){
				$data["botonRegreso"] = "dashboard/admin";
			}
				
			$this->load->model("general_model");
			$arrParam = array("idSitio" => $idSitio);
			$data['info'] = $this->report_model->get_sesiones_by($arrParam);

			$data['infoSitio'] = $this->general_model->get_sitios($arrParam);
			
			//LISTADO DE RESPUESTAS QUE se han dado para este sitio
			$data['infoRespuestas'] = $this->general_model->get_respuestas_usuario_by($arrParam);
		
			$data["view"] = "lista_sesinones_by_sitio";
			$this->load->view("layout", $data);


    }
	
	/**
	 * Lista de alertas por sesiones
     * @since 22/5/2017
	 */
    public function alertaList()
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos

			$arrParam['idSesion'] = $this->input->post('identificador');
			$this->load->model("general_model");
			$lista = $this->general_model->get_alertas_by($arrParam);
		
			echo "<option value=''>Select...</option>";
			if ($lista) {
				foreach ($lista as $fila) {
					echo "<option value='" . $fila["idAlerta"] . "' >" . $fila["descripcion"] . "</option>";
				}
			}
    }
	
	
	/**
	 * Buscar por regiones
     * @since 21/05/2017
	 */
    public function searchByCoordinador() 
	{
			$data['rol_busqueda'] = "Representantes";
			$data['regreso'] = "report/searchByCoordinador";
			$userRol = $this->session->userdata("rol");
			$userID = $this->session->userdata("id");
			
			//Lista Regiones
			$this->load->model("general_model");
			
			if($userRol == 3){
				$arrParam = array("idCoordinador" => $userID);
				$data['rol'] = "coordinador";
			}elseif($userRol == 6){
				$arrParam = array("idOperdador" => $userID);
				$data['rol'] = "operador";
			}
			
			
			$data['listaDepartamentos'] = $this->general_model->get_dpto_divipola_by($arrParam);//listado de departamentos
			
			//lista sesiones
			$arrParam = array();
			$data['infoSesiones'] = $this->general_model->get_sesiones($arrParam);//lista sesiones
			
			$data["view"] = "form_search_by_coordinador";

			if($this->input->post('sesion'))
			{
				$sesion = $this->input->post('sesion');
				
				$alerta = $this->input->post('alerta');
				$alerta = $alerta==""?FALSE:$alerta;
				
				$depto = $this->input->post('depto');
				$depto = $depto==""?FALSE:$depto;
				
				$mcpio = $this->input->post('mcpio');
				$mcpio = $mcpio==""?FALSE:$mcpio;
	
				//lista sesiones
				$arrParam = array("idSesion" => $sesion);
				$data['infoSesiones'] = $this->general_model->get_sesiones($arrParam);//info de sesion que se filtro
				
				//Info Alerta
				if($alerta){
						$arrParam = array(
							"table" => "alertas",
							"order" => "id_alerta",
							"column" => "id_alerta",
							"id" => $alerta
						);
						$data['infoAlerta'] = $this->general_model->get_basic_search($arrParam);//Info Alerta para mostrar la region por la que se filtro
				}
				
				//Info Departamento
				if($depto){
						$arrParam = array(
							"table" => "param_divipola",
							"order" => "dpto_divipola",
							"column" => "dpto_divipola",
							"id" => $depto
						);
						$data['infoDepto'] = $this->general_model->get_basic_search($arrParam);//Info Departamento para mostrar la region por la que se filtro
				}
				
				//Info Municipio
				if($mcpio){
						$arrParam = array(
							"table" => "param_divipola",
							"order" => "mpio_divipola",
							"column" => "mpio_divipola",
							"id" => $mcpio
						);
						$data['infoMcpio'] = $this->general_model->get_basic_search($arrParam);//Info Municipio para mostrar la region por la que se filtro
				}
				
				
				if($this->input->post('tipoAlerta'))
				{				
						$arrParam = array(
									"tipoAlerta" => $this->input->post('tipoAlerta'),
									"respuestaUsuario" => $this->input->post('respuesta')
						);
						$data['info'] = $this->report_model->get_total_by($arrParam);
				}
				
				//conteo de los sitios segun el filtro
				$data['conteoSitios'] = $this->general_model->get_numero_sitios_por_filtro_by_coordinador();
				
				$data['conteoCitados'] = $this->general_model->get_numero_citados_por_filtro_by_coordinnador();
//pr($data['conteoCitados']);
//echo$this->db->last_query();exit;
				
//conteo respuestas para alertas INFORMATIVAS - ROL COORDINADOR
				$arrParam = array(
								'tipoAlerta' => 1, //INFORMATIVA
								'rolAlerta' => 4, //representante
				);
				$infoInformativa = $this->report_model->get_respuestas_registro_by_coordinador($arrParam);//alertas vigentes para los filtros
				
				//recorro las alertas y reviso se se les dio respuesta, si no se le dio respuesta las voy contando
				$data['contadorInformativaSi'] = 0;
				$data['contadorInformativaNo'] = 0;
				if($infoInformativa){
					foreach ($infoInformativa as $lista):
						$arrParam = array(
								"idSitioSesion" => $lista['id_sitio_sesion'],
								"idAlerta" => $lista['id_alerta']
						);
						$respuesta = $this->general_model->get_respuestas_alertas_vencidas_by($arrParam);
						
						if($respuesta){
							$data['contadorInformativaSi']++;
						}else{
							$data['contadorInformativaNo']++;
						}
					endforeach;
				}
				
//conteo respuestas para alertas NOTIFICACION - ROL DELEGADO
				$arrParam = array(
								'tipoAlerta' => 2, //NOTIFICACION
								'rolAlerta' => 4, //representante
				);
				$infoNotificacion = $this->report_model->get_respuestas_registro_by_coordinador($arrParam);
				//recorro las alertas y reviso se se les dio respuesta, si no se le dio respuesta las voy contando
				$data['contadorNotificacionContestaron'] = 0;
				$data['contadorNotificacionSi'] = 0;
				$data['contadorNotificacionNoContestaron'] = 0;
				if($infoNotificacion){
					foreach ($infoNotificacion as $lista):
						$arrParam = array(
								"idSitioSesion" => $lista['id_sitio_sesion'],
								"idAlerta" => $lista['id_alerta']
						);
						$respuesta = $this->general_model->get_respuestas_alertas_vencidas_by($arrParam);
						
						$arrParam = array(
								"idSitioSesion" => $lista['id_sitio_sesion'],
								"idAlerta" => $lista['id_alerta'],
								"respuestaAcepta" => 1
						);//filtro por los que contestaron que SI
						$respuestaSI = $this->general_model->get_respuestas_alertas_vencidas_by($arrParam);
						
						if($respuestaSI){
							$data['contadorNotificacionSi']++;
						}
						
						if($respuesta){
							$data['contadorNotificacionContestaron']++;
						}else{
							$data['contadorNotificacionNoContestaron']++;
						}
					endforeach;
				}
				
//conteo respiestas para alertas CONSOLIDACION - ROL DELEGADO
				$arrParam = array(
								'tipoAlerta' => 3, //CONSOLIDACION
								'rolAlerta' => 4, //representante
				);
				$infoConsolidacion = $this->report_model->get_respuestas_registro_by_coordinador($arrParam);
				//recorro las alertas y reviso se se les dio respuesta, si no se le dio respuesta las voy contando
				$data['contadorConsolidacionSi'] = 0;
				$data['contadorConsolidacionNo'] = 0;
				if($infoConsolidacion){
					foreach ($infoConsolidacion as $lista):
						$arrParam = array(
								"idSitioSesion" => $lista['id_sitio_sesion'],
								"idAlerta" => $lista['id_alerta']
						);
						$respuesta = $this->general_model->get_respuestas_alertas_vencidas_by($arrParam);
						
						if($respuesta){
							$data['contadorConsolidacionSi']++;
						}else{
							$data['contadorConsolidacionNo']++;
						}
					endforeach;
				}


				$data["view"] = "lista_total_coordinador";
			}
			
			$this->load->view("layout", $data);
    }
	
	/**
	 * Formulario para actualizar la alerta de consolidacion
     * @since 9/8/2017
	 */
	public function update_alerta_consolidacion($idRegistro, $rol)
	{
			$data["rol"] = $rol;
			$this->load->model("general_model");
			//informacion de la respuesta
			$arrParam = array(
					"idRegistro" => $idRegistro
			);
			$data['infoRespuesta'] = $this->general_model->get_respuestas_alertas_vencidas_by($arrParam);

			//informacion de la alerta sesion y sitio
			$arrParam = array(
					"idSitioSesion" => $data['infoRespuesta'][0]['fk_id_sitio_sesion'],
					"idAlerta" => $data['infoRespuesta'][0]['fk_id_alerta']
			);
			$data['info'] = $this->general_model->get_informacion_respuestas_alertas_vencidas_by($arrParam);

			$data["view"] = 'form_update_alerta_consolidacion';
			$this->load->view("layout", $data);
	}
	
	/**
	 * Actualizacion de las alertas de consolidacion
	 * @since 11/8/2017
	 */
	public function update_registro_consolidacion_by_coordinador()
	{
			$data = array();
			$ausentes = $this->input->post('ausentes');
			$ausentesConfirmar = $this->input->post('ausentesConfirmar');
			$citados = $this->input->post('citados');

			$rol = $this->input->post('hddIdRol');
			$idAlerta = $this->input->post('hddIdAlerta');
			$idSitioSesion = $this->input->post('hddIdSitioSesion');
			$idDelegado = $this->input->post('hddIdUserDelegado');
			
			$idRegistro = $this->input->post('idRegistro');
			
			$error = false;
			
			
			
			if($ausentes == ""){
				$this->session->set_flashdata('retornoErrorConsolidacion', '<strong>Error!!!</strong> Debe indicar los ausentes.');
			}else{
				if($ausentes < 0){
					$this->session->set_flashdata('retornoErrorConsolidacion', '<strong>Error!!!</strong> La cantidad de ausentes no puede ser menor que 0.');
				}else{				
					if($ausentes != $ausentesConfirmar){
						$this->session->set_flashdata('retornoErrorConsolidacion', '<strong>Error!!!</strong> Confirmar la cantidad de ausentes.');
					}else{				
							if($ausentes > $citados){
								$this->session->set_flashdata('retornoErrorConsolidacion', '<strong>Error!!!</strong> La cantidad de ausentes no puede ser mayor a la cantidad de citados.');
							}else{
								if ($this->report_model->updateRegistroConsolidacionCoordinador()) 
								{
									$error = true;
									$this->session->set_flashdata('retornoExito', "Gracias por su respuesta.");
								} else {
									$this->session->set_flashdata('retornoErrorConsolidacion', '<strong>Error!!!</strong> Contactarse con el Administrador.');
								}
							}
					}
				}
			}
			

			redirect("/dashboard/" . $rol,"location",301);

	}
	
	
	
	

	
}