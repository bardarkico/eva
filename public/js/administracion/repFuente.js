var idSesion=$('#idSesion'),
token=$('#token'),
tbodyRep=$('#tbodyRep'),
btnSeleccionar=$('#btnSeleccionar'),
btnImprimir=$('#btnImprimir'),
chkTodos=$('#chkTodos');

var txtFechaFin=$('#txtFechaFin'),
txtFechaInicio=$('#txtFechaInicio');

var slctFuentes=$('#slctFuentes'),
slctFuentes2=$('#slctFuentes2'),
slctFuentes3=$('#slctFuentes3'),
slctFuentes4=$('#slctFuentes4'),
slctFuentes5=$('#slctFuentes5'),
slctFuentes6=$('#slctFuentes6');

function getTodosFuentesConsultas(){
  var datos = $.ajax({
    url: 'getTodosFuentes',
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

    slctFuentes.html('');
    slctFuentes2.html('');
    slctFuentes3.html('');
    slctFuentes4.html('');
    slctFuentes5.html('');


    slctFuentes.append(
      '<option>Selecionar fuente de información</option>'
    );
    slctFuentes2.append(
      '<option>Selecionar fuente de información</option>'
    );
    slctFuentes3.append(
      '<option>Selecionar fuente de información</option>'
    );
    slctFuentes4.append(
      '<option>Selecionar fuente de información</option>'
    );
    slctFuentes5.append(
      '<option>Selecionar fuente de información</option>'
    );
    slctFuentes6.append(
      '<option>Selecionar fuente de información</option>'
    );

    if ( res.status === 'OK' ){
       var i = 1;
      $.each(res.data, function(k,o){

        slctFuentes.append(
          '<option value='+o.fueId+'>'+o.fueNombre+' </option>'
        );
        slctFuentes2.append(
          '<option value='+o.fueId+'>'+o.fueNombre+' </option>'
        );
        slctFuentes3.append(
          '<option value='+o.fueId+'>'+o.fueNombre+' </option>'
        );
        slctFuentes4.append(
          '<option value='+o.fueId+'>'+o.fueNombre+' </option>'
        );
        slctFuentes5.append(
          '<option value='+o.fueId+'>'+o.fueNombre+' </option>'
        );
        slctFuentes6.append(
          '<option value='+o.fueId+'>'+o.fueNombre+' </option>'
        );

      });
    }else{
      slctFuentes.html('<tr><td colspan="8" class="center"><h3>'+ res.message +'</h3></td></tr>');
    }
}

function repFuente(select,select2,select3,select4,select5,select6){
  var datos = $.ajax({
      url: 'repFuente',
      data:{
        i:select,
        i2:select2,
        i3:select3,
        i4:select4,
        i5:select5,
        i6:select6,
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

function repFuentePer(select,select2,select3,select4,select5,select6){
  var datos = $.ajax({
      url: 'repFuentePer',
      data:{
        fi:txtFechaInicio.val(),
        ff:txtFechaFin.val(),
        i:select,
        i2:select2,
        i3:select3,
        i4:select4,
        i5:select5,
        i6:select6,
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

function verificarTodos(){
  select = document.getElementById("slctFuentes").selectedIndex;
  select2 = document.getElementById("slctFuentes2").selectedIndex;
  select3 = document.getElementById("slctFuentes3").selectedIndex;
  select4 = document.getElementById("slctFuentes4").selectedIndex;
  select5 = document.getElementById("slctFuentes5").selectedIndex;
  select6 = document.getElementById("slctFuentes6").selectedIndex;

  if (chkTodos.prop('checked')) {
    repFuente(select,select2,select3,select4,select5,select6);
  }
  else{
    repFuentePer(select,select2,select3,select4,select5,select6);
  }
}

function todoPeriodo(){
  if (chkTodos.prop('checked')) {
      txtFechaInicio.attr('disabled',true);
      txtFechaFin.attr('disabled',true);
      txtFechaInicio.val('');
      txtFechaFin.val('');
  }
  else {
    txtFechaInicio.attr('disabled',false);
    txtFechaFin.attr('disabled',false);
  }
}

function generarPdfRepFuente(){
  select = document.getElementById("slctFuentes").selectedIndex;
  if (chkTodos.prop('checked')) {
    repFuente(select);
  }
  else{
    repFuentePer(select)
  }
}

$(document).on('ready', function(){
  getTodosFuentesConsultas();
});

btnImprimir.on('click',generarPdfRepFuente);
btnSeleccionar.on('click',verificarTodos);
chkTodos.on('click',todoPeriodo);
