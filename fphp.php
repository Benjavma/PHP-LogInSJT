<?php
SESSION_START();
include 'librerias/connection.php';
$conn = new connection();
$db = $conn->connect(); 
function conectar()
{
$e = mysqli_connect("localhost", "root", "", "laboratorio");
if (!$e) {
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
    exit;
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
            echo "Se ha conectado exitosamene el administrador";
          }
          else
          {
            echo “<script>window.open(‘index.html’,’_self’)</script>”;
          }
        }
        else{
          mysqli_close($e);
          $msjusu='Este usuario no esta registrado';
        } 
      }
?>
