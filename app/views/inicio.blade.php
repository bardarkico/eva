@extends('layoutInicio')

@section('head')
@stop

@section('title')
  Vázquez Hernández Contadores, S. C.
@stop

@section('css')
  {{ HTML::style('css/inicio.css') }}
@stop

@section('content')
<body class="fondo">
  <div class="row">
    <div class="col-md-12 text-center fondo2">
      <h3 class="textTitulo"><i class="fa fa-newspaper-o text-primary"></i> Sistema de noticias</h3>
    </div>
  </div>
<br>
  <div class="container">

<div class="row">
  <div class="col-md-6">

    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header"><i class="fa fa-user text-primary"></i> Iniciar Sesión</h2>
        </div>
        <div class="col-lg-12">

            <ul id="myTab" class="nav nav-tabs nav-justified">
                <li class="active"><a href="#service-one" data-toggle="tab"><i class="fa fa-users"></i> Responsables</a>
                </li>
                <li class=""><a href="#service-two" data-toggle="tab"><i class="fa fa-user-plus"></i> Administrador</a>
                </li>
            </ul>

            <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade active in" id="service-one">




                     <div class="well trasparenteClaroPlus" id="pnlMensaje">

                       <div class="row" id="pnlAdmin">
                         <div class="col-md-12">

                         <h3 class="text-center grisObscuro"> <strong><i class="fa fa-users"></i> Responsables</strong></h3>
                         {{ Form::open(array('url' => 'login', 'method' => 'post', 'class' => 'form-signin')) }}
                               <div class="control-group form-group">
                                 <div class="input-group">
                                   <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                   {{ Form::text('usuario', null,
                                       array('placeholder' => 'Usuario Responsable','title' => 'Ingrese su correo institucional', 'class' => 'form-control', 'maxlength' => '50', 'required')); }}
                                 </div>
                               </div>

                               <div class="control-group form-group">
                                 <div class="input-group">
                                   <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                     {{ Form::password('pass',
                                       array('placeholder' => 'Contraseña','title' => 'Ingrese la contraseña', 'class' => 'form-control', 'required')); }}
                                 </div>
                               </div>
                               {{ Form::submit('Login', array('class' => 'btn btn-primary btn-block')); }}
                             {{ Form::close() }}
                             <br>
                             <input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">

                       </div>

                     </div>  <!-- /Login -->

                     </div>



                </div>
                <div class="tab-pane fade" id="service-two">



                                       <div class="well trasparenteClaroPlus" id="pnlMensaje">

                                         <div class="row" id="pnlAdmin">
                                           <div class="col-md-12">

                                           <h3 class="text-center grisObscuro"> <strong><i class="fa fa-user-plus"></i> Administrador</strong></h3>
                                           {{ Form::open(array('url' => 'loginA', 'method' => 'post', 'class' => 'form-signin')) }}
                                                 <div class="control-group form-group">
                                                   <div class="input-group">
                                                     <span class="input-group-addon"><i class="fa fa-user-plus"></i></span>
                                                     {{ Form::text('usuario', null,
                                                         array('placeholder' => 'Usuario Administrador', 'title' => 'Ingrese usuario administrador', 'class' => 'form-control', 'maxlength' => '50', 'required')); }}
                                                   </div>
                                                 </div>

                                                 <div class="control-group form-group">
                                                   <div class="input-group">
                                                     <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                                       {{ Form::password('pass',
                                                         array('placeholder' => 'Contraseña','title' => 'Ingrese contraseña', 'class' => 'form-control', 'required')); }}
                                                   </div>
                                                 </div>
                                                 {{ Form::submit('Login', array('class' => 'btn btn-primary btn-block')); }}
                                               {{ Form::close() }}
                                               <br>
                                               <input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">

                                         </div>

                                       </div>  <!-- /Login -->

                                       </div>



                </div>

            </div>

        </div>
    </div>


  </div>

  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-body">
        <img src="/img/474726969.jpg" class="imgI img-responsive" />
      </div>
    </div>

  </div>

</div>


<br><br><br><br><br>


    <div class="row">
      <div class="col-md-12 text-center">
        <h4>  <i class="fa fa-newspaper-o text-primary"></i>&nbsp;&nbsp; F u e n t e s &nbsp;&nbsp;  d e &nbsp;&nbsp;  i n f o r m a c i ó n : </h4>
      </div>
    </div>
    <marquee behavior="scroll" scrollamount=3 direction="left">
      D.O.F. &nbsp;&nbsp;&nbsp;&nbsp; GACETA DF &nbsp;&nbsp;-&nbsp;&nbsp; GACETA CUN &nbsp;&nbsp;-&nbsp;&nbsp; WEB SHCP &nbsp;&nbsp;-&nbsp;&nbsp; WEB INFONAVIT &nbsp;&nbsp;-&nbsp;&nbsp; WEB IMSS &nbsp;&nbsp;-&nbsp;&nbsp; WEB DF &nbsp;&nbsp;-&nbsp;&nbsp; WEB INFONACOT &nbsp;&nbsp;-&nbsp;&nbsp; WEB CCPM &nbsp;&nbsp;-&nbsp;&nbsp; ECONOMISTA &nbsp;&nbsp;-&nbsp;&nbsp; FINANCIERO &nbsp;&nbsp;-&nbsp;&nbsp; IDC &nbsp;&nbsp;-&nbsp;&nbsp; DOFISCAL &nbsp;&nbsp;-&nbsp;&nbsp; PAF &nbsp;&nbsp;-&nbsp;&nbsp; IMCP &nbsp;&nbsp;-&nbsp;&nbsp; PRODECON &nbsp;&nbsp;-&nbsp;&nbsp; STPS
     </marquee>

  </div>
  {{ HTML::script('js/jquery.js') }}
  {{HTML::script('sweetAlert/sweetalert.min.js')}}
  {{HTML::script('js/jquery.tablesorter.min.js')}}
  {{HTML::script('js/jquery.highlight-5.js')}}
</body>
@stop
