<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sitios extends CI_Controller {
	
    public function __construct() {
        parent::__construct();
        $this->load->model("sitios_model");
		$this->load->helper('form');
    }
	
	/**
	 * Lista de sitios
     * @since 24/10/2017
     * @author BMOTTAG
	 */
	public function index()
	{
			$this->load->model("general_model");
			
			//listado de sitios
			$arrParam = array();
			$data['info'] = $this->general_model->get_sitios($arrParam);
			
			$data["view"] = 'sitios_list';			
			$this->load->view("layout", $data);
	}
	
	/**
	 * Lista de bloques y salones
	 */
	public function salones($idSitio)
	{		
			$this->load->model("general_model");
			//info de sitio
			$arrParam = array("idSitio" => $idSitio);
			$data['infoSitio'] = $this->general_model->get_sitios($arrParam);
			
			//lista de bloques
			$data['infoBloques'] = $this->general_model->get_sitios_bloques($arrParam);

			$data["view"] ='bloques&salones';
			$this->load->view("layout", $data);
	}

    /**
     * Cargo modal - formulario BLOQUES
     * @since 14/12/2017
     */
    public function cargarModalBloques() 
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
						
			$data['information'] = FALSE;
			$data["idSitio"] = $this->input->post("idSitio");
			$data["idBloque"] = $this->input->post("idBloque");
			
			if ($data["idBloque"] != 'x') {
				$this->load->model("general_model");
				$arrParam = array(
					"idBloque" => $data["idBloque"]
				);
				$data['information'] = $this->general_model->get_sitios_bloques($arrParam);//info bloques
				
				$data["idSitio"] = $data['information'][0]['fk_id_sitio'];
			}
			
			$this->load->view("form_bloque_modal", $data);
    }
	
	/**
	 * Guardar bloques
     * @since 14/12/2017
	 */
	public function save_bloques()
	{			
			header('Content-Type: application/json');
			$data = array();
			
			$idSitio = $this->input->post('hddIdSitio');
			$idBloque = $this->input->post('hddIdBloque');
			$data["idRecord"] = $idSitio;
			
			$msj = "Se adicionó el bloque con exito.";
			if ($idSitio != '') {
				$msj = "Se actualizó el bloque con exito.";
			}
			
			if ($idSitio = $this->sitios_model->saveBloques()) {
				$data["result"] = true;
				
				$this->session->set_flashdata('retornoExito', $msj);
			} else {
				$data["result"] = "error";
				
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Contactarse con el Administrador.');
			}

			echo json_encode($data);
    }
	
	/**
	 * Lista de salones por bloque
     * @since 14/12/2017
	 */
    public function salonesList()
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos

			$this->load->model("general_model");
			$arrParam['idBloque'] = $this->input->post('identificador');
			$lista = $this->general_model->get_salones_by($arrParam);
		
			echo "<option value=''>Select...</option>";
			if ($lista) {
				foreach ($lista as $fila) {
					echo "<option value='" . $fila["idMcpio"] . "' >" . $fila["municipio"] . "</option>";
				}
			}
    }
	
    /**
     * Cargo modal - formulario SALONES
     * @since 15/12/2017
     */
    public function cargarModalSalones() 
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
						
			$data['information'] = FALSE;
			$data["idSitio"] = $this->input->post("idSitio");
			$data["idBloque"] = $this->input->post("idBloque");
			
			if ($data["idBloque"] != 'x') {
				$this->load->model("general_model");
				$arrParam = array(
					"idBloque" => $data["idBloque"]
				);
				$data['information'] = $this->general_model->get_sitios_bloques($arrParam);//info bloques
				
				$data["idSitio"] = $data['information'][0]['fk_id_sitio'];
			}
			
			$this->load->view("form_bloque_modal", $data);
    }
	
	
	
}