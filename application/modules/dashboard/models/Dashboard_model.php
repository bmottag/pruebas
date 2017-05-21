<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Dashboard_model extends CI_Model {

		
		/**
		 * Muestra la ultima alerta-INFORMATIVA para el USUAIOR
		 * @since 14/5/2017
		 */
		public function get_alerta_by($arrDatos) 
		{
				$fecha = date("Y-m-d G:i:s");
				$userRol = $this->session->rol;
				$userSitio = $this->session->sitio;

			
				$this->db->select();
				$this->db->join('param_tipo_alerta T', 'T.id_tipo_alerta = A.fk_id_tipo_alerta', 'INNER');//tipo alerta
				$this->db->join('param_roles R', 'R.id_rol = A.fk_id_rol', 'INNER');//ROLES - ALERTA
				$this->db->join('sesiones S', 'S.id_sesion = A.fk_id_sesion', 'INNER');//SESIONES - ALERTA
				$this->db->join('param_grupo_instrumentos G', 'G.id_grupo_instrumentos = S.fk_id_grupo_instrumentos', 'INNER'); //GRUPO INSTRUMENTO - SESIONES
				$this->db->join('pruebas P', 'P.id_prueba = G.fk_id_prueba', 'INNER');//PRUEBA - GRUPO INSTRUMENTO
				$this->db->join('sitio_sesion X', 'X.fk_id_sesion = S.id_sesion', 'INNER');//SITIO - SESION

				$this->db->where('A.estado_alerta', 1); //ALERTA ACTIVA
				$this->db->where('A.fecha_inicio <=', $fecha); //FECHA INICIAL MAYOR A LA ACTUAL
				$this->db->where('A.fecha_fin >=', $fecha); //FECHA INICIAL MAYOR A LA ACTUAL
				
				if (array_key_exists("tipoAlerta", $arrDatos)) {
					$this->db->where('A.fk_id_tipo_alerta', $arrDatos["tipoAlerta"]); //TIPO ALERTA = INFORMATIVA
				}
				
				$this->db->where('A.fk_id_rol', $userRol); //filtro por ROL DEL USUARIO
				$this->db->where('X.fk_id_sitio', $userSitio); //filtro por SITIO DEL USUARIO
				
				$this->db->order_by('A.id_alerta', 'desc');
				$query = $this->db->get('alertas A' , 1);

				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}
		
		/**
		 * Lista de alertas
		 * @since 18/5/2017
		 */
		public function get_consolidacion_by($arrDatos) 
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
				$this->db->order_by('S.id_sesion', 'asc');
				$query = $this->db->get('alertas A');

				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}		
		
		/**
		 * Guardar respuesta del usuario
		 * @since 19/5/2017
		 */
		public function saveRegistroInformativo() 
		{
				$data = array(
					'fk_id_alerta' => $this->input->post('hddId'),
					'fk_id_usuario' => $this->session->id,
					'acepta' => 1,
					'fecha_registro' => date("Y-m-d G:i:s")
				);	

				$query = $this->db->insert('registro', $data);

				if ($query) {
					return true;
				} else {
					return false;
				}
		}
		
		/**
		 * Consultar si el usuario ya dio respuesta a la alerta
		 * @since 19/5/2017
		 */
		public function get_registro_by($arrDatos) 
		{
				$this->db->select();
				if (array_key_exists("idAlerta", $arrDatos)) {
					$this->db->where('fk_id_alerta', $arrDatos["idAlerta"]);
				}
				$this->db->where('fk_id_usuario', $this->session->id);
				$query = $this->db->get('registro');

				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}
		
		/**
		 * Guardar respuesta del usuario
		 * @since 19/5/2017
		 */
		public function saveRegistroNotificacion() 
		{
				$data = array(
					'fk_id_alerta' => $this->input->post('hddId'),
					'fk_id_usuario' => $this->session->id,
					'acepta' => $this->input->post('acepta'),
					'observacion' => $this->input->post('observacion'),
					'fecha_registro' => date("Y-m-d G:i:s")
				);	

				$query = $this->db->insert('registro', $data);

				if ($query) {
					return true;
				} else {
					return false;
				}
		}
		
		/**
		 * Guardar respuesta del usuario
		 * @since 19/5/2017
		 */
		public function saveRegistroConsolidacion() 
		{
				$data = array(
					'fk_id_alerta' => $this->input->post('hddId'),
					'fk_id_usuario' => $this->session->id,
					'acepta' => 1,
					'ausentes' => $this->input->post('ausentes'),
					'observacion' => $this->input->post('observacion'),
					'fecha_registro' => date("Y-m-d G:i:s")
				);	

				$query = $this->db->insert('registro', $data);

				if ($query) {
					return true;
				} else {
					return false;
				}
		}
		
		
	}