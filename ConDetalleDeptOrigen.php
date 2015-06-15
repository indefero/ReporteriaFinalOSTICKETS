
<?php
error_reporting(0);
//inicializacion de la varible
$VarExport=0;
$VarFilas=0;
//asignacion de la cokies del de partamento de origen a una variabel
$VarExport =  $_COOKIE["VarCookie"];

//inicializacion de la varibale
$VarExportFinalq=0;
$VarExportInicio=0;
//asignación de la cookies de la fechas a una varible
 $VarExportInicio =  $_COOKIE["VarCookieInicio"];
 $VarExportFinalq =  $_COOKIE["VarCookieFinalq"];




if(isset($_POST['btnbuscar']))
    {

     if( $VarExportInicio!=0 and $VarExportFinalq!=0)
     {
    //Variable que guarda la informaciòn de la caja de texto a buscar
        $Varnombre = $_POST['input_2'];

//query requerido para asignar el id a una varible 
      $query="SELECT id from ost_list_items where extra = '$VarExport'";
                 $resultado=mysqli_query($conexion, $query);

                $VarIdDept=0;
                  foreach ($resultado as $clave => $key) 
                          {  
                                    $VarIdDept= $key['id'];
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
                            where (ot.created BETWEEN ' $VarExportInicio' and ' $VarExportFinalq') and oli.id ='$VarIdDept' and (ot.number like '%$Varnombre%' or os.name like '%$Varnombre%' or concat_ws(' ',osf.firstname,osf.lastname)like '%$Varnombre%' or od.dept_name like '%$Varnombre%'  or oht.topic like '%$Varnombre%' or ots.state like '%$Varnombre%') 
                             order by ot.created desc ";

                 $resultado = mysqli_query( $conexion, $query );//variable resultada para almacenar el arreglo de la informacion tomando encuenta la conexion de la DB y el query requerido
                                        
                   if ($resultado->num_rows>=1)// decicion que evalua el numero de registro afectados por el query en caso de ser verdadero imprime la tabla si no llamda a llamar un mensaje de error
                       {       //foreach para mostar los terminos de búsqueda  
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
  //llamado del mensaje de alerta cuando no se encuetrar ningun tickets
                            require_once("MsgError.php");
  //query requerido para mostar los tickets principales sin ningun termino de búsqueda
                         $query = "SELECT ot.number,ot.created,os.name,concat_ws(' ',osf.firstname,osf.lastname)as nombre,oli.extra,od.dept_name,oht.topic,ots.state
                           FROM ost_ticket ot 
                                left join ost_user os on ot.user_id=os.id 
                                left join ost_staff osf on ot.staff_id=osf.staff_id
                                left join ost_department od on ot.dept_id=od.dept_id 
                                left join ost_ticket__cdata otd on ot.ticket_id=otd.ticket_id
                                left join ost_list_items oli on otd.departamento = oli.id 
                                left join ost_help_topic oht on ot.topic_id=oht.topic_id
                                left join ost_ticket_status ots on ot.status_id= ots.id
                                where (ot.created BETWEEN ' $VarExportInicio' and ' $VarExportFinalq') and oli.id ='$VarIdDept'
                                 order by ot.created desc ";
                
                        $resultado = mysqli_query( $conexion, $query );//variable resultada para almacenar el arreglo de la informacion tomando encuenta la conexion de la DB y el query requerido
                                        
                          if ($resultado->num_rows>=1)// decicion que evalua el numero de registro afectados por el query en caso de ser verdadero imprime la tabla si no llamda a llamar un mensaje de error
                             {    //foreach  para mostar los termimos de búsqueda
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
        }else{
//asignación de la caja de búsqueda a una variable
  $Varnombre = $_POST['input_2'];

//query para la asignación  de id a una variable
      $query="SELECT id from ost_list_items where extra = '$VarExport'";
                 $resultado=mysqli_query($conexion, $query);

                $VarIdDept=0;
                  foreach ($resultado as $clave => $key) 
                          {  
                                    $VarIdDept= $key['id'];
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
                            where  oli.id ='$VarIdDept' and (ot.number like '%$Varnombre%' or os.name like '%$Varnombre%' or concat_ws(' ',osf.firstname,osf.lastname)like '%$Varnombre%' or od.dept_name like '%$Varnombre%'  or oht.topic like '%$Varnombre%' or ots.state like '%$Varnombre%') 
                             order by ot.created desc ";

                 $resultado = mysqli_query( $conexion, $query );//variable resultada para almacenar el arreglo de la informacion tomando encuenta la conexion de la DB y el query requerido
                                        
                   if ($resultado->num_rows>=1)// decicion que evalua el numero de registro afectados por el query en caso de ser verdadero imprime la tabla si no llamda a llamar un mensaje de error
                       {     //foreach indicado para mostrar los terminos de busqueda    
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
    //llamado de un mensaje de alertar se a encontrado algún tickets
                            require_once("MsgError.php");
  //query para mostrar los tickets sin ningun termino de búsqued 
                         $query = "SELECT ot.number,ot.created,os.name,concat_ws(' ',osf.firstname,osf.lastname)as nombre,oli.extra,od.dept_name,oht.topic,ots.state
                           FROM ost_ticket ot 
                                left join ost_user os on ot.user_id=os.id 
                                left join ost_staff osf on ot.staff_id=osf.staff_id
                                left join ost_department od on ot.dept_id=od.dept_id 
                                left join ost_ticket__cdata otd on ot.ticket_id=otd.ticket_id
                                left join ost_list_items oli on otd.departamento = oli.id 
                                left join ost_help_topic oht on ot.topic_id=oht.topic_id
                                left join ost_ticket_status ots on ot.status_id= ots.id
                                where  oli.id ='$VarIdDept'
                                 order by ot.created desc ";
                
                        $resultado = mysqli_query( $conexion, $query );//variable resultada para almacenar el arreglo de la informacion tomando encuenta la conexion de la DB y el query requerido
                                        
                          if ($resultado->num_rows>=1)// decicion que evalua el numero de registro afectados por el query en caso de ser verdadero imprime la tabla si no llamda a llamar un mensaje de error
                             {  //foreach para mostrar los terminos de búsqueda
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
//validación para retornar los valore de tabla detalle sin ningun filtro de búsqueda
   elseif(isset($_POST['btnResul']))
    {
       if( $VarExportInicio!=0 and $VarExportFinalq!=0)
     {//query requerido para la asignacion de id del departamento  a una variable cuando hay fechas de busqueda
      
      $query="SELECT id from ost_list_items where extra = '$VarExport'";
                 $resultado=mysqli_query($conexion, $query);

                $VarIdDept=0;
                  foreach ($resultado as $clave => $key) 
                          {  
                                    $VarIdDept= $key['id'];
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
                                where (ot.created BETWEEN ' $VarExportInicio' and ' $VarExportFinalq') and oli.id ='$VarIdDept'
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
                    else{

//query requerido para asignado el id a una variable si no hay fechas de búsqueda
                       $query="SELECT id from ost_list_items where extra = '$VarExport'";
                 $resultado=mysqli_query($conexion, $query);

                $VarIdDept=0;
                  foreach ($resultado as $clave => $key) 
                          {  
                                    $VarIdDept= $key['id'];
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
                                where  oli.id ='$VarIdDept'
                                 order by ot.created desc ";
                
                        $resultado = mysqli_query( $conexion, $query );//variable resultada para almacenar el arreglo de la informacion tomando encuenta la conexion de la DB y el query requerido
                                        
                          if ($resultado->num_rows>=1)// decicion que evalua el numero de registro afectados por el query en caso de ser verdadero imprime la tabla si no llamda a llamar un mensaje de error
                             {   //foreach indicando para mostar los terminos de búsqueda
                              foreach ($resultado as $clave => $key) 
                           { 
                               $VarFilas++;                          
                           }
                           echo "<strong>\n\nNº de Tickets:</strong>"; echo $VarFilas;   
                                  
                              require_once("LlenarTablaDetalle.php");
                          }
                    }
       } 


   elseif($VarExportInicio!=0 and  $VarExportFinalq!=0)
            {//Query requerido para asignacion del id a una variable si hay fechas de busqueda
         $query="SELECT id from ost_list_items where extra = '$VarExport'";
                         $resultado=mysqli_query($conexion, $query);

                $VarIdDept=0;
                  foreach ($resultado as $clave => $key) 
                                {  
                                    $VarIdDept= $key['id'];
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
                            where (ot.created BETWEEN ' $VarExportInicio' and ' $VarExportFinalq') and oli.id ='$VarIdDept'
                             order by ot.created desc ";
                
                        $resultado = mysqli_query( $conexion, $query );//variable resultada para almacenar el arreglo de la informacion tomando encuenta la conexion de la DB y el query requerido
                          
                         
                          
                          if ($resultado->num_rows>=1)// decicion que evalua el numero de registro afectados por el query en caso de ser verdadero imprime la tabla si no llamda a llamar un mensaje de error
                             {      //foreach para indicar los terminos de búsqueda  
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

//query requerido para la búsqueda del id del departamento seleccionado y asignarlo a una varible
           $query="SELECT id from ost_list_items where extra = '$VarExport'";
                 $resultado=mysqli_query($conexion, $query);

        $VarIdDept=0;
          foreach ($resultado as $clave => $key) 
                        {  
                            $VarIdDept= $key['id'];
                    }

//query requerido para la búsqueda de todos los tickets en contrados por id del departamento de origen
    $query = "SELECT ot.number,ot.created,os.name,concat_ws(' ',osf.firstname,osf.lastname)as nombre,oli.extra,od.dept_name,oht.topic,ots.state
                 FROM ost_ticket ot 
                    left join ost_user os on ot.user_id=os.id 
                    left join ost_staff osf on ot.staff_id=osf.staff_id
                    left join ost_department od on ot.dept_id=od.dept_id 
                    left join ost_ticket__cdata otd on ot.ticket_id=otd.ticket_id
                    left join ost_list_items oli on otd.departamento = oli.id 
                    left join ost_help_topic oht on ot.topic_id=oht.topic_id
                    left join ost_ticket_status ots on ot.status_id= ots.id
                     where oli.id ='$VarIdDept'
                     order by ot.created desc ";
        
                $resultado = mysqli_query( $conexion, $query );//variable resultada para almacenar el arreglo de la informacion tomando encuenta la conexion de la DB y el query requerido
                           
                    
                  if ($resultado->num_rows>=1)// decicion que evalua el numero de registro afectados por el query en caso de ser verdadero imprime la tabla si no llamda a llamar un mensaje de error
                     {         
                      foreach ($resultado as $clave => $key) 
                           { //foreach para mostrar los terminos de búsqueda principal
                               $VarFilas++;                          
                           }
                           echo "<strong>\n\nNº de Tickets:</strong>"; echo $VarFilas;   
                     
                      require_once("LlenarTablaDetalle.php");
                       }
                   
                      

}

?>

 