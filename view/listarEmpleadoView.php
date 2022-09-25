<?php
session_start();
require_once("../includes/header.php");
require_once("../Controller/empleadoController.php");

// mensaje
  if(isset($_SESSION['message'])){
    ?>
    <div class="alert alert-<?=$_SESSION['message_type']?> alert-dismissible fade show" role="alert">
      <!-- para pintar el mensaje se hace lo siguiente -->
      <?= $_SESSION['message']?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php
  session_unset();
}
?>
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
      <th scope="col" class="text-center">Modificar</th>
      <th scope="col" class="text-center">Eliminar</th>
    </tr>
  </thead>
  <tbody>
  <?php
  $objetoEmpleados = new empleadoController();

    $presentarEmpleado = $objetoEmpleados->listarEmpleado();
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
      <td class="text-center"><a href="actualizarEmpleadoView.php?id=<?php echo $id?>"><i class="fas fa-edit"></i></a></td>
      <td class="text-center"><a href="eliminarEmpleadoView.php?id=<?php echo $id?>"><i class="fas fa-trash-alt"></i></a></td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>
</div>
<?php
require_once("../includes/footer.php");
?>