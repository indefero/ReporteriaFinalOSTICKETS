<!--Este PHP es el encargado de mostar en pantalla la informaciòn que fue selecionada en la tabla de busqueda avanzada-->

<?php
    require_once("conexion.php");//Manda a llamar el archivo de conexion de la base de datos
     $conexion = conectar();//variable a la cual retorna la cadena de conexion de la base de datos
    
?>

<div class="MarcoPrincipal">


<?php
     require_once("Utilidad.php");
?>


<title>Reportería de Tickets Avanzada</title> <!--Titulo del archivo de indextab.php-->

  <div class="subTituloReportAv"><!--clases para ser utilizada en el archivo de css-->
	     <H1><legend>Reporterìa de Tickets avanzada</legend></H1><!--Titulo que se muestra en la presentacion de la pagina web-->
  </div>
    </br></br></br></br></br>
  <center><div class="MenuAv"><!--Clases para ser utilizada en el archivo de css para el control del menu-->

    <ul> <!--referencias a los distintos tipos de opciones del menu de busqueda-->
        	 <li><a href="indexTab.php">Inicio</a></li>
           <li><a href="BusquedaAv.php">Bùsqueda</a></li>
           <Li><a href="BusquedaTickAsig.php">Asignado</a></Li>
             <li><a href="">Tickets</a>
                    <ul class="tiket">
                   <Li><a href="TicketCerrado.php">Tickets Cerrado</a></Li>
                       <li><a href="TicketAbierto.php">Tickets Abierto</a></li>
                       </ul>
                  </li>
           
   	</ul>
  </div></center>

</body>
</html>

<div class="ReportAV"><!--Clase para trabajar con la hoja de estilo para la tabla de informaciòn-->
  <hr>
<?php
    require_once("ConQueryBusqAv.php");
    require_once("footer.php");
?>
</div>
</div>