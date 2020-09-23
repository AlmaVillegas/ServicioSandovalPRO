<!DOCTYPE html>
<html lang="en">
<head>
  <title>Mis Productos</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default rounded borders and increase the bottom margin */ 
    .navbar {
      margin-bottom: 50px;
      border-radius: 0;
    }
    
    /* Remove the jumbotron's default bottom margin */ 
     .jumbotron {
      margin-bottom: 0;
    }
   
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }
  </style>
</head>
<body>
 <?php include "php/navbarCliente.php"; ?>
<div class="container">

<div class="jumbotron">
  <div class="container text-center">
    <h1>Productos</h1>      
    <p>Nuestra variedad de aceites y filtros</p>
  </div>
</div>

<div class="container">    
  <div class="row">
    <div class="col-sm-4">
      <div class="panel panel-primary">
        <div class="panel-heading" align="center">Ultimate Durability</div>
        <div class="panel-body"><img src="Productos/quaker1.jpg" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer" align="center">100% SINTETICO</div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-danger">
        <div class="panel-heading" align="center">XTR-PRO</div>
        <div class="panel-body"><img src="Productos/quaker2.jpg" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer" align="center">Super Multigrado</div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-success">
        <div class="panel-heading" align="center">Máxima Potencia</div>
        <div class="panel-body" align="center"><img src="Productos/quarker3.jpg" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer" align="center">Alto Kilometraje</div>
      </div>
    </div>
  </div>
</div><br>

<div class="container">    
  <div class="row">
    <div class="col-sm-4">
      <div class="panel panel-primary">
        <div class="panel-heading" align="center">Super Racing OIL</div>
        <div class="panel-body"><img src="Productos/bardahl1.jpg" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer" align="center">Bardahl Heavy Duty 40 SI</div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-danger">
        <div class="panel-heading" align="center">FUS1ÓN</div>
        <div class="panel-body"><img src="Productos/bardahl2.jpg" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer" align="center">Bardahl Fusión 20W50 SN</div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-success">
        <div class="panel-heading" align="center">Gear OIL</div>
        <div class="panel-body"><img src="Productos/bardahl3.jpg" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer" align="center">Bardahl Gear Oil SAE 80W90 API GL-5</div>
      </div>
    </div>
  </div>
</div><br>
<div class="container">    
  <div class="row">
    <div class="col-sm-4">
      <div class="panel panel-primary">
        <div class="panel-heading" align="center">ROSHFRANS</div>
        <div class="panel-body"><img src="Productos/roshfran1.png" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer" align="center">SEED RACING</div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-danger">
        <div class="panel-heading" align="center">ROSHFRANS</div>
        <div class="panel-body"><img src="Productos/roshfran2.png" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer" align="center">Full AK HI ENERGY</div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-success">
        <div class="panel-heading" align="center">ROSHFRANS</div>
        <div class="panel-body"><img src="Productos/roshfran3.png" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer" align="center">Zn-30</div>
      </div>
    </div>
  </div>
</div>
<br><br>



</body>
</html>
