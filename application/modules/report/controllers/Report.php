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
    public function searchBy() 
	{
		
			//Lista Regiones
			$this->load->model("general_model");
			$arrParam = array(
				"table" => "param_regiones",
				"order" => "nombre_region",
				"id" => "x"
			);
			$data['listaRegiones'] = $this->general_model->get_basic_search($arrParam);//Lista Regiones
			
			//Lista Departamentos
			$this->load->model("general_model");
			$data['listaDepartamentos'] = $this->general_model->get_dpto_divipola();//listado de departamentos
			
			//lista sesiones
			$arrParam = array();
			$data['infoSesiones'] = $this->general_model->get_sesiones($arrParam);//lista sesiones
			
			$data["view"] = "form_search_by";

			if($_POST){
				
				

				$idRegion = $this->input->post('region');	
				$idRegion = $idRegion==""?FALSE:$idRegion;
				
				$depto = $this->input->post('depto');
				$mcpio = $this->input->post('mcpio');
				$sesion = $this->input->post('sesion');
				$alerta = $this->input->post('alerta');
				
				$arrParam = array(
					"table" => "param_regiones",
					"order" => "nombre_region",
					"column" => "id_region",
					"id" => $idRegion
				);
				$data['infoRegion'] = $this->general_model->get_basic_search($arrParam);//Info Regiones
				
				
				$data['info'] = $this->report_model->get_total_by();
				
//echo $this->db->last_query();				
//pr($data['info']); exit;
				$data["view"] = "lista_total";
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
	
	
	
	
	

	
}