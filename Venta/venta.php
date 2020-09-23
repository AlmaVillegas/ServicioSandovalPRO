<?php
         session_start();
         if(!isset($_SESSION["username"]))
         {
            header("Location:../index.php");
         } 
    
require_once './Venta/venta.entidad.php';
require_once './Venta/venta.modelo.php';
require_once './Cliente/Cliente.entidad.php';
require_once './Cliente/Cliente.modelo.php';
require_once './Venta/detalle.entidad.php';
require_once './Venta/detalle.modelo.php';
require_once './ProductosVen/ProductosVen.modelo.php';
require_once './ProductosVen/ProductosVen.entidad.php';

// Logica
$ven = new Venta();
$model = new VentaModel();
$cli = new Cliente();
$modelCli= new ClienteModel();
$det= new DetalleVenta();
$modelDel= new DetalleModel();
$pro = new ProductosVen();
$modelPro = new VentaPModel(); 

if(isset($_REQUEST['action']))
{ 
	switch($_REQUEST['action'])
	{
		  case 'actualizar':
            $ven->__SET('id',               $_REQUEST['id']);
            $ven->__SET('Fecha',            $_REQUEST['Fecha']);
      			$ven->__SET('Id_cliente',       $_REQUEST['Id_cliente']);
            $det->__SET('id_venta',         $_REQUEST['id']);
      			$det->__SET('Id_productosVenta',$_REQUEST['Id_productosVenta']);
      			$det->__SET('Descripcion',      $_REQUEST['Descripcion']);
            $det->__SET('Cantidad',         $_REQUEST['Cantidad']);
            $det->__SET('Precio',           $_REQUEST['Precio']);
            $det->__SET('Importe',          $_REQUEST['Importe']);
		        $model->Actualizar($ven);
            header('Location: venta.php');
          break;

          case 'buscar';
            $ven= $model->Buscar($_REQUEST['id']);
          break;

		  case 'registrar1':
            $ven->__SET('id')
            $ven->__SET('Fecha',        $_REQUEST['Fecha']);
            $ven->__SET('Id_cliente',   $_REQUEST['Nombrecli']);
            //$ven->__SET('Total',        $_REQUEST['Total']);
            
            $model->Registrar($ven);
            header('Location: venta.php');
		   break;
       case 'registrar2':
            $det->__SET('Id_venta',           $_REQUEST['Id_venta[]']);
            $det->__SET('Id_productosVenta',  $_REQUEST['Id_productosVenta[]']);
            $det->__SET('Descripcion',        $_REQUEST['Descripcion[]']);
            $det->__SET('Cantidad',           $_REQUEST['Cantidad[]']);
            $det->__SET('Precio',             $_REQUEST['Precio[]']);
            $det->__SET('Importe',            $_REQUEST['Importe[]']);
            $modelDel->Registrar($det);
            header('Location: venta.php');
       break;

		  case 'eliminar':
			      $model->Eliminar($_REQUEST['id']);
			      header('Location: venta.php');
		   break;

          case 'editar':
      			$ven = $model->Obtener($_REQUEST['id']);
			    break;

      case 'cancelar':
            $ven->__SET('id',   $_REQUEST[' ']);
            $ven->__SET('Fecha', $_REQUEST[' ']);
            $ven->__SET('Id_cliente', $_REQUEST[' ']);
            $ven->__SET('Id_productosVenta', $_REQUEST[' ']);
            $ven->__SET('Descripcion', $_REQUEST[' ']);
            $ven->__SET('Cantidad', $_REQUEST[' ']);
            $ven->__SET('Precio', $_REQUEST[' ']);
            $ven->__SET('Importe', $_REQUEST[' ']);
            break;
      case 'idVenta':
            $codigo= $model->idVenta();
      break;

	}
}

?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Venta</title>
       <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-beta1/jquery.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
         <!--Grafica-->
         <script src="./code/highcharts.js"></script>
         <script src="./code/modules/exporting.js"></script>
         <script src="/code/highcharts-3d.js"></script>
         
         <meta charset="utf-8">
        <style>
          .modal-header, h4, .close {
          background-color: #0B2161;
          color:white !important;
          text-align: center;
          font-size: 30px;
          }
          .modal-body {
          background-color: #f9f9f9;
          }
      </style> 

      <script>
      
        $(function(){
        // Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
        $("#btnNuevoProducto").on('click', function(){
          $("#tablaProductos tbody tr:eq(0)").clone().removeClass('fila-fija').appendTo("#tablaProductos");
        });
        // Evento que selecciona la fila y la elimina 
        $(document).on("click",".eliminar",function(){
          var parent = $(this).parents().get(0);
          $(parent).remove();
        });
      });
    </script>
</head>
<body style="padding:15px;">
        
<?php include "php/navbar.php"; ?>
<div class="container">
<div class="row">
<div class="col-md-6">
<button type="button" class="btn btn-default btn-lg" id="myBtn">Ventas</button>
<div class="modal fade" id="myModal" role="dialog">
<div class="modal-dialog modal-lg">
  <div class="modal-content">
  <div class="modal-header" style="padding:35px 50px;" position="center">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4><span class="glyphicon"></span>Ventas</h4>
  </div>
  <div class="modal-body" style="padding:40px 50px;">                    
  <form method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;" role="form" >
      <div class="form-group">
        <input type="hidden" name="id"  value="<?php echo $ven->__GET('id'); ?>" />
      </div>
      <Label style="text-align:left;">Folio venta</Label>
          <input type="text" name="Id_venta" value="<?php ?>" style="width:20%;"/>
      <div class="form-group">
          <Label style="text-align:left;">Fecha</Label>
          <input type="text" name="Fecha"  value="<?php date_default_timezone_set("America/New_York"); echo date("Y-m-d");
           ?> <?php echo $ven->__GET('Fecha'); ?>" style="width:20%;" />
      </div>
      <div class="form-group">
          <Label style="text-align:left;">Cliente</Label>
              <select name="Nombrecli">
                  <?php foreach ($modelCli->Listar1() as $r):
                      $var=$r->__GET('id');
                      echo "<option value='$var' >";
                      echo $r->__GET('Nombre');            
                      echo "</option>";
                    endforeach; ?> 
               </select>      
      </div>
          <button type="submit" formaction="?action=registrar1" class="btn btn-default btn-lg" >CrearVenta</button>
      <table class="table table-bordered table-hover" id="tablaProductos">
          <tr class="fila-fija">
              <td>
                <input type="text" name="Id_productosVenta" placeholder="Id" style="width:100%;" />
              </td>
              <td>
                <input type="text" name="Descripcion" placeholder="Producto" style="width:100%;" />
              </td>
              <td>
                <input type="text" name="Precio" placeholder="Precio" style="width:70%;" />
              </td>
              <td>
                <input type="text" name="Cantidad" placeholder="Cantidad" style="width:70%;" />
              </td>
              <td>
                <input type="text" name="Importe" placeholder="Importe" style="width:70%;"/>
              </td>
             
              <td class="eliminar"><input type="button"   value="Menos -"/></td>
          </tr>

          </table>
          <div class="form-group">
            <Label style="text-align:left;">Total</Label>
            <input type="text" name="Total" style="width:20%;" />
          </div>
          <div class="btn btn-success" id="btnNuevoProducto">AgregarProducto</div>
           <div class="modal-footer"> 
                  <button type="submit" formaction="?action=registrar2" class="btn btn-default btn-lg">Generar Venta</button>
           </div>
  </form>
  </div>
 </div>
</div>
</div>
<script>
$(document).ready(function(){
    $("#myBtn").click(function(){
        $("#myModal").modal();
    });
});
</script>
     
       <button  id="openBt" data-toggle="moda" class="btn btn-default btn-lg">Ver Grafica</button>
       <div class="modal fade" id="Moda">
              <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-body">
                      <div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
                      <script type="text/javascript">

                          Highcharts.chart('container', {
                              chart: {
                                  type: 'column',
                                  options3d: {
                                      enabled: true,
                                      alpha: 10,
                                      beta: 25,
                                      depth: 70
                                  }
                              },
                              title: {
                                  text: 'Servicio Sandoval'
                              },
                              subtitle: {
                                  text: 'Ventas X Mex'
                              },
                              plotOptions: {
                                  column: {
                                      depth: 25
                                  }
                              },
                              xAxis: {
                                  categories: Highcharts.getOptions().lang.shortMonths,
                                  labels: {
                                      skew3d: true,
                                      style: {
                                          fontSize: '16px'
                                      }
                                  }
                              },
                              yAxis: {
                                  title: {
                                      text: null
                                  }
                              },
                              series: [{
                                  name: 'Ventas',
                                  data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 460, 225, 0]
                              }]
                          });
                    </script>

                    </div>
                </div>
              </div>
            </div>
          </div>
          <script>
            $(document).ready(function(){
                $("#openBt").click(function(){
                    $("#Moda").modal();
                });
            });
         </script>
<br>
<br>
<br>
  <table class="pure-table pure-table-horizontal">
    <thead>
      <tr>
          <th style="text-align:left;">RFC</th>
          <th style="text-align:left;">Nombre</th>
          <th style="text-align:left;">Fecha</th>
          <th style="text-align:left;">Status</th>
          <th></th>
      </tr>
    </thead>
    <?php foreach($model->Listar() as $r): ?>
      <tr>
          <td><?php echo $r->__GET('RFC'); ?></td>
          <td><?php echo $r->__GET('Nombre'); ?></td>
          <?php $d=$r->__GET('ventas'); ?>
          <td><?php echo $d->__GET('Fecha'); ?></td>
          <td><?php echo $d->__GET('Status'); ?></td>
          <td>
            <button href="#Modal" id="openBtn" data-toggle="modal" class="btn btn-primary" 
            onClick= "verDetalle('.$mostrar['<?php  echo $id; ?>'].')>">Descripcion</button>
              <div class="modal fade" id="Modal">
              <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h3 class="modal-title">Detalle De La Venta</h3>
                </div>
                <div class="modal-body">
                  <table class="table table-striped" id="tblGrid">
                    <thead id="tblHead">
                      <tr>
                            <th style="text-align:left;">Fecha</th>
                            <th style="text-align:left;">Descripción</th>
                            <th style="text-align:left;">Cantidad</th>
                            <th style="text-align:left;">Precio</th>
                            <th style="text-align:left;">Importe</th>
                            <th style="text-align:left;">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                    <tr>
                      <?php foreach($model->Listar1() as $ven): ?>
                      <td><?php echo $ven->__GET('Fecha'); ?></td>
                      <?php $d=$ven->__GET('detalles'); ?>
                      <td><?php echo $d->__GET('Descripcion'); ?></td>
                      <td><?php echo $d->__GET('Cantidad'); ?></td>
                      <td><?php echo $d->__GET('Precio'); ?></td>
                      <td><?php echo $d->__GET('Importe'); ?></td>
                      <td><?php echo $ven->__GET('Status'); ?></td>
                      </tr>
                    </tbody>
                       <?php endforeach; ?>
                  </table>
                  </div>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </tr>
            <?php endforeach; ?>
          </table>
         </div>
        </div> 
       </div>
      </body>
    </html>