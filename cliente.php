<?php
         session_start();
         if(!isset($_SESSION["username"]))
         {
            header("Location:../index.php");
         } 
    
require_once './Cliente/cliente.entidad.php';
require_once './Cliente/cliente.modelo.php';
require_once './Cliente/domicilio.entidad.php';
require_once './Cliente/domicilio.modelo.php';
require_once './Cliente/telefono.entidad.php';
require_once './Cliente/telefono.modelo.php';
require_once './Cliente/email.entidad.php';
require_once './Cliente/email.modelo.php';

// Logica
$cli = new Cliente();
$dom = new Domicilio();
$tel = new Telefono();
$em = new Email(); 
$model = new ClienteModel();
$modelDO = new DomicilioModel();
$modelTe = new TelefonoModel();
$modelEm = new EmailModel();


if(isset($_REQUEST['action']))
{ 
	switch($_REQUEST['action'])
	{
		      case 'actualizar':

            $cli->__SET('id',              $_REQUEST['id']);
            $cli->__SET('RFC',             $_REQUEST['RFC']);
      			$cli->__SET('Nombre',          $_REQUEST['Nombre']);
      			$cli->__SET('Paterno',         $_REQUEST['Paterno']);
      			$cli->__SET('Materno',         $_REQUEST['Materno']);
            $dom->__SET('id',              $_REQUEST['id']);
            $dom->__SET('Calle',           $_REQUEST['Calle']);
            $dom->__SET('Numero',          $_REQUEST['Numero']);
            $dom->__SET('Estado',          $_REQUEST['Estado']);
            $dom->__SET('CodigoPostal',     $_REQUEST['CodigoPostal']);
            $dom->__SET('Colonia',         $_REQUEST['Colonia']);
            $tel->__SET('id',              $_REQUEST['id']);
            $tel->__SET('Telefono',        $_REQUEST['Telefono']);
             $em->__SET('id',               $_REQUEST['id']);
             $em->__SET('Email',            $_REQUEST['Email']);
            

			      $model->Actualizar($cli);
			      
            $modelDO->Obtener($_REQUEST['id']);
            $modelDO->Actualizar($dom);

            $modelTe->Obtener($_REQUEST['id']);
            $modelTe->Actualizar($tel);

            $modelEm->Obtener($_REQUEST['id']);
            $modelEm->Actualizar($em);

            header('Location:cliente.php');

            break;

          case 'buscar';
            $cli= $model->Buscar($_REQUEST['id']);
            $dom= $modelDO->Buscar($_REQUEST['id']);
            $tel= $modelTe->Buscar($_REQUEST['id']);
            $em = $modelEm->Buscar($_REQUEST['id']);
          break;

		      case 'registrar':
            $cli->__SET('RFC',            $_REQUEST['RFC']);
      			$cli->__SET('Nombre',         $_REQUEST['Nombre']);
      			$cli->__SET('Paterno',        $_REQUEST['Paterno']);
      			$cli->__SET('Materno',        $_REQUEST['Materno']);
      			$cli->__SET('domicilios', $dom);
            $dom->__SET('Calle',          $_REQUEST['Calle']);
            $dom->__SET('Numero',         $_REQUEST['Numero']);
            $dom->__SET('Estado',         $_REQUEST['Estado']);
            $dom->__SET('CodigoPostal',   $_REQUEST['CodigoPostal']);
            $dom->__SET('Colonia',        $_REQUEST['Colonia']);
            $cli->__SET('telefonos', $tel);
            $tel->__SET('Telefono',       $_REQUEST['Telefono']);
            $em-> __SET('Email',          $_REQUEST['Email']);
            $cli->__SET('emails', $em);

            $model->Registrar($cli);
            $model->ObtenerDomicilio();
            $model->ObtenerTelefono();
            $model->ObtenerEmail();
            header('Location:cliente.php');
			    break;

		      case 'eliminar':
			    $model->Eliminar($_REQUEST['id']);
			   header('Location: cliente.php');
			break;

		
      case 'editar':
      			$cli = $model->Obtener($_REQUEST['id']);
            $dom = $modelDO->Obtener($_REQUEST['id']);
            $tel = $modelTe->Obtener($_REQUEST['id']);
            $em = $modelEm->Obtener($_REQUEST['id']);
			break;

      case 'cancelar':
            $cli->__SET('id',   $_REQUEST[' ']);
            $cli->__SET('RFC', $_REQUEST[' ']);
            $cli->__SET('Nombre', $_REQUEST[' ']);
            $cli->__SET('Paterno', $_REQUEST[' ']);
            $cli->__SET('Materno', $_REQUEST[' ']);
            $dom->__SET('Calle', $_REQUEST[' ']);
            $dom->__SET('Numero', $_REQUEST[' ']);
            $dom->__SET('Estado', $_REQUEST[' ']);
            $dom->__SET('CodigoPostal', $_REQUEST[' '] );
            $dom->__SET('Colonia', $_REQUEST[' ']);
            $tel->__SET('Telefono', $_REQUEST[' ']);
            $em->__SET('Email', $_REQUEST[' ']);
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

            var val = document.getElementById('Nombre').value;
            var val1= document.getElementById('Paterno').value;
            var val2= document.getElementById('Materno').value;
            var val3= document.getElementById('Status').value;
            var tam = val.length;
            for(i = 0; i < tam; i++) {
                if(!isNaN(val[i]))
                    document.getElementById('Nombre').value = '';
                    document.getElementById('Paterno').value= '';
                    document.getElementById('Materno').value= '';
                    document.getElementById('Status').value= '';
            }
    }
</SCRIPT>
	<head>
		<title>Cliente</title>
       
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
    <body style="padding:15px;"s> 
 
  <?php include "php/navbar.php"; ?>
        <div class="container">
        <div class="row">
        <div class="col-md-6">

          <button type="button" class="btn btn-default btn-lg" id="myBtn" value="NuevoCliente" >Nuevo Cliente</button>

          <div class="modal fade" id="myModal" role="dialog">
          <div class="modal-dialog">
          <div class="modal-content">
          <div class="modal-header" style="padding:35px 50px;" position="center">
            
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4><span class="glyphicon"></span>CLIENTE</h4>
          </div>
          <div class="modal-body" style="padding:40px 50px;">

        <form action="?action=<?php echo $cli->id > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;" role="form">
          <div class="form-group">
          <input type="hidden" name="id"  value="<?php echo $cli->__GET('id'); ?>" />
             <label style="text-align:left;">Id</label>
              <input type="text" name="id" value="<?php echo $cli->__GET('id'); ?>" />                            
              <input type="submit" formaction="?action=buscar"  class="btn btn-default btn-lg" value="Buscar">
            </div>
            <div class="form-group">
             <label style="text-align:left;">RFC</label>
              <input type="text" name="RFC" value="<?php echo $cli->__GET('RFC'); ?>" onkeypress="" onblur="limpia()" style="width:100%;" />
            </div>
            <div class="form-group">
            <label style="text-align:left;">Nombre</label>
                <input type="text" name="Nombre" value="<?php echo $cli->__GET('Nombre'); ?>" onkeypress="return soloLetras(event)" onblur="limpia()" style="width:100%;"/>
            </div>
            <div class="form-group">
            <label style="text-align:left;">Apellido Paterno</label>
                <input type="text" name="Paterno" value="<?php echo $cli->__GET('Paterno'); ?>" onkeypress="return soloLetras(event)" onblur="limpia()" style="width:100%;"/>
            </div>
            <div class="form-group">
            <label style="text-align:left;">Apellido Materno</label>
                <input type="text" name="Materno" value="<?php echo $cli->__GET('Materno'); ?>" onkeypress="return soloLetras(event)" onblur="limpia()" style="width:100%;" />
            </div>
            <div class="form-group">
            <label style="text-align:left;">Calle</label>
                    <input type="text" name="Calle" value="<?php echo $dom->__GET('Calle'); ?>" onkeypress="return soloLetras(event)" onblur="limpia()" style="width:100%;" />
            </div>
            <div class="form-group">
            <label style="text-align:left;">Numero</label>
                    <input type="text" name="Numero" value="<?php echo $dom->__GET('Numero'); ?>" onkeypress="" onblur="limpia()" style="width:100%;" >
            </div>
            <div class="form-group">
            <label style="text-align:left;">Estado</label>
                    <select name="Estado" >
                       <option value="AGUAS CALIENTES" <?php echo $dom->__GET('Estado') == 1 ? 'selected' : ''; ?>>AGUAS CALIENTES</option>
                       <option value="BAJA CALIFORNIA" <?php echo $dom->__GET('Estado') == 2 ? 'selected' : ''; ?>>BAJA CALIFORNIA</option>
                       <option value="BAJA CALIFORNIA SUR" <?php echo $dom->__GET('Estado') == 3 ? 'selected' : ''; ?>>BAJA CALIFORNIA SUR</option>
                       <option value="CAMPECHE" <?php echo $dom->__GET('Estado') == 4 ? 'selected' : ''; ?>>CAMPECHE</option>
                       <option value="COAHUILA" <?php echo $dom->__GET('Estado') == 5 ? 'selected' : ''; ?>>COAHUILA</option>
                       <option value="COLIMA" <?php echo $dom->__GET('Estado') == 6 ? 'selected' : ''; ?>>COLIMA</option>
                       <option value="CHIAPAS" <?php echo $dom->__GET('Estado') == 7 ? 'selected' : ''; ?>>CHIAPAS</option>
                       <option value="CHIHUAHUA" <?php echo $dom->__GET('Estado') == 8 ? 'selected' : ''; ?>>CHIHUAHUA</option>
                       <option value="DISTRITO FEDERAL" <?php echo $dom->__GET('Estado') == 9 ? 'selected' : ''; ?>>DISTRITO FEDERAL</option>
                       <option value="DURANGO" <?php echo $dom->__GET('Estado') == 10 ? 'selected' : ''; ?>>DURANGO</option>
                       <option value="GUANAJUATO" <?php echo $dom->__GET('Estado') == 11 ? 'selected' : ''; ?>>GUANAJUATO</option>
                       <option value="GUERRERO" <?php echo $dom->__GET('Estado') == 12 ? 'selected' : ''; ?>>GUERRERO</option>
                       <option value="HIDALGO" <?php echo $dom->__GET('Estado') == 13 ? 'selected' : ''; ?>>HIDALGO</option>
                       <option value="JALISCO" <?php echo $dom->__GET('Estado') == 14 ? 'selected' : ''; ?>>JALISCO</option>
                       <option value="ESTADO DE MEXICO" <?php echo $dom->__GET('Estado') == 15 ? 'selected' : ''; ?>>ESTADO DE MEXICO</option>
                       <option value="MICHOACAN" <?php echo $dom->__GET('Estado') == 16 ? 'selected' : ''; ?>>MICHOACAN</option>
                       <option value="MORELOS" <?php echo $dom->__GET('Estado') == 17 ? 'selected' : ''; ?>>MORELOS</option>
                       <option value="NAYARIT" <?php echo $dom->__GET('Estado') == 18 ? 'selected' : ''; ?>>NAYARIT</option>
                       <option value="NUEVO LEON" <?php echo $dom->__GET('Estado') == 19 ? 'selected' : ''; ?>>NUEVO LEON</option>
                       <option value="OAXACA" <?php echo $dom->__GET('Estado') == 20 ? 'selected' : ''; ?>>OAXACA</option>
                       <option value="PUEBLA" <?php echo $dom->__GET('Estado') == 21 ? 'selected' : ''; ?>>PUEBLA</option>
                       <option value="QUERETARO" <?php echo $dom->__GET('Estado') == 22 ? 'selected' : ''; ?>>QUERETARO</option>
                       <option value="QUERETARO ROO" <?php echo $dom->__GET('Estado') == 23 ? 'selected' : ''; ?>>QUINTANA ROO</option>
                       <option value="SAN LUIS POTOSI" <?php echo $dom->__GET('Estado') == 24 ? 'selected' : ''; ?>>SAN LUIS POTOSI</option>
                       <option value="SINALOA" <?php echo $dom->__GET('Estado') == 25 ? 'selected' : ''; ?>>SINALOA</option>
                       <option value="SONORA" <?php echo $dom->__GET('Estado') == 26 ? 'selected' : ''; ?>>SONORA</option>
                       <option value="TABASCO" <?php echo $dom->__GET('Estado') == 27 ? 'selected' : ''; ?>>TABASCO</option>
                       <option value="TAMAULIPAS" <?php echo $dom->__GET('Estado') == 28 ? 'selected' : ''; ?>>TAMAULIPAS</option>
                       <option value="TLAXCALA" <?php echo $dom->__GET('Estado') == 29 ? 'selected' : ''; ?>>TLAXCALA</option>
                       <option value="VERACRUZ" <?php echo $dom->__GET('Estado') == 30 ? 'selected' : ''; ?>>VERACRUZ</option>
                       <option value="YUCATAN" <?php echo $dom->__GET('Estado') == 31 ? 'selected' : ''; ?>>YUCATAN</option>
                       <option value="ZACATECAS" <?php echo $dom->__GET('Estado') == 32 ? 'selected' : ''; ?>>ZACATECAS</option>
                       <option value="NACIDO EXTRANJERO" <?php echo $dom->__GET('Estado') == 33 ? 'selected' : ''; ?>>NACIDO EXTRANJERO</option>
                    </select>
            </div>
            <div class="form-group">
               <label style="text-align:left;">CodigoPostal</label>
                  <input type="text" name="CodigoPostal" value="<?php echo $dom->__GET('CodigoPostal'); ?>" style="width:100%;" />
            </div>
            <div class="form-group">
            <label style="text-align:left;">Colonia</label>
                     <input type="text" name="Colonia" value="<?php echo $dom->__GET('Colonia'); ?>" style="width:100%;" />
            </div>
            <div class="form-group">
            <label style="text-align:left;">Telefono</label>
                      <input type="text" name="Telefono" value="<?php echo $tel->__GET('Telefono'); ?>" style="width:100%;" />
                  
            </div>
            <div class="form-group">
            <label style="text-align:left;">Email</label>
                      <input type="text" name="Email" value="<?php echo $em->__GET('Email'); ?>" style="width:100%;" />
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
<table   class="pure-table pure-table-horizontal">
              <thead>
                  <tr>
                    <th style="text-align:left;">RFC</th>
                    <th style="text-align:left;">Nombre</th>
                    <th style="text-align:left;">Paterno</th>
                    <th style="text-align:left;">Materno</th>
                    <th style="text-align:left;">Calle</th>
                    <th style="text-align:left;">Numero</th>
                    <th style="text-align:left;">Estado</th>
                    <th style="text-align:left;">CodigoPostal</th>
                    <th style="text-align:left;">Colonia</th>
                    <th style="text-align:left;">Telefono</th>
                    <th style="text-align:left;">Email</th>
                    <th style="text-align:left;">Status</th>
                  </tr>
              </thead>
                    <?php foreach($model->Listar() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('RFC'); ?></td>
                            <td><?php echo $r->__GET('Nombre'); ?></td>
                            <td><?php echo $r->__GET('Paterno'); ?></td>
                            <td><?php echo $r->__GET('Materno'); ?></td>
                              <?php $d=$r->__GET('domicilios'); ?>
                            <td><?php echo $d->__GET('Calle'); ?></td>
                            <td><?php echo $d->__GET('Numero'); ?></td>
                            <td><?php echo $d->__GET('Estado'); ?></td>
                            <td><?php echo $d->__GET('CodigoPostal'); ?></td>
                            <td><?php echo $d->__GET('Colonia'); ?></td>
                              <?php $t=$r->__GET('telefonos'); ?>
                            <td><?php echo $t->__GET('Telefono'); ?></td>
                              <?php $e=$r->__GET('emails'); ?>
                            <td><?php echo $e->__GET('Email'); ?></td>
                            <td><?php echo $r->__GET('Status'); ?></td>
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