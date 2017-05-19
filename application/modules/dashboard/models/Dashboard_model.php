<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Dashboard_model extends CI_Model {

		
		/**
		 * Muestra la ultima alerta-INFORMATIVA para el USUAIOR
		 * @since 14/5/2017
		 */
		public function get_alerta_informativa_by($arrDatos) 
		{
				$fecha = date("Y-m-d G:i:s");
			
				$this->db->select();
				$this->db->join('param_tipo_alerta T', 'T.id_tipo_alerta = A.fk_id_tipo_alerta', 'INNER');
				$this->db->join('param_roles R', 'R.id_rol = A.fk_id_rol', 'INNER');
				$this->db->join('sesiones S', 'S.id_sesion = A.fk_id_sesion', 'INNER');
				$this->db->join('param_grupo_instrumentos G', 'G.id_grupo_instrumentos = S.fk_id_grupo_instrumentos', 'INNER');
				$this->db->join('pruebas P', 'P.id_prueba = G.fk_id_prueba', 'INNER');
				$this->db->join('sitio_sesion X', 'X.fk_id_sesion = S.id_sesion', 'INNER');

				
				$this->db->where('A.estado_alerta', 1); //ALERTA ACTIVA
				$this->db->where('A.fecha_inicio <=', $fecha); //FECHA INICIAL MAYOR A LA ACTUAL
				$this->db->where('A.fecha_fin >=', $fecha); //FECHA INICIAL MAYOR A LA ACTUAL
				$this->db->where('A.fk_id_tipo_alerta', 1); //TIPO ALERTA = INFORMATIVA
				
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
		
		
	}