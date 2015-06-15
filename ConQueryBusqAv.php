<!--Este PHP  es encargado de controlar el Query de bùsqueda avanzada de todos los tiket que esten-->
<!--evalua una bùsqueda segùn el criterio que se le asigne cada uno de los combobox de la tabla de bùsqueda avanzada-->

<?php
$VarFilas=0;
$VarFilasT=0;

// Desiciòn para cuando se presione el botòn de buscar
 if(isset($_POST['btnBuscarAv']))
    {
    // inicializacion de la variables  
      $VarEstado=0;
      $VarDeptDestino=0;
      $VarDeptOrigen=0;
      $VarAyuda=0;
      $VarPrioridad=0;
      $VarMedSolicit=0;
      $VarAsignado=0;
      $VarCerrado=0;
      $VarFechInicio=0;
      $VarFechFin=0;

      // Recolecion de los datos entre formulario de bùsqueda avansada a cada una de las variables
      $VarEstado = $_POST['estado'];
      $VarDeptDestino = $_POST['Departamentos'];
      $VarDeptOrigen = $_POST['DepartaOrigen'];
      $VarAyuda = $_POST['Ayuda'];
      $VarMedSolicit = $_POST['MedSolicit'];
      $VarPrioridad = $_POST['Prioridad'];
      $VarFechInicio = $_POST['Inicio'];
      $VarFechFin = $_POST['Fin'];


 // Deciòn requeridad independientemente del estado que se a seleccionado e inicializa las variables en 0 de asignado y cerrado de usuario
    if($VarEstado==3)
      {
        $VarAsignado=0;
      }
        else{
        $VarAsignado = $_POST['Asignado'];
        }    


        if($VarEstado==1){
          $VarCerrado=0;
        }    
        else
        {
          $VarCerrado=$_POST['Cerrado'];
        }

    // Ciclo de if anidados para ir construllendo el WHERE para  filtrar los datos seleccionados        
$conditions = array();// Declaracion del arreglo unidimencional para guardar los registros
$ArrEstados=array();
$ArrDeptDes=array();
$ArrDeptOrig=array();
$ArrTemaAyu=array();
$ArrMediSoli=array();
$ArrPrioridad=array();
$ArrAsig=array();
$ArrCerrad=array();
      if( $VarEstado != "0" ){//If que evalua que la condicion tenga un registro para ser guardado en el areglo de condicion
          $conditions[] = "ots.id= '$VarEstado'";
         $ArrEstados[] ="id = '$VarEstado'";
          
        }
      if( $VarDeptDestino != "0" ){
        $conditions[] = "od.dept_id  = '$VarDeptDestino'";
         $ArrDeptDes[] ="dept_id = '$VarDeptDestino'";
        
        }
      if( $VarDeptOrigen != "0" ){
          $conditions[] = "oli.id = '$VarDeptOrigen'";
          $ArrDeptOrig[] ="id='$VarDeptOrigen'";
        
        }
      if( $VarAyuda != "0" ){
          $conditions[] = "oht.topic_id = '$VarAyuda'";
           $ArrTemaAyu[] ="topic_id='$VarAyuda'";
         
        }
      if( $VarMedSolicit != "0" ){
          $conditions[] = "oli1.id = '$VarMedSolicit'";
          $ArrMediSoli[] ="id='$VarMedSolicit'";
         
        }
      if( $VarPrioridad != "0" ){
           $conditions[] = "otp.priority_id = '$VarPrioridad'";
            $ArrPrioridad[] ="priority_id='$VarPrioridad'";
         
        }
        if($VarCerrado!='0'){
          $conditions[] = "osf.staff_id='$VarCerrado'";
           $ArrCerrad[] ="staff_id='$VarCerrado'";
        
        }
        if( $VarAsignado != "0"){
          $conditions[] = "osf.staff_id='$VarAsignado'";
           $ArrAsig[] ="staff_id='$VarAsignado'";
         
        }
        if( $VarFechInicio && $VarFechFin != "0"){// between para la bùsqueda entre fecha
          $conditions[] = "(ot.created BETWEEN '$VarFechInicio' AND '$VarFechFin')";
         // $mensaj[] = "(ot.created BETWEEN '$VarFechInicio' AND '$VarFechFin')";
         
        }
        // Declaracion de la variable que va a guardar el arreglo del WHERE con la declaracion de implode para anidar todas las deciones
       $wquery=" ";
      $resul=" ";
      $resulDeptDe=" ";
      $resulDeptOrig=" ";
      $resulTemaAyu=" ";
      $resulMediSoli=" ";
      $resulPrioridad=" ";
      $resulAsig=" ";
      $resulCerrad=" ";

    if(count($conditions) > 0 ){
         $wquery.=" WHERE ".implode(" AND ",$conditions);
         }
       


//-------------------------------------------------
      

   if(count($ArrEstados) > 0 ){
        $resul.=" WHERE ".implode(" AND ",$ArrEstados);      
        }

    if(count($ArrDeptDes) > 0 ){
      $resulDeptDe.=" WHERE ".implode(" AND ",$ArrDeptDes);      
        }

    if(count($ArrDeptOrig) > 0 ){
      $resulDeptOrig.=" WHERE ".implode(" AND ",$ArrDeptOrig);      
        }
    if(count($ArrTemaAyu) > 0 ){
      $resulTemaAyu.=" WHERE ".implode(" AND ",$ArrTemaAyu);      
        }
          
    if(count($ArrMediSoli) > 0 ){
      $resulMediSoli.=" WHERE ".implode(" AND ",$ArrMediSoli);      
        }   
       
    if(count($ArrPrioridad) > 0 ){
       $resulPrioridad.=" WHERE ".implode(" AND ",$ArrPrioridad);      
        } 
        
    if(count($ArrAsig) > 0 ){
        $resulAsig.=" WHERE ".implode(" AND ",$ArrAsig);      
        }

    if(count($ArrCerrad) > 0 ){
       $resulCerrad.=" WHERE ".implode(" AND ",$ArrCerrad);      
        }


      
        

       
      

    //Query bajo el cual se hace el llamado del arreglo dinamico para cada una de las informacion de las tablas que se va a mostar en pantalla

       $query = "SELECT ot.number,ot.created,os.name,osf.firstname,osf.lastname,od.dept_name,oli1.value,oht.topic,ots.state,otp.priority_desc,oli.extra
                    FROM ost_ticket ot 
                        left join ost_user os on ot.user_id=os.id 
                        left join ost_staff osf on ot.staff_id=osf.staff_id
                        left join ost_department od on ot.dept_id=od.dept_id 
                        left join ost_ticket__cdata otd on ot.ticket_id=otd.ticket_id
                      
                        left join ost_list_items oli on otd.departamento=oli.id 
                        left join ost_help_topic oht on ot.topic_id=oht.topic_id
                        left join ost_ticket_status ots on ot.status_id= ots.id
                        left join ost_ticket_priority otp on otd.priority=otp.priority_id
                        left join ost_list_items oli1 on  otd.fuente = oli1.id " .$wquery. " order by ot.created desc ";
//echo $query;
             $resultado = mysqli_query( $conexion, $query );//variable resultada para almacenar el arreglo de la informacion tomando encuenta la conexion de la DB y el query requerido
                   foreach ($resultado as $clave => $key) 
                           { 
                               $VarFilas++;                          
                           }

                $queryT="SELECT ot.number  FROM ost_ticket ot ";
            $resultadoT=mysqli_query($conexion, $queryT);
              foreach ($resultadoT as $clave => $key) 
                           { 
                               $VarFilasT++;                          
                           }

                 
              
                  if ($resultado->num_rows>=1)// decicion que evalua el numero de registro afectados por el query en caso de ser verdadero imprime la tabla si no llamda a llamar un mensaje de error
                     {
                       echo "<strong> Resultado segùn busqueda de:\n\n</strong>";
                        echo "<strong>Fecha Inicio:\n\n</strong>";
                         echo $VarFechInicio;
                         echo "<strong>,Fecha Hasta:\n\n</strong>";
                         echo $VarFechFin;
                         echo "<strong>\n\n,Nº de Tickets:</strong>"; echo $VarFilas;
                         echo "\n\n<strong>,de:</strong>\n\n";echo $VarFilasT;
                             if( $VarEstado != "0" )
                                {
                                  echo "<strong>,Estado:\n\n</strong>";
      
                                      $queryES = "SELECT state
                                             FROM ost_ticket_status" .$resul;
                                             $resulta = mysqli_query( $conexion, $queryES );
                                            foreach ($resulta as $clave => $key) 
                                                   {                                              
                                                  echo $key['state'];
                                                    }
                                 }

                               if( $VarDeptDestino != "0" )
                               {
                                  echo "<strong>,Departamento Destino:\n\n</strong>";
      
                                      $queryDD = "SELECT dept_name
                                             FROM ost_department" .$resulDeptDe;
                                               $resultaa = mysqli_query( $conexion, $queryDD );
                                            foreach ($resultaa as $clave => $key) 
                                                   {                                              
                                                  echo $key['dept_name'];
                                                    }
                                 }
                                   if( $VarDeptOrigen != "0" )
                                   {
                                       echo "<strong>,Departamento Origen:\n\n</strong>";
      
                                      $queryDo = "SELECT value
                                             FROM ost_list_items" .$resulDeptOrig;
                                               $resulOrig = mysqli_query( $conexion, $queryDo );
                                            foreach ($resulOrig as $clave => $key) 
                                                   {                                              
                                                  echo $key['value'];
                                                    }
                                 }

                                if( $VarAyuda != "0" )
                                   {
                                  echo "<strong>,Tema de Ayuda:\n\n</strong>";
                                       $queryTA = "SELECT topic
                                             FROM ost_help_topic" .$resulTemaAyu;
                                               $resulOrig = mysqli_query( $conexion, $queryTA );
                                            foreach ($resulOrig as $clave => $key) 
                                                   {                                              
                                                  echo $key['topic'];
                                                    }
                                 }
                                    
                                      if( $VarMedSolicit != "0" )
                                        { echo "<strong>,Medio de Solicitud:\n\n</strong>";
      
                                      $queryMS = "SELECT value
                                             FROM ost_list_items" .$resulMediSoli;
                                               $resulMeds = mysqli_query( $conexion, $queryMS);
                                            foreach ($resulMeds as $clave => $key) 
                                                   {                                              
                                                  echo $key['value'];
                                                    }
                                     }
                                      if( $VarPrioridad != "0" ){
                                        echo "<strong>,Prioridad:\n\n</strong>";
      
                                      $queryPrio = "SELECT priority_desc
                                             FROM ost_ticket_priority" .$resulPrioridad;
                                               $resulPrio = mysqli_query( $conexion, $queryPrio);
                                            foreach ($resulPrio as $clave => $key) 
                                                   {                                              
                                                  echo $key['priority_desc'];
                                                    }
                                     }

                                      if( $VarAsignado != "0"){
                                        echo "<strong>,Asignado a:\n\n</strong>";
      
                                      $queryAsig = "SELECT concat_ws(' ',firstname,lastname)as nombre
                                             FROM ost_staff" .$resulAsig;
                                               $resulAsign = mysqli_query( $conexion, $queryAsig);
                                            foreach ($resulAsign as $clave => $key) 
                                                   {                                              
                                                  echo $key['nombre'];
                                                    }
                                     }

                                     if($VarCerrado!='0'){
                                        echo "<strong>,Cerrado por:\n\n</strong>";
      
                                      $queryCerrad = "SELECT concat_ws(' ',firstname,lastname)as nombre
                                             FROM ost_staff" .$resulCerrad;
                                               $resulcerrado = mysqli_query( $conexion, $queryCerrad);
                                            foreach ($resulcerrado as $clave => $key) 
                                                   {                                              
                                                  echo $key['nombre'];
                                                    }
                                     }
                             

                    require_once("LlenarTabAV.php"); //Llama al php de llenar tabla avanzada para que lo muestre en pantalla
                       }
                 else
                    {
                     require_once("Redireccion.php");//Redirecionamiento automatico encaso de no encontrar conincidencias con su busqueda 
                    
                    }
 
}


?>