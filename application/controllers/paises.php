<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paises extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		//Paso 1: Validar los datos de la sesión
		if($this->session->userdata('loggedIn') == null)
		{
			redirect('/login');
		}
		
		//Paso 2: Si hay sesión entonces validamos el sello
		if(!$this->Seguridad_modelo->verificar_sello_sesion())
		{
			redirect('/login/logout');
		}
		
		$this->load->model('Paises_modelo');
	}
	
	public function index()
	{
		$datos['paises'] = $this->Paises_modelo->buscar();
		$datos['pagina'] = 'paises_gestor';
		
		$this->load->view('plantilla', $datos);
	}
	
	public function exportar_excel()
	{
		//MIME TYPE excel 2003
		header('Content-type: application/vnd.ms-excel; charset=utf-8');
		header('Content-Disposition: attachment; filename="paises.xls"');
		
		$datos['paises'] = $this->Paises_modelo->buscar();
		
		$html = $this->load->view('paises_excel', $datos, true);
		
		echo utf8_decode($html);
	}
	
	public function exportar_pdf()
	{
		$datos['paises'] = $this->Paises_modelo->buscar();
		
		$this->load->view('paises_pdf', $datos);
	}
	
	public function agregar()
	{
		$datos['pagina'] = 'paises_agregar';
		
		$this->Seguridad_modelo->generar_token();
		
		$this->load->view('plantilla', $datos);
	}
	
	public function agregar_registro()
	{
		$token = $this->input->post('token');
		if(!$this->Seguridad_modelo->validar_token($token))
		{
			$this->session->set_flashdata('mensajeError', 'No puede enviar un formulario 2 veces');
			redirect('/paises/agregar');
		}
		$this->Seguridad_modelo->generar_token();
	
		$datos['nombre']     = $this->input->post('nombre');
		$datos['poblacion']  = $this->input->post('poblacion');
		$datos['capital']    = $this->input->post('capital');
		$datos['continente'] = $this->input->post('continente');
		
		try
		{
			// if(!$this->form_validation->run() == false) throw new Exception('Los datos enviados son incorrectos');
		
			if(!$this->Paises_modelo->agregar($datos)) throw new Exception('Ocurrió un error al guardar la información');
			
			$this->session->set_flashdata('mensajeExito', 'Los datos se guardaron correctamente');
			redirect('/paises/agregar');
		
		}catch(Exception $e){
			$this->session->set_flashdata('mensajeError', $e->getMessage());
			redirect('/paises/agregar');
		}
	}
	
	public function editar($id = null, $sello = null)
	{
		try
		{
			if(!$id || !$sello) throw new Exception('La petición es incorrecta');
			if(!$this->Seguridad_modelo->validar_sello($id, $sello)) throw new Exception('Intento de intrusión');
			$datos['pais'] = $this->Paises_modelo->obtener_registro($id);
			if(!$datos['pais']) throw new Exception('');
		}catch(Exception $e){
			$this->session->set_flashdata('mensajeError', $e->getMessage());
			redirect('/paises');
		}
		
		$datos['pagina'] = 'paises_editar';
		
		$this->load->view('plantilla', $datos);
	}
	
	public function editar_registro()
	{
		$id                  = $this->input->post('id_pais');
		
		$datos['nombre']     = $this->input->post('nombre');
		$datos['poblacion']  = $this->input->post('poblacion');
		$datos['capital']    = $this->input->post('capital');
		$datos['continente'] = $this->input->post('continente');
		
		try
		{
			if(!$this->Paises_modelo->editar($id, $datos)) throw new Exception('Ocurrió un error al guardar la información');
			
			redirect('/paises/editar/' . $id . '/exito');
		
		}catch(Exception $e){
			redirect('/paises/editar/' . $id . '/error');
		}
	}
	
	public function eliminar($id = null, $sello = null)
	{
		if(!$id || !$sello) redirect('/paises');
		if(!$this->Seguridad_modelo->validar_sello($id, $sello)) redirect('/paises');
		if($this->Paises_modelo->eliminar($id))
			redirect('/paises/index/eliminado');
		redirect('/paises/index/no_eliminado');
	}
}