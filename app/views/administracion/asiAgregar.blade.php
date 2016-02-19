@extends('administracion.layoutAd')

@section('head')
{{ HTML::style('sweetAlert/sweetalert.css') }}
@stop

@section('title')
  Editar Sesión | Hemeroteca VHC
@stop

@section('body')
@stop

@section('content')
<div>
  <div class="row">
    <center><h2><i class="fa fa-calendar-times-o text-primary"></i> Fuentes y representantes</h2></center>
    <br><br>
      <div class="col-md-4">
        <button id="btnConsulta" class="btn btn-block btn-md botonNoactivo"><i class="fa fa-th-list"></i> Consultar</button>
    </div>
    <div class="col-md-4">
      <button id="btnEditar" class="btn btn-block btn-md botonNoactivo"><i class="fa fa-pencil-square-o"></i> Edición Manual</button>
    </div>
    <div class="col-md-4">
      <button id="btnAgregar" class="btn btn-block btn-md botonNoactivo"><i class="fa fa-plus-circle"></i> Edición Automática</button>
    </div>
  </div>
</div>



<div class="row hidden" id="pnlAgregar">
  <div class="col-md-10">
    <h2><span class="glyphicon glyphicon-edit text-primary"></span> Asignación de fuentes a representantes de forma automática:</h2>



        <!-- Tabla de servicios -->
      <br>
      <div class="row">
        <div class="col-md-3 text-right">
          <strong>Período </strong>
        </div>
        <div class="col-md-5">
          <select name="" id="slctPeriodo" class="form-control input-sm" >
          </select>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-md-3 text-right">
          <strong>Inicio Responsable: </strong>
        </div>
        <div class="col-md-5">
          <select name="" id="slctRepresentante" class="form-control input-sm" >
          </select>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-md-6 text-right">
          <button class="btn btn-primary" id="btnAsignar"><i class="fa fa-th-list"></i> Generar Asignación</button>
        </div>
        <div class="col-md-6">
          <button class="btn btn-primary" id="btnGuardar"><i class="fa fa-floppy-o"></i> Guardar asignacón</button>
        </div>
      </div>

      <br><hr>


      <div class="row">
        <div class="col-md-6">

                <div class="row">
                  <div class="col-md-12">
                    <div class="table-responsive" id="tblFuentes">

                      <table class="table table-striped table-hover">
                        <thead>
                          <tr>
                            <th class="col-md-12">FUENTE</th>
                          </tr>
                        </thead>

                        <tbody id="tbodyFuentes">

                        </tbody>

                      </table>
                    </div>
                  </div>
                </div>



        </div>
        <div class="col-md-6">


          <div class="row">
            <div class="col-md-12">
              <div class="table-responsive" id="tblResponsables">

                <table class="table table-striped table-hover">
                  <thead>
                    <tr>
                      <th class="col-md-12">REPRESENTANTE</th>
                    </tr>
                  </thead>

                  <tbody id="tbodyResponsables">

                  </tbody>

                </table>
              </div>
            </div>
          </div>



        </div>
      </div>


    <br>

    <input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">

  </div>  <!--/columna10 contenido-->
</div>



<div class="row hidden" id="tblServicios">
  <div class="col-md-10">
    <h2><span class="glyphicon glyphicon-edit text-primary"></span> Editar fuente y representante de forma manual</h2><br>

    <div class="row">
      <div class="col-md-3 text-right">
        <strong>Selecccionar Período </strong>
      </div>
      <div class="col-md-5">
        <select name="" id="slctPeriodoE" class="form-control input-sm" >
          <option> </option>
        </select>
      </div>
  <!--      <div class="col-md-2">
        <button id="btnEnviar"  class="btn btn-info btn-block btn-md"><i class="fa fa-paper-plane"></i> Enviar por Correo</button>
      </div>
      <div class="col-md-2">
         <a href="#" id="btnImprimir" target="blanck">  <button   class="btn btn-info btn-block btn-md"><i class="fa fa-file-pdf-o"></i> Imprimir PDF</button>  </a>
      </div>
    -->
    </div>


        <!-- Tabla de servicios -->
      <br>
      <div class="row">
        <div class="col-md-12">
          <div class="table-responsive" id="tblEditAs">
            <h3>Asignaciones de fuentes de informacion a representantes actual:</h3>
            <table class="table table-striped table-hover table-bordered">
              <thead>
                <tr>
                <th class="col-md-1">No.</th>
                  <th class="col-md-3 text-center">Fuente</th>
                  <th class="col-md-3 text-center">Representante</th>
                  <th class="col-md-3 text-center">Modificar</th>
                </tr>
              </thead>
              <tbody id="tbodyEditAs">
              </tbody>

            </table>
          </div>
        </div>
      </div> <!-- /Tabla de servicios -->
    <br>

    <!-- Panel editar -->
     <div class="row">
      <div class="col-md-10">
        <div class="well transparenteClaro hidden" id="formEditarServE">

          <div class="form-horizontal">
            <fieldset>
              <legend><span class="glyphicon glyphicon-edit text-primary"></span> Editar Fuente</legend>
              <input type="hidden" id="txtIdAsignacionE" value="">
              <div class="form-group">
                <input type="hidden" id="txtIdFuenteE" value="">
                <label for="txtNombreFuenteE" class="col-md-4 control-label">Nombre de la Fuente:</label>
                <div class="col-md-7">
                  <input type="text" class="form-control input-sm" id="txtNombreFuenteE" maxlength="55" disabled>
                </div>
              </div>


              <div class="form-group">
							  <label for="slctRepresentanteE" class="col-md-4 control-label">Representante:</label>
							  <div class="col-md-7">
								  <select name="" id="slctRepresentanteE" class="form-control input-sm">
									 <!--  <option value="1">Sí</option>
									  <option value="0">No</option>  -->
								  </select>
							  </div>
						  </div>
              <div class="form-group">
                <div class="col-md-9 col-md-offset-3">
                  <button class="btn btn-primary" id="btnGuardarE"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar cambios</button>
                  <button class="btn btn-danger " id="btnCancelarE"><span class="glyphicon glyphicon-remove-sign"></span> Cancelar</button>
                </div>
              </div>
            </fieldset>
          </div>
        </div>
      </div>
    </div>

    <input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">

  </div>  <!--/columna10 contenido-->
</div>



  <div class="row hidden" id="pnlConsulta">
    <div class="row">
      <div class="col-md-6">
        <h4>Asignación Actual: <input type="text" id="textFecha" disabled></h4>
      </div>
      <div class="col-md-4">
          <h4> Período: <input type="text" id="txtPeriodo" value="" disabled>   </h4>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">

      </div>
      <div class="col-md-2">
            <button id="btnEnviarA"  class="btn btn-info btn-block btn-md"><i class="fa fa-paper-plane"></i> Enviar por Correo</button>
      </div>
      <div class="col-md-2">
             <a href="imprimirAsignacionesA" id="btnImprimirA" target="blanck">  <button   class="btn btn-info btn-block btn-md"><i class="fa fa-file-pdf-o"></i> Imprimir PDF</button>  </a>
      </div>
    </div>
<br>
    <div class="col-md-10">
      <div class="table-responsive" id="tblConsulta">



        <table class="table table-striped table-hover table-bordered">
          <thead>
            <tr>
            <th class="col-md-1 text-center">No.</th>
              <th class="col-md-3 text-center">Fuente</th>
              <th class="col-md-3 text-center">Representante</th>
            </tr>
          </thead>
          <tbody id="tbodyConsulta">
          </tbody>

        </table>
      </div>
    </div>
  </div> <!-- /Tabla de servicios -->

  <div class="row" id="pnlInicio">
    <br>
    <div class="col-md-12" align="center">
      <img src="/img/cuentas/187789399.jpg" class="imgI img-responsive" />
      </div>
    </div>



@stop

@section('js')
{{HTML::script('sweetAlert/sweetalert.min.js')}}
{{HTML::script('js/administracion/asiAgregar.js')}}
@stop

@section('javascript')
  <script>
    $('#collapseAsignacion').addClass('in');
    $('#liAsignacion').addClass('activoBorde');
  </script>
@stop
