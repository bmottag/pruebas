<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {
	
    public function __construct() {
        parent::__construct();
		$this->load->model("report_model");
		//$this->load->library('PHPExcel.php');
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
			$data['infoAlerta'] = $this->report_model->get_consolidado_by($arrParam);
//echo $this->db->last_query();			
//pr($data['infoAlerta']); exit;
						
			$this->load->view("layout", $data);
    }
	
	/**
	 * Buscar por regiones
     * @since 21/05/2017
	 */
    public function searchByRegiones() 
	{
			$data["titulo"] = "<i class='fa fa-book fa-fw'></i> Buscar Sitios por Regiones";
			$data["subTitulo"] = "Región";
			$data["botonRegreso"] = "report/searchByRegiones";
			$data['listaDepartamentos'] = FALSE;//lista para filtrar por departamentos
			
			//Lista Regiones
			$this->load->model("general_model");
			$arrParam = array(
				"table" => "param_regiones",
				"order" => "nombre_region",
				"id" => "x"
			);
			$data['listaRegiones'] = $this->general_model->get_basic_search($arrParam);//Lista Regiones
			
			$data["view"] = "form_search_by";

			if($idRegion = $this->input->post('region')){
				
				$arrParam = array(
					"table" => "param_regiones",
					"order" => "nombre_region",
					"column" => "id_region",
					"id" => $idRegion
				);
				$data['infoRegion'] = $this->general_model->get_basic_search($arrParam);//Info Regiones
				
				$arrParam = array("idRegion" => $idRegion);
				$data['info'] = $this->report_model->get_sitios_by($arrParam);
				$data["view"] = "lista_sitios_by";
			}
			
			$this->load->view("layout", $data);
    }
	
	/**
	 * Buscar por Departamento
     * @since 21/05/2017
	 */
    public function searchByDepartamento() 
	{
			$data["titulo"] = "<i class='fa fa-book fa-fw'></i> Buscar Sitios por Departamento - Municipio";
			$data["subTitulo"] = "Departamento";
			$data["botonRegreso"] = "report/searchByDepartamento";
			$data['listaRegiones'] = FALSE;//lista para filtrar por regiones
			
			//Lista Departamentos
			$this->load->model("general_model");
			$data['listaDepartamentos'] = $this->general_model->get_dpto_divipola();//listado de departamentos
			
			$data["view"] = "form_search_by";

			if($idDepto = $this->input->post('depto')){
				
				$arrParam = array(
					"table" => "param_divipola",
					"order" => "dpto_divipola",
					"column" => "dpto_divipola",
					"id" => $idDepto
				);
				$data['infoDepartamento'] = $this->general_model->get_basic_search($arrParam);//Info Depto
				
				$arrParam = array("idDepto" => $idDepto);
				$data['info'] = $this->report_model->get_sitios_by($arrParam);
				$data["view"] = "lista_sitios_by";
			}
			
			$this->load->view("layout", $data);
    }
	
    /**
     * Cargo modal - lista de sesiones
     * @since 21/5/2017
     */
    public function mostrarSesiones($idSitio) 
	{
			$data["botonRegreso"] = "report/searchByRegiones";
							
			$this->load->model("general_model");
			$arrParam = array("idSitio" => $idSitio);
			$data['info'] = $this->report_model->get_sesiones_by($arrParam);

			$data['infoSitio'] = $this->general_model->get_sitios($arrParam);
			
			$data["view"] = "lista_sesinones_by_sitio";
			$this->load->view("layout", $data);


    }
	
	
	
	
	

	
}