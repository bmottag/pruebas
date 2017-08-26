<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Novedades_model extends CI_Model {

	    		
		/**
		 * Lista de cuadernillos
		 * @since 30/5/2017
		 */
		public function get_cambio_cuadernillo($arrDatos) 
		{
				$this->db->select('X.id_sitio, X.nombre_sitio, X.codigo_dane, D.*,S.*, P.nombre_prueba, G.*, E.snp snp_examinando, E.consecutivo consecutivo_examinando, H.snp snp_cuadernillo, H.consecutivo consecutivo_cuadernillo, M.nombre_motivo_novedad, A.*');
				$this->db->join('sitios X', 'X.id_sitio = A.fk_id_sitio', 'INNER');
				$this->db->join('param_divipola D', 'D.mpio_divipola = X.fk_mpio_divipola', 'INNER');

				$this->db->join('sesiones S', 'S.id_sesion = A.fk_id_sesion', 'INNER');
				$this->db->join('param_grupo_instrumentos G', 'G.id_grupo_instrumentos = S.fk_id_grupo_instrumentos', 'INNER');
				$this->db->join('pruebas P', 'P.id_prueba = G.fk_id_prueba', 'INNER');
				
				$this->db->join('param_motivo_novedad M', 'M.id_motivo_novedad = A.fk_id_motivo_novedad', 'INNER');
				
				$this->db->join('examinandos E', 'E.id_examinando = A.fk_id_examinando', 'INNER');
				$this->db->join('examinandos H', 'H.id_examinando = A.fk_id_cuadernillo', 'INNER');

				if (array_key_exists("idSitio", $arrDatos)) {
					$this->db->where('A.fk_id_sitio', $arrDatos["idSitio"]);
				}
				
				if (array_key_exists("idCambioCuadernillo", $arrDatos)) {
					$this->db->where('A.id_cambio_cuadernillo', $arrDatos["idCambioCuadernillo"]);
				}
				
				if (array_key_exists("idCoordinador", $arrDatos)) {
					$this->db->where('X.fk_id_user_coordinador', $arrDatos["idCoordinador"]);
				}

				$query = $this->db->get('novedades_cambio_cuadernillo A');

				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}
		
		/**
		 * Add/Edit Cambio cuadrnillo
		 * @since 29/5/2017
		 */
		public function saveCambioCuadernillo($idExaminando) 
		{
				$idCambioCuadernillo = $this->input->post('hddId');
				$userID = $this->session->userdata("id");
				$busqueda_1 = $this->input->post("busqueda_1");
				$busqueda_2 = $this->input->post("busqueda_2");
				$cuadernillo = $busqueda_1==""?$busqueda_2:$busqueda_1;
				$busqueda = $busqueda_1==""?2:1;
				
				$data = array(
					'fk_id_sitio' => $this->input->post('hddIdSitio'),
					'fk_id_sesion' => $this->input->post('sesion'),
					'fk_id_examinando' => $idExaminando,
					'fk_id_motivo_novedad' => $this->input->post('motivo'),
					'fk_id_cuadernillo' => $cuadernillo,
					'observacion' => $this->input->post('observacion'),
					'fecha_cambio' => date("Y-m-d G:i:s"),
					'fk_id_user_dele' => $userID,
					'aprobada' => 0,
					'busqueda' => $busqueda
				);	

				//revisar si es para adicionar o editar
				if ($idCambioCuadernillo == '') {
					$query = $this->db->insert('novedades_cambio_cuadernillo', $data);
					
					//log auditoria
					$data["fk_id_cambio_cuadernillo"] = $this->db->insert_id();
					$query = $this->db->insert('log_novedades_cambio_cuadernillo', $data);
				} else {
					$this->db->where('id_cambio_cuadernillo', $idCambioCuadernillo);
					$query = $this->db->update('novedades_cambio_cuadernillo', $data);
					
					//log auditoria
					$data["fk_id_cambio_cuadernillo"] = $idCambioCuadernillo;
					$query = $this->db->insert('log_novedades_cambio_cuadernillo', $data);
				}
				if ($query) {
					return true;
				} else {
					return false;
				}
		}

		/**
		 * aprobacion cambio de cuadernillo
		 * @since 1/6/2017
		 */
		public function saveCambioCuadernilloAprobar() 
		{
				$idCambioCuadernillo = $this->input->post('hddId');
				$userID = $this->session->userdata("id");
				
				$data = array(
					'aprobada' => $this->input->post('aprobar'),
					'observacion_aprobacion' => $this->input->post('observacion'),
					'fecha_aprobacion' => date("Y-m-d G:i:s"),
					'fk_id_user_coor' => $userID
				);	

				$this->db->where('id_cambio_cuadernillo', $idCambioCuadernillo);
				$query = $this->db->update('novedades_cambio_cuadernillo', $data);
				
				//log auditoria
				$data["fk_id_cambio_cuadernillo"] = $idCambioCuadernillo;
				$query = $this->db->insert('log_novedades_cambio_cuadernillo', $data);

				if ($query) {
					return true;
				} else {
					return false;
				}
		}
		
		/**
		 * Lista de holguras
		 * @since 3/6/2017
		 */
		public function get_holguras($arrDatos) 
		{
				$this->db->select('D.*, X.id_sitio, X.nombre_sitio, X.codigo_dane, S.*, P.nombre_prueba, G.*, Z.snp_holgura, Z.consecutivo_holgura, A.*');
				$this->db->join('sitios X', 'X.id_sitio = A.fk_id_sitio', 'INNER');
				$this->db->join('param_divipola D', 'D.mpio_divipola = X.fk_mpio_divipola', 'INNER');

				$this->db->join('sesiones S', 'S.id_sesion = A.fk_id_sesion', 'INNER');
				$this->db->join('param_grupo_instrumentos G', 'G.id_grupo_instrumentos = S.fk_id_grupo_instrumentos', 'INNER');
				$this->db->join('pruebas P', 'P.id_prueba = G.fk_id_prueba', 'INNER');
				
				$this->db->join('snp_holguras Z', 'Z.id_snp_holgura = A.fk_id_snp_holgura', 'INNER');

				if (array_key_exists("idHolgura", $arrDatos)) {
					$this->db->where('A.id_holgura', $arrDatos["idHolgura"]);
				}
				
				if (array_key_exists("idSitio", $arrDatos)) {
					$this->db->where('A.fk_id_sitio', $arrDatos["idSitio"]);
				}
				
				if (array_key_exists("idCoordinador", $arrDatos)) {
					$this->db->where('X.fk_id_user_coordinador', $arrDatos["idCoordinador"]);
				}

				$query = $this->db->get('novedades_holgura A');

				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}
		
		/**
		 * Add/Edit Holgura
		 * @since 4/6/2017
		 */
		public function saveHolgura($idSNPHolgura) 
		{
				$idHolgura = $this->input->post('hddId');
				$userID = $this->session->userdata("id");
				
				$data = array(
					'fk_id_sitio' => $this->input->post('hddIdSitio'),
					'fk_id_sesion' => $this->input->post('sesion'),
					'fk_id_examinando' => $this->input->post('consecutivo'),
					'fk_id_snp_holgura' => $idSNPHolgura,
					'observacion' => $this->input->post('observacion'),
					'fecha_holgura' => date("Y-m-d G:i:s"),
					'fk_id_user_dele' => $userID,
					'aprobada' => 0
				);	

				//revisar si es para adicionar o editar
				if ($idHolgura == '') {
					$query = $this->db->insert('novedades_holgura', $data);
					
					//log auditoria
					$data["fk_id_holgura"] = $this->db->insert_id();
					$query = $this->db->insert('log_novedades_holgura', $data);
				} else {
					$this->db->where('id_holgura', $idHolgura);
					$query = $this->db->update('novedades_holgura', $data);
					
					//log auditoria
					$data["fk_id_holgura"] = $idHolgura;
					$query = $this->db->insert('log_novedades_holgura', $data);
				}
				if ($query) {
					return true;
				} else {
					return false;
				}
		}
		
		/**
		 * aprobacion holgura
		 * @since 4/6/2017
		 */
		public function saveHolguraAprobar() 
		{
				$idHolgura = $this->input->post('hddId');
				$userID = $this->session->userdata("id");
				
				$data = array(
					'aprobada' => $this->input->post('aprobar'),
					'observacion_aprobacion' => $this->input->post('observacion'),
					'fecha_aprobacion' => date("Y-m-d G:i:s"),
					'fk_id_user_coor' => $userID
				);	

				$this->db->where('id_holgura', $idHolgura);
				$query = $this->db->update('novedades_holgura', $data);
				
				//log auditoria
				$data["fk_id_holgura"] = $idHolgura;
				$query = $this->db->insert('log_novedades_holgura', $data);

				if ($query) {
					return true;
				} else {
					return false;
				}
		}
		
		/**
		 * Lista de otras novedades
		 * @since 7/8/2017
		 */
		public function get_otras($arrDatos) 
		{
				$this->db->select('D.*, X.id_sitio, X.nombre_sitio, X.codigo_dane, S.*, P.nombre_prueba, G.*, A.*');
				$this->db->join('sitios X', 'X.id_sitio = A.fk_id_sitio', 'INNER');
				$this->db->join('param_divipola D', 'D.mpio_divipola = X.fk_mpio_divipola', 'INNER');

				$this->db->join('sesiones S', 'S.id_sesion = A.fk_id_sesion', 'INNER');
				$this->db->join('param_grupo_instrumentos G', 'G.id_grupo_instrumentos = S.fk_id_grupo_instrumentos', 'INNER');
				$this->db->join('pruebas P', 'P.id_prueba = G.fk_id_prueba', 'INNER');

				if (array_key_exists("idOtra", $arrDatos)) {
					$this->db->where('A.id_otra', $arrDatos["idOtra"]);
				}
				
				if (array_key_exists("idSitio", $arrDatos)) {
					$this->db->where('A.fk_id_sitio', $arrDatos["idSitio"]);
				}
				
				if (array_key_exists("idCoordinador", $arrDatos)) {
					$this->db->where('X.fk_id_user_coordinador', $arrDatos["idCoordinador"]);
				}

				$query = $this->db->get('novedades_otra A');

				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}
		
		/**
		 * Add/Edit otra novedad
		 * @since 7/8/2017
		 */
		public function saveOtra() 
		{
				$idOtra = $this->input->post('hddId');
				$userID = $this->session->userdata("id");
				
				$data = array(
					'fk_id_sitio' => $this->input->post('hddIdSitio'),
					'fk_id_sesion' => $this->input->post('sesion'),
					'observacion' => $this->input->post('observacion'),
					'fecha_otra' => date("Y-m-d G:i:s"),
					'fk_id_user_dele' => $userID,
					'aprobada' => 0
				);	

				//revisar si es para adicionar o editar
				if ($idOtra == '') {
					$query = $this->db->insert('novedades_otra', $data);
					
					//log auditoria
					$data["fk_id_log_otra"] = $this->db->insert_id();
					$query = $this->db->insert('log_novedades_otra', $data);
				} else {
					$this->db->where('id_otra', $idOtra);
					$query = $this->db->update('novedades_otra', $data);
					
					//log auditoria
					$data["fk_id_log_otra"] = $idOtra;
					$query = $this->db->insert('log_novedades_otra', $data);
				}
				if ($query) {
					return true;
				} else {
					return false;
				}
		}
		
		/**
		 * Edit Cambio cuadrnillo
		 * @since 14/8/2017
		 */
		public function updateCambioCuadernillo($idExaminando) 
		{
				$idCambioCuadernillo = $this->input->post('hddId');
				$userID = $this->session->userdata("id");
				$busqueda_1 = $this->input->post("busqueda_1");
				$busqueda_2 = $this->input->post("busqueda_2");
				$cuadernillo = $busqueda_1==""?$busqueda_2:$busqueda_1;
				$busqueda = $busqueda_1==""?2:1;
				
				$data = array(
					'fk_id_sitio' => $this->input->post('hddIdSitio'),
					'fk_id_sesion' => $this->input->post('sesion'),
					'fk_id_examinando' => $idExaminando,
					'fk_id_motivo_novedad' => $this->input->post('motivo'),
					'fk_id_cuadernillo' => $cuadernillo,
					'observacion' => $this->input->post('observacion'),
					'busqueda' => $busqueda
				);	


				$this->db->where('id_cambio_cuadernillo', $idCambioCuadernillo);
				$query = $this->db->update('novedades_cambio_cuadernillo', $data);
				
				//log auditoria
				$data["fk_id_cambio_cuadernillo"] = $idCambioCuadernillo;
				$query = $this->db->insert('log_novedades_cambio_cuadernillo', $data);

				if ($query) {
					return true;
				} else {
					return false;
				}
		}
		
		/**
		 * Edit Holgura
		 * @since 14/8/2017
		 */
		public function updateHolgura($idSNPHolgura) 
		{
				$idHolgura = $this->input->post('hddId');
				$userID = $this->session->userdata("id");
				
				$data = array(
					'fk_id_sitio' => $this->input->post('hddIdSitio'),
					'fk_id_sesion' => $this->input->post('sesion'),
					'fk_id_examinando' => $this->input->post('consecutivo'),
					'fk_id_snp_holgura' => $idSNPHolgura,
					'observacion' => $this->input->post('observacion')
				);	

				$this->db->where('id_holgura', $idHolgura);
				$query = $this->db->update('novedades_holgura', $data);
				
				//log auditoria
				$data["fk_id_holgura"] = $idHolgura;
				$query = $this->db->insert('log_novedades_holgura', $data);

				if ($query) {
					return true;
				} else {
					return false;
				}
		}
		
		/**
		 * aprobacion otra novedad
		 * @since 14/8/2017
		 */
		public function saveOtraAprobar() 
		{
				$idOtra = $this->input->post('hddId');
				$userID = $this->session->userdata("id");
				
				$data = array(
					'aprobada' => $this->input->post('aprobar'),
					'observacion_aprobacion' => $this->input->post('observacion'),
					'fecha_aprobacion' => date("Y-m-d G:i:s"),
					'fk_id_user_coor' => $userID
				);	

				$this->db->where('id_otra', $idOtra);
				$query = $this->db->update('novedades_otra', $data);
				
				//log auditoria
				$data["fk_id_log_otra"] = $idOtra;
				$query = $this->db->insert('log_novedades_otra', $data);

				if ($query) {
					return true;
				} else {
					return false;
				}
		}
		
		/**
		 * Edit otra novedad
		 * @since 14/8/2017
		 */
		public function updateOtra() 
		{
				$idOtra = $this->input->post('hddId');
				$userID = $this->session->userdata("id");
				
				$data = array(
					'fk_id_sitio' => $this->input->post('hddIdSitio'),
					'fk_id_sesion' => $this->input->post('sesion'),
					'observacion' => $this->input->post('observacion')
				);	

				$this->db->where('id_otra', $idOtra);
				$query = $this->db->update('novedades_otra', $data);
				
				//log auditoria
				$data["fk_id_log_otra"] = $idOtra;
				$query = $this->db->insert('log_novedades_otra', $data);

				if ($query) {
					return true;
				} else {
					return false;
				}
		}

		
	    
	}