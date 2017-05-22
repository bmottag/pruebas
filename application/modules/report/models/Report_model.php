<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Report_model extends CI_Model {
	    
		/**
		 * Muestra registros de las Alertas
		 * @since 20/5/2017
		 */
		public function get_consolidado_by($arrDatos) 
		{
				$this->db->select();
				$this->db->join('alertas A', 'A.id_alerta = R.fk_id_alerta', 'INNER');//tipo alerta
				$this->db->join('param_tipo_alerta T', 'T.id_tipo_alerta = A.fk_id_tipo_alerta', 'INNER');//tipo alerta
				$this->db->join('sesiones S', 'S.id_sesion = A.fk_id_sesion', 'INNER');//SESIONES - ALERTA
				$this->db->join('param_grupo_instrumentos G', 'G.id_grupo_instrumentos = S.fk_id_grupo_instrumentos', 'INNER'); //GRUPO INSTRUMENTO - SESIONES
				$this->db->join('pruebas P', 'P.id_prueba = G.fk_id_prueba', 'INNER');//PRUEBA - GRUPO INSTRUMENTO
				$this->db->join('sitio_sesion X', 'X.fk_id_sesion = S.id_sesion', 'INNER');//SITIO - SESION
				$this->db->join('sitios Y', 'Y.id_sitio = X.fk_id_sitio', 'INNER');//SITIO
				$this->db->join('param_divipola D', 'D.mpio_divipola = Y.fk_mpio_divipola', 'INNER');//DIVIPOLA
				$this->db->join('usuario U', 'U.id_usuario = R.fk_id_usuario', 'INNER');//USUARIO
				
				if (array_key_exists("tipoAlerta", $arrDatos)) {
					$this->db->where('A.fk_id_tipo_alerta', $arrDatos["tipoAlerta"]); //TIPO ALERTA = INFORMATIVA
				}
				
				$this->db->order_by('A.id_alerta', 'desc');
				$query = $this->db->get('registro R');

				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}
		
		/**
		 * Muestra inofrmacion sitios filtrado por Region o Departamento
		 * @since 21/5/2017
		 */
		public function get_sitios_by($arrDatos) 
		{			
				$this->db->select('S.*, O.nombre_organizacion, R.nombre_region, D.*, Z.nombre_zona, U.numero_documento as delegado, Y.numero_documento as coordinador');
				$this->db->join('param_organizaciones O', 'O.id_organizacion = S.fk_id_organizacion', 'INNER');
				$this->db->join('param_regiones R', 'R.id_region = S.fk_id_region', 'INNER');
				$this->db->join('param_divipola D', 'D.mpio_divipola = S.fk_mpio_divipola', 'INNER');
				$this->db->join('param_zonas Z', 'Z.id_zona = S.fk_id_zona', 'INNER');
				$this->db->join('usuario U', 'U.id_usuario = S.fk_id_user_delegado', 'LEFT');
				$this->db->join('usuario Y', 'Y.id_usuario = S.fk_id_user_coordinador', 'LEFT');
				
				if (array_key_exists("idRegion", $arrDatos)) {
					$this->db->where('S.fk_id_region', $arrDatos["idRegion"]); //FILTRO POR REGION
				}
				
				if (array_key_exists("idDepto", $arrDatos)) {
					$this->db->where('S.fk_dpto_divipola', $arrDatos["idDepto"]); //FILTRO POR DEPARTAMENTO
				}

				$this->db->order_by('R.nombre_region, D.dpto_divipola_nombre, D.mpio_divipola_nombre', 'desc');
				$query = $this->db->get('sitios S');

				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}
		
		/**
		 * Contar registros de sesiones por sitio
		 * filtrado por fecha vigente
		 * @since  21/5/2017
		 */
		public function countSesionesbySitio($arrDatos)
		{
				$year = date('Y');
				$firstDay = date('Y-m-d', mktime(0,0,0, 1, 1, $year));

				$sql = "SELECT count(fk_id_sesion) CONTEO";
				$sql.= " FROM sitio_sesion SS";
				$sql.= " INNER JOIN sesiones S ON S.id_sesion = SS.fk_id_sesion";
				$sql.= " INNER JOIN param_grupo_instrumentos G ON G.id_grupo_instrumentos = S.fk_id_grupo_instrumentos";
				
				if (array_key_exists("idSitio", $arrDatos)) {
					$sql.= " WHERE SS.fk_id_sitio = " . $arrDatos["idSitio"];
				}

				$sql.= " AND G.fecha >= '$firstDay'";

				$query = $this->db->query($sql);
				$row = $query->row();
				return $row->CONTEO;
		}
		
		/**
		 * Muestra sesiones para un sitio
		 * @since 21/5/2017
		 */
		public function get_sesiones_by($arrDatos) 
		{
				$this->db->select();
				$this->db->join('sesiones S', 'S.id_sesion = X.fk_id_sesion', 'INNER');//SESIONES - ALERTA
				
				if (array_key_exists("tipoAlerta", $arrDatos)) {
					$this->db->where('A.fk_id_tipo_alerta', $arrDatos["tipoAlerta"]); //TIPO ALERTA = INFORMATIVA
				}
				
				$this->db->order_by('X.fk_id_sitio', 'desc');
				$query = $this->db->get('sitio_sesion X');

				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}

		
		
		
		
		
		
		
		
		
		
	    
	}