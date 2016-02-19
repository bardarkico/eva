
var tbodyConsulta =$('#tbodyConsulta'),
    slctRepresentante=$('#slctRepresentante');
var btnConsulta=$('#btnConsulta'),
btnEditar=$('#btnEditar'),
btnAgregar=$('#btnAgregar');

var pnlAgregar=$('#pnlAgregar'),
pnlConsulta=$('#pnlConsulta');
var pnlInicio=$('#pnlInicio');

var txtIniciales=$('#txtIniciales'),
txtNombreC=$('#txtNombreC');

var tblServicios   = $('#tblServicios'),
    tbodyServicios = $('#tbodyServicios');
var txtNombre = $('#txtNombre'),
    txtIdFuente = $('#txtIdFuente'),
    formEditarServ= $('#formEditarServ'),
    txtActivo     = $('#txtActivo'),
    txtCorreo     = $('#txtCorreo'),
    btnGuardar    = $('#btnGuardar'),
    btnCancelar   = $('#btnCancelar'),
    btnEnviar=$('#btnEnviar'),
    slctRepresentante2 =$('#slctRepresentante2'),
    token         = $('#_token');

    var btnGuardarAg =$('#btnGuardarAg'),
        btnCancelarAg = $('#btnCancelarAg');
    var txtNombreAg = $('#txtNombreAg'),
    txtCorreoAg=$('#txtCorreoAg');
    var tbodyServicios =$('#tbodyServicios'),
        slctRepresentante=$('#slctRepresentante');
    var spnNombre=$('#spnNombre'),
    spnCorreo=$('#spnCorreo');

function darBajaIntegrante(){
  var id = $(this).attr('id');  /*Ide desde el icono editar de la tabla*/
  if (id==="")
    return false;

  var datos = $.ajax({
    url: 'darBajaIntegrante',
    data: {
      i: id,
      token: token.val()
    },
    type: 'post',
    dataType:'json',
    async:false
  }).error(function(e){
    alert('Ocurrio un error, intente de nuevo');
  }).responseText;

  var res;
  try{
      res = JSON.parse(datos);
      }catch(e){
      alert('Error JSON ' + e);
    }

    if ( res.status === 'OK' ){
      getTodosIntegrantes();
    }
    else{
      alert(res.message);
    }
}

function editarIntegrante(){
  var datos = $.ajax({
    url: 'editarIntegrante',
    data: {
      token: token.val(),
      n:txtNombre.val(),
      nc:txtNombreC.val(),
      c:txtCorreo.val(),
      i:txtIdFuente.val(),
      activo:txtActivo.val(),
      r:slctRepresentante2.val()
    },
    type: 'post',
        dataType:'json',
        async:false
    }).error(function(e){
        alert('Ocurrio un error, intente de nuevo');
    }).responseText;

    var res;
    try{
        res = JSON.parse(datos);
    }catch (e){
        alert('Error JSON ' + e);

    }

  //  tbodyServicios.html('');
    if ( res.status === 'OK' ){
      limpiar();
      getTodosIntegrantes();

      swal({
        title: "Edición de información correcta.",
        text: res.message,
        timer: 2000,
        type: "success",
        showConfirmButton: true
      });

    }
    else{      
      alert(res.message);
    }

}

function getTodosIntegrantes(){
  var datos = $.ajax({
    url: 'getTodosIntegrantes',
    type: 'post',
        dataType:'json',
        async:false
    }).error(function(e){
        alert('Ocurrio un error, intente de nuevo');
    }).responseText;

    var res;
    try{
        res = JSON.parse(datos);
    }catch (e){
        alert('Error JSON ' + e);
    }

    tbodyServicios.html('');
    if ( res.status === 'OK' ){
       var i = 1;
      $.each(res.data, function(k,o){
        if ( o.intActivo == 1 ){
          status = '<span class="glyphicon glyphicon-ok text-success" title="Activo"></span>';
        }
    		else{
          status = '<span class="glyphicon glyphicon-remove" title="Inactivo"></span>';
        }

        tbodyServicios.append(
          '<tr>'+
            '<td >'+o.intId+'</td>'+
            '<td >'+o.resNombre+'</td>'+
            '<td >'+o.intNombre+'</td>'+
            '<td >'+o.intNombreCompleto+'</td>'+
            '<td >'+o.intCorreo+'</td>'+
            '<td class="text-center">'+status+'</td>'+
            '<td class="text-center">'+
              '<span class="glyphicon glyphicon-edit text-primary" id="'+o.intId+'" '+
              'style="cursor:pointer" title="Editar"></span>'+
            '</td>'+
            '<td class="text-center">'+
              '<span class="glyphicon glyphicon-trash text-danger" id="'+o.intId+'" '+
              'style="cursor:pointer" title="Dar de baja"></span>'+
            '</td>'+
          '</tr>'
      );
      i++;
      });
    }else{
      tbodyServicios.html('<tr><td colspan="8" class="center"><h3>'+ res.message +'</h3></td></tr>');
    }
    tblServicios.removeClass('hidden');
}

function getIntegrante(){
  getTodosResponsables();

  var id = $(this).attr('id');  /*Ide desde el icono editar de la tabla*/
  if (id==="")
    return false;

  var datos = $.ajax({
    url: 'getIntegrante',
    data: {
      i: id
    },
    type: 'post',
    dataType:'json',
    async:false
  }).error(function(e){
    alert('Ocurrio un error, intente de nuevo');
  }).responseText;

  var res;
  try{
      res = JSON.parse(datos);
      }catch(e){
      alert('Error JSON ' + e);
    }

    if ( res.status === 'OK' ){
       var i = 1;
      $.each(res.data, function(k,o){
        txtActivo.find('option').each(function(){
        if ( o.intActivo == $(this).val() )
          txtActivo.val(o.intActivo);
        });

        slctRepresentante2.find('option').each(function(){
        if ( o.intResponsable == $(this).val() )
        slctRepresentante2.val(o.intResponsable);
        });

        txtCorreo.val(o.intCorreo);
        txtNombre.val(o.intNombre);
        txtNombreC.val(o.intNombreCompleto)
        txtIdFuente.val(o.intId);
        formEditarServ.removeClass('hidden');
        tblServicios.addClass('hidden');
      i++;
      });
    }else{
      tbodyServicios.html('<tr><td colspan="8" class="center"><h3>'+ res.message +'</h3></td></tr>');
    }
    tbodyServicios.removeClass('hidden');
}

function getTodosResponsables(){
  var datos = $.ajax({
    url: 'getActivoResponsables',
    type: 'post',
        dataType:'json',
        async:false
    }).error(function(e){
        alert('Ocurrio un error, intente de nuevo');
    }).responseText;

    var res;
    try{
        res = JSON.parse(datos);
    }catch (e){
        alert('Error JSON ' + e);
    }

    slctRepresentante2.html('');
    slctRepresentante.html('');
    if ( res.status === 'OK' ){
       var i = 1;
      $.each(res.data, function(k,o){
        slctRepresentante2.append(
          '<option value='+o.resId+'>'+o.resNombre+' </option>'
        );
        slctRepresentante.append(
          '<option value= '+o.resId+'>'+o.resNombre+' </option>'
        );

      });

    }else{
      slctRepresentante2.append(
        '<option >'+res.message +' </option>'
      );
    }
}

function cancelar(){
  limpiar();
  getTodosIntegrantes();
}

function limpiar(){
  tblServicios.removeClass('hidden');
  formEditarServ.addClass('hidden');
  txtNombre.val('');
}

function validarBuscar(){
  if (( txtBuscar.val() === '')||( txtBuscar.val() === null)){
    alert("Ingrese una cadena de caracteres a buscar.");
    txtBuscar.focus();
    return false;
  }
  return true;
}

/*********************/
function ingresoIntegrante(){
  var editar = $.ajax({
    url: 'ingresoIntegrante',
    data: {
      token: token.val(),
      nc: txtNombreAg.val(),
      c:txtCorreoAg.val(),
      n:txtIniciales.val(),
      r:slctRepresentante.val()
    },
    type: 'post',
    dataType:'json',
      async:false
    }).error(function(e){
        alert('Ocurrio un error, intente de nuevo');
    }).responseText;

    var resultado;
    try{
      resultado = JSON.parse(editar);
    }catch (e){
        alert('Error JSON ' + e);
    }

    if ( resultado.status == 'OK' ){
      swal({
        title: "Integrante agregado.",
        text: "Se agrego correctamente el resposable.",
        timer: 2000,
        type: "success",
        showConfirmButton: true
      });
    }
    else{
      alert(resultado.message);
    }
}

function comprobarNombre(e){
  var elem = e.target;
  if (elem.validity.valid) {
    document.getElementById('spnNombre').innerHTML = "";
    elem.style.background='#FFFFFF';
  }
  else {
    elem.style.background='#FFDDDD';
    document.getElementById('spnNombre').innerHTML = '<i class="fa fa-exclamation-circle"></i> Solo caracteres alfanumericos y @ . _ - ';
  }
}

function cancelarAg(){
  txtNombreAg.val('');
  txtCorreoAg.val('');
}
/***********************/





function getTodosIntegrantesConsulta(){
  var datos = $.ajax({
    url: 'getTodosIntegrantes',
    type: 'post',
        dataType:'json',
        async:false
    }).error(function(e){
        alert('Ocurrio un error, intente de nuevo');
    }).responseText;

    var res;
    try{
        res = JSON.parse(datos);
    }catch (e){
        alert('Error JSON ' + e);
    }

    tbodyConsulta.html('');
    if ( res.status === 'OK' ){
       var i = 1;
      $.each(res.data, function(k,o){
        if ( o.intActivo == 1 ){
          status = '<span class="glyphicon glyphicon-ok text-success" title="Activo"></span>';
        }
    		else{
          status = '<span class="glyphicon glyphicon-remove" title="Inactivo"></span>';
        }

        tbodyConsulta.append(
          '<tr>'+
            '<td >'+i+'</td>'+
            '<td >'+o.resNombre+'</td>'+
            '<td >'+o.intNombre+'</td>'+
            '<td >'+o.intNombreCompleto+'</td>'+
            '<td >'+o.intCorreo+'</td>'+
            '<td class="text-center">'+status+'</td>'+
          '</tr>'
      );
      i++;
      });
    }else{
      tbodyConsulta.html('<tr><td colspan="8" class="center"><h3>'+ res.message +'</h3></td></tr>');
    }

}
function enviarEquipos(){
  var datos = $.ajax({
    url: 'enviarEquipos',
    type: 'get',
    dataType:'json',
    async:false
  }).error(function(e){
    alert('Ocurrio un error, intente de nuevo');
  }).responseText;

  var res;
  try{
      res = JSON.parse(datos);
      }catch(e){
      alert('Error JSON ' + e);
    }

    if ( res.status === 'OK' ){
      swal({
         title: res.message,
         text: "El correo se envio correctamente.",
         timer: 2000,
         type: "success",
         showConfirmButton: true
       });

    }else{
      alert(res.message);
    }
}


function mostrarEditar(){
  pnlAgregar.addClass('hidden');
  pnlConsulta.addClass('hidden');
  tblServicios.removeClass('hidden');
  getTodosIntegrantes();
  pnlInicio.addClass('hidden');
  btnEditar.addClass('botonActivo');
  btnConsulta.addClass('botonNoactivo');
  btnAgregar.addClass('botonNoactivo');
  btnEditar.removeClass('botonNoactivo');
  btnConsulta.removeClass('botonActivo');
  btnAgregar.removeClass('botonActivo');
}
function mostrarConsulta(){
  pnlAgregar.addClass('hidden');
  pnlConsulta.removeClass('hidden');
  tblServicios.addClass('hidden');
  getTodosIntegrantesConsulta();
  pnlInicio.addClass('hidden');
  btnEditar.addClass('botonNoactivo');
  btnConsulta.addClass('botonActivo');
  btnAgregar.addClass('botonNoactivo');
  btnEditar.removeClass('botonActivo');
  btnConsulta.removeClass('botonNoactivo');
  btnAgregar.removeClass('botonActivo');
}
function mostrarAgregar(){
  pnlAgregar.removeClass('hidden');
  pnlConsulta.addClass('hidden');
  tblServicios.addClass('hidden');
  getTodosResponsables();
  pnlInicio.addClass('hidden');
  btnEditar.addClass('botonNoactivo');
  btnConsulta.addClass('botonNoactivo');
  btnAgregar.addClass('botonActivo');
  btnEditar.removeClass('botonActivo');
  btnConsulta.removeClass('botonActivo');
  btnAgregar.removeClass('botonNoactivo');
}

$(document).on('ready', function(){

  intNombre = document.querySelector("input[name='txtNombreAg']");
  intNombre.addEventListener("input", comprobarNombre);
});

tblServicios.delegate('.glyphicon-edit', 'click', getIntegrante);
tblServicios.delegate('.glyphicon-trash', 'click', darBajaIntegrante);
btnCancelar.on('click',cancelar);
btnGuardar.on('click',editarIntegrante);

btnCancelarAg.on('click',cancelarAg);
btnGuardarAg.on('click',ingresoIntegrante);

btnEditar.on('click',mostrarEditar);
btnConsulta.on('click',mostrarConsulta);
btnAgregar.on('click',mostrarAgregar);
btnEnviar.on('click',enviarEquipos);
