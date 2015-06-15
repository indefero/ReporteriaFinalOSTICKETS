<?php
$ruta = "../";
//Conexión a la base de datos
function conectar(){//funcion que sera para llamar la cadena de contexion del servidor


$host = "172.16.23.219";//nombre del servido local o direccion del servidor
$user = "root"; // <-- aqui va el usuario de PHPmyAdmin que tiene los permisos de la base de datos
$password = "supercalifragilisticoespialidoso"; // <-- contraseña del usurio para verificar su Autenticación de PHPmyAdmin
$db = "nutickets"; // nombre de la base de datos con la que se esta trabajando

$conexion = new mysqli($host, $user, $password, $db); // variable que sirve para guardar la cadena de conexion del servido
    
  if($conexion->errno!=0)// validaciòn  para mostrar el entorno de conexion al servido 
  {
   	 die("Error de Conexion a la DB");//mensaje de error para indicar que no se pudo realizar la conexion con exito
  }
  else{
      echo "<p>Conectado con éxito </br></p>";// mensaje que indica la conexion con exito del servidor
	  }
    
 $conexion->set_charset('utf8');
//Conexión a la base de datos

return $conexion; // retorno de la variable con la cadena de conexion para ser llamada dentro de otro archivo de php
}
?>

