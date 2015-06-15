
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
//Asigancion de las cookies de la Fecha de Búsqueda
 $VarExportInicio =  $_COOKIE["VarCookieInicio"];
 $VarExportFinalq =  $_COOKIE["VarCookieFinalq"];


if(isset($_POST['btnbuscar']))
    {
//Validación requeridad para indicar que los campos de fechas de búsqueda esten llenos
     if( $VarExportInicio!=0 and $VarExportFinalq!=0)
     {
//Variable que guarda la informaciòn de la caja de texto a buscar
       $Varnombre = $_POST['input_2'];
       
//Query requerido para indicar el id de cada uno de los departamentos de destinos
      $query="SELECT dept_id  from ost_department  where dept_name = '$VarExport'";
                 $resultado=mysqli_query($conexion, $query);

                $VarIdDept=0;
//Foreach que indica la asignación del id del departamento a una variable
                  foreach ($resultado as $clave => $key) 
                          {  
                                    $VarIdDept= $key['dept_id'];
                          }

 //Query requerido la búsqueda de los tickets por el departamento seleccionado por intervalos de fechas         
 $query = "SELECT ot.number,ot.created,os.name,concat_ws(' ',osf.firstname,osf.lastname)as nombre,oli.extra,od.dept_name,oht.topic,ots.state
                FROM ost_ticket ot 
                            left join ost_user os on ot.user_id=os.id 
                            left join ost_staff osf on ot.staff_id=osf.staff_id
                            left join ost_department od on ot.dept_id=od.dept_id 
                            left join ost_ticket__cdata otd on ot.ticket_id=otd.ticket_id
                            left join ost_list_items oli on otd.departamento = oli.id 
                            left join ost_help_topic oht on ot.topic_id=oht.topic_id
                            left join ost_ticket_status ots on ot.status_id= ots.id
                            where (ot.created BETWEEN ' $VarExportInicio' and ' $VarExportFinalq') and od.dept_id ='$VarIdDept' and (ot.number like '%$Varnombre%' or os.name like '%$Varnombre%' or concat_ws(' ',osf.firstname,osf.lastname)like '%$Varnombre%' or oli.extra like '%$Varnombre%'  or oht.topic like '%$Varnombre%' or ots.state like '%$Varnombre%') 
                             order by ot.created desc ";

                 $resultado = mysqli_query( $conexion, $query );//variable resultada para almacenar el arreglo de la informacion tomando encuenta la conexion de la DB y el query requerido
 //validación que indicada que muestre los ticketes que se an encontrado                                    
                   if ($resultado->num_rows>=1)// decicion que evalua el numero de registro afectados por el query en caso de ser verdadero imprime la tabla si no llamda a llamar un mensaje de error
                       {  //foreach para imprimir los terminos de busqueda y el numero de tickets encontrado 
                          foreach ($resultado as $clave => $key) 
                           { 
                               $VarFilas++;                          
                           }
                           echo "<strong>\n\nNº de Tickets:</strong>"; echo $VarFilas;
                           echo "<strong>\n\n,Fecha Inicio:</strong>"; echo $VarExportInicio;
                           echo "<strong>\n\n,Fecha Final:</strong>"; echo $VarExportFinalq;
                            echo "<strong>\n\n,Busqueda por:</strong>"; echo $Varnombre;
                                 
                              require_once("LlenarTablaDetalle.php");
                        }
 
                       else
                          {
    //Llamado del mensaje de alerta cuando no se encuentran resistros de tickets
                            require_once("MsgError.php");
   //query requerido la el llenado de tabla  si no se encontraron reguistros en la búsqueda                        
                         $query = "SELECT ot.number,ot.created,os.name,concat_ws(' ',osf.firstname,osf.lastname)as nombre,oli.extra,od.dept_name,oht.topic,ots.state
                           FROM ost_ticket ot 
                                left join ost_user os on ot.user_id=os.id 
                                left join ost_staff osf on ot.staff_id=osf.staff_id
                                left join ost_department od on ot.dept_id=od.dept_id 
                                left join ost_ticket__cdata otd on ot.ticket_id=otd.ticket_id
                                left join ost_list_items oli on otd.departamento = oli.id 
                                left join ost_help_topic oht on ot.topic_id=oht.topic_id
                                left join ost_ticket_status ots on ot.status_id= ots.id
                                where (ot.created BETWEEN ' $VarExportInicio' and ' $VarExportFinalq') and od.dept_id ='$VarIdDept'
                                 order by ot.created desc ";
                
                        $resultado = mysqli_query( $conexion, $query );//variable resultada para almacenar el arreglo de la informacion tomando encuenta la conexion de la DB y el query requerido
                                      
                          if ($resultado->num_rows>=1)// decicion que evalua el numero de registro afectados por el query en caso de ser verdadero imprime la tabla si no llamda a llamar un mensaje de error
                             {  //foreach para imprimir los terminos de busqueda y el numero de tickets encontrado 
                         
                               foreach ($resultado as $clave => $key) 
                               { 
                               $VarFilas++;                          
                                }
                           echo "<strong>\n\nNº de Tickets:</strong>"; echo $VarFilas;
                           echo "<strong>\n\n,Fecha Inicio:</strong>"; echo $VarExportInicio;
                           echo "<strong>\n\n,Fecha Final:</strong>"; echo $VarExportFinalq;
                                    
                              require_once("LlenarTablaDetalle.php");
                          }

                          }
        }
        else{
  $Varnombre = $_POST['input_2'];

//query requerido para la búsqueda del departamento seleccionado en la grafica
      $query="SELECT dept_id  from ost_department  where dept_name = '$VarExport'";
                 $resultado=mysqli_query($conexion, $query);

                $VarIdDept=0;
                  foreach ($resultado as $clave => $key) 
                          {  // asignación de la variables del id a una variable
                                    $VarIdDept= $key['dept_id'];
                          }

 //Query requerido la búsqueda de los tickets por el departamento seleccionado por intervalos de fechas         
         
 $query = "SELECT ot.number,ot.created,os.name,concat_ws(' ',osf.firstname,osf.lastname)as nombre,oli.extra,od.dept_name,oht.topic,ots.state
                FROM ost_ticket ot 
                            left join ost_user os on ot.user_id=os.id 
                            left join ost_staff osf on ot.staff_id=osf.staff_id
                            left join ost_department od on ot.dept_id=od.dept_id 
                            left join ost_ticket__cdata otd on ot.ticket_id=otd.ticket_id
                            left join ost_list_items oli on otd.departamento = oli.id 
                            left join ost_help_topic oht on ot.topic_id=oht.topic_id
                            left join ost_ticket_status ots on ot.status_id= ots.id
                            where  od.dept_id ='$VarIdDept' and (ot.number like '%$Varnombre%' or os.name like '%$Varnombre%' or concat_ws(' ',osf.firstname,osf.lastname)like '%$Varnombre%' or oli.extra like '%$Varnombre%'  or oht.topic like '%$Varnombre%' or ots.state like '%$Varnombre%') 
                             order by ot.created desc ";

                 $resultado = mysqli_query( $conexion, $query );//variable resultada para almacenar el arreglo de la informacion tomando encuenta la conexion de la DB y el query requerido
                               
                                   
                   if ($resultado->num_rows>=1)// decicion que evalua el numero de registro afectados por el query en caso de ser verdadero imprime la tabla si no llamda a llamar un mensaje de error
                       {     //foreach para imprimir los terminos de busqueda y el numero de tickets encontrado 
                              
                        foreach ($resultado as $clave => $key) 
                           { 
                               $VarFilas++;                          
                           }
                           echo "<strong>\n\nNº de Tickets:</strong>"; echo $VarFilas;
                           echo "<strong>\n\n,Busqueda por:</strong>"; echo $Varnombre;
                             
                              require_once("LlenarTablaDetalle.php");
                        }
 
                       else
                          {
     //Llamado del mensaje de alerta cuando no se encuentran resistros de tickets
                            require_once("MsgError.php");
   //query requerido la el llenado de tabla  si no se encontraron reguistros en la búsqueda                        
                                                                    
                         $query = "SELECT ot.number,ot.created,os.name,concat_ws(' ',osf.firstname,osf.lastname)as nombre,oli.extra,od.dept_name,oht.topic,ots.state
                           FROM ost_ticket ot 
                                left join ost_user os on ot.user_id=os.id 
                                left join ost_staff osf on ot.staff_id=osf.staff_id
                                left join ost_department od on ot.dept_id=od.dept_id 
                                left join ost_ticket__cdata otd on ot.ticket_id=otd.ticket_id
                                left join ost_list_items oli on otd.departamento = oli.id 
                                left join ost_help_topic oht on ot.topic_id=oht.topic_id
                                left join ost_ticket_status ots on ot.status_id= ots.id
                                where  od.dept_id ='$VarIdDept'
                                 order by ot.created desc ";
                
                        $resultado = mysqli_query( $conexion, $query );//variable resultada para almacenar el arreglo de la informacion tomando encuenta la conexion de la DB y el query requerido
                                    
                          if ($resultado->num_rows>=1)// decicion que evalua el numero de registro afectados por el query en caso de ser verdadero imprime la tabla si no llamda a llamar un mensaje de error
                             {     //foreach para imprimir los terminos de busqueda y el numero de tickets encontrado 
                              
                              foreach ($resultado as $clave => $key) 
                           { 
                               $VarFilas++;                          
                           }
                           echo "<strong>\n\nNº de Tickets:</strong>"; echo $VarFilas;   
                           
                              require_once("LlenarTablaDetalle.php");
                          }

                     }

        }

    }

    //Validacion para retornar los valores sin ningún filtro en la tabla de los tickets de los departamento

   elseif(isset($_POST['btnResul']))
    {//validación para indicar que los campos de fechas esten llenos
       if( $VarExportInicio!=0 and $VarExportFinalq!=0)
     {//query requerido para asigancion del id a una varible
      
      $query="SELECT dept_id  from ost_department  where dept_name = '$VarExport'";
                 $resultado=mysqli_query($conexion, $query);

                $VarIdDept=0;
                  foreach ($resultado as $clave => $key) 
                          {  
                                    $VarIdDept= $key['dept_id'];
                          }
     // query requerido para la búsqueda de los tickets por los valores anteriores
       $query = "SELECT ot.number,ot.created,os.name,concat_ws(' ',osf.firstname,osf.lastname)as nombre,oli.extra,od.dept_name,oht.topic,ots.state
                           FROM ost_ticket ot 
                                left join ost_user os on ot.user_id=os.id 
                                left join ost_staff osf on ot.staff_id=osf.staff_id
                                left join ost_department od on ot.dept_id=od.dept_id 
                                left join ost_ticket__cdata otd on ot.ticket_id=otd.ticket_id
                                left join ost_list_items oli on otd.departamento = oli.id 
                                left join ost_help_topic oht on ot.topic_id=oht.topic_id
                                left join ost_ticket_status ots on ot.status_id= ots.id
                                where (ot.created BETWEEN ' $VarExportInicio' and ' $VarExportFinalq') and od.dept_id ='$VarIdDept'
                                 order by ot.created desc ";
                
                        $resultado = mysqli_query( $conexion, $query );//variable resultada para almacenar el arreglo de la informacion tomando encuenta la conexion de la DB y el query requerido
                                   
                              
                          if ($resultado->num_rows>=1)// decicion que evalua el numero de registro afectados por el query en caso de ser verdadero imprime la tabla si no llamda a llamar un mensaje de error
                             {  //foreach para mostrar el total de los tickets encontrados y nostrar los terminos d búsqueda

                                foreach ($resultado as $clave => $key) 
                           { 
                               $VarFilas++;                          
                           }
                           echo "<strong>\n\nNº de Tickets:</strong>"; echo $VarFilas;
                           echo "<strong>\n\n,Fecha Inicio:</strong>"; echo $VarExportInicio;
                           echo "<strong>\n\n,Fecha Final:</strong>"; echo $VarExportFinalq;
      
                              require_once("LlenarTablaDetalle.php");
                          }
                    }
                    else{
//query requerido para la búsqueda del id selccionado anteriormente y asignacion de la varibale

                       $query="SELECT dept_id  from ost_department  where dept_name = '$VarExport'";
                 $resultado=mysqli_query($conexion, $query);

                $VarIdDept=0;
                  foreach ($resultado as $clave => $key) 
                          {  
                                    $VarIdDept= $key['dept_id'];
                          }
       $query = "SELECT ot.number,ot.created,os.name,concat_ws(' ',osf.firstname,osf.lastname)as nombre,oli.extra,od.dept_name,oht.topic,ots.state
                           FROM ost_ticket ot 
                                left join ost_user os on ot.user_id=os.id 
                                left join ost_staff osf on ot.staff_id=osf.staff_id
                                left join ost_department od on ot.dept_id=od.dept_id 
                                left join ost_ticket__cdata otd on ot.ticket_id=otd.ticket_id
                                left join ost_list_items oli on otd.departamento = oli.id 
                                left join ost_help_topic oht on ot.topic_id=oht.topic_id
                                left join ost_ticket_status ots on ot.status_id= ots.id
                                where  od.dept_id ='$VarIdDept'
                                 order by ot.created desc ";
                
                        $resultado = mysqli_query( $conexion, $query );//variable resultada para almacenar el arreglo de la informacion tomando encuenta la conexion de la DB y el query requerido
                                 
                          if ($resultado->num_rows>=1)// decicion que evalua el numero de registro afectados por el query en caso de ser verdadero imprime la tabla si no llamda a llamar un mensaje de error
                             {  foreach ($resultado as $clave => $key) 
                           { 
                               $VarFilas++;                          
                           }
                           echo "<strong>\n\nNº de Tickets:</strong>"; echo $VarFilas;   
                                     
                              require_once("LlenarTablaDetalle.php");
                          }
                    }
       } 

//validacíon para indicar que esten llenos los campos de fecha
   elseif($VarExportInicio!=0 and  $VarExportFinalq!=0)
            {// query para la asignacion de la id a una variable

         $query="SELECT dept_id  from ost_department  where dept_name = '$VarExport'";
                         $resultado=mysqli_query($conexion, $query);

                $VarIdDept=0;
                  foreach ($resultado as $clave => $key) 
                                {  
                                    $VarIdDept= $key['dept_id'];
                            }

            $query = "SELECT ot.number,ot.created,os.name,concat_ws(' ',osf.firstname,osf.lastname)as nombre,oli.extra,od.dept_name,oht.topic,ots.state
                         FROM ost_ticket ot 
                            left join ost_user os on ot.user_id=os.id 
                            left join ost_staff osf on ot.staff_id=osf.staff_id
                            left join ost_department od on ot.dept_id=od.dept_id 
                            left join ost_ticket__cdata otd on ot.ticket_id=otd.ticket_id
                            left join ost_list_items oli on otd.departamento = oli.id 
                            left join ost_help_topic oht on ot.topic_id=oht.topic_id
                            left join ost_ticket_status ots on ot.status_id= ots.id
                            where (ot.created BETWEEN ' $VarExportInicio' and ' $VarExportFinalq') and od.dept_id ='$VarIdDept'
                             order by ot.created desc ";
                
                        $resultado = mysqli_query( $conexion, $query );//variable resultada para almacenar el arreglo de la informacion tomando encuenta la conexion de la DB y el query requerido
                          
                          
                          if ($resultado->num_rows>=1)// decicion que evalua el numero de registro afectados por el query en caso de ser verdadero imprime la tabla si no llamda a llamar un mensaje de error
                             {   // foreach indicando los terminos de búsqueda con el total de los tickets encontrados
                              foreach ($resultado as $clave => $key) 
                           { 
                               $VarFilas++;                          
                           }
                           echo "<strong>\n\nNº de Tickets:</strong>"; echo $VarFilas;
                           echo "<strong>\n\n,Fecha Inicio:</strong>"; echo $VarExportInicio;
                           echo "<strong>\n\n,Fecha Final:</strong>"; echo $VarExportFinalq;
                                 
                              require_once("LlenarTablaDetalle.php");
                          }


          }
      
      else{

//query requerido para la búsqueda de id del departamento seleccionado guardarlos a una variable
           $query="SELECT dept_id  from ost_department  where dept_name = '$VarExport'";
                 $resultado=mysqli_query($conexion, $query);

        $VarIdDept=0;
          foreach ($resultado as $clave => $key) 
                        {  
                            $VarIdDept= $key['dept_id'];
                    }


    $query = "SELECT ot.number,ot.created,os.name,concat_ws(' ',osf.firstname,osf.lastname)as nombre,oli.extra,od.dept_name,oht.topic,ots.state
                 FROM ost_ticket ot 
                    left join ost_user os on ot.user_id=os.id 
                    left join ost_staff osf on ot.staff_id=osf.staff_id
                    left join ost_department od on ot.dept_id=od.dept_id 
                    left join ost_ticket__cdata otd on ot.ticket_id=otd.ticket_id
                    left join ost_list_items oli on otd.departamento = oli.id 
                    left join ost_help_topic oht on ot.topic_id=oht.topic_id
                    left join ost_ticket_status ots on ot.status_id= ots.id
                     where od.dept_id ='$VarIdDept'
                     order by ot.created desc ";
        
                $resultado = mysqli_query( $conexion, $query );//variable resultada para almacenar el arreglo de la informacion tomando encuenta la conexion de la DB y el query requerido
                        
                  if ($resultado->num_rows>=1)// decicion que evalua el numero de registro afectados por el query en caso de ser verdadero imprime la tabla si no llamda a llamar un mensaje de error
                     {   //foreach para mostrar los terminos de búsqueda principal
                      foreach ($resultado as $clave => $key) 
                           { 
                               $VarFilas++;                          
                           }
                           echo "<strong>\n\nNº de Tickets:</strong>"; echo $VarFilas;   
                     
  
                      require_once("LlenarTablaDetalle.php");
                       }   

}



?>

