<?php 
	require_once('conexion/conexion.php');	
  $usuario = 'SELECT detallecompra.id_compra, detallecompra.descripcion, detallecompra.cantidad, detallecompra.precio, 
          detallecompra.importe, compra.total, compra.status
          FROM detallecompra
          right join compra
          on compra.id_compra = detallecompra.id_compra';

	$usuarios=$mysqli->query($usuario);
	
if(isset($_POST['create_pdf'])){
	require_once('tcpdf/tcpdf.php');
	
	$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
	
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('Servicio Sandoval');
	$pdf->SetTitle($_POST['reporte_name']);
	
	$pdf->setPrintHeader(false); 
	$pdf->setPrintFooter(false);
	$pdf->SetMargins(20, 20, 20, false); 
	$pdf->SetAutoPageBreak(true, 20); 
	$pdf->SetFont('Helvetica', '', 10);
	$pdf->addPage();

	$content = '';
	
	$content .= '
		<div class="row">
        	<div class="col-md-12">
            	<h1 style="text-align:center;">'.$_POST['reporte_name'].'</h1>
       	
      <table border="1" cellpadding="5">
        <thead>
          <tr  bgcolor="#0040FF">
            <th>ID</th>
            <th>DESCRIPCION</th>
            <th>CANTIDAD</th>
            <th>PRECIO</th>
            <th>IMPORTE</th>
            <th>TOTAL</th>
          </tr>
        </thead>
	';
	
	
	while ($user=$usuarios->fetch_assoc()) { 
	$content .= '
		<tr>
            <td>'.$user['id_compra'].'</td>
            <td>'.$user['descripcion'].'</td>
            <td>'.$user['cantidad'].'</td>
            <td>'.$user['precio'].'</td>
            <td>'.$user['importe'].'</td>
            <td>S/. '.$user['total'].'</td>
        </tr>
	';
	}
	
	$content .= '</table>';
	

	
	$pdf->writeHTML($content, true, 0, true, 0);

	$pdf->lastPage();
	$pdf->output('ReporteVenta.pdf', 'I');
}

?>
		 
          
        
<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Reporte Compras</title>
<meta name="keywords" content="">
<meta name="description" content="">
<!-- Meta Mobil
================================================== -->
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
</head>

<body>
	<div class="container-fluid">
        <div class="row padding">
        	<div class="col-md-12">
            	<?php $h1 = "Reporte de Compras";  
            	 echo '<h1>'.$h1.'</h1>'
				?>
            </div>
        </div>
    	<div class="row">
      <table class="table table-hover">
        <thead>
          <tr bgcolor="#0040FF">
            <th>ID</th>
            <th>DESCRIPCION</th>
            <th>CANTIDAD</th>
            <th>PRECIO</th>
            <th>IMPORTE</th>
            <th>TOTAL</th>
          </tr>
        </thead>
        <tbody>
        <?php 
			while ($user=$usuarios->fetch_assoc()) {   ?>
          <tr>
            <td><?php echo $user['id_compra']; ?></td>
            <td><?php echo $user['descripcion']; ?></td>
            <td><?php echo $user['cantidad']; ?></td>
            <td><?php echo $user['precio']; ?></td>
            <td><?php echo $user['importe']; ?></td>
            <td>S/. <?php echo $user['total']; ?></td>
          </tr>
         <?php } ?>
        </tbody>
      </table>
              <div class="col-md-12">
              	<form method="post">
                	<input type="hidden" name="reporte_name" value="<?php echo $h1; ?>">
                	<input type="submit" name="create_pdf" class="btn btn-primary pull-right" value="Generar PDF">
                </form>
              </div>
      	</div>
    </div>
</body>
</html>