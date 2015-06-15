<!--Este PHP  es encargado de controlar los Query que esten en estado cerrados ya sea los primeros 50 ,100,200 o todos los tiket que esten cerrados-->
<!--evalua una bùsqueda segùn el criterio que se le asigne a la caja de texto bùsqueda-->


<?php
$VarFilas=0; 
// Desiciòn para cuando se presione el botòn de buscar
     if(isset($_POST['btnbuscar']))
    { //Variable que guarda la informaciòn de la caja de texto a buscar
        $Varnombre = $_POST['input_2'];
    // Query requerido para la bùsqueda por la caja de texto para los ticket cerrados
            $query="SELECT ot.number,ot.created,os.name, concat_ws(' ',osf.firstname,osf.lastname)as nombre,od.dept_name,oli.value,oht.topic,ots.state,otp.priority_desc
                    FROM ost_ticket ot 
                        left join ost_user os on ot.user_id=os.id 
                        left join ost_staff osf on ot.staff_id=osf.staff_id
                        left join ost_department od on ot.dept_id=od.dept_id 
                        left join ost_ticket__cdata otd on ot.ticket_id=otd.ticket_id
                        left join ost_list_items oli on otd.departamento=oli.id 
                        left join ost_help_topic oht on ot.topic_id=oht.topic_id
                        left join ost_ticket_status ots on ot.status_id= ots.id
                        left join ost_ticket_priority otp on otd.priority=otp.priority_id
                        where ots.state ='closed' and (ot.number like '%$Varnombre%' or os.name like '%$Varnombre%' or concat_ws(' ',osf.firstname,osf.lastname)like '%$Varnombre%' or od.dept_name like '%$Varnombre%' or oli.value like '%$Varnombre%' or oht.topic like '%$Varnombre%' or otp.priority_desc like '%$Varnombre%')
                     order by ot.created desc";

       
                $resultado=mysqli_query($conexion, $query);//variable resultada para almacenar el arreglo de la informacion tomando encuenta la conexion de la DB y el query requerido

                  foreach ($resultado as $clave => $key) 
                           { 
                               $VarFilas++;                          
                           }

      if ($resultado->num_rows>=1)
          { echo "<strong>Busqueda por:</strong>"; echo $Varnombre; echo "<strong>\n\nNº de Tickets:</strong>"; echo $VarFilas;
            
          require_once("LlenarTabla.php");//Llama al php de la tabla  para que se muestre en pantalla
             }
            else
            {
              $query="SELECT ot.number,ot.created,os.name,concat_ws(' ',osf.firstname,osf.lastname)as nombre,od.dept_name,oli.value,oht.topic,ots.state,otp.priority_desc
                    FROM ost_ticket ot 
                        left join ost_user os on ot.user_id=os.id 
                        left join ost_staff osf on ot.staff_id=osf.staff_id
                        left join ost_department od on ot.dept_id=od.dept_id 
                        left join ost_ticket__cdata otd on ot.ticket_id=otd.ticket_id
                        left join ost_list_items oli on otd.departamento = oli.id
                        left join ost_help_topic oht on ot.topic_id=oht.topic_id
                        left join ost_ticket_status ots on ot.status_id= ots.id
                        left join ost_ticket_priority otp on otd.priority=otp.priority_id
                        where ots.state='closed'
                  order by ot.created desc LIMIT 50";
            $resultado=mysqli_query($conexion, $query);//variable resultada para almacenar el arreglo de la informacion tomando encuenta la conexion de la DB y el query requerido

                   echo "<strong>Numero de Tickets:</strong>";echo"50"; echo "\n\n<strong>,de:</strong>\n\n";
 
      
                   $queryT="SELECT ot.number  FROM ost_ticket ot ";
            $resultadoT=mysqli_query($conexion, $queryT);
              foreach ($resultadoT as $clave => $key) 
                           { 
                               $VarFilas++;                          
                           }

                echo $VarFilas;
             require_once("LlenarTabla.php");//Llama al php de la tabla  para que se muestre en pantalla
            require_once("MsgError.php");   //Llama al php de error de coincidencias
            }
    }
    
elseif(isset($_POST['btnAceptar']))
    {//Valor del combobox que se encuentra en utilidades para generar consulta
         $VarConsulta = $_POST['NivelCon'];
    
       if($VarConsulta == 1)
         { //Query para el llenado de la tabla con los primeros 100 registros de ticket cerrado
         $query="SELECT ot.number,ot.created,os.name, concat_ws(' ',osf.firstname,osf.lastname)as nombre,od.dept_name,oli.value,oht.topic,ots.state,otp.priority_desc
                    FROM ost_ticket ot 
                        left join ost_user os on ot.user_id=os.id 
                        left join ost_staff osf on ot.staff_id=osf.staff_id
                        left join ost_department od on ot.dept_id=od.dept_id 
                        left join ost_ticket__cdata otd on ot.ticket_id=otd.ticket_id
                        left join ost_list_items oli on otd.departamento = oli.id
                        left join ost_help_topic oht on ot.topic_id=oht.topic_id
                        left join ost_ticket_status ots on ot.status_id= ots.id
                        left join ost_ticket_priority otp on otd.priority=otp.priority_id
                        where ots.state='closed'
                  order by ot.created desc LIMIT 100";

             $resultado=mysqli_query($conexion, $query);//variable resultada para almacenar el arreglo de la informacion tomando encuenta la conexion de la DB y el query requerido
                  
                  echo "<strong>Numero de Tickets:</strong>";echo"100"; echo "\n\n<strong>,de:</strong>\n\n";
                $queryT="SELECT ot.number  FROM ost_ticket ot ";
            $resultadoT=mysqli_query($conexion, $queryT);
          foreach ($resultadoT as $clave => $key) 
                       { 
                           $VarFilas++;                          
                       }

                echo $VarFilas;        
             require_once("LlenarTabla.php");//Llama al php de la tabla  para que se muestre en pantalla
                }
                        
        elseif($VarConsulta == 2)
             {  //Query para el llenado de la tabla con los primeros 200 registros de ticket cerrado
                 $query="SELECT ot.number,ot.created,os.name, concat_ws(' ',osf.firstname,osf.lastname)as nombre,od.dept_name,oli.value,oht.topic,ots.state,otp.priority_desc
                    FROM ost_ticket ot 
                        left join ost_user os on ot.user_id=os.id 
                        left join ost_staff osf on ot.staff_id=osf.staff_id
                        left join ost_department od on ot.dept_id=od.dept_id 
                        left join ost_ticket__cdata otd on ot.ticket_id=otd.ticket_id
                        left join ost_list_items oli on otd.departamento = oli.id
                        left join ost_help_topic oht on ot.topic_id=oht.topic_id
                        left join ost_ticket_status ots on ot.status_id= ots.id
                        left join ost_ticket_priority otp on otd.priority=otp.priority_id
                        where ots.state='closed'
                  order by ot.created desc LIMIT 200";

             $resultado=mysqli_query($conexion, $query);//variable resultada para almacenar el arreglo de la informacion tomando encuenta la conexion de la DB y el query requerido
                 

                  echo "<strong>Numero de Tickets:</strong>";echo"200"; echo "\n\n<strong>,de:</strong>\n\n";

           $queryT="SELECT ot.number  FROM ost_ticket ot ";
            $resultadoT=mysqli_query($conexion, $queryT);
          foreach ($resultadoT as $clave => $key) 
                      { 
                       $VarFilas++;                          
                       }

                echo $VarFilas;          
             require_once("LlenarTabla.php");//Llama al php de la tabla  para que se muestre en pantalla
             }

         elseif($VarConsulta == 0)
            {  //Query para el llenado de la tabla con todos los registros de ticket cerrados
                  $query="SELECT ot.number,ot.created,os.name, concat_ws(' ',osf.firstname,osf.lastname)as nombre,od.dept_name,oli.value,oht.topic,ots.state,otp.priority_desc
                        FROM ost_ticket ot 
                            left join ost_user os on ot.user_id=os.id 
                            left join ost_staff osf on ot.staff_id=osf.staff_id
                            left join ost_department od on ot.dept_id=od.dept_id 
                            left join ost_ticket__cdata otd on ot.ticket_id=otd.ticket_id
                            left join ost_list_items oli on otd.departamento = oli.id
                            left join ost_help_topic oht on ot.topic_id=oht.topic_id
                            left join ost_ticket_status ots on ot.status_id= ots.id
                            left join ost_ticket_priority otp on otd.priority=otp.priority_id
                            where ots.state='closed'
                      order by ot.created desc";

             $resultado=mysqli_query($conexion, $query);//variable resultada para almacenar el arreglo de la informacion tomando encuenta la conexion de la DB y el query requerido
                  

                   $queryT="SELECT ot.number  FROM ost_ticket ot ";
                            $resultadoT=mysqli_query($conexion, $queryT);
                          foreach ($resultadoT as $clave => $key) 
                                      { 
                                       $VarFilas++;                          
                                       }

                                echo "<strong>Numero de Tickets:</strong>";echo$VarFilas; echo "\n\n<strong>,de:</strong>\n\n";echo$VarFilas;
      
             require_once("LlenarTabla.php");//Llama al php de la tabla  para que se muestre en pantalla
           }


   }    

 else
    {     //Query para el llenado de la tabla con los primeros 50 registros    
  	     $query="SELECT ot.number,ot.created,os.name,concat_ws(' ',osf.firstname,osf.lastname)as nombre,od.dept_name,oli.value,oht.topic,ots.state,otp.priority_desc
                    FROM ost_ticket ot 
                        left join ost_user os on ot.user_id=os.id 
                        left join ost_staff osf on ot.staff_id=osf.staff_id
                        left join ost_department od on ot.dept_id=od.dept_id 
                        left join ost_ticket__cdata otd on ot.ticket_id=otd.ticket_id
                       left join ost_list_items oli on otd.departamento=oli.id 
                        left join ost_help_topic oht on ot.topic_id=oht.topic_id
                        left join ost_ticket_status ots on ot.status_id= ots.id
                        left join ost_ticket_priority otp on otd.priority=otp.priority_id
                        where ots.state='closed'
                  order by ot.created desc LIMIT 50";
            $resultado=mysqli_query($conexion, $query);//variable resultada para almacenar el arreglo de la informacion tomando encuenta la conexion de la DB y el query requerido


 echo "<strong>Numero de Tickets:</strong>";echo"50"; echo "\n\n<strong>,de:</strong>\n\n";
        $queryT="SELECT ot.number  FROM ost_ticket ot ";
            $resultadoT=mysqli_query($conexion, $queryT);
          foreach ($resultadoT as $clave => $key) 
                       { 
                           $VarFilas++;                          
                       }

                echo $VarFilas;   
          require_once("LlenarTabla.php");//Llama al php de la tabla  para que se muestre en pantalla
        
    }

?>