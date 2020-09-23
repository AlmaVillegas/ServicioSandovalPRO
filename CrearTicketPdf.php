<?php
// Cargamos la librería dompdf que hemos instalado en la carpeta dompdf

require_once './dompdf/dompdf_config.inc.php';
//use Dompdf\Dompdf;

$factura=$_GET['factura'];
//$tpagar=$_GET['tpagar'];
//$ccpago=$_GET['ccpago'];
//$cambio=$_GET['factura'];
// Introducimos HTML de prueba
function file_get_contents_curl($url) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);

    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}

 $html=file_get_contents("http://localhost:8080/ServicioSandovalPRO/ticketVentaPdf.php?factura=".$factura);
 //http://localhost:8080/ServicioSandovalPRO/ticketVentaPdf.php
 //echo ($html);

 
// Instanciamos un objeto de la clase DOMPDF.
$pdf = new DOMPDF();
 
// Definimos el tamaño y orientación del papel que queremos.
//$pdf->set_paper("letter", "portrait");
$pdf->set_paper(array(0,0,200,450));
 
// Cargamos el contenido HTML.
$pdf->load_html($html);
 
// Renderizamos el documento PDF.
$pdf->render();
 
// Enviamos el fichero PDF al navegador.
$pdf->stream('reporteVenta.pdf');


?>