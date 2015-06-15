<?php
 	

$VarExportAgente =  $_COOKIE["VarCookieNombreAgentess"];
$VarExport =  $_COOKIE["VarCookieDestino"];

$TotalFinalCerrado=0;
$TotalFinalAbierto=0;

//Asigancion de las cookies de la Fecha de Búsqueda
 $VarExportInicio =  $_COOKIE["VarCookieInicio"];
 $VarExportFinalq =  $_COOKIE["VarCookieFinalq"];



if( $VarExportInicio!=0 and $VarExportFinalq!=0)
      {

if(isset($_POST['btnbuscar']))
    { //Variable que guarda la informaciòn de la caja de texto a buscar
        $Varnombre = $_POST['input_2'];
        

    // Query requerido para la bùsqueda por la caja de texto para los detalles
           $query = "SELECT ot.staff_id,ot.number,ot.created,os.name,concat_ws(' ',osf.firstname,osf.lastname)as nombre,oli.extra,od.dept_name,oht.topic,ots.state
                 FROM ost_ticket ot 
                    left join ost_user os on ot.user_id=os.id 
                    left join ost_staff osf on ot.staff_id=osf.staff_id
                    left join ost_department od on ot.dept_id=od.dept_id 
                    left join ost_ticket__cdata otd on ot.ticket_id=otd.ticket_id
                    left join ost_list_items oli on otd.departamento = oli.id 
                    left join ost_help_topic oht on ot.topic_id=oht.topic_id
                    left join ost_ticket_status ots on ot.status_id= ots.id
                     where (ot.created BETWEEN '$VarExportInicio ' and ' $VarExportFinalq') and oht.topic='$VarExport' and ots.state='open' and (concat_ws(' ',osf.firstname,osf.lastname)='$VarExportAgente') and( od.dept_name like '%$Varnombre%' or oli.extra like '%$Varnombre%' or os.name like '%$Varnombre%' or ot.number like '%$Varnombre%' )
                     order by ot.created desc ";
        
                $resultado = mysqli_query( $conexion, $query );//variable resultada para almacenar el arreglo de la informacion tomando encuenta la conexion de la DB y el query requerido
                     
                  $VarFilas=0;  
                  if ($resultado->num_rows>=1)// decicion que evalua el numero de registro afectados por el query en caso de ser verdadero imprime la tabla si no llamda a llamar un mensaje de error
                     {         
                      foreach ($resultado as $clave => $key) 
                           { //foreach para mostrar los terminos de búsqueda principal
                               $VarFilas++;                          
                           }
                           echo "<strong>\n\nNº de Tickets:</strong>"; echo $VarFilas;  
                           echo ",<strong>\n\nDepartamento Destino:</strong>"; echo $VarExport;
                           echo ",<strong>\n\nAgente Asignado:</strong>";echo $VarExportAgente;
                           echo ",<strong>\n\nsegùn el intervalo de fecha de: Incio:</strong>";echo $VarExportInicio; 
                           echo ",<strong>\n\n Hasta:</strong>";echo $VarExportFinalq;  
                           echo ",<strong>\n\nBùsqueda por:</strong>";echo $Varnombre;
                      require_once("LlenarTablaDetalle.php");
                       }  
                        else{

                 $query = "SELECT ot.staff_id,ot.number,ot.created,os.name,concat_ws(' ',osf.firstname,osf.lastname)as nombre,oli.extra,od.dept_name,oht.topic,ots.state
                 FROM ost_ticket ot 
                    left join ost_user os on ot.user_id=os.id 
                    left join ost_staff osf on ot.staff_id=osf.staff_id
                    left join ost_department od on ot.dept_id=od.dept_id 
                    left join ost_ticket__cdata otd on ot.ticket_id=otd.ticket_id
                    left join ost_list_items oli on otd.departamento = oli.id 
                    left join ost_help_topic oht on ot.topic_id=oht.topic_id
                    left join ost_ticket_status ots on ot.status_id= ots.id
                     where (ot.created BETWEEN '$VarExportInicio ' and ' $VarExportFinalq') and oht.topic ='$VarExport' and ots.state='open' and (concat_ws(' ',osf.firstname,osf.lastname)='$VarExportAgente')
                     order by ot.created desc ";
        
                $resultado = mysqli_query( $conexion, $query );//variable resultada para almacenar el arreglo de la informacion tomando encuenta la conexion de la DB y el query requerido
                     
                  $VarFilas=0;  
                  if ($resultado->num_rows>=1)// decicion que evalua el numero de registro afectados por el query en caso de ser verdadero imprime la tabla si no llamda a llamar un mensaje de error
                     {         
                      foreach ($resultado as $clave => $key) 
                           { //foreach para mostrar los terminos de búsqueda principal
                               $VarFilas++;                          
                           }
                           echo "<strong>\n\nNº de Tickets:</strong>"; echo $VarFilas;  
                           echo ",<strong>\n\nDepartamento Destino:</strong>"; echo $VarExport;
                           echo ",<strong>\n\nAgente Asignado:</strong>";echo $VarExportAgente;
                           echo ",<strong>\n\nsegùn el intervalo de fecha de: Incio:</strong>";echo $VarExportInicio; 
                           echo ",<strong>\n\n Hasta:</strong>";echo $VarExportFinalq;   
                     
                      require_once("LlenarTablaDetalle.php");
                       }

            require_once("MsgError.php");   //Llama al php de error de coincidencias
          }
    }
    else{

       $query = "SELECT ot.staff_id,ot.number,ot.created,os.name,concat_ws(' ',osf.firstname,osf.lastname)as nombre,oli.extra,od.dept_name,oht.topic,ots.state
                 FROM ost_ticket ot 
                    left join ost_user os on ot.user_id=os.id 
                    left join ost_staff osf on ot.staff_id=osf.staff_id
                    left join ost_department od on ot.dept_id=od.dept_id 
                    left join ost_ticket__cdata otd on ot.ticket_id=otd.ticket_id
                    left join ost_list_items oli on otd.departamento = oli.id 
                    left join ost_help_topic oht on ot.topic_id=oht.topic_id
                    left join ost_ticket_status ots on ot.status_id= ots.id
                     where (ot.created BETWEEN '$VarExportInicio ' and ' $VarExportFinalq') and oht.topic ='$VarExport' and ots.state='open' and (concat_ws(' ',osf.firstname,osf.lastname)='$VarExportAgente')
                     order by ot.created desc ";
        
                $resultado = mysqli_query( $conexion, $query );//variable resultada para almacenar el arreglo de la informacion tomando encuenta la conexion de la DB y el query requerido
                     
                  $VarFilas=0;  
                  if ($resultado->num_rows>=1)// decicion que evalua el numero de registro afectados por el query en caso de ser verdadero imprime la tabla si no llamda a llamar un mensaje de error
                     {         
                      foreach ($resultado as $clave => $key) 
                           { //foreach para mostrar los terminos de búsqueda principal
                               $VarFilas++;                          
                           }
                           echo "<strong>\n\nNº de Tickets:</strong>"; echo $VarFilas;  
                           echo ",<strong>\n\nDepartamento Destino:</strong>"; echo $VarExport;
                           echo ",<strong>\n\nAgente Asignado:</strong>";echo $VarExportAgente;
                           echo ",<strong>\n\nsegùn el intervalo de fecha de: Incio:</strong>";echo $VarExportInicio; 
                           echo ",<strong>\n\n Hasta:</strong>";echo $VarExportFinalq;   
                     
                      require_once("LlenarTablaDetalle.php");
                       }
    }




}
else{

if(isset($_POST['btnbuscar']))
    { //Variable que guarda la informaciòn de la caja de texto a buscar
        $Varnombre = $_POST['input_2'];
    // Query requerido para la bùsqueda por la caja de texto para los detalles
           $query = "SELECT ot.staff_id,ot.number,ot.created,os.name,concat_ws(' ',osf.firstname,osf.lastname)as nombre,oli.extra,od.dept_name,oht.topic,ots.state
                 FROM ost_ticket ot 
                    left join ost_user os on ot.user_id=os.id 
                    left join ost_staff osf on ot.staff_id=osf.staff_id
                    left join ost_department od on ot.dept_id=od.dept_id 
                    left join ost_ticket__cdata otd on ot.ticket_id=otd.ticket_id
                    left join ost_list_items oli on otd.departamento = oli.id 
                    left join ost_help_topic oht on ot.topic_id=oht.topic_id
                    left join ost_ticket_status ots on ot.status_id= ots.id
                     where oht.topic='$VarExport' and ots.state='open' and (concat_ws(' ',osf.firstname,osf.lastname)='$VarExportAgente') and( od.dept_name like '%$Varnombre%' or oli.extra like '%$Varnombre%' or os.name like '%$Varnombre%' or ot.number like '%$Varnombre%' )
                     order by ot.created desc ";
        
                $resultado = mysqli_query( $conexion, $query );//variable resultada para almacenar el arreglo de la informacion tomando encuenta la conexion de la DB y el query requerido
                     
                  $VarFilas=0;  
                  if ($resultado->num_rows>=1)// decicion que evalua el numero de registro afectados por el query en caso de ser verdadero imprime la tabla si no llamda a llamar un mensaje de error
                     {         
                      foreach ($resultado as $clave => $key) 
                           { //foreach para mostrar los terminos de búsqueda principal
                               $VarFilas++;                          
                           }
                           echo "<strong>\n\nNº de Tickets:</strong>"; echo $VarFilas;  
                           echo ",<strong>\n\nDepartamento Destino:</strong>"; echo $VarExport;
                           echo ",<strong>\n\nAgente Asignado:</strong>";echo $VarExportAgente; 
                           echo ",<strong>\n\nBùsqueda por:</strong>";echo $Varnombre;
                      require_once("LlenarTablaDetalle.php");
                       }  
                        else{

                 $query = "SELECT ot.staff_id,ot.number,ot.created,os.name,concat_ws(' ',osf.firstname,osf.lastname)as nombre,oli.extra,od.dept_name,oht.topic,ots.state
                 FROM ost_ticket ot 
                    left join ost_user os on ot.user_id=os.id 
                    left join ost_staff osf on ot.staff_id=osf.staff_id
                    left join ost_department od on ot.dept_id=od.dept_id 
                    left join ost_ticket__cdata otd on ot.ticket_id=otd.ticket_id
                    left join ost_list_items oli on otd.departamento = oli.id 
                    left join ost_help_topic oht on ot.topic_id=oht.topic_id
                    left join ost_ticket_status ots on ot.status_id= ots.id
                     where oht.topic ='$VarExport' and ots.state='open' and (concat_ws(' ',osf.firstname,osf.lastname)='$VarExportAgente')
                     order by ot.created desc ";
        
                $resultado = mysqli_query( $conexion, $query );//variable resultada para almacenar el arreglo de la informacion tomando encuenta la conexion de la DB y el query requerido
                     
                  $VarFilas=0;  
                  if ($resultado->num_rows>=1)// decicion que evalua el numero de registro afectados por el query en caso de ser verdadero imprime la tabla si no llamda a llamar un mensaje de error
                     {         
                      foreach ($resultado as $clave => $key) 
                           { //foreach para mostrar los terminos de búsqueda principal
                               $VarFilas++;                          
                           }
                           echo "<strong>\n\nNº de Tickets:</strong>"; echo $VarFilas;  
                           echo ",<strong>\n\nDepartamento Destino:</strong>"; echo $VarExport;
                           echo ",<strong>\n\nAgente Asignado:</strong>";echo $VarExportAgente; 
                     
                      require_once("LlenarTablaDetalle.php");
                       }

            require_once("MsgError.php");   //Llama al php de error de coincidencias
          }
    }
    else{

       $query = "SELECT ot.staff_id,ot.number,ot.created,os.name,concat_ws(' ',osf.firstname,osf.lastname)as nombre,oli.extra,od.dept_name,oht.topic,ots.state
                 FROM ost_ticket ot 
                    left join ost_user os on ot.user_id=os.id 
                    left join ost_staff osf on ot.staff_id=osf.staff_id
                    left join ost_department od on ot.dept_id=od.dept_id 
                    left join ost_ticket__cdata otd on ot.ticket_id=otd.ticket_id
                    left join ost_list_items oli on otd.departamento = oli.id 
                    left join ost_help_topic oht on ot.topic_id=oht.topic_id
                    left join ost_ticket_status ots on ot.status_id= ots.id
                     where oht.topic ='$VarExport' and ots.state='open' and (concat_ws(' ',osf.firstname,osf.lastname)='$VarExportAgente')
                     order by ot.created desc ";
        
                $resultado = mysqli_query( $conexion, $query );//variable resultada para almacenar el arreglo de la informacion tomando encuenta la conexion de la DB y el query requerido
                     
                  $VarFilas=0;  
                  if ($resultado->num_rows>=1)// decicion que evalua el numero de registro afectados por el query en caso de ser verdadero imprime la tabla si no llamda a llamar un mensaje de error
                     {         
                      foreach ($resultado as $clave => $key) 
                           { //foreach para mostrar los terminos de búsqueda principal
                               $VarFilas++;                          
                           }
                           echo "<strong>\n\nNº de Tickets:</strong>"; echo $VarFilas;  
                           echo ",<strong>\n\nDepartamento Destino:</strong>"; echo $VarExport;
                           echo ",<strong>\n\nAgente Asignado:</strong>";echo $VarExportAgente; 
                     
                      require_once("LlenarTablaDetalle.php");
                       }
    }


}

       
?>