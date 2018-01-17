<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class More_model extends CI_Model {

	    
		/**
		 * Add/Edit REGION
		 * @since 16/1/2018
		 */
		public function saveRegion() 
		{
				$idRegion = $this->input->post('hddId');
				
				$data = array(
					'nombre_region' => $this->input->post('nombreRegion')
				);
				
				//revisar si es para adicionar o editar
				if ($idRegion == '') {
					$data['fecha_creacion'] = date("Y-m-d G:i:s");
					$data['fecha_actualizacion'] = date("Y-m-d G:i:s");
					$query = $this->db->insert('param_regiones', $data);
					$idRegion = $this->db->insert_id();				
				} else {
					$data['fecha_actualizacion'] = date("Y-m-d G:i:s");
					$this->db->where('id_region', $idRegion);
					$query = $this->db->update('param_regiones', $data);
				}
				if ($query) {
					return $idRegion;
				} else {
					return false;
				}
		}
		
		/**
		 * Add/Edit ZONA
		 * @since 17/1/2018
		 */
		public function saveZona() 
		{
				$idZona = $this->input->post('hddId');
				
				$data = array(
					'nombre_zona' => $this->input->post('nombreZona')
				);
				
				//revisar si es para adicionar o editar
				if ($idZona == '') {
					$data['fecha_creacion'] = date("Y-m-d G:i:s");
					$data['fecha_actualizacion'] = date("Y-m-d G:i:s");
					$query = $this->db->insert('param_zonas', $data);
					$idZona = $this->db->insert_id();				
				} else {
					$data['fecha_actualizacion'] = date("Y-m-d G:i:s");
					$this->db->where('id_zona', $idZona);
					$query = $this->db->update('param_zonas', $data);
				}
				if ($query) {
					return $idZona;
				} else {
					return false;
				}
		}
		
		
	    
	}