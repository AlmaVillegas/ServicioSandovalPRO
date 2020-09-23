<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Highcharts Example</title>

		<style type="text/css">

		</style>
	</head>
	<body>
<script src="../code/highcharts.js"></script>
<script src="../code/modules/exporting.js"></script>

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>



<script type="text/javascript">
    $.ajax({
            type:'POST',
            url:'controladorCompra/procesar.php',
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
                                
                          

Highcharts.chart('container', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Monthly Average Temperature'
    },
    subtitle: {
        text: 'Source: WorldClimate.com'
    },
    xAxis: {
            categories: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']
    },
    yAxis: {
        title: {
            text: 'Temperature (°C)'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
    series: [{
        name: 'Tokyo',
        data: [7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
    }, {
        name: 'London',
        data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
    }]
   }
  }
});
		</script>
	</body>
</html>
