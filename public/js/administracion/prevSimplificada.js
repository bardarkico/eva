var tbodyPreliminar=$('#tbodyPreliminar');

var txtHora=$('#txtHora'),
txtMinuto=$('#txtMinuto'),
btnActualizarH=$('#btnActualizarH'),
idSesion=$('#idSesion'),
textFecha=$('#textFecha'),
token=$('#token');

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


function getPrevSimplificada(){
  var datos = $.ajax({
      url: 'getPrevSimplificada',
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
            '<td>'+o.notContenido+' ...</td>'+
            '<td class="text-center">'+o.resNombre+'</td>'+
            '<td class="text-center">'+o.notFecha+'</td>'+
          '</tr>'
          );

        i++;
      });
      }else{
          tbodyPreliminar.html('<tr><td colspan="8" class="center"><h3>'+ res.message +'</h3></td></tr>');
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
  getPrevSimplificada();
  getHora();
  mostrarFecha();
  setInterval(muestraReloj, 1000);
});

btnActualizarH.on('click',editarHora);
