<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Anulaciones_model extends CI_Model {

	    		
		/**
		 * Lista de anulaciones
		 * @since 29/5/2017
		 */
		public function get_anulaciones($arrDatos) 
		{
				$this->db->select();
				$this->db->join('sitios X', 'X.id_sitio = A.fk_id_sitio', 'INNER');
				$this->db->join('param_divipola D', 'D.mpio_divipola = X.fk_mpio_divipola', 'INNER');

				$this->db->join('sesiones S', 'S.id_sesion = A.fk_id_sesion', 'INNER');
				$this->db->join('param_grupo_instrumentos G', 'G.id_grupo_instrumentos = S.fk_id_grupo_instrumentos', 'INNER');
				$this->db->join('pruebas P', 'P.id_prueba = G.fk_id_prueba', 'INNER');
				
				$this->db->join('param_motivo_anulacion M', 'M.id_motivo_anulacion = A.fk_id_motivo', 'INNER');
				
				$this->db->join('examinandos E', 'E.id_examinando = A.fk_id_examinando', 'INNER');

				if (array_key_exists("idSitio", $arrDatos)) {
					$this->db->where('A.fk_id_sitio', $arrDatos["idSitio"]);
				}
				
				if (array_key_exists("idAnulacion", $arrDatos)) {
					$this->db->where('A.id_anulacion', $arrDatos["idAnulacion"]);
				}
				
				if (array_key_exists("idCoordinador", $arrDatos)) {
					$this->db->where('X.fk_id_user_coordinador', $arrDatos["idCoordinador"]);
				}

				$query = $this->db->get('anulaciones A');

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
		public function saveAnulacion($idExaminando) 
		{
				$idAnulacion = $this->input->post('hddId');
				$userID = $this->session->userdata("id");
				
				$data = array(
					'fk_id_sitio' => $this->input->post('hddIdSitio'),
					'fk_id_sesion' => $this->input->post('sesion'),
					'fk_id_examinando' => $idExaminando,
					'fk_id_motivo' => $this->input->post('motivo'),
					'observacion' => $this->input->post('observacion'),
					'fecha_anulacion' => date("Y-m-d G:i:s"),
					'fk_id_user_dele' => $userID,
					'aprobada' => 0
				);	

				//revisar si es para adicionar o editar
				if ($idAnulacion == '') {
					$query = $this->db->insert('anulaciones', $data);
					
					$data["fk_id_anulacion"] = $this->db->insert_id();
					$query = $this->db->insert('log_anulaciones', $data);
				} else {
					$this->db->where('id_anulacion', $idAnulacion);
					$query = $this->db->update('anulaciones', $data);
					
					$data["fk_id_anulacion"] = $idAnulacion;
					$query = $this->db->insert('log_anulaciones', $data);
				}
				if ($query) {
					return true;
				} else {
					return false;
				}
		}

		/**
		 * Add/Edit Anulacion
		 * @since 29/5/2017
		 */
		public function saveAnulacionAprobar() 
		{
				$idAnulacion = $this->input->post('hddId');
				$userID = $this->session->userdata("id");
				
				$data = array(
					'aprobada' => $this->input->post('aprobar'),
					'observacion_aprobacion' => $this->input->post('observacion'),
					'fecha_aprobacion' => date("Y-m-d G:i:s"),
					'fk_id_user_coor' => $userID
				);	

				$this->db->where('id_anulacion', $idAnulacion);
				$query = $this->db->update('anulaciones', $data);
				
				//log para la auditoria
				$data["fk_id_anulacion"] = $idAnulacion;
				$query = $this->db->insert('log_anulaciones', $data);

				if ($query) {
					return true;
				} else {
					return false;
				}
		}
		
		/**
		 * Add/Edit Anulacion
		 * @since 14/8/2017
		 */
		public function updateAnulacion($idExaminando) 
		{
				$idAnulacion = $this->input->post('hddId');
				
				$data = array(
					'fk_id_sitio' => $this->input->post('hddIdSitio'),
					'fk_id_sesion' => $this->input->post('sesion'),
					'fk_id_examinando' => $idExaminando,
					'fk_id_motivo' => $this->input->post('motivo'),
					'observacion' => $this->input->post('observacion')
				);	

				$this->db->where('id_anulacion', $idAnulacion);
				$query = $this->db->update('anulaciones', $data);
				
				//log para la auditoria
				$data["fk_id_anulacion"] = $idAnulacion;
				$query = $this->db->insert('log_anulaciones', $data);

				if ($query) {
					return true;
				} else {
					return false;
				}
		}

		
		
		
	    
	}