<html>
  <head>
    <title></title>
  </head>

  <body>
    <p><h3><strong>{{$titulo}}</strong></h3></p>
    <p><strong>Período: </strong>{{$periodo}}      
    </p>

    <table cellspacing="0"  border="1" align="center" width="400" >
      <thead >
        <tr>
          <th width="3%" >
            <div align="center">
            </div>
          </th>
          <th width="20%" >
            <div align="center">
              <h5><strong>Fuente</strong> </h5>
            </div>
          </th>
          <th width="20%">
            <div align="center">
              <h5><strong>Responsable</strong> </h5>
            </div>
          </th>
        </tr>

        <tbody >
          {{$body}}
        </tbody>


       </table>

  </body>
</html>
