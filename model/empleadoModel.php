<?php
// archivo conexion
require_once("../conection.php");

class empleadoModel extends conection{

	// guardar
	public function GuardarEmpleado($empleado){
		$objetoConexion = new conection();
		$objetoConexion->conectarDB();

		$sql = "INSERT INTO empleado(nombre,email,sexo,area_id,boletin,descripcion) VALUES('$empleado->nombre','$empleado->email','$empleado->sexo','$empleado->area_id','$empleado->boletin','$empleado->descripcion')";

		$resultado = mysqli_query($objetoConexion->con,$sql);
		$ultimoId = mysqli_insert_id($objetoConexion->con);
		// return $resultado;
		return $ultimoId;
	}
	//presentarEmpleados
	public function ListarEmpleado(){
		$objetoConexion = new conection();
		$objetoConexion->conectarDB();

		$sql = "SELECT empleado.id AS id_empleado, empleado.nombre,email,descripcion, ".
				"CASE WHEN sexo = 'F' THEN 'Femenino' " .
				"WHEN sexo = 'M' THEN 'Masculino' END AS sexo, " .
				"areas.id AS area_id, areas.nombre AS area_nombre, " .
				"CASE WHEN  boletin = 1 THEN 'Si' " .
				"WHEN boletin = 0 THEN 'No' END AS boletin " .
				"FROM empleado " .
				"INNER JOIN areas ON areas.id = empleado.area_id ";
		$resultado = mysqli_query($objetoConexion->con,$sql);
		return $resultado;
	}
	// presentar empleado actualizar
	public function PresentarEmpleadoActualizar($id){
		$objetoConexion = new conection();
		$objetoConexion->conectarDB();

		$sql = "SELECT * FROM empleado WHERE id = $id";

		// $sql = "SELECT empleados.id,empleados.nombre,empleados.email,empleados.sexo,empleados.area_id,empleados.boletin,empleados.descripcion,empleado_rol.empleado_id,empleado_rol.rol_id
		// 		FROM empleados 
  //               INNER JOIN empleado_rol
		// 		WHERE empleados.id = empleado_rol.empleado_id && empleados.id = $id ";
		$resultado = mysqli_query($objetoConexion->con,$sql);

		$resultadoObjeto = mysqli_fetch_object($resultado);

		return $resultadoObjeto;
		// return $resultado;

	}
	// actualizar empleado
	public function ActualizarEmpleado($empleado){
		$objetoConexion = new  conection();
		$objetoConexion->conectarDB();

		$sql = "UPDATE empleado SET nombre = '$empleado->nombre',	
									 email = '$empleado->email',
									 sexo = '$empleado->sexo',
									 area_id = '$empleado->area_id',
									 boletin = '$empleado->boletin',
									 descripcion = '$empleado->descripcion'

				 WHERE id = '$empleado->id'";
		$resultado = mysqli_query($objetoConexion->con,$sql);
		return $resultado;

	}
	// eliminar empleado
	public function EliminarEmpleado($id){
		$objetoConexion = new conection();
		$objetoConexion->conectarDB();

		$sql = "DELETE FROM empleado WHERE id = '$id'";
		$resultado =mysqli_query($objetoConexion->con,$sql);

		return $resultado;
	}
	// buscar maximo id
	public function MaximoId(){
		$objetoConexion = new conection();
		$objetoConexion->conectarDB();

		$sql= "SELECT id AS id_empleado FROM empleado WHERE id=( SELECT max(id) FROM empleados )";
		$resultado =mysqli_query($objetoConexion->con,$sql);
		$resultadoMaximo = mysqli_fetch_object($resultado);

		return $resultadoMaximo;
	}
	public function PresentarDetalles($id){
		$objetoConexion = new conection();
		$objetoConexion->conectarDB();

		$sql = "SELECT empleado.id AS id_empleado, empleado.nombre, empleado.email, empleado.sexo, empleado.area_id, empleado.boletin, empleado.descripcion, areas.id AS area_id, areas.nombre AS nombre_area FROM empleados INNER JOIN areas ON areas.id = empleado.area_id WHERE empleado.id = $id";
		$resultado = mysqli_query($objetoConexion->con,$sql);

		$resultadoObjeto = mysqli_fetch_object($resultado);
		return $resultadoObjeto;
	}
}
?>