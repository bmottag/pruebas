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
		public function get_total_by($arrDatos) 
		{		
				//filtro para un perido menos a 20 dias y no mayor a 20 dias de la fecha actual
				$fecha = date("Y-m-d");
				$fechaInicio = strtotime ( '-20 day' , strtotime ( $fecha ) ) ;//le sumo 20 dias a la fecha actual
				$fechaInicio = date ( 'Y-m-d' , $fechaInicio );
				
				$fechaFin = strtotime ( '+20 day' , strtotime ( $fecha ) ) ;//le resto 20 dias a la fecha actual
				$fechaFin = date ( 'Y-m-d' , $fechaFin );

				$idRegion = $this->input->post('region');				
				$depto = $this->input->post('depto');
				$mcpio = $this->input->post('mcpio');
				$sesion = $this->input->post('sesion');
				$alerta = $this->input->post('alerta');
		
				$this->db->select('Y.*,A.*, S.*, K.id_registro, K.acepta, K.ausentes, K.observacion, K.fecha_registro, P.nombre_prueba, G.nombre_grupo_instrumentos, G.fecha,
				O.nombre_organizacion, R.nombre_region, D.*, Z.nombre_zona, T.nombre_tipo_alerta, X.*');
				
				//SESION
				$this->db->join('sesiones S', 'S.id_sesion = X.fk_id_sesion', 'INNER');
				$this->db->join('param_grupo_instrumentos G', 'G.id_grupo_instrumentos = S.fk_id_grupo_instrumentos', 'INNER');
				$this->db->join('pruebas P', 'P.id_prueba = G.fk_id_prueba', 'INNER');
				
				//ALERTA
				$this->db->join('alertas A', 'A.fk_id_sesion = S.id_sesion', 'INNER');
				$this->db->join('param_tipo_alerta T', 'T.id_tipo_alerta = A.fk_id_tipo_alerta', 'INNER');
				
				//SITIO
				$this->db->join('sitios Y', 'Y.id_sitio = X.fk_id_sitio', 'INNER');
				$this->db->join('param_regiones R', 'R.id_region = Y.fk_id_region', 'INNER');
				$this->db->join('param_divipola D', 'D.mpio_divipola = Y.fk_mpio_divipola', 'INNER');
				$this->db->join('param_organizaciones O', 'O.id_organizacion = Y.fk_id_organizacion', 'INNER');
				$this->db->join('param_zonas Z', 'Z.id_zona = Y.fk_id_zona', 'INNER');
				
				//REGISTRO
				//$this->db->join('registro N', 'N.fk_id_alerta = A.id_alerta', 'LEFT');
				$this->db->join('registro K', 'K.fk_id_sitio_sesion = X.id_sitio_sesion', 'LEFT');
				
				
				
				$this->db->where('G.fecha >=', $fechaInicio); //FECHA INICIAL MAYOR A LA ACTUAL
				$this->db->where('G.fecha <=', $fechaFin); //FECHA FINAL MENOR A LA ACTUAL				
				
				
				if($idRegion && $idRegion != "") {
					$this->db->where('Y.fk_id_region', $idRegion); //FILTRO POR REGION
				}
				
				if ($depto && $depto != "") {
					$this->db->where('Y.fk_dpto_divipola', $depto); //FILTRO POR DEPARTAMENTO
				}
			
				if ($mcpio && $mcpio != "") {
					$this->db->where('Y.fk_mpio_divipola', $mcpio); //FILTRO POR MUNICIPIO
				}
				
				if ($sesion && $sesion != "") {
					$this->db->where('X.fk_id_sesion', $sesion); //FILTRO POR DEPARTAMENTO
				}
				
				if ($alerta && $alerta != "") {
					$this->db->where('A.id_alerta', $alerta); //FILTRO POR ALERTA
				}
				
				if (array_key_exists("idSitioSesion", $arrDatos)) {
					$this->db->where('X.id_sitio_sesion', $arrDatos["idSitioSesion"]); //SITIO-SESION
				}

				//$this->db->order_by('R.nombre_region, D.dpto_divipola_nombre, D.mpio_divipola_nombre', 'desc');
				$query = $this->db->get('sitio_sesion X');

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
		
		/**
		 * Guardar respuesta del usuario coordinador
		 * @since 19/5/2017
		 */
		public function saveRegistroInformativoCoordinador() 
		{
				$data = array(
					'fk_id_alerta' => $this->input->post('hddIdAlerta'),
					'fk_id_usuario' => $this->input->post('hddIdUserDelegado'),
					'fk_id_sitio_sesion' => $this->input->post('hddIdSitioSesion'),
					'acepta' => 1,
					'fecha_registro' => date("Y-m-d G:i:s"),
					'fk_id_user_coordinador' => $this->session->id,
					'nota' => 'Se realizó el registro por el Coordinador.'
				);	

				$query = $this->db->insert('registro', $data);

				if ($query) {
					return true;
				} else {
					return false;
				}
		}

		
		
		
		
		
		
		
		
		
		
	    
	}