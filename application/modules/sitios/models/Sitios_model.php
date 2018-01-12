<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Sitios_model extends CI_Model {

	
		/**
		 * Add/Edit BLOQUES
		 * @since 14/12/2017
		 */
		public function saveBloques() 
		{
				$idBloque = $this->input->post('hddIdBloque');
				
				$data = array(
					'fk_id_sitio' => $this->input->post('hddIdSitio'),
					'nombre_bloque' => $this->input->post('bloque'),
					'estado_bloque' => $this->input->post('estado'),
					'observacion_bloque' => $this->input->post('observacion')
				);
				
				//revisar si es para adicionar o editar
				if ($idBloque == '') {
					$query = $this->db->insert('sitios_bloques', $data);			
				} else {
					$this->db->where('id_sitio_bloque', $idBloque);
					$query = $this->db->update('sitios_bloques', $data);
				}
				if ($query) {
					return true;
				} else {
					return false;
				}
		}
		
		/**
		 * Add/Edit SALONES
		 * @since 15/12/2017
		 */
		public function saveSalones() 
		{
				$idSalon = $this->input->post('hddIdSalon');
				
				$data = array(
					'fk_id_sitio_bloque' => $this->input->post('bloque'),
					'nombre_salon' => $this->input->post('salon'),
					'capacidad_salon' => $this->input->post('capacidad'),
					'discapacitados' => $this->input->post('discapacitados'),
					'estado_salon' => $this->input->post('estado'),
					'numero_piso' => $this->input->post('piso'),
					'observacion_salon' => $this->input->post('observacion'),
					'tipo_salon' => $this->input->post('tipo_salon')					
				);
				
				//revisar si es para adicionar o editar
				if ($idSalon == '') {
					$query = $this->db->insert('sitios_salones', $data);
				} else {
					$this->db->where('id_sitio_salon', $idSalon);
					$query = $this->db->update('sitios_salones', $data);
				}
				if ($query) {
					return true;
				} else {
					return false;
				}
		}
		
		/**
		 * updateAddressSitio
		 * @since 11/1/2018
		 */
		public function updateAddressSitio() 
		{
				$idSitio = $this->input->post('hddId');
							
				if($this->input->post('latitud') != 0){				
					$data['latitud'] = $this->input->post('latitud');
					$data['longitud'] = $this->input->post('longitud');
					$data['address'] = $this->input->post('address');
					
					$this->db->where('id_sitio', $idSitio);
					$query = $this->db->update('sitios', $data);
				}

				if ($query) {
					return true;
				} else {
					return false;
				}
		}
		
		/**
		 * Get fotos info
		 * @since 11/1/2018
		 */
		public function get_fotos($idSitio) 
		{		
				$this->db->select();
				$this->db->where('fk_id_sitio', $idSitio); 
				$this->db->order_by('id_sitio_foto', 'asc');
				$query = $this->db->get('sitios_fotos');

				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}
		
		/**
		 * Add fotos
		 * @since 11/1/2018
		 */
		public function add_fotos($path) 
		{							
				$idUser = $this->session->userdata("id");
		
				$data = array(
					'fk_id_sitio' => $this->input->post('hddIdSitio'),
					'fk_id_usuario' => $idUser,
					'descripcion_foto' => $this->input->post('description'),
					'foto_sitio' => $path,
					'fecha_foto' => date("Y-m-d G:i:s")
				);			

				$query = $this->db->insert('sitios_fotos', $data);

				if ($query) {
					return true;
				} else {
					return false;
				}
		}
		
		/**
		 * Actualizar datos de los salones
		 * @since 12/1/2018
		 */
		public function updateInfoSalon() 
		{
				$idSalon = $this->input->post('hddIdSalon');
		
				$data = array(
					'aire_acondicionado' => $this->input->post('aire_acondicionado'),
					'ventilacion_natural' => $this->input->post('ventilacion_natural'),
					'iluminacion' => $this->input->post('iluminacion'),
					'separador_piso_techo' => $this->input->post('separador_piso_techo'),
					'puerta' => $this->input->post('puerta'),
					'forma_mobiliario' => $this->input->post('forma_mobiliario'),
					'tamaño' => $this->input->post('tamaño'),
					'tipo_piso' => $this->input->post('tipo_piso')					
				);

				$this->db->where('id_sitio_salon', $idSalon);
				$query = $this->db->update('sitios_salones', $data);

				if ($query) {
					return true;
				} else {
					return false;
				}
		}

		
	    
	}