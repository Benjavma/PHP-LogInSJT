<?php 
$servidor = "localhost"; //el servidor que utilizaremos, en este caso será el localhost
$usuario = "root"; //El usuario que acabamos de crear en la base de datos
$contrasenha = ""; //La contraseña del usuario que utilizaremos
$BD = "laboratorio"; //El nombre de la base de datos 
  
$conexion = @mysql_connect($servidor, $usuario, $contrasenha);
  
if (!$conexion) { 
    die('<strong>No pudo conectarse:</strong> ' . mysql_error()); 
}else{ 

echo 'Conectado  satisfactoriamente al servidor <br />'; 
} 

mysql_select_db($BD, $conexion) or die(mysql_error($conexion));
  
//Luego de abrir y utilizar una conexión en MySql siempre hay que cerrarla luego de terminar de trabajar con ella
mysql_close($conexion); 
?>