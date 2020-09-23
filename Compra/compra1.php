<?php
         session_start();
         if(!isset($_SESSION["username"]))
         {
            header("Location:../index.php");
         } 
    
require_once './Compra/compra.entidad.php';
require_once './Compra/compra.modelo.php';

// Logica
$com = new Compra();
$model = new CompraModel();


if(isset($_REQUEST['action']))
{ 
	switch($_REQUEST['action'])
	{
		      case 'actualizar':

            $com->__SET('id',              $_REQUEST['id']);
            $com->__SET('Fecha',            $_REQUEST['Fecha']);
      	    $com->__SET('Id_proveedor',     $_REQUEST['Id_proveedor']);
        		$com->__SET('Id_productosCompra', $_REQUEST['Id_productosCompra']);
        		$com->__SET('Descripcion',        $_REQUEST['Descripcion']);
            $com->__SET('Cantidad',           $_REQUEST['Cantidad']);
            $com->__SET('PrecioUnitario',     $_REQUEST['PrecioUnitario']);
            $com->__SET('Total',          $_REQUEST['Total']);
			      $model->Actualizar($com);
            header('Location: compra.php');
          break;

          case 'buscar';
            $com= $model->Buscar($_REQUEST['id']);
          break;

		      case 'registrar':
            $com->__SET('Fecha',            $_REQUEST['Fecha']);
            $com->__SET('Id_proveedor',     $_REQUEST['Id_proveedor']);
            $com->__SET('Id_productosCompra', $_REQUEST['Id_productosCompra']);
            $com->__SET('Descripcion',        $_REQUEST['Descripcion']);
            $com->__SET('Cantidad',           $_REQUEST['Cantidad']);
            $com->__SET('PrecioUnitario',     $_REQUEST['PrecioUnitario']);
            $com->__SET('Total',          $_REQUEST['Total']);

            $model->Registrar($com);
            header('Location: compra.php');
			    break;

		      case 'eliminar':
			      $model->Eliminar($_REQUEST['id']);
			      header('Location: compra.php');
			    break;

          case 'editar':
      			$com = $model->Obtener($_REQUEST['id']);
			    break;

      case 'cancelar':
            $com->__SET('id',   $_REQUEST[' ']);
            $com->__SET('Fecha', $_REQUEST[' ']);
            $com->__SET('Id_proveedor', $_REQUEST[' ']);
            $com->__SET('Id_productosCompra', $_REQUEST[' ']);
            $com->__SET('Descripcion', $_REQUEST[' ']);
            $com->__SET('Cantidad', $_REQUEST[' ']);
            $com->__SET('PrecioUnitario', $_REQUEST[' ']);
            $com->__SET('Total', $_REQUEST[' ']);
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
		<title>Compras</title>
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
    <button type="button" class="btn btn-default btn-lg" id="myBtn">Compras</button>
          <div class="modal fade" id="myModal" role="dialog">
          <div class="modal-dialog">

          <div class="modal-content">
          <div class="modal-header" style="padding:35px 50px;" position="center">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4><span class="glyphicon"></span>Compras</h4>
          </div>
          <div class="modal-body" style="padding:40px 50px;">     
                <form action="?action=<?php echo $com->id > 0 ? 'actualizar' : 'registrar'; ?>" method="post" oninput="Total.value=parseInt(Cantidad.value)*parseInt(PrecioUnitario.value)" class="pure-form pure-form-stacked" style="margin-bottom:30px;" role="form">
                    <div class="form-group">
                    <input type="hidden" name="id"  value="<?php echo $com->__GET('id'); ?>" />
                            <label style="text-align:left;">Id</label> 
                             <input type="text" name="id" value="<?php echo $com->__GET('id'); ?>" />
                             <input type="submit" formaction="?action=buscar"  class="btn btn-default btn-lg" value="Buscar"> 
                         </div>
                        <div class="form-group">
                            <LABEL style="text-align:left;">Fecha</LABEL>
                            <input type="date" name="Fecha" value="<?php echo $com->__GET('Fecha'); ?>" style="width:100%;" />
                        </div>
                        <div class="form-group">
                            <LABEL style="text-align:left;">Id_proveedor</LABEL>
                            <input type="text" name="Id_proveedor" value="<?php echo $com->__GET('Id_proveedor'); ?>" style="width:100%;" />
                        </div>
                        <div class="form-group">
                            <LABEL style="text-align:left;">Id_producto</LABEL>
                            <input type="text" name="Id_productosCompra" value="<?php echo $com->__GET('Id_productosCompra'); ?>" style="width:100%;" />
                        </div>
                        <div class="form-group">
                            <LABEL style="text-align:left;">Descripcion</LABEL>
                            <input type="text" name="Descripcion" value="<?php echo $com->__GET('Descripcion'); ?>" onkeypress="return soloLetras(event)" onblur="limpia()" style="width:100%;" />
                        </div>
                          <div class="form-group">
                            <LABEL style="text-align:left;">Cantidad</LABEL>
                            <input type="text" name="Cantidad" value="<?php echo $com->__GET('Cantidad'); ?>" style="width:100%;" /></td>
                        </div>
                         <div class="form-group">
                            <LABEL style="text-align:left;">PrecioUnitario</LABEL>
                            <input type="text" name="PrecioUnitario" value="<?php echo $com->__GET('PrecioUnitario'); ?>" style="width:100%;" />
                        </div>
                        <div class="form-group">
                            <LABEL style="text-align:left;">Total</LABEL>
                            <input type="text" name="Total" for="Cantidad PrecioUnitario" value="<?php echo $com->__GET('Total'); ?>" style="width:100%;" />
                        </div>
                        <div class="modal-footer"> 
                                <button type="submit" class="btn btn-default btn-lg">Guardar</button>
                                <button type="submit" class="btn btn-default btn-lg" action="?action=editar">Editar</button>
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
                            <th style="text-align:left;">Fecha</th>
                            <th style="text-align:left;">Id_proveedor</th>
                            <th style="text-align:left;">Id_producto</th>
                            <th style="text-align:left;">Descripcion</th>
                            <th style="text-align:left;">Cantidad</th>
                            <th style="text-align:left;">PrecioUnitario</th>
                            <th style="text-align:left;">Total</th>
                            <th style="text-align:left;">Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach($model->Listar() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('Fecha'); ?></td>
                            <td><?php echo $r->__GET('Id_proveedor'); ?></td>
                            <td><?php echo $r->__GET('Id_productosCompra'); ?></td>
                            <td><?php echo $r->__GET('Descripcion'); ?></td>
                            <td><?php echo $r->__GET('Cantidad'); ?></td>
                            <td><?php echo $r->__GET('PrecioUnitario'); ?></td>
                            <td><?php echo $r->__GET('Total'); ?></td>
                            <td><?php echo $r->__GET('Status'); ?></td>
                            <td>
                                <a href="?action=eliminar&id=<?php echo $r->id; ?>">Eliminar</a>
                            </td>
                        </tr>
                <?php endforeach; ?>
                </table>  
            </div>
          </div>
        </div> 
    </body>
</html>