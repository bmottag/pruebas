<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Clase para consultas especificas
 */
class Specific_model extends CI_Model {

		/**
		 * Información de una alerta
		 * @since 28/7/2017
		 */
		public function get_info_alerta($arrDatos) 
		{
				$this->db->select();
				$this->db->join('param_tipo_alerta T', 'T.id_tipo_alerta = A.fk_id_tipo_alerta', 'INNER');//tipo alerta
				$this->db->join('param_roles R', 'R.id_rol = A.fk_id_rol', 'INNER');//ROLES - ALERTA
				$this->db->join('sesiones S', 'S.id_sesion = A.fk_id_sesion', 'INNER');//SESIONES - ALERTA
				$this->db->join('param_grupo_instrumentos G', 'G.id_grupo_instrumentos = S.fk_id_grupo_instrumentos', 'INNER'); //GRUPO INSTRUMENTO - SESIONES
				$this->db->join('pruebas P', 'P.id_prueba = G.fk_id_prueba', 'INNER');//PRUEBA - GRUPO INSTRUMENTO
				
				if (array_key_exists("idAlerta", $arrDatos)) {
					$this->db->where('A.id_alerta', $arrDatos["idAlerta"]); //FILTRO POR ID ALERTA
				}
				
				$query = $this->db->get('alertas A');

				if ($query->num_rows() > 0) {
					return $query->row_array();
				} else {
					return false;
				}
		}
		
		/**
		 * Lista de alertas para mostrar en la app
		 * @since 28/7/2017
		 */
		public function get_lista_alertas() 
		{
				$this->db->select();
				$this->db->join('param_tipo_alerta T', 'T.id_tipo_alerta = A.fk_id_tipo_alerta', 'INNER');
				$this->db->join('sesiones S', 'S.id_sesion = A.fk_id_sesion', 'INNER');
				$this->db->join('param_grupo_instrumentos G', 'G.id_grupo_instrumentos = S.fk_id_grupo_instrumentos', 'INNER');
				$this->db->join('pruebas P', 'P.id_prueba = G.fk_id_prueba', 'INNER');

				$this->db->order_by('A.fecha_inicio, P.nombre_prueba, G.nombre_grupo_instrumentos, S.sesion_prueba', 'asc');
				$query = $this->db->get('alertas A');

				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}
		
		/**
		 * Lista de sesiones para un operador
		 * @since 28/7/2017
		 */
		public function get_sesiones_operador() 
		{				
				$this->db->select("DISTINCT(id_sesion), nombre_prueba, nombre_grupo_instrumentos, fecha, sesion_prueba");

				//SITIO-SESION
				$this->db->join('sitio_sesion X', 'X.fk_id_sitio = Y.id_sitio', 'INNER');
				
				//SESION
				$this->db->join('sesiones S', 'S.id_sesion = X.fk_id_sesion', 'INNER');
				//GRUPO INSTRUMENTOS
				$this->db->join('param_grupo_instrumentos G', 'G.id_grupo_instrumentos = S.fk_id_grupo_instrumentos', 'INNER');
				//PRUEBA
				$this->db->join('pruebas P', 'P.id_prueba = G.fk_id_prueba', 'INNER');
				
				
				//FILTRO POR COORDINADOR SI EL USUARIO DE SESION ES COORDINADOR
				$userRol = $this->session->rol;
				if($userRol==3) {
					$this->db->where('Y.fk_id_user_coordinador', $this->session->id); //FILTRO POR ID DEL COORDINADOR
				}				
				//FILTRO POR OPERADOR SI EL USUARIO DE SESION ES OPERADOR
				if($userRol==6) {
					$this->db->where('Y.fk_id_user_operador', $this->session->id); //FILTRO POR ID DEL OPERADOR
				}
			
				$query = $this->db->get('sitios Y');

				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}
		
		/**
		 * Obtener alertas vencidas y que se le debe dar respuesta por el delegado
		 * filtrados por operador y por sesion
		 * @since 28/7/2017
		 */
		public function get_alertas_vencidas_totales($arrDatos) 
		{		
				//fecha para buscar las que ya se vencieron
				$fechaActual = date('Y-m-d G:i:s');	

				$this->db->select('distinct(id_alerta)');

				//SITIO-SESION
				$this->db->join('sitio_sesion X', 'X.fk_id_sitio = Y.id_sitio', 'INNER');
				
				//SESION
				$this->db->join('sesiones S', 'S.id_sesion = X.fk_id_sesion', 'INNER');
				
				//ALERTA
				$this->db->join('alertas A', 'A.fk_id_sesion = S.id_sesion', 'INNER');
				
				if (array_key_exists("idSesion", $arrDatos)) {
					$this->db->where('S.id_sesion', $arrDatos["idSesion"]); //filtro por SESION
				}
				
				//FILTRO POR COORDINADOR SI EL USUARIO DE SESION ES COORDINADOR
				$userRol = $this->session->rol;
				if($userRol==3) {
					$this->db->where('Y.fk_id_user_coordinador', $this->session->id); //FILTRO POR ID DEL COORDINADOR
				}				
				//FILTRO POR OPERADOR SI EL USUARIO DE SESION ES OPERADOR
				if($userRol==6) {
					$this->db->where('Y.fk_id_user_operador', $this->session->id); //FILTRO POR ID DEL OPERADOR
				}
				
				$this->db->where('A.estado_alerta', 1); //ALERTAS ACTIVAS
				$this->db->where('A.fk_id_rol', 4); //ALERTAS QUE SON PARA DELEGADO
				
				$tipoMensaje = array(1, 2);//filtrar por alertas que se muestren en el APP
				$this->db->where_in('A.tipo_mensaje', $tipoMensaje);
				
				$this->db->where('A.fecha_fin <=', $fechaActual); //FECHA FINAL SEA MAYOR A LA FECHA ACTUAL
			
				$this->db->order_by('A.id_alerta', 'asc');
				$query = $this->db->get('sitios Y');

				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}
		




		


}