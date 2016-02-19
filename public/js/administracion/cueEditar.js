
var tblConsulta=$('#tblConsulta'),
tbodyConsulta=$('#tbodyConsulta');

var btnConsulta=$('#btnConsulta'),
btnEditar=$('#btnEditar'),
btnAgregar=$('#btnAgregar');

var pnlAgregar=$('#pnlAgregar');
pnlConsulta=$('#pnlConsulta'),
pnlInicio=$('#pnlInicio');

var tblServicios   = $('#tblServicios'),
    tbodyServicios = $('#tbodyServicios');

var txtNombreFuente = $('#txtNombreFuente'),
    txtIdFuente = $('#txtIdFuente'),
    formEditarServ= $('#formEditarServ'),
    txtActivo     = $('#txtActivo'),
    btnGuardar    = $('#btnGuardar'),
    btnCancelar   = $('#btnCancelar'),
    token         = $('#_token');

var btnCancelarAg = $('#btnCancelarAg'),
    token = $('#token'),
    txtNombre = $('#txtNombre'),
    txtTema = $('#txtTema'),
    txtFechaApl = $('#txtFechaApl'),
    btnGuardarAg =$('#btnGuardarAg'),
    txtFechaA =$('#txtFechaA'),
    txtTemaE =$('#txtTemaE'),
    txtNombreE =$('#txtNombreE');
/*var spnNombre=$('#spnNombre'),
    
    btnImprimir=$('#btnImprimir');*/
/*Ide desde el icono editar de la tabla*/
function darBajaCues(){
  var id = $(this).attr('id');  
  if (id==="")
    return false;

  var datos = $.ajax({
    url: 'darBajaCues',
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

    if ( res.status === 'OK' ){
      getTodosCuestionarios();
    }
    else{
      alert(res.message);
    }
}

/*function editarFuente(){
  var datos = $.ajax({
    url: 'editarFuente',
    data: {
      token: token.val(),
      nombre:txtNombreFuente.val(),
      i:txtIdFuente.val(),
      activo:txtActivo.val()
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

    tbodyServicios.html('');
    if ( res.status === 'OK' ){
      limpiar();
      getTodosFuentes();
      swal({
        title: "Edición de información correcta.",
        text: res.message,
        timer: 2000,
        type: "success",
        showConfirmButton: true
      });
    }
    else {
        alert(res.message);
    }
}*/

function getTodosCuestionarios(){
  var datos = $.ajax({
    url: 'getCuestionarioConsultas',
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

    tbodyServicios.html('');
    if ( res.status === 'OK' ){
       var i = 1;
      $.each(res.data, function(k,o){

        tbodyServicios.append(
          '<tr>'+
            '<td >'+o.cueFechaAp+'</td>'+
            '<td >'+o.cueNombre+'</td>'+
            '<td class="text-center">'+o.cueTema+'</td>'+
            '<td class="text-center">'+
              '<span class="glyphicon glyphicon-edit text-primary" id="'+o.cueId+'" '+
              'style="cursor:pointer" title="Editar"></span>'+
            '</td>'+
            '<td class="text-center">'+
              '<span class="glyphicon glyphicon-trash text-danger" id="'+o.cueId+'" '+
              'style="cursor:pointer" title="Dar de baja"></span>'+
            '</td>'+
          '</tr>'
      );
      i++;
      });

      }else{
      tbodyServicios.html('<tr><td colspan="8" class="center"><h3>'+ res.message +'</h3></td></tr>');
    }
}

function getCues(){
  var id = $(this).attr('id');
  if (id==="")
    return false;

  var datos = $.ajax({
    url: 'getCues',
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
       var i = 1;
      $.each(res.data, function(k,o){

        txtFechaA.val(o.cueFechaAp);
        txtTemaE.val(o.cueTema);
        txtNombreE.val(o.cueNombre);
        txtIdFuente.val(o.cueId);
        formEditarServ.removeClass('hidden');
        tblServicios.addClass('hidden');
      i++;
      });
    }else{
      tbodyServicios.html('<tr><td colspan="8" class="center"><h3>'+ res.message +'</h3></td></tr>');
    }
    tbodyServicios.removeClass('hidden');
}

function limpiar(){
  tblServicios.removeClass('hidden');
  formEditarServ.addClass('hidden');
  txtNombreFuente.val('');
}

/*******/

function ingresoCuestionario(){
  var editar = $.ajax({
    url: 'ingresoCuestionario',
    data: {
      token: token.val(),
      fecha: txtFechaApl.val(),
      tema: txtTema.val(),
      nombre: txtNombre.val()
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
        title: "Cuestionario agregado.",
        text: "Se agrego correctamente el cuestionario.",
        timer: 2000,
        type: "success",
        showConfirmButton: true
      });
    }
    else{
      alert(resultado.message);
    }
}

function cancelar(){
  txtNombre.val('');
}

/*function comprobarFuente(e){
  var elem = e.target;
  if (elem.validity.valid) {
    document.getElementById('spnNombre').innerHTML = "";
    elem.style.background='#FFFFFF';
  }
  else {
    elem.style.background='#FFDDDD';
    document.getElementById('spnNombre').innerHTML = '<i class="fa fa-exclamation-circle"></i> Solo caracteres alfanumericos y @ . _ - ';
  }
}*/

function getCuestionarioConsultas(){
  var datos = $.ajax({
    url: 'getCuestionarioConsultas',
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

        tbodyConsulta.append(
          '<tr>'+
            '<td >'+o.cueFechaAp+'</td>'+
            '<td >'+o.cueNombre+'</td>'+
            '<td class="text-center">'+o.cueTema+'</td>'+
          '</tr>'
      );
      i++;
      });
    }else{
      tbodyConsulta.html('<tr><td colspan="8" class="center"><h3>'+ res.message +'</h3></td></tr>');
    }
    tblConsulta.removeClass('hidden');
}

function mostrarEditar(){
  pnlAgregar.addClass('hidden');
  pnlConsulta.addClass('hidden');
  tblServicios.removeClass('hidden');
  pnlInicio.addClass('hidden');
  getTodosCuestionarios();
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
  btnEditar.addClass('botonNoactivo');
  btnConsulta.addClass('botonActivo');
  btnAgregar.addClass('botonNoactivo');
  btnEditar.removeClass('botonActivo');
  btnConsulta.removeClass('botonNoactivo');
  btnAgregar.removeClass('botonActivo');
  getCuestionarioConsultas();
}
function mostrarAgregar(){
  pnlAgregar.removeClass('hidden');
  pnlConsulta.addClass('hidden');
  tblServicios.addClass('hidden');
  pnlInicio.addClass('hidden');
  btnEditar.addClass('botonNoactivo');
  btnConsulta.addClass('botonNoactivo');
  btnAgregar.addClass('botonActivo');
  btnEditar.removeClass('botonActivo');
  btnConsulta.removeClass('botonActivo');
  btnAgregar.removeClass('botonNoactivo');
}

/******/
/*$(document).on('ready', function(){

  getTodosFuentesConsultas();

  intNombre = document.querySelector("input[name='txtFuente']");
  intNombre.addEventListener("input", comprobarFuente);

});*/

tblServicios.delegate('.glyphicon-edit', 'click', getCues);
tblServicios.delegate('.glyphicon-trash', 'click', darBajaCues);
/*btnCancelar.on('click',limpiar);
btnGuardar.on('click',editarFuente);*/

btnCancelarAg.on('click',cancelar);
btnGuardarAg.on('click',ingresoCuestionario);


btnEditar.on('click',mostrarEditar);
btnConsulta.on('click',mostrarConsulta);
btnAgregar.on('click',mostrarAgregar);
