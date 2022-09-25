<?php
require_once("../model/empleadoModel.php");

class empleadoController{
	// propiedades
	public $id;
	public $nombre;
	public $email;
	public $sexo;
	public $area_id;
	public $boletin;
	public $descripcion;

	// guardar empleado

	public function guardarEmpleado($_nombre,$_email,$_sexo,$Area_id,$_boletin,$_descripcion){
		$objetoEmpleado = new empleadoModel();
		$this->nombre = $_nombre;
		$this->email = $_email;
		$this->sexo = $_sexo;
		$this->area_id = $Area_id;
		$this->boletin = $_boletin;
		$this->descripcion = $_descripcion;

		$empleados = $objetoEmpleado->guardarEmpleado($this);

		return $empleados;

	}
	// presntar empleado
	public function listarEmpleado(){
		$objetoEmpleado = new empleadoModel();
		$empleado = $objetoEmpleado->listarEmpleado();

		return $empleado;
	}
	// presentar empleado actualizar
	public function presentarEmpleadosActualizar($id){
		$objetoEmpleado = new empleadoModel();
		$empleado = $objetoEmpleado->presentarEmpleadosActualizar($id);

		return $empleado;
	}
	// actualizar empleado
	public function actualizarEmpleados($_id,$_nombre,$_email,$_sexo,$_area_id,$_boletin,$_descripcion){
		$objetoEmpleado = new empleadoModel();

		$this->id = $_id;
		$this->nombre = $_nombre;
		$this->email = $_email;
		$this->sexo = $_sexo;
		$this->area_id = $_area_id;
		$this->boletin = $_boletin;
		$this->descripcion = $_descripcion;

		$empleado = $objetoEmpleado->actualizarEmpleado($this);

		return $empleado;

	}
	// eliminar empleado
	public function eliminarEmpleados($id){
		$objetoEmpleado = new empleadoModel();

		$empleado = $objetoEmpleado->eliminarEmpleado($id);

		return $empleado;
	}
	/**
	 * 
	 * */
	public function validateId($id){
		$objetoEmpleado = new empleadoModel();

		$empleado = $objetoEmpleado->validateId($id);

		return $empleado;
	}
}

?>