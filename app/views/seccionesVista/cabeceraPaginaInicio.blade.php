<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="cache-control" content="max-age=0" />
  <meta http-equiv="cache-control" content="no-cache" />
  <meta http-equiv="cache-control" content="must-revalidate" />
  <meta name="author" content="edSantiago" />
  <meta http-equiv="expires" content="0" />
  <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
  <meta http-equiv="pragma" content="no-cache" />
  <link rel="icon" type="image/png" href="{{ URL::asset('img/favicon.png'); }}"/>

  <title>
    @section('title')
    @show
  </title>

  {{ HTML::style('css/bootstrap.min.css')}}
  {{ HTML::style('fonts/font-awesome/css/font-awesome.min.css') }}
  
  @section('css')
  @show
  @section('head')
  @show
</head>
