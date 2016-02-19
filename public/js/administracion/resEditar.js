var tbodyAgregar=$('#tbodyAgregar');
var tblAgregar=$('#tblAgregar'),
btnEditar=$('#btnEditar'),
btnConsulta=$('#btnConsulta'),
btnAgregar=$('#btnAgregar');
var pnlInicio=$('#pnlInicio');

var pnlAgregar=$('#pnlAgregar'),
pnlConsulta=$('#pnlConsulta');

var tblServicios   = $('#tblServicios'),
    tbodyServicios = $('#tbodyServicios');
var txtNombre = $('#txtNombre'),
    txtIdFuente = $('#txtIdFuente'),
    formEditarServ= $('#formEditarServ'),
    txtActivo     = $('#txtActivo'),
    txtCorreo     = $('#txtCorreo'),
    btnGuardar    = $('#btnGuardar'),
    btnCancelar   = $('#btnCancelar'),
    token         = $('#_token');

    var btnCancelarAg = $('#btnCancelarAg');
    var txtNombreAg = $('#txtNombreAg'),
    txtCorreoAg=$('#txtCorreoAg');
    var spnNombre=$('#spnNombre'),
    btnGuardarAg =$('#btnGuardarAg');

function darBajaRepresentante(){
  var id = $(this).attr('id');
  if (id==="")
    return false;

  var datos = $.ajax({
    url: 'darBajaRepresentante',
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
      getTodosResponsables();
    }
    else{
      alert(res.message);
    }
}

function editarRepresentante(){
  var datos = $.ajax({
    url: 'editarRepresentante',
    data: {
      token: token.val(),
      n:txtNombre.val(),
      c:txtCorreo.val(),
      i:txtIdFuente.val(),
      activo:txtActivo.val()
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

    tbodyServicios.html('');
    if ( res.status === 'OK' ){
      limpiar();
      getTodosResponsables();
    }
    alert(res.message);
}

function getTodosResponsables(){
  var datos = $.ajax({
    url: 'getTodosResponsables',
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
        if ( o.resActivo == 1 ){
          status = '<span class="glyphicon glyphicon-ok text-success" title="Activo"></span>';
        }
    		else{
          status = '<span class="glyphicon glyphicon-remove" title="Inactivo"></span>';
        }

        tbodyServicios.append(
          '<tr>'+
            '<td >'+o.resId+'</td>'+
            '<td >'+o.resNombre+'</td>'+
            '<td >'+o.resCorreo+'</td>'+
            '<td class="text-center">'+status+'</td>'+
            '<td class="text-center">'+
              '<span class="glyphicon glyphicon-edit text-primary" id="'+o.resId+'" '+
              'style="cursor:pointer" title="Editar"></span>'+
            '</td>'+
            '<td class="text-center">'+
              '<span class="glyphicon glyphicon-trash text-danger" id="'+o.resId+'" '+
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

function getRepresentante(){
  //tblServicios.addClass('hidden');
  var id = $(this).attr('id');
  if (id==="")
    return false;

  var datos = $.ajax({
    url: 'getRepresentante',
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
        if ( o.resActivo == $(this).val() )
          txtActivo.val(o.resActivo);
        });

        txtCorreo.val(o.resCorreo);
        txtNombre.val(o.resNombre);
        txtIdFuente.val(o.resId);
        formEditarServ.removeClass('hidden');
        tblServicios.addClass('hidden');
      i++;
      });
    }else{
      tbodyServicios.html('<tr><td colspan="8" class="center"><h3>'+ res.message +'</h3></td></tr>');
    }
    //tbodyServicios.removeClass('hidden');
}

function cancelar(){
  limpiar();
}

function limpiar(){
  tblServicios.removeClass('hidden');
  formEditarServ.addClass('hidden');
  txtNombre.val('');
}

/************/
function ingresoResponsable(){
  var editar = $.ajax({
    url: 'ingresoResponsable',
    data: {
      token: token.val(),
      nombre: txtNombreAg.val(),
      correo:txtCorreoAg.val()
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
        title: "Responsable agregado.",
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

function cancelarAg(){
  txtNombreAg.val('');
  txtCorreo.val('');
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

/***************/

function getTodosResponsablesCon(){
  var datos = $.ajax({
    url: 'getTodosResponsables',
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

    tbodyAgregar.html('');
    if ( res.status === 'OK' ){
       var i = 1;
      $.each(res.data, function(k,o){
        if ( o.resActivo == 1 ){
          status = '<span class="glyphicon glyphicon-ok text-success" title="Activo"></span>';
        }
    		else{
          status = '<span class="glyphicon glyphicon-remove" title="Inactivo"></span>';
        }

        tbodyAgregar.append(
          '<tr>'+
            '<td >'+o.resId+'</td>'+
            '<td >'+o.resNombre+'</td>'+
            '<td >'+o.resCorreo+'</td>'+
            '<td class="text-center">'+status+'</td>'+
          '</tr>'
      );
      i++;
      });
    }else{
      tbodyAgregar.html('<tr><td colspan="8" class="center"><h3>'+ res.message +'</h3></td></tr>');
    }
    tblAgregar.removeClass('hidden');
}

function mostrarEditar(){
  pnlAgregar.addClass('hidden');
 pnlConsulta.addClass('hidden');
 tblServicios.removeClass('hidden');
 getTodosResponsables();
 pnlInicio.addClass('hidden');
}
function mostrarConsulta(){
  pnlAgregar.addClass('hidden');
   pnlConsulta.removeClass('hidden');
   tblServicios.addClass('hidden');
   getTodosResponsablesCon();
   pnlInicio.addClass('hidden');
}
function mostrarAgregar(){
  pnlAgregar.removeClass('hidden');
  pnlConsulta.addClass('hidden');
  tblServicios.addClass('hidden');
  pnlInicio.addClass('hidden');
}

$(document).on('ready', function(){
  intNombre = document.querySelector("input[name='txtNombreAg']");
  intNombre.addEventListener("input", comprobarNombre);
});
tblServicios.delegate('.glyphicon-edit', 'click', getRepresentante);
tblServicios.delegate('.glyphicon-trash', 'click', darBajaRepresentante);
btnCancelar.on('click',cancelar);
btnGuardar.on('click',editarRepresentante);

btnCancelarAg.on('click',cancelar);
btnGuardarAg.on('click',ingresoResponsable);


btnEditar.on('click',mostrarEditar);
btnConsulta.on('click',mostrarConsulta);
btnAgregar.on('click',mostrarAgregar);

function myFunction(elmnt,clr) {
    elmnt.style.color = clr;
}
