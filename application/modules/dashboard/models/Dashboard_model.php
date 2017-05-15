<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Dashboard_model extends CI_Model {

		
		/**
		 * Lista de alertas
		 * @since 14/5/2017
		 */
		public function get_alertas_by($arrDatos) 
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