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
		 * Muestra informacion sitios filtrado por Region o Departamento
		 * @since 21/5/2017
		 */
		public function get_total_by($arrDatos) 
		{		
				$idRegion = $this->input->post('region');				
				$depto = $this->input->post('depto');
				$mcpio = $this->input->post('mcpio');
				$sesion = $this->input->post('sesion');
				$alerta = $this->input->post('alerta');
		
				$this->db->select('Y.*,A.*, S.*, P.nombre_prueba, G.nombre_grupo_instrumentos, G.fecha,
				O.nombre_organizacion, R.nombre_region, D.*, Z.nombre_zona, T.*, X.*');
				
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
				
					
				$this->db->where('A.estado_alerta', 1); //ALERTAS ACTIVAS
				$tipoMensaje = array(1, 2);//filtrar por alertas que se muestren en el APP
				$this->db->where_in('A.tipo_mensaje', $tipoMensaje);	

				if (array_key_exists("rolAlerta", $arrDatos)) {
					$this->db->where('A.fk_id_rol', $arrDatos["rolAlerta"]); //TIPO ALERTA
				}
				
				if ($sesion && $sesion != "") {
					$this->db->where('X.fk_id_sesion', $sesion); //FILTRO POR SESION
				}
				
				if ($alerta && $alerta != "") {
					$this->db->where('A.id_alerta', $alerta); //FILTRO POR ALERTA
				}
				
				if($idRegion && $idRegion != "") {
					$this->db->where('Y.fk_id_region', $idRegion); //FILTRO POR REGION
				}
				
				if ($depto && $depto != "") {
					$this->db->where('Y.fk_dpto_divipola', $depto); //FILTRO POR DEPARTAMENTO
				}
			
				if ($mcpio && $mcpio != "") {
					$this->db->where('Y.fk_mpio_divipola', $mcpio); //FILTRO POR MUNICIPIO
				}
				
				if (array_key_exists("tipoAlerta", $arrDatos)) {
					$this->db->where('A.fk_id_tipo_alerta', $arrDatos["tipoAlerta"]); //TIPO ALEERTA
				}
				
				
				//FILTRO POR COORDINADOR SI EL USUARIO DE SESION ES COORDINADOR
				$userRol = $this->session->rol;
				if($userRol==3) {
					$this->db->where('Y.fk_id_user_coordinador', $this->session->id); //FILTRO POR ID DEL COORDINADOR
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
		
		/**
		 * Guardar respuesta del usuario
		 * @since 19/5/2017
		 */
		public function saveRegistroNotificacionCoordinador() 
		{
				$data = array(
					'fk_id_alerta' => $this->input->post('hddIdAlerta'),
					'fk_id_usuario' => $this->input->post('hddIdUserDelegado'),
					'fk_id_sitio_sesion' => $this->input->post('hddIdSitioSesion'),
					'acepta' => $this->input->post('acepta'),
					'observacion' => $this->input->post('observacion'),
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
		
		/**
		 * Guardar respuesta del usuario
		 * @since 19/5/2017
		 */
		public function saveRegistroConsolidacionCoordinador() 
		{
				$ausentes = $this->input->post('ausentes');
				$idSitioSesion = $this->input->post('hddIdSitioSesion');
		
				$data = array(
					'fk_id_alerta' => $this->input->post('hddIdAlerta'),
					'fk_id_usuario' => $this->input->post('hddIdUserDelegado'),
					'fk_id_sitio_sesion' => $this->input->post('hddIdSitioSesion'),
					'acepta' => 1,
					'ausentes' => $ausentes,
					'fecha_registro' => date("Y-m-d G:i:s"),
					'fk_id_user_coordinador' => $this->session->id,
					'nota' => 'Se realizó el registro por el Coordinador.'
				);	

				$query = $this->db->insert('registro', $data);

				if ($query) {
					
					//actualizo tabla sitio_sesion con la cantidad de ausentes
					$presentes = $this->input->post('citados') - $ausentes;
					
					$data = array(
						'numero_ausentes' => $ausentes,
						'numero_presentes_efectivos' => $presentes
					);

					$this->db->where('id_sitio_sesion', $idSitioSesion);
					$query = $this->db->update('sitio_sesion', $data);

					return true;
				} else {
					return false;
				}
		}

		
		/**
		 * Lista de Alertas para el REPORTE
		 * @since 24/5/2017
		 */
		public function get_respuestas_registro($arrDatos) 
		{		
				$sesion = $this->input->post('sesion');
				$alerta = $this->input->post('alerta');
				
				$idRegion = $this->input->post('region');				
				$depto = $this->input->post('depto');
				$mcpio = $this->input->post('mcpio');
				
		
				$this->db->select('id_sitio_sesion, id_sitio, id_sesion, id_alerta');
				
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
				
				$this->db->where('A.estado_alerta', 1); //ALERTAS ACTIVAS
				$tipoMensaje = array(1, 2);//filtrar por alertas que se muestren en el APP
				$this->db->where_in('A.tipo_mensaje', $tipoMensaje);	

				if (array_key_exists("rolAlerta", $arrDatos)) {
					$this->db->where('A.fk_id_rol', $arrDatos["rolAlerta"]); //TIPO ALERTA
				}
				
				if ($sesion && $sesion != "") {
					$this->db->where('X.fk_id_sesion', $sesion); //FILTRO POR SESION
				}
				
				if ($alerta && $alerta != "") {
					$this->db->where('A.id_alerta', $alerta); //FILTRO POR ALERTA
				}
				
				if($idRegion && $idRegion != "") {
					$this->db->where('Y.fk_id_region', $idRegion); //FILTRO POR REGION
				}
				
				if ($depto && $depto != "") {
					$this->db->where('Y.fk_dpto_divipola', $depto); //FILTRO POR DEPARTAMENTO
				}
			
				if ($mcpio && $mcpio != "") {
					$this->db->where('Y.fk_mpio_divipola', $mcpio); //FILTRO POR MUNICIPIO
				}
				
				if (array_key_exists("tipoAlerta", $arrDatos)) {
					$this->db->where('A.fk_id_tipo_alerta', $arrDatos["tipoAlerta"]); //TIPO ALEERTA
				}

				$query = $this->db->get('sitio_sesion X');

				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}
		
		/**
		 * Conteo de sitios para el reporte general
		 * @since 26/5/2017
		 */
		public function get_numero_sitios_por_filtro($arrDatos) 
		{		
				$sesion = $this->input->post('sesion');
				
				$idRegion = $this->input->post('region');				
				$depto = $this->input->post('depto');
				$mcpio = $this->input->post('mcpio');

				$sql = "SELECT COUNT(DISTINCT(id_sitio)) CONTEO";
				$sql.= " FROM sitio_sesion X ";
				$sql.= "	INNER JOIN sesiones S ON S.id_sesion = X.fk_id_sesion 
							INNER JOIN sitios Y ON Y.id_sitio = X.fk_id_sitio 
							INNER JOIN param_regiones R ON R.id_region = Y.fk_id_region 
							INNER JOIN param_divipola D ON D.mpio_divipola = Y.fk_mpio_divipola";
				
				if ($sesion && $sesion != "") {
					$sql.= " WHERE X.fk_id_sesion = '$sesion'"; //FILTRO POR SESION
				}
				
				if($idRegion && $idRegion != "") {
					$sql.= " AND Y.fk_id_region = '$idRegion'"; //FILTRO POR REGION
				}
				
				if ($depto && $depto != "") {
					$sql.= " AND Y.fk_dpto_divipola = '$depto'"; //FILTRO POR DEPARTAMENTO
				}
			
				if ($mcpio && $mcpio != "") {
					$sql.= " AND Y.fk_mpio_divipola = '$mcpio'"; //FILTRO POR MUNICIPIO
				}

				$query = $this->db->query($sql);
				$row = $query->row();
				return $row->CONTEO;
		}
		
		/**
		 * Conteo de citados para el reporte general
		 * @since 26/5/2017
		 */
		public function get_numero_citados_por_filtro($arrDatos) 
		{		
				$sesion = $this->input->post('sesion');
				
				$idRegion = $this->input->post('region');				
				$depto = $this->input->post('depto');
				$mcpio = $this->input->post('mcpio');

				$sql = "SELECT SUM(numero_citados) citados, SUM(numero_ausentes) ausentes";
				$sql.= " FROM sitio_sesion X ";
				$sql.= "	INNER JOIN sesiones S ON S.id_sesion = X.fk_id_sesion 
							INNER JOIN sitios Y ON Y.id_sitio = X.fk_id_sitio 
							INNER JOIN param_regiones R ON R.id_region = Y.fk_id_region 
							INNER JOIN param_divipola D ON D.mpio_divipola = Y.fk_mpio_divipola";			
				if ($sesion && $sesion != "") {
					$sql.= " WHERE X.fk_id_sesion = '$sesion'"; //FILTRO POR SESION
				}
				
				if($idRegion && $idRegion != "") {
					$sql.= " AND Y.fk_id_region = '$idRegion'"; //FILTRO POR REGION
				}
				
				if ($depto && $depto != "") {
					$sql.= " AND Y.fk_dpto_divipola = '$depto'"; //FILTRO POR DEPARTAMENTO
				}
			
				if ($mcpio && $mcpio != "") {
					$sql.= " AND Y.fk_mpio_divipola = '$mcpio'"; //FILTRO POR MUNICIPIO
				}

				$query = $this->db->query($sql);
				return $query->row_array();
		}
		
		
		
		
		
		
		
		
		
		
		
	    
	}