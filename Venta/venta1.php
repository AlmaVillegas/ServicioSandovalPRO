<?php
	include('detallesVenta/class/classAsistencias.php');
  require_once './Cliente/Cliente.entidad.php';
  require_once './Cliente/Cliente.modelo.php';
	$clase = new sistema;
  $cli = new Cliente();
  $modelCli= new ClienteModel();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ventas</title> 
<link href="detallesVenta/bootstrap/css/bootstrap.css" rel="stylesheet">
<link href="detallesVenta/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="detallesVenta/bootstrap/css/bootstrap-theme.css" rel="stylesheet">
<link href="detallesVenta/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
<link href="detallesVenta/css/estilos.css" rel="stylesheet">
<script src="detallesVenta/js/jquery.js"></script>
<script src="detallesVenta/js/myjava.js"></script>
<script src="detallesVenta/bootstrap/js/bootstrap.min.js"></script>
<script src="detallesVenta/bootstrap/js/bootstrap.js"></script>
 <!--Grafica-->
         <script src="./code/highcharts.js"></script>
         <script src="./code/modules/exporting.js"></script>
         <script src="/code/highcharts-3d.js"></script>
</head>
<body>
  <?php include "php/navbar.php"; ?>
    <div class="container">
    <div class="row">
    <div class="col-md-6">
<section>
    <input type="button" value="Venta" id="nuevaAsistencia" class="btn btn-default btn-lg"/>
    <input type="submit" value="Reporte" class="btn btn-default btn-lg" onclick = "location='./Reportes/ReporteVentas.php'"/>
    <input type="submit" value="Ver Grafica" class="btn btn-default btn-lg" onclick = "location='./Graficas/GraficaVentas.php'"/>
    <br />
    <br />
    <table class="table table-bordered table-condensed table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>FECHA</th>
                <th>ID_CLIENTE</th>
                <th>PRODUCTOS</th>
                <th>ACCION</th>
            </tr>
        </thead>
        <tbody>
            <?php $clase->conexion();
                     $clase->mostrarAsistencias(); ?>
        </tbody>
    </table>
</section>

<!-- MODAL DE REGISTRO -->

 <div class="modal fade" id="modalAsistencia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel"><b>Registro de Ventas</b></h4>
            </div>
            <div class="modal-body">
            <fieldset><legend>1. Generar Venta</legend>
				<table class="tbl-registro" width="100%">
                	<tr>
                    	<td>Codigo</td>
                        <td><input type="text" class="form-control" id="codRegistro" maxlength="5"/></td>
                    	<td>Fecha</td>
                        <td><input type="text" class="form-control" value="<?php date_default_timezone_set("America/New_York"); echo date('Y-m-d'); ?>" style="width:110%;"/></td>
                        <td>Cliente</td>
                        <td>
                        <select id="id_cliente"  class="form-control" style="width:100%;">
                          <?php foreach ($modelCli->Listar1() as $r):
                              $var=$r->__GET('id');
                              echo "<option value='$var' >";
                              echo $r->__GET('Nombre');            
                              echo "</option>";
                            endforeach; ?> 
                        </select>  
                    </tr>
                    <tr>
                    	<td colspan="6"><input type="button" id="generarAsistencia" class="btn btn-success" value="Ingresar productos" /></td>
                    </tr>
                </table>
                </fieldset>
                <div id="mensaje"></div>
                <fieldset><legend>2. Registrar Productos</legend>
                <table class="tbl-registro" width="100%">
                	<tr>
                          <td>
                            <input type="text" id="Id_productosVenta" placeholder="Id" class="form-control"  />
                          </td>
                          <td>
                            <input type="text" id="Descripcion" placeholder="Descripcion" class="form-control" />
                          </td>
                          <td>
                            <input type="text" id="Precio" placeholder="Precio" class="form-control"/>
                          </td>
                          <td>
                            <input type="text" id="Cantidad" placeholder="Cantidad"  class="form-control" />
                          </td>
                          <td>
                            <input type="text" id="Importe"  placeholder="Importe" onChange="multiplicar();"  class="form-control"/>
                          </td>
                        <td><input type="button" id="regEstudiante" class="btn btn-primary" value="+" disabled="disabled"/></td>
                    </tr>
                </table>
                </fieldset>
                <br />
                <div id="contenidoRegistro"></div>
                <div class="modal-footer">
                   <input type="text" placeholder="Total" id="Total"  class="form-control" style="width:20%;" />
                  <br>
                  <br>
                	<input type="button" id="guardar" class="btn btn-default" value="Guardar"/>
                </div>
            </div>
          </div>
        </div>
   <!-- MODAL PARA MOSTRAR EL DETALLE -->

 <div class="modal fade" id="modalDetalle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel"><b>Detalle De La Venta</b></h4>
            </div>
            <div class="modal-body" id="datosAqui">
            </div>
          </div>
       </div>
   </div>     
</body>
</html>