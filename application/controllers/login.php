<?php

class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Login_modelo');
	}
	
	/**
	* Metodo que muestra el formulario de inicio de sesión
	*
	**/
	public function index()
	{
		if($this->session->userdata('loggedIn') != null)
		{
			redirect('/paises');
		}
	
		aasaa$this->load->view('login');
	}
	
	/**
	* Método que validará los datos del usuario y permitirá o negará el acceso al sistema
	*
	**/
	public function validar_datos()
	{
		//Traer la información del formulario
		$usuario    = $this->input->post('usuario');
		$contrasena = $this->input->post('contrasena');
		
		//Buscamos al usuario en la base de datos
		$resultado = $this->Login_modelo->validar_usuario($usuario, md5($contrasena));
		
		//Validar el resultado obtenido
		if($resultado)
		{
			//Armamos nuestro arreglo de información
			$sesion['id_usuario'] = $resultado['id_usuario'];
			$sesion['usuario']    = $resultado['usuario'];
			$sesion['contrasena'] = $resultado['contrasena'];
			$sesion['sello']      = $this->Seguridad_modelo->sellar_sesion($sesion);
			
			//Guardamos datos en variables de sesión
			$this->session->set_userdata('loggedIn', $sesion);
			//Brindar acceso al usuario
			redirect('/paises');
		}
		
		//Redirigimos al login por acceso no autorizado
		$this->session->set_flashdata('mensajeError', 'Los datos son incorrectos');
		redirect('/login');
	}
	
	/**
	* Borramos la variable de sesión del usuario y mandamos al formulario de login
	*
	**/
	public function logout()
	{
		$this->session->unset_userdata('loggedIn');
		redirect('/login');
	}
}