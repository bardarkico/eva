



function getFuentesSesion(){
//alert("dsad");
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
      /*  slctFuente.append(
          '<option value='+o.fueId+'>'+o.fueNombre+' </option>'
        );
*/
alert(o.fueId);

      i++;
    });
        }else{
      tbodyServicios.html('<tr><td colspan="8" class="center"><h3>'+ res.message +'</h3></td></tr>');
    }
    tblServicios.removeClass('hidden');
}

$(document).on('ready', function(){
  getFuentesSesion();
});
