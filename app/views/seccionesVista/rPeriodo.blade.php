<div class="row">
<center><h2><i class="fa fa-calendar-o text-primary"></i> Reporte General</h2></center>
  <div class="col-md-12">

     <input type="hidden" name="_token" id="token" value="<?php echo csrf_token(); ?>">
     <p class="text-primary">
       <i class="fa fa-info-circle"></i> Este reporte es especifico por período y general por fuente y representante.
     </p>

    <h3>Seleccionar período:</h3>
    <div class="form-group" id="groupNueva2">
      <label for="txtFechaInicio" class="col-md-3 control-label">*Fecha inicio: </label>
      <div class="col-md-5">

        <div class="input-group date" data-provide="datepicker">
          <input type="text" class="form-control" id="txtFechaInicio">
          <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
          </div>
        </div>

      </div>
    </div>
    <br><br>

       <div class="form-group" id="p">
        <label for="txtDias" class="col-md-3 control-label">* Fecha Fin: </label>
        <div class="col-md-5">
        <div class="input-group date" data-provide="datepicker">
          <input type="text" class="form-control" id="txtFechaFin">
          <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
          </div>
        </div>

        </div>
      </div>


    <br><br>
    <center><button id="btnSeleccionar" class="btn btn-primary"><i class="fa fa-file-text"></i> Ver reporte</button></center>


<br><br>

    <div class="table-responsive" id="tblRep">
      <h3>Fuente de información del período seleccionado:</h3>
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th class="col-md-1">Fuente</th>
            <th class="col-md-2">Titulo</th>
            <th class="col-md-7">Contenido</th>
            <th class="col-md-1">Fecha</th>
            <th class="col-md-1 text-center">Representante</th>
          </tr>
        </thead>
        <tbody id="tbodyRep"></tbody>
      </table>
    </div>
  </div>
</div> <!-- /Tabla de servicios -->
