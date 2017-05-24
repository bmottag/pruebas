<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MX_Controller {
	
    public function __construct() {
        parent::__construct();
        $this->load->model("admin_model");
		$this->load->library("validarsesion");
    }
	
	/**
	 * Evio de correo al usuario con la contraseña
     * @since 24/5/2017
	 */
	public function email($idUsuario)
	{
			$arrParam = array("idUsuario" => $idUsuario);
			$infoUsuario = $this->admin_model->get_users($arrParam);

			$subjet = "Usuario ICFES";				
			$user = $infoUsuario[0]["nombres_usuario"] . " " . $infoUsuario[0]["apellidos_usuario"];
			$to = $infoUsuario[0]["email"];
		
			//mensaje del correo
			$msj = "<p>Los datos para ingresar al apliativo de pruebas es el siguiente:</p>";
			$msj .= "<br><strong>Usuario: </strong>" . $infoUsuario[0]["numero_documento"];
			$msj .= "<br><strong>Contraseña: </strong>" . $infoUsuario[0]["clave"];
			$msj .= "<br><br><strong><a href='" . base_url() . "'>Enlace Aplicación </a></strong><br>";
				
			$mensaje = "<html>
						<head>
						  <title> $subjet </title>
						</head>
						<body>
							<p>Apreciado(a) $user:</p>
							<p>$msj</p>
							<p>Cordialmente,</p>
							<p><strong>Pruebas ICFES</strong></p>
						</body>
						</html>";

			$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
			$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$cabeceras .= 'To: ' . $user . '<' . $to . '>' . "\r\n";
			$cabeceras .= 'From: VCI APP <jelozanoo@gmail.com>' . "\r\n";

			//enviar correo
			mail($to, $subjet, $mensaje, $cabeceras);
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

			$msj = "Se adicionó un nuevo usuario.";
			if ($idUser != '') {
				$msj = "Se actualizó el usuario con exito.";
			}			

			$documento = $this->input->post('documento');

			$result_user = false;
			$clave = "";
			if ($idUser == '') {
				//Verify if the user already exist by the user name
				$arrParam = array(
					"column" => "numero_documento",
					"value" => $documento
				);
				$result_user = $this->admin_model->verifyUser($arrParam);
				$clave = $this->generar_clave();
			}

			if ($result_user) {
				$data["result"] = "error";
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Este número de documetno ya existe en la base de datos.');
			} else {
					if ($idUsuario = $this->admin_model->saveUser($clave)) {
						$data["result"] = true;					
						$this->session->set_flashdata('retornoExito', $msj);
						
						//a los usuarios nuevos les envio correo con contraseña
						if($idUser == '') {
							$this->email($idUsuario);
						}
					} else {
						$data["result"] = "error";					
						$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Contactarse con el administrador.');
					}
			}

			echo json_encode($data);
    }
	
	public function generar_clave()
	{
			$key = "";
			$caracteres = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
			
			$length = 10;
			$max = strlen($caracteres) - 1;
			for ($i=0;$i<$length;$i++) {
				$key .= substr($caracteres, rand(0, $max), 1);
			}
			return $key;
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
						$data["msj"] = "Se actualizó la contraseña.";
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
			
			$msj = "Se adicionó el Tipo de Alerta con exito.";
			if ($idTipoAlerta != '') {
				$msj = "Se actualizó el tipo de alerta con exito.";
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
			$year = date('Y');
			$arrParam = array(
				"table" => "pruebas",
				"order" => "nombre_prueba",
				"column" => "anio_prueba",
				"id" => $year
			);
			$data['info'] = $this->general_model->get_basic_search($arrParam);//lista pruebas; se filtra por año actual
			
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
					"table" => "pruebas",
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
			
			$msj = "Se adicionó la Prueba con exito.";
			if ($idPrueba != '') {
				$msj = "Se actualizó la Prueba con exito.";
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
			$arrParam = array();
			$data['info'] = $this->admin_model->get_alertas($arrParam);
			
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
			$data['tipoAlerta'] = $this->general_model->get_basic_search($arrParam);//tipo de alerta
			
			$arrParam = array(
				"table" => "param_roles",
				"order" => "nombre_rol",
				"id" => "x"
			);
			$data['roles'] = $this->general_model->get_basic_search($arrParam);//lista de roles
			
			$arrParam = array();
			$data['infoPruebas'] = $this->general_model->get_sesiones($arrParam);//lista sesiones
			
			
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
			
			//buscar la fecha de la sesion para guardarla en la alerta
			$this->load->model("general_model");
			$arrParam = array("idSesion" => $this->input->post('sesion'));
			$data['information'] = $this->general_model->get_sesiones($arrParam);//info sesiones
			
			$msj = "Se adicionó la Alerta con exito.";
			if ($idAlerta != '') {
				$msj = "Se actualizó la Alerta con exito.";
			}

			if ($idAlerta = $this->admin_model->saveAlerta($data['information'][0]['fecha'])) {
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
			$this->load->model("general_model");
			$arrParam = array();
			$data['info'] = $this->general_model->get_sitios($arrParam);
			
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
			
			$data['departamentos'] = $this->general_model->get_dpto_divipola();//listado de departamentos
			
			if ($data["identificador"] != 'x') {
				$arrParam = array(
					"idSitio" => $data["identificador"]
				);
				$data['information'] = $this->general_model->get_sitios($arrParam);//info sitio
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
			
			$msj = "Se adicionó el Sitio con exito.";
			if ($idSitio != '') {
				$msj = "Se actualizó el Sitio con exito.";
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
			$this->load->model("general_model");
			$lista = $this->general_model->get_municipios_by($arrParam);
		
			echo "<option value=''>Select...</option>";
			if ($lista) {
				foreach ($lista as $fila) {
					echo "<option value='" . $fila["idMcpio"] . "' >" . $fila["municipio"] . "</option>";
				}
			}
    }

	/**
	 * INICIO GRUPO INSTRUMENTOS
	 */	
	
		
	/**
	 * Lista de GRUPO INSTRUMENTOS
     * @since 12/5/2017
	 */
	public function grupo_instrumentos()
	{
			$arrParam = array();
			$data['info'] = $this->admin_model->get_grupo_instrumentos($arrParam);
			
			$data["view"] = 'grupo_instrumentos';
			$this->load->view("layout", $data);
	}
	
    /**
     * Cargo modal - formulario tipo de alerta
     * @since 12/5/2017
     */
    public function cargarModalGrupoInstrumentos() 
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
			
			$data['information'] = FALSE;
			$data["identificador"] = $this->input->post("identificador");	
			
			$this->load->model("general_model");
			$arrParam = array(
				"table" => "pruebas",
				"order" => "id_prueba",
				"id" => "x"
			);
			$data['pruebas'] = $this->general_model->get_basic_search($arrParam);//listado pruebas
			
			if ($data["identificador"] != 'x') {
				$this->load->model("general_model");
				$arrParam = array(
					"table" => "param_grupo_instrumentos",
					"order" => "id_grupo_instrumentos",
					"column" => "id_grupo_instrumentos",
					"id" => $data["identificador"]
				);
				$data['information'] = $this->general_model->get_basic_search($arrParam);
			}
			
			$this->load->view("grupo_instrumentos_modal", $data);
    }
	
	/**
	 * Update GRUPO INSTRUMENTOS
     * @since 12/5/2017
	 */
	public function save_grupo_instrumentos()
	{			
			header('Content-Type: application/json');
			$data = array();
			
			$identificador = $this->input->post('hddId');
			
			$msj = "Se adicionó el Grupo de Instrumentos con exito.";
			if ($identificador != '') {
				$msj = "Se actualizó el Grupo de Instrumentos con exito.";
			}

			if ($identificador = $this->admin_model->saveGrupoInstrumentos()) {
				$data["result"] = true;
				$data["idRecord"] = $identificador;
				
				$this->session->set_flashdata('retornoExito', $msj);
			} else {
				$data["result"] = "error";
				$data["idRecord"] = "";
				
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Contactarse con el Administrador.');
			}

			echo json_encode($data);
    }
	
	/**
	 * INICIO ASIGNAR SESISONES Y PRUEBA AL GRUPO INSTRUMENTO
	 */	
	
		
	/**
	 * Lista de SESIONES POR GRUPO
     * @since 12/5/2017
	 */
	public function sesiones($idGrupo)
	{
			$this->load->model("general_model");
			$arrParam = array("idGrupo" => $idGrupo);
			$data['info'] = $this->general_model->get_sesiones($arrParam);
			
			$arrParam = array("idGrupo" => $idGrupo);
			$data['infoGrupo'] = $this->admin_model->get_grupo_instrumentos($arrParam);

			$data["view"] = 'sesiones';
			$this->load->view("layout", $data);
	}
	
    /**
     * Cargo modal - formulario SESIONES
     * @since 12/5/2017
     */
    public function cargarModalSesiones() 
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
			
			$data['information'] = FALSE;
			$data["idGrupo"] = $this->input->post("idGrupo");
			$data["idSesion"] = $this->input->post("idSesion");
			
			if ($data["idSesion"] != 'x') {
				$this->load->model("general_model");
				$arrParam = array(
					"idSesion" => $data["idSesion"]
				);
				$data['information'] = $this->general_model->get_sesiones($arrParam);//info sesiones
				
				$data["idGrupo"] = $data['information'][0]['fk_id_grupo_instrumentos'];
			}
			
			$this->load->view("sesiones_modal", $data);
    }
	
	/**
	 * Update SESIONES
     * @since 12/5/2017
	 */
	public function save_sesiones()
	{			
			header('Content-Type: application/json');
			$data = array();
			
			$idGrupo = $this->input->post('hddIdGrupo');
			$idSesion = $this->input->post('hddId');
			
			$msj = "Se adicionó la Sesión con exito.";
			if ($idSesion != '') {
				$msj = "Se actualizó la Sesión con exito.";
			}

			if ($idSesion = $this->admin_model->saveSesiones()) {
				$data["result"] = true;
				$data["idRecord"] = $idGrupo;
				
				$this->session->set_flashdata('retornoExito', $msj);
			} else {
				$data["result"] = "error";
				$data["idRecord"] = "";
				
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Contactarse con el Administrador.');
			}

			echo json_encode($data);
    }

	/**
	 * INICIO ASIGNAR USUARIO delegado al sitio
	 */	
	
		
	/**
	 * Formulario para asignar delegado al sitio
     * @since 21/5/2017
	 */
	public function asignar_delegado($idSitio, $rol)
	{
			$this->load->model("general_model");
			$arrParam = array("idSitio" => $idSitio);
			$data['infoSitio'] = $this->general_model->get_sitios($arrParam);//informacion sitio
			$data['rol'] = $rol;
			$lista = "lista_" . $rol;

			$data['usuarios'] = $this->general_model->$lista($arrParam);//listado usuarios

			$data["view"] = 'asignar_delegado';
			$this->load->view("layout", $data);
	}
	
	/**
	 * Guardar delegado o coordinador para el sitio
	 * @since 13/5/2017
	 */
	public function guardar_delegado()
	{
			$data = array();			
				
			$data['linkBack'] = "admin/sitios/";
			$data['titulo'] = "<i class='fa fa-gear fa-fw'></i>ASIGNAR";
			
			$idSitio = $this->input->post("hddId");
			//se busca informacion del sitio para asignar el usuario al mismo municipio
			$this->load->model("general_model");
			$arrParam = array("idSitio" => $idSitio);
			$infoSitio = $this->general_model->get_sitios($arrParam);//informacion sitio
			$idMunicipio = $infoSitio[0]['fk_mpio_divipola']; //envio el id municipio para los coordinadores
			
			$rol = $this->input->post("hddRol");
			$Fmodelo = "updateSitio_" . $rol;
	
			if ($this->admin_model->$Fmodelo($idMunicipio)) {
				$data["msj"] = "Se asignó el <strong>" . $rol . "</strong> con exito.";
				$data["clase"] = "alert-success";
			}else{
				$data["msj"] = "<strong>Error!!!</strong> Contactarse con el administrador.";
				$data["clase"] = "alert-danger";
			}
						
			$data["view"] = "template/answer";
			$this->load->view("layout", $data);
	}
	
	/**
	 * INICIO ASOCIAR SESISONES Y PRUEBA AL SITIO
	 */	
	
		
	/**
	 * Lista de SESIONES POR SITIO
     * @since 17/5/2017
	 */
	public function asociar_sesion($idSitio)
	{
			$this->load->model("general_model");
			
			$arrParam = array("idSitio" => $idSitio);
			$data['info'] = $this->general_model->get_sesiones_sitio($arrParam);
			
			$arrParam = array("idSitio" => $idSitio);
			$data['infoSitio'] = $this->general_model->get_sitios($arrParam);
			
			$data["view"] = 'sesionesForSitio';
			$this->load->view("layout", $data);
	}
	
    /**
     * Cargo modal - formulario SESIONES para sitio
     * @since 17/5/2017
     */
    public function cargarModalSesionesSitio() 
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
			
			$data['information'] = FALSE;
			$data["idSitio"] = $this->input->post("idSitio");
			$data["idSesionSitio"] = $this->input->post("idSesionSitio");
			

			
			if ($data["idSesionSitio"] != 'x') {
				$this->load->model("general_model");
				$arrParam = array(
					"idSesionSitio" => $data["idSesionSitio"]
				);
				$data['information'] = $this->general_model->get_sesiones_sitio($arrParam);//info sesiones por sitio
				$data["idSitio"] = $data['information'][0]['fk_id_sitio'];
				
				//si es para editar muestro lista con todas las sesiones vigentes
				$arrParam = array();
				$data['infoSesiones'] = $this->general_model->get_sesiones($arrParam);//lista sesiones
			}else{
				
				//si es para adicionar uno nuevo muestro lista con sesiones que no se han utilizado
				$arrParam = array("idSitio" => $data["idSitio"]);
				$data['infoSesiones'] = $this->admin_model->lista_sesiones_for_sitio($arrParam);//lista sesiones
				
			}
			
			$this->load->view("sesionesForSitio_modal", $data);
    }
	
	/**
	 * Update SESIONES para sitio
     * @since 17/5/2017
	 */
	public function saveSitiosSesion()
	{			
			header('Content-Type: application/json');
			$data = array();
			$error = FALSE;
			
			$idSitio = $this->input->post('hddIdSitio');		
			$idSitioSesion = $this->input->post('hddId');
			$idSesionBD = $this->input->post('hddIdSesion');
			$idSesion = $this->input->post('sesion');
			
			$data["idRecord"] = $idSitio;
			
			$arrParam = array("idSitio" => $idSitio,
								"idSesion" => $idSesion);
			
			$msj = "Se adicionó la Sesión con exito.";
			if ($idSitioSesion != '') {
				$msj = "Se actualizó la Sesión con exito.";
				$arrParam["idSitioSesionDistinta"] = $idSitioSesion;
				
				//verificar que al editar la relacion SITIO con SESION no existe en la base de datos
				if($idSesionBD!=$idSesion){ //si la sesion guardada anteriormente es diferente de la nueva seion entonces verifico
					$this->load->model("general_model");
					$verificar = $this->general_model->get_sesiones_sitio($arrParam);

					if($verificar){
						$error = TRUE;
					}
				}
			}


			if($error){
					$data["result"] = "error";
					//$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Ya se encuentra relacionado el SITIO con esa SESIÓN.');
			}else{
				if ($idSesion = $this->admin_model->saveSitiosSesion()) {
					$data["result"] = true;
					$this->session->set_flashdata('retornoExito', $msj);
				} else {
					$data["result"] = "error";
					$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Contactarse con el Administrador.');
				}
			}

			echo json_encode($data);
    }
	
	/**
	 * INICIO ASIGNAR SITIOS AL USUARIO
	 */	
	
		
	/**
	 * Formulario para datos del contacto del Sitio
     * @since 18/5/2017
	 */
	public function contacto_sitio($idSitio)
	{
			$this->load->model("general_model");
			$arrParam = array("idSitio" => $idSitio);
			$data['infoSitio'] = $this->general_model->get_sitios($arrParam);//info Sitio

			$data["view"] = 'contacto_sitio';
			$this->load->view("layout", $data);
	}
	
	/**
	 * Guardar contacto del Sitio
	 * @since 18/5/2017
	 */
	public function guardar_contacto()
	{
			$data = array();			
				
			$data['linkBack'] = "admin/sitios/";
			$data['titulo'] = "<i class='fa fa-gear fa-fw'></i>Contacto del Sitio ";
	
			if ($this->admin_model->updateSitioContacto()) {
				
				$this->load->model("general_model");
				$arrParam = array(
					"idSitio" => $this->input->post("hddId")
				);
				$infoSitio = $this->general_model->get_sitios($arrParam);//info sitio			
				
				$data["msj"] = "Se ingresaron los datos de <strong>CONTACTO</strong> del sitio con exito.";
				$data["msj"] .= "<br><br><strong>Nombre: </strong>" . $infoSitio[0]['contacto_nombres'] . " " . $infoSitio[0]['contacto_apellidos'];
				$data["msj"] .= "<br><strong>Cargo: </strong>" . $infoSitio[0]['contacto_cargo'];
				$data["msj"] .= "<br><strong>Teléfono: </strong>" . $infoSitio[0]['contacto_telefono'];
				$data["msj"] .= "<br><strong>Celular: </strong>" . $infoSitio[0]['contacto_celular'];
				$data["msj"] .= "<br><strong>Email: </strong>" . $infoSitio[0]['contacto_email'];;
				$data["clase"] = "alert-success";
			}else{
				$data["msj"] = "<strong>Error!!!</strong> Contactarse con el administrador.";
				$data["clase"] = "alert-danger";
			}
						
			$data["view"] = "template/answer";
			$this->load->view("layout", $data);
	}
	
	/**
	 * Eliminar registros de la base de datpos
	 * @since 23/5/2017
	 */
	public function eliminar_db()
	{
			$data = array();			
			$data["titulo"] = "ELIMINAR REGISTROS";
			$data['linkBack'] = "dashboard/";
			
			if ($this->admin_model->eliminarRegistros()) {
				
				$data["clase"] = "alert-success";
				$data["msj"] = "Se eliminaron registros de la tabla Registro.";
				
				if ($this->admin_model->eliminarAlertas()) {
					$data["msj"] .= "<br>Se eliminaron registros de la tabla Alertas.";
				}
				
				if ($this->admin_model->eliminarSitioSesion()) {
					$data["msj"] .= "<br>Se eliminaron registros de la tabla Sitio Sesión.";
				}				
				
				
				if ($this->admin_model->eliminarSesiones()) {
					$data["msj"] .= "<br>Se eliminaron registros de la Sesiones.";
					
					if ($this->admin_model->eliminarGrupoInstrumentos()) {
						$data["msj"] .= "<br>Se eliminaron registros de la tabla Grupo Instrumentos.";
					}
				}
				
				
				
				
			}else{
				$data["msj"] = "<strong>Error!!!</strong> Contactarse con el administrador.";
				$data["clase"] = "alert-danger";
			}
						
			$data["view"] = "template/answer";
			$this->load->view("layout", $data);
	}
	
	
	
}