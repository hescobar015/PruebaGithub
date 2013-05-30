<?php

class Login_modelo extends CI_Model
{
	public function validar_usuario($usuario, $contrasena)
	{
		$consulta = "SELECT * 
					FROM usuarios
					WHERE usuario = '" . $this->db->escape_str($usuario) . "' AND contrasena = '" . $contrasena . "' ";
		$resultado = $this->db->query($consulta);
		return $resultado->row_array();
	}
}