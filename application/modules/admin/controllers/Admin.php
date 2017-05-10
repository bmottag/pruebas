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
	
	


	
}