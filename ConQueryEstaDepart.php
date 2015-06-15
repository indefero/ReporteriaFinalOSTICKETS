<!--Este PHP  es encargado de controlar los Query para general las consultas de los ticket por departamento-->
<!--evalua una bùsqueda segùn el criterio que se le asigne a los datapicker del calendario-->

 <?php
error_reporting(0);
$VarFechFin=0;
$VarFechInicio=0;

if(isset($_POST['btnConsulta']))
          {
             
                $VarFechInicio = $_POST['Inicio'];//Valor del combobox que se encuentra en utilidades para generar consulta
           	    $VarFechFin = $_POST['Fin'];//Valor del combobox que se encuentra en utilidades para generar consulta
           

           	    	 $strSql = "SELECT od.dept_name as nombre,COUNT(ot.dept_id)as total from ost_ticket ot
                      left join ost_department od on ot.dept_id=od.dept_id
                       where (ot.created BETWEEN '$VarFechInicio' and '$VarFechFin') 
                        group by ot.dept_id
                        order by nombre asc";

             $registros = $conexion->query($strSql);
           //echo "La seleccion devolvió ". $registros ." filas</br>";

      if($registros->num_rows>=1)
            {//if requerido para mostrar el subtitulo de las gràfica cuando es por fecha
             echo "Gràfica segùn el intervalo de fecha de:\n\n";
             echo"Incio:\n\n";
             echo $VarFechInicio;
             echo"\n\n\n\n";
             echo"Hasta:\n\n";
             echo $VarFechFin;
             }
          elseif($registros->num_rows<1)
                      {//manda a llamar la tabla para que se mueste en pantalla con la informaciòn
                 /*Query requerido para obtener el total de ticket por cada departamento con su nombre*/
       			$strSql = "SELECT od.dept_name as nombre,COUNT(ot.dept_id)as total from ost_ticket ot
                      left join ost_department od on ot.dept_id=od.dept_id
                        group by ot.dept_id
                        order by nombre asc";

             $registros = $conexion->query($strSql);
           //echo "La seleccion devolvió ". $registros ." filas</br>";
                    require_once("MsgError.php");  
            		}


           }
elseif(isset($_POST['BTNatras']))
   {

    $VarExport=0;
    $VarExportInicio=0;
    $VarExportFinalq=0;
    
 $VarExport =  $_COOKIE["VarCookieDestino"];                
$VarExportInicio =  $_COOKIE["VarCookieInicio"];
$VarExportFinalq =  $_COOKIE["VarCookieFinalq"];

  if($VarExport!="" and $VarExportInicio!="" and $VarExportFinalq!="" )
  {

                        $strSql="SELECT od.dept_name as nombre,COUNT(ot.dept_id)as total from ost_ticket ot
                      left join ost_department od on ot.dept_id=od.dept_id
                       where (ot.created BETWEEN '$VarExportInicio ' and ' $VarExportFinalq') 
                        group by od.dept_id
                        order by nombre asc";

             $registros = $conexion->query($strSql);
           //echo "La seleccion devolvió ". $registros ." filas</br>";
            if($registros->num_rows<=0)
            {
               echo"El tiempo de la fecha de bùsqueda a expirado porfavor ingrese otro intervalo de fecha o haga click en actualizar para mostar las estadìsticas actuales ";
             }

            if($registros->num_rows>=1)
         
            {//if requerido para mostrar el subtitulo de las gràfica cuando es por fecha
             echo "Gràfica segùn el intervalo de fecha de:\n\n";
             echo"Incio:\n\n";
             echo $VarExportInicio;
             echo"\n\n\n\n";
             echo"Hasta:\n\n";
             echo $VarExportFinalq;


             }
   }
    else{

              /*Query requerido para obtener el total de ticket por cada departamento con su nombre*/
         $strSql="SELECT od.dept_name as nombre,COUNT(ot.dept_id)as total from ost_ticket ot
                      left join ost_department od on ot.dept_id=od.dept_id
                        group by od.dept_id
                        order by nombre asc";

             $registros = $conexion->query($strSql);
           //echo "La seleccion devolvió ". $registros ." filas</br>";
             
               }  
        }
           else {
            
 		/*Query requerido para obtener el total de ticket por cada departamento con su nombre*/
       $strSql = "SELECT od.dept_name as nombre,COUNT(ot.dept_id)as total from ost_ticket ot
                      left join ost_department od on ot.dept_id=od.dept_id
                        group by od.dept_id
                        order by nombre asc";


                        

             $registros = $conexion->query($strSql);
           //echo "La seleccion devolvió ". $registros ." filas</br>";

               


                 }           




  ?>

  