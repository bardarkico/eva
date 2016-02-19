var txtNDof=$('#txtNDof'),
txtnGDf=$('#txtnGDf'),
token=$('#token');

var idSesion=$('#idSesion');
var txtTDof=$('#txtTDof');
var tblN=$('#tblN'),
tbodyN=$('#tbodyN');

var chkDof=$('#chkDof');

var btnAgregarDof=$('#btnAgregarDof'),
btnFinalizarDof=$('#btnFinalizarDof'),
btnAnteriorDof=$('#btnAnteriorDof'),
btnSiguienteDof=$('#btnSiguienteDof'),
btnEliminarDof=$('#btnEliminarDof'),
btnEditarDof=$('#btnEditarDof');
txtNumDof=$('#txtNumDof');

var bdyDof=$('#bdyDof');
var notSinFinalizar=[],
btnFinalizar=$('#btnFinalizar');
var idNot=0;

var slctFuentes=$('#slctFuentes');

var slctFuentesE=$('#slctFuentesE'),
btnAgregarDofE=$('#btnAgregarDofE'),
txtTDofE=$('#txtTDofE'),
txtNDofE=$('#txtNDofE'),
chkDofE=$('#chkDofE'),
chkPublic=$('#chkPublic'),
chkPublicE=$('#chkPublicE');

var pnlDof=$('#pnlDof'),
pnlEditar=$('#pnlEditar'),
btnCalcelarDofE=$('#btnCalcelarDofE'),
btnEditar=$('#btnEditar');

var txtHora=$('#txtHora'),
txtMinuto=$('#txtMinuto'),
myTab=$('#myTab');


function ingresoNoticia(){
  var titulos, contenidos, fuente=slctFuentes.val();
  var total=0;
  if( chkDof.prop('checked') ) {
    titulos="Sin Información relevante";
    contenido="";
  }
  else if (chkPublic.prop('checked')) {
    titulos="Sin Publicación";
    contenido="";
  }
  else{
      titulos= txtTDof.val();
      contenido= txtNDof.val();
  }
  //alert(txtnGDf.val());
  ingresoBD(titulos, contenido, fuente);

  getNoticiasSesion();
}


function ingresoBD(titulo, contenido, fuente){
  var total=0;
  var resultadoIn;

  var ingreso = $.ajax({
    url: 'ingresoNoticia',
    data: {
      token: 15,
      t: titulo,
      c: contenido,
      f: fuente,
      i:idSesion.val()
    },
    type: 'post',
    dataType:'json',
      async:false
    }).error(function(e){
        alert('Ocurrio un error, intente de nuevo');
    }).responseText;

    var resultado;
    try{
      resultado = JSON.parse(ingreso);
    }catch (e){
        alert('Error JSON ' + e);
    }

    if ( resultado.status == 'OK' ){
      //resultadoIn = "noticia agregada";
      //alert("Noticia Agregada");
      swal({
        title: "Noticia agregada.",
        text: "Se agrego correctamente la noticia.",
        timer: 2000,
        type: "success",
        showConfirmButton: true
      });
      txtTDof.val('');
      txtNDof.val('');

    }
    else{
      alert(resultado.message);
      //resultadoIn = resultado.message;
    }

  //  return resultado;
}


function limpiar(){
  txtTDof.val('');
  txtNDof.val('');

}

/*function verificarDof(){
  titulo = txtTDof.val();
  noticia= txtNDof.val();
  if (((titulo != "")&&(noticia != ""))||((titulo == null)&&(noticia == null))) {
    btnEliminarDof.prop("disabled",false);
    btnEditarDof.prop("disabled",false);
  }
  else{
    btnEliminarDof.prop("disabled",true);
    btnEditarDof.prop("disabled",true);
  }
}*/

function getNoticiasSesion(){
  var datos = $.ajax({
      url: 'getNoticiasSesion',
      data:{
        token:156,
        i:idSesion.val()
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

      if ( res.status === 'OK' ){
        var i = 1;
        tbodyN.html('');
        $.each(res.data, function(k,o){

          notSinFinalizar[i]=o.notId;

          tbodyN.append(
            '<tr>'+
            '<td>'+o.fueNombre+'</td>'+
            '<td>'+o.notTitulo+'</td>'+
            '<td>'+o.notContenido+'</td>'+
            '<td class="text-center">'+
              '<span class="glyphicon glyphicon-trash text-danger" id="'+o.notId+'" '+
              'style="cursor:pointer" title="Eliminar noticia"></span>'+
            '</td>'+
            '<td class="text-center">'+
              '<span class="glyphicon glyphicon-edit text-primary" id="'+o.notId+'" '+
              'style="cursor:pointer" title="Editar contenidos"></span>'+
            '</td>'+

          '</tr>'
          );

        i++;
      });
          }else{
        tbodyServicios.html('<tr><td colspan="8" class="center"><h3>'+ res.message +'</h3></td></tr>');
      }
}

function getFuentesSesion(){
var datos = $.ajax({
    url: 'getFuentesSesion',
    data:{
      i:idSesion.val()
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

    if ( res.status === 'OK' ){
      var i = 1;
      $.each(res.data, function(k,o){

      slctFuentes.append(
      '<option value='+o.fueId+'> <strong>'+o.fueNombre+'</strong> </option>'
      );

      slctFuentesE.append(
      '<option value='+o.fueId+'> <strong>'+o.fueNombre+'</strong> </option>'
      );

      i++;
    });
        }else{
      tbodyServicios.html('<tr><td colspan="8" class="center"><h3>'+ res.message +'</h3></td></tr>');
    }
    tblServicios.removeClass('hidden');
}




function seleccionarNoticia(){

  tblN.addClass("hidden");
  pnlDof.addClass("hidden");
  pnlEditar.removeClass("hidden");
  myTab.addClass("hidden");


  idNot= $(this).attr('id');
  var datos = $.ajax({
    url: 'getNoticia',
    data:{
      token:156,
      i:idNot
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

    if ( res.status === 'OK' ){
       var i = 1;
      $.each(res.data, function(k,o){

        var str1="Sin Información relevante";
        var n = str1.localeCompare(o.notTitulo);
        if (n==0) {
          chkDofE.prop('checked',true);
        }
        else{
          chkDofE.prop('checked',false);
        }
        desactivarDofE();

        slctFuentesE.find('option').each(function(){
        if ( o.notFuente == $(this).val() )
        slctFuentesE.val(o.notFuente);
        });
        txtTDofE.val(o.notTitulo);
        txtNDofE.val(o.notContenido);
      });
    }else{
      alert(res.message);
    }
}


function cancelarE(){
  txtTDofE.val('');
  txtNDofE.val('');
  tblN.removeClass("hidden");
  pnlDof.removeClass("hidden");
  pnlEditar.addClass("hidden");
  myTab.removeClass("hidden");

}

function editarNot(){

  if ((!chkPublicE.is(":checked")) && (!chkPublicE.is(":checked")) && (txtTDofE.val()=="")&& (txtNDofE.val()=="")) {
    swal({
        title: "Campos Vacios.",
        text: "Debe seleccionar una opción o llenar los campos.",
        timer: 2000,
        type: "error",
        showConfirmButton: true
      });
  }
  else {

        var titulos, contenido;
        if( chkDofE.prop('checked') ) {
          titulos="Sin Información relevante";
          contenido="";
        }
        else{
            titulos= txtTDofE.val();
            contenido= txtNDofE.val();
        }

        var ingreso = $.ajax({
          url: 'editarNot',
          data: {
            token: 15,
            i: idNot,
            t: titulos,
            c: contenido,
            f: slctFuentesE.val()
          },
          type: 'post',
          dataType:'json',
            async:false
          }).error(function(e){
              alert('Ocurrio un error, intente de nuevo');
          }).responseText;

          var resultado;
          try{
            resultado = JSON.parse(ingreso);
          }catch (e){
              alert('Error JSON ' + e);
        }
        alert(resultado.message);

        location.reload();
      }
}

function eliminarNoticia(){
  var id = $(this).attr('id');
  var datos = $.ajax({
    url: 'elimiarNoticia',
    data:{
      token:156,
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

    alert(res.message);

    location.reload()
}



function getHora(){
  var datos = $.ajax({
    url: 'getHora',
    type: 'get',
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

    if ( res.status === 'OK' ){

      $.each(res.data, function(k,o){
        /*alert(o.admHora);*/
        tiempo=o.admHora;
      });
      hora=tiempo.split(":",1);
      minuto=tiempo.substring(5,3);
      txtHora.val(hora);
      txtMinuto.val(minuto);
      /*alert(hora);
      alert(minuto);*/
    }else{
      alert(res.message);
    }
}

function restarHoras() {

/*  inicio = document.getElementById("inicio").value;
  fin = document.getElementById("fin").value;
  inicioMinutos = parseInt(inicio.substr(3,2));
  inicioHoras = parseInt(inicio.substr(0,2));
  finMinutos = parseInt(fin.substr(3,2));
  finHoras = parseInt(fin.substr(0,2));*/

  transcurridoMinutos = finMinutos - inicioMinutos;
  transcurridoHoras = finHoras - inicioHoras;

  if (transcurridoMinutos < 0) {
    transcurridoHoras--;
    transcurridoMinutos = 60 + transcurridoMinutos;
  }

  horas = transcurridoHoras.toString();
  minutos = transcurridoMinutos.toString();

  if (horas.length < 2) {
    horas = "0"+horas;
  }

  if (minutos.length < 2) {
    minutos = "0"+horas;
  }
//  document.getElementById("resta").value = horas+":"+minutos;
  alert(resta);
}



function desactivarDof(){
    var bdyDof=$('#bdyDof') ;

    if( chkDof.prop('checked') ) {
      txtTDof.prop('disabled', true);
      txtNDof.prop('disabled', true);
      chkPublic.prop('checked', false);
    }
    else{
      txtTDof.prop('disabled', false);
      txtNDof.prop('disabled', false);
    }
}
function desactivarPublicacion(){
    var bdyDof=$('#bdyDof') ;

    if( chkPublic.prop('checked') ) {
      txtTDof.prop('disabled', true);
      txtNDof.prop('disabled', true);
      chkDof.prop('checked', false);
    }
    else{
      txtTDof.prop('disabled', false);
      txtNDof.prop('disabled', false);

    }
}


function desactivarDofE(){
    var bdyDofE=$('#bdyDofE') ;

    if( chkDofE.prop('checked') ) {
      txtTDofE.prop('disabled', true);
      txtNDofE.prop('disabled', true);
      chkPublicE.prop('checked', false);
    }
    else{
      txtTDofE.prop('disabled', false);
      txtNDofE.prop('disabled', false);
    }
}  //FALTABA ESTA LLAVE  +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

function desactivarPublicacionE(){
    var bdyDof=$('#bdyDof') ;

    if( chkPublicE.prop('checked') ) {
      txtTDofE.prop('disabled', true);
      txtNDofE.prop('disabled', true);
      chkDofE.prop('checked', false);
    }
    else{
      txtTDofE.prop('disabled', false);
      txtNDofE.prop('disabled', false);

    }
}

function actualizarFinalizar(ide){
  var t=0;
  var ingreso = $.ajax({
    url: 'finalizarNot',
    data: {
    //  id: ,
      iN: ide,
      token: "1ll5"

    },
    type: 'post',
    dataType:'json',
      async:false
    }).error(function(e){
        alert('Ocurrio un error, intente de nuevo');
    }).responseText;

    var resultado;
    try{
      res = JSON.parse(ingreso);
    }catch (e){
        alert('Error JSON ' + e);
  }

  if ( res.status === 'OK' ){
    t++;
  }
  return t;
}

function ejecutarFinalizar(){
  var total=0;
  var nSFinalizar=notSinFinalizar.length;
  if (nSFinalizar != 0) {




  for (var i = 1; i < notSinFinalizar.length; i++) {
    var iNot=notSinFinalizar[i];

    r=actualizarFinalizar(iNot);

    if ( r == 1 ){
      total++;
    }

  }

  if (total > 0) {
    swal({
      title: "Sesión finalizada.",
      text: "Se finalizo correctamente su sesión.",
      timer: 2000,
      type: "success",
      showConfirmButton: true
    });
    location.reload();
  }
  else {
    alert("Ocurrio un error al finalizar sesión.")
  }

}
else {
  alert("Ya ha finalizado sesión");
}


}

function finalizarNot(){

  swal({
  title: "¿Está seguro de finalizar?",
  text: "Una vez finalizando las noticias se enviarán y usted no podrá editarlas",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Sí, finalizar",
  closeOnConfirm: false
},
function(){
  ejecutarFinalizar();
});


  }


$(document).on('ready', function(){
    getFuentesSesion();
    desactivarDof();

    getNoticiasSesion();

    chkDof.prop('checked', false );

    txtNumDof.val(0);

    txtTDofE.val('');
    txtNDofE.val('');
    txtTDof.val('');
    txtNDof.val('');
  });

btnAgregarDof.on('click',ingresoNoticia);

chkDof.on('click',desactivarDof);
chkPublic.on('click',desactivarPublicacion);

chkDofE.on('click',desactivarDofE);
chkPublicE.on('click',desactivarPublicacionE);

btnCalcelarDofE.on('click',cancelarE);
btnEditar.on('click',editarNot);
btnFinalizar.on('click',finalizarNot);

tblN.delegate('.glyphicon-edit', 'click', seleccionarNoticia);
tblN.delegate('.glyphicon-trash', 'click', eliminarNoticia);
