<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class More extends MX_Controller {
	
    public function __construct() {
        parent::__construct();
        $this->load->model("more_model");
		$this->load->library("validarsesion");
    }
	
	/**
	 * Lista de REGIONES	
     * @since 16/1/2018
	 */
	public function region()
	{
			$this->load->model("general_model");

			$arrParam = array();
			//lista de regiones
			$data['info'] = $this->general_model->get_regiones($arrParam);
			
			$data["view"] = 'region';
			$this->load->view("layout", $data);
	}
	
    /**
     * Cargo modal - formulario REGION
     * @since 16/1/2018
     */
    public function cargarModalRegion() 
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
			
			$data['information'] = FALSE;
			$data["idRegion"] = $this->input->post("idRegion");
			
			if ($data["idRegion"] != 'x') {
				$this->load->model("general_model");
				$arrParam = array("idRegion" => $data["idRegion"]);
				$data['information'] = $this->general_model->get_regiones($arrParam);
			}
			
			$this->load->view("region_modal", $data);
    }
	
	/**
	 * Update Region
     * @since 16/1/2018
	 */
	public function save_region()
	{			
			header('Content-Type: application/json');
			$data = array();
			
			$idRegion = $this->input->post('hddId');
			
			$msj = "Se adicionó la Región con éxito.";
			if ($idRegion != '') {
				$msj = "Se actualizó la Región con éxito.";
			}

			if ($idRegion = $this->more_model->saveRegion()) {
				$data["result"] = true;
				$data["idRecord"] = $idRegion;
				
				$this->session->set_flashdata('retornoExito', $msj);
			} else {
				$data["result"] = "error";
				$data["idRecord"] = "";
				
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Contactarse con el Administrador.');
			}

			echo json_encode($data);
    }
	
	/**
	 * Lista de ZONAS	
     * @since 17/1/2018
	 */
	public function zona()
	{
			$this->load->model("general_model");

			$arrParam = array();
			//lista de regiones
			$data['info'] = $this->general_model->get_zonas($arrParam);
			
			$data["view"] = 'zona';
			$this->load->view("layout", $data);
	}
	
    /**
     * Cargo modal - formulario ZONA
     * @since 17/1/2018
     */
    public function cargarModalZona() 
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
			
			$data['information'] = FALSE;
			$data["idZona"] = $this->input->post("idZona");
			
			if ($data["idZona"] != 'x') {
				$this->load->model("general_model");
				$arrParam = array("idZona" => $data["idZona"]);
				$data['information'] = $this->general_model->get_zonas($arrParam);
			}
			
			$this->load->view("zona_modal", $data);
    }
	
	/**
	 * Update Zona
     * @since 17/1/2018
	 */
	public function save_zona()
	{			
			header('Content-Type: application/json');
			$data = array();
			
			$idZona = $this->input->post('hddId');
			
			$msj = "Se adicionó la Zona con éxito.";
			if ($idZona != '') {
				$msj = "Se actualizó la Zona con éxito.";
			}

			if ($idZona = $this->more_model->saveZona()) {
				$data["result"] = true;
				$data["idRecord"] = $idZona;
				
				$this->session->set_flashdata('retornoExito', $msj);
			} else {
				$data["result"] = "error";
				$data["idRecord"] = "";
				
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Contactarse con el Administrador.');
			}

			echo json_encode($data);
    }	
	
	

	
	
}