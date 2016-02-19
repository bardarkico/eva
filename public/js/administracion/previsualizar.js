var tblPreliminar=$('#tblPreliminar'),
    tbodyPreliminar=$('#tbodyPreliminar'),
    tblPreliminar=$('#tblPreliminar');

var txtFuentesE=$('#txtFuentesE'),
txtTDofE=$('#txtTDofE'),
txtNDofE=$('#txtNDofE'),
chkDofE=$('#chkDofE');

var btnCalcelarDofE=$('#btnCalcelarDofE'),
btnEditar=$('#btnEditar');

var pnlPrevisualizar=$('#pnlPrevisualizar'),
pnlEditar=$('#pnlEditar');

var txtHora=$('#txtHora'),
txtMinuto=$('#txtMinuto'),
btnActualizarH=$('#btnActualizarH'),
idSesion=$('#idSesion'),
textFecha=$('#textFecha'),
token=$('#token');
var envio=0;

function getNoticiasPrev(){
  var datos = $.ajax({
      url: 'getNoticiasPrev',
      data:{
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
      }catch (e){
          alert('Error JSON ' + e);
      }

      if ( res.status === 'OK' ){
        var i = 1;
        tbodyPreliminar.html('');
        $.each(res.data, function(k,o){

          tbodyPreliminar.append(
            '<tr>'+
            '<td>'+o.fueNombre+'</td>'+
            '<td>'+o.notTitulo+'</td>'+
            '<td>'+o.notContenido+'</td>'+
            '<td class="text-center">'+o.resNombre+'</td>'+
            '<td class="text-center">'+
              '<span class="glyphicon glyphicon-edit text-primary" id="'+o.notId+'" '+
              'style="cursor:pointer" title="Editar contenidos"></span>'+
            '</td>'+
            '<td class="text-center">'+
              '<span class="glyphicon glyphicon-trash text-danger" id="'+o.notId+'" '+
              'style="cursor:pointer" title="Eliminar noticia"></span>'+
            '</td>'+
          '</tr>'
          );

        i++;
      });
      }else{
          tbodyPreliminar.html('<tr><td colspan="8" class="center"><h3>'+ res.message +'</h3></td></tr>');
      }
}

function seleccionarNoticia(){
  pnlPrevisualizar.addClass("hidden");
  pnlEditar.removeClass("hidden");
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
        txtFuentesE.val(o.notFuente);

        txtTDofE.val(o.notTitulo);
        txtNDofE.val(o.notContenido);
      });
    }else{
      alert(res.message);
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

function editarNot(){
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
      f: txtFuentesE.val()
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
      swal({
        title: "Información actualizada.",
        text: res.message,
        type: "success",
        showConfirmButton: true
      });
    }else{
      alert(res.message);
    }
      location.reload();
}

function cancelarE(){
  txtTDofE.val('');
  txtNDofE.val('');
  pnlPrevisualizar.removeClass("hidden");
  pnlEditar.addClass("hidden");
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
        tiempo=o.admHora;
      });
      hora=tiempo.split(":",1);
      minuto=tiempo.substring(5,3);
      txtHora.val(hora);
      txtMinuto.val(minuto);
    }else{
      alert(res.message);
    }
}

function editarHora(){
  tiempo= txtHora.val()+":"+txtMinuto.val()+":00";

  var datos = $.ajax({
    url: 'editarHora',
    data: {
      i: idSesion.val(),
      t:tiempo,
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

    if ( res.status === 'OK' ){
      swal({
        title: "Información actualizada.",
        text: res.message,
        timer: 2000,
        type: "success",
        showConfirmButton: true
      });
      getHora();
    }else{
      alert(res.message);
    }
}


function muestraReloj() {
  var fechaHora = new Date();
  var horas = fechaHora.getHours();
  var minutos = fechaHora.getMinutes();
  var segundos = fechaHora.getSeconds();

  if(horas < 10) { horas = '0' + horas; }
  if(minutos < 10) { minutos = '0' + minutos; }
  if(segundos < 10) { segundos = '0' + segundos; }

  document.getElementById("reloj").innerHTML = horas+':'+minutos+':'+segundos;

  minutosR=txtMinuto.val();
  horasR=txtHora.val();



  transcurridoMinutos = minutosR - minutos;
  transcurridoHoras = horasR - horas;

   if (transcurridoMinutos < 0) {
     transcurridoHoras--;
     transcurridoMinutos = 60 + transcurridoMinutos;
   }

   horasT = transcurridoHoras.toString();
   minutosT = transcurridoMinutos.toString();

   if (horasT.length < 2) {
     horasT = "0"+horasT;
   }

   if (minutosT.length < 2) {
     minutosT = "0"+minutosT;
   }

   if ((transcurridoMinutos <= 30) && (transcurridoHoras == 0)) {
     $('#restante').addClass('ambar');
   }
   else {
     $('#restante').removeClass('ambar');
   }
   if ((transcurridoMinutos <= 15) && (transcurridoHoras == 0)) {
     $('#restante').addClass('rojo');
   }
   else {
     $('#restante').removeClass('rojo');
   }
  document.getElementById("restante").innerHTML = horasT+':'+minutosT;
}


function mostrarFecha(){
  var f = new Date();
  var fecha= " "+f.getDate() + " / " + (f.getMonth() +1) + " / " + f.getFullYear();
  textFecha.val(fecha);
}

$(document).on('ready', function(){
  getHora();
  mostrarFecha();
  getNoticiasPrev();
  setInterval(muestraReloj, 1000);
});

btnActualizarH.on('click',editarHora);

tblPreliminar.delegate('.glyphicon-edit', 'click', seleccionarNoticia);
tblPreliminar.delegate('.glyphicon-trash', 'click', eliminarNoticia);
btnCalcelarDofE.on('click',cancelarE);
btnEditar.on('click',editarNot);
