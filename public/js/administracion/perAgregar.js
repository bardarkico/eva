var btnAgregar = $('#btnAgregar'),
    btnCancelar = $('#btnCancelar'),
    token = $('#token');
var txtDiasAgregar=$('#txtDiasAgregar'),
 token=$('#token'),
tbodyConsulta=$('#tbodyConsulta');

var btnAgregar=$('#btnAgregar'),
    btnEditarM=$('#btnEditarM'),
    btnConsulta=$('#btnConsulta');

var txtFechaFin=$('#txtFechaFin'),
txtFechaInicio=$('#txtFechaInicio'),
pnlAgregar=$('#pnlAgregar'),
pnlConsulta=$('#pnlConsulta'),
tblServicios=$('#tblServicios');

var btnGuardar =$('#btnGuardar');
var tbodyPeriodos=$('#tbodyPeriodos'),
tblPeriodos=$('#tblPeriodos');

var txtFechaInicioE=$('#txtFechaInicioE'),
txtFechaFinE=$('#txtFechaFinE'),
btnCancelarE=$('#btnCancelarE'),
btnEditar=$('#btnEditar'),
idPeriodo=$('#idPeriodo'),
btnEditar=$('#btnEditar'),
pnlEditar=$('#pnlEditar'),
pnlInicio=$('#pnlInicio'),
btnEditar=$('#btnEditar'),
txtActivo=$('#txtActivo');

function getMostrarConsulta(){
  var datos = $.ajax({
    url: 'getTodosPeriodos',
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
        if ( o.perActivo == 1 ){
          status = '<span class="glyphicon glyphicon-ok text-success" title="Activo"></span>';
        }
        else{
          status = '<span class="glyphicon glyphicon-remove" title="Inactivo"></span>';
        }

        tbodyConsulta.append(
          '<tr>'+
            '<td >'+i+'</td>'+
            '<td >'+o.perInicio+'</td>'+
            '<td >'+o.perFin+'</td>'+
            '<td class="text-center">'+status+'</td>'+

          '</tr>'
      );
      i++;
      });
    }else{
      tbodyConsulta.html('<tr><td colspan="8" class="center"><h3>'+ res.message +'</h3></td></tr>');
    }
    tbodyConsulta.removeClass('hidden');
    }


function ingresoPeriodo(){
  var editar = $.ajax({
    url: 'ingresoPeriodo',
    data: {
      token: token.val(),
      fi: txtFechaInicio.val(),
      ff:txtFechaFin.val()
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
        title: "Período agregado.",
        text: "Se agrego correctamente el período.",
        timer: 2000,
        type: "success",
        showConfirmButton: true
      });
      getTodosPeriodos();
    }
    else{
      alert(resultado.message);
    }

}

function getTodosPeriodos(){
  var datos = $.ajax({
    url: 'getTodosPeriodos',
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

    tbodyPeriodos.html('');
    if ( res.status === 'OK' ){
       var i = 1;
      $.each(res.data, function(k,o){
        if ( o.perActivo == 1 ){
          status = '<span class="glyphicon glyphicon-ok text-success" title="Activo"></span>';
        }
    		else{
          status = '<span class="glyphicon glyphicon-remove" title="Inactivo"></span>';
        }

        tbodyPeriodos.append(
          '<tr>'+
            '<td >'+i+'</td>'+
            '<td >'+o.perInicio+'</td>'+
            '<td >'+o.perFin+'</td>'+
            '<td class="text-center">'+status+'</td>'+
            '<td class="text-center">'+
              '<span class="glyphicon glyphicon-edit text-primary" id="'+o.perId+'" '+
              'style="cursor:pointer" title="Editar"></span>'+
            '</td>'+
            '<td class="text-center">'+
              '<span class="glyphicon glyphicon-trash text-danger" id="'+o.perId+'" '+
              'style="cursor:pointer" title="Dar de baja"></span>'+
            '</td>'+
          '</tr>'
      );
      i++;
      });
    }else{
      tbodyPeriodos.html('<tr><td colspan="8" class="center"><h3>'+ res.message +'</h3></td></tr>');
    }
    tbodyPeriodos.removeClass('hidden');
}

function seleccionarPeriodo(){
  tblServicios.addClass('hidden');
  pnlEditar.removeClass('hidden');
  var id = $(this).attr('id');

  var datos = $.ajax({
    url: 'seleccionarPeriodo',
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

      $.each(res.data, function(k,o){
        txtFechaInicioE.val(o.perInicio);
        txtFechaFinE.val(o.perFin);
        idPeriodo.val(o.perId);

        txtActivo.find('option').each(function(){
        if ( o.perActivo == $(this).val() )
        txtActivo.val(o.perActivo);
        });

      });


    }else{
      alert(res.message);

    }
}

function editarPeriodo(){
  var datos = $.ajax({
    url: 'editarPeriodo',
    data: {
      i: idPeriodo.val(),
      fi:txtFechaInicioE.val(),
      ff:txtFechaFinE.val(),
      a:txtActivo.val(),
      token:token.val()
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
    swal({
        title: "Información actualizada.",
        text: res.message,
        timer: 2000,
        type: "success",
        showConfirmButton: true
      });

    cancelarE();
    getTodosPeriodos();
}

function darBajaPeriodo(){
  var id = $(this).attr('id');
  var datos = $.ajax({
    url: 'darBajaPeriodo',
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
    alert(res.message);
  //cancelarE();
    getTodosPeriodos();
}

function cancelar(){
  txtDiasAgregar.val('');
  txtFechaInicio.val('');
  txtFechaFin.val('');

}
function cancelarE(){
  pnlEditar.addClass('hidden');
  pnlCambio.removeClass('hidden');
}


function sumaFecha(days, fecha){

    fecha=new Date(fecha);
    day=fecha.getDate();
    month=fecha.getMonth()+1;
    year=fecha.getFullYear();

    tiempo=fecha.getTime();
    milisegundos=parseInt(days*24*60*60*1000);
    total=fecha.setTime(tiempo+milisegundos);
    day=fecha.getDate();
    month=fecha.getMonth()+1;
    year=fecha.getFullYear();

    var fechaMod = year+"/"+month+"/"+day;
    return fechaMod;

}

function mostrarEditar(){
  pnlAgregar.addClass('hidden');
  pnlConsulta.addClass('hidden');
  tblServicios.removeClass('hidden');
  getTodosPeriodos();
  pnlInicio.addClass('hidden');
  btnEditarM.addClass('botonActivo');
  btnConsulta.addClass('botonNoactivo');
  btnAgregar.addClass('botonNoactivo');
  btnEditarM.removeClass('botonNoactivo');
  btnConsulta.removeClass('botonActivo');
  btnAgregar.removeClass('botonActivo');
}
function mostrarConsulta(){
  pnlAgregar.addClass('hidden');
  pnlConsulta.removeClass('hidden');
  tblServicios.addClass('hidden');
  getMostrarConsulta();
  pnlInicio.addClass('hidden');
  btnEditarM.addClass('botonNoactivo');
  btnConsulta.addClass('botonActivo');
  btnAgregar.addClass('botonNoactivo');
  btnEditarM.removeClass('botonActivo');
  btnConsulta.removeClass('botonNoactivo');
  btnAgregar.removeClass('botonActivo');
}
function mostrarAgregar(){
  pnlAgregar.removeClass('hidden');
  pnlConsulta.addClass('hidden');
  tblServicios.addClass('hidden');
  pnlInicio.addClass('hidden');
  btnEditarM.addClass('botonNoactivo');
  btnConsulta.addClass('botonNoactivo');
  btnAgregar.addClass('botonActivo');
  btnEditarM.removeClass('botonActivo');
  btnConsulta.removeClass('botonActivo');
  btnAgregar.removeClass('botonNoactivo');
}

function seleccionarPer(){
  var seleccionCheck = txtDiasAgregar.val();
  if (seleccionCheck == 100) {

    txtFechaFin.prop('disabled', false);
  }
  else {
    txtFechaFin.prop('disabled', true);
  }
}

$(document).on('ready', function(){
  txtFechaFin.prop('disabled', true);
});

txtFechaInicio.change( function() {
  var seleccion = txtDiasAgregar.val();
  if (seleccion != 100) {
    var inicio=txtFechaInicio.val();
    var dias=txtDiasAgregar.val();
    var txtFechaFinal = sumaFecha(dias, inicio);
    txtFechaFin.val(txtFechaFinal);

  }
})

btnCancelar.on('click',cancelar);
btnGuardar.on('click',ingresoPeriodo);

tblPeriodos.delegate('.glyphicon-edit', 'click', seleccionarPeriodo);
tblPeriodos.delegate('.glyphicon-trash', 'click', darBajaPeriodo);
btnEditar.on('click',editarPeriodo);
btnCancelarE.on('click',cancelarE);

btnConsulta.on('click',mostrarConsulta);
btnEditarM.on('click',mostrarEditar);
btnAgregar.on('click',mostrarAgregar);

txtDiasAgregar.change(seleccionarPer);
