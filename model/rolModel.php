<?php
require_once("../conection.php");

class rolModel{
	// presentar roles
	public function presentarRol(){
		$objetoConexion = new conection();
		$objetoConexion->conectarDB();

		$sql = "SELECT roles.id AS id_rol, roles.nombre AS nombre_rol FROM roles";

		$resultado = mysqli_query($objetoConexion->con,$sql);
		return $resultado;
	}

	// guardar empleado
	public function guardarRol($rol){
		$objetoConexion = new conection();
		$objetoConexion->conectarDB();

		$consulta = "SELECT * FROM empleado_rol WHERE id_empleado = $rol->id_empleado, rol_id =$rol->id_rol";
		if(!empty($consulta))
		$sql = "INSERT INTO empleado_rol(rol_id,empleado_id) VALUES('$rol->id_rol','$rol->id_empleado')"; 

		$rol = mysqli_query($objetoConexion->con,$sql);
		return $rol;

	}
	// actualizarempleado
	// presentarempleado actualizar
	// eliminarempleado
	public function eliminarRol($id_empleado){
		$objetoConexion = new conection();
		$objetoConexion->conectarDB();

		$sql = "DELETE FROM empleado_rol WHERE empleado_id = '$id_empleado'";
		$resultado =mysqli_query($objetoConexion->con,$sql);

		return $resultado;
	}

	public function presentarRolActualizar($id_empleado,$id_rol){
		$objetoConexion = new conection();
		$objetoConexion->conectarDB();

		$sql = "SELECT empleado_id, rol_id FROM empleado_rol WHERE empleado_id = $id_empleado && rol_id = $id_rol";
		
		$roles = mysqli_query($objetoConexion->con,$sql);

		return $roles;

	}

	public function actualizarRol($roles){
		$objetoConexion = new conection();
		$objetoConexion->conectarDB();

		$sql = "DELETE FROM empleado_rol WHERE empleado_id = $roles->id_empleado && rol_id = $roles->id_rol";

		$resultados = mysqli_query($objetoConexion->con,$sql);
		return $resultados;
	}

	public function presentarDetallesRol($id){
		$objetoConexion = new conection();
		$objetoConexion->conectarDB();

		$sql = "SELECT roles.id, roles.nombre,empleado_rol.empleado_id,empleado_rol.rol_id FROM empleado_rol
				INNER JOIN roles
				WHERE roles.id= empleado_rol.rol_id && empleado_rol.empleado_id = $id";
		
		$roles = mysqli_query($objetoConexion->con,$sql);

		return $roles;
	}
}
?>