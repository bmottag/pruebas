<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Novedades_model extends CI_Model {

	    		
		/**
		 * Lista de cuadernillos
		 * @since 30/5/2017
		 */
		public function get_cambio_cuadernillo($arrDatos) 
		{
				$this->db->select();
				$this->db->join('sitios X', 'X.id_sitio = A.fk_id_sitio', 'INNER');

				$this->db->join('sesiones S', 'S.id_sesion = A.fk_id_sesion', 'INNER');
				$this->db->join('param_grupo_instrumentos G', 'G.id_grupo_instrumentos = S.fk_id_grupo_instrumentos', 'INNER');
				$this->db->join('pruebas P', 'P.id_prueba = G.fk_id_prueba', 'INNER');
				
				$this->db->join('param_motivo_novedad M', 'M.id_motivo_novedad = A.fk_id_motivo_novedad', 'INNER');
				
				$this->db->join('examinandos E', 'E.id_examinando = A.fk_id_examinando', 'INNER');

				if (array_key_exists("idSitio", $arrDatos)) {
					$this->db->where('A.fk_id_sitio', $arrDatos["idSitio"]);
				}
				
				if (array_key_exists("idCambioCuadernillo", $arrDatos)) {
					$this->db->where('A.id_cambio_cuadernillo', $arrDatos["idCambioCuadernillo"]);
				}

				$query = $this->db->get('novedades_cambio_cuadernillo A');

				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}
		
		/**
		 * Add/Edit Anulacion
		 * @since 29/5/2017
		 */
		public function saveCambioCuadernillo($idExaminando) 
		{
				$idCambioCuadernillo = $this->input->post('hddId');
				$userID = $this->session->userdata("id");
				
				$data = array(
					'fk_id_sitio' => $this->input->post('hddIdSitio'),
					'fk_id_sesion' => $this->input->post('sesion'),
					'fk_id_examinando' => $idExaminando,
					'fk_id_motivo_novedad' => $this->input->post('motivo'),
					'fk_id_cuadernillo' => $this->input->post('busqueda_1'),
					'observacion' => $this->input->post('observacion'),
					'fecha_cambio' => date("Y-m-d G:i:s"),
					'fk_id_user_dele' => $userID,
					'aprobada' => 2
				);	

				//revisar si es para adicionar o editar
				if ($idCambioCuadernillo == '') {
					$query = $this->db->insert('novedades_cambio_cuadernillo', $data);
				} else {
					$this->db->where('id_cambio_cuadernillo', $idCambioCuadernillo);
					$query = $this->db->update('novedades_cambio_cuadernillo', $data);
				}
				if ($query) {
					return true;
				} else {
					return false;
				}
		}

		
		
	    
	}