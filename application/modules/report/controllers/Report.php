<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {
	
    public function __construct() {
        parent::__construct();
		$this->load->model("report_model");
		//$this->load->library('PHPExcel.php');
    }
	
	/**
	 * Search
     * @since 24/11/2016
     * @author BMOTTAG
	 */
    public function payrollSearch() 
	{
			$this->load->view("layout", $data);
    }
	
	/**
	 * Search by daterange safety reports
     * @since 6/01/2017
     * @author BMOTTAG
	 */
    public function searchByDateRange($tipoAlerta) 
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
	
	
	
	
	
	
	
	

	
}
