<!DOCTYPE html>
<html lang="en">
<head>
  <title>ServicioSandoval</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }
    
  .carousel-inner img {
      width: 100%; /* Set width to 100% */
      margin: auto;
      min-height:200px;
  }

  /* Hide the carousel text when the screen is less than 600 pixels wide */
  @media (max-width: 600px) {
    .carousel-caption {
      display: none; 
    }
  }
  </style>

</head>

<body>
<?php include "php/navbarCliente.php"; ?>
  <div class="container">
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img src="./imagenes/Carrorosa.jpg" alt="Los Angeles" style="width:50%;" style="height:50%">
        <div class="carousel-caption">
         <!-- <h3>Sell $</h3>
          <p>Money Money.</p>-->
        </div>      
      </div>

      <div class="item">
        <img src="./imagenes/Carroamarillo.jpg" alt="Chicago" style="width:50%;" style="height:50%">
        <div class="carousel-caption">
          <!--<h3>More Sell $</h3>
          <p>Lorem ipsum...</p>-->
        </div>      
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
</div>
  
<div class="container text-center">    
  <h3>Servicio Sandoval</h3>
  <h3>A sus Ordenes desde 1978</h3>
  <div class="row">
    <div class="col-sm-4">
      <img src="imagenes/taller9.jpg" class="img-responsive" style="width:100%"  alt="Image">
      <p></p>
    </div>
    <div class="col-sm-4"> 
      <img src="imagenes/taller8.jpg" class="img-responsive" style="width:100%" alt="Image">
      <p></p>    
    </div>
    <div class="col-sm-4">
       <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1866.5203586547393!2d-103.3039067!3d20.6679224!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8428b3d7c6083791%3A0xb09b979325897b0a!2sGuelatao+360%2C+Jardines+de+Guadalupe%2C+44740+Guadalajara%2C+Jal.!5e0!3m2!1ses-419!2smx!4v1508206090612" width="300" height="200" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>
  </div>
</div><br>

<footer class="container-fluid text-center">
  <p>Contactanos:</p>
  <p>Calle: Guelatao #360, El Porvenir, Guadalajara, Jal</p>
  <p>Tel: 36441039 </p>
</footer>

</body>
</html>