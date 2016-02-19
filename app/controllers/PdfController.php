
<?php

class PdfController extends BaseController {

  static public function getFecha(){
    $format = "Y-m-d H:i:s";
    $timestamp = time();
    $fechaHoy =  date($format, $timestamp);
    return $fechaHoy;
  }

  public static function imprimirAsignaciones(){
  $idPeriodo = Input::get('ia');
  $seleccionar = AsignacionesController::consultaGetAsignaciones($idPeriodo);
    $cuerpoTabla ='';
    $i=0;

    foreach ($seleccionar as $value) {
      $i=$i+1;
      $fuenombre = $value['fueNombre'];
      $resNombre = $value['resNombre'];

      $cuerpoTabla = $cuerpoTabla.'<tr>
          <td width="3%" >
            <div align="center">
            <CODE  style="font-size: 80%;">'.$i.'</code>
            </div>
          </td>
          <td>
            <div align="center">
            <CODE>'.$fuenombre.'</code>
            </div>
          </td>
          <td>
            <div align="center">
            <CODE>'.$resNombre.'</code>
            </div>
          </td>
        </tr>';
    }

    $html = '<html><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/><body>'
    .'<h5 align="right">Sistema de Noticias </h5><h5 align="right">Vázquez Hernández Contadores, S.C.</h5>'
    .'<h3 align="center">Asignación de fuentes</h3>'

    .'<table cellspacing="0"  border="1" align="center" width="400" >
      <tbody >
        <tr>
          <td width="3%" >
            <div align="center">
            </div>
          </td>
          <td width="20%" >
            <div align="center">
              <h5><strong>Fuente</strong> </h5>
            </div>
          </td>
          <td width="20%">
            <div align="center">
              <h5><strong>Responsable</strong> </h5>
            </div>
          </td>
        </tr>'
        .$cuerpoTabla

      .'</tbody
     </table>'

    . '</body></html>';
    return PDF::load($html, 'letter', 'portrait')->show();
  }


  public static function imprimirEquipos(){

    $seleccionar= IntegrantesController::consultaGetTodosIntegrantes();

    $cuerpoTabla ='';
    $i=0;
    $fecha=PdfController::getFecha();

    foreach ($seleccionar as $value) {
      $i=$i+1;
      $resNombre = $value['resNombre'];
      $intNombre = $value['intNombre'];
      $intNCompleto = $value['intNombreCompleto'];
      $intCorreo = $value['intCorreo'];


      $cuerpoTabla = $cuerpoTabla.'<tr>
          <td width="3%" >
            <div align="center">
            <CODE  style="font-size: 80%;">'.$i.'</code>
            </div>
          </td>
          <td>
            <div align="center">
            <CODE>'.$resNombre.'</code>
            </div>
          </td>
          <td>
            <div align="center">
            <CODE>'.$intNombre.'</code>
            </div>
          </td>
          <td>
            <div align="center">
            <CODE>'.$intNCompleto.'</code>
            </div>
          </td>
          <td>
            <div align="center">
            <CODE>'.$intCorreo.'</code>
            </div>
          </td>
        </tr>';
    }

    $html = '<html><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/><body>'
    .'<h5 align="right">Sistema de Noticias </h5><h5 align="right">Vázquez Hernández Contadores, S.C.</h5>'
    .'<h3 align="center">Integración de equipos</h3>'

    .'<table cellspacing="0"  border="1" align="left" width="450" >
      <tbody >
        <tr>
          <td width="3%" >
            <div align="center">
            </div>
          </td>
          <td width="10%" >
            <div align="center">
              <h5><strong>Representante</strong> </h5>
            </div>
          </td>
          <td width="30%" colspan=2>
            <div align="center">
              <h5><strong>Nombre</strong> </h5>
            </div>
          </td>
          <td width="30%">
            <div align="center">
              <h5><strong>Correo</strong> </h5>
            </div>
          </td>
        </tr>'
        .$cuerpoTabla

      .'</tbody
     </table>'
    /* .'<p> Fecha de generación:  <CODE>'.$fecha.'</CODE></p> '*/
    . '</body></html>';
    return PDF::load($html, 'letter', 'portrait')->show();
  }


  public static function imprimirAsignacionesA(){

  $seleccionar = AsignacionesController::consultaGetAsignacionesActual();

    $cuerpoTabla ='';
    $i=0;
    $periodo="";

    foreach ($seleccionar as $value) {
      $i=$i+1;
      $fuenombre = $value['fueNombre'];
      $resNombre = $value['resNombre'];

      $periodo="";
      $periodo = $periodo.$value['perInicio']." a ";
      $periodo = $periodo.$value['perFin'];

      $cuerpoTabla = $cuerpoTabla.'<tr>
          <td width="3%" >
            <div align="center">
            <CODE  style="font-size: 80%;">'.$i.'</code>
            </div>
          </td>
          <td>
            <div align="center">
            <CODE>'.$fuenombre.'</code>
            </div>
          </td>
          <td>
            <div align="center">
            <CODE>'.$resNombre.'</code>
            </div>
          </td>
        </tr>';
    }

    $html = '<html><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/><body>'
    .'<h5 align="right">Sistema de Noticias </h5><h5 align="right">Vázquez Hernández Contadores, S.C.</h5>'
    .'<h3 align="center">Asignación de fuentes de información</h3>'

    .'<p> <strong>Período: </strong> '.$periodo.'</p>'
    .'<table cellspacing="0"  border="1" align="center" width="400" >
      <tbody >
        <tr>
          <td width="3%" >
            <div align="center">
            </div>
          </td>
          <td width="20%" >
            <div align="center">
              <h5><strong>Fuente</strong> </h5>
            </div>
          </td>
          <td width="20%">
            <div align="center">
              <h5><strong>Responsable</strong> </h5>
            </div>
          </td>
        </tr>'
        .$cuerpoTabla

      .'</tbody
     </table>'

    . '</body></html>';
    return PDF::load($html, 'letter', 'portrait')->show();
  }



    public static function imprimirFuentes(){

      $seleccionar=FuenteController::consultagetTodosFuentes();

      $cuerpoTabla ='';
      $i=0;
      $periodo="";

      $fecha=PDFController::getFecha();

      foreach ($seleccionar as $value) {
        $i=$i+1;
        $fuenombre = $value['fueNombre'];

        $cuerpoTabla = $cuerpoTabla.'<tr>
            <td width="3%" >
              <div align="center">
              <CODE  style="font-size: 80%;">'.$i.'</code>
              </div>
            </td>
            <td>
              <div align="center">
              <CODE>'.$fuenombre.'</code>
              </div>
            </td>
          </tr>';
      }

      $html = '<html><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/><body>'
      .'<h5 align="right">Sistema de Noticias </h5><h5 align="right">Vázquez Hernández Contadores, S.C.</h5>'
      .'<h3 align="center">Fuentes de información</h3>'

      .'<table cellspacing="0"  border="1" align="center" width="400" >
        <tbody >
          <tr>
            <td width="3%" >
              <div align="center">
              </div>
            </td>
            <td width="20%" >
              <div align="center">
                <h5><strong>Fuente</strong> </h5>
              </div>
            </td>
          </tr>'
          .$cuerpoTabla

        .'</tbody
       </table>'

       .'<br><p> Fecha de generación:  <CODE>'.$fecha.'</CODE></p>'
      . '</body></html>';
      return PDF::load($html, 'letter', 'portrait')->show();
    }

    public static function imprimirRepresentantes(){

      $seleccionar = ResponsableController::consultasResponsables();

      $cuerpoTabla ='';
      $i=0;
      $periodo="";

      $fecha=PDFController::getFecha();

      foreach ($seleccionar as $value) {
        $i=$i+1;
        $resNombre = $value['resNombre'];
        $resCorreo = $value['resCorreo'];

        $cuerpoTabla = $cuerpoTabla.'<tr>
            <td width="3%" >
              <div align="center">
              <CODE  style="font-size: 80%;">'.$i.'</code>
              </div>
            </td>
            <td>
              <div align="center">
              <CODE>'.$resNombre.'</code>
              </div>
            </td>
            <td>
              <div align="center">
              <CODE>'.$resCorreo.'</code>
              </div>
            </td>
          </tr>';
      }

      $html = '<html><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/><body>'
      .'<h5 align="right">Sistema de Noticias </h5><h5 align="right">Vázquez Hernández Contadores, S.C.</h5>'
      .'<h3 align="center">Representantes de Equipo</h3>'

      .'<table cellspacing="0"  border="1" align="center" width="400" >
        <tbody >
          <tr>
            <td width="3%" >
              <div align="center">
              </div>
            </td>
            <td width="20%" >
              <div align="center">
                <h5><strong>Nombre</strong> </h5>
              </div>
            </td>
            <td width="20%" >
              <div align="center">
                <h5><strong>Correo</strong> </h5>
              </div>
            </td>
          </tr>'
          .$cuerpoTabla

        .'</tbody
       </table>'

       .'<br><p> Fecha de generación:  <CODE>'.$fecha.'</CODE></p>'
      . '</body></html>';
      return PDF::load($html, 'letter', 'portrait')->show();
    }


}
