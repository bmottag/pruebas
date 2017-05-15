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
					'semestre_prueba' => $this->input->post('semestre'),
					'fecha_prueba' => $this->input->post('fechaPrueba')
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
		 * Lista de sitios
		 * @since 12/5/2017
		 */
		public function get_sitios($arrDatos) 
		{
				$this->db->select();
				$this->db->join('param_organizaciones O', 'O.id_organizacion = S.fk_id_organizacion', 'INNER');
				$this->db->join('param_regiones R', 'R.id_region = S.fk_id_region', 'INNER');
				$this->db->join('param_divipola D', 'D.mpio_divipola = S.fk_mpio_divipola', 'INNER');
				$this->db->join('param_zonas Z', 'Z.id_zona = S.fk_id_zona', 'INNER');
				if (array_key_exists("idSitio", $arrDatos)) {
					$this->db->where('S.id_sitio', $arrDatos["idSitio"]);
				}
				$this->db->order_by('S.nombre_sitio', 'asc');
				$query = $this->db->get('sitios S');

				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}
		
		/**
		 * Lista de sitios
		 * @since 12/5/2017
		 */
		public function get_dpto_divipola() 
		{
				$this->db->select('DISTINCT(dpto_divipola), dpto_divipola_nombre');

				$this->db->order_by('dpto_divipola_nombre', 'asc');
				$query = $this->db->get('param_divipola D');

				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}
		
		/**
		 * Municipios por departamento
		 * @since 12/5/2016
		 */
		public function get_municipios_by($arrDatos)
		{
				$municipios = array();
				$this->db->select();
				if (array_key_exists("idDepto", $arrDatos)) {
					$this->db->where('dpto_divipola', $arrDatos["idDepto"]);
				}
				$this->db->order_by('mpio_divipola_nombre', 'asc');
				$query = $this->db->get('param_divipola');
					
				if ($query->num_rows() > 0) {
					$i = 0;
					foreach ($query->result() as $row) {
						$municipios[$i]["idMcpio"] = $row->mpio_divipola;
						$municipios[$i]["municipio"] = $row->mpio_divipola_nombre;
						$i++;
					}
				}
				$this->db->close();
				return $municipios;
		}
		
		/**
		 * Add/Edit GRUPO INSTRUMENTOS
		 * @since 12/5/2017
		 */
		public function saveGrupoInstrumentos() 
		{
				$identificador = $this->input->post('hddId');
				
				$data = array(
					'nombre_grupo_instrumentos' => $this->input->post('nombreGrupoInstrumentos')
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
				$this->db->select();
				$this->db->join('pruebas P', 'P.id_prueba = S.fk_id_prueba', 'INNER');
				$this->db->join('param_grupo_instrumentos G', 'G.id_grupo_instrumentos = S.fk_id_grupo_instrumentos', 'INNER');
				if (array_key_exists("idGrupo", $arrDatos)) {
					$this->db->where('S.fk_id_grupo_instrumentos', $arrDatos["idGrupo"]);
				}
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
					'fk_id_prueba' => $this->input->post('prueba'),
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
	     * Actualiar SITIO Y PRUEBA USUARIO
	     * @since  13/5/2017
	     */
	    public function updateSitio()
		{
				$idUser = $this->input->post("hddId");

				$data = array(
					'fk_id_sitio' => $this->input->post("sitio"),
					'fk_id_prueba' => $this->input->post("prueba")
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
		 * Add/Edit ALERTA
		 * @since 14/5/2017
		 */
		public function saveAlerta() 
		{
				$idAlerta = $this->input->post('hddId');
				
				$hour = $this->input->post('hour');
				$hour = $hour<10?"0".$hour:$hour;
				
				$time = $hour . ":" . $this->input->post('min');
				
				$data = array(
					'descripcion_alerta' => $this->input->post('descripcion'),
					'fk_id_tipo_alerta' => $this->input->post('tipoAlerta'),
					'fecha_alerta' => $this->input->post('fechaAlerta'),
					'mensaje_alerta' => $this->input->post('mensaje'),
					'hora_alerta' => $time,
					'tiempo_duracion_alerta' => $this->input->post('duracion'),
					'fk_id_rol' => $this->input->post('rol'),
					'fk_id_sesion' => $this->input->post('sesion')
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
				$this->db->join('pruebas P', 'P.id_prueba = S.fk_id_prueba', 'INNER');
				$this->db->join('param_grupo_instrumentos G', 'G.id_grupo_instrumentos = S.fk_id_grupo_instrumentos', 'INNER');
				if (array_key_exists("idGrupo", $arrDatos)) {
					$this->db->where('S.fk_id_grupo_instrumentos', $arrDatos["idGrupo"]);
				}
				$this->db->order_by('S.id_sesion', 'asc');
				$query = $this->db->get('alertas A');

				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}
		
		
		
		
		
	    
	}