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
	
	



}