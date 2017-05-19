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
			$arrParam["limit"] = 15;//Limite de registros para la consulta
			
			$arrParam = array("tipoAlerta" => 1);
			$data['infoAlertaInformativa'] = $this->dashboard_model->get_alerta_by($arrParam);
			
			$arrParam = array("tipoAlerta" => 2);
			$data['infoAlertaNotificacion'] = $this->dashboard_model->get_alerta_by($arrParam);
			
			$arrParam = array("tipoAlerta" => 3);
			$data['infoAlertaConsolidacion'] = $this->dashboard_model->get_alerta_by($arrParam);
		
			$data["view"] = "dashboard";
			$this->load->view("layout", $data);
	}
}