var tbodyIngresados= $('#tbodyIngresados'),
tblFaltantes = $('#tblFaltantes'),
tbodyFaltantes= $('#tbodyFaltantes');
var txtHora=$('#txtHora'),
txtMinuto=$('#txtMinuto'),
idSesion=$('#idSesion'),
token=$('#token');
var textFecha=$('#textFecha'),
btnActualizarH=$('#btnActualizarH'),
btnEnviar=$('#btnEnviar');
var nIngresadas=[],
    totalFuentes=[],
    totalFaltantesR=[],
    resUnicosFaltantes=[];
var flagEnviar=0;

function getNoticiasIngresadas(){
  //alert("getNoticiasIngresadas");
  var k=0;
  var datos = $.ajax({
    url: 'getNoticiasIngresadas',
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

    tbodyIngresados.html('');
    if ( res.status === 'OK' ){
       var i = 1;
      $.each(res.data, function(k,o){

        tbodyIngresados.append(
          '<tr>'+
            '<td>'+i+'</td>'+
            '<td>'+o.fueNombre+'</td>'+
            '<td>'+o.resNombre+'</td>'+
          '</tr>'
      );
      nIngresadas[i]=o.fueId;

      i++;

      });
    }else{
      tbodyIngresados.html('<tr><td colspan="8" class="center"><h3>'+ res.message +'</h3></td></tr>');
    }
}

function getPeriodoResponsable(){
  //alert("sd");
  var datos = $.ajax({
    url: 'getPeriodoResponsable',
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
       var i = 0;
       var j=1;
      $.each(res.data, function(k,o){

        totalFuentes[i]= o.fueId;
        ingresado=0;
        existente= nIngresadas.indexOf(totalFuentes[i]);

        if (existente <= 0) {
          totalFaltantesR[j]= o.resId;
          //console.log(totalFaltantesR[j]);

          tbodyFaltantes.append(
            '<tr>'+
              '<td>'+j+'</td>'+
              '<td>'+o.fueNombre+'</td>'+
              '<td>'+o.resNombre+'</td>'+
              '<td><button id="'+o.resId+'" class="btn btn-primary btn-md"><i class="fa fa-paper-plane"></i> Enviar recordatorio</button></td>'+
            '</tr>'

        );
        j++;
        }
      i++;

      });

      var aux, nER=0, nF=totalFaltantesR.length;

      for (var n = 0; n < nF; n++) {
          aux=totalFaltantesR[n];
          encontrado=0;

          for (var i = 0; i < nF; i++) {
            if (totalFaltantesR[i] == aux) {

              for (var p = 0; p < resUnicosFaltantes.length; p++) {
                if (resUnicosFaltantes[p]==aux) {
                  encontrado=1;
                }
              }

              if (encontrado==0) {
                resUnicosFaltantes[nER]=aux;
                nER++;
              }

            }

          }

      }

    }
}

function enviarRecordatorio(){
  var idRepresentante = $(this).attr('id');
  enviarRecordatorioC(idRepresentante);
}
function enviarAhoraAutomatico(){
  for (var i = 1; i < resUnicosFaltantes.length; i++) {
    var idRepresentante=resUnicosFaltantes[i];
    enviarRecordatorioC(idRepresentante);
    //console.log(idRepresentante);

  }
}

function enviarRecordatorioC(idRepresentante){
//  var idRepresentante = $(this).attr('id');

  var datos = $.ajax({
    url: 'enviarRecordatorio',
    data:{
      i:idRepresentante
    },
    type:'post',
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
      swal({
        title: "Correo enviado exitosamente.",
        text: "Se envío un correo con recordatorio los integrantes del equipo.",

        type: "success",
        showConfirmButton: true
      });

    }else{
      alert("err");
    }
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

function enviarAhora(){
  var datos = $.ajax({
    url: 'enviarAhora',
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


function mostrarFecha(){
  var f = new Date();
  var fecha= " "+f.getDate() + " / " + (f.getMonth() +1) + " / " + f.getFullYear();
  textFecha.val(fecha);
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

     if (flagEnviar==0) {
       flagEnviar=1;
       enviarAhoraAutomatico();
     }

   }
   else {
     $('#restante').removeClass('rojo');
   }
  document.getElementById("restante").innerHTML = horasT+':'+minutosT;
}

function cambioMinuto(){
  swal({
    title: "¿Desea guardar las modificaciones para los minutos?",
    text: "",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Sí, realizar cambios",
    closeOnConfirm: false
  },
  function(){
    editarHora();
  });
}
function cambioHora(){
  swal({
    title: "¿Desea guardar las modificaciones para la hora?",
    text: "",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Sí, realizar cambios",
    closeOnConfirm: false
  },
  function(){
    editarHora();
  });
}
$(document).on('ready', function(){
  mostrarFecha();
  getHora();
  getNoticiasIngresadas();
  getPeriodoResponsable();
  setInterval(muestraReloj, 1000);
});
tblFaltantes.delegate('.btn-primary', 'click', enviarRecordatorio);

btnActualizarH.on('click',editarHora);
btnEnviar.on('click',enviarAhora);

txtMinuto.change(cambioMinuto);
txtHora.change(cambioHora);
