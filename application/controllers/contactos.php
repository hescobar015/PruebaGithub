<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contactos extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Contactos_modelo');
	}
	
	public function index()
	{
		$datos['contactos'] = $this->Contactos_modelo->buscar();
		$datos['pagina'] = 'contactos_gestor';
		
		$this->load->view('plantilla', $datos);
	}
	
	public function agregar()
	{
		$datos['pagina'] = 'contactos_agregar';
		
		$this->load->view('plantilla', $datos);
	}
	
	public function agregar_registro()
	{
		$datos['nombre']             = $this->input->post('nombre');
		$datos['apellidos']          = $this->input->post('apellidos');
		$datos['fecha_nacimiento']   = $this->input->post('fecha_nacimiento');
		$datos['correo_electronico'] = $this->input->post('correo_electronico');
		
		try
		{
			if(!$this->Contactos_modelo->agregar($datos)) throw new Exception('Ocurrió un error al guardar la información');
			
			redirect('/contactos/agregar/exito');
		
		}catch(Exception $e){
			redirect('/contactos/agregar/error');
		}
	}
	
	public function editar($id = null)
	{
		try
		{
			if(!$id) throw new Exception('');
			$datos['contacto'] = $this->Contactos_modelo->obtener_registro($id);
			if(!$datos['contacto']) throw new Exception('');
		}catch(Exception $e){
			redirect('/contactos');
		}
		
		$datos['pagina'] = 'contactos_editar';
		
		$this->load->view('plantilla', $datos);
	}
	
	public function editar_registro()
	{
		$id                  = $this->input->post('id_contacto');
		
		$datos['nombre']             = $this->input->post('nombre');
		$datos['apellidos']          = $this->input->post('apellidos');
		$datos['fecha_nacimiento']   = $this->input->post('fecha_nacimiento');
		$datos['correo_electronico'] = $this->input->post('correo_electronico');
		
		try
		{
			if(!$this->Contactos_modelo->editar($id, $datos)) throw new Exception('Ocurrió un error al guardar la información');
			
			redirect('/contactos/editar/' . $id . '/exito');
		
		}catch(Exception $e){
			redirect('/contactos/editar/' . $id . '/error');
		}
	}
	
	public function eliminar($id = null)
	{
		if(!$id) redirect('/contactos');
		if($this->Contactos_modelo->eliminar($id))
			redirect('/contactos/index/eliminado');
		redirect('/contactos/index/no_eliminado');
	}
}