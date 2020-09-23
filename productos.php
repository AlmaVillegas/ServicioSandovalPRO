<?php
         session_start();
         if(!isset($_SESSION["username"]))
         {
            header("Location:../index.php");
         } 
    
require_once './ProductosyServicios/productosservicios.entidad.php';
require_once './ProductosyServicios/productosservicios.modelo.php';

// Logica
$ven = new ProductosServicios();
$model = new ProductosModel();


if(isset($_REQUEST['action']))
{ 
	switch($_REQUEST['action'])
	{
		  case 'actualizar':
            $ven->__SET('id',              $_REQUEST['id']);
            $ven->__SET('Descripcion',     $_REQUEST['Descripcion']);
  			    $ven->__SET('Precio',          $_REQUEST['Precio']);
            $ven->__SET('Venta',           $_REQUEST['Venta']);
  			    $ven->__SET('Cantidad',        $_REQUEST['Cantidad']);
            //$ven->__SET('Imagen',            $_REQUEST['Imagen']);
			      $model->Actualizar($ven);
            header('Location: productos.php');
          break;

          case 'buscar';
            $ven= $model->Buscar($_REQUEST['id']);
          break;

		  case 'registrar':
            $ven->__SET('id',              $_REQUEST['id']);
            $ven->__SET('Descripcion',     $_REQUEST['Descripcion']);
            $ven->__SET('Precio',          $_REQUEST['Precio']);
            $ven->__SET('Venta',           $_REQUEST['Venta']);
            $ven->__SET('Cantidad',        $_REQUEST['Cantidad']);
            
            $ven->__SET('Imagen',            $_REQUEST['Imagen']);

            $model->Registrar($ven);
            header('Location: productos.php');
		   break;

		  case 'eliminar':
			      $model->Eliminar($_REQUEST['id']);
			      header('Location: productos.php');
		   break;

          case 'editar':
      			$ven = $model->Obtener($_REQUEST['id']);
			    break;

      case 'cancelar':
            $ven->__SET('id',              $_REQUEST[' ']);
            $ven->__SET('Descripcion',     $_REQUEST[' ']);
            $ven->__SET('Precio',          $_REQUEST[' ']);
            $ven->__SET('Venta',           $_REQUEST[' ']);
            $ven->__SET('Cantidad',        $_REQUEST[' ']);
            break;
	}
}
?>
<!DOCTYPE html>
<html lang="es">
<SCRIPT Language=Javascript >
function soloLetras(e) {
        key = e.keyCode || e.which;
        tecla = String.fromCharCode(key).toLowerCase();
        letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
        especiales = [8, 37, 39, 46];

        tecla_especial = false
        for(var i in especiales) {
            if(key == especiales[i]) {
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla) == -1 && !tecla_especial)
            return false;
    }

function limpia() {

            var val = document.getElementById('Descripcion').value;
            var tam = val.length;
            for(i = 0; i < tam; i++) {
                if(!isNaN(val[i]))
                    document.getElementById('Descripcion').value = '';
            }
    }
</SCRIPT>
	<head>
		<title>Productos Y Servicios</title>
         <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
        
	</head>
    <body style="padding:15px;">
     
    <?php include "php/navbar.php"; ?>
    <div class="container">
    <div class="row">
    <div class="col-md-6">
      
         <?php if($_SESSION["username"]=='cliente')
              {
                echo '<input type="button" class="btn btn-default btn-lg" id="myBtn" value="Productos" disabled>';
              }
              else
              {
                echo '<input type="button" class="btn btn-default btn-lg" id="myBtn" value="Productos" >';
              }

         ?> 
           <button type="button" class="btn btn-primary" onClick="window.location='empresa.php'">Inventario</button>
          <div class="modal fade" id="myModal" role="dialog">
          <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
          <div class="modal-header" style="padding:35px 50px;" position="center">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4><span class="glyphicon"></span>Productos</h4>
          </div>
          <div class="modal-body" style="padding:40px 50px;">
                        
                <form action="?action=<?php echo $ven->id > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;" role="form"  enctype="multipart/form-data" >
                    <div class="form-group">
                    <input type="hidden" name="id"  value="<?php echo $ven->__GET('id'); ?>" />
                             <input type="text" name="id" value="<?php echo $ven->__GET('id'); ?>" /> <label style="text-align:left;">Id</label>                          
                            
                             <input type="submit" formaction="?action=buscar"  class="btn btn-default btn-lg" value="Buscar">
                   </div>
                   <div class="form-group">    
                             <label style="text-align:left;">Descripcion</label>  
                            <input type="text" name="Descripcion" value="<?php echo $ven->__GET('Descripcion'); ?>" onkeypress="return soloLetras(event)" onblur="limpia()" style="width:100%;" />
                   </div>
                   <div class="form-group"> 
                        <label style="text-align:left;">Precio</label> 
                       <input type="text" name="Precio" value="<?php echo $ven->__GET('Precio'); ?>" style="width:100%;" />
                   </div>
                   <div class="form-group"> 
                        <label style="text-align:left;">Precio A Venta</label> 
                        <input type="text" name="Venta" value="<?php echo $ven->__GET('Venta'); ?>" style="width:100%;" />
                   </div>
                   <div class="form-group"> 
                        <label style="text-align:left;">Cantidad</label>   
                        <input type="text" name="Cantidad" value="<?php echo $ven->__GET('Cantidad'); ?>" style="width:100%;" />
                    </div>
                   <div class="form-group"> 
                        <label style="text-align:left;">Minimo en Stock</label>   
                            <input type="text" name="Minimo" value="10" style="width:100%;" readonly/>
                    </div>
                     <div class="form-group"> 
                        <label style="text-align:left;">Imagen</label>  
                            <input type="file" name="Imagen" value="<?php echo $ven->__GET('Imagen'); ?>" />
                    </div>
                    <div class="modal-footer">    
                                <button type="submit" class="btn btn-default btn-lg">Guardar</button>
                                <button type="submit" class="btn btn-default btn-lg" action="?action=cancelar">Cancelar</button>
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
<br>
<br>
<br>
                <table class="pure-table pure-table-horizontal">
                    <thead>
                        <tr>
                            <th style="text-align:left;">Descripcion</th>
                            <th style="text-align:left;">Precio</th>
                            <th style="text-align:left;">PrecioALaVenta</th>
                            <th style="text-align:left;">Cantidad</th>
                            <th style="text-align:left;">STOCK</th>
                            <th style="text-align:left;">Imagen</th>
                            <th style="text-align:left;">Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach($model->Listar() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('Descripcion'); ?></td>
                            <td><?php echo $r->__GET('Precio'); ?></td>
                            <td><?php echo $r->__GET('Venta'); ?></td>
                            <td><?php echo $r->__GET('Cantidad'); ?></td>
                            <td><?php echo $r->__GET('Minimo'); ?></td>
                            <td><img width="50%" src="data:image/jpg; base64, <?php echo base64_encode($r->__GET('Imagen'));?>"/></td>
                            <td><?php echo $r->__GET('Status'); ?></td>
                             <td>
                                <a href="?action=editar&id=<?php echo $r->id; ?>" disabled="true" >Editar</a>
                            </td>
                            <td>
                                <a href="?action=eliminar&id=<?php echo $r->id; ?>" disabled="true" >Eliminar</a>
                            </td>
                        </tr>
                <?php endforeach; ?>
                </table> 
        </div>
        </div>
        </div>
     </body>
     </html>