<!DOCTYPE html>
<html>
<header>
  
</header>

<body>
 <script>
    //funciòn para la validacion de la fecha donde la fecha de desde no puede ser mayor que la fecha hasta
function validar() {
        var inicio = document.getElementById('Inicio').value; 
        var finalq  = document.getElementById('Fin').value;


       
    
document.cookie ='VarCookieInicio='+inicio+';';
document.cookie ='VarCookieFinalq='+finalq+';';

//document.cookie ='variable='+data+'; expires=Thu, 2 Aug 2021 20:47:11 UTC; path=/'; cooki con fecha de expiraciòn
 
        inicio= new Date(inicio);
        finalq= new Date(finalq);

      

        if(inicio>finalq)
        {
        alert('La fecha Desde no puede ser mayor que la fecha Hasta verifique sus fechas');
         }
       }
   
     </script>


      
<form name='tabla.php' method="POST" class="formulario" onkeypress="validar()" onchange="validar();" >
  <TABLE cellspacing=0 cellpadding=0><!--Creacion de la tabla busqueda para dar un mejor ambiente de busqueda-->
      <TR><TD>
        <TABLE cellspacing=0 cellpadding=0><!--mension al tamaño de tabla de busqueda-->
         <center><legend><h4>Búsqueda por intervalo de fechas</h4></legend></center>
          <tr>
          <!--datapicker para el calendario en pantalla-->
       <label>Desde que fecha:</label>
            <!--Calendario de fecha desde-->
           
              <input type="date" name="Inicio" id="Inicio" step="1" required/>
             &nbsp;
              <!--Calendario de fecha hasta-->
              <label> Hasta que fecha:</label>
          <input type="date" name="Fin" step="1" id="Fin" required/>
          
           <center><input type="submit" name="btnConsulta" value="Consultar" /> &nbsp;
           <input type="reset" name="btnRest" value="Borrar"/></center>
           
            </tr>

        
            </TABLE>
            </TD></TR>
 </TABLE>
 </form>
</body>

 </html>