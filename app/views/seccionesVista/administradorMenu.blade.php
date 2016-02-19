<div class="menuAdmin">
  <ul class="nav nav-sidebar colorNav">

<div class="menuAdmin">
  <ul class="nav nav-sidebar colorNav">

<!-- /Reportes -->

</ul>
</div>
<br>
<div class="menuAdmin">
  <ul class="nav nav-sidebar colorNav">
    <li class="header" data-toggle="collapse" data-target="#collapseSesiones">
      <a class="grisClaro " href="{{ URL::to('administracion/cueEditar') }}"><strong>
        <h4><i class="fa fa-newspaper-o"></i>
          &nbsp;Cuestionarios
        </h4>
      </strong></a>
  <!--      <ul id="collapseSesiones" class="nav nav-sidebar colorNav collapse">
          <li id="liAgregarSesion">
              <a class="grisClaro " href="{{ URL::to('administracion/fueAgregar') }}">
                <i class="fa fa-th-list"></i> Consulta fuente
              </a>
          </li>
          <li id="liEditarSesion">
              <a class="grisClaro " href="{{ URL::to('administracion/fueEditar') }}">
                <span class="glyphicon glyphicon-edit"></span> Editar fuente
              </a>
          </li>
      </ul> -->
    </li>

    <li class="header" data-toggle="collapse" data-target="#collapseMiembros">
      <a class="grisClaro " style="cursor:pointer" ><!--<strong>
        <h4><i class="fa fa-users"></i>
          &nbsp;Integrantes
        </h4>
      </strong>--></a>
        <!--<ul id="collapseMiembros" class="nav nav-sidebar colorNav collapse">
          <li id="liEditarRe">
              <a class="grisClaro" href="{{ URL::to('administracion/resEditar') }}">
                <i class="fa fa-male"></i> Representantes
              </a>
          </li>
          <li id="liEditarEqu">
              <a class="grisClaro" href="{{ URL::to('administracion/intEditar') }}">
                <i class="fa fa-users"></i> Equipos
              </a>
          </li>
          <li id="liInvitados">
              <a class="grisClaro" href="{{ URL::to('administracion/invitados') }}">
                <i class="fa fa-star"></i> Invitados
              </a>
          </li>
      </ul>-->
    </li>


  <!--   <li class="header" data-toggle="collapse" data-target="#collapseIntegrantes">
      <a class="grisClaro " href="{{ URL::to('administracion/intEditar') }}"><strong>
        <h4><i class="fa fa-users"></i>
          &nbsp;Integrantes
        </h4>
      </strong></a> -->
    <!--    <ul id="collapseIntegrantes" class="nav nav-sidebar colorNav collapse">
          <li id="liAgregarIn">
              <a class="grisClaro " href="{{ URL::to('administracion/intAgregar') }}">
                <i class="fa fa-th-list"></i> Consultar integrantes
              </a>
          </li>
          <li id="liEditarIn">
              <a class="grisClaro" href="{{ URL::to('administracion/intEditar') }}">
                <span class="glyphicon glyphicon-edit"></span> Editar integrantes
              </a>
          </li>
      </ul> -->
  <!--    </li> -->

        <li class="header" data-toggle="collapse" data-target="#collapseAsignacion" >
          <a class="grisClaro" collapseAsignacion style="cursor:pointer"><!--<strong>
            <h4><i class="fa fa-calendar"></i>
              &nbsp;Asignaciones
            </h4>
          </strong>--></a>

            <!--<ul id="collapseAsignacion" class="nav nav-sidebar colorNav collapse">
              <li id="liPeAgregar">
                  <a class="grisClaro" href="{{ URL::to('administracion/perAgregar') }}">
                    <i class="fa fa-calendar-o"></i> Períodos
                  </a>
              </li>
              <li id="liAsignacion">
                  <a class="grisClaro" href="{{ URL::to('administracion/asiAgregar') }}">
                    <i class="fa fa-calendar-times-o"></i> Fuentes y representantes
                  </a>
              </li>
              <li id="liAsigEditar">
                  <a class="grisClaro" href="{{ URL::to('administracion/asiEditar') }}">
                    <span class="glyphicon glyphicon-edit"></span> Editar asignación periódica
                  </a>
              </li>
          </ul>-->
        </li>


        <li class="header" data-toggle="collapse" data-target="#collapsePrevi" >
          <a class="grisClaro" collapseAsignacion style="cursor:pointer"><!--<strong>
            <h4><i class="fa fa-file-text"></i>
              &nbsp; Estatus de información por enviar
            </h4>
          </strong>--></a>

              <!--<ul id="collapsePrevi" class="nav nav-sidebar colorNav collapse">

              <li id="liGeneral">
                  <a class="grisClaro" href="{{ URL::to('administracion/prevGeneral') }}">
                    <i class="fa fa-bars"></i> Fuentes ingresadas y no ingresadas
                  </a>
              </li>
              <li id="liSimplificada">
                  <a class="grisClaro" href="{{ URL::to('administracion/prevSimplificada') }}">
                    <i class="fa fa-th-list"></i> Vista simplificada de fuentes ingresadas
                  </a>
              </li>
              <li id="liEspecifica">
                  <a class="grisClaro" href="{{ URL::to('administracion/previsualizar') }}">
                    <i class="fa fa-list-alt"></i> Vista específica de fuentes ingresadas
                  </a>
              </li>
          </ul>-->
        </li>


        <li class="header" data-toggle="collapse" data-target="#collapseReportes" >
          <a class="grisClaro" collapseAsignacion style="cursor:pointer"><!--<strong>
            <h4><i class="fa fa-file-text"></i>
              &nbsp;Reportes
            </h4>
          </strong>--></a>

              <!--<ul id="collapseReportes" class="nav nav-sidebar colorNav collapse">
                <li id="liPPeriodo">
                    <a class="grisClaro" href="{{ URL::to('administracion/repPeriodo') }}">
                      <i class="fa fa-calendar-o"></i> Reporte general
                    </a>
                </li>

                <li id="liFuente">
                    <a class="grisClaro" href="{{ URL::to('administracion/repFuente') }}">
                      <i class="fa fa-newspaper-o"></i> Reporte por fuente y período
                    </a>
                </li>

                <li id="liRepresentante">
                    <a class="grisClaro" href="{{ URL::to('administracion/repRepresentante') }}">
                      <i class="fa fa-male"></i> Reporte por representante y período
                    </a>
                </li>
          </ul>-->
        </li>



      </ul>
    </div>
