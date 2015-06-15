<!--Este PHP es una ayuda para ver el movimiento del ticket que a tenido en su tiempo si es asignado a alquien cerrado,o reasignado a otra persona-->

<?php
   require_once("conexion.php"); //Manda a llamar el archivo de conexion de la base de datos
 	  $conexion = conectar();//variable a la cual retorna la cadena de conexion de la base de datos
?>


<!DOCTYPE html>

<html>
<body>

<div class="MarcoPrincipal">
<div class="MarcoEncabezado">
  
<?php
  require_once("Utilidades.php");//Manda llamar las difentes tipos de ayuda para gestar la informaciòn
 ?>

 	<title>Reportería de Tickets Asignados</title> <!--Titulo del archivo de indextab.php-->

  <div class="subTituloAsig"><!--clases para ser utilizada en el archivo de css-->
	     <H1><legend>Reporterìa de Tickes Asignados </legend></H1><!--Titulo que se muestra en la presentacion de la pagina web-->
  </div>
    </br></br></br></br></br>
<!--script para matar la cookies de fechas por los menus-->


<script >
  
  function diecoo(){
        

var fechaActual = new Date();
fechaActual.setTime(fechaActual.getTime() + (1000 * 1000))
var strExpiracion = fechaActual.toGMTString();
document.cookie="VarCookieInicio=0; expires=+strExpiracion";
document.cookie="VarCookieFinalq=0; expires=+strExpiracion";

 
}
</script>

<div class="Menu"><!--Clases para ser utilizada en el archivo de css para el control del menu-->
<form name="atrass" method="POST">
  <ul>
      <!--referencias a los distintos tipos de opciones del menu de busqueda-->
      <li><a  <input  type="submit" name="BTNIni" id="BTNIni" value="Actualizar" onclick="self.location.href ='indexTab.php'" onkeypress="self.location.href ='indexTab.php'" onmousedown="diecoo();" onclick="diecoo();" />Inicio</a></li>
                   <li><a  <input  type="submit" name="BTNAsig" id="BTNAsig" value="Asignado" onclick="self.location.href ='BusquedaTickAsig.php'" onkeypress="self.location.href ='BusquedaTickAsig.php'" onmousedown="diecoo();" onclick="diecoo();" />Asignado</a></li>
                
                   <li><a href="">Tickets</a>
                    <ul class="tiket">
                   <Li><a  <input  type="submit" name="BTNCerrar" id="BTNCerrar" value="Cerrado" onclick="self.location.href ='TicketCerrado.php'" onkeypress="self.location.href ='TicketCerrado.php'" onmousedown="diecoo();" onclick="diecoo();" />Tickets Cerrado</a></Li>
                      <hr>
                       <li><a <input  type="submit" name="BTNAbierto" id="BTNAbierto" value="Abierto" onclick="self.location.href ='TicketAbierto.php'" onkeypress="self.location.href ='TicketAbierto.php'" onmousedown="diecoo();" onclick="diecoo();" />Tickets Abierto</a></li>
                       </ul>
                  </li>
               <li><a href="">Estadìsticas</a>
                    <ul class="estad">
                    <li><a <input  type="submit" name="BTNDestino" id="BTNDestino" value="Destino" onclick="self.location.href ='EstadisticasDepart.php'" onkeypress="self.location.href ='EstadisticasDepart.php'" onmousedown="diecoo();" onclick="diecoo();" />Ticket por Departamento de Destino</a></li>
                    <hr>
                    <li> <a <input  type="submit" name="BTNTema" id="BTNTema" value="Tema de ayuda" onclick="self.location.href ='EstadisticasTema.php'" onkeypress="self.location.href ='EstadisticasTema.php'" onmousedown="diecoo();" onclick="diecoo();" />Ticket por Tema de Ayuda</a></li>
                    <hr>
                    <li> <a <input  type="submit" name="BTNEmpl" id="BTNEmpl" value="Empleados" onclick="self.location.href ='EstadisticasEmpl.php'" onkeypress="self.location.href ='EstadisticasEmpl.php'" onmousedown="diecoo();" onclick="diecoo();" />Ticket Asig. Empleado.</a></li>
                    <hr>
                     <li> <a <input  type="submit" name="BTNIni" id="BTNIni" value="Inicio" onclick="self.location.href ='EstadisticasDepartOrigen.php'" onkeypress="self.location.href ='EstadisticasDepartOrigen.php'"  onmousedown="diecoo();" onclick="diecoo();" />Ticket por Departamento de Origen</a></li>
         
                              </ul>
                    </li>
    

  </ul>
  </form>
</div>

<div class="TablaBusquedaAsg">
<?php
//Llama la opciòn de tabla de busqueda para que se muestre en pantalla

  require_once("TablaBusq.php");

 ?>
  </div>



<div class="AyudaCeAbAs">

 <form name="atrass" method="POST"  action="BusquedaTickAsig.php">
        <p>Ayuda  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input style='background:url("img/Ayuda.jpeg");' type="submit" name="BTNAyuda" id="BTAyuda" value=" &nbsp;"  onmousedown="ayuda();" Title="doble click para acceder al Manual de reporteria" /></P>  
        <p>Actualizar<input style='background:url("img/Actualizar.jpeg");' type="submit" name="BTNActualizar" id="BTNActualizar" value="&nbsp;&nbsp;"  /></P>  
         
  </form>


<?php

if(isset($_POST['BTNAyuda']))
    { ?>

  <script>
function ayuda(){
  var fechaActual = new Date();
fechaActual.setTime(fechaActual.getTime() + (1000 * 1000))
var strExpiracion = fechaActual.toGMTString();
document.cookie="VarCookieInicio=0; expires=+strExpiracion";
document.cookie="VarCookieFinalq=0; expires=+strExpiracion";

 window.location="Manual/index.html";
   }
   

  </script>      

   <?php

 }


?>




<?php
if(isset($_POST['BTNActualizar']))
    { ?>

      
   <script>
$(function(){
    
    $(".click").click(function(e) {
        e.preventDefault();
        

var fechaActual = new Date();
fechaActual.setTime(fechaActual.getTime() + (1000 * 1000))
var strExpiracion = fechaActual.toGMTString();
document.cookie="VarCookieInicio=0; expires=+strExpiracion";
document.cookie="VarCookieFinalq=0; expires=+strExpiracion";

 

      
    });

});


</script>
       

   <?php }

?>

</div>




</body>
</html>
</div>
<div class="tablainf"><!--Clase llamada para trabaja con la hoja de estilo -->
 <hr>

<?php
// llamdo de las hojas de php requeridas para mostrar en pantalla
  require_once("ConQueryAsig.php");// llamada de los query con su tabla
  require_once("footer.php");// llamada para el pie de pagina que se muestre abajo de la tabla
?>

</div>
</div>
