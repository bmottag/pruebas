<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Admin_model extends CI_Model {

	    
		/**
		 * Verify if the user already exist by the social insurance number
		 * @since  10/5/2017
		 */
		public function verifyUser($arrData) 
		{
				$this->db->where($arrData["column"], $arrData["value"]);
				$query = $this->db->get("usuario");

				if ($query->num_rows() >= 1) {
					return true;
				} else{ return false; }
		}
		
		/**
		 * Lista de usuarios
		 * @since 10/5/2017
		 */
		public function get_users($arrDatos) 
		{
				$this->db->select();
				$this->db->join('param_roles R', 'R.id_rol = U.fk_id_rol', 'INNER');
				if (array_key_exists("idUsuario", $arrDatos)) {
					$this->db->where('id_usuario', $arrDatos["idUsuario"]);
				}
				$this->db->order_by('nombres_usuario', 'asc');
				$query = $this->db->get('usuario U');

				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}
		
		/**
		 * Add/Edit USER
		 * @since 10/5/2017
		 */
		public function saveUser() 
		{
				$idUser = $this->input->post('hddId');
				
				$data = array(
					'numero_documento' => $this->input->post('documento'),
					'nombres_usuario' => $this->input->post('firstName'),
					'apellidos_usuario' => $this->input->post('lastName'),
					'direccion_usuario' => $this->input->post('address'),
					'telefono_fijo' => $this->input->post('telefono'),
					'celular' => $this->input->post('movilNumber'),
					'email' => $this->input->post('email'),
					'log_user' => $this->input->post('documento'),
					'fk_id_rol' => $this->input->post('rol')
				);	

				//revisar si es para adicionar o editar
				if ($idUser == '') {
					$data['fecha_creacion'] = date("Y-m-d");
					$data['estado'] = 1;//si es para adicionar se coloca estado inicial como usuario ACTIVO
					$data['password'] = 'e10adc3949ba59abbe56e057f20f883e';//123456
					$query = $this->db->insert('usuario', $data);
				} else {
					$data['estado'] = $this->input->post('estado');
					$this->db->where('id_usuario', $idUser);
					$query = $this->db->update('usuario', $data);
				}
				if ($query) {
					return true;
				} else {
					return false;
				}
		}

	    /**
	     * Reset user´s password ---NO SE ESTA USANDO
	     * @since  11/1/2017
	     */
	    public function resetEmployeePassword($idUser)
		{
				$passwd = '123456';
				$passwd = md5($passwd);
				
				$data = array(
					'password' => $passwd,
					'state' => 0
				);

				$this->db->where('id_user', $idUser);
				$query = $this->db->update('user', $data);

				if ($query) {
					return true;
				} else {
					return false;
				}
	    }
		
	    /**
	     * Actualiar la contraseña del usuario
	     * @since  10/5/2017
	     */
	    public function updatePassword()
		{
				$idUser = $this->input->post("hddId");
				$newPassword = $this->input->post("inputPassword");
				$passwd = str_replace(array("<",">","[","]","*","^","-","'","="),"",$newPassword); 
				$passwd = md5($passwd);
				
				$data = array(
					'password' => $passwd
				);

				$this->db->where('id_usuario', $idUser);
				$query = $this->db->update('usuario', $data);

				if ($query) {
					return true;
				} else {
					return false;
				}
	    }
		
		/**
		 * Add/Edit TIPO ALERTA
		 * @since 10/5/2017
		 */
		public function saveTipoAlerta() 
		{
				$idTipoAlerta = $this->input->post('hddId');
				
				$data = array(
					'nombre_tipo_alerta' => $this->input->post('nombreTipoAlerta'),
					'descripcion_tipo_alerta' => $this->input->post('descripcion'),
					'observacion_alerta' => $this->input->post('observacion')
				);
				
				//revisar si es para adicionar o editar
				if ($idTipoAlerta == '') {
					$data['fecha_creacion'] = date("Y-m-d");
					$query = $this->db->insert('param_tipo_alerta', $data);
					$idTipoAlerta = $this->db->insert_id();				
				} else {
					$this->db->where('id_tipo_alerta', $idTipoAlerta);
					$query = $this->db->update('param_tipo_alerta', $data);
				}
				if ($query) {
					return $idTipoAlerta;
				} else {
					return false;
				}
		}
	
		/**
		 * Add/Edit PRUEBA
		 * @since 10/5/2017
		 */
		public function savePrueba() 
		{
				$idPrueba = $this->input->post('hddId');
				
				$data = array(
					'nombre_prueba' => $this->input->post('nombrePrueba'),
					'descripcion_prueba' => $this->input->post('descripcion'),
					'anio_prueba' => $this->input->post('anio'),
					'semestre_prueba' => $this->input->post('semestre')
				);
				
				//revisar si es para adicionar o editar
				if ($idPrueba == '') {
					$data['fecha_creacion'] = date("Y-m-d");
					$query = $this->db->insert('pruebas', $data);
					$idPrueba = $this->db->insert_id();				
				} else {
					$this->db->where('id_prueba', $idPrueba);
					$query = $this->db->update('pruebas', $data);
				}
				if ($query) {
					return $idPrueba;
				} else {
					return false;
				}
		}
		
		/**
		 * Add/Edit SITIO
		 * @since 11/5/2017
		 */
		public function saveSitio() 
		{
				$idSitio = $this->input->post('hddId');
				
				$data = array(
					'nombre_sitio' => $this->input->post('nombreSitio'),
					'direccion_sitio' => $this->input->post('direccion'),
					'codigo_postal_sitio' => $this->input->post('codigoPostal'),
					'barrio_sitio' => $this->input->post('barrioSitio'),
					'telefono_sitio' => $this->input->post('telefono'),
					'fax_sitio' => $this->input->post('fax'),
					'celular_sitio' => $this->input->post('celular'),
					'email_sitio' => $this->input->post('email'),
					'fk_id_organizacion' => $this->input->post('organizacion'),
					'fk_id_region' => $this->input->post('region'),
					'fk_dpto_divipola' => $this->input->post('depto'),
					'fk_mpio_divipola' => $this->input->post('mcpio'),
					'fk_id_zona' => $this->input->post('zona'),
					'estado_sitio' => $this->input->post('estado')
				);
				
				//revisar si es para adicionar o editar
				if ($idSitio == '') {
					$data['fecha_creacion'] = date("Y-m-d");
					$query = $this->db->insert('sitios', $data);
					$idSitio = $this->db->insert_id();				
				} else {
					$this->db->where('id_sitio', $idSitio);
					$query = $this->db->update('sitios', $data);
				}
				if ($query) {
					return $idSitio;
				} else {
					return false;
				}
		}
						
		/**
		 * Add/Edit GRUPO INSTRUMENTOS
		 * @since 12/5/2017
		 */
		public function saveGrupoInstrumentos() 
		{
				$identificador = $this->input->post('hddId');
				
				$data = array(
					'nombre_grupo_instrumentos' => $this->input->post('nombreGrupoInstrumentos'),
					'fk_id_prueba' => $this->input->post('prueba'),
					'fecha' => $this->input->post('fecha')
				);
				
				//revisar si es para adicionar o editar
				if ($identificador == '') {
					$data['fecha_creacion'] = date("Y-m-d");
					$query = $this->db->insert('param_grupo_instrumentos', $data);
					$identificador = $this->db->insert_id();				
				} else {
					$this->db->where('id_grupo_instrumentos', $identificador);
					$query = $this->db->update('param_grupo_instrumentos', $data);
				}
				if ($query) {
					return $identificador;
				} else {
					return false;
				}
		}
		
		/**
		 * Lista de sesiones
		 * @since 12/5/2017
		 */
		public function get_sesiones($arrDatos) 
		{
				$year = date('Y');
				$firstDay = date('Y-m-d', mktime(0,0,0, 1, 1, $year));
			
				$this->db->select();
				$this->db->join('param_grupo_instrumentos G', 'G.id_grupo_instrumentos = S.fk_id_grupo_instrumentos', 'INNER');
				$this->db->join('pruebas P', 'P.id_prueba = G.fk_id_prueba', 'INNER');
				if (array_key_exists("idGrupo", $arrDatos)) {
					$this->db->where('S.fk_id_grupo_instrumentos', $arrDatos["idGrupo"]);
				}
				
				if (array_key_exists("idSesion", $arrDatos)) {
					$this->db->where('S.id_sesion', $arrDatos["idSesion"]);
				}
				
				$this->db->where('G.fecha >=', $firstDay); //se filtran por registros mayores al primer dia del año
				
				$this->db->order_by('S.id_sesion', 'asc');
				$query = $this->db->get('sesiones S');

				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}
		
		/**
		 * Add/Edit SESIONES
		 * @since 11/5/2017
		 */
		public function saveSesiones() 
		{
				$idGrupo = $this->input->post('hddIdGrupo');
				$idSesion = $this->input->post('hddId');
				
				$hourIn = $this->input->post('hourIni');
				$hourOut = $this->input->post('hourFin');
				
				$hourIn = $hourIn<10?"0".$hourIn:$hourIn;
				$hourOut = $hourOut<10?"0".$hourOut:$hourOut;
				
				$timeIn = $hourIn . ":" . $this->input->post('minIni');
				$timeOut = $hourOut . ":" . $this->input->post('minFin');
				
				$data = array(
					'fk_id_grupo_instrumentos' => $idGrupo,
					'sesion_prueba' => $this->input->post('sesion'),
					'hora_inicio_prueba' => $timeIn ,
					'hora_fin_prueba' => $timeOut
				);
				
				//revisar si es para adicionar o editar
				if ($idSesion == '') {
					$data['fecha_creacion'] = date("Y-m-d");
					$query = $this->db->insert('sesiones', $data);
					$idSesion = $this->db->insert_id();				
				} else {
					$this->db->where('id_sesion', $idSesion);
					$query = $this->db->update('sesiones', $data);
				}
				if ($query) {
					return $idSesion;
				} else {
					return false;
				}
		}
		
	    /**
	     * Actualiar SITIO con el coordinador y el delegado
	     * @since  13/5/2017
	     */
	    public function updateSitio()
		{
				$idSitio = $this->input->post("hddId");
				$rol = $this->input->post("hddRol");

				$data = array(
					'fk_id_user_' . $rol => $this->input->post("usuario")
				);

				$this->db->where('id_sitio', $idSitio);
				$query = $this->db->update('sitios', $data);

				if ($query) {
					return true;
				} else {
					return false;
				}
	    }
		
	    /**
	     * Actualiar SITIO con el coordinador y el delegado
	     * @since  20/5/2017
	     */
	    public function updateSitioContacto()
		{
				$idSitio = $this->input->post("hddId");

				$data = array(
					'contacto_nombres' => $this->input->post("nombres"),
					'contacto_apellidos' => $this->input->post("apellidos"),
					'contacto_telefono' => $this->input->post("telefono"),
					'contacto_celular' => $this->input->post("movilNumber"),
					'contacto_email' => $this->input->post("email")
				);

				$this->db->where('id_sitio', $idSitio);
				$query = $this->db->update('sitios', $data);

				if ($query) {
					return true;
				} else {
					return false;
				}
	    }
		
		/**
		 * Add/Edit ALERTA
		 * @since 14/5/2017
		 */
		public function saveAlerta() 
		{
				$idAlerta = $this->input->post('hddId');
				$fechaAlerta = $this->input->post('fechaAlerta');
				$duracion = $this->input->post('duracion');
				
				$hour = $this->input->post('hour');
				$hour = $hour<10?"0".$hour:$hour;
				
				$time = $hour . ":" . $this->input->post('min');
				
				$fechaInicio = $fechaAlerta . " " . $time . ":00";
				
				$fechaFin = strtotime ( '+' . $duracion . ' minute' , strtotime ( $fechaInicio ) ) ;
				$fechaFin = date ( 'Y-m-d G:i:s' , $fechaFin );

				$data = array(
					'descripcion_alerta' => $this->input->post('descripcion'),
					'fk_id_tipo_alerta' => $this->input->post('tipoAlerta'),
					'fecha_alerta' => $fechaAlerta,
					'mensaje_alerta' => $this->input->post('mensaje'),
					'hora_alerta' => $time,
					'tiempo_duracion_alerta' => $duracion,
					'fk_id_rol' => $this->input->post('rol'),
					'fk_id_sesion' => $this->input->post('sesion'),
					'fecha_inicio' => $fechaInicio,
					'fecha_fin' => $fechaFin,
					'estado_alerta' => $this->input->post('estado')
				);
				
				//revisar si es para adicionar o editar
				if ($idAlerta == '') {
					$data['fecha_creacion'] = date("Y-m-d");
					$query = $this->db->insert('alertas', $data);
					$idAlerta = $this->db->insert_id();				
				} else {
					$this->db->where('id_alerta', $idAlerta);
					$query = $this->db->update('alertas', $data);
				}
				if ($query) {
					return $idAlerta;
				} else {
					return false;
				}
		}
		
		/**
		 * Lista de alertas
		 * @since 14/5/2017
		 */
		public function get_alertas($arrDatos) 
		{
				$this->db->select();
				$this->db->join('param_tipo_alerta T', 'T.id_tipo_alerta = A.fk_id_tipo_alerta', 'INNER');
				$this->db->join('param_roles R', 'R.id_rol = A.fk_id_rol', 'INNER');
				$this->db->join('sesiones S', 'S.id_sesion = A.fk_id_sesion', 'INNER');
				$this->db->join('param_grupo_instrumentos G', 'G.id_grupo_instrumentos = S.fk_id_grupo_instrumentos', 'INNER');
				$this->db->join('pruebas P', 'P.id_prueba = G.fk_id_prueba', 'INNER');
				if (array_key_exists("idGrupo", $arrDatos)) {
					$this->db->where('S.fk_id_grupo_instrumentos', $arrDatos["idGrupo"]);
				}
				$this->db->order_by('P.nombre_prueba, G.nombre_grupo_instrumentos, S.sesion_prueba', 'asc');
				$query = $this->db->get('alertas A');

				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}
		
		/**
		 * Lista grupo_instrumentos
		 * @since 16/5/2017
		 */
		public function get_grupo_instrumentos($arrDatos) 
		{
				$year = date('Y');
				$firstDay = date('Y-m-d', mktime(0,0,0, 1, 1, $year));
			
				$this->db->select();
				$this->db->join('pruebas P', 'P.id_prueba = G.fk_id_prueba', 'INNER');
				if (array_key_exists("idGrupo", $arrDatos)) {
					$this->db->where('G.id_grupo_instrumentos', $arrDatos["idGrupo"]);
				}
				$this->db->where('G.fecha >=', $firstDay); //se filtran por registros mayores al primer dia del año
				
				$this->db->order_by('P.nombre_prueba', 'asc');
				$query = $this->db->get('param_grupo_instrumentos G');

				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}		
		
		/**
		 * Lista de sesiones por sitio
		 * @since 17/5/2017
		 */
		public function get_sesiones_sitio($arrDatos) 
		{
				$this->db->select();
				$this->db->join('sesiones S', 'S.id_sesion = X.fk_id_sesion', 'INNER');
				$this->db->join('param_grupo_instrumentos G', 'G.id_grupo_instrumentos = S.fk_id_grupo_instrumentos', 'INNER');
				$this->db->join('pruebas P', 'P.id_prueba = G.fk_id_prueba', 'INNER');
				$this->db->join('sitios Y', 'Y.id_sitio = X.fk_id_sitio', 'INNER');
				$this->db->join('param_regiones R', 'R.id_region = Y.fk_id_region', 'INNER');
				$this->db->join('param_divipola D', 'D.mpio_divipola = Y.fk_mpio_divipola', 'INNER');
				if (array_key_exists("idSitio", $arrDatos)) {
					$this->db->where('X.fk_id_sitio', $arrDatos["idSitio"]);
				}
				
				if (array_key_exists("idSesion", $arrDatos)) {
					$this->db->where('X.fk_id_sesion', $arrDatos["idSesion"]);
				}
				
				if (array_key_exists("idSesionSitio", $arrDatos)) {
					$this->db->where('X.id_sitio_sesion', $arrDatos["idSesionSitio"]);
				}
				
				//filtro para cuando se edita el SITIO - SESION se verifique que no se repite la relacion
				if (array_key_exists("idSitioSesionDistinta", $arrDatos)) {
					$this->db->where('X.id_sitio_sesion !=', $arrDatos["idSitioSesionDistinta"]);
				}				

				
				$this->db->order_by('X.id_sitio_sesion', 'asc');	
				$query = $this->db->get('sitio_sesion X');

				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}
		
		/**
		 * Add/Edit SESIONES para SITIO
		 * @since 18/5/2017
		 */
		public function saveSitiosSesion() 
		{
				$idSitio = $this->input->post('hddIdSitio');
				$idSitioSesion = $this->input->post('hddId');
								
				$data = array(
					'fk_id_sitio' => $idSitio,
					'fk_id_sesion' => $this->input->post('prueba'),
					'numero_citados' => $this->input->post('citados')
				);
				
				//revisar si es para adicionar o editar
				if ($idSitioSesion == '') {
					$data['fecha_creacion'] = date("Y-m-d");
					$query = $this->db->insert('sitio_sesion', $data);
					$idSitioSesion = $this->db->insert_id();				
				} else {
					$this->db->where('id_sitio_sesion', $idSitioSesion);
					$query = $this->db->update('sitio_sesion', $data);
				}
				if ($query) {
					return $idSitioSesion;
				} else {
					return false;
				}
		}

		
		
	    
	}