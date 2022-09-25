<?php 
//clase de conexión a base de datos
class conection{
	public $con;
	public $host = 'localhost';
	public $user = 'root';
	public $pass = '';
	public $bd = 'prueba_tecnica_dev';

	public function conectarDB(){
		$this->con = mysqli_connect($this->host,$this->user,$this->pass,$this->bd);
		if(mysqli_connect_error()){
			die("Error al conectar a base de datos".mysqli_connect_error());
		}
	}
}

?>