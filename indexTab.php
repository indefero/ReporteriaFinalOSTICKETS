<?php
   
 	 require_once("conexion.php"); //Manda a llamar el archivo de conexion de la base de datos
 	  $conexion = conectar();//variable a la cual retorna la cadena de conexion de la base de datos
?>
<!DOCTYPE html>
<html>
<body>




<div class="MarcoPrincipal">
<!--Este PHP es el que se muestra al inicio de la publicaciòn con la informaciòn màs relevante de los tickets-->

 <div class="MarcoEncabezado">

 

<?php
	  require_once("Utilidades.php");//Carga las utilidades con las que va a trabajar
 ?>

<title>Reportería de Tickets</title> <!--Titulo del archivo de indextab.php-->
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

	
<script>
$(function(){
    
    $(".click").click(function(e) {
        e.preventDefault();
        

var fechaActual = new Date();
fechaActual.setTime(fechaActual.getTime() + (1000 * 1000))
var strExpiracion = fechaActual.toGMTString();
document.cookie="VarCookieInicio=0; expires=+strExpiracion";
document.cookie="VarCookieFinalq=0; expires=+strExpiracion";
//document.cookie="VarCookie=0; expires=+strExpiracion;

 

      
    });

});


</script>

		<div class="subTituloIndex"><!--clases para ser utilizada en el archivo de css-->
			<H1><legend>Reporterìa de Tickets</legend></H1><!--Titulo que se muestra en la presentacion de la pagina web-->
	   </div>

</br></br></br></br></br>

		<div class="Menu"><!--Clases para ser utilizada en el archivo de css para el control del menu-->
<form name="atrass" method="POST" class="click">
  						<ul>
     						 <!--referencias a los distintos tipos de opciones del menu de busqueda-->
							 <li><a  <input  type="submit" name="BTNIni" id="BTNIni" value="Actualizar" onclick="self.location.href ='indexTab.php'" onkeypress="self.location.href ='indexTab.php'" onmousedown="diecoo();" onclick="diecoo();" />Actualizar</a></li>
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






		
<div class="TablaBusqIndex">
<?php
// Carga las difentes formas de busqueda en el sitio
 require_once("TablaBusq.php");
  
 ?>
 </div>
</div>


<div class="AyudaIndex">

 <form name="atrass" method="POST"  action="Manual/index.html">
        <p>Ayuda  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input style='background:url("img/Ayuda.jpeg");' type="submit" name="BTNAyuda" id="BTAyuda" value=" &nbsp;"  onmousedown="ayuda();" Title="Manual de reporteria" /></P>  
         
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
</div>



    <!-- Clases para trabajar en el css de diseño para la tabla de infromaciòn-->
<div class="tablainf">
  <hr>
 
<?php
//Manda a llamar el archivo de php de query y el php de pie de pagina

   require_once("ConQueryGen.php");
   
   require_once("footer.php");

?>

</div>

</div>
</body>
</html>


