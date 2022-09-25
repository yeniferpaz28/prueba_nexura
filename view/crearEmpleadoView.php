<!DOCTYPE html>
<html>
<head>
  <title>Crear Empleado</title>
  <?php
  session_start();
  require_once("../Controller/empleadoController.php");
  require_once("../Controller/areaController.php");
  require_once("../Controller/rolController.php");

  ?>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie-edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
<div class="alert alert-danger alert-dismissible fade show" style="display:none" id="mensajeError" role="alert">
  <!-- para pintar el mensaje se hace lo siguiente -->
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <div id="mensajes"></div>
</div>
<form method="post">
  <div class="container-fluid" id="containerCrear">
    <div class="form-row" id="row1">
  		<div class="col-sm-4" style="padding-bottom: 20px;">
  			<h1>Guardar empleado</h1>
  		</div>
    </div>
    <div class="form-group row">
      <label for="nombre" class="col-sm-2 col-form-label">Nombre Completo *</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre completo del empleado" value="<?php if(isset($_POST['nombre'])) echo $_POST['nombre'];?>">
      </div>
    </div>
    <div class="form-group row">
      <label for="email" class="col-sm-2 col-form-label">Correo electrónico *</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="email" id="email" placeholder="Correo electrónico" value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>">
      </div>
    </div>
  <fieldset class="form-group">
    <div class="row">
      <legend class="col-form-label col-sm-2 pt-0">Sexo *</legend>
      <div class="col-sm-10">
        <div class="form-check">
          <input class="form-check-input sexo" type="radio" name="sexo" id="sexoMasculino" value="M" <?php if(isset($_POST['sexo']) && ($_POST['sexo'])=='M') echo 'checked';?>>
          <label class="form-check-label" for="sexoMasculino">
            Masculino
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input sexo" type="radio" name="sexo" id="sexoFemenino" value="F" <?php if(isset($_POST['sexo']) && ($_POST['sexo']) =='F') echo 'checked';?>>
          <label class="form-check-label" for="sexoFemenino">
            Femenino
          </label>
        </div>
      </div>
    </div>
  </fieldset>
  <div class="form-group row">
    <label for="area_id" class="col-sm-2 col-form-label">Área *</label>
    <div class="col-sm-10">
    	<select class="form-control" id="area_id" name="area_id">
      <option value="">Seleccione una opción</option>
      <?php
      if(isset($_POST['area_id'])){
        $selecArea = ($_POST['area_id']);
      }
        $objetoArea = new areaController();
        $listaAreas = $objetoArea->ListarAreas();
        while($areas = mysqli_fetch_array($listaAreas)){
          $seleccionar=($selecArea == $areas[id])? "selected" : "";
          echo '<option '.$seleccionar.' value = "'.$areas[id].'">'.$areas[nombre].'</option>\n';
        }
      ?>
    </select>
    </div>
  </div>
  <div class="form-group row">
    <label for="descripcion" class="col-sm-2 col-form-label" required>Descripción *</label>
    <div class="col-sm-10">
    	<textarea class="form-control" id="descripcion" rows="3" name="descripcion"><?php if(isset($_POST['descripcion'])) echo $_POST['descripcion'];?></textarea>
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-2"></div>
    <div class="col-sm-10">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="boletin" name="boletin" <?php if(isset($_POST['boletin'])  =='on') echo 'checked';?>>
        <label class="form-check-label" for="boletin">
          Deseo recibir boletín informativo
        </label>
      </div>
    </div>
  </div>
  <!-- rol -->
    <?php
    $nuevo = 0;
    $objetoRol = new rolController();
    $listaRoles = $objetoRol->PresentarRoles();
    while($roles = mysqli_fetch_array($listaRoles)){
      $nuevo += 1;

      $id_rol = $roles[0];
      $nombre_rol = $roles[1];

  ?>
  <div class="form-group row">
      <?php if($nuevo == 1){ ?>
      <label for="id_rol" class="col-sm-2 col-form-label pt-0" required>Roles *</label>
    <div class="col-sm-10">
      <?php }else{ ?>
        <div class="col-sm-10 offset-sm-2">
        <?php }?>
      <div class="form-check">
        <input class="form-check-input rol" type="checkbox" id="<?php echo 'id_rol_'.$nuevo;?>" name="id_rol[]" value="<?php echo $id_rol;?>" <?php if(isset($_POST['id_rol'])){ if(in_array($id_rol, $_POST['id_rol'])) {echo ' checked="checked"';}} ?>>
        <label class="form-check-label" for="<?php echo 'id_rol_'.$nuevo;?>">
          <?php echo $nombre_rol; ?>
        </label>
      </div>
    </div>
  </div>
  <?php }
  ?>
  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary" name="btnGuardar" id="btnGuardar">Guardar</button>
      <a href="ListarEmpleado.php" class="btn btn-primary">Volver</a>
    </div>
  </div>
</form>
</div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script type="text/javascript" src="../js/empleado.js"></script>
</body>
</html>