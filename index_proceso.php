
<?php

function validaBusqueda($parametro)
{
	// Funcion para validar la cadena de busqueda de la lista desplegable
	if(eregi("^[a-zA-Z0-9.@ ]{2,40}$", $parametro)) return TRUE;
	else return FALSE;
}


if(isset($_POST["busqueda"]))
{
	$valor=$_POST["busqueda"];
	
	if(validaBusqueda($valor))
	{

		//asignación del servidor y la base de datos
		$coneccion=mysql_connect("172.16.23.219", "root", "supercalifragilisticoespialidoso") or die(mysql_error());
		$coneccion;
		$bd=mysql_select_db("nutickets", $coneccion) or die(mysql_error());
		if (!$bd){
              echo 'error al seleccionar la base d datos';
               die;
             }
             mysql_query ("SET NAMES 'utf8'");
           
			  //consulta de los registros de las tablas en una cadena de union  de select          
             $consulta=mysql_query("SELECT name FROM ost_user  WHERE name LIKE '%".$valor."%' LIMIT 0, 22 
											union SELECT dept_name FROM ost_department WHERE dept_name LIKE '%".$valor."%' LIMIT 0, 22 
             								UNION SELECT topic FROM ost_help_topic WHERE topic LIKE '%".$valor."%' LIMIT 0, 22 
             								UNION SELECT value FROM ost_list_items WHERE value LIKE '%".$valor."%' LIMIT 0, 22 
             								UNION SELECT state FROm ost_ticket_status WHERE state LIKE '%".$valor."%' LIMIT 0, 22
             								UNION Select priority_desc FROM ost_ticket_priority	WHERE priority_desc LIKE '%".$valor."%' LIMIT 0, 22 
											UNION SELECT number FROM ost_ticket WHERE number  LIKE '%".$valor."%' LIMIT 0, 22  	
             								union SELECT state FROM ost_ticket_event WHERE  state LIKE '%".$valor."%' LIMIT 0, 22
										    UNION SELECT concat_ws(' ',firstname,lastname) FROM ost_staff WHERE concat_ws(' ',firstname,lastname) LIKE '%".$valor."%' LIMIT 0, 22
              								");
									
  

		mysql_close($coneccion);

				
		$cantidad=mysql_num_rows($consulta);
		

		if($cantidad==0 )
		{
			/* 0: no se vuelve por mas resultados
			vacio: cadena a mostrar, en este caso no se muestra nada */
			echo "0&vacio";
		}
		else
		{
			if($cantidad>20) echo "1&"; 
			else echo "0&";
	
			$cantidad=1;
			while(($registro=mysql_fetch_row($consulta)) && $cantidad<=20)
			{
				echo "<div onClick=\"clickLista(this);\" onMouseOver=\"mouseDentro(this);\">".$registro[0]."</div>";
				// Muestro solo 20 resultados de los 22 obtenidos
				$cantidad++;
			}

        			

		}


	}
}
?>