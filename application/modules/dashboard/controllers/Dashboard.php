<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MX_Controller {
	
    public function __construct() {
        parent::__construct();
		$this->load->model("dashboard_model");
    }

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{	
			$userRol = $this->session->userdata("rol");
			$userID = $this->session->userdata("id");
			/**
			 * Esta vista solo es para ADMINISTRADORES Y DIRECTIOVOS
			 */
			if($userRol==3 || $userRol==4){			
				show_error('ERROR!!! - You are in the wrong place.');
			}
			
			$this->load->model("general_model");

			$arrParam = array("tipoAlerta" => 1);
			$data['infoAlertaInformativa'] = $this->dashboard_model->get_alerta_by($arrParam);
			
			$arrParam = array("tipoAlerta" => 2);
			$data['infoAlertaNotificacion'] = $this->dashboard_model->get_alerta_by($arrParam);

			$arrParam = array("tipoAlerta" => 3);
			$data['infoAlertaConsolidacion'] = $this->dashboard_model->get_alerta_by($arrParam);
//echo $this->db->last_query();			
//pr($data['infoAlertaConsolidacion']); exit;	

	/**
	 * Datos para las cajas 
	 */
	 
	 //inicio consulta de pruebas vigentes
			$data['noPruebasVigentes'] = $this->dashboard_model->countPruebas();//cuenta de pruebas vigentes
			
			$year = date('Y');
			$arrParam = array(
				"table" => "pruebas",
				"order" => "nombre_prueba",
				"column" => "anio_prueba",
				"id" => $year
			);
			$data['infoPruebas'] = $this->general_model->get_basic_search($arrParam);//lista pruebas; se filtra por año actual
			
			
	//inicio consulta de numero de alertas
			$data['noRegistroInformativa'] = $this->dashboard_model->countAlertasByTipo(1);//cuenta de registro de informativa
			$data['noRegistroNotificacion'] = $this->dashboard_model->countAlertasByTipo(2);//cuenta de registro de notificaciones
			$data['noRegistroConsolidacion'] = $this->dashboard_model->countAlertasByTipo(3);//cuenta de registro de notificaciones
			
	//inicio consulta de sesiones que estan abiertas en un rango mayor a 7 dias y menor a 7 dias de la fecha actual
			$fecha = date("Y-m-d");
			$fechaInicio = strtotime ( '-7 day' , strtotime ( $fecha ) ) ;//le sumo 7 dias a la fecha actual
			$data['fechaInicio'] = date ( 'Y-m-d' , $fechaInicio );
			
			$fechaFin = strtotime ( '+7 day' , strtotime ( $fecha ) ) ;//le resto 7 dias a la fecha actual
			$data['fechaFin'] = date ( 'Y-m-d' , $fechaFin );

			$arrParam = array(
				"fechaInicio" => $data['fechaInicio'],
				"fechaFin" => $data['fechaFin']
			);
			$data['infoSesiones'] = $this->dashboard_model->get_sesiones_actuales($arrParam);
	
			$data["view"] = "dashboard";
			$this->load->view("layout", $data);
	}
	
	/**
	 * Registro de la aceptacion de la alerta informativa
	 * @since 19/5/2017
	 */
	public function registro_informativo()
	{
			$data = array();
			$userRol = $this->session->userdata("rol");
						
			$msj = "Gracias por su respuesta.";
			
			if ($this->dashboard_model->saveRegistroInformativo()) {
				$this->session->set_flashdata('retornoExito', $msj);
			} else {
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Contactarse con el Administrador.');
			}

			if($userRol==4){
				redirect("/dashboard/delegados","location",301);
			}else{
				redirect("/dashboard","location",301);	
			}
	}
	
	/**
	 * Registro de la aceptacion de la alerta notificacion
	 * @since 19/5/2017
	 */
	public function registro_notificacion()
	{
			$data = array();
			$userRol = $this->session->userdata("rol");

			$msj = "Gracias por su respuesta.";
			
			$acepta = $this->input->post('acepta');
			$observacion = $this->input->post('observacion');

			if($acepta==2 && $observacion == ""){
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Debe indicar la Observación.');
			}elseif($acepta==""){
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Debe indicar su respuesta.');
			}else{
				if ($this->dashboard_model->saveRegistroNotificacion()) {
					$this->session->set_flashdata('retornoExito', $msj);
				} else {
					$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Contactarse con el Administrador.');
				}
			}

			$userRol = $this->session->userdata("rol");
	
			if($userRol==4){
				redirect("/dashboard/delegados","location",301);
			}else{
				redirect("/dashboard","location",301);	
			}
	}
	
	/**
	 * Registro de la aceptacion de la alerta notificacion
	 * @since 19/5/2017
	 */
	public function registro_consolidacion()
	{
			$data = array();
			$userRol = $this->session->userdata("rol");
			$ausentes = $this->input->post('ausentes');
			$citados = $this->input->post('citados');
			
			//buscar datos de la tabla sitio_sesion		
			$infoSitioSesion = $this->dashboard_model->get_info_sitio_sesion();

			$msj = "Gracias por su respuesta.";

			if($ausentes == ""){
				$this->session->set_flashdata('retornoErrorConsolidacion', '<strong>Error!!!</strong> Debe indicar los ausentes.');
			}else{
				if($ausentes > $citados){
					$this->session->set_flashdata('retornoErrorConsolidacion', '<strong>Error!!!</strong> La cantidad de ausentes no puede ser mayor a la cantidad de citados.');
				}else{
					if ($this->dashboard_model->saveRegistroConsolidacion($infoSitioSesion)) {
						$this->session->set_flashdata('retornoExito', $msj);
					} else {
						$this->session->set_flashdata('retornoErrorConsolidacion', '<strong>Error!!!</strong> Contactarse con el Administrador.');
					}
				}
			}

			if($userRol==4){
				redirect("/dashboard/delegados","location",301);
			}else{
				redirect("/dashboard","location",301);	
			}
	}
	
	/**
	 * Controlador para delegados
	 */
	public function delegados()
	{	
			$userRol = $this->session->userdata("rol");
			$userID = $this->session->userdata("id");
	/**
	 * SI es delegado busco en que sitio esta asignado y que sesiones tiene pendientes
	 */
			if($userRol==4){
				$this->load->model("general_model");
				$arrParam = array("idDelegado" => $userID);
				$data['infoSitoDelegado'] = $this->general_model->get_sitios($arrParam);//informacion del sitio asignado al usuario
		
			}else{
				show_error('ERROR!!! - You are in the wrong place.');	
			}
			
			$arrParam = array("tipoAlerta" => 1);
			$data['infoAlertaInformativa'] = $this->dashboard_model->get_alerta_by($arrParam);
			
			$arrParam = array("tipoAlerta" => 2);
			$data['infoAlertaNotificacion'] = $this->dashboard_model->get_alerta_by($arrParam);

			$arrParam = array("tipoAlerta" => 3);
			$data['infoAlertaConsolidacion'] = $this->dashboard_model->get_alerta_by($arrParam);


			$data["view"] = "dashboard_delegado";
			$this->load->view("layout", $data);
	}
	
	/**
	 * Controlador para coordinadores
	 */
	public function coordinadores()
	{	
			$this->load->model("general_model");
			$userRol = $this->session->userdata("rol");
			$userID = $this->session->userdata("id");
	/**
	 * SI es coordinador busco los municipios en los que esta asignado
	 */
			if($userRol==3){
				$arrParam = array("idDelegado" => $userID);
				$data['infoMunicipiosCoordinador'] = $this->dashboard_model->get_municipios_coordinador();
			}else{
				show_error('ERROR!!! - You are in the wrong place.');	
			}
					
//se buscan las alertas asignadas al coordinador			
			$arrParam = array("tipoAlerta" => 1);
			$data['infoAlertaInformativa'] = $this->dashboard_model->get_alerta_by($arrParam);
			
			$arrParam = array("tipoAlerta" => 2);
			$data['infoAlertaNotificacion'] = $this->dashboard_model->get_alerta_by($arrParam);

			$arrParam = array("tipoAlerta" => 3);
			$data['infoAlertaConsolidacion'] = $this->dashboard_model->get_alerta_by($arrParam);


			
//se buscan las alertas informativas vencidas que tienen el coordinador a cargo
			$arrParam = array("tipoAlerta" => 1);
			$infoAlertaVencidaInformativa = $this->general_model->get_alertas_vencidas_by($arrParam);
			
			//recorro las alertas y reviso se se les dio respuesta, si no se le dio respuesta las voy contando
			$data['contadorInformativa'] = 0;
			if($infoAlertaVencidaInformativa){
				foreach ($infoAlertaVencidaInformativa as $lista):
					$arrParam = array(
							"idSitioSesion" => $lista['id_sitio_sesion'],
							"idAlerta" => $lista['id_alerta']
					);
					$respuesta = $this->general_model->get_respuestas_alertas_vencidas_by($arrParam);
					
					if(!$respuesta){
						$data['contadorInformativa']++;
					}
				endforeach;
			}
			

//se buscan las alertas NOTIFICACION vencidas que tienen el coordinador a cargo			
			$arrParam = array("tipoAlerta" => 2);
			$infoAlertaVencidaNotificacion = $this->general_model->get_alertas_vencidas_by($arrParam);

			//recorro las alertas y reviso se se les dio respuesta, si no se le dio respuesta las voy contando
			$data['contadorNotificacion'] = 0;
			if($infoAlertaVencidaNotificacion){
				foreach ($infoAlertaVencidaNotificacion as $lista):
					$arrParam = array(
							"idSitioSesion" => $lista['id_sitio_sesion'],
							"idAlerta" => $lista['id_alerta']
					);
					$respuesta = $this->general_model->get_respuestas_alertas_vencidas_by($arrParam);
					
					if(!$respuesta){
						$data['contadorNotificacion']++;
					}
				endforeach;
			}

			
			
//se buscan las alertas CONSOLIDACION vencidas que tienen el coordinador a cargo
			$arrParam = array("tipoAlerta" => 3);
			$infoAlertaVencidaConsolidacion = $this->general_model->get_alertas_vencidas_by($arrParam);
			
			//recorro las alertas y reviso se se les dio respuesta, si no se le dio respuesta las voy contando
			$data['contadorConsolidacion'] = 0;
			if($infoAlertaVencidaConsolidacion){
				foreach ($infoAlertaVencidaConsolidacion as $lista):
					$arrParam = array(
							"idSitioSesion" => $lista['id_sitio_sesion'],
							"idAlerta" => $lista['id_alerta']
					);
					$respuesta = $this->general_model->get_respuestas_alertas_vencidas_by($arrParam);
					
					if(!$respuesta){
						$data['contadorConsolidacion']++;
					}
				endforeach;
			}
			
			$data["view"] = "dashboard_coordinador";
			$this->load->view("layout", $data);
	}
	
	/**
	 * Lista de alertas sin respuesta del delegado
	 * @since 24/5/2017
	 */
	public function respuesta_coordinador($tipoAlerta)
	{
			$this->load->model("general_model");
			$arrParam = array("tipoAlerta" => $tipoAlerta);
			$data['infoAlertaVencida'] = $this->general_model->get_alertas_vencidas_by($arrParam);
			
			$data["view"] = "lista_respuestas_faltantes";
						
			$this->load->view("layout", $data);
	}
	
	
}

