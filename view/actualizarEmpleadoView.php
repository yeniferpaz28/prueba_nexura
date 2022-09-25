<?php
session_start();
require_once("../modelo/ModeloEmpleado.php");
require_once("../modelo/ModeloArea.php");
require_once("../modelo/ModeloRol.php");

// validar valor del boletin
$vBoletin = 0;
if(isset($_POST['boletin'])){
	if($_POST['boletin']=='on'){
		$vBoletin = 1;
	}else{
		$vBoletin = 0;
	}
}
$objetoEmpleado = new ModeloEmpleado();
$objetoRol = new ModeloRol();
// verificar si exite id
if(isset($_GET['id'])){
	$id = intval($_GET['id']);
	$maxId = $objetoEmpleado->MaximoId();
	$mId = $maxId->id_empleado;
	if(!is_numeric($_GET['id']) || $_GET['id']<=0 || $mId < $_GET['id']){

		header("location: ListarEmpleado.php");
	}
}else{
  header("location: ListarEmpleado.php");
}
// actualizar empleado
if (isset($_POST['btnActualizar'])) {
		if(isset($_POST) && !empty($_POST)){
		$id = intval($_GET['id']);
		$nombre = ($_POST['nombre']);
		$email = ($_POST['email']);
		$sexo = ($_POST['sexo']);
		$descripcion = ($_POST['descripcion']);
		$area_id = ($_POST['area_id']);
		$boletin = $vBoletin;

      $email = filter_var($email, FILTER_SANITIZE_EMAIL);
      if(trim($nombre)==''){
        $_SESSION['message_error'][] = 'Debe agregar un nombre';
      }else if (!preg_match ("/^[a-z A-Z]+$/", $nombre)) {
      $_SESSION['message_error'][] = 'nombre no valida';
    }
    // Luego validamos el email
      if(trim($email)==''){
        $_SESSION['message_error'][] = 'Debe agregar un correo';
      }
      if (!filter_var($email, FILTER_VALIDATE_EMAIL) === true) {
        $_SESSION['message_error'][] = 'No es una dirección válida de correo';
      }
      if(empty(($_POST['sexo']))){
        $_SESSION['message_error'][] = 'Debe seleccionar un sexo';
      }
      if(trim($area_id)==''){
        $_SESSION['message_error'][] = 'Debe seleccionar una área';
      }
      else if (!preg_match ("/^[0-9]+$/", $area_id)) {
        $_SESSION['message_error'][] = 'Área no válida';
      }
      if(trim($descripcion)==''){
        $_SESSION['message_error'][] = 'Debe agregar una descripción';
      }else
      if (!preg_match ("/^[a-z0-9A-Z,. ]+$/", $descripcion)) {
      $_SESSION['message_error'][] = 'Descripción no valida';
      }
      if (!isset($_POST['id_rol']) && empty($_POST['id_rol_2'])) {
         $_SESSION['message_error'][] = 'Debe seleccionar al menos un rol';
      }
      // else if (isset($_POST['id_rol_2'])){
      //   foreach ($_POST['id_rol_2'] as $id_rol) {
      //     if (!preg_match ("/^[0-9]+$/", $id_rol)) {
      //       $_SESSION['message_error'][] = 'Rol no válido';
      //     }
      //   }
      // }
      else if(!isset($_SESSION['message_error'])){

		   $empleado = $objetoEmpleado->ActualizarEmpleados($id,$nombre,$email,$sexo,$area_id,$boletin,$descripcion);
      if (!empty($_POST['id_rol_2'])){
        foreach ($_POST['id_rol_2'] as $seleccion) {
          $rol = $objetoRol->GuardarRoles($seleccion,$id);
          }
        }
        if(!empty($_POST['id_rol_2'])){
          $valorVariable =($empleado && $rol);
        }else{
          $valorVariable = $empleado;
        }
    // mensaje si se actualizo
        if($valorVariable){
      		// if($empleado){
      			 $_SESSION['message'] = 'Datos actualizados correctamente';
            $_SESSION['message_type']='success';
            // header("location: ActualizarEmpleado.php");

          }else{
            $_SESSION['message'] = 'Error al actualizar datos';
            $_SESSION['message_type']='danger';
            // header("location: ActualizarEmpleado.php");
      	}
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
    }
  }
}
$presentarEmpleados = $objetoEmpleado->PresentarEmpleadosActualizar($id);
// mensajes cuando no se selecciona
      if(isset($_SESSION['message_error'])){
        foreach ($_SESSION['message_error'] as $row) {
          ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <!-- para pintar el mensaje se hace lo siguiente -->
            <?php echo $row; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php }
      // <!-- aqui limpiara los datos que esten en sesion, para que no se quede el mensaje en el index, todo el tiempo -->
        session_unset();
        // header("Location: Pagina.php?mensaje=$mensaje");

      }
?>
 <!--no permitir que se recargue la pagina -->
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
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
<form method="post">
	<div class="container-fluid">
	<div class="form-row" id="row1">
		<div class="col-sm-4">
			<h1>Actualizar empleados</h1>
		</div>
	</div>
  <div class="form-group row">
    <label for="nombre" class="col-sm-2 col-form-label">Nombre Completo*</label>
    <div class="col-sm-10">
      <input type="hidden" class="form-control" id="id_empleado" name="id_empleado" placeholder="Nombre completo del empleado" value="<?php echo $presentarEmpleados->id;?>">
      <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre completo del empleado" value="<?php echo $presentarEmpleados->nombre;?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="email" class="col-sm-2 col-form-label">Correo electrónico*</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="email" id="email" placeholder="Correo electronico" value="<?php echo $presentarEmpleados->email;?>">
    </div>
  </div>
  <fieldset class="form-group">
    <div class="row">
      <legend class="col-form-label col-sm-2 pt-0">Sexo*</legend>
      <div class="col-sm-10">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="sexo" id="sexoMasculino" value="M" <?php if($presentarEmpleados->sexo == 'M') echo 'checked'?>>
          <label class="form-check-label" for="sexoMasculino">
            Masculino
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="sexo" id="sexoFemenino" value="F" <?php if($presentarEmpleados->sexo == 'F') echo 'checked'?>>
          <label class="form-check-label" for="sexoFemenino">
            Femenino
          </label>
        </div>
      </div>
    </div>
  </fieldset>
  <div class="form-group row">
    <label for="area" class="col-sm-2 col-form-label">Área</label>
    <div class="col-sm-10">
    	<select class="form-control" id="area_id" name="area_id">
      <!-- <option value="">:..</option> -->
      <?php
            $objetoArea = new ModeloArea();
          $listaAreas = $objetoArea->ListarAreas();
          while($areas = mysqli_fetch_array($listaAreas)){
          	$seleccionar=($presentarEmpleados->area_id == $areas[id])? "selected" : "";
            echo '<option '.$seleccionar.' value = "'.$areas[id].'">'.$areas[nombre].'</option>\n';
          }
      ?>
    </select>
    </div>
  </div>
  <div class="form-group row">
    <label for="descripciones" class="col-sm-2 col-form-label">Descripción *</label>
    <div class="col-sm-10">
    	<textarea class="form-control" id="descripcion" rows="3" name="descripcion"><?php echo $presentarEmpleados->descripcion;?></textarea>
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-2"></div>
    <div class="col-sm-10">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="boletin" name="boletin" <?php if($presentarEmpleados->boletin == 1) echo 'checked'; ?>>
        <label class="form-check-label" for="boletin">
          Deseo recibir boletín informativo
        </label>
      </div>
    </div>
  </div>
  <!-- rol -->
   <?php
    $i = 0;
    $listaRoles = $objetoRol->PresentarRoles();
    while ($roles = mysqli_fetch_object($listaRoles)) {
      $i++;
      $nombre_rol = $roles->nombre_rol;
      $id_rol = $roles->id_rol;
   ?>
    <div class="form-group row">
      <?php if($i<=1){ ?>
      <label for="descripciones" class="col-sm-2 col-form-label pt-0" required>Roles *</label>
      <div class="col-sm-10">
        <?php }else{ ?>
        <div class="col-sm-10 offset-sm-2">
          <?php } ?>
        <div class="form-check">
          <?php $presentarRoles = $objetoRol->PresentarRolesActualizar($id,$id_rol);
          if($filas = mysqli_fetch_object($presentarRoles)){   ?>
          <input class="form-check-input" type="checkbox" id="<?php echo 'id_rol_'.$i;?>" name="id_rol[]" value="<?php echo $id_rol;?>" checked onclick="funciones(this);">
          <label class="form-check-label" for="<?php echo 'id_rol_'.$i;?>">
        <?php }else{ ?>
          <input class="form-check-input" type="checkbox" id="<?php echo 'id_rol_'.$i;?>" name="id_rol_2[]" value="<?php echo $id_rol;?>" <?php if(isset($_POST['id_rol_2'])){ if(in_array($id_rol, $_POST['id_rol_2'])) {echo ' checked="checked"';}} ?>>
          <label class="form-check-label" for="<?php echo 'id_rol_'.$i;?>">
        <?php }?>

          <?php echo $nombre_rol; ?>
          </label>

        </div>
      </div>
    </div>
  <?php }?>
    <div class="form-group row">
      <div class="col-sm-10">

        <button type="submit" class="btn btn-primary" name="btnActualizar" id="btnActualizar" onclick="funciones(this)" value="btn">Actualizar</button>
        <a href="ListarEmpleado.php" class="btn btn-primary">Volver</a>
      </div>
    </div>
  </div>
</form>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="../validar/validacion.js"></script>
  </body>
</html>
