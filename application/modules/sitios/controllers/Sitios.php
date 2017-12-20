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
     * @since 14/12/2017
     * @author BMOTTAG
	 */
	public function index()
	{
			$this->load->model("general_model");
			
			//listado de sitios
			$arrParam = array();
			$data['info'] = $this->general_model->get_sitios($arrParam);
			
			$data['departamentos'] = $this->general_model->get_dpto_divipola();//listado de departamentos
	
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
		
			//lista de salones para el primer bloque de la lista anterior
			$data['infoSalones'] = false;
			if($data['infoBloques']){
				$arrParam = array("idBloque" => $data['infoBloques'][0]['id_sitio_bloque']);
				$data['infoSalones'] = $this->general_model->get_salones_by($arrParam);
			}

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
				$arrParam = array("idBloque" => $data["idBloque"]);
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
			
			$msj = "Se adicionó el bloque con éxito.";
			if ($idBloque != '') {
				$msj = "Se actualizó el bloque con éxito.";
			}
			
			if ($this->sitios_model->saveBloques()) {
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
			$infoSalones = $this->general_model->get_salones_by($arrParam);
		
			if ($infoSalones) {
				$i=0;
								
				foreach ($infoSalones as $lista):
						$i++;
				
						echo "<tr>";
						echo "<td class='text-center'>" . $i . "</td>";
						echo "<td>" . $lista['nombre_salon'] . "</td>";
						echo "<td class='text-center'>" . $lista['capacidad_salon'] . "</td>";
						
						switch ($lista['tipo_salon']) {
							case 1:
								$tipoSalon = 'Arquitectura';
								break;
							case 2:
								$tipoSalon = 'Electrónico';
								break;
							case 2:
								$tipoSalon = 'Papel';
								break;
						}
						echo "<td>" . $tipoSalon . "</td>";

						echo "<td class='text-center'>";
						switch ($lista['estado_salon']) {
							case 1:
								$valor = 'Activo';
								$clase = "text-success";
								break;
							case 2:
								$valor = 'Inactivo';
								$clase = "text-danger";
								break;
						}
						echo '<p class="' . $clase . '"><strong>' . $valor . '</strong></p>';
						echo "</td>";
						
						echo "<td class='text-center'>";						
						echo "<a class='btn btn-default btn-xs' href='" . base_url('jobs/add_tool_box/' . $lista['id_sitio_salon'] ) . "'>
											Editar <span class='glyphicon glyphicon-edit' aria-hidden='true'>
							</a>";
						echo "</td>";
						echo "</tr>";
				endforeach;
				

			}
    }
	
    /**
     * Cargo modal - formulario SALONES
     * @since 15/12/2017
     */
    public function cargarModalSalones() 
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
			$this->load->model("general_model");
						
			$data['information'] = FALSE;
			$data["idSitio"] = $this->input->post("idSitio");
			$data["idSalon"] = $this->input->post("idSalon");
			
			if ($data["idSalon"] != 'x') {
				
				$arrParam = array("idSalon" => $data["idSalon"]);
				$data['information'] = $this->general_model->get_salones_by($arrParam);//info salon
			
				$data["idSitio"] = $data['information'][0]['fk_id_sitio'];
			}
			
			//lista de bloques
			$arrParam = array("idSitio" => $data["idSitio"]);
			$data['infoBloques'] = $this->general_model->get_sitios_bloques($arrParam);
			
			$this->load->view("form_salon_modal", $data);
    }
	
	/**
	 * Guardar salones
     * @since 15/12/2017
	 */
	public function save_salones()
	{			
			header('Content-Type: application/json');
			$data = array();
			
			$idSitio = $this->input->post('hddIdSitio');
			$idBloque = $this->input->post('hddIdBloque');
			$data["idRecord"] = $idSitio;
			
			$msj = "Se adicionó el salón con éxito.";
			if ($idSitio != '') {
				$msj = "Se actualizó el salón con éxito.";
			}
			
			if ($this->sitios_model->saveSalones()) {
				$data["result"] = true;
				
				$this->session->set_flashdata('retornoExito', $msj);
			} else {
				$data["result"] = "error";
				
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Contactarse con el Administrador.');
			}

			echo json_encode($data);
    }
	
	/**
	 * Lista de sitios por DEPTO y MPIO
     * @since 20/12/2017
	 */
    public function sitioList()
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos

			$this->load->model("general_model");
			$arrParam = array("depto" => $this->input->post('depto'), "mcpio" => $this->input->post('mcpio'));
			$infoSitios = $this->general_model->get_sitios($arrParam);
		
			if ($infoSitios) {
								
				foreach ($infoSitios as $lista):
						echo "<tr>";
						echo "<td >" . strtoupper($lista['dpto_divipola_nombre']) . "</td>";
						echo "<td >" . strtoupper($lista['mpio_divipola_nombre']) . "</td>";	
						echo "<td >" . $lista['nombre_sitio'] . "</td>";
						echo "<td class='text-center'>" . $lista['codigo_dane'] . "</td>";
						
						echo "<td class='text-center'>";

						echo "<a class='btn btn-default btn-xs' href='" . base_url('sitios/salones/' . $lista['id_sitio']) . "'>
								Bloques y Salones <span class='fa fa-cube' aria-hidden='true'>
							</a>";

						echo "</td>";
						echo "</tr>";
				endforeach;
				

			}
    }
	
	
	
}