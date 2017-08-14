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
			$busqueda_1 = $this->input->post("busqueda_1");
			$busqueda_2 = $this->input->post("busqueda_2");

			if($consecutivo != $confirm){
				$data["result"] = "error";
				$data["mensaje"] = "Los consecutivos no coinciden.";
			} else {
				
				if($busqueda_1 =="" && $busqueda_2==""){
					$data["result"] = "error";
					$data["mensaje"] = "Seleccionar una de las busquedas.";
				} else {
				
					if($busqueda_1 !="" && $busqueda_2!=""){
						$data["result"] = "error";
						$data["mensaje"] = "Solo seleccionar una opción.";
					} else {
				
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
						
								if ($this->novedades_model->saveCambioCuadernillo($infoSNP['id_examinando'])) {
									$data["result"] = true;					
									$this->session->set_flashdata('retornoExito', $msj);
								} else {
									$data["result"] = "error";					
									$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Contactarse con el administrador.');
								}
							}
					}
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
    public function busquedaList($numeroBusqueda)
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
					"busqueda_" . $numeroBusqueda => $infoExaminando[0]['busqueda_' . $numeroBusqueda]
			);
			
			$lista = $this->general_model->get_busqueda_by($arrParam);

			echo "<option value=''>Select...</option>";
			if ($lista) {
				foreach ($lista as $fila) {
					echo "<option value='" . $fila["id_examinando"] . "' >" . $fila["snp"] . "</option>";
				}
			}
    }
	
	/**
	 * Lista de cambio de cuadernillo para el coordinador
     * @since 1/6/2017
	 */
	public function cambio_cuadernillo_coordinador()
	{
			$userRol = $this->session->userdata("rol");
			$userID = $this->session->userdata("id");
			if ($userRol != 3 ) { 
				show_error('ERROR!!! - You are in the wrong place.');	
			}
			
			$arrParam = array("idCoordinador" => $userID);
			$data['info'] = $this->novedades_model->get_cambio_cuadernillo($arrParam);//listado de anulaciones
			
			$data["view"] = 'cambio_cuadernillo_coordinador';
			$this->load->view("layout", $data);
	}

    /**
     * Cargo modal - formulario aprobar cambio de cuadernillo
     * @since 1/6/2017
     */
    public function cargarModalAprobarCambioCuadernillo() 
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
			
			$data['information'] = FALSE;
			$data["idCambioCuadernillo"] = $this->input->post("identificador");


			if ($data["idCambioCuadernillo"] != 'x') 
			{
				$arrParam = array(
					"idCambioCuadernillo" => $data["idCambioCuadernillo"]
				);
				$data['information'] = $this->novedades_model->get_cambio_cuadernillo($arrParam);//listado de anulaciones
			}
			
			$this->load->view("cambio_cuadernillo_aprobar_modal", $data);
    }	

	/**
	 * Guardar anulacion aprobacion
     * @since 1/6/2017
	 */
	public function save_cambio_cuadernillo_aprobacion()
	{			
			header('Content-Type: application/json');
			$data = array();

			$idAnulacion = $this->input->post('hddId');

			if ($this->novedades_model->saveCambioCuadernilloAprobar()) {
				$data["result"] = true;
				$this->session->set_flashdata('retornoExito', 'Se guardó con exito');
			} else {
				$data["result"] = "error";
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Contactarse con el administrador.');
			}

			echo json_encode($data);
    }

	/**
	 * Lista de holguras para el sitio del Delegado
     * @since 3/6/2017
	 */
	public function holgura()
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
			$data['info'] = $this->novedades_model->get_holguras($arrParam);//listado de holguras
			
			$data["view"] = 'holgura';
			$this->load->view("layout", $data);
	}
	
    /**
     * Cargo modal - formulario holgura
     * @since 3/6/2017
     */
    public function cargarModalHolgura() 
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
			
			$data['information'] = FALSE;
			$data["idHolgura"] = $this->input->post("identificador");

			$this->load->model("general_model");
			//lista de snp holguras
			$arrParam = array(
				"table" => "snp_holguras",
				"order" => "snp_holgura",
				"id" => "x"
			);
			$data['snpHolgura'] = $this->general_model->get_basic_search($arrParam);//lista de snp holguras

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

			if ($data["idHolgura"] != 'x') 
			{
				$arrParam = array(
					"idHolgura" => $data["idHolgura"]
				);
				$data['information'] = $this->novedades_model->get_holguras($arrParam);
			}
			
			$this->load->view("holgura_modal", $data);
    }
	
	/**
	 * Guardar holgura
     * @since 4/5/2017
	 */
	public function save_holgura()
	{			
			header('Content-Type: application/json');
			$data = array();
			
			$idHolgura = $this->input->post('hddId');

			$msj = "Se adicionó la holgura.";
			if ($idHolgura != '') {
				$msj = "Se actualizó la holgura.";
			}			

			$holgura = $this->input->post("holgura");
			$confirm = $this->input->post("confirmarHolgura");

			if($holgura != $confirm){
				$data["result"] = "error";
				$data["mensaje"] = "Los consecutivos no coinciden.";
			} else {
					//buscar el id de ese consecutivo
					$this->load->model("general_model");
					

					$arrParam = array(
						"table" => "snp_holguras",
						"order" => "id_snp_holgura",
						"column" => "consecutivo_holgura",
						"id" => $holgura
					);
					$holguras = $this->general_model->get_basic_search($arrParam);//lista de holguras
									
					if(!$holguras){
						$data["result"] = "error";
						$data["mensaje"] = "El SNP ingresado no se encontró en la base de datos.";
					}else{
							if ($this->novedades_model->saveHolgura($holguras[0]['id_snp_holgura'])) {
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
	 * Eliminar cambio de cuadernillo
     * @since 30/5/2017
	 */
	public function eliminar_holgura()
	{			
			header('Content-Type: application/json');
			$data = array();
			
			$idHolgura = $this->input->post('identificador');
			
			$this->load->model("general_model");
			//eliminaos registro
			$arrParam = array(
				"table" => "novedades_holgura",
				"primaryKey" => "id_holgura",
				"id" => $idHolgura
			);
				
			if ($this->general_model->deleteRecord($arrParam)) {
				$data["result"] = true;
				$data["mensaje"] = "Se eliminó la holgura.";
				$this->session->set_flashdata('retornoExito', 'Se eliminó la holgura');
			} else {
				$data["result"] = "error";
				$data["mensaje"] = "Error!!! Contactarse con el Administrador.";
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Contactarse con el Administrador');
			}


			echo json_encode($data);
    }
	
	/**
	 * Lista de holguras para el coordinador
     * @since 4/6/2017
	 */
	public function holgura_coordinador()
	{
			$userRol = $this->session->userdata("rol");
			$userID = $this->session->userdata("id");
			if ($userRol != 3 ) { 
				show_error('ERROR!!! - You are in the wrong place.');	
			}
			
			$arrParam = array("idCoordinador" => $userID);
			$data['info'] = $this->novedades_model->get_holguras($arrParam);//listado de holguras
			
			$data["view"] = 'holgura_coordinador';
			$this->load->view("layout", $data);
	}

    /**
     * Cargo modal - formulario aprobar holgura
     * @since 4/6/2017
     */
    public function cargarModalAprobarHolgura() 
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
			
			$data['information'] = FALSE;
			$data["idHolgura"] = $this->input->post("identificador");


			if ($data["idHolgura"] != 'x') 
			{
				$arrParam = array(
					"idHolgura" => $data["idHolgura"]
				);
				$data['information'] = $this->novedades_model->get_holguras($arrParam);//informacion holgura
			}
	
			$this->load->view("holgura_aprobar_modal", $data);
    }	

	/**
	 * Guardar holgura aprobacion
     * @since 4/6/2017
	 */
	public function save_holgura_aprobacion()
	{			
			header('Content-Type: application/json');
			$data = array();

			if ($this->novedades_model->saveHolguraAprobar()) {
				$data["result"] = true;
				$this->session->set_flashdata('retornoExito', 'Se guardó con exito');
			} else {
				$data["result"] = "error";
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Contactarse con el administrador.');
			}

			echo json_encode($data);
    }
	
	/**
	 * Lista de otras novedades para el sitio del Delegado
     * @since 7/8/2017
	 */
	public function otras()
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
			$data['info'] = $this->novedades_model->get_otras($arrParam);//listado de otras novedades
			
			$data["view"] = 'otras';
			$this->load->view("layout", $data);
	}
	
    /**
     * Cargo modal - formulario otras novedades
     * @since 7/8/2017
     */
    public function cargarModalOtras() 
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
			
			$data['information'] = FALSE;
			$data["idOtra"] = $this->input->post("identificador");

			$this->load->model("general_model");

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

			if ($data["idOtra"] != 'x') 
			{
				$arrParam = array(
					"idOtra" => $data["idOtra"]
				);
				$data['information'] = $this->novedades_model->get_otras($arrParam);
			}
			
			$this->load->view("otras_modal", $data);
    }
	
	/**
	 * Guardar otras novedades
     * @since 7/8/2017
	 */
	public function save_otras()
	{			
			header('Content-Type: application/json');
			$data = array();
			
			$idOtra = $this->input->post('hddId');

			$msj = "Se adicionó otra novedad.";
			if ($idOtra != '') {
				$msj = "Se actualizó la novedad.";
			}			

			if ($this->novedades_model->saveOtra()) {
				$data["result"] = true;					
				$this->session->set_flashdata('retornoExito', $msj);
			} else {
				$data["result"] = "error";					
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Contactarse con el administrador.');
			}



			echo json_encode($data);
    }
	
	/**
	 * Eliminar otra novedad
     * @since 7/8/2017
	 */
	public function eliminar_otra()
	{			
			header('Content-Type: application/json');
			$data = array();
			
			$idOtra = $this->input->post('identificador');
			
			$this->load->model("general_model");
			//eliminaos registro
			$arrParam = array(
				"table" => "novedades_otra",
				"primaryKey" => "id_otra",
				"id" => $idOtra
			);
				
			if ($this->general_model->deleteRecord($arrParam)) {
				$data["result"] = true;
				$data["mensaje"] = "Se eliminó la novedad.";
				$this->session->set_flashdata('retornoExito', 'Se eliminó la novedad');
			} else {
				$data["result"] = "error";
				$data["mensaje"] = "Error!!! Contactarse con el Administrador.";
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Contactarse con el Administrador');
			}


			echo json_encode($data);
    }
	
	/**
	 * Lista de otras novedades para el coordinador
     * @since 7/8/2017
	 */
	public function otra_coordinador()
	{
			$userRol = $this->session->userdata("rol");
			$userID = $this->session->userdata("id");
			if ($userRol != 3 ) { 
				show_error('ERROR!!! - You are in the wrong place.');	
			}
			
			$arrParam = array("idCoordinador" => $userID);
			$data['info'] = $this->novedades_model->get_otras($arrParam);//listado de otras novedades
			
			$data["view"] = 'otra_coordinador';
			$this->load->view("layout", $data);
	}

    /**
     * Cargo modal - formulario aprobar otra novedad
     * @since 7/8/2017
     */
    public function cargarModalAprobarOtra() 
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
			
			$data['information'] = FALSE;
			$data["idOtra"] = $this->input->post("identificador");


			if ($data["idOtra"] != 'x') 
			{
				$arrParam = array(
					"idOtra" => $data["idOtra"]
				);
				$data['information'] = $this->novedades_model->get_otras($arrParam);//informacion otra novedad
			}
	
			$this->load->view("otra_aprobar_modal", $data);
    }	

	/**
	 * Guardar otra novedad aprobacion
     * @since 7/8/2017
	 */
	public function save_otra_aprobacion()
	{			
			header('Content-Type: application/json');
			$data = array();

			if ($this->novedades_model->saveOtraAprobar()) {
				$data["result"] = true;
				$this->session->set_flashdata('retornoExito', 'Se guardó con exito');
			} else {
				$data["result"] = "error";
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Contactarse con el administrador.');
			}

			echo json_encode($data);
    }
	
    /**
     * Cargo modal - formulario para editar cambio de cuadernillo  por parte del coordinador
     * @since 14/8/2017
     */
    public function cargarModalEditarCambioCuadernillo() 
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
			
			$data['information'] = FALSE;
			
			$identificador = $this->input->post("identificador");			
			//como se coloca un ID diferente para que no entre en conflicto con los otros modales, toca sacar el ID
			$porciones = explode("-", $identificador);
			$data["idCambioCuadernillo"] = $porciones[1];

			$this->load->model("general_model");
			//lista de motivo de cambio cuadernillo
			$arrParam = array(
				"table" => "param_motivo_novedad",
				"order" => "id_motivo_novedad",
				"id" => "x"
			);
			$data['motivos'] = $this->general_model->get_basic_search($arrParam);//lista de motivo de anulaciones			

			if ($data["idCambioCuadernillo"] != 'x') 
			{
				$arrParam = array(
					"idCambioCuadernillo" => $data["idCambioCuadernillo"]
				);
				$data['information'] = $this->novedades_model->get_cambio_cuadernillo($arrParam);
				
				//busco si el sitio tiene asociadas sesiones			
				$arrParam = array("idSitio" => $data['information'][0]['id_sitio']);
				$conteoSesiones = $this->general_model->countSesionesbySitio($arrParam);//reviso si el sitio tiene sesiones
				$data['infoSesiones'] = false;
				if($conteoSesiones != 0){//si tiene sesiones las busco
					$data['infoSesiones'] = $this->general_model->get_sesiones_sitio($arrParam);//sesiones del sitio
				}
				
				//busco informacion del sitio
				$arrParam = array("idSitio" => $data['information'][0]['id_sitio']);
				$data['infoSitoDelegado'] = $this->general_model->get_sitios($arrParam);//busco el id del sitio
				
			}
			
			$this->load->view("cambio_cuadernillo_aprobar_editar_modal", $data);
    }
	
	/**
	 * Guardar cambio de cuadernillo
     * @since 14/8/2017
	 */
	public function update_cambio_cuadernillo()
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
			$busqueda_1 = $this->input->post("busqueda_1");
			$busqueda_2 = $this->input->post("busqueda_2");

			if($consecutivo != $confirm){
				$data["result"] = "error";
				$data["mensaje"] = "Los consecutivos no coinciden.";
			} else {
				
				if($busqueda_1 =="" && $busqueda_2==""){
					$data["result"] = "error";
					$data["mensaje"] = "Seleccionar una de las busquedas.";
				} else {
				
					if($busqueda_1 !="" && $busqueda_2!=""){
						$data["result"] = "error";
						$data["mensaje"] = "Solo seleccionar una opción.";
					} else {
				
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
						
								if ($this->novedades_model->updateCambioCuadernillo($infoSNP['id_examinando'])) {
									$data["result"] = true;					
									$this->session->set_flashdata('retornoExito', $msj);
								} else {
									$data["result"] = "error";					
									$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Contactarse con el administrador.');
								}
							}
					}
				}
			}

			echo json_encode($data);
    }	
	
    /**
     * Cargo modal - formulario holgura para editarlo por parte del coordinador
     * @since 14/8/2017
     */
    public function cargarModalEditarHolgura() 
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
			
			$data['information'] = FALSE;

			$identificador = $this->input->post("identificador");			
			//como se coloca un ID diferente para que no entre en conflicto con los otros modales, toca sacar el ID
			$porciones = explode("-", $identificador);
			$data["idHolgura"] = $porciones[1];

			$this->load->model("general_model");
			//lista de snp holguras
			$arrParam = array(
				"table" => "snp_holguras",
				"order" => "snp_holgura",
				"id" => "x"
			);
			$data['snpHolgura'] = $this->general_model->get_basic_search($arrParam);//lista de snp holguras
	

			if ($data["idHolgura"] != 'x') 
			{
				$arrParam = array(
					"idHolgura" => $data["idHolgura"]
				);
				$data['information'] = $this->novedades_model->get_holguras($arrParam);
		
				//busco si el sitio tiene asociadas sesiones			
				$arrParam = array("idSitio" => $data['information'][0]['id_sitio']);
				$conteoSesiones = $this->general_model->countSesionesbySitio($arrParam);//reviso si el sitio tiene sesiones
				$data['infoSesiones'] = false;
				if($conteoSesiones != 0){//si tiene sesiones las busco
					$data['infoSesiones'] = $this->general_model->get_sesiones_sitio($arrParam);//sesiones del sitio
				}
				
				//busco informacion del sitio
				$arrParam = array("idSitio" => $data['information'][0]['id_sitio']);
				$data['infoSitoDelegado'] = $this->general_model->get_sitios($arrParam);//busco el id del sitio
				
			}
			
			$this->load->view("holgura_aprobar_editar_modal", $data);
    }
	
	/**
	 * Guardar holgura
     * @since 14/8/2017
	 */
	public function update_holgura()
	{			
			header('Content-Type: application/json');
			$data = array();
			
			$idHolgura = $this->input->post('hddId');

			$msj = "Se adicionó la holgura.";
			if ($idHolgura != '') {
				$msj = "Se actualizó la holgura.";
			}			

			$holgura = $this->input->post("holgura");
			$confirm = $this->input->post("confirmarHolgura");

			if($holgura != $confirm){
				$data["result"] = "error";
				$data["mensaje"] = "Los consecutivos no coinciden.";
			} else {
					//buscar el id de ese consecutivo
					$this->load->model("general_model");
					

					$arrParam = array(
						"table" => "snp_holguras",
						"order" => "id_snp_holgura",
						"column" => "consecutivo_holgura",
						"id" => $holgura
					);
					$holguras = $this->general_model->get_basic_search($arrParam);//lista de holguras
									
					if(!$holguras){
						$data["result"] = "error";
						$data["mensaje"] = "El SNP ingresado no se encontró en la base de datos.";
					}else{
							if ($this->novedades_model->updateHolgura($holguras[0]['id_snp_holgura'])) {
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
     * Cargo modal - formulario otras novedades para editarlar por parte del coordinador
     * @since 14/8/2017
     */
    public function cargarModalEditarOtras() 
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
			
			$data['information'] = FALSE;
			
			$identificador = $this->input->post("identificador");			
			//como se coloca un ID diferente para que no entre en conflicto con los otros modales, toca sacar el ID
			$porciones = explode("-", $identificador);
			$data["idOtra"] = $porciones[1];

			$this->load->model("general_model");	

			if ($data["idOtra"] != 'x') 
			{
				$arrParam = array(
					"idOtra" => $data["idOtra"]
				);
				$data['information'] = $this->novedades_model->get_otras($arrParam);
				
				//busco si el sitio tiene asociadas sesiones			
				$arrParam = array("idSitio" => $data['information'][0]['id_sitio']);
				$conteoSesiones = $this->general_model->countSesionesbySitio($arrParam);//reviso si el sitio tiene sesiones
				$data['infoSesiones'] = false;
				if($conteoSesiones != 0){//si tiene sesiones las busco
					$data['infoSesiones'] = $this->general_model->get_sesiones_sitio($arrParam);//sesiones del sitio
				}
				
				//busco informacion del sitio
				$arrParam = array("idSitio" => $data['information'][0]['id_sitio']);
				$data['infoSitoDelegado'] = $this->general_model->get_sitios($arrParam);//busco el id del sitio
				
			}
			
			$this->load->view("otras_aprobar_editar_modal", $data);
    }
	
	/**
	 * Guardar otras novedades
     * @since 14/8/2017
	 */
	public function update_otras()
	{			
			header('Content-Type: application/json');
			$data = array();
			
			$idOtra = $this->input->post('hddId');

			$msj = "Se adicionó otra novedad.";
			if ($idOtra != '') {
				$msj = "Se actualizó la novedad.";
			}			

			if ($this->novedades_model->updateOtra()) {
				$data["result"] = true;					
				$this->session->set_flashdata('retornoExito', $msj);
			} else {
				$data["result"] = "error";					
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Contactarse con el administrador.');
			}



			echo json_encode($data);
    }
	
	
}