<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anulaciones extends MX_Controller {
	
    public function __construct() {
        parent::__construct();
        $this->load->model("anulaciones_model");
		$this->load->library("validarsesion");
    }
	
	/**
	 * Lista de anulaciones para el sitio del delegado
     * @since 29/5/2017
     * @author BMOTTAG
	 */
	public function index()
	{
			$userRol = $this->session->userdata("rol");
			$userID = $this->session->userdata("id");
			if ($userRol != 4 ) { 
				show_error('ERROR!!! - You are in the wrong place.');	
			}
			
			$this->load->model("general_model");
			$arrParam = array("idDelegado" => $userID);
			$data['infoSitio'] = $this->general_model->get_sitios($arrParam);//informacion del sitio

			$arrParam = array("idSitio" => $data['infoSitio'][0]['id_sitio']);
			$data['info'] = $this->anulaciones_model->get_anulaciones($arrParam);//listado de anulaciones
			
			$data["view"] = 'anulaciones';
			$this->load->view("layout", $data);
	}
	
    /**
     * Cargo modal - formulario anulaciones
     * @since 29/5/2017
     */
    public function cargarModalAnulacion() 
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
			
			$data['information'] = FALSE;
			$data["idAnulacion"] = $this->input->post("identificador");

			$this->load->model("general_model");
			//lista de motivo de anulaciones
			$arrParam = array(
				"table" => "param_motivo_anulacion",
				"order" => "nombre_motivo_anulacion",
				"id" => "x"
			);
			$data['motivos'] = $this->general_model->get_basic_search($arrParam);//lista de motivo de anulaciones
			
			//busco si el sitio tiene asociadas sesiones
			$userID = $this->session->userdata("id");
			$arrParam = array("idDelegado" => $userID);
			$data['infoSitoDelegado'] = $this->general_model->get_sitios($arrParam);//busco el id del sitio
			
			$arrParam = array("idSitio" => $data['infoSitoDelegado'][0]['id_sitio']);
			$conteoSesiones = $this->general_model->countSesionesbySitio($arrParam);//reviso si el sitio tiene sesiones
			$data['infoSesiones'] = false;
			if($conteoSesiones != 0){//si tiene sesiones las busco
				$data['infoSesiones'] = $this->general_model->get_sesiones_sitio($arrParam);//sesiones del sitio
			}		

			if ($data["idAnulacion"] != 'x') 
			{
				$arrParam = array(
					"idAnulacion" => $data["idAnulacion"]
				);
				$data['information'] = $this->anulaciones_model->get_anulaciones($arrParam);
			}
			
			$this->load->view("anulaciones_modal", $data);
    }
	
	/**
	 * Guardar anulacion
     * @since 29/5/2017
	 */
	public function save_anulacion()
	{			
			header('Content-Type: application/json');
			$data = array();

			$idAnulacion = $this->input->post('hddId');

			$msj = "Se adicionó la anulación.";
			if ($idAnulacion != '') {
				$msj = "Se actualizó la anulación con exito.";
			}			

			$consecutivo = $this->input->post("consecutivo");
			$confirm = $this->input->post("confirmarConsecutivo");
			$consecutivo = str_replace(array("<",">","[","]","*","^","-","'","="),"",$consecutivo); 

			if($consecutivo != $confirm){
				$data["result"] = "error";
				$data["mensaje"] = "Los consecutivos no coinciden.";
			}else{
					//buscar el id de ese consecutivo
					$this->load->model("general_model");
					$arrParam = array(
							"consecutivo" => $consecutivo,
							"idMunicipio" => $this->input->post('hddIdMunicipio'),
							"codigoDane" => $this->input->post('hddCodigoDane')
					);
					$infoSNP = $this->general_model->get_examinandos_by($arrParam);
					
					if(!$infoSNP){
						$data["result"] = "error";
						$data["mensaje"] = "El SNP ingresado no se encontró en la base de datos.";
					}else{
						if ($this->anulaciones_model->saveAnulacion($infoSNP['id_examinando'])) {
							$data["result"] = true;
							$this->session->set_flashdata('retornoExito', $msj);
						} else {
							$data["result"] = "error";
							$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Contactarse con el administrador.');
						}
					}
			}

			echo json_encode($data);
    }
	
	/**
	 * Eliminar anulacion
     * @since 29/5/2017
	 */
	public function eliminar_anulacion()
	{			
			header('Content-Type: application/json');
			$data = array();
			
			$idAnulacion = $this->input->post('identificador');
			
			$this->load->model("general_model");
			//eliminaos registro
			$arrParam = array(
				"table" => "anulaciones",
				"primaryKey" => "id_anulacion",
				"id" => $idAnulacion
			);
				
			if ($this->general_model->deleteRecord($arrParam)) {
				$data["result"] = true;
				$data["mensaje"] = "Se eliminó la Anulación.";
				$this->session->set_flashdata('retornoExito', 'Se eliminó la Anulación');
			} else {
				$data["result"] = "error";
				$data["mensaje"] = "Error!!! Contactarse con el Administrador.";
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Contactarse con el Administrador');
			}


			echo json_encode($data);
    }
	

	
	
}