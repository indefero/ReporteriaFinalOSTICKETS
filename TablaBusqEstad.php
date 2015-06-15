<!DOCTYPE HTML PUBLIC >

<html lang="es">


 <script>
      // Validaciòn requeridad para la caja de texto de bùsqueda solo acepta caracteres de la A-Z ,a-z y 0-9 
    function validar(e) 
      { 
        tecla = (document.all) ? e.keyCode : e.which; 
        if (tecla==8) return true; 
        patron =/[A-Za-z-0-9\s]/; 
        te = String.fromCharCode(tecla); 
    return patron.test(te); 
      } 

      //Validaciòn para habilitar la caja de texto cuando este deshabilitada
      function HabilitarBTN(c)
        {
        document.getElementById("btnbuscar").disabled = (c!="") ? false : true;
        document.getElementById("btnborrar").disabled = (c!="") ? false : true;
        }

      //Validaciòn para deshabilitar el botòn de buscar cuando le presiona el boton de borrar
      function boton (obj)
        {
        document.getElementById('btnbuscar').disabled="true";
       }
</script>

<body onload="asignaVariables();">
      
<FORM name='indexTab.php'  method="POST" >
    <TABLE ><!--Creacion de la tabla busqueda para dar un mejor ambiente de busqueda-->
      <TR><TD>
        <TABLE ><!--mension al tamaño de tabla de busqueda-->
          <TR>
          <!--Tipos de opciones de busqueda de la tabla-->
            <legend>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Opciòn de bùsqueda de Tickets</legend>
            <TD><TD align="left">


      <div id="demo" style="width:600px;">
        <div id="demoDer">
          <input type="text" id="input_2" name="input_2" class="input" 
          onfocus="if(document.getElementById('lista').childNodes[0]!=null && this.value!='') { filtraLista(this.value); formateaLista(this.value); 
            reiniciaSeleccion(); document.getElementById('lista').style.display='block'; }" 
          onblur="if(v==1) document.getElementById('lista').style.display='none';" 
          onkeyup="if(navegaTeclado(event)==1) {
            clearTimeout(ultimoIdentificador); 
            ultimoIdentificador=setTimeout('rellenaLista()', 1000); }" placeholder="Ingrese los terminos de busqueda " size="28px" onmouseover="HabilitarBTN(this.value);" onclick="HabilitarBTN(this.value);" onkeypress="return validar(event)" onkeyup="HabilitarBTN(this.value); " autocomplete="off">


             <INPUT   type="submit" name="btnbuscar" id="btnbuscar"value="Buscar" disabled="false">&nbsp;&nbsp;
           <!--Declaracòn para el botòn de cerrar-->
           <INPUT   type="reset" name="btnborrar"id="btnborrar"value="Borrar" disabled="false" onclick="boton(this)">&nbsp;&nbsp; 
           <!--Declaraciòn para el boton de Busqueda Avanzada -->
            <INPUT   type="submit" name="btnResul" id="btnResul" value="Resultados anteriores">&nbsp;&nbsp;
     
          <div id="lista" onmouseout="v=1;" onmouseover="v=0;"></div>
        </div>
        
        <div class="mensaje" id="error"></div>
      </div>

             <!--Declaracion de la caja de texto-->
                
                   
           

            </TD>
          </TR>             
       </TABLE>
   </TD></TR>
 </TABLE>
</FORM>
      
</body>
</html>