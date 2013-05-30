<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contactos_modelo extends CI_Model
{
	public function buscar()
	{
		$resultado = $this->db->get('contactos');
		return $resultado->result_array();
	}
	
	public function agregar($datos)
	{
		$this->db->insert('contactos', $datos);
		// if($this->db->affected_rows() == 1)
			// return $this->db->insert_id();
		// else
			// return false;
		return ( $this->db->affected_rows() == 1 ) ? $this->db->insert_id() : false;
	}
	
	public function obtener_registro($id)
	{
		$resultado = $this->db->get_where('contactos', array('id_contacto' => $id), 1);
		return $resultado->row_array();
	}
	
	public function editar($id, $datos)
	{
		$this->db->where('id_contacto', $id);
		$this->db->update('contactos', $datos);
		
		return ( $this->db->affected_rows() == 1 ) ? true : false;
	}
	
	public function eliminar($id)
	{
		$this->db->delete('contactos', array('id_contacto' => $id));
		return ( $this->db->affected_rows() == 1 ) ? true : false;
	}
}