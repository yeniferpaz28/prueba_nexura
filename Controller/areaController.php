<?php
require_once("../model/areaModel.php");

class areaController{
	// propiedades
	public $id;
	public $nombre;
	// presentar area
	public function listarAreas(){
		$nuevaArea = new areaModel();
		$areas = $nuevaArea->listarArea();
		return $areas;
	}
}

?>