var btnAdm   = $('#btnAdm'),
    pnlAdmin = $('#pnlAdmin'),
    phlBusqueda =$('#phlBusqueda'),
    btnBuscador=$('#btnBuscador'),
    txtObtenidos =$('#txtObtenidos'),
    txtObtenidosF=$('#txtObtenidosF');
var btnBuscar = $('#btnBuscar'),
    txtBuscar = $('#txtBuscar'),
    btnLimpiar = $('#btnLimpiar');
var tblServicios   = $('#tblServicios'),
    tbodyServicios = $('#tbodyServicios'),
    token = $('#_token');
var spnBuscar =$('#spnBuscar'),
    spnListo = $('#spnListo');
var btnBuscarP = $('#btnBuscarP'),
txtPalabra1 =$('#txtPalabra1'),
txtPalabra2 =$('#txtPalabra2'),
txtPalabra3 =$('#txtPalabra3'),
txtPalabra4 =$('#txtPalabra4'),
slctCond =$('#slctCond'),
chAutor = $('#chAutor'),
txtAutor =$('#txtAutor'),
btnImprimirF=$('#btnImprimirF'),
btnLimpiarF=$('#btnLimpiarF'),
btnImprimirP=$('#btnImprimirP'),
slctHistorialFrase=$('#slctHistorialFrase')
slctHistorialPalabra=$('#slctHistorialPalabra'),
idSesion=$('#idSesion');
var slctTipoP=$('#slctTipoP'),
    slctTipoG=$('#slctTipoG');

var lblBuscar=$('#lblBuscar');

    function buscarArticulo(){
      if(!validarBuscar())
        return false;
        $('td').removeHighlight();
        spnListo.addClass('hidden');
        spnBuscar.removeClass('hidden');
        var guardado = 0;

          var datos = $.ajax({
            url: 'buscarArticulo',
            data: {
              token:  token.val(),
              buscar: txtBuscar.val(),
              s: idSesion.val(),
              tipo: slctTipoG.val()
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
            var total = res.total;
            tbodyServicios.html('');
            if ( res.status === 'OK' ){
               var i = 1;
              $.each(res.data, function(k,o){

            var t=o.artActivo;
            status = selectStatus(t);

            var ubicacion;
            if((o.artUbicacion == "")||(o.artUbicacion == null)||(o.artUbicacion == " ")){
              ubicacion=o.reUbicacion;
            }
            else ubicacion=o.artUbicacion;

            var t=o.artTipo;
            tipo = selectTipo(t);

            var m=o.reMes;
            mes = selectMes(m);

            var autor;
            if ((o.artAutor == null)||(o.artAutor == "")||(o.artAutor == "")) {
              autor = "Sin autor";
            }
            else autor = o.artAutor;

                tbodyServicios.append(
                  '<tr>'+
                  '<td >'+i+'</td>'+
                  '<td class="colArticulo" >'+o.artTitulo+'</td>'+
                  '<td class="text-center">'+tipo+'</td>'+
                  '<td class="text-center">'+o.artPagina+'</td>'+
                  '<td class="text-center">'+o.revNombre+'</td>'+
                  '<td class="text-center">'+o.reNumero+'</td>'+
                  '<td class="text-center">'+o.reAnio+'</td>'+
                  '<td class="text-center">'+mes+'</td>'+
                  '<td >'+autor+'</td>'+
                  '<td class="text-left"><a target="blanck" href="'+ubicacion+'">'+ubicacion+'</a></td>'+
                  '</tr>'
              );
              i++;
              });
              txtObtenidosF.val(total);
              $("#tblServicios").tablesorter(); /*para ordenar*/

              var textoBuscar = txtBuscar.val()
            //  $('td').highlight();

              var elem = textoBuscar.split(' ');

              for (var i = 0; i < elem.length; i++) {
                $('td.colArticulo').highlight(elem[i]);
              }


            }else{
              tbodyServicios.html('<tr><td colspan="8" class="center"><h3>'+ res.message +'</h3></td></tr>');
              txtObtenidosF.val("0");
            }
            setTimeout(function(){ spnBuscar.addClass('hidden'); spnListo.removeClass('hidden');}, 500);

            tblServicios.removeClass('hidden');
            btnImprimirF.attr("href", "pdfReporteBusquedaFrase?b="+txtBuscar.val());
            btnImprimirF.attr("target", "blank");
            btnImprimirF.removeClass('hidden');

           var palabraBuscar = txtBuscar.val();

           var existente=0;
           slctHistorialFrase.find('option').each(function(){
              if (palabraBuscar == $(this).val() ) {
                existente=1;
              }

            });

            if (existente==0) {
              var selectFrase = document.getElementById("slctHistorialFrase");
              var option = document.createElement("option");
              option.text = palabraBuscar;
              selectFrase.add(option, selectFrase[0]);
            }
        }

        function buscarArticuloPalabra(){
        $('td').removeHighlight();

        var palabra1Txt = txtPalabra1.val(),
            palabra2Txt = txtPalabra2.val(),
            palabra3Txt = txtPalabra3.val(),
            palabra4Txt = txtPalabra4.val();

          if(!validarBuscarP())
            return false;
            spnListo.addClass('hidden');
            spnBuscar.removeClass('hidden');

              var datos = $.ajax({
                url: 'buscarArticuloPalabra',
                data: {
                  token:  token.val(),
                  palabra1: palabra1Txt,
                  palabra2: palabra2Txt,
                  palabra3: palabra3Txt,
                  palabra4: palabra4Txt,
                  condicion: slctCond.val(),
                  tipo: slctTipoP.val(),
                  autor: txtAutor.val(),
                  s: idSesion.val()
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
                var total = res.total;
                tbodyServicios.html('');
                if ( res.status === 'OK' ){
                   var i = 1;
                  $.each(res.data, function(k,o){

                var ubicacion;
                if((o.artUbicacion == "")||(o.artUbicacion == null)||(o.artUbicacion == " ")){
                  ubicacion=o.reUbicacion;
                }
                else ubicacion=o.artUbicacion;

                var t=o.artActivo;
                status = selectStatus(t);

                var t=o.artTipo;
                tipo = selectTipo(t);

                var m=o.reMes;
                mes = selectMes(m);

                var autor;
                if ((o.artAutor == null)||(o.artAutor == "")||(o.artAutor == "")) {
                  autor = "Sin autor";
                }
                else autor = o.artAutor;

                    tbodyServicios.append(
                      '<tr>'+
                      '<td >'+i+'</td>'+
                      '<td class="colArticulo">'+o.artTitulo+'</td>'+
                      '<td class="text-center">'+tipo+'</td>'+
                      '<td class="text-center">'+o.artPagina+'</td>'+
                      '<td class="text-center">'+o.revNombre+'</td>'+
                      '<td class="text-center">'+o.reNumero+'</td>'+
                      '<td class="text-center">'+o.reAnio+'</td>'+
                      '<td class="text-center">'+mes+'</td>'+
                      '<td >'+autor+'</td>'+
                      '<td class="text-left"><a target="blanck" href="'+ubicacion+'">'+ubicacion+'</a></td>'+
                      '</tr>'
                  );
                  i++;
                  });
                  txtObtenidos.val(total);
                  $("#tblServicios").tablesorter();
                }else{
                  tbodyServicios.html('<tr><td colspan="8" class="center"><h3>'+ res.message +'</h3></td></tr>');
                  txtObtenidos.val("0");
                }
                setTimeout(function(){ spnBuscar.addClass('hidden'); spnListo.removeClass('hidden');}, 500);

                tblServicios.removeClass('hidden');

                tblServicios.removeClass('hidden');

                //btnImprimirP.attr("href", "pdfReporteBusquedaPalabra?p1="+txtPalabra1.val()+"&p2="+txtPalabra2.val()+"&p3="+txtPalabra3.val()+"&p4="+txtPalabra4.val()+"&c="+slctCond.val());
                btnImprimirP.attr("href", "pdfReporteBusquedaPalabra?p1="+txtPalabra1.val()+"&p2="+txtPalabra2.val()+"&p3="+txtPalabra3.val()+"&p4="+txtPalabra4.val()+"&c="+slctCond.val()+"&t="+slctTipoP.val());
                btnImprimirP.attr("target", "blank");
                btnImprimirP.removeClass('hidden');

                $('td.colArticulo').highlight(txtPalabra1.val());
                $('td.colArticulo').highlight(txtPalabra2.val());
                $('td.colArticulo').highlight(txtPalabra3.val());
                $('td.colArticulo').highlight(txtPalabra4.val());


                var existente=0;
                var palabras = palabra1Txt+"-"+palabra2Txt+"-"+palabra3Txt+"-"+palabra4Txt;

                slctHistorialPalabra.find('option').each(function(){
                   if (palabras == $(this).val() ) {
                     existente=1;
                   }

                 });

                 if (existente==0) {
                 var selectFrase = document.getElementById("slctHistorialPalabra");
                 var option = document.createElement("option");
                 option.text = palabras;
                 selectFrase.add(option, selectFrase[0]);

                 }

            }



        function validarBuscar(){
          if (( txtBuscar.val() === '')||( txtBuscar.val() === null)){
            alert("Ingrese una cadena de caracteres a buscar.");
            txtBuscar.focus();
            return false;
          }
          return true;
        }

        function validarBuscarP(){
          if (( txtPalabra1.val() === '')||( txtPalabra1.val() === null)){
            alert("Ingrese  al menos una palabra de caracteres a buscar.");
            txtBuscar.focus();
            return false;
          }
          return true;
        }


            function validarBuscar(){
              if (( txtBuscar.val() === '')||( txtBuscar.val() === null)){
                alert("Ingrese una cadena de caracteres a buscar.");
                txtBuscar.focus();
                return false;
              }
              return true;
            }

  function imprimir(){
    /*var datos = $.ajax({
      url: 'pdfReporteBusquedaPalabra',
      data: {
        token:  token.val(),
        palabra1: txtPalabra1.val(),
        palabra2: txtPalabra2.val(),
        palabra3: txtPalabra3.val(),
        palabra4: txtPalabra4.val(),
        condicion: slctCond.val()
      },
            type: 'get',
          dataType:'json',
          async:false
      }).error(function(e){
          alert('Ocurrio un error, intente de nuevo');
      }).responseText;*/
//alert("alert");
  //  location.href = "pdfReporteBusquedaPalabra";
  }
function selectMes(m){
  if (m==1) {
    mes="enero";
  }
  if (m==2) {
    mes="febrero";
  }
  if (m==3) {
    mes="marzo";
  }
  if (m==4) {
    mes="abril";
  }
  if (m==5) {
    mes="mayo";
  }
  if (m==6) {
    mes="junio";
  }
  if (m==7) {
    mes="julio";
  }
  if (m==8) {
    mes="agosto";
  }
  if (m==9) {
    mes="septiembre";
  }
  if (m==10) {
    mes="octubre";
  }
  if (m==11) {
    mes="noviembre";
  }
  if (m==12) {
    mes="diciembre";
  }
  if (m==13) {
    mes="agosto-septiembre";
  }
  if (m==14) {
    mes="junio-julio";
  }
  return (mes);
}
function selectTipo(t){
  if (t==1) {
    tipo="artículo"
  }
  if (t==2) {
    tipo="consulta"
  }
  if (t==3) {
    tipo="tesis"
  }
  if (t==4) {
    tipo="jurisprudencia"
  }
  if (t==5) {
    tipo="tips"
  }
  return(tipo);
}
function selectStatus(a){
  if ( a == 1 ){
    status = '<span class="glyphicon glyphicon-ok text-success" title="Activo"></span>';
  }
  else{
    status = '<span class="glyphicon glyphicon-remove" title="Inactivo"></span>';
  }
  return(status);
}
function limpiar(){
  txtBuscar.val('');
  txtObtenidos.val('');
  tbodyServicios.html('');
  txtPalabra1.val('');
  txtPalabra2.val('');
  txtPalabra3.val('');
  txtPalabra4.val('');
  txtObtenidosF.val('');
  txtAutor.val('');
  chAutor.prop("checked", "");
}
function activarAutor(){
  var valorCheck;
  valorCheck = chAutor.prop('checked');
  if (valorCheck) {
    txtAutor.prop('disabled', false);
  }
  else{
    txtAutor.prop('disabled', true);
    txtAutor.val("");
  }

}

function mostrarAdm(){
  pnlAdmin.removeClass('hidden');
  phlBusqueda.addClass('hidden');
}

function mostrarBuscador(){
  phlBusqueda.removeClass('hidden');
  pnlAdmin.addClass('hidden');
}

$(document).on('ready', function(){
  limpiar();

  txtBuscar.keyup(function (e) {
    if (e.keyCode == 13) {
      buscarArticulo();
    }
});

txtPalabra1.keyup(function (e) {
  if (e.keyCode == 13) {
    buscarArticuloPalabra();
  }
});
txtPalabra2.keyup(function (e) {
  if (e.keyCode == 13) {
    buscarArticuloPalabra();
  }
});
txtPalabra3.keyup(function (e) {
  if (e.keyCode == 13) {
    buscarArticuloPalabra();
  }
});
txtPalabra4.keyup(function (e) {
  if (e.keyCode == 13) {
    buscarArticuloPalabra();
  }
});

});


function historialFrase(){
  valorHistorial = $(this).val();
  txtBuscar.val(valorHistorial);
  buscarArticulo();
}

function historialPalabra(){
  valorHistorial = $(this).val();
  var p1,p2,p3,p4;
  var elementos = valorHistorial.split('-');

  p1=elementos[0];
  p2=elementos[1];
  p3=elementos[2];
  p4=elementos[3];

  txtPalabra1.val(p1);
  txtPalabra2.val(p2);
  txtPalabra3.val(p3);
  txtPalabra4.val(p4);

  buscarArticuloPalabra();
}


slctHistorialFrase.on('change',historialFrase);
slctHistorialPalabra.on('change',historialPalabra);
btnAdm.on('click',mostrarAdm);
btnBuscador.on('click',mostrarBuscador);
btnLimpiar.on('click',limpiar);
btnBuscar.on('click',buscarArticulo);
btnBuscarP.on('click', buscarArticuloPalabra);

btnLimpiarF.on('click',limpiar);
//btnImprimir.on('click',imprimir);
chAutor.on('click',activarAutor);
