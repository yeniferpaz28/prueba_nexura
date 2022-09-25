<?php
session_start();
require_once("../Controller/empleadoController.php");

// mensaje
  if(isset($_SESSION['message'])){
// despues de la parte del alert, la sesion hace que se traiga el dato de cual era el tipo de color que se queria
    ?>
    <div class="alert alert-<?=$_SESSION['message_type']?> alert-dismissible fade show" role="alert">
      <!-- para pintar el mensaje se hace lo siguiente -->
      <?= $_SESSION['message']?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php
// <!-- aqui limpiara los datos que esten en sesion, para que no se quede el mensaje en el index, todo el tiempo -->
  session_unset();

}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie-edge">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
<div class="container-fluid">
	<div class="form-row" id="row1">
		<div class="col-sm-4" id="divTitle">
			<h1>Lista de empleados</h1>
		</div>
		<div class="col-sm-4 offset-sm-5" id="divNuevoUsuario">
      <a href="crearEmpleadoView.php" class="btn btn-primary"><i class="fa fa-user-plus"></i>Crear</a>
    </div>
	</div>
<table class="table table-hover">
  <thead class="table table-primary">
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col">Email</th>
      <th scope="col">Sexo</th>
      <th scope="col">Área</th>
      <th scope="col">Boletín</th>
      <th class='text-center' scope="col">Modificar</th>
      <th class='text-center' scope="col">Eliminar</th>
    </tr>
  </thead>
  <tbody>
	<?php
	$objetoEmpleados = new empleadoController();

    $presentarEmpleado = $objetoEmpleados->ListarEmpleados();
    while($filas = mysqli_fetch_object($presentarEmpleado)){
      $id = $filas->id_empleado;
      $nombre = $filas->nombre;
      $email = $filas->email;
      $sexo = $filas->sexo;
      $boletin = $filas->boletin;
      $descripcion = $filas->descripcion;
      $area_id = $filas->area_id;
      $area_nombre = $filas->area_nombre;
	?>
    <tr>
      <td><?php echo $nombre;?></td>
      <td><?php echo $email;?></td>
      <td><?php echo $sexo;?></td>
      <td><?php echo $area_nombre;?></td>
      <td><?php echo $boletin;?></td>
      <td class='text-center'><a href="actualizarEmpleadoView.php?id=<?php echo $id?>"><i class="fas fa-edit"></i></a></td>
      <td class='text-center'><a href="EliminarEmpleado.php?id=<?php echo $id?>"><i class="fas fa-trash-alt"></i></a></td>
    </tr>
    <?php
		}
    ?>
  </tbody>
</table>
</div>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script type="text/javascript" src="../js/empleado.js"></script>
</body>
</html>