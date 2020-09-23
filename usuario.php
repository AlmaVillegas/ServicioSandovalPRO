<?php
         session_start();
         if(!isset($_SESSION["username"]))
         {
            header("Location:../index.php");
         } 
    
require_once './Usuario/usuario.entidad.php';
require_once './Usuario/usuario.modelo.php';

// Logica
$usu = new Usuario();
$model = new UsuarioModel();


if(isset($_REQUEST['action']))
{ 
	switch($_REQUEST['action'])
	{
		  case 'actualizar':
            $usu->__SET('id',              $_REQUEST['id']);
            $usu->__SET('Usuario',         $_REQUEST['Usuario']);
      			$usu->__SET('Password',        $_REQUEST['Password']);
      			$usu->__SET('Nombre',          $_REQUEST['Nombre']);
      			$usu->__SET('Imagen',          $_REQUEST['Imagen']);
		        $model->Actualizar($usu);
            header('Location: usuario.php');
          break;

          case 'buscar';
            $ven= $model->Buscar($_REQUEST['id']);
          break;

		  case 'registrar':
            $usu->__SET('id',              $_REQUEST['id']);
            $usu->__SET('Usuario',         $_REQUEST['Usuario']);
            $usu->__SET('Password',        $_REQUEST['Password']);
            $usu->__SET('Nombre',          $_REQUEST['Nombre']);
            $usu->__SET('Imagen',          $_REQUEST['Imagen']);

            $model->Registrar($usu);
            header('Location: usuario.php');
		   break;

		  case 'eliminar':
			      $model->Eliminar($_REQUEST['id']);
			      header('Location: usuario.php');
		   break;

          case 'editar':
      			$usu = $model->Obtener($_REQUEST['id']);
			    break;

      case 'cancelar':
            $ven->__SET('id',   $_REQUEST[' ']);
            $ven->__SET('Usuario', $_REQUEST[' ']);
            $ven->__SET('Password', $_REQUEST[' ']);
            $ven->__SET('Nombre', $_REQUEST[' ']);
            $ven->__SET('Imagen', $_REQUEST[' ']);
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
		<title>Usuario</title>
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
    <button type="button" class="btn btn-default btn-lg" id="myBtn">Usuario</button>
          <div class="modal fade" id="myModal" role="dialog">
          <div class="modal-dialog">
    
          <!-- Modal content-->
          <div class="modal-content">
          <div class="modal-header" style="padding:35px 50px;" position="center">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4><span class="glyphicon"></span>Usuario</h4>
          </div>
          <div class="modal-body" style="padding:40px 50px;">                    
                <form action="?action=<?php echo $usu->id > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;" role="form"  enctype="multipart/form-data" >
                   <div class="form-group">
                    <input type="hidden" name="id"  value="<?php echo $usu->__GET('id'); ?>" />
                   
                            <Label style="text-align:left;">Id</Label>
                             <input type="text" name="id" value="<?php echo $usu->__GET('id'); ?>" />
                             <input type="submit" formaction="?action=buscar"  class="btn btn-default btn-lg" value="Buscar"> 
                        </div>
                         <div class="form-group">
                            <Label style="text-align:left;">Uusuario</Label>
                            <input type="text" name="Usuario" value="<?php echo $usu->__GET('Usuario'); ?>" style="width:100%;" />
                        </div>
                         <div class="form-group">
                            <Label style="text-align:left;">Password</Label>
                            <input type="text" name="Password" value="<?php echo $usu->__GET('Password'); ?>" style="width:100%;" />
                        </div>
                        <div class="form-group">
                            <Label style="text-align:left;">Nombre</Label>
                            <input type="text" name="Nombre" value="<?php echo $usu->__GET('Nombre'); ?>" style="width:100%;" />
                        </div>
                        <div class="form-group">
                            <Label style="text-align:left;">Imagen</Label>
                            <input type="file" name="Imagen" value="<?php echo $usu->__GET('Imagen'); ?>"/>
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
                            <th style="text-align:left;">Usuario</th>
                            <th style="text-align:left;">Password</th>
                            <th style="text-align:left;">Nombre</th>
                            <th style="text-align:left;">Imagen</th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach($model->Listar() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('Usuario'); ?></td>
                            <td><?php echo $r->__GET('Password'); ?></td>
                            <td><?php echo $r->__GET('Nombre'); ?></td>
                            <td><img width="50%" src="data:image/jpg; base64, <?php echo base64_encode($r->__GET('Imagen'));?>"/></td>
                            <td>
                                <a href="?action=editar&id=<?php echo $r->id; ?>">Editar</a>
                            </td>
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