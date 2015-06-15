<?php

//Este php es el que muestra las estaditicas generales de los departamento y por intervalos de fecha
require_once("conexion.php");//Manda a llamar el archivo de conexion de la base de datos
 $conexion = conectar();//variable a la cual retorna la cadena de conexion de la base de datos

?>



<html>

<body>
<div class="MarcoPrincipal">
<div class="MarcoEncabezado">

<?php
require_once("Utilidad.php");
?>

<div class="TablaFechDepart">
<?php
require_once("TablaInterFecha.php");
?>   
</div>


<!--Estilo requerido para la tabla que se muestra en pantalla con las informaciòn y grafica-->
  <style type="text/css">

table {
    /*  font: 11px Verdana, Arial, Helvetica,sans-serif;
      padding:7px;*/
      font-family: Georgia, "Times New Roman", serif;
      padding: 7px;
       }

</style>

<script >
  
  function diecoo(){
        

var fechaActual = new Date();
fechaActual.setTime(fechaActual.getTime() + (1000 * 1000))
var strExpiracion = fechaActual.toGMTString();
document.cookie="VarCookieInicio=0; expires=+strExpiracion";
document.cookie="VarCookieFinalq=0; expires=+strExpiracion";

 
}
</script>


<title>Estadìsticas Departamento Destino</title> <!--Titulo del archivo de indextab.php-->

  <div class="subTituloEstadi0"><!--clases para ser utilizada en el archivo de css-->
 
  <form name="atrass" method="POST" class="click">

	     <H1><legend>Estadìsticas de los Departamento Destino  por Tickets </legend></H1><!--Titulo que se muestra en la presentacion de la pagina web-->
  </div>
    </br></br>

	<div class="MenuEstadi"><!--Clases para ser utilizada en el archivo de css para el control del menu-->
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
      </from>




	</div>
  

 <div class="Ayudadestino">

 <form name="atrass" method="POST"  action="EstadisticasDepart.php">
        <p>Ayuda  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input style='background:url("img/Ayuda.jpeg");' type="submit" name="BTNAyuda" id="BTAyuda" value=" &nbsp;" onmousedown="ayuda();" Title="doble click para acceder al Manual de reporteria"  /></P>  
        <p>Actualizar<input style='background:url("img/Actualizar.jpeg");' type="submit" name="BTNActualizar" id="BTNActualizar" value="&nbsp;&nbsp;" Title="mostrar graficas actuales" /></P>  
         
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


<script>

   
  $(function(){


    $(".click").click(function(e) {

      var contador = 0;
        contador++;

        e.preventDefault();
        var data = $(this).attr("data-valor");

               
  //      alert(data);   
//document.cookie ='variable='+data+'; expires=Thu, 2 Aug 2021 20:47:11 UTC; path=/'; cooki con fecha de expiraciòn
document.cookie ='VarCookieDestino='+data+';'; // Cooki sin fecha de expiraciòn


   // window.location="DetallesDeptDestino.php";
   window.location="DetalleIndividualDepartDestino.php";
  
    });

});


</script>


     

<div class="TablaEstadiDept">
<FORM action="DetallesDeptDestino.php" method="POST" >
 <?php 

 require_once("ConQueryEstaDepart.php");

  echo"<table border=1 align='center' cellspacing=0 cellpadding=2 id='Exportar_a_Excel'>";// creacion de la tabla con los encabezados que se mostarar en el pantalla principal de las estadisticas por departamento
   echo "<tr align='center' bgcolor='bbbbbb' >
              
                 <b><td ALIGN=CENTER>Nº</td></b>
                 <td ALIGN=CENTER>Departamento Destino</td>
                 <td ALIGN=CENTER>Total Ticket</td>
                 <td ALIGN=CENTER>Porcentaje</td>
                 <td ALIGN=CENTER>Grafica base 100%</td>
                </tr>";
                    
 //Inicializaciòn de las variablea a utilizar durante el trayecto de todo la operacion
                    $i=0;
                    $TotalColum=0;
                    $porcentaje=0;
                    $ColorGrafico=0;
 //Ciclo de foreach que captura el total de general de los ticket por departamento
                 foreach ($registros as $clave => $key) 
                        { 
                        $TotalColum+=$key['total'];
                                                 
                       }
//Cliclo de foreach que captura el color de las columna ,color del grafico y los distinto valores que se muestran en pantalla
                      foreach ($registros as $clave => $key) 
                                { $i++;
                                echo "<tr "; 
                                  if ($i%2==0) 
                                    {
                                    echo "bgcolor=#C4C7D6"; //si el resto de la división es 0 pongo un color 
                                    $ColorGrafico="bgcolor=#3C5DE2";
                                    }                          
                                    else
                                       {
                                        echo "bgcolor=#FDFDFD"; //si el resto de la división NO es 0 pongo otro color 
                                        $ColorGrafico="bgcolor=#E9192A";
                                        }
                               
                                echo ">";
//Operaciòn requeridad para calcular el porcentaje en base al 100% de cada uno de los resultados en pantalla
                             $porcentaje = round((($key['total']/$TotalColum)*100),2); 
 ?>
<!--Llenado de la tabla por cada valor segùn su columna-->
         <tr data-valor="<?php echo($key['nombre'])?>" class="click">

              <td width=4% ALIGN="CENTER"> <?php echo( $i)?></td>
              <td width=30%><a href='DetallesDeptDestino.php'><strong><?php echo($key['nombre'])?></a></strong></td>
              <td width=10% ALIGN="CENTER"><?php echo($key['total'])?></td>
              <td width=8% ALIGN="CENTER"><?php echo($porcentaje)?>%</td>
         
          <td>
          <table width="<?php echo($porcentaje) ?>%" <?php echo($ColorGrafico)?>>
              <tr><td></td></tr>
            </table>
      <hr>
      </td>
      </tr>
    <?php } ?>
     
 </div> 

 
 </body>
 </from>
 </div>
 
  </div>
  
</html>
























 