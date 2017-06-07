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
    public function registros($tipoAlerta) 
	{

			$data["titulo"] = "<i class='fa fa-book fa-fw'></i> PAYROLL REPORT";
			
			switch ($tipoAlerta) {
				case 1:
					$data["view"] = "lista_informativa";
					break;
				case 2:
					$data["view"] = "lista_notificacion";
					break;
				case 3:
					$data["view"] = "lista_consolidado";
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
			//Lista Regiones
			$this->load->model("general_model");
			$arrParam = array(
				"table" => "param_regiones",
				"order" => "nombre_region",
				"id" => "x"
			);
			$data['listaRegiones'] = $this->general_model->get_basic_search($arrParam);//Lista Regiones
			
			//Lista Departamentos
			$data['listaDepartamentos'] = $this->general_model->get_dpto_divipola();//listado de departamentos
			
			//lista sesiones
			$arrParam = array();
			$data['infoSesiones'] = $this->general_model->get_sesiones($arrParam);//lista sesiones
			
			$data["view"] = "form_search_by";

			if($this->input->post('sesion'))
			{
				$sesion = $this->input->post('sesion');
				
				$alerta = $this->input->post('alerta');
				$alerta = $alerta==""?FALSE:$alerta;
				
				$idRegion = $this->input->post('region');	
				$idRegion = $idRegion==""?FALSE:$idRegion;
				
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
						$data['infoAlerta'] = $this->general_model->get_basic_search($arrParam);//Info Departamento para mostrar la region por la que se filtro
				}
				
				//Info Regiones
				if($idRegion){
						$arrParam = array(
							"table" => "param_regiones",
							"order" => "nombre_region",
							"column" => "id_region",
							"id" => $idRegion
						);
						$data['infoRegion'] = $this->general_model->get_basic_search($arrParam);//Info Regiones para mostrar la region por la que se filtro
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
				
				
				//CUANDO SE ESTA BUSCANDO INFORMAICION DE LAS ALERTAS
				if($this->input->post('tipoAlerta'))
				{				
						$arrParam = array(
									"tipoAlerta" => $this->input->post('tipoAlerta'),
									"respuestaUsuario" => $this->input->post('respuesta'),
									"rolAlerta" => 4
						);
						$data['info'] = $this->report_model->get_total_by($arrParam);
				}
				
				//conteo de los sitios segun el filtro
				$data['conteoSitios'] = $this->report_model->get_numero_sitios_por_filtro($arrParam);
				
				$data['conteoCitados'] = $this->report_model->get_numero_citados_por_filtro($arrParam);
//pr($data['conteoCitados']);
//echo$this->db->last_query();exit;
				
//conteo respuestas para alertas INFORMATIVAS - ROL DELEGADO
				$arrParam = array(
								'tipoAlerta' => 1, //INFORMATIVA
								'rolAlerta' => 4, //DELEGADO
				);
				$infoInformativa = $this->report_model->get_respuestas_registro($arrParam);//alertas vigentes para los filtros
				
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
								'rolAlerta' => 4, //DELEGADO
				);
				$infoNotificacion = $this->report_model->get_respuestas_registro($arrParam);
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
								'rolAlerta' => 4, //DELEGADO
				);
				$infoConsolidacion = $this->report_model->get_respuestas_registro($arrParam);
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


				$data["view"] = "lista_total";
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
			
			$acepta = $this->input->post('acepta');
			$observacion = $this->input->post('observacion');

			if($acepta && $acepta==2 && $observacion == ""){
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Debe indicar la Observación.');
			}elseif($acepta==""){
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Debe indicar su respuesta.');
			}else{
				if ($this->report_model->saveRegistroNotificacionCoordinador()) {
					$this->session->set_flashdata('retornoExito', "Gracias por su respuesta.");
				} else {
					$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Contactarse con el Administrador.');
				}
			}

			redirect("/dashboard/" . $rol,"location",301);
	}
	
	/**
	 * Registro de la aceptacion de la alerta notificacion
	 * @since 19/5/2017
	 */
	public function registro_consolidacion_by_coordinador()
	{
			$data = array();
			$ausentes = $this->input->post('ausentes');
			$citados = $this->input->post('citados');

			$rol = $this->input->post('hddIdRol');

			if($ausentes == ""){
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Debe indicar los ausentes.');
			}else{
				if($ausentes > $citados){
					$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> La cantidad de ausentes no puede ser mayor a la cantidad de citados.');
				}else{
					if ($this->report_model->saveRegistroConsolidacionCoordinador()) {
						$this->session->set_flashdata('retornoExito', "Gracias por su respuesta.");
					} else {
						$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Contactarse con el Administrador.');
					}
				}
			}


			redirect("/dashboard/" . $rol,"location",301);
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
			$data['rol_busqueda'] = "Coordinadores";
			//Lista Regiones
			$this->load->model("general_model");
			$arrParam = array(
				"table" => "param_regiones",
				"order" => "nombre_region",
				"id" => "x"
			);
			$data['listaRegiones'] = $this->general_model->get_basic_search($arrParam);//Lista Regiones
			
			//Lista Departamentos
			$data['listaDepartamentos'] = $this->general_model->get_dpto_divipola();//listado de departamentos
			
			//lista sesiones
			$arrParam = array();
			$data['infoSesiones'] = $this->general_model->get_sesiones($arrParam);//lista sesiones
			
			$data["view"] = "form_search_by";

			if($this->input->post('sesion'))
			{
				$sesion = $this->input->post('sesion');
				
				$alerta = $this->input->post('alerta');
				$alerta = $alerta==""?FALSE:$alerta;
				
				$idRegion = $this->input->post('region');	
				$idRegion = $idRegion==""?FALSE:$idRegion;
				
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
				
				//Info Regiones
				if($idRegion){
						$arrParam = array(
							"table" => "param_regiones",
							"order" => "nombre_region",
							"column" => "id_region",
							"id" => $idRegion
						);
						$data['infoRegion'] = $this->general_model->get_basic_search($arrParam);//Info Regiones para mostrar la region por la que se filtro
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
				$data['conteoSitios'] = $this->report_model->get_numero_sitios_por_filtro($arrParam);
				
				$data['conteoCitados'] = $this->report_model->get_numero_citados_por_filtro($arrParam);
//pr($data['conteoCitados']);
//echo$this->db->last_query();exit;
				
//conteo respuestas para alertas INFORMATIVAS - ROL COORDINADOR
				$arrParam = array(
								'tipoAlerta' => 1, //INFORMATIVA
								'rolAlerta' => 3, //COORDINADOR
				);
				$infoInformativa = $this->report_model->get_respuestas_registro($arrParam);//alertas vigentes para los filtros
				
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
								'rolAlerta' => 3, //COORDINADOR
				);
				$infoNotificacion = $this->report_model->get_respuestas_registro($arrParam);
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
								'rolAlerta' => 3, //COORDINADOR
				);
				$infoConsolidacion = $this->report_model->get_respuestas_registro($arrParam);
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


				$data["view"] = "lista_total";
			}
			
			$this->load->view("layout", $data);
    }
	
	
	
	
	

	
}