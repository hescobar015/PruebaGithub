<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Seguridad_modelo extends CI_Model
{
	var $salt = "BSd9a-#$8mxe3dk--fde353sd0a+9d8a0gv0*";
	
	//Genera un nuevo sello para la sesion actual
	public function sellar_sesion($auth)
	{
		$sello = md5($this->salt.$auth['id_usuario']);
		
		return $sello;
	}
	
	//Verifica que el sello de la sesion con la informacion del usuario sea el mismo que el guardado anteriormente en sesion
	public function verificar_sello_sesion()
	{
		$auth = $this->session->userdata("loggedIn");
		
		$sello = md5($this->salt.$auth['id_usuario']);
		
		return ($auth['sello'] == $sello) ? true : false;
	}
	
	//Genera un sello para los vinculos que pasan por URL
	public function generar_sello($valor)
	{
		return md5($this->salt.$valor);
	}
	
	//Valida el sello de la URL para evitar intrusion en el sistema
	public function validar_sello($valor, $sello)
	{
		$sello_actual = md5($this->salt.$valor);
		//http://localhost/nuevaesperanza/index.php/pacientes/editar/355/d1c800a474f71f5b52c649951a876e49
		return ($sello_actual == $sello) ? true : false;
	}
	
	//Genera un nuevo token para un formulario
	public function generar_token()
	{
		$aleatorio = mt_rand(0,99999999999);
		
		$token = md5($this->salt.$aleatorio);
		
		$this->session->set_userdata("token",$token);
		
		return $token;
	}
	
	//Valida que el token del formulario enviado sea el mismo que el generado anteriormente
	public function validar_token($token_formulario)
	{
		$token_servidor = $this->session->userdata("token");
		
		if(strlen($token_servidor) < 30) return false;
		
		return ($token_formulario == $token_servidor) ? true : false;
	}
}

?>