<?php
require_once("../conection.php");

class areaModel{
	// presentarAREAS
	public function ListarArea(){
		$objetoConexion = new conection();
		$objetoConexion->conectarDB();

		$sql = "SELECT * FROM areas";

		$resultado = mysqli_query($objetoConexion->con,$sql);

		return $resultado;

	}
}

?>