<!--Este PHP es el encargado de mostrar toda la informaciòn en una tabla en pantalla de los ticket en la bùsqueda avanzada-->
<div class="LineaTab">

<script>

   
 $(function(){


    $(".ondblclick").click(function(e) {

      var contador = 0;
        contador++;

        e.preventDefault();
        var NurTicket = $(this).attr("Nutickets");
document.cookie ='VarCookieNumero='+NurTicket+';';
               
       //alert(data);   
       window.open('HiloTickets.php','nuevaVentana','width=900, height=500')
       

  
    });

});



</script>

 <?php
$valor=0;
 echo"<table border=1 align='center' cellspacing=0 cellpadding=2 id='Exportar_a_Excel'>";// creacion de la tabla con los encabezados que se mostarar en el pantalla principal
 
  
 echo "<tr align='center' bgcolor='bbbbbb' >
              
                 <b><td  ALIGN=CENTER>Nº</td></b>
                 <td  ALIGN=CENTER>Ticket</td>
                 <td  ALIGN=CENTER>Fecha</td>
                 <td  ALIGN=CENTER>Remitente</td>
                 <td  ALIGN=CENTER>Asignado a</td>
                 <td  ALIGN=CENTER>Departamento Origen</td>
                 <td  ALIGN=CENTER>Departamento Destino</td>
                 <td  ALIGN=CENTER>Tema de ayuda</td>
                 <td  ALIGN=CENTER> Estado Ticket</td>
                 <td  ALIGN=CENTER> Prioridad Ticket</td>
                  <td  ALIGN=CENTER>Medio de solicitud</td>
                </tr>";
                    

  $i=0;
                    // ciclo de foreach que imprime el resultado en la pantalla web de cada uno de los resultados
                 foreach ($resultado as $clave => $key) 
                        { 
                        $i++;
                         

?>                         
             <tr Nutickets="<?php echo($key['number'])?>"  class="ondblclick" <?php if ($i%2==0) 
                                   echo "bgcolor=#C4C7D6"; //si el resto de la división es 0 pongo un color 
                                else 
                                 echo "bgcolor=#FDFDFD"; //si el resto de la división NO es 0 pongo otro color ?>>
                          
                           <td  ALIGN="CENTER"><?php echo($i)?></td>
                           <td  ALIGN="CENTER"><a href=''><?php echo $key['number']?></a></td>
                            <td><?php echo $key['created']?></td>
                            <td><?php echo $key['name']?></td>
                            <td> <?php echo $key['firstname']." ".$key['lastname']?></td>
                            <td> <?php echo $key['extra']?></td>
                            <td> <?php echo $key['dept_name']?></td>
                            <td> <?php echo $key['topic']?></td>
                            <td  ALIGN="CENTER"><?php echo $key['state']?></td>
                            <td  ALIGN="CENTER"> <?php echo $key['priority_desc']?></td>
                            <td  ALIGN="CENTER"> <?php echo $key['value']?></td>
                            </tr>

                           <?php } ?>
                      
                      </table>

    


<?php ?>
