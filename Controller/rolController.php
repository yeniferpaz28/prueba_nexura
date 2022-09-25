<?php
require_once("../model/rolModel.php");

class rolController{
	public $id;
	public $nombre;
	public $id_empleado;
	public $id_rol;

	// presentar usuario
	public function presentarRoles(){
		$objetoControlador = new rolModel();
		$roles = $objetoControlador->presentarRol();

		return $roles;
	}
	
	// guardar rol
	public function guardarRoles($id_rol,$id_empleado){
		$objetoControlador = new rolModel();
		$this->id_rol = $id_rol;
		$this->id_empleado = $id_empleado;

		$roles = $objetoControlador->guardarRol($this);

		return $roles;
	}
	
	public function actualizarRoles($id_rol,$id_empleado){
		$objetoControlador = new rolModel();
		$this->id_rol = $id_rol;
		$this->id_empleado = $id_empleado;

		$roles = $objetoControlador->actualizarRol($this);

		return $roles;
	}
	
	// eliminar rol
	public function eliminarRoles($id_empleado){
		$objetoControlador = new rolModel();
		
		$roles = $objetoControlador->eliminarRol($id_empleado);

		return $roles;

	}

	public function presentarRolesActualizar($id_empleado,$id_rol){
		$objetoControlador = new rolModel();

		$roles = $objetoControlador->presentarRolActualizar($id_empleado,$id_rol);

		return $roles;
	}

	public function presentarDetallesRoles($id){
		$objetoControlador = new rolModel();
		$roles = $objetoControlador->presentarDetallesRol($id);

		return $roles;
	}
}
?>