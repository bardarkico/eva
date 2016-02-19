var tblAgregar=$('#tblAgregar'),
tbodyAgregar=$('#tbodyAgregar');
var btnConsulta=$('#btnConsulta'),
btnEditar=$('#btnEditar'),
btnAgregar=$('#btnAgregar');

var pnlAgregar=$('#pnlAgregar'),
pnlConsulta=$('#pnlConsulta'),
pnlInicio=$('#pnlInicio');

var txtCorreoI=$('#txtCorreoI'),
txtNombreI=$('#txtNombreI');
var tblConsulta=$('#tblConsulta'),
tbodyConsulta=$('#tbodyConsulta');

var tblServicios   = $('#tblServicios'),
    tbodyServicios = $('#tbodyServicios');
var txtNombreE = $('#txtNombreE'),
    txtCorreoE=$('#txtCorreoE'),
    txtIdInvitado = $('#txtIdInvitado'),
    formEditarServ= $('#formEditarServ'),
    txtActivo     = $('#txtActivo'),
    btnGuardar    = $('#btnGuardar'),
    btnCancelar   = $('#btnCancelar'),
    token         = $('#_token');

var btnCancelarAg = $('#btnCancelarAg'),
    token = $('#token'),
    txtFuente = $('#txtFuente');
var spnNombre=$('#spnNombre'),
    btnGuardarAg =$('#btnGuardarAg');

function darBajainvitado(){
  var id = $(this).attr('id');
  if (id==="")
    return false;

  var datos = $.ajax({
    url: 'darBajaInvitado',
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
      getTodosInvitadosE();
    }
    else{
      alert(res.message);
    }
}


function editarInvitado(){
  var datos = $.ajax({
    url: 'editarInvitado',
    data: {
      token: token.val(),
      n:txtNombreE.val(),
      i:txtIdInvitado.val(),
      c:txtCorreoE.val(),
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
      swal({
        title: "Invitado editado.",
        text: "Se edito correctamente el invitado.",
      /*  timer: 2000,*/
        type: "success",
        showConfirmButton: true
      });
      limpiar();
      getTodosInvitadosE();
    }
    else
    alert(res.message);


}

function getTodosInvitadosE(){
  var datos = $.ajax({
    url: 'getTodosInvitados',
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
        if ( o.invActivo == 1 ){
          status = '<span class="glyphicon glyphicon-ok text-success" title="Activo"></span>';
        }
    		else{
          status = '<span class="glyphicon glyphicon-remove" title="Inactivo"></span>';
        }

        tbodyServicios.append(
          '<tr>'+
            '<td >'+i+'</td>'+
            '<td >'+o.invNombre+'</td>'+
            '<td >'+o.invCorreo+'</td>'+
            '<td class="text-center">'+status+'</td>'+
            '<td class="text-center">'+
              '<span class="glyphicon glyphicon-edit text-primary" id="'+o.invId+'" '+
              'style="cursor:pointer" title="Editar"></span>'+
            '</td>'+
            '<td class="text-center">'+
              '<span class="glyphicon glyphicon-trash text-danger" id="'+o.invId+'" '+
              'style="cursor:pointer" title="Dar de baja"></span>'+
            '</td>'+
          '</tr>'
      );
      i++;
      });

      }else{
      tbodyServicios.html('<tr><td colspan="8" class="center"><h3>'+ res.message +'</h3></td></tr>');
    }
}


function getInvitado(){
  var id = $(this).attr('id');
  if (id==="")
    return false;

  var datos = $.ajax({
    url: 'getInvitado',
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
        if ( o.invActivo == $(this).val() )
          txtActivo.val(o.invActivo);
        });

        txtNombreE.val(o.invNombre);
        txtIdInvitado.val(o.invId);
        txtCorreoE.val(o.invCorreo);

        formEditarServ.removeClass('hidden');
        tblServicios.addClass('hidden');
      i++;
      });
    }else{
      tbodyServicios.html('<tr><td colspan="8" class="center"><h3>'+ res.message +'</h3></td></tr>');
    }
    tbodyServicios.removeClass('hidden');
}

function cancelarAg(){
  txtCorreoI.val('');
  txtNombreI.val('');
}

function limpiar(){
  tblServicios.removeClass('hidden');
  formEditarServ.addClass('hidden');
  txtNombreE.val('');
}

/*******/

function ingresoInvitado(){
  var editar = $.ajax({
    url: 'ingresoInvitado',
    data: {
      token: token.val(),
      c: txtCorreoI.val(),
      n: txtNombreI.val()
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
        title: "Invitado agregado.",
        text: "Se agrego correctamente el invitado.",
      /*  timer: 2000,*/
        type: "success",
        showConfirmButton: true
      });
    }
    else{
      alert(resultado.message);
    }
}

function getTodosInvitados(){
  var datos = $.ajax({
    url: 'getTodosInvitados',
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
        if ( o.invActivo == 1 ){
          status = '<span class="glyphicon glyphicon-ok text-success" title="Activo"></span>';
        }
    		else{
          status = '<span class="glyphicon glyphicon-remove" title="Inactivo"></span>';
        }

        tbodyConsulta.append(
          '<tr>'+
            '<td >'+i+'</td>'+
            '<td >'+o.invNombre+'</td>'+
            '<td >'+o.invCorreo+'</td>'+
            '<td class="text-center">'+status+'</td>'+
          '</tr>'
      );
      i++;
      });
    }else{
      tbodyConsulta.html('<tr><td colspan="8" class="center"><h3>'+ res.message +'</h3></td></tr>');
    }
    tblConsulta.removeClass('hidden');
}

function mostrarEditar(){
  pnlAgregar.addClass('hidden');
  pnlConsulta.addClass('hidden');
  tblServicios.removeClass('hidden');
  getTodosInvitadosE();
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
  getTodosInvitados();
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
  pnlInicio.addClass('hidden');
  btnEditar.addClass('botonNoactivo');
  btnConsulta.addClass('botonNoactivo');
  btnAgregar.addClass('botonActivo');
  btnEditar.removeClass('botonActivo');
  btnConsulta.removeClass('botonActivo');
  btnAgregar.removeClass('botonNoactivo');
}

/******/
$(document).on('ready', function(){
});
tblServicios.delegate('.glyphicon-edit', 'click', getInvitado);
tblServicios.delegate('.glyphicon-trash', 'click', darBajainvitado);
btnCancelar.on('click',limpiar);
btnGuardar.on('click',editarInvitado);

btnCancelarAg.on('click',cancelarAg);
btnGuardarAg.on('click',ingresoInvitado);


btnEditar.on('click',mostrarEditar);
btnConsulta.on('click',mostrarConsulta);
btnAgregar.on('click',mostrarAgregar);
