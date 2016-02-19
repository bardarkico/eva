<?php

class ReportesController extends BaseController {

  private function getFecha(){
    $format = "d-m-Y H:i:s";
    $timestamp = time();
    $fecha =  date($format, $timestamp);
    return $fecha;
  }

  private function selectMes($m){
    if ($m==1) {
      $mes="enero";
    }
    if ($m==2) {
      $mes="febrero";
    }
    if ($m==3) {
      $mes="marzo";
    }
    if ($m==4) {
      $mes="abril";
    }
    if ($m==5) {
      $mes="mayo";
    }
    if ($m==6) {
      $mes="junio";
    }
    if ($m==7) {
      $mes="julio";
    }
    if ($m==8) {
      $mes="agosto";
    }
    if ($m==9) {
      $mes="septiembre";
    }
    if ($m==10) {
      $mes="octubre";
    }
    if ($m==11) {
      $mes="noviembre";
    }
    if ($m==12) {
      $mes="diciembre";
    }
    if ($m==13) {
      $mes="agosto-septiembre";
    }
    if ($m==14) {
      $mes="junio-julio";
    }
    return ($mes);
  }

  public function pdfReporteBusquedaPalabra(){  /*CONTRASEÑA Actualizar*/
    $data = array(
      'palabra1' => Input::get('p1'),
      'palabra2' => Input::get('p2'),
      'palabra3' => Input::get('p3'),
      'palabra4' => Input::get('p4'),
      'condicion'=> Input::get('c'),
      'tipo'=> Input::get('tipo'),
      'autor'=> Input::get('autor')

    );



  /*  $data = array(
      'palabra1' => "ley",
      'palabra2' => "distrito",
      'palabra3' => "",
      'palabra4' => "",
      'condicion'=> 1
    );*/

    $palabra1 = $data['palabra1'];
    $palabra2 = $data['palabra2'];
    $palabra3 = $data['palabra3'];
    $palabra4 = $data['palabra4'];
    $tipo = $data['tipo'];
    $autor = $data['autor'];


    if ($data['condicion']) {
      $busqueda = ArticulosController::getBusquedaPalabra1($palabra1,$palabra2,$palabra3,$palabra4,$tipo,$autor);
    }
    else {
      $busqueda = ArticulosController::getBusquedaPalabra0($palabra1,$palabra2,$palabra3,$palabra4,$tipo,$autor);
    }
    $fecha=ReportesController::getFecha();

    $i=0;
    $cuerpoTabla='';
    foreach ($busqueda as $value) {
      $i=$i+1;

      $titulo = $value['artTitulo'];

      $tipo;
      if ( $value['artTipo'] == 1) {
        $tipo="artículo";
      }
      if ( $value['artTipo'] == 2) {
        $tipo="consulta";
      }
      if ( $value['artTipo'] == 3) {
        $tipo="tesis";
      }
      if ( $value['artTipo'] == 4) {
        $tipo="jurisprudencia";
      }
      if ( $value['artTipo'] == 5) {
        $tipo="tips";
      }

      $autor;
      if (($value['artAutor'] == null)||($value['artAutor'] == "")||($value['artAutor'] == "")) {
        $autor = "Sin autor";
      }
      else $autor = $value['artAutor'];

      $pagina = $value['artPagina'];
      $revista = $value['revNombre'];
      $numero = $value['reNumero'];
      $anio = $value['reAnio'];
      $mes = ReportesController::selectMes($value['reMes']);
    //  $autor = $value['artAutor'];
      $ubicacion = $value['reUbicacion'];

      $cuerpoTabla = $cuerpoTabla.'<tr>
          <td>
            <div align="center">
            <p style="font-size:10px; ">'.$i.'</p>
            </div>
          </td>
          <td  >
            <div align="justify">
            <p style="font-size:10px; padding:0 5px 0 5px ">'.$titulo.'</p>
            </div>
          </td>
          <td>
            <div align="center">
            <p style="font-size:10px; ">'.$tipo.'</p>
            </div>
          </td>
          <td >
            <div align="center">
            <p style="font-size:10px; ">'.$pagina.'</p>
            </div>
          </td>
          <td >
            <div align="center">
            <p style="font-size:10px; ">'.$revista.'</p>
            </div>
          </td>
          <td >
            <div align="center">
            <p style="font-size:10px; ">'.$numero.'</p>
            </div>
          </td>
          <td >
            <div align="center">
            <p style="font-size:10px; ">'.$anio.'</p>
            </div>
          </td>
          <td >
            <div align="center">
            <p style="font-size:10px; ">'.$mes.'</p>
            </div>
          </td>
          <td >
            <div align="center">
            <p style="font-size:10px; ">'.$autor.'</p>
            </div>
          </td>

        </tr>';
        /*<td >
          <div align="center">
          <p style="font-size:10px; ">'.$ubicacion.'</p>
          </div>
        </td>*/
    }

    $html = '<html><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/><body>'
    .'<span align="left">Buscador de revistas</span>'/*<span align="right">Vázquez Hernández Contadores, S.C.</span>*/
    .'<h3 align="center">Resultados de búsqueda</h3>'
    .'<p><strong>   Termino(s) de busqueda: </strong>'.$palabra1.' '.$palabra2.' '.$palabra3.' '.$palabra4.' </p>'
    .'<table cellspacing="0"  border="1" align="center" width="550" >
      <tbody >
        <tr style="background:#0d47a1;">
          <th>
            <div align="center">
            </div>
          </th>
          <th>
            <div align="center">
              <h5 style="color:#fff;"><strong>Título</strong> </h5>
            </div>
          </th>
          <th>
            <div align="center">
              <h5 style="color:#fff;"><strong>Tipo</strong> </h5>
            </div>
          </th>
          <th>
            <div align="center">
              <h5 style="color:#fff;"><strong>Página</strong> </h5>
            </div>
          </th>
          <th>
            <div align="center">
              <h5 style="color:#fff;"><strong>Revista</strong> </h5>
            </div>
          </th>
          <th>
            <div align="center">
              <h5 style="color:#fff;"><strong>Número</strong> </h5>
            </div>
          </th>
          <th>
            <div align="center">
              <h5 style="color:#fff;"><strong>Año</strong> </h5>
            </div>
          </th>
          <th>
            <div align="center">
            <h5 style="color:#fff;"><strong>Mes</strong> </h5>
            </div>
          </th>
          <th>
            <div align="center">
            <h5 style="color:#fff;"><strong>Autor</strong> </h5>
            </div>
          </th>

        </tr>'
        .$cuerpoTabla

        /*<th>
          <div align="center">
          <h5 style="color:#fff;"><strong>Ubicación</strong> </h5>
          </div>
        </th>*/

      .'</tbody
     </table>'
     .'<p style="font-size:10px; "> Total: <CODE >'
     .$i.'  </code>'
     .$fecha. '</code> </p>'
    . ' </code> </body></html>';
    return PDF::load($html, 'letter', 'portrait')->show();


  }





  public function pdfReporteBusquedaFrase(){  /*CONTRASEÑA Actualizar*/
    $data = array(
      'buscar' => Input::get('b'),

    );


  /*  $data = array(
      'palabra1' => "leyes",
      'palabra2' => "distrito",
      'palabra3' => "",
      'palabra4' => "",
      'condicion'=> 1
    );*/

  /*  $palabra1 = $data['palabra1'];
    $palabra2 = $data['palabra2'];
    $palabra3 = $data['palabra3'];
    $palabra4 = $data['palabra4'];
*/
    $busqueda = ArticulosController::getBusquedaFrase($data['buscar']);
    $fecha=ReportesController::getFecha();

    $i=0;
    $cuerpoTabla='';
    foreach ($busqueda as $value) {
      $i=$i+1;

      $titulo = $value->artTitulo;

      $tipo;
      if ( $value->artTipo == 1) {
        $tipo="artículo";
      }
      if ( $value->artTipo == 2) {
        $tipo="consulta";
      }
      if ( $value->artTipo == 3) {
        $tipo="tesis";
      }
      if ( $value->artTipo == 4) {
        $tipo="jurisprudencia";
      }
      if ( $value->artTipo == 5) {
        $tipo="tips";
      }

      $autor;
      if (($value->artAutor == null)||($value->artAutor == "")||($value->artAutor == "")) {
        $autor = "Sin autor";
      }
      else $autor = $value->artAutor;

      $pagina = $value->artPagina;
      $revista = $value->revNombre;
      $numero = $value->reNumero;
      $anio = $value->reAnio;
      $mes = ReportesController::selectMes($value->reMes);
    //  $autor = $value['artAutor'];
      $ubicacion = $value->reUbicacion;

      $cuerpoTabla = $cuerpoTabla.'<tr>
          <td>
            <div align="center">
            <p style="font-size:10px; ">'.$i.'</p>
            </div>
          </td>
          <td  >
            <div align="justify">
            <p style="font-size:10px; padding:0 5px 0 5px ">'.$titulo.'</p>
            </div>
          </td>
          <td>
            <div align="center">
            <p style="font-size:10px; ">'.$tipo.'</p>
            </div>
          </td>
          <td >
            <div align="center">
            <p style="font-size:10px; ">'.$pagina.'</p>
            </div>
          </td>
          <td >
            <div align="center">
            <p style="font-size:10px; ">'.$revista.'</p>
            </div>
          </td>
          <td >
            <div align="center">
            <p style="font-size:10px; ">'.$numero.'</p>
            </div>
          </td>
          <td >
            <div align="center">
            <p style="font-size:10px; ">'.$anio.'</p>
            </div>
          </td>
          <td >
            <div align="center">
            <p style="font-size:10px; ">'.$mes.'</p>
            </div>
          </td>
          <td >
            <div align="center">
            <p style="font-size:10px; ">'.$autor.'</p>
            </div>
          </td>

        </tr>';
        /*<td >
          <div align="center">
          <p style="font-size:10px; ">'.$ubicacion.'</p>
          </div>
        </td>*/
    }

    $html = '<html><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/><body>'
    .'<span align="left">Buscador de revistas</span>'/*<span align="right">Vázquez Hernández Contadores, S.C.</span>*/
    .'<h3 align="center">Resultados de búsqueda</h3>'
    .'<p><strong>   Termino(s) de busqueda: </strong>'.$data['buscar'].' </p>'
    .'<table cellspacing="0"  border="1" align="center" width="550" >
      <tbody >
        <tr style="background:#0d47a1;">
          <th>
            <div align="center">
            </div>
          </th>
          <th>
            <div align="center">
              <h5 style="color:#fff;"><strong>Título</strong> </h5>
            </div>
          </th>
          <th>
            <div align="center">
              <h5 style="color:#fff;"><strong>Tipo</strong> </h5>
            </div>
          </th>
          <th>
            <div align="center">
              <h5 style="color:#fff;"><strong>Página</strong> </h5>
            </div>
          </th>
          <th>
            <div align="center">
              <h5 style="color:#fff;"><strong>Revista</strong> </h5>
            </div>
          </th>
          <th>
            <div align="center">
              <h5 style="color:#fff;"><strong>Número</strong> </h5>
            </div>
          </th>
          <th>
            <div align="center">
              <h5 style="color:#fff;"><strong>Año</strong> </h5>
            </div>
          </th>
          <th>
            <div align="center">
            <h5 style="color:#fff;"><strong>Mes</strong> </h5>
            </div>
          </th>
          <th>
            <div align="center">
            <h5 style="color:#fff;"><strong>Autor</strong> </h5>
            </div>
          </th>

        </tr>'
        .$cuerpoTabla

        /*<th>
          <div align="center">
          <h5 style="color:#fff;"><strong>Ubicación</strong> </h5>
          </div>
        </th>*/

      .'</tbody
     </table>'
     .'<p style="font-size:10px; "> Total: <CODE >'
     .$i.'  </code>'
     .$fecha. '</code> </p>'
    . ' </code> </body></html>';
    return PDF::load($html, 'letter', 'portrait')->show();


  }




}
