var idSesion=$('#idSesion'),
token=$('#token'),
tbodyRep=$('#tbodyRep'),
btnSeleccionar=$('#btnSeleccionar'),
btnImprimir=$('#btnImprimir'),
chkTodos=$('#chkTodos');

var txtFechaFin=$('#txtFechaFin'),
txtFechaInicio=$('#txtFechaInicio'),
txtDias=$('#txtDias');

var slctRepresentante=$('#slctRepresentante');

function getTodosResponsables(){
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

    slctRepresentante.html('');
    slctRepresentante.append(
    '<option></option>'
  );
    if ( res.status === 'OK' ){
       var i = 1;
      $.each(res.data, function(k,o){
        slctRepresentante.append(
          '<option value= '+o.resId+'>'+o.resNombre+' </option>'
        );

      });

    }else{
      slctRepresentante.append(
        '<option >'+res.message +' </option>'
      );
    }
}


function repRepre(select){
  var datos = $.ajax({
      url: 'repRepre',
      data:{
        i:select,
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
        tbodyRep.html('');
        $.each(res.data, function(k,o){

          tbodyRep.append(
            '<tr>'+
            '<td class="text-center">'+o.resNombre+'</td>'+
            '<td>'+o.fueNombre+'</td>'+
            '<td>'+o.notTitulo+'</td>'+
            '<td>'+o.notContenido+'</td>'+
            '<td>'+o.notFecha+'</td>'+

            '</tr>'
          );

        i++;
      });
      }else{
          tbodyRep.html('<tr><td colspan="8" class="center"><h3>'+ res.message +'</h3></td></tr>');
      }
}

function repReprePer(select){
  var datos = $.ajax({
      url: 'repReprePer',
      data:{
        fi:txtFechaInicio.val(),
        ff:txtFechaFin.val(),
        i:select,
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
        tbodyRep.html('');
        $.each(res.data, function(k,o){

          tbodyRep.append(
            '<tr>'+
            '<td class="text-center">'+o.resNombre+'</td>'+
            '<td>'+o.fueNombre+'</td>'+
            '<td>'+o.notTitulo+'</td>'+
            '<td>'+o.notContenido+'</td>'+
            '<td>'+o.notFecha+'</td>'+

            '</tr>'
          );

        i++;
      });
      }else{
          tbodyRep.html('<tr><td colspan="8" class="center"><h3>'+ res.message +'</h3></td></tr>');
      }
}


function verificarTodos(){
  select = document.getElementById("slctRepresentante").selectedIndex;
  if (chkTodos.prop('checked')) {
    repRepre(select);
  }
  else{
    repReprePer(select)
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
  select = document.getElementById("slctRepresentante").selectedIndex;
  if (chkTodos.prop('checked')) {
    repFuente(select);
  }
  else{
    repFuentePer(select)
  }
}

$(document).on('ready', function(){
  getTodosResponsables();
});

btnImprimir.on('click',generarPdfRepFuente);
btnSeleccionar.on('click',verificarTodos);
chkTodos.on('click',todoPeriodo);
