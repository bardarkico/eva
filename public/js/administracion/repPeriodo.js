var idSesion=$('#idSesion'),
token=$('#token'),
tbodyRep=$('#tbodyRep'),
btnSeleccionar=$('#btnSeleccionar');

var txtFechaFin=$('#txtFechaFin'),
txtFechaInicio=$('#txtFechaInicio'),
txtDias=$('#txtDias');

function repPeriodo(){
  var datos = $.ajax({
      url: 'repPeriodo',
      data:{
        fi:txtFechaInicio.val(),
        ff:txtFechaFin.val(),
        token:"token.val()"
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
        tbodyRep.html('');
        $.each(res.data, function(k,o){

          tbodyRep.append(
            '<tr>'+
            '<td>'+o.fueNombre+'</td>'+
            '<td>'+o.notTitulo+'</td>'+
            '<td>'+o.notContenido+'</td>'+
            '<td>'+o.notFecha+'</td>'+
            '<td class="text-center">'+o.resNombre+'</td>'+
            '</tr>'
          );

        i++;
      });
      }else{
          tbodyRep.html('<tr><td colspan="8" class="center"><h3>'+ res.message +'</h3></td></tr>');
      }
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

btnSeleccionar.on('click',repPeriodo);
