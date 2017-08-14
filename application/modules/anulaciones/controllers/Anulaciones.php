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
	
	/**
	 * evidencia
	 */
	public function evidencia($idAnulacion, $error = '')
	{		
			//busco info de la anulacion
			$arrParam = array(
					"idAnulacion" => $idAnulacion
				);
			$data['information'] = $this->anulaciones_model->get_anulaciones($arrParam);
			$data['tipo'] = "evidencia";
			$data['mensaje'] = "Guardar la foto de la evidencia";
						
			$data['error'] = $error; //se usa para mostrar los errores al cargar la imagen 
			$data["view"] = 'form_imagen';
			$this->load->view("layout", $data);
	}
	
	/**
	 * acta
	 */
	public function acta($idAnulacion, $error = '')
	{		
			//busco info de la anulacion
			$arrParam = array(
					"idAnulacion" => $idAnulacion
				);
			$data['information'] = $this->anulaciones_model->get_anulaciones($arrParam);
			$data['tipo'] = "acta";
			$data['mensaje'] = "Guardar la foto del acta de anulación";
						
			$data['error'] = $error; //se usa para mostrar los errores al cargar la imagen 
			$data["view"] = 'form_imagen';
			$this->load->view("layout", $data);
	}
	
    //FUNCIÓN PARA SUBIR LA IMAGEN 
    function do_upload() 
	{
			$config['upload_path'] = './images/anulaciones/';
			$config['overwrite'] = true;
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = '2000';
			$config['max_width'] = '1024';
			$config['max_height'] = '1008';
			$idAnulacion = $this->input->post("hddId");
			$tipo = $this->input->post("tipo");
			$config['file_name'] = $idAnulacion . "_" . $tipo;

			$this->load->library('upload', $config);
			//SI LA IMAGEN FALLA AL SUBIR MOSTRAMOS EL ERROR EN LA VISTA 
			if (!$this->upload->do_upload()) {
				$error = $this->upload->display_errors();
				$this->$tipo($idAnulacion,$error);
			} else {
				$file_info = $this->upload->data();//subimos la imagen
				
				//USAMOS LA FUNCIÓN create_thumbnail Y LE PASAMOS EL NOMBRE DE LA IMAGEN,
				//ASÍ YA TENEMOS LA IMAGEN REDIMENSIONADA
				$this->_create_thumbnail($file_info['file_name']);
				$data = array('upload_data' => $this->upload->data());
				$imagen = $file_info['file_name'];
				$path = "images/anulaciones/thumbs/" . $imagen;

				//actualizamos el campo photo
				$arrParam = array(
					"table" => "anulaciones",
					"primaryKey" => " 	id_anulacion",
					"id" => $idAnulacion,
					"column" => $tipo,
					"value" => $path
				);

				$this->load->model("general_model");
				$data['linkBack'] = "anulaciones";
				$data['titulo'] = "<i class='fa fa-user fa-fw'></i>" . strtoupper($tipo) . " ANULACIÓN";
				
				if($this->general_model->updateRecord($arrParam))
				{
					$data['clase'] = "alert-success";
					$data['msj'] = "Se guardó la imagen con exito.";
				}else{
					$data['clase'] = "alert-danger";
					$data['msj'] = "Contactarse con el administrador.";
				}
							
				$data["view"] = 'template/answer';
				$this->load->view("layout", $data);
				//redirect('employee/photo');
			}
    }
	
    //FUNCIÓN PARA CREAR LA MINIATURA A LA MEDIDA QUE LE DIGAMOS
    function _create_thumbnail($filename) 
	{
        $config['image_library'] = 'gd2';
        //CARPETA EN LA QUE ESTÁ LA IMAGEN A REDIMENSIONAR
        $config['source_image'] = 'images/anulaciones/' . $filename;
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        //CARPETA EN LA QUE GUARDAMOS LA MINIATURA
        $config['new_image'] = 'images/anulaciones/thumbs/';
        $config['width'] = 150;
        $config['height'] = 150;
        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
    }
	
	/**
	 * Lista de anulaciones para el coordinador
     * @since 1/6/2017
	 */
	public function anulaciones_coordinador()
	{
			$userRol = $this->session->userdata("rol");
			$userID = $this->session->userdata("id");
			if ($userRol != 3 ) { 
				show_error('ERROR!!! - You are in the wrong place.');	
			}
			
			$arrParam = array("idCoordinador" => $userID);
			$data['info'] = $this->anulaciones_model->get_anulaciones($arrParam);//listado de anulaciones
			
			$data["view"] = 'anulaciones_coordinador';
			$this->load->view("layout", $data);
	}

    /**
     * Cargo modal - formulario aprobar anulaciones
     * @since 29/5/2017
     */
    public function cargarModalAprobarAnulacion() 
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

			if ($data["idAnulacion"] != 'x') 
			{
				$arrParam = array(
					"idAnulacion" => $data["idAnulacion"]
				);
				$data['information'] = $this->anulaciones_model->get_anulaciones($arrParam);
			}
			
			$this->load->view("anulaciones_aprobar_modal", $data);
    }	

	/**
	 * Guardar anulacion aprobacion
     * @since 1/6/2017
	 */
	public function save_anulacion_aprobacion()
	{			
			header('Content-Type: application/json');
			$data = array();

			$idAnulacion = $this->input->post('hddId');

			if ($this->anulaciones_model->saveAnulacionAprobar()) {
				$data["result"] = true;
				$this->session->set_flashdata('retornoExito', 'Se guardó con exito');
			} else {
				$data["result"] = "error";
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Contactarse con el administrador.');
			}

			echo json_encode($data);
    }
	
	/**
	 * Guardar imagen
     * @since 6/8/2017
	 */
	public function ajax()
	{		
			$src = $this->input->post('src');
			$tipo = $this->input->post('tipo');
			$idAnulacion = $this->input->post('idAnulacion');

			//actualizamos el campo coordinador en la lista de municipios
			$arrParam = array(
				"table" => "anulaciones",
				"primaryKey" => "id_anulacion",
				"id" => $idAnulacion,
				"column" => "foto_" . $tipo,
				"value" => $src
			);

			$this->load->model("general_model");

			if ($this->general_model->updateRecord($arrParam)) {				
					$data["result"] = true;
					$this->session->set_flashdata('retornoExito', 'Se guardó la información');
			}else{
					$data["result"] = "error";				
					$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Contactarse con el Administrador.');					
			}
			
			$this->output->set_output($src);
	}
	
    /**
     * Cargo modal - formulario para editar una anulacion por parte del coordinador
     * @since 14/8/2017
     */
    public function cargarModalEditarAnulacion() 
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
			
			$data['information'] = FALSE;
			

			$identificador = $this->input->post("identificador");			
			//como se coloca un ID diferente para que no entre en conflicto con los otros modales, toca sacar el ID
			$porciones = explode("-", $identificador);
			$data["idAnulacion"] = $porciones[1];

			$this->load->model("general_model");
			//lista de motivo de anulaciones
			$arrParam = array(
				"table" => "param_motivo_anulacion",
				"order" => "nombre_motivo_anulacion",
				"id" => "x"
			);
			$data['motivos'] = $this->general_model->get_basic_search($arrParam);//lista de motivo de anulaciones
			

			if ($data["idAnulacion"] != 'x') 
			{
				$arrParam = array(
					"idAnulacion" => $data["idAnulacion"]
				);
				$data['information'] = $this->anulaciones_model->get_anulaciones($arrParam);
				
				
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
			
			$this->load->view("anulaciones_aprobar_editar_modal", $data);
    }
	
	/**
	 * Guardar anulacion
     * @since 14/8/2017
	 */
	public function update_anulacion()
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
						if ($this->anulaciones_model->updateAnulacion($infoSNP['id_examinando'])) {
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

	
	
}