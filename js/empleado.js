// datos obtenidos de rol
var arrayCheck = new Array;
function roles(elemento){

    var elemento = ($(elemento).attr("value"));
    var id_empleado = $('#id_empleado').val();
      
    if(elemento.length>0){
      var checkEnOn = elemento;
      // buscar posicion del elemento que se va agregar
      var indice = arrayCheck.indexOf(checkEnOn);
      console.log("El elemento buscado está en el índice ", indice);
      if(indice >= 0){
        console.log("no se puede agregar");
        // si existe el indice eliminarlo del array
        arrayCheck.splice(indice,1);
      }else{
        arrayCheck.push(checkEnOn);
      }
      
      for(var i=0; i<checkEnOn.length;i++){
           console.log(checkEnOn[i]);
      }
      console.log(arrayCheck);
    }     
     // boton actualizar
    if(elemento == 'btn'){
      var elemento = elemento;
      // enviar datos a la funcion enviar
      enviar(arrayCheck,id_empleado);
    }
}



// enviar datos a obtenerRol
function enviar(arrayCheck,id_empleado){
  var valor = arrayCheck;
  var valorId = id_empleado;
  
    $.ajax({
      url:   '../view/ObtenerRol.php', //archivo que recibe la llamada
      type:  'post', //método de envio
      async: true,
      data:  {arrayCheck:valor,valorId:valorId}, //datos a enviar en json (para mejor lectura)
      success:  function (result) { //Una vez que la llamada fue realiada y procesada por el servidor, el resultado se recibe en 'response'
        $('#resultado').html(result);
      },
      error: function(result){
        $('#resultado').html('se ha producido un error');
      }
    });
}

$('#btnGuardar').click(function(){
    let errores = [];
    let i = 0;
    if ($('#nombre').val().trim() === '') {
        errores[i] = 'Debe ingresar un nombre';
        i++;
    }else if(!/^[a-zA-Z]+$/.test($('#nombre').val().trim())){
        errores[i] = 'El nombre ingresado no es válido';
        i++;
    }

    if ($('#descripcion').val().trim() === '') {
        errores[i] = 'Debe ingresar una descripción';
        i++;
    }else if(!/^[a-z0-9A-Z,. ]+$/.test($('#descripcion').val().trim())){        
        errores[i] = 'La descripcion ingresada no es válida';
        i++;
    }

    if ($('#email').val().trim() === '') {
        errores[i] = 'Debe ingresar el correo electrónico';
        i++;
    }else if(!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3,4})+$/.test($('#email').val().trim())){        
        errores[i] = 'El correo ingresado no es válido';
        i++;
    }
    
    if ($('#area_id').val() === '') {
        errores[i] = 'Debe seleccionar una área';
        i++;
    }
    
    if ($('.sexo').is(':checked') === false) {
        errores[i] = 'Debe seleccionar el sexo';
        i++;
    
    }

    if ($('.rol').is(':checked') === false) {
        errores[i] = 'Debe seleccionar al menos un rol';  
        i++;  
    }
    if (i > 0) {
        document.getElementById('mensajeError').style.display='block';

        $('#mensajeError').addClass('show');
        $('#mensajeError').removeClass('hide');
       let valores = [];
        for (var j = 0; j < errores.length; j++) {
            valores += '<li>'+errores[j]+'</li>';
        }
        $('#mensajes').html(valores);
        return false;
    }else{
        console.log('hola');
    document.getElementById('mensajeError').style.display='none';  
    $('#mensajeError').addClass('hide');
    $('#mensajeError').removeClass('show');
    }
});

$('#cerrarMensajeError').click(function(){
    document.getElementById('mensajeError').style.display='none';  
    $('#mensajeError').addClass('hide');
    $('#mensajeError').removeClass('show');
});