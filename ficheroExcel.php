<!-- Este PHP es el encargao de realizar la exportaciòn de las tablas en formato excel para poder analizar los datos de otra forma-->

<?php
// Aqui  se le indica el tipo de documento que será el fichero
header("Content-type: application/vnd.ms-excel; name='excel'");
header("Content-Disposition: filename=ficheroExcel.xls");
header("Pragma: no-cache");
header("Expires: 0");

// Recibimos los valores la tabla  en un variable por metodo POST cuando se realiza la acciòn de enviar para exportar
$tabla=$_POST['datos_a_enviar'];
// indicamos bajo que formato deceamos mostrar el contenido en este caso es utf8 para que no se nos muestren caracteres raros
$tabla=utf8_decode($tabla);

echo $tabla;

?>