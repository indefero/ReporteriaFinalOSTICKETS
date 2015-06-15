<?php
error_reporting(0);

//Inicialización de las Variables

$VarExport=0;
$VarFilas=0;
//Asignación de la cookies del departamento de Detino de la Grafica
$VarExport =  $_COOKIE["VarCookieDestino"];


// Inicialización de las Variable
$VarExportFinalq=0;
$VarExportInicio=0;

$TotalFinalCerrado=0;
$TotalFinalAbierto=0;
$i=0;
$ii=0;
//Asigancion de las cookies de la Fecha de Búsqueda
 $VarExportInicio =  $_COOKIE["VarCookieInicio"];
 $VarExportFinalq =  $_COOKIE["VarCookieFinalq"];

 ?>

 
 <?php
 
//if($VarExport!="" and $VarExportInicio!="" and $VarExportFinalq!="" )
 if( $VarExportInicio!=0 and $VarExportFinalq!=0)
      {


$queryq = "SELECT ot.staff_id ,concat_ws(' ',os.firstname,os.lastname)as nombre,count(ot.ticket_id ) as TotalCerrado,ots.state FROM ost_ticket ot
             left join ost_staff os on os.staff_id=ot.staff_id
            left join ost_ticket_status ots on ots.id=ot.status_id
             left join ost_help_topic oht on ot.topic_id=oht.topic_id
             where (ot.created BETWEEN '$VarExportInicio ' and ' $VarExportFinalq') and oht.topic='$VarExport' and ot.status_id='3' group by ot.staff_id order by nombre asc";   

                                             

                     $resultadoq = mysqli_query( $conexion, $queryq );
                        foreach ($resultadoq as $clave => $keyq) 
                        {             
                      $TotalFinalCerrado+=$keyq['TotalCerrado'];
                    }



  $queryqq = "SELECT ot.staff_id ,concat_ws(' ',os.firstname,os.lastname)as nombress,count(ot.ticket_id ) as TotalAbierto,ots.state FROM ost_ticket ot
             left join ost_staff os on os.staff_id=ot.staff_id
             left join ost_ticket_status ots on ots.id=ot.status_id
              left join ost_help_topic oht on ot.topic_id=oht.topic_id
             where (ot.created BETWEEN '$VarExportInicio ' and ' $VarExportFinalq') and oht.topic='$VarExport' and ot.status_id='1' group by ot.staff_id order by nombress asc";   

                                             

                     $resultadoqq = mysqli_query( $conexion, $queryqq );
                        foreach ($resultadoqq as $clave => $keyqq) 
                        { 
                                
                      $TotalFinalAbierto+=$keyqq['TotalAbierto'];
                    
                    }
                  

}else{
         
$queryq = "SELECT ot.staff_id ,concat_ws(' ',os.firstname,os.lastname)as nombre,count(ot.ticket_id ) as TotalCerrado,ots.state FROM ost_ticket ot
             left join ost_staff os on os.staff_id=ot.staff_id
            left join ost_ticket_status ots on ots.id=ot.status_id
             left join ost_help_topic oht on ot.topic_id=oht.topic_id
             where oht.topic='$VarExport' and ot.status_id='3' group by ot.staff_id order by nombre asc";   

                                             

                     $resultadoq = mysqli_query( $conexion, $queryq );
                        foreach ($resultadoq as $clave => $keyq) 
                        {             
                      $TotalFinalCerrado+=$keyq['TotalCerrado'];
                    }



        
$queryqq = "SELECT ot.staff_id ,concat_ws(' ',os.firstname,os.lastname)as nombress,count(ot.ticket_id ) as TotalAbierto,ots.state FROM ost_ticket ot
             left join ost_staff os on os.staff_id=ot.staff_id
             left join ost_ticket_status ots on ots.id=ot.status_id
             left join ost_help_topic oht on ot.topic_id=oht.topic_id
             where oht.topic='$VarExport' and ot.status_id='1' group by ot.staff_id order by nombress asc";   

                                         

                     $resultadoqq = mysqli_query( $conexion, $queryqq );
                        foreach ($resultadoqq as $clave => $keyqq) 
                        { 
                                
                      $TotalFinalAbierto+=$keyqq['TotalAbierto'];
                    
                    }
      }



?>



<div class="TodaslasTablas">
 <table   cellpadding=0 cellspacing=0 class="tabla" id="Exportar_a_Excel">
      
<td valign = TOP colspan="3">
<div class="TablaTotal">
  </br></br>

<strong><center>Tabla de Resultados </center></strong>
<table  border="1" cellspacing="0" cellpadding="2" align="center" >
    <tr bgcolor='bbbbbb'>
      
      <td ALIGN="CENTER">Cerrados</td>
      <td ALIGN="CENTER">Abierto</td>
      <td ALIGN="CENTER">Total</td>
    </tr>
    <tr>
     
      <td ALIGN="CENTER"> <?php echo $TotalFinalCerrado;?></td>
      <td ALIGN="CENTER"><?php echo $TotalFinalAbierto;?></td>
       <td ALIGN="CENTER"><?php echo  $TotalFinalCerrado+$TotalFinalAbierto;?></td>
    </tr>
    <tr>
      </table>
     <center> <strong><p>Mostrar  los  <?php echo  $TotalFinalCerrado+$TotalFinalAbierto;?> Tickets <a href="http:DetallesTemaAyuda.php">aquí</a></p></strong></center>
      </div>   
</td>

      <tr>
      <td valign = TOP>
<div class="TablaIndividualCerrado">

<?php
echo "<strong><center>Tabla de Tickets Cerrados</center></strong>";
       echo"<table border=1 cellspacing=0 cellpadding=2 align='center' >";// creacion de la tabla con los encabezados que se mostarar en el pantalla principal
   
            echo "<tr  align='center' bgcolor='bbbbbb' >
              
                 <td ALIGN=CENTER>Nº</td>
                 <td ALIGN=CENTER>Nombre del agente</td>
                  <td ALIGN=CENTER>Cerrado</td>
                
                 
                   </tr>";     
                   
                    
                      // ciclo de foreach que imprime el resultado en la pantalla web de cada uno de los resultados
                 foreach ($resultadoq as $clave => $keyq) 
                        { 
                        $i++;                            
     ?>  

 <script>
   
 $(function(){

    $(".onmouseout").click(function(e) {

          e.preventDefault();
        var NombreAgente = $(this).attr("NombreAgente");
document.cookie ='VarCookieNombreAgente='+NombreAgente+';';
               
       //alert(NombreAgente);   
      window.open('DetallesAgenteTema.php','Detalles','width=1000, height=500')
       

    });

});

</script>  


             <tr NombreAgente="<?php echo($keyq['nombre'])?>" class="onmouseout" <?php if ($i%2==0) 
                                   echo "bgcolor=#C4C7D6"; //si el resto de la división es 0 pongo un color 
                                else 
                                 echo "bgcolor=#FDFDFD"; //si el resto de la división NO es 0 pongo otro color ?>>
                     
                           <td ALIGN="CENTER"><?php echo($i)?></td>
                           <td><a href=''><?php echo $keyq['nombre']?></a></td>                             
                           <td ALIGN="CENTER"><?php echo $keyq['TotalCerrado']?></td>  

                            </tr>
                          


        <?php } ?>
                      
                      </table>
<?php

?>
</div>

</td>

<td>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</td>

<td  valign = TOP>

<div class="TablaIndividualAbierto">
<?php

//-------------------------------------------------------------------------------------------------------------------

echo "<strong><center>Tabla de Tickets Abierto  </center></strong>";
 echo"<table border=1 cellspacing=0 cellpadding=2 align='center' >";// creacion de la tabla con los encabezados que se mostarar en el pantalla principal
   
            echo "<tr  align='center' bgcolor='bbbbbb' >
              
                 <td ALIGN=CENTER>Nº</td>
                 <td ALIGN=CENTER>Nombre del agente</td>
                  <td ALIGN=CENTER>Abierto</td>
                
                 
                   </tr>";

                   
                      
                      // ciclo de foreach que imprime el resultado en la pantalla web de cada uno de los resultados
                 foreach ($resultadoqq as $clave => $keyqq) 
                        { 
                         
                        $ii++;                            
     ?>  
 <script>
   
 $(function(){

    $(".click").click(function(e) {

          e.preventDefault();
        var NombreAgentess = $(this).attr("NombreAgentess");
document.cookie ='VarCookieNombreAgentess='+NombreAgentess+';';
               
       //alert(NombreAgentess);   
      window.open('DetallesAgentesAbiertoTema.php','Detalles','width=1000, height=500')
       

    });

});

</script>  

 <tr NombreAgentess="<?php echo($keyqq['nombress'])?>" class="click" <?php if ($ii%2==0) 
                                   echo "bgcolor=#C4C7D6"; //si el resto de la división es 0 pongo un color 
                                else 
                                 echo "bgcolor=#FDFDFD"; //si el resto de la división NO es 0 pongo otro color ?>>
                     
                           <td ALIGN="CENTER"><?php echo($ii)?></td>
                           <td><a href=''><?php echo $keyqq['nombress']?></a></td>                             
                           <td ALIGN="CENTER"><?php echo $keyqq['TotalAbierto']?></td>  

                            </tr>                                   


        <?php } ?>
                      
                      </table>
         
<?php
   
?>
</div>

</td>
      </tr>



                                           
  
                    






