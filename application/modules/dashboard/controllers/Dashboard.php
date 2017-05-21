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
			$this->load->model("general_model");
			$userRol = $this->session->userdata("rol");
	
			if(!$userRol){ //If it is a normal user, just show the records of the user session
				$arrParam["idEmployee"] = $this->session->userdata("id");
			}
			
			$arrParam = array("tipoAlerta" => 1);
			$data['infoAlertaInformativa'] = $this->dashboard_model->get_alerta_by($arrParam);
			
			$arrParam = array("tipoAlerta" => 2);
			$data['infoAlertaNotificacion'] = $this->dashboard_model->get_alerta_by($arrParam);

			$arrParam = array("tipoAlerta" => 3);
			$data['infoAlertaConsolidacion'] = $this->dashboard_model->get_alerta_by($arrParam);
//echo $this->db->last_query();			
//pr($data['infoAlertaConsolidacion']); exit;		
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
						
			$msj = "Gracias por su respuesta.";
			
			if ($this->dashboard_model->saveRegistroInformativo()) {
				$this->session->set_flashdata('retornoExito', $msj);
			} else {
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Contactarse con el Administrador.');
			}

			redirect("/dashboard","location",301);
	}
	
	/**
	 * Registro de la aceptacion de la alerta notificacion
	 * @since 19/5/2017
	 */
	public function registro_notificacion()
	{
			$data = array();

			$msj = "Gracias por su respuesta.";
			
			$acepta = $this->input->post('acepta');
			$observacion = $this->input->post('observacion');

			if($acepta && $acepta==2 && $observacion == ""){
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Debe indicar la Observación.');
			}else{
				if ($this->dashboard_model->saveRegistroNotificacion()) {
					$this->session->set_flashdata('retornoExito', $msj);
				} else {
					$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Contactarse con el Administrador.');
				}
			}

			redirect("/dashboard","location",301);
	}
	
	/**
	 * Registro de la aceptacion de la alerta notificacion
	 * @since 19/5/2017
	 */
	public function registro_consolidacion()
	{
			$data = array();
			$ausentes = $this->input->post('ausentes');
			
			//buscar datos de la tabla sitio_sesion		
			$infoSitioSesion = $this->dashboard_model->get_info_sitio_sesion();

			$msj = "Gracias por su respuesta.";

			if($ausentes == ""){
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Debe indicar los ausentes.');
			}else{
				if ($this->dashboard_model->saveRegistroConsolidacion($infoSitioSesion)) {
					$this->session->set_flashdata('retornoExito', $msj);
				} else {
					$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Contactarse con el Administrador.');
				}
			}


			redirect("/dashboard","location",301);
	}
	
}

