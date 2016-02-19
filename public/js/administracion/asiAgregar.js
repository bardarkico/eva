var tblServicios   = $('#tblServicios'),
    tbodyServicios = $('#tbodyServicios');

var txtNombreFuente = $('#txtNombreFuente'),
    txtIdFuente = $('#txtIdFuente'),
    formEditarServ= $('#formEditarServ'),
    btnCancelar   = $('#btnCancelar'),
    token         = $('#_token'),
    pnlInicio=$('#pnlInicio');
var slctRepresentante =$('#slctRepresentante'),
slctPeriodo=$('#slctPeriodo');
var btnGuardar=$('#btnGuardar');
var idFue=[],idRes=[],
    idResFin=[];
var tbodyFuentes=$('#tbodyFuentes'),
    tbodyResponsables=$('#tbodyResponsables'),
    btnAsignar=$('#btnAsignar');
    var btnConsulta=$('#btnConsulta'),
    btnEditar=$('#btnEditar'),
    btnAgregar=$('#btnAgregar');
    var pnlAgregar=$('#pnlAgregar'),
    pnlConsulta=$('#pnlConsulta');

var tbodyConsulta=$('#tbodyConsulta'),
btnEnviar=$('#btnEnviar'),
btnImprimir=$('#btnImprimir'),
btnEnviarA=$('#btnEnviarA'),
txtPeriodo=$('#txtPeriodo'),
textFecha=$('#textFecha');
    /******/
    var tblEditAs   = $('#tblEditAs'),
        tbodyEditAs = $('#tbodyEditAs');

    var txtNombreFuenteE = $('#txtNombreFuenteE'),
        txtIdAsignacionE = $('#txtIdAsignacionE'),
        slctRepresentanteE = $('#slctRepresentanteE'),
        slctPeriodoE = $('#slctPeriodoE'),
        txtIdFuenteE=$('#txtIdFuenteE'),
        formEditarServE= $('#formEditarServE'),
        btnGuardarE    = $('#btnGuardarE'),
        btnCancelarE   = $('#btnCancelarE');

function getActivoFuentes(){

  var datos = $.ajax({
    url: 'getActivoFuentes',
    type: 'post',
        dataType:'json',
        async:false
    }).error(function(e){
        alert('Ocurrio un error, intente de nuevo');
    }).responseText;

    var res,i=0;
    try{
        res = JSON.parse(datos);
    }catch (e){
        alert('Error JSON ' + e);
    }

    if ( res.status === 'OK' ){
      $.each(res.data, function(k,o){
        idFue[i]=o.fueId;
        tbodyFuentes.append(
          '<tr><td>'+o.fueNombre+'</td> </tr>'
        );
      i++;
      });
    }else{
      tbodyServicios.html('<tr><td colspan="8" class="center"><h3>'+ res.message +'</h3></td></tr>');
    }
    tblServicios.removeClass('hidden');
}

function getActivoResponsablesA(){
  var datos = $.ajax({
    url: 'getActivoResponsables',
    type: 'post',
        dataType:'json',
        async:false
    }).error(function(e){
        alert('Ocurrio un error, intente de nuevo');
    }).responseText;

    var res,i=0;
    try{
        res = JSON.parse(datos);
    }catch (e){
        alert('Error JSON ' + e);
    }

    slctRepresentante.html('');
    if ( res.status === 'OK' ){
      $.each(res.data, function(k,o){
        idRes[i]=o.resId;
        slctRepresentante.append(
          '<option value='+o.resId+'>'+o.resNombre+' </option>'
        );
        i++;
      });

    }else{
      slctRepresentante2.append(
        '<option >'+res.message +' </option>'
      );
    }
}

function getPeriodoActivoA(){
  var datos = $.ajax({
    url: 'getPeriodoActivo',

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

    slctPeriodo.html('');
    if ( res.status === 'OK' ){
       var i = 1;
      $.each(res.data, function(k,o){

        slctPeriodo.append(
          '<option value='+o.perId+'>'+o.perInicio+'  || '+o.perFin+'</option>'
        );

      i++;
      });
    }else{
      tbodyServicios.html('<tr><td colspan="8" class="center"><h3>'+ res.message +'</h3></td></tr>');
    }

}

function ingresoAsignacion(){
  var idPeriodo=slctPeriodo.val();
  var idFuente=0, idResponsable=0, nFue=idFue.length, tot=0;

  for (var i = 0; i < nFue; i++) {
    idFuente = idFue[i];
    idResponsable = idResFin[i];

    var editar = $.ajax({
      url: 'ingresoAsignacion',
      data: {
        token: 123,
        f:idFuente,
        r:idResponsable,
        p:idPeriodo
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
        tot++;
      }
      else{
        alert(resultado.message);
      }
  }
  if (tot==nFue) {

    swal({
      title: "Asignación Correcta.",
      text: "Se asignaron los períodos correctamente.",
      timer: 2000,
      type: "success",
      showConfirmButton: true
    });
  }

}


function asignar(){
  btnGuardar.prop('disabled',false);

  var nFuentes=idFue.length,
  nResponsables=idRes.length,
  select = document.getElementById("slctRepresentante"),
  j=select.selectedIndex;

  tbodyResponsables.html('');
  for (var i = 0; i < nFuentes; i++) {
    if (j>=nResponsables) {
      j=0;
    }

    idResn=idRes[j];
    idResSelect=idResn-1;

    var resNombre= select.options[idResSelect].text;
    tbodyResponsables.append(
      '<tr><td>'+resNombre+'</td> </tr>'
    );
    idResFin[i]=idResn;
    j++;

  }
}

function cancelar(){
  tblServicios.removeClass('hidden');
  formEditarServ.addClass('hidden');
  txtNombreFuente.val('');
  pnlInicio.addClass('hidden');

  tblEditAs.removeClass('hidden');
  formEditarServE.addClass('hidden');
  txtNombreFuenteE.val('');
}

function editarAsignacion(){
  var datos = $.ajax({
    url: 'editarAsignacion',
    data: {
      token: token.val(),
      f:txtIdFuenteE.val(),
      r:slctRepresentanteE.val(),
      a:txtIdAsignacionE.val()
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

    tbodyEditAs.html('');
    if ( res.status === 'OK' ){
      limpiar();
      swal({
        title: "Información actualizada.",
        type: "success",
        showConfirmButton: true
      });

    }
    else
    alert(res.message);
}

function getActivoResponsables(){
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
    slctRepresentanteE.html('');
    if ( res.status === 'OK' ){
       var i = 1;


      $.each(res.data, function(k,o){

        slctRepresentanteE.append(
          '<option value='+o.resId+'>'+o.resNombre+' </option>'
        );

      });
    }else{
      slctRepresentanteE.append(
        '<option >'+res.message +' </option>'
      );
    }
}

function editar(){
  formEditarServE.removeClass("hidden");
  tblEditAs.addClass("hidden");
  getActivoResponsables();

  swal({
        title: "Información.",
        text: "La actualización solo aplicara para el registro seleccionado.",
        timer: 2100,
        type: "success",
        showConfirmButton: true
      });

  var id = $(this).attr('id');

  var datos = $.ajax({
    url: 'getAsignacion',
    data:{
      i:id
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

    txtNombreFuenteE.html('');
    if ( res.status === 'OK' ){
       var i = 1;
      $.each(res.data, function(k,o){
        txtIdAsignacionE.val(o.asiId);

        slctRepresentanteE.find('option').each(function(){
        if ( o.asiResponsables == $(this).val() )
        slctRepresentanteE.val(o.asiResponsables);
        });
      //  alert("res");
      txtIdFuenteE.val(o.fueId);
    txtNombreFuenteE.val(o.fueNombre);
      });
    }else{
      slctRepresentanteE.append(
        '<option >'+res.message +' </option>'
      );
    }
}

function getPeriodoActivo(){
  var datos = $.ajax({
    url: 'getPeriodoActivo',

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

    slctPeriodoE.html('');
    slctPeriodoE.append(
      '<option >Seleccione período</option>'
    );

    if ( res.status === 'OK' ){
       var i = 1;
      $.each(res.data, function(k,o){

        slctPeriodoE.append(
          '<option value='+o.perId+'>'+o.perInicio+'  || '+o.perFin+'</option>'
        );

      i++;
      });
    }else{
      tbodyEditAs.html('<tr><td colspan="8" class="center"><h3>'+ res.message +'</h3></td></tr>');
    }
    tbodyEditAs.removeClass('hidden');
}
function getAsignaciones(idPeriodo){
  var datos = $.ajax({
    url: 'getAsignaciones',
    data:{
      i:idPeriodo
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

    tbodyEditAs.html('');
    if ( res.status === 'OK' ){
       var i = 1;
      $.each(res.data, function(k,o){

        tbodyEditAs.append(
          '<tr>'+
            '<td class="text-center">'+i+'</td>'+
            '<td class="text-center">'+o.fueNombre+'</td>'+
            '<td class="text-center">'+o.resNombre+'</td>'+
            '<td class="text-center">'+
              '<span class="glyphicon glyphicon-edit text-primary" id="'+o.asiId+'" '+
              'style="cursor:pointer" title="Editar"></span>'+
            '</td>'+
          '</tr>'
      );
      i++;
      });
    }else{
      tbodyEditAs.html('<tr><td colspan="8" class="center"><h3>'+ res.message +'</h3></td></tr>');
    }
    tblEditAs.removeClass('hidden');
}
function cambioSeleccion(){
  select0 = document.getElementById("slctPeriodoE").selectedIndex;
  select = select0+1;
  getAsignaciones(select);

  imprimir = document.getElementById('btnImprimir');
  imprimir.href='imprimirAsignaciones?ia='+select;

}

function enviarAsignaciones(){
  var datos = $.ajax({
    url: 'enviarAsignaciones',
    data:{
      i:slctPeriodoE.val()
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
      alert(res.message);
    }else{
      alert(res.message);
    }
}

function enviarAsignacionesA(){
  var datos = $.ajax({
    url: 'enviarAsignacionesA',
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
      alert(res.message);
    }else{
      alert(res.message);
    }
}

function getAsignacionActual(){
  var editar = $.ajax({
    url: 'getAsignacionActual',
    type: 'get',
    dataType:'json',
      async:false
    }).error(function(e){
        alert('Ocurrio un error, intente de nuevo');
    }).responseText;

    var resultado;
    try{
      res = JSON.parse(editar);
    }catch (e){
        alert('Error JSON ' + e);
    }

    if ( res.status == 'OK' ){
    /*  swal({
        title: "Fuente agregada.",
        text: "Se agrego correctamente la asignación.",
        timer: 2000,
        type: "success",
        showConfirmButton: true
      });
*/
    tbodyConsulta.html('');

    var i = 1, periodo;
    $.each(res.data, function(k,o){
      periodo = o.perInicio+'  '+o.perFin;
      txtPeriodo.val(periodo);
      tbodyConsulta.append(
       '<tr>'+
         '<td class="text-center">'+i+'</td>'+
         '<td class="text-center">'+o.fueNombre+'</td>'+
         '<td class="text-center">'+o.resNombre+'</td>'+
       '</tr>'
     );
     i++;
    });


    }
    else{
      alert(resultado.message);
    }
}

/*****************/

function mostrarEditar(){
  pnlAgregar.addClass('hidden');
  pnlConsulta.addClass('hidden');
  tblServicios.removeClass('hidden');
  getPeriodoActivo();
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
  pnlInicio.addClass('hidden');
  getAsignacionActual();
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
  getPeriodoActivoA();
  getActivoResponsablesA();
  getActivoFuentes();
  pnlInicio.addClass('hidden');
  tblServicios.addClass('hidden');
  btnEditar.addClass('botonNoactivo');
  btnConsulta.addClass('botonNoactivo');
  btnAgregar.addClass('botonActivo');
  btnEditar.removeClass('botonActivo');
  btnConsulta.removeClass('botonActivo');
  btnAgregar.removeClass('botonNoactivo');
}
/****************/
function mostrarFecha(){
  var f = new Date();
  var fecha= " "+f.getFullYear() + " / " + (f.getMonth() +1) + " / " + f.getDate();
  textFecha.val(fecha);
}

$(document).on('ready', function(){
  mostrarFecha();
});
btnCancelar.on('click',cancelar);
btnGuardar.on('click',ingresoAsignacion);
btnAsignar.on('click',asignar);


btnEditar.on('click',mostrarEditar);
btnConsulta.on('click',mostrarConsulta);
btnAgregar.on('click',mostrarAgregar);
/***********/

tblEditAs.delegate('.glyphicon-edit', 'click', editar);
slctPeriodoE.change(cambioSeleccion);
btnCancelarE.on('click',cancelar);
btnGuardarE.on('click',editarAsignacion);
btnEnviar.on('click',enviarAsignaciones);
btnEnviarA.on('click',enviarAsignacionesA);
