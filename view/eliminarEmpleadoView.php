<?php
session_start();
require_once("../Controller/empleadoController.php");
require_once("../Controller/rolController.php");
$objetoEmpleado = new empleadoController();
if(isset($_GET['id'])){
	$id = intval($_GET['id']);
	$validateId = $objetoEmpleado->validateId($id);
	if(!is_numeric($_GET['id']) || !$validateId){
		header("location: ListarEmpleado.php");
	}else if(isset($_GET['btnDelete'])){
		$empleado = $objetoEmpleado->eliminarEmpleados($id);
		$objetoRol = new rolController();
		$rol = $objetoRol->eliminarRoles($id);

		if($empleado && $rol){
			$_SESSION['message'] = 'Datos eliminados correctamente';
			$_SESSION['message_type']='success';
			header("location: ListarEmpleadoView.php");

		}else{
			$_SESSION['message'] = 'Error al eliminar datos';
			$_SESSION['message_type']='danger';
			header("location: ListarEmpleadoView.php");
		}
	}
}
?>
<?php require_once("../includes/header.php"); ?>

<form>
<div class="modal" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Eliminar Empleado</h5>
      </div>
      <div class="modal-body">
              <input type="hidden" name="id" id="id" value="<?php $id = intval($_GET['id']);
              echo $id;?>">
        <p>¿Esta seguro de eliminar empleado?</p>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="btnDelete" id="btnDelete">Eliminar</button>
        <a href="ListarEmpleadoView.php" class="btn btn-default" data-dismiss="modal" id="cancelar">Cancelar</a>
      </div>
    </div>
  </div>
</div>
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script type="text/javascript">
    $( document ).ready(function() {
        $("#myModal").show();
    });
</script>
<?php  require_once("../includes/footer.php");?>