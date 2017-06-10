<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Cron_model extends CI_Model {

		
		/**
		 * Muestra las alertas ACTIVAS para enviar por correo
		 * @since 9/6/2017
		 */
		public function get_alerta_email($arrDatos) 
		{
				$fecha = date("Y-m-d G:i:s");
			
				$this->db->select('T.nombre_tipo_alerta, Y.*,G.*, P.*, S.*, A.*, D.dpto_divipola_nombre, D.mpio_divipola_nombre,
				U.numero_documento as cedula_representante, CONCAT(U.nombres_usuario, " ", U.apellidos_usuario) AS representante, U.email email_representante, 
				K.numero_documento as cedula_operador, CONCAT(K.nombres_usuario, " ",K.apellidos_usuario) AS operador, K.email email_operador');
				$this->db->join('param_tipo_alerta T', 'T.id_tipo_alerta = A.fk_id_tipo_alerta', 'INNER');//tipo alerta
				$this->db->join('param_roles R', 'R.id_rol = A.fk_id_rol', 'INNER');//ROLES - ALERTA
				$this->db->join('sesiones S', 'S.id_sesion = A.fk_id_sesion', 'INNER');//SESIONES - ALERTA
				$this->db->join('param_grupo_instrumentos G', 'G.id_grupo_instrumentos = S.fk_id_grupo_instrumentos', 'INNER'); //GRUPO INSTRUMENTO - SESIONES
				$this->db->join('pruebas P', 'P.id_prueba = G.fk_id_prueba', 'INNER');//PRUEBA - GRUPO INSTRUMENTO
				$this->db->join('sitio_sesion X', 'X.fk_id_sesion = S.id_sesion', 'INNER');//SITIO - SESION
				$this->db->join('sitios Y', 'Y.id_sitio = X.fk_id_sitio', 'INNER');//SITIO
				$this->db->join('param_divipola D', 'D.mpio_divipola = Y.fk_mpio_divipola', 'INNER');//divipola
				
				$this->db->join('usuario U', 'U.id_usuario = Y.fk_id_user_delegado', 'LEFT');
				$this->db->join('usuario K', 'K.id_usuario = Y.fk_id_user_operador', 'LEFT');

				$this->db->where('A.estado_alerta', 1); //ALERTA ACTIVA
				$this->db->where('A.fecha_inicio <=', $fecha); //FECHA INICIAL MENOR O IGUAL A LA ACTUAL
				$this->db->where('A.fecha_fin >=', $fecha); //FECHA FINAL MAYOR O IGUAL A LA ACTUAL
				
				$tipoMensaje = array(2, 3);//filtrar por alertas que se muestren en el APP
				$this->db->where_in('A.tipo_mensaje', $tipoMensaje);	
				
				$this->db->order_by('A.id_alerta', 'desc');
				$query = $this->db->get('alertas A');

				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}
		

		

		
		
		
		
	}