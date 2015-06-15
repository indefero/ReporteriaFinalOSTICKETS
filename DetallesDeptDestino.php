<?php
//Este php es el que muestra las estaditicas generales de los departamento y por intervalos de fecha
require_once("conexion.php");//Manda a llamar el archivo de conexion de la base de datos
 $conexion = conectar();//variable a la cual retorna la cadena de conexion de la base de datos
$VarExport=0;
 $VarExport =  $_COOKIE["VarCookieDestino"];
?>


<html>
<body>

<div class="MarcoPrincipal">
<div class="MarcoEncabezado">


<?php
    require_once("Utilidad.php");
?>
<!--script para matar la cookies de fechas por los menus-->
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

<title>Estadìsticas Departamento Destino </title> <!--Titulo del archivo de indextab.php-->

  <div class="subTituloEstadi0"><!--clases para ser utilizada en el archivo de css-->
       <H1><legend>Tickets del Departamento de <?php echo $VarExport; ?></legend></H1><!--Titulo que se muestra en la presentacion de la pagina web-->
  </div>
    </br></br>

  <div class="MenuEstadi"><!--Clases para ser utilizada en el archivo de css para el control del menu-->
   <form name="atrass" method="POST" class="click">
     <ul>
           <!--referencias a los distintos tipos de opciones del menu de busqueda-->
           
         <li><a <input  type="submit" name="BTNIni" id="BTNIni" value="Actualizar" onclick="self.location.href ='indexTab.php'" onkeypress="self.location.href ='indexTab.php'" onmousedown="diecoo();" onclick="diecoo();"/>Inicio</a></li>
           <Li><a <input  type="submit" name="BTNAsig" id="BTNAsig" value="Asignado" onclick="self.location.href ='BusquedaTickAsig.php'" onkeypress="self.location.href ='BusquedaTickAsig.php'" onmousedown="diecoo();" onclick="diecoo();"/>Asignado</a></Li>
           <li><a href="">Tickets</a>
                    <ul class="tiket">
                   <Li><a <input  type="submit" name="BTNCerrar" id="BTNCerrar" value="Cerrado" onclick="self.location.href ='TicketCerrado.php'" onkeypress="self.location.href ='TicketCerrado.php'" onmousedown="diecoo();" onclick="diecoo();"/>Tickets Cerrado</a></Li>
                       <hr>
                       <li><a <input  type="submit" name="BTNAbierto" id="BTNAbierto" value="Abierto" onclick="self.location.href ='TicketAbierto.php'" onkeypress="self.location.href ='TicketAbierto.php'" onmousedown="diecoo();" onclick="diecoo();"/>Tickets Abierto</a></li>
                       </ul>
                  </li>
                  <li><a href="">Estadìsticas</a>
                    <ul class="estad">
                    <li><a <input  type="submit" name="BTNTema" id="BTNTema" value="Tema de ayuda" onclick="self.location.href ='EstadisticasTema.php'" onkeypress="self.location.href ='EstadisticasTema.php'"  onmousedown="diecoo();" onclick="diecoo();" />Ticket por Tema de Ayuda</a></li>
                    <hr>
                    <li><a <input  type="submit" name="BTNEmpl" id="BTNEmpl" value="Empleados" onclick="self.location.href ='EstadisticasEmpl.php'" onkeypress="self.location.href ='EstadisticasEmpl.php'" onmousedown="diecoo();" onclick="diecoo();" />Ticket Asig. Empleado.</a></li>
                    <hr>
                     <Li><a <input  type="submit" name="BTNIni" id="BTNIni" value="Inicio" onclick="self.location.href ='EstadisticasDepartOrigen.php'" onkeypress="self.location.href ='EstadisticasDepartOrigen.php'" onmousedown="diecoo();" onclick="diecoo();" />Ticket por Departamento de Origen</a></Li>
                    </ul>
                    </li>
              
      </ul>

     </form>
  </div>


  <div class="TablaBusqDept">
<?php

//Llama la opciòn de tabla de busqueda para que se muestre en pantalla
 require_once("TablaBusqEstad.php");
 //require_once("TablaBusq.php");
//require_once("index.php");
 ?>
 </div>




<div class="AyudaDetalle">

 <form name="atrass" method="POST"  action="EstadisticasDepart.php">
        
       
         <p>Atras  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input style='background:url("img/atrasimg.png");' type="submit" name="BTNatras" id="BTNatras" value=" &nbsp;" onclick="self.location.href ='EstadisticasDepart.php'" onkeypress="self.location.href ='EstadisticasDepart.php'" Title="ir a resultados anteriores"/></P>  
        
        
  </form>



</div>


<div class="TablaDetalleDeptOrigen">

<?php
require_once("ConDetalleDeptDestino.php");
?>
</div>

</div>
</div>
 </body>
  
</html>






