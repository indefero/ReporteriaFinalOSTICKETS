
<?php
error_reporting(0);
//inicializacion dela variable
$VarExport=0;
$VarFilas=0;
//asignacion dela cookies de tema de ayuda
$VarExport =  $_COOKIE["VarCookieDestino"];

//inicializacion de la varible
$VarExportFinalq=0;
$VarExportInicio=0;
//asignacion de la cookies de las fechas
 $VarExportInicio =  $_COOKIE["VarCookieInicio"];
 $VarExportFinalq =  $_COOKIE["VarCookieFinalq"];




if(isset($_POST['btnbuscar']))
    {
//validación de la fecha para inidicar si hay asignado las fechas

     if( $VarExportInicio!=0 and $VarExportFinalq!=0)
     {
    //Variable que guarda la informaciòn de la caja de texto a buscar
        $Varnombre = $_POST['input_2'];

//query requerido para la asignación del id a una variable
      $query="SELECT topic_id  from ost_help_topic  where topic = '$VarExport'";
                 $resultado=mysqli_query($conexion, $query);

                $VarIdDept=0;
                  foreach ($resultado as $clave => $key) 
                          {  
                                    $VarIdDept= $key['topic_id'];
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
                            where (ot.created BETWEEN ' $VarExportInicio' and ' $VarExportFinalq') and oht.topic_id ='$VarIdDept' and (ot.number like '%$Varnombre%' or os.name like '%$Varnombre%' or concat_ws(' ',osf.firstname,osf.lastname)like '%$Varnombre%' or oli.extra like '%$Varnombre%'  or od.dept_name like '%$Varnombre%' or ots.state like '%$Varnombre%') 
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
                            echo "<strong>\n\n,Busqueda por:</strong>"; echo $Varnombre;
                                     
                              require_once("LlenarTablaDetalle.php");
                        }
 
                       else
                          {
  //mensaje de alerta para indicar que no se an encontrado ningun tickets
                            require_once("MsgError.php");
  //query requerido mostrar los tickets en contardos segun la fecha de busqueda 
                         $query = "SELECT ot.number,ot.created,os.name,concat_ws(' ',osf.firstname,osf.lastname)as nombre,oli.extra,od.dept_name,oht.topic,ots.state
                           FROM ost_ticket ot 
                                left join ost_user os on ot.user_id=os.id 
                                left join ost_staff osf on ot.staff_id=osf.staff_id
                                left join ost_department od on ot.dept_id=od.dept_id 
                                left join ost_ticket__cdata otd on ot.ticket_id=otd.ticket_id
                                left join ost_list_items oli on otd.departamento = oli.id 
                                left join ost_help_topic oht on ot.topic_id=oht.topic_id
                                left join ost_ticket_status ots on ot.status_id= ots.id
                                where (ot.created BETWEEN ' $VarExportInicio' and ' $VarExportFinalq') and oht.topic_id ='$VarIdDept'
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
                                  
                              require_once("LlenarTablaDetalle.php");
                          }

                          }
        }
        else{
  //validación para mostar los tickets principales sin ningun filtro
  //asignación de la caja de texto a una variable
  $Varnombre = $_POST['input_2'];

//query requerido para la asignacion del id a una variable
      $query="SELECT topic_id  from ost_help_topic  where topic = '$VarExport'";
                 $resultado=mysqli_query($conexion, $query);

                $VarIdDept=0;
                  foreach ($resultado as $clave => $key) 
                          {  
                                    $VarIdDept= $key['topic_id'];
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
                            where  oht.topic_id ='$VarIdDept' and (ot.number like '%$Varnombre%' or os.name like '%$Varnombre%' or concat_ws(' ',osf.firstname,osf.lastname)like '%$Varnombre%' or oli.extra like '%$Varnombre%'  or od.dept_name like '%$Varnombre%' or ots.state like '%$Varnombre%') 
                             order by ot.created desc ";

                 $resultado = mysqli_query( $conexion, $query );//variable resultada para almacenar el arreglo de la informacion tomando encuenta la conexion de la DB y el query requerido
                                        
                   if ($resultado->num_rows>=1)// decicion que evalua el numero de registro afectados por el query en caso de ser verdadero imprime la tabla si no llamda a llamar un mensaje de error
                       {   //foreach para mostar los terminos de busqueda
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
// mensaje de alerta cuando no se encuentrar ningun tickets
                            require_once("MsgError.php");
//query para mostas los tickets principales sin ningun filtro de busqueda
                          
                         $query = "SELECT ot.number,ot.created,os.name,concat_ws(' ',osf.firstname,osf.lastname)as nombre,oli.extra,od.dept_name,oht.topic,ots.state
                           FROM ost_ticket ot 
                                left join ost_user os on ot.user_id=os.id 
                                left join ost_staff osf on ot.staff_id=osf.staff_id
                                left join ost_department od on ot.dept_id=od.dept_id 
                                left join ost_ticket__cdata otd on ot.ticket_id=otd.ticket_id
                                left join ost_list_items oli on otd.departamento = oli.id 
                                left join ost_help_topic oht on ot.topic_id=oht.topic_id
                                left join ost_ticket_status ots on ot.status_id= ots.id
                                where  oht.topic_id ='$VarIdDept'
                                 order by ot.created desc ";
                
                        $resultado = mysqli_query( $conexion, $query );//variable resultada para almacenar el arreglo de la informacion tomando encuenta la conexion de la DB y el query requerido
                                        
                          if ($resultado->num_rows>=1)// decicion que evalua el numero de registro afectados por el query en caso de ser verdadero imprime la tabla si no llamda a llamar un mensaje de error
                             {          foreach ($resultado as $clave => $key) 
                           { 
                               $VarFilas++;                          
                           }
                           echo "<strong>\n\nNº de Tickets:</strong>"; echo $VarFilas;   
                                
                              require_once("LlenarTablaDetalle.php");
                          }

                          }
        }
     }

//validación para retornar los datos de destalle para los valores sin ningun filtro
   elseif(isset($_POST['btnResul']))
    {//validación para indicar que se a seleccionado los fechas de busqueda
       if( $VarExportInicio!=0 and $VarExportFinalq!=0)
     {
//query  para la asignación  del id a una variable
      $query="SELECT topic_id  from ost_help_topic  where topic = '$VarExport'";
                 $resultado=mysqli_query($conexion, $query);

                $VarIdDept=0;
                  foreach ($resultado as $clave => $key) 
                          {  
                                    $VarIdDept= $key['topic_id'];
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
                                where (ot.created BETWEEN ' $VarExportInicio' and ' $VarExportFinalq') and oht.topic_id ='$VarIdDept'
                                 order by ot.created desc ";
                
                        $resultado = mysqli_query( $conexion, $query );//variable resultada para almacenar el arreglo de la informacion tomando encuenta la conexion de la DB y el query requerido
                                        
                          if ($resultado->num_rows>=1)// decicion que evalua el numero de registro afectados por el query en caso de ser verdadero imprime la tabla si no llamda a llamar un mensaje de error
                             {  //foreach para mostar los terminos de busqueda
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
//query requerido para la asignacion del id a una varibale y mostar los tickets en pantalla

                       $query="SELECT topic_id from ost_help_topic  where topic = '$VarExport'";
                 $resultado=mysqli_query($conexion, $query);

                $VarIdDept=0;
                  foreach ($resultado as $clave => $key) 
                          {  
                                    $VarIdDept= $key['topic_id'];
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
                                where  oht.topic_id ='$VarIdDept'
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

//validación para indicar sin hay algun fecha de busqueda
   elseif($VarExportInicio!=0 and  $VarExportFinalq!=0)
            {
//query para la asignación del id a una variable si hay fecha de busqueda
         $query="SELECT topic_id  from ost_help_topic  where topic = '$VarExport'";
                         $resultado=mysqli_query($conexion, $query);

                $VarIdDept=0;
                  foreach ($resultado as $clave => $key) 
                                {  
                                    $VarIdDept= $key['topic_id'];
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
                            where (ot.created BETWEEN ' $VarExportInicio' and ' $VarExportFinalq') and oht.topic_id ='$VarIdDept'
                             order by ot.created desc ";
                
                        $resultado = mysqli_query( $conexion, $query );//variable resultada para almacenar el arreglo de la informacion tomando encuenta la conexion de la DB y el query requerido
                          
                         
                          
                          if ($resultado->num_rows>=1)// decicion que evalua el numero de registro afectados por el query en caso de ser verdadero imprime la tabla si no llamda a llamar un mensaje de error
                             {   //foreach para mostar los terminos de busqueda
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

//query requerido para asignar el id a una variable y mostar los tickets en la ventana principal
           $query="SELECT topic_id  from ost_help_topic  where topic = '$VarExport'";
                 $resultado=mysqli_query($conexion, $query);

        $VarIdDept=0;
          foreach ($resultado as $clave => $key) 
                        {  
                            $VarIdDept= $key['topic_id'];
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
                     where oht.topic_id ='$VarIdDept'
                     order by ot.created desc ";
        
                $resultado = mysqli_query( $conexion, $query );//variable resultada para almacenar el arreglo de la informacion tomando encuenta la conexion de la DB y el query requerido
                           
                    
                  if ($resultado->num_rows>=1)// decicion que evalua el numero de registro afectados por el query en caso de ser verdadero imprime la tabla si no llamda a llamar un mensaje de error
                     {       foreach ($resultado as $clave => $key) 
                           { 
                               $VarFilas++;                          
                           }
                           echo "<strong>\n\nNº de Tickets:</strong>"; echo $VarFilas;   
                              
                      require_once("LlenarTablaDetalle.php");
                       }
                   
                      

}

?>

