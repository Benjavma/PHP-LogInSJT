<?php
SESSION_START();
SESSION_DESTROY();
include 'librerias/connection.php';
$conn = new connection();
$db = $conn->connect();	

function conectar()
{
$e = mysqli_connect("localhost", "root", "") or die("could not connect to mysql");
mysqli_select_db($e, "laboratorio") or die ("no database");
if (!$e) {
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

}

ini_set ('error_reporting', E_ALL & ~E_NOTICE);

if (isset($_POST['registrar'])) {


	$ced=$_POST['ced'];
	$cla=$_POST['cla'];
  $ape=$_POST['ape'];
  $dir=$_POST['dir'];
	$nombre=$_POST['nombre'];
	$consulta1="select idusu from usuario where idusu='$ced'";
	if(!$resultado1 = $db->query($consulta1)) {
		die('Error. '.$db->error);}
		if($resultado1->num_rows>0)
		{
			$mensaje="Esta Cedula ya esta Registrada";
		}
		else
		{
			if(strlen($ced)<7)
			{
				$mensaje="Su cedula no es valida";
			}
			else
			{
				$insert="insert into usuario (idusu,nombre,apellido,direccion,clave,privilegio)values('$ced','$nombre','$ape','$dir','$cla','0')";
				if(!$rinsert = $db->query($insert)) {
					die('Error. '.$db->error);}else{$mensaje="Se Registro Exitosamente ya puede entrar al sistema";}
					
					
				}
			}


		}

		if (isset($_POST['entrar'])) {
			$u=strtoupper($_POST['cusu']);
			$c=strtoupper($_POST['ccla']);
			$enlace=conectar($e);
			$consulta="select * from usuario where idusu= '$u' and clave= '$c'";
			if(!$resultado = $db->query($consulta)) {
				die('Error. '.$db->error);}
				if($resultado->num_rows>0)
				{
					SESSION_NAME("loginlaboratorio");
					SESSION_START();
					$fila=$resultado->fetch_assoc();
					$_SESSION['nombre_validacion']=$fila['nombre'];
					$_SESSION['id_validacion']=$fila['idusu'];

					if($fila['privilegio']==1)
					{
						header('location: administrador.php');
					}
					else
					{
						header('location: usuario.php');
					}
				}
				else{
        try{
          $mensaje = "Usuario y/o contraseña invalida";      
          mysqli_close($enlace);  
        }catch(Exception $e){
        }
					
		      
				}	
			}
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
      <a class="navbar-brand" href="index.html">Logo</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="index.html">Inicio</a></li>
        <li><a href="laboratorio.html">Laboratorio</a></li>
        <li><a href="noticias.html">Noticias</a></li>
        <li><a href="contacto.html">Contacto</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="active"><a href="#"><span class="glyphicon glyphicon-log-in"></span>Entrar/Registrarse</a></li>
      </ul>
    </div>
  </div>
</nav>
<!--Registro-->
    <div class="form">
      
      <ul class="tab-group">
        <li class="tab"><a href="#signup">Registrar</a></li>
        <li class="tab active"><a href="#login">Entrar</a></li>
      </ul>
      
      <div class="tab-content">
        <div id="login">   
          <h1>Bienvenido!</h1>
          
          <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
          
            <div class="field-wrap">
            <label>
              Cedula<span class="req">*</span>
            </label>
            <input type="text" name="cusu" required autocomplete="off"//>
          </div>
          
          <div class="field-wrap">
            <label>
              Contraseña<span class="req">*</span>
            </label>
            <input type="password"required autocomplete="off" name="ccla" />
          </div>
          <br>
          
          <p class="forgot"><font color=white><?php echo $mensaje ?></font></p> 
          
          <button name="entrar" class="button button-block"/>Entrar</button>
          
          </form>

        </div>        


        <div id="signup">   
          <h1>Registrate Gratis</h1>
          
          <form form action="<?php $_SERVER['PHP_SELF']?>" method="post"">
          
          <div class="top-row">
            <div class="field-wrap">
              <label>
                Nombre<span class="req">*</span>
              </label>
              <input type="text" required autocomplete="off" name="nombre" maxlength="15"/>
            </div>
        
            <div class="field-wrap">
              <label>
                Apellido<span class="req">*</span>
              </label>
              <input type="text"required autocomplete="off" name="ape" maxlength="15" />
            </div>
          </div>

          <div class="field-wrap">
            <label>
              Cedula<span class="req">*</span>
            </label>
            <input type="text"  onkeypress="return solonum(event)" required name=ced  maxlength="8">
          </div>
          
          <div class="field-wrap">
            <label>
              Contraseña<span class="req">*</span>
            </label>
            <input type="password" required name="cla" id="" maxlength="10">
          </div>
          <div class="field-wrap">
            <label>
              Direccion<span class="req">*</span>
            </label>
            <textarea required name=dir></textarea>
          </div>
          
          <button name=registrar type="submit" class="button button-block"/>Registrarse</button>
          
          </form>

        </div>
        
      </div><!-- tab-content -->
      
</div> <!-- /form -->
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