<!--Este php es encargo de realizar la busqueda avanzada portodas sus categorias y fechas-->

<?php
require_once("conexion.php");//Manda a llamar el archivo de conexion de la base de datos
 $conexion = conectar();//variable a la cual retorna la cadena de conexion de la base de datos
?>


<!DOCTYPE html>
<html lang="en">

<div class="MarcoPrincipalC">




<head>
	<meta charset="UTF-8">
	<title>Bùsqueda Avanzada</title><!--Titulo del archivo de busquedaAv.php-->
	<link rel="stylesheet" href="style.css"><!--referencia al archivo de estilos de la paginas-->
	<script type="text/javascript" src="JavascriptIndex.js"></script><!-- referencia al archivo de estilos -->
</head>


<body>

    <script>
    //funciòn para la validacion de la fecha donde la fecha de desde no puede ser mayor que la fecha hasta
function validar() {
        var inicio = document.getElementById('Inicio').value; 
        var finalq  = document.getElementById('Fin').value;
        inicio= new Date(inicio);
        finalq= new Date(finalq);
        if(inicio>finalq)
        {
        alert('La fecha Desde no puede ser mayor que la fecha Hasta verifique sus fechas');
         }
         
      }

// funcion para bloquear un combobox ya sea asignado o cerrado si se selecciona una opción específica en combobox estado
 function cambiar(select){
    var BloqAsig = document.getElementById("Asignado");

     if(select.value=="3"){

      BloqAsig.disabled = true;
      BloqAsig.value=0;
    }else{
      BloqAsig.disabled = false;
       BloqAsig.value=0;
       }
   
   var BloqCerr = document.getElementById("Cerrado");
     if(select.value=="1"){
      BloqCerr.disabled = true;
    }else{
      BloqCerr.disabled = false;
       }
  }
        

</script>

  <div class="principal"><br><!--nombre de la clase principal del archivo-->
		<h1>Reportería de Tickets</h1><hr><!--titulo que se mostrara para la pagina busquedaAv-->
		
		<div class="second"><!--nombre de la clase segundaria para mostrar dentro de un caja-->
		<form action="reportBusqAv.php" method="post" class="formulario" onkeypress="validar()" onchange="validar();">

 <br><fieldset>
			<br><table border="0">
			 <legend><h2>Seleccione sus criterios de búsqueda</h2></legend><!--subtitulo del frame de los comobox-->
			 	<tr>
        <!--Combobox para el estado de los ticket-->
        <td><label for="estado">Tipo de estado: </label></td>
					<td><select  name="estado" id="estado" style="width:200px"  onchange="cambiar(this);" ><br>
     		  <option value="0" >-Cualquier Estado-</option>
           <option value="1">Abierto</option>
            <option value="3">Cerrado</option>
					</select></td>

           <!--Combobox para el medio de solicitud de los ticket-->
  <td><label for="medio">Medio de solicitud: </label></td>
			<td><select name="MedSolicit" id="MedSolicit" style="width:200px">
	     			<option value="0"> -Selectionar-</option>
      	 		<?php
              //Query para hacer el combobox dinamico desde la informacion de la Base de datos
  				       $strSql = "select * from ost_list_items  order by value ASC";
     			      $registros = $conexion->query($strSql);
        			//echo "La seleccion devolvió ". $registros ." filas</br>";
                  
      				 foreach($registros as $fila)
       						{
               				  if($fila['id']<=8 )
               				  {
               		 echo "<option value=".$fila['id'].">";

                  			  echo $fila['value'];
                              echo "</option>";


                  				}

                          if($fila['id']==83)
                            {
                        echo "<option value=".$fila['id'].">";
                          echo $fila['value'];
                              echo "</option>";
                          }
                          if($fila['id']==54)
                            {
                        echo "<option value=".$fila['id'].">";
                          echo $fila['value'];
                              echo "</option>";
                          }
        					}      
           $registros->close();
  
   			  ?>
			 </select></td>
					</tr>

				<tr>
 <!--Combobox para el departamento de destino de los ticket-->
        <td><label for="departamento">Departamento de destino:</label></td>
		<td><select name="Departamentos" id"Departamentos" style="width:200px">><br>
		    		<option value="0"> -Todos los departamentos-</option>
        
			<?php  
        //Query para hacer el combobox dinamico desde la informacion de la Base de datos
        			$strSql = "select * from ost_department  order by dept_name ASC";
        			$registros = $conexion->query($strSql);
        			//echo "La seleccion devolvió ". $registros ." filas</br>";

         			foreach($registros as $fila)
         					{
            				echo "<option value=".$fila['dept_id'].">";
            				echo $fila['dept_name'];
				            echo "</option>";
        					}
        				   $VarDepart=$fila['dept_id'];
        $registros->close();
      
     		?>

		</select></td>

 <!--Combobox para el nivel de prioridad de los ticket-->
      <td><label for="prioridad">Nivel de prioridad: </label></td>
		<td><select name="Prioridad" id="Prioridad" style="width:200px"><br>
				<option value="0"> -Seleccionar Prioridad-</option>
			 <?php
           //Query para hacer el combobox dinamico desde la informacion de la Base de datos
    	     		$strSql = "select * from ost_ticket_priority  order by priority_desc ASC";
       		        $registros = $conexion->query($strSql);
        			//echo "La seleccion devolvió ". $registros ." filas</br>";

         			foreach($registros as $fila)
         				{
           		                               
                       echo "<option value=".$fila['priority_id'].">";
                       echo $fila['priority_desc'];
                       echo "</option>";
        				}
        $registros->close();
     			?>
				</select></td>

			</tr>
<tr>
 <!--Combobox para el departamento de origen de los ticket-->
        <td><label for="origen">Departamento de origen: </label></td>
		<td><select name="DepartaOrigen" id="DepartaOrigen" style="width:240px"><br>
            <option value="0" >-Todos los departamentos-</option>

          <?php
          //Query para hacer el combobox dinamico desde la informacion de la Base de datos
              $strSql = "select * from ost_list_items  order by value ASC";
              $registros = $conexion->query($strSql);
        	 //echo "La seleccion devolvió ". $registros ." filas</br>";
                  
       			foreach($registros as $fila)
       					{
               			if($fila['id']>=9 and $fila['id']<54)
               				{
               					echo "<option value=".$fila['id'].">";
                  				echo $fila['value'];
                     			echo "</option>";
                  			}

                        if($fila['id']>54 and $fila['id']<83)
                            {
                          echo "<option value=".$fila['id'].">";
                          echo $fila['value'];
                          echo "</option>";
                        }

                         if($fila['id']==84)
                            {
                          echo "<option value=".$fila['id'].">";
                          echo $fila['value'];
                          echo "</option>";
                        }
        				}      
       $registros->close();
         
     	?>
		</select></td>

 <!--Combobox para el personal asignado de los ticket-->
<td><label for="asignado">Asignado a: </label></td>
          <td><select name="Asignado" id="Asignado" style="width:200px" ><br>
            <option value="0"> -Cualquiera-</option>
      <?php
        //Query para hacer el combobox dinamico desde la informacion de la Base de datos
            $strSql = "select * from ost_staff  order by firstname ASC";
            $registros = $conexion->query($strSql);
        //echo "La seleccion devolvió ". $registros ." filas</br>";

              foreach($registros as $fila)
                    {
                    echo "<option value=".$fila['staff_id'].">";
                      echo $fila['firstname']." ".$fila['lastname'];
                    echo "</option>";
                      }
        $registros->close();
      ?>
       </select></td>

				</tr>
				<tr>


 <!--Combobox para los temas de ayuda de los ticket-->
<td><label for="centralizada">Tema de ayuda:</label></td>
 			<td><select name="Ayuda" id="IDAyuda" style="width:240px"><br>
            <option value="0">-Todos los temas de ayuda-</option>
 	      <?php
          //Query para hacer el combobox dinamico desde la informacion de la Base de datos
         		$strSql = "select * from ost_help_topic  order by topic ASC";
        		$registros = $conexion->query($strSql);
    		    //echo "La seleccion devolvió ". $registros ." filas</br>";

         		foreach($registros as $fila)
         				{
                 
           				 echo "<option value=".$fila['topic_id'].">";
           				 echo $fila['topic'];
             			 echo "</option>";

        				}
        $registros->close();
  		   ?>
			</select></td>

 <!--Combobox para el personal que cerror el  ticket-->
<td><label for="cerrado">Cerrado por: </label></td>
      <td><select name="Cerrado" id="Cerrado" style="width:200px" ><br>
        <option value="0"> -Cualquiera-</option>

     <?php
       //Query para hacer el combobox dinamico desde la informacion de la Base de datos
            $strSql = "select * from ost_staff  order by firstname ASC";
            $registros = $conexion->query($strSql);
            //echo "La seleccion devolvió ". $registros ." filas</br>";

            foreach($registros as $fila)
                {
                  echo "<option value=".$fila['staff_id'].">";
                    echo $fila['firstname']." ".$fila['lastname'];
                  echo "</option>";
                   }
        $registros->close();
    ?>
      </select></td>
			 </tr>


</table>
</fieldset><br><br><hr>

		
<fieldset>
			<table border="0">
  <legend><h2>Búsqueda por intervalo de fechas</h2></legend>
					<tr>
          <!--datapicker para el calendario en pantalla-->
						<center><label>Desde que fecha:</label>
            <!--Calendario de fecha desde-->
				   		<input type="date" name="Inicio" id="Inicio" step="1" required/>
							&nbsp;&nbsp;
              <!--Calendario de fecha hasta-->
		  				<label> Hasta que fecha:</label>
						<input type="date" name="Fin" step="1" id="Fin" required/></center></br>
						</tr>
			</table>
</fieldset><br><br><br><br><br><br><br>

<fieldset class="opciones">
				<legend><h2>Opciones</h2></legend>
				<div><!--Botones para el formulario de busqueda avanzada-->
						<input type="reset" name="btnRest" value="Restablecer"/>
						<input type="button" name="btnCacelarAv" value="Cancelar" onclick="self.location.href ='indexTab.php'" onkeypress="self.location.href ='indexTab.php'"/>
						<input type="submit" name="btnBuscarAv" value="Buscar" formaction="reportBusqAv.php"/>
				</div>
</fieldset>

		</form>


		</div>
		<!--Pie de pagina que se muestra en la tabla de busqueda avanzada-->
			<div class="footer">
				<p>Derechos reservados D.E.I 2015</p>		
				</div>	
			<br><br><br><br><br><br><br><br><br><br></div>

</body>


</div>
</html>