

<?php
//Este php es el que muestra las estaditicas generales de los departamento y por intervalos de fecha
require_once("conexion.php");//Manda a llamar el archivo de conexion de la base de datos
 $conexion = conectar();//variable a la cual retorna la cadena de conexion de la base de datos

$VarExport=0;
 $VarExportAgente =  $_COOKIE["VarCookieNombreAgente"];
?>


<html>
<body>

<div class="MarcoPrincipal">
<div class="MarcoEncabezado">


<?php
   require_once("Utilidad.php");
?>


<title>Detalles </title> <!--Titulo del archivo de indextab.php-->

  <div class="subTituloEstadi0"><!--clases para ser utilizada en el archivo de css-->

       <H2><legend>Tickets en estado cerrado</br>Detalles del agente: <?php echo $VarExportAgente;?></legend></H2><!--Titulo que se muestra en la presentacion de la pagina web-->
  </div>
    </br></br>



  <div class="TablaBusqAgente">
<?php

//Llama la opciòn de tabla de busqueda para que se muestre en pantalla
 require_once("TablaBusqEstad.php");

 ?>
 </div>


<div class="TablaDetalleAgentes">

<?php

require_once("ConDetallesAgenteCeTema.php");
?>
</div>

</div>
</div>
 </body>
  
</html>
