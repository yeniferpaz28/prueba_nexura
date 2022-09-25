<?php
include_once("../Controller/rolController.php");

	if(isset($_POST['arrayCheck']) && isset($_POST['valorId'])){
     	
     	$id_empleado = ($_POST['valorId']);
     
     	$objetoRol = new rolController();  

    	if (!empty($_POST['arrayCheck'])){
    		foreach ($_POST['arrayCheck'] as $id_rol) {

    		$rol = $objetoRol->actualizarRoles($id_rol,$id_empleado);

   			}
   		}
    }
    if($rol){
       	echo "datos eliminados";
    }else{
    echo "error al eliminar";
    }     
?>

           