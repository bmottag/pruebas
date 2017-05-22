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
				$sql.= " WHERE U.id_usuario NOT IN ( SELECT fk_id_user_coordinador FROM sitios S WHERE fk_id_user_coordinador IS NOT NULL)";
				$sql.= " AND U.fk_id_rol = 3";
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
				$this->db->select('S.*, O.nombre_organizacion, R.nombre_region, D.*, Z.nombre_zona, U.numero_documento as delegado, Y.numero_documento as coordinador');
				$this->db->join('param_organizaciones O', 'O.id_organizacion = S.fk_id_organizacion', 'INNER');
				$this->db->join('param_regiones R', 'R.id_region = S.fk_id_region', 'INNER');
				$this->db->join('param_divipola D', 'D.mpio_divipola = S.fk_mpio_divipola', 'INNER');
				$this->db->join('param_zonas Z', 'Z.id_zona = S.fk_id_zona', 'INNER');
				$this->db->join('usuario U', 'U.id_usuario = S.fk_id_user_delegado', 'LEFT');
				$this->db->join('usuario Y', 'Y.id_usuario = S.fk_id_user_coordinador', 'LEFT');
				
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
	
	



}