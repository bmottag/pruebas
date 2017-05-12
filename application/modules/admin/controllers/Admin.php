<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MX_Controller {
	
    public function __construct() {
        parent::__construct();
        $this->load->model("admin_model");
    }
	
	/**
	 * users List
     * @since 15/12/2016
     * @author BMOTTAG
	 */
	public function users()
	{
			$userRol = $this->session->rol;
			if ($userRol != 1 ) { 
				show_error('ERROR!!! - You are in the wrong place.');	
			}

			$arrParam = array();
			$data['info'] = $this->admin_model->get_users($arrParam);
			
			$data["view"] = 'users';
			$this->load->view("layout", $data);
	}
	
    /**
     * Cargo modal - formulario Usuarios
     * @since 15/12/2016
     */
    public function cargarModalUser() 
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
			
			$data['information'] = FALSE;
			$data["idUser"] = $this->input->post("idUser");

			$this->load->model("general_model");
			$arrParam = array(
				"table" => "param_roles",
				"order" => "nombre_rol",
				"id" => "x"
			);
			$data['roles'] = $this->general_model->get_basic_search($arrParam);			
			
			if ($data["idUser"] != 'x') 
			{
				$arrParam = array(
					"idUsuario" => $data["idUser"]
				);
				$data['information'] = $this->admin_model->get_users($arrParam);
			}
			
			$this->load->view("user_modal", $data);
    }
	
	/**
	 * Update user
     * @since 15/12/2016
     * @author BMOTTAG
	 */
	public function save_user()
	{			
			header('Content-Type: application/json');
			$data = array();
			
			$idUser = $this->input->post('hddId');

			$msj = "You have add a new Employee!!";
			if ($idUser != '') {
				$msj = "Se actualizo el usuario con exito.";
			}			

			$documento = $this->input->post('documento');

			$result_user = false;
			if ($idUser == '') {
				//Verify if the user already exist by the user name
				$arrParam = array(
					"column" => "numero_documento",
					"value" => $documento
				);
				$result_user = $this->admin_model->verifyUser($arrParam);
			}

			if ($result_user) {
				$data["result"] = "error";
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Este número de documetno ya existe en la base de datos.');
			} else {
					if ($this->admin_model->saveUser()) {
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
	 * Reset employee password
	 * Reset the password to '123456'
	 * And change the status to '0' to changue de password 
     * @since 11/1/2017
     * @author BMOTTAG
	 */
	public function resetPassword($idUser)
	{
			if ($this->admin_model->resetEmployeePassword($idUser)) {
				$this->session->set_flashdata('retornoExito', 'You have reset the Employee pasword to: 123456');
			} else {
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Ask for help');
			}
			
			redirect("/admin/employee/",'refresh');
	}
	
	/**
	 * Change password
     * @since 10/5/2017
	 */
	public function change_password($idUser)
	{
			if (empty($idUser)) {
				show_error('ERROR!!! - You are in the wrong place. The ID USER is missing.');
			}
						
			$arrParam = array(
				"idUsuario" => $idUser
			);
			$data['information'] = $this->admin_model->get_users($arrParam);
		
			$data["view"] = "form_password";
			$this->load->view("layout", $data);
	}
	
	/**
	 * Update user´s password
	 * @since 10/5/2017
	 */
	public function update_password()
	{
			$data = array();			
			$data["titulo"] = "ACTUALIZAR CONTRASEÑA";
			
			$newPassword = $this->input->post("inputPassword");
			$confirm = $this->input->post("inputConfirm");
			$passwd = str_replace(array("<",">","[","]","*","^","-","'","="),"",$newPassword); 
			
			$data['linkBack'] = "admin/users/";
			$data['titulo'] = "<i class='fa fa-unlock fa-fw'></i>CAMBIAR CONTRASEÑA";
			
			if($newPassword == $confirm)
			{					
					if ($this->admin_model->updatePassword()) {
						$data["msj"] = "Se actualizo la contraseña.";
						$data["msj"] .= "<br><strong>Número de documento: </strong>" . $this->input->post("hddUser");
						$data["msj"] .= "<br><strong>Contraseña: </strong>" . $passwd;
						$data["clase"] = "alert-success";
					}else{
						$data["msj"] = "<strong>Error!!!</strong> Contactarse con el administrador.";
						$data["clase"] = "alert-danger";
					}
			}else{
				//definir mensaje de error
				echo "pailas no son iguales";
			}
						
			$data["view"] = "template/answer";
			$this->load->view("layout", $data);
	}
	
	/**
	 * Tipo de alertas
     * @since 10/5/2017
	 */
	public function tipo_alertas()
	{
			$this->load->model("general_model");
			$arrParam = array(
				"table" => "param_tipo_alerta",
				"order" => "nombre_tipo_alerta",
				"id" => "x"
			);
			$data['info'] = $this->general_model->get_basic_search($arrParam);
			
			$data["view"] = 'tipo_alerta';
			$this->load->view("layout", $data);
	}
	
    /**
     * Cargo modal - formulario tipo de alerta
     * @since 10/5/2017
     */
    public function cargarModalTipoAlerta() 
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
			
			$data['information'] = FALSE;
			$data["idTipoAlerta"] = $this->input->post("idTipoAlerta");	
			
			if ($data["idTipoAlerta"] != 'x') {
				$this->load->model("general_model");
				$arrParam = array(
					"table" => "param_tipo_alerta",
					"order" => "id_tipo_alerta",
					"column" => "id_tipo_alerta",
					"id" => $data["idTipoAlerta"]
				);
				$data['information'] = $this->general_model->get_basic_search($arrParam);
			}
			
			$this->load->view("tipo_alerta_modal", $data);
    }
	
	/**
	 * Update tipo alerta
     * @since 10/5/2017
	 */
	public function save_tipo_alerta()
	{			
			header('Content-Type: application/json');
			$data = array();
			
			$idTipoAlerta = $this->input->post('hddId');
			
			$msj = "Se adiciono el Tipo de Alerta con exito.";
			if ($idTipoAlerta != '') {
				$msj = "Se actualizo el tipo de alerta con exito.";
			}

			if ($idTipoAlerta = $this->admin_model->saveTipoAlerta()) {
				$data["result"] = true;
				$data["idRecord"] = $idTipoAlerta;
				
				$this->session->set_flashdata('retornoExito', $msj);
			} else {
				$data["result"] = "error";
				$data["idRecord"] = "";
				
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Contactarse con el Administrador.');
			}

			echo json_encode($data);
    }
	
	/**
	 * INICIO PRUEBAS
	 */	
	
		
	/**
	 * Lista de PRUEBAS
     * @since 10/5/2017
	 */
	public function pruebas()
	{
			$this->load->model("general_model");
			$arrParam = array(
				"table" => "param_pruebas",
				"order" => "nombre_prueba",
				"id" => "x"
			);
			$data['info'] = $this->general_model->get_basic_search($arrParam);
			
			$data["view"] = 'prueba';
			$this->load->view("layout", $data);
	}
	
    /**
     * Cargo modal - formulario PRUEBAS
     * @since 10/5/2017
     */
    public function cargarModalPrueba() 
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
			
			$data['information'] = FALSE;
			$data["idPrueba"] = $this->input->post("idPrueba");
			
			if ($data["idPrueba"] != 'x') {
				$this->load->model("general_model");
				$arrParam = array(
					"table" => "param_pruebas",
					"order" => "id_prueba",
					"column" => "id_prueba",
					"id" => $data["idPrueba"]
				);
				$data['information'] = $this->general_model->get_basic_search($arrParam);
			}
			
			$this->load->view("prueba_modal", $data);
    }
	
	/**
	 * Update Pruebas
     * @since 10/5/2017
	 */
	public function save_prueba()
	{			
			header('Content-Type: application/json');
			$data = array();
			
			$idPrueba = $this->input->post('hddId');
			
			$msj = "Se adiciono la Prueba con exito.";
			if ($idPrueba != '') {
				$msj = "Se actualizo la Prueba con exito.";
			}

			if ($idPrueba = $this->admin_model->savePrueba()) {
				$data["result"] = true;
				$data["idRecord"] = $idPrueba;
				
				$this->session->set_flashdata('retornoExito', $msj);
			} else {
				$data["result"] = "error";
				$data["idRecord"] = "";
				
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Contactarse con el Administrador.');
			}

			echo json_encode($data);
    }
	
	/**
	 * INICIO ALERTAS
	 */	
	
		
	/**
	 * Lista de ALERTAS
     * @since 10/5/2017
	 */
	public function alertas()
	{
			$this->load->model("general_model");
			$arrParam = array(
				"table" => "alertas",
				"order" => "id_alerta",
				"id" => "x"
			);
			$data['info'] = $this->general_model->get_basic_search($arrParam);
			
			$data["view"] = 'alerta';
			$this->load->view("layout", $data);
	}
	
    /**
     * Cargo modal - formulario ALERTAS
     * @since 10/5/2017
     */
    public function cargarModalAlerta() 
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
			
			$data['information'] = FALSE;
			$data["identificador"] = $this->input->post("identificador");
			
			$this->load->model("general_model");
			$arrParam = array(
				"table" => "param_tipo_alerta",
				"order" => "nombre_tipo_alerta",
				"id" => "x"
			);
			$data['tipoAlerta'] = $this->general_model->get_basic_search($arrParam);
			
			$arrParam = array(
				"table" => "param_roles",
				"order" => "nombre_rol",
				"id" => "x"
			);
			$data['roles'] = $this->general_model->get_basic_search($arrParam);
			
			if ($data["identificador"] != 'x') {
				$this->load->model("general_model");
				$arrParam = array(
					"table" => "alertas",
					"order" => "id_alerta",
					"column" => "id_alerta",
					"id" => $data["identificador"]
				);
				$data['information'] = $this->general_model->get_basic_search($arrParam);
			}
			
			$this->load->view("alerta_modal", $data);
    }
	
	/**
	 * Update Alertas
     * @since 10/5/2017
	 */
	public function save_alerta()
	{			
			header('Content-Type: application/json');
			$data = array();
			
			$idAlerta = $this->input->post('hddId');
			
			$msj = "Se adiciono la Prueba con exito.";
			if ($idAlerta != '') {
				$msj = "Se actualizo la Prueba con exito.";
			}

			if ($idAlerta = $this->admin_model->savePrueba()) {
				$data["result"] = true;
				$data["idRecord"] = $idAlerta;
				
				$this->session->set_flashdata('retornoExito', $msj);
			} else {
				$data["result"] = "error";
				$data["idRecord"] = "";
				
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Contactarse con el Administrador.');
			}

			echo json_encode($data);
    }

	/**
	 * INICIO SITIOS
	 */	
	
		
	/**
	 * Lista de SITIOS
     * @since 11/5/2017
	 */
	public function sitios()
	{
			$arrParam = array();
			$data['info'] = $this->admin_model->get_sitios($arrParam);
			
			$data["view"] = 'sitio';
			$this->load->view("layout", $data);
	}
	
    /**
     * Cargo modal - formulario SITIOS
     * @since 11/5/2017
     */
    public function cargarModalSitio() 
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
			
			$data['information'] = FALSE;
			$data["identificador"] = $this->input->post("identificador");
			
			$this->load->model("general_model");
			$arrParam = array(
				"table" => "param_organizaciones",
				"order" => "id_organizacion",
				"id" => "x"
			);
			$data['organizaciones'] = $this->general_model->get_basic_search($arrParam);//listado organizaciones
			
			$arrParam = array(
				"table" => "param_regiones",
				"order" => "nombre_region",
				"id" => "x"
			);
			$data['regiones'] = $this->general_model->get_basic_search($arrParam);//listado regiones
			
			$arrParam = array(
				"table" => "param_zonas",
				"order" => "nombre_zona",
				"id" => "x"
			);
			$data['zonas'] = $this->general_model->get_basic_search($arrParam);//listado zonas
			
			$data['departamentos'] = $this->admin_model->get_dpto_divipola();//listado de departamentos
			
			if ($data["identificador"] != 'x') {
				$arrParam = array(
					"idSitio" => $data["identificador"]
				);
				$data['information'] = $this->admin_model->get_sitios($arrParam);//info sitio
			}
			
			$this->load->view("sitio_modal", $data);
    }
	
	/**
	 * Update Sitios
     * @since 11/5/2017
	 */
	public function save_sitio()
	{			
			header('Content-Type: application/json');
			$data = array();

			$idSitio = $this->input->post('hddId');
			
			$msj = "Se adiciono el Sitio con exito.";
			if ($idSitio != '') {
				$msj = "Se actualizo el Sitio con exito.";
			}

			if ($idSitio = $this->admin_model->saveSitio()) {
				$data["result"] = true;
				$data["idRecord"] = $idSitio;
				
				$this->session->set_flashdata('retornoExito', $msj);
			} else {
				$data["result"] = "error";
				$data["idRecord"] = "";
				
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Contactarse con el Administrador.');
			}

			echo json_encode($data);
    }
	
	/**
	 * Lista de municipios por departamentos
     * @since 12/5/2017
	 */
    public function mcpioList()
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos

			$arrParam['idDepto'] = $this->input->post('identificador');

			$lista = $this->admin_model->get_municipios_by($arrParam);
		
			echo "<option value=''>Select...</option>";
			if ($lista) {
				foreach ($lista as $fila) {
					echo "<option value='" . $fila["idMcpio"] . "' >" . $fila["municipio"] . "</option>";
				}
			}
    }

	
	
	
}