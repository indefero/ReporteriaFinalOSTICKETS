<!--Este PHP es el encargado de mostar en pantalla los diferentes tipos de opciones que el usuario podria utilizar para un mejor analisis de informaciòn-->
<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<link rel="stylesheet" href="style.css"><!--referencia al archivo de estilos de la paginas en cada uno de los archivos php-->
<script type="text/javascript" src="JavascriptIndex.js"></script><!-- referencia al archivo de estilos en cada uno de los archivos php-->
<head>
<script type="text/javascript" src="Ajax.js"></script>
</head>
<!-- script que se ocupan para la opciòn de exportacion de pagina web a microsoft excel-->
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<script type="text/javascript" src="jquery-1.3.2.min.js"></script><!-- se hace el llamado a la libreria de jquery para trabajar-->



 <script type='text/javascript' src='Browser.js'></script>
    <script type='text/javascript'>
      var brw = new Browser();
    // alert('fullName: ' + brw.fullName + '\n' + 'name: ' + brw.name + '\n' + 'fullVersion: ' + brw.fullVersion + '\n' + 'version: ' + brw.version + '\n' + 'platform: ' + brw.platform+ '\n' + 'mobile: ' + brw.mobile+ '\n' + 'resolution: ' + brw.width + 'x' + brw.height);
   
   if(brw.fullName!=='Google Chrome'){
   alert("ATENCIÓN: El navegador que estas utilizando.No es compatible con éste sitio web. Recomendamos utilizar Google Chrome V.42.0 ,Lo redireccionaremos para efectuar la descarga");
   window.location="http://www.google.com/chrome/browser/desktop/index.html";
   
  }



    </script>


<script language="javascript">

 
$(document).ready(function() 
	{
  	$(".botonExcel").click(function(event)
  		 {
   			 $("#datos_a_enviar").val( $("<div>").append( $("#Exportar_a_Excel").eq(0).clone()).html());
    		 $("#FormularioExportacion").submit();
		});
});
</script>

<style type="text/css">
.botonExcel{cursor:pointer;}
</style>


<div class="Utilidad">
  <TABLE ><!--Creacion de la tabla busqueda para dar un mejor ambiente de busqueda-->
      <TR><TD>
        <TABLE width="180"><!--mension al tamaño de tabla de busqueda-->
          <TR>
          <!--Tipos de opciones de busqueda de la tabla-->
            <center><legend>Utilidades</legend></center>
            <TD><TD align="left"><!-- referencia al javascript de la libreria windows para que haceda a una opcion predetermianda para que imprima los resultados de las tablas-->
            <p>Imprimir Documento<a href="javascript:window.print()"><img src="img/impresora.jpg" width="" height="" alt="" /></a></P>
           
            <!-- hace referencia a que tablas es la que desea exportar  un fichere xls por su respectivo id-->
      			<form action="ficheroExcel.php" method="post" target="_blank" id="FormularioExportacion">
			      <p>Exportar a Excel &nbsp;&nbsp;&nbsp;  <img src="img/export_to_excel.gif" class="botonExcel" /></p>
		        <input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
		 <hr>
     				</form>
      <!-- Opciòn de filtrado para los diferentes tipos de tablas mostradas-->
       <form  method="POST" >
           <center> <legend>Mostrar los primeros:</legend></center>
             <center><select name="NivelCon" id="NivelCon" style="width:100px">
                <option value="0" >-Todos los registro-</option>
                <option value="1">-100 registro-</option>
                <option value="2">-200 registro-</option>
                </select>
                   <INPUT type="submit" name="btnAceptar"  value="Aceptar" >
       </form>
          </TR>   
          </TABLE>
   </TD></TR>
 </TABLE>
</div>
<body>
</body>
</hrml>
