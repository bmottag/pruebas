<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Novedades extends MX_Controller {
	
    public function __construct() {
        parent::__construct();
        $this->load->model("novedades_model");
		$this->load->library("validarsesion");
    }
	
	/**
	 * Lista de cambios de cuadernillo para el sitio del Delegado
     * @since 30/5/2017
	 */
	public function cambio_cuadernillo()
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
			$data['info'] = $this->novedades_model->get_cambio_cuadernillo($arrParam);//listado de cambio de cuadernillo
			
			$data["view"] = 'cambio_cuadernillo';
			$this->load->view("layout", $data);
	}
	
    /**
     * Cargo modal - formulario cambio de cuadernillo
     * @since 30/5/2017
     */
    public function cargarModalCambioCuadernillo() 
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
			
			$data['information'] = FALSE;
			$data["idCambioCuadernillo"] = $this->input->post("identificador");

			$this->load->model("general_model");
			//lista de motivo de cambio cuadernillo
			$arrParam = array(
				"table" => "param_motivo_novedad",
				"order" => "id_motivo_novedad",
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

			if ($data["idCambioCuadernillo"] != 'x') 
			{
				$arrParam = array(
					"idCambioCuadernillo" => $data["idCambioCuadernillo"]
				);
				$data['information'] = $this->novedades_model->get_cambio_cuadernillo($arrParam);
			}
			
			$this->load->view("cambio_cuadernillo_modal", $data);
    }
	
	/**
	 * Guardar cambio de cuadernillo
     * @since 30/5/2017
	 */
	public function save_cambio_cuadernillo()
	{			
			header('Content-Type: application/json');
			$data = array();
			
			$idAnulacion = $this->input->post('hddId');

			$msj = "Se adicionó el cambio de cudernillo.";
			if ($idAnulacion != '') {
				$msj = "Se actualizó el cambio de cuadernillo.";
			}			

			$consecutivo = $this->input->post("consecutivo");
			$confirm = $this->input->post("confirmarConsecutivo");

			if($consecutivo != $confirm){
				$data["result"] = "error";
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Los consecutivos no coinciden.');
			} else {
					//buscar el id de ese consecutivo
					$this->load->model("general_model");
					$arrParam = array(
							"consecutivo" => $consecutivo,
							"idMunicipio" => $this->input->post('hddIdMunicipio'),
							"codigoDane" => $this->input->post('hddCodigoDane')
					);
					$infoSNP = $this->general_model->get_examinandos_by($arrParam);
				
					if ($this->novedades_model->saveCambioCuadernillo($infoSNP['id_examinando'])) {
						$data["result"] = true;					
						$this->session->set_flashdata('retornoExito', $msj);
					} else {
						$data["result"] = "error";					
						$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Contactarse con el administrador.');
					}
			}

			echo json_encode($data);
    }
		
	/**
	 * Eliminar cambio de cuadernillo
     * @since 30/5/2017
	 */
	public function eliminar_cambio_cuadernillo()
	{			
			header('Content-Type: application/json');
			$data = array();
			
			$idCambioCuadernillo = $this->input->post('identificador');
			
			$this->load->model("general_model");
			//eliminaos registro
			$arrParam = array(
				"table" => "novedades_cambio_cuadernillo",
				"primaryKey" => "id_cambio_cuadernillo",
				"id" => $idCambioCuadernillo
			);
				
			if ($this->general_model->deleteRecord($arrParam)) {
				$data["result"] = true;
				$data["mensaje"] = "Se eliminó el cambio de cuadernillo.";
				$this->session->set_flashdata('retornoExito', 'Se eliminó el cambio de cuadernillo');
			} else {
				$data["result"] = "error";
				$data["mensaje"] = "Error!!! Contactarse con el Administrador.";
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Contactarse con el Administrador');
			}


			echo json_encode($data);
    }
	
	/**
	 * Lista de busquedas 
     * @since 30/5/2017
	 */
    public function busquedaList()
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
			
			$consecutivo = $this->input->post('consecutivo');
			
			$this->load->model("general_model");
			//busco informacion del SNP
			$arrParam = array(
				"table" => "examinandos",
				"order" => "snp",
				"column" => "consecutivo",
				"id" => $consecutivo
			);
			$infoExaminando = $this->general_model->get_basic_search($arrParam);//busco informacion del SNP

			$arrParam = array(
					"consecutivo" => $consecutivo,
					"idMunicipio" => $this->input->post('idMunicipio'),
					"codigoDane" => $this->input->post('codigoDane'),
					"busqueda_1" => $infoExaminando[0]['busqueda_1'],
					"busqueda_2" => $infoExaminando[0]['busqueda_2']
			);
			
			$lista = $this->general_model->get_busqueda_by($arrParam);

			echo "<option value=''>Select...</option>";
			if ($lista) {
				foreach ($lista as $fila) {
					echo "<option value='" . $fila["id_examinando"] . "' >" . $fila["snp"] . "</option>";
				}
			}
    }
	

	
	
}