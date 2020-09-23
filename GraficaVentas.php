<?php
        session_start(); 
         if(!isset($_SESSION["username"]))
         {
            header("Location:../index.php");
         }

        include('DetalleVenta/class/classAsistencias.php');
        $clase = new sistema;                   
 ?>
<html>
    <head>
        <title>Estadistica</title>
        <meta charset="UTF-8">
        <script type="text/javascript" src="./Graficas/js/jquery.js"></script>
        <script type="text/javascript" src="./Graficas/js/chartJS/Chart.min.js"></script>

        <!--Detalle de mis ventas-->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="DetalleVenta/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="DetalleVenta/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="DetalleVenta/bootstrap/css/bootstrap-theme.css" rel="stylesheet">
        <link href="DetalleVenta/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
        <link href="DetalleVenta/css/estilos.css" rel="stylesheet">
        <script src="DetalleVenta/js/jquery.js"></script>
        <script src="DetalleVenta/js/myjava.js"></script>
        <script src="DetalleVenta/bootstrap/js/bootstrap.min.js"></script>
        <script src="DetalleVenta/bootstrap/js/bootstrap.js"></script>

         <div class="jumbotron text-center">
            <h1>Servicio Sandoval</h1>
            <p>Servicios De Cambio De Aceite Y Afinación</p> 
        </div>

    </head>
    <style>
        .caja{
            margin: auto;
            max-width: 250px;
            padding: 20px;
            border: 1px solid #BDBDBD;
        }
        .caja select{
            width: 100%;
            font-size: 16px;
            padding: 5px;
        }
        .resultados{
            margin: auto;
            margin-top: 40px;
            width: 1000px;
        }
    </style>
    <body> 
     <button type="button" class="<?php echo $vboton; ?>" onClick="window.location='caja.php'">Regresar a Ventas</button>
        <div class="caja">
            <select onChange="mostrarResultados(this.value);">
                <?php
                    for($i=2018;$i<2025;$i++){
                        if($i == 2018){
                            echo '<option value="'.$i.'" selected>'.$i.'</option>';
                        }else{
                            echo '<option value="'.$i.'">'.$i.'</option>';
                        }
                    }
                ?>
            </select>
        </div>
        <h1><center>Ventas</center></h1>
        <div class="resultados"><canvas id="grafico"></canvas></div>
    </body>
    <script>
            $(document).ready(mostrarResultados(2018));  
                function mostrarResultados(año){
                    $.ajax({
                        type:'POST',
                        url:'Graficas/controladorVenta/procesar.php',
                        data:'año='+año,
                        success:function(data){

                            var valores = eval(data);

                            var e   = valores[0];
                            var f   = valores[1];
                            var m   = valores[2];
                            var a   = valores[3];
                            var ma  = valores[4];
                            var j   = valores[5];
                            var jl  = valores[6];
                            var ag  = valores[7];
                            var s   = valores[8];
                            var o   = valores[9];
                            var n   = valores[10];
                            var d   = valores[11];
                                
                            var Datos = {
                                    labels : ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                                    datasets : [
                                        {
                                            fillColor : 'rgba(91,228,146,0.6)', //COLOR DE LAS BARRAS
                                            strokeColor : 'rgba(57,194,112,0.7)', //COLOR DEL BORDE DE LAS BARRAS
                                            highlightFill : 'rgba(73,206,180,0.6)', //COLOR "HOVER" DE LAS BARRAS
                                            highlightStroke : 'rgba(66,196,157,0.7)', //COLOR "HOVER" DEL BORDE DE LAS BARRAS
                                            data : [e, f, m, a, ma, j, jl, ag, s, o, n, d]
                                        }
                                    ]
                                }
                                
                            var contexto = document.getElementById('grafico').getContext('2d');
                            window.Barra = new Chart(contexto).Bar(Datos, { responsive : true });
                        }
                    });
                    return false;
                }
    </script>
<section>
    <br />
    <input type="submit" value="Reporte" class="btn btn-default btn-lg" onclick = "location='./Reportes/ReporteVentas.php'"/>
    <br />
    <br />
    <table class="table table-bordered table-condensed table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>FECHA</th>
                <th>PRODUCTOS</th>
                <th>TOTAL</th>
                <th>ACCION</th>
            </tr>
        </thead>
        <tbody>
            <?php $clase->conexion();
                     $clase->mostrarAsistencias(); ?>
        </tbody>
    </table>
</section>
<div class="modal fade" id="modalDetalle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel"><b>Ventas</b></h4>
            </div>
            <div class="modal-body" id="datosAqui">

            </div>
          </div>
       </div>
   </div> 











</html>