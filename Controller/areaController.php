<?php
require_once("../model/areaModel.php");

class areaController{
	// propiedades
	public $id;
	public $nombre;
	// presentar area
	public function ListarAreas(){
		$nuevaArea = new areaModel();
		$areas = $nuevaArea->ListarArea();

		return $areas;


	}
}

?>