<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Clase para consultas generales a una tabla
 */
class General_model extends CI_Model {

    /**
     * Consulta BASICA A UNA TABLA
     * @param $TABLA: nombre de la tabla
     * @param $ORDEN: orden por el que se quiere organizar los datos
     * @param $COLUMNA: nombre de la columna en la tabla para realizar un filtro (NO ES OBLIGATORIO)
     * @param $VALOR: valor de la columna para realizar un filtro (NO ES OBLIGATORIO)
     * @since 8/11/2016
     */
    public function get_basic_search($arrData) {
        if ($arrData["id"] != 'x')
            $this->db->where($arrData["column"], $arrData["id"]);
        $this->db->order_by($arrData["order"], "ASC");
        $query = $this->db->get($arrData["table"]);

        if ($query->num_rows() >= 1) {
            return $query->result_array();
        } else
            return false;
    }
	
		/**
		 * Lista de departamentos
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
		 * Alertas ACTIVAS por sesiones
		 * @since 22/5/2016
		 */
		public function get_alertas_by($arrDatos)
		{
				$sesiones = array();
				$this->db->select();
				if (array_key_exists("idSesion", $arrDatos)) {
					$this->db->where('fk_id_sesion', $arrDatos["idSesion"]);
				}
				$this->db->where('estado_alerta', 1);
				$this->db->order_by('descripcion_alerta', 'asc');
				$query = $this->db->get('alertas');
					
				if ($query->num_rows() > 0) {
					$i = 0;
					foreach ($query->result() as $row) {
						$sesiones[$i]["idAlerta"] = $row->id_alerta;
						$sesiones[$i]["descripcion"] = $row->descripcion_alerta . " ----> Inicio: " . $row->fecha_inicio;
						$i++;
					}
				}
				$this->db->close();
				return $sesiones;
		}
		
		/**
		 * Lista de delegados que no tienen sitio asignado
		 * @since  21/5/2017
		 */
		public function lista_delegado()
		{	
				$sql = "SELECT U.*";
				$sql.= " FROM usuario U";
				$sql.= " WHERE U.id_usuario NOT IN ( SELECT fk_id_user_delegado FROM sitios S WHERE fk_id_user_delegado IS NOT NULL)";
				$sql.= " AND U.fk_id_rol = 4";
				$sql.= " AND U.estado = 1";
				
				$query = $this->db->query($sql);
				
				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}
		
		/**
		 * Lista de coordinadores que no tienen sitio asignado
		 * @since  21/5/2017
		 */
		public function lista_coordinador()
		{	
				$sql = "SELECT U.*";
				$sql.= " FROM usuario U";
				$sql.= " WHERE U.fk_id_rol = 3";
				$sql.= " AND U.estado = 1";
				
				$query = $this->db->query($sql);
				
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
		public function get_sitios($arrDatos) 
		{
				$this->db->select('S.*, O.nombre_organizacion, R.nombre_region, D.*, Z.nombre_zona, 
				U.numero_documento as cedula_delegado, U.nombres_usuario nom_delegado, U.apellidos_usuario ape_delegado, U.celular celular_delegado,
				Y.numero_documento as cedula_coordinador, Y.nombres_usuario nom_coordinador, Y.apellidos_usuario ape_coordiandor, Y.celular celular_coordinador');
				$this->db->join('param_organizaciones O', 'O.id_organizacion = S.fk_id_organizacion', 'INNER');
				$this->db->join('param_regiones R', 'R.id_region = S.fk_id_region', 'INNER');
				$this->db->join('param_divipola D', 'D.mpio_divipola = S.fk_mpio_divipola', 'INNER');
				$this->db->join('param_zonas Z', 'Z.id_zona = S.fk_id_zona', 'INNER');
				$this->db->join('usuario U', 'U.id_usuario = S.fk_id_user_delegado', 'LEFT');
				$this->db->join('usuario Y', 'Y.id_usuario = S.fk_id_user_coordinador', 'LEFT');
				
				if (array_key_exists("idSitio", $arrDatos)) {
					$this->db->where('S.id_sitio', $arrDatos["idSitio"]);
				}
				
				if (array_key_exists("idDelegado", $arrDatos)) {
					$this->db->where('S.fk_id_user_delegado', $arrDatos["idDelegado"]);
				}
				
				$this->db->order_by('nombre_region, dpto_divipola_nombre, mpio_divipola_nombre, nombre_zona', 'asc');
				$query = $this->db->get('sitios S');

				if ($query->num_rows() > 0) {
					return $query->result_array();
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
		 * Contar sesiones para los grupos
		 * filtrado por grupo
		 * @since  25/5/2017
		 */
		public function countSesionesbyGrupo($arrDatos)
		{
				$sql = "SELECT count(id_sesion) CONTEO";
				$sql.= " FROM sesiones S";
				
				if (array_key_exists("idGrupoInstrumentos", $arrDatos)) {
					$sql.= " WHERE fk_id_grupo_instrumentos = " . $arrDatos["idGrupoInstrumentos"];
				}

				$query = $this->db->query($sql);
				$row = $query->row();
				return $row->CONTEO;
		}
		
		/**
		 * Obtener alertas vencidas y que se le debe dar respuesta por el delegado
		 * se filtra por alertas para un periodo de 24 horas
		 * @since 24/5/2017
		 */
		public function get_alertas_vencidas_by($arrDatos) 
		{		
				//fecha para uscar las que ya se vencieron
				$fechaActual = date('Y-m-d G:i:s');
				
				$fechaMinima = strtotime ( '-1 day' , strtotime ( $fechaActual ) ) ;
				$fechaMinima = date ( 'Y-m-d G:i:s' , $fechaMinima );//fecha minima para la busqueda
		
				$this->db->select('id_sitio_sesion, id_sitio, id_sesion, id_alerta');

				//SITIO-SESION
				$this->db->join('sitio_sesion X', 'X.fk_id_sitio = Y.id_sitio', 'INNER');
				
				//SESION
				$this->db->join('sesiones S', 'S.id_sesion = X.fk_id_sesion', 'INNER');
				
				//ALERTA
				$this->db->join('alertas A', 'A.fk_id_sesion = S.id_sesion', 'INNER');
				
				$this->db->where('Y.fk_id_user_coordinador', $this->session->id); //FILTRO POR ID DEL COORDINADOR
				$this->db->where('A.estado_alerta', 1); //ALERTAS ACTIVAS
				$this->db->where('A.fk_id_rol', 4); //ALERTAS QUE SON PARA DELEGADO
				
				$tipoMensaje = array(1, 2);//filtrar por alertas que se muestren en el APP
				$this->db->where_in('A.tipo_mensaje', $tipoMensaje);
				
				$this->db->where('A.fecha_fin <=', $fechaActual); //FECHA FINAL SEA MAYOR A LA FECHA ACTUAL
				$this->db->where('A.fecha_fin >', $fechaMinima); //FECHA FINAL SEA MAYOR A LA FECHA ACTUAL
				
				
				if (array_key_exists("tipoAlerta", $arrDatos)) {
					$this->db->where('A.fk_id_tipo_alerta', $arrDatos["tipoAlerta"]); //SITIO-SESION
				}
			
				$query = $this->db->get('sitios Y');

				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}
		
		/**
		 * Revisar si se dio respuesta a la alerta para un sitio especifico y una sesion
		 * @since 12/5/2017
		 */
		public function get_respuestas_alertas_vencidas_by($arrDatos) 
		{
				$this->db->select();

				if (array_key_exists("idSitioSesion", $arrDatos)) {
					$this->db->where('fk_id_sitio_sesion', $arrDatos["idSitioSesion"]); 
				}
				
				if (array_key_exists("idAlerta", $arrDatos)) {
					$this->db->where('fk_id_alerta', $arrDatos["idAlerta"]); 
				}
				
				if (array_key_exists("respuestaAcepta", $arrDatos)) {
					$this->db->where('acepta', $arrDatos["respuestaAcepta"]); //filtro para las NOTIFICACIONES
				}
				
				$query = $this->db->get('registro');

				if ($query->num_rows() > 0) {
					return true;
				} else {
					return false;
				}
		}
		
		/**
		 * Muestra informacion de las alertas que no le han dado respueta filtrado por ID_SITIO_SESION - ID_ALERTA
		 * @since 24/5/2017
		 */
		public function get_informacion_respuestas_alertas_vencidas_by($arrDatos) 
		{				
				$this->db->select('Y.*,A.*, S.*, P.nombre_prueba, G.nombre_grupo_instrumentos, G.fecha,
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
								
				if (array_key_exists("idAlerta", $arrDatos)) {
					$this->db->where('A.id_alerta', $arrDatos["idAlerta"]); //FILTRO POR ALERTA
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
		 * Update field in a table
		 * @since 25/5/2017
		 */
		public function updateRecord($arrDatos) {
				$data = array(
					$arrDatos ["column"] => $arrDatos ["value"]
				);
				$this->db->where($arrDatos ["primaryKey"], $arrDatos ["id"]);
				$query = $this->db->update($arrDatos ["table"], $data);
				if ($query) {
					return true;
				} else {
					return false;
				}
		}
		
		/**
		 * Delete Record
		 * @since 25/5/2017
		 */
		public function deleteRecord($arrDatos) 
		{
				$query = $this->db->delete($arrDatos ["table"], array($arrDatos ["primaryKey"] => $arrDatos ["id"]));
				if ($query) {
					return true;
				} else {
					return false;
				}
		}



}