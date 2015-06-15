
<?php
error_reporting(0);
//inicialización de la variable
$VarExport=0;
$VarFilas=0;
//asignación de la cookies del empleado
$VarExport =  $_COOKIE["VarCookieDestino"];

//inicialización de las variables de fecha
$VarExportFinalq=0;
$VarExportInicio=0;
//asigbación de la cookies de fechas
 $VarExportInicio =  $_COOKIE["VarCookieInicio"];
 $VarExportFinalq =  $_COOKIE["VarCookieFinalq"];




if(isset($_POST['btnbuscar']))
    {
//validacion para indicar que hay un intervalo de fecha para la búsqueda
     if( $VarExportInicio!=0 and $VarExportFinalq!=0)
     {
    //Variable que guarda la informaciòn de la caja de texto a buscar
        $Varnombre = $_POST['input_2'];

//query requerido para la asignación de id a una varibale
      $query="SELECT  staff_id FROM ost_staff where concat_ws(' ',firstname,lastname)='$VarExport'";
                 $resultado=mysqli_query($conexion, $query);

                $VarIdDept=0;
                  foreach ($resultado as $clave => $key) 
                          {  
                                    $VarIdDept= $key['staff_id'];
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
                            where (ot.created BETWEEN ' $VarExportInicio' and ' $VarExportFinalq') and osf.staff_id ='$VarIdDept' and (ot.number like '%$Varnombre%' or os.name like '%$Varnombre%' or od.dept_name like '%$Varnombre%' or oli.extra like '%$Varnombre%'  or oht.topic like '%$Varnombre%' or ots.state like '%$Varnombre%') 
                             order by ot.created desc ";

                 $resultado = mysqli_query( $conexion, $query );//variable resultada para almacenar el arreglo de la informacion tomando encuenta la conexion de la DB y el query requerido
                                        
                   if ($resultado->num_rows>=1)// decicion que evalua el numero de registro afectados por el query en caso de ser verdadero imprime la tabla si no llamda a llamar un mensaje de error
                       {    //foreach para mostar los terminos de búsqueda 
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
    //mensaje para indicar si no hay ningun tickets
                            require_once("MsgError.php");
  // query requerido para mostar los tickets principales sin ningun filtro
                         $query = "SELECT ot.number,ot.created,os.name,concat_ws(' ',osf.firstname,osf.lastname)as nombre,oli.extra,od.dept_name,oht.topic,ots.state
                           FROM ost_ticket ot 
                                left join ost_user os on ot.user_id=os.id 
                                left join ost_staff osf on ot.staff_id=osf.staff_id
                                left join ost_department od on ot.dept_id=od.dept_id 
                                left join ost_ticket__cdata otd on ot.ticket_id=otd.ticket_id
                                left join ost_list_items oli on otd.departamento = oli.id 
                                left join ost_help_topic oht on ot.topic_id=oht.topic_id
                                left join ost_ticket_status ots on ot.status_id= ots.id
                                where (ot.created BETWEEN ' $VarExportInicio' and ' $VarExportFinalq') and osf.staff_id ='$VarIdDept'
                                 order by ot.created desc ";
                
                        $resultado = mysqli_query( $conexion, $query );//variable resultada para almacenar el arreglo de la informacion tomando encuenta la conexion de la DB y el query requerido
                                        
                          if ($resultado->num_rows>=1)// decicion que evalua el numero de registro afectados por el query en caso de ser verdadero imprime la tabla si no llamda a llamar un mensaje de error
                             {  //foreach para mostar los terminos de búsqueda     
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
  //asignación de la variable de caja de busqueda
  $Varnombre = $_POST['input_2'];
//query 

      $query="SELECT  staff_id FROM ost_staff where concat_ws(' ',firstname,lastname)='$VarExport'";
                 $resultado=mysqli_query($conexion, $query);

                $VarIdDept=0;
                  foreach ($resultado as $clave => $key) 
                          {  
                                    $VarIdDept= $key['staff_id'];
                          }

 //query indicado para mostar todos los tickes encontrados segun termino de busqueda         
 $query = "SELECT ot.number,ot.created,os.name,concat_ws(' ',osf.firstname,osf.lastname)as nombre,oli.extra,od.dept_name,oht.topic,ots.state
                FROM ost_ticket ot 
                            left join ost_user os on ot.user_id=os.id 
                            left join ost_staff osf on ot.staff_id=osf.staff_id
                            left join ost_department od on ot.dept_id=od.dept_id 
                            left join ost_ticket__cdata otd on ot.ticket_id=otd.ticket_id
                            left join ost_list_items oli on otd.departamento = oli.id 
                            left join ost_help_topic oht on ot.topic_id=oht.topic_id
                            left join ost_ticket_status ots on ot.status_id= ots.id
                            where  osf.staff_id ='$VarIdDept' and (ot.number like '%$Varnombre%' or os.name like '%$Varnombre%' or od.dept_name like '%$Varnombre%' or oli.extra like '%$Varnombre%'  or oht.topic like '%$Varnombre%' or ots.state like '%$Varnombre%') 
                             order by ot.created desc ";

                 $resultado = mysqli_query( $conexion, $query );//variable resultada para almacenar el arreglo de la informacion tomando encuenta la conexion de la DB y el query requerido
                                        
                   if ($resultado->num_rows>=1)// decicion que evalua el numero de registro afectados por el query en caso de ser verdadero imprime la tabla si no llamda a llamar un mensaje de error
                       {        //foreach para mostrar los terminos de busqueda
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
          //mensaje de error sino hay tickets ningun tickets encontrado en la busqueda
                            require_once("MsgError.php");
          //query para mostar los tickets principales según sin ningún filtro
                         $query = "SELECT ot.number,ot.created,os.name,concat_ws(' ',osf.firstname,osf.lastname)as nombre,oli.extra,od.dept_name,oht.topic,ots.state
                           FROM ost_ticket ot 
                                left join ost_user os on ot.user_id=os.id 
                                left join ost_staff osf on ot.staff_id=osf.staff_id
                                left join ost_department od on ot.dept_id=od.dept_id 
                                left join ost_ticket__cdata otd on ot.ticket_id=otd.ticket_id
                                left join ost_list_items oli on otd.departamento = oli.id 
                                left join ost_help_topic oht on ot.topic_id=oht.topic_id
                                left join ost_ticket_status ots on ot.status_id= ots.id
                                where  osf.staff_id ='$VarIdDept'
                                 order by ot.created desc ";
                
                        $resultado = mysqli_query( $conexion, $query );//variable resultada para almacenar el arreglo de la informacion tomando encuenta la conexion de la DB y el query requerido
                                        
                          if ($resultado->num_rows>=1)// decicion que evalua el numero de registro afectados por el query en caso de ser verdadero imprime la tabla si no llamda a llamar un mensaje de error
                             {    //foreach para mostar los terminos de búsqueda
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
//validación para retornar los valores de la búsqueda
   elseif(isset($_POST['btnResul']))
    {//validación para indicar los fechas de búsqueda que esten llenas
       if( $VarExportInicio!=0 and $VarExportFinalq!=0)
     {
//query requerido para la asignación de id a una varibale
      $query="SELECT  staff_id FROM ost_staff where concat_ws(' ',firstname,lastname)='$VarExport'";
                 $resultado=mysqli_query($conexion, $query);

                $VarIdDept=0;
                  foreach ($resultado as $clave => $key) 
                          {  
                                    $VarIdDept= $key['staff_id'];
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
                                where (ot.created BETWEEN ' $VarExportInicio' and ' $VarExportFinalq') and osf.staff_id ='$VarIdDept'
                                 order by ot.created desc ";
                
                        $resultado = mysqli_query( $conexion, $query );//variable resultada para almacenar el arreglo de la informacion tomando encuenta la conexion de la DB y el query requerido
                                        
                          if ($resultado->num_rows>=1)// decicion que evalua el numero de registro afectados por el query en caso de ser verdadero imprime la tabla si no llamda a llamar un mensaje de error
                             {   //foreach para mostar los terminos de búsqueda
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

//query requerido para mostar los tickets sin ningun fecha de busqueda
                       $query="SELECT  staff_id FROM ost_staff where concat_ws(' ',firstname,lastname)='$VarExport'";
                 $resultado=mysqli_query($conexion, $query);

                $VarIdDept=0;
                  foreach ($resultado as $clave => $key) 
                          {  
                                    $VarIdDept= $key['staff_id'];
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
                                where  osf.staff_id ='$VarIdDept'
                                 order by ot.created desc ";
                
                        $resultado = mysqli_query( $conexion, $query );//variable resultada para almacenar el arreglo de la informacion tomando encuenta la conexion de la DB y el query requerido
                                        
                          if ($resultado->num_rows>=1)// decicion que evalua el numero de registro afectados por el query en caso de ser verdadero imprime la tabla si no llamda a llamar un mensaje de error
                             {  //foreach para mostar los terminos de busqueda
                              foreach ($resultado as $clave => $key) 
                           { 
                               $VarFilas++;                          
                           }
                           echo "<strong>\n\nNº de Tickets:</strong>"; echo $VarFilas;   
                                        
                              require_once("LlenarTablaDetalle.php");
                          }
                    }
       } 

//validacióm para indicar si los terminos fecha asido asignada
   elseif($VarExportInicio!=0 and  $VarExportFinalq!=0)
            {
//query indicado para asignar el id a una varible y mostar los resultados
         $query="SELECT  staff_id FROM ost_staff where concat_ws(' ',firstname,lastname)='$VarExport'";
                         $resultado=mysqli_query($conexion, $query);

                $VarIdDept=0;
                  foreach ($resultado as $clave => $key) 
                                {  
                                    $VarIdDept= $key['staff_id'];
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
                            where (ot.created BETWEEN ' $VarExportInicio' and ' $VarExportFinalq') and osf.staff_id ='$VarIdDept'
                             order by ot.created desc ";
                
                        $resultado = mysqli_query( $conexion, $query );//variable resultada para almacenar el arreglo de la informacion tomando encuenta la conexion de la DB y el query requerido
                          
                         
                          
                          if ($resultado->num_rows>=1)// decicion que evalua el numero de registro afectados por el query en caso de ser verdadero imprime la tabla si no llamda a llamar un mensaje de error
                             {    //foreach para mostar los termnos de busqueda
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

//query para  la asignacion del id a una variable  y mostar los tickets principal
           $query="SELECT  staff_id FROM ost_staff where concat_ws(' ',firstname,lastname)='$VarExport'";
                 $resultado=mysqli_query($conexion, $query);

        $VarIdDept=0;
          foreach ($resultado as $clave => $key) 
                        {  
                            $VarIdDept= $key['staff_id'];
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
                     where osf.staff_id ='$VarIdDept'
                     order by ot.created desc ";
        
                $resultado = mysqli_query( $conexion, $query );//variable resultada para almacenar el arreglo de la informacion tomando encuenta la conexion de la DB y el query requerido
                           
                    
                  if ($resultado->num_rows>=1)// decicion que evalua el numero de registro afectados por el query en caso de ser verdadero imprime la tabla si no llamda a llamar un mensaje de error
                     {     //foreach para mostar los termimos de busqueda
                       foreach ($resultado as $clave => $key) 
                           { 
                               $VarFilas++;                          
                           }
                           echo "<strong>\n\nNº de Tickets:</strong>"; echo $VarFilas;   
                          
                      require_once("LlenarTablaDetalle.php");
                       }
                   
                      

}

?>

