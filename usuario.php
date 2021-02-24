<?php
session_name("loginlaboratorio");
session_start();
if  (trim($_SESSION['nombre_validacion'])=='') { 
	session_destroy(); // destruyo la sesión
	header("Location: registro.php"); 	
}
include 'librerias/connection.php';
$conn = new connection();
$db = $conn->connect();

?>	
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <title>Laboratorio Clinico San Judas Tadeo</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-social/4.10.1/bootstrap-social.css" rel="stylesheet" >
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
    
    <link rel="stylesheet" href="css/normalize.css">

    
        <link rel="stylesheet" href="css/style.css">
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }

.a:link, .a:visited {
	color: white;
    text-align: center;
    text-decoration: none;
    display: inline-block;
}

.a1:link, .a1:visited {
	color: black;
    text-align: left;
    text-decoration: none;
    display: inline-block;
}


.a:hover, .a:active {
 color: black;
}

.a1:hover, .a1:active {
 color: white;
}
    
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Logo</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Resultados</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>Salir</a></li>
      </ul>
    </div>
  </div>
</nav>
<!--Resultados-->

<br>
<div class="container">
<table class="w3-table w3-striped w3-bordered w3-card-4">
<thead>
<tr class="w3-black">
  <th>Archivo</th>
  <th>Titulo</th>
  <th>Cedula</th>
  <th>Descripcion</th>
</tr>
</thead>
	<?php 

	$consulta="select * from resultados where idusu = ".$_SESSION['id_validacion'];
    if(!$resultado = $db->query($consulta)) {
      die('Error. '.$db->error);
    } //que los nombres, cedulas y/o correos o datos personales sirvan para ayudar a mostrar los archivos, logrando que sea mas precisa la busqueda
	while ($row123 = $resultado -> fetch_assoc()) {?>
		<tr>
		<td><?php echo $row123['ruta']; ?></td>
		<td><?php echo $row123['titulo']; ?></td>
		<td><?php echo $row123['idusu']; ?></td>
		<td><?php echo $row123['descripcion']; ?></td>
		</tr>
	<?php	} ?>
</table>
</div>
<br>
<!--Footer-->

<footer class="w3-container w3-padding-64 w3-center w3-dark-grey w3-xlarge">
<div class="container">
  <div class="row">
    <div class="col-sm-6 col-md-4">
    <div align="left"><img src="logo_full.png"></div>
    </div>
    <div class="col-sm-6 col-md-4">
      <a class="w3-btn-floating w3-grey" href="https://www.facebook.com/laboratoriosanjudast/" target="_black" title="Facebook"><i class="fa fa-facebook"></i></a>
      <a class="w3-btn-floating w3-grey" href="https://twitter.com/labsanjudas" target="_black" title="Twitter"><i class="fa fa-twitter"></i></a>
      <a class="w3-btn-floating w3-grey" href="https://www.instagram.com/labsanjudast/" target="_black" title="Instagram"><i class="fa fa-instagram"></i></a>
    </div>
  <div class="col-sm-6 col-md-4">
    <div align="right">
    <div><a class="a" href="index.html">Inicio</a></div>
    <div><a class="a" href="laboratorio.html">Laboratorio</a></div>
    <div><a class="a" href="noticias.html">Noticias</a></div>
    <div><a class="a" href="contacto.html">Contacto</a></div>
    </div>
  </div>
  </div>
 </div>
</footer>

    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

        <script src='js/jquery.js'></script>

        <script src="js/index.js"></script>

</body>
</html>