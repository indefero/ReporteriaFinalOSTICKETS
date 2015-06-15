<?php
require_once("conexion.php");//Manda a llamar el archivo de conexion de la base de datos
 $conexion = conectar();//variable a la cual retorna la cadena de conexion de la base de datos
?>

<?php
$VarExport=0;
$VarAsunto=0;
$VarExport1 =  $_COOKIE["VarCookieNumero"];
?>


<!DOCTYPE html>
<html>
<div class="MarcoPrincipal">
<!--Este PHP es el que se muestra al inicio de la publicaciòn con la informaciòn màs relevante de los tickets-->
 <div class="MarcoEncabezado">
<head>
 <link rel="stylesheet" href="style.css"><!--referencia al archivo de estilos de la paginas en cada uno de los archivos php-->
 <meta charset="UTF-8">


    
    <script type="text/javascript" src="JavascriptIndex.js"></script>
<title>Hilo de Tickets</title>
</head>
<body>
<center><h2>Ticket # <?php echo $VarExport1;?></h2><center>


<?php

 $queryP="SELECT ot.number,ot.created,os.name, concat_ws(' ',osf.firstname,osf.lastname)as nombre,od.dept_name,oli.value,oht.topic,ots.state,otp.priority_desc
                FROM ost_ticket ot 
                   left join ost_user os on ot.user_id=os.id 
                   left join ost_staff osf on ot.staff_id=osf.staff_id
                   left join ost_department od on ot.dept_id=od.dept_id 
                   left join ost_ticket__cdata otd on ot.ticket_id=otd.ticket_id
                   left join ost_list_items oli on otd.departamento = oli.id
                   left join ost_help_topic oht on ot.topic_id=oht.topic_id
                   left join ost_ticket_status ots on ot.status_id= ots.id
                   left join ost_ticket_priority otp on otd.priority=otp.priority_id
                  where ot.number='$VarExport1'";
            
            $resultadoP=mysqli_query($conexion, $queryP);
            foreach ($resultadoP as $clave => $keyP) 
                           {  
?>                       
  	<style>
  table.tabla {
   width: 90%;
   max-width:600px;
   min-width: 300px; 
   margin: 0 auto;*/ /* centrado */
 
   background: white;
 
   /* sombra interior */
      box-shadow: inset 1px 1px 1px 0px #999999;
    
   /* esquinas redondeadas */
     border-radius: 10px;
  }
  table.tabla > tbody > tr:first-child > td:first-child { /* celda superior izquierda */
   border-top-left-radius: 10px;
  }
  table.tabla > tbody > tr > td:first-child { /* celdas de la primera columna  */
   border-left: 1px solid #999999;
  }
  table.tabla > tbody > tr:last-child > td:first-child { /* celda inferior izquierda */
   border-bottom-left-radius: 10px;
  }
  table.tabla > tbody > tr:last-child > td:last-child { /* celda inferior derecha */
   border-bottom-right-radius: 10px;
  }
  table.tabla > tbody > tr:nth-child(even) { /* celdas de los renglones pares */
   background: #e7e7e7;
  }
 </style>
</head>
<body>

     <strong><h3>Datos Generales del Ticket</h3></strong>
<?php
     $queryt = "SELECT ot.number,otcd.subject  FROM ost_ticket ot 
				left join ost_ticket__cdata otcd on otcd.ticket_id=ot.ticket_id
				where ot.number='$VarExport1'";
                  
				$resultadot=mysqli_query($conexion, $queryt);
				 
				foreach ($resultadot as $clavet => $keyt) 
                           {
                               $VarAsunto= $keyt['subject']; 
                           }		
echo "<strong>Asunto:</strong>";echo $VarAsunto;
?>
		 <table cellpadding=0 cellspacing=0 class="tabla">
		  <tr>
		   <th >Nº Tickets:<?php echo $keyP['number'];?></th></br>
		   <th >Fecha de Creaciòn:<?php echo $keyP['created'];?></th>
		  </tr>	

		  <tr>
		  <td><strong>Remitente:</strong><?php echo $keyP['name'];?></td>
		  <td>&nbsp;<strong>Asignado a:</strong><?php echo $keyP['nombre'];?></td>
		  </tr>
		   <tr>
		  <td><strong>Departamento Origen:</strong><?php echo $keyP['value'];?></td>
		  <td>&nbsp;<strong>Departamento Destino:</strong><?php echo $keyP['dept_name'];?></td>
		  <td></td>
		  </tr>
		  <tr>
		   <td colspan="2"><strong>Tema de Ayuda:</strong><?php echo $keyP['topic'];?> </td>
		   <td>
		  </tr>
		  <tr>
		  <td><strong>Nivel de Prioridad:</strong><?php echo $keyP['priority_desc'];?> </td>
		  <td><strong>&nbsp;Estado Actual:</strong><?php echo $keyP['state'];?> </td>
		  </tr>
		 </table>

		</body>
		</html> 

	        <?php  }   ?>

<strong><h3>Hilo del Ticket</h3></strong>

<?php
 	
$query = "SELECT ot.number, otth.ticket_id,otth.poster,otth.title,otth.body,otth.created FROM ost_ticket ot 
				left join ost_ticket_thread otth on otth.ticket_id=ot.ticket_id
				left join ost_ticket__cdata otcd on otcd.ticket_id=ot.ticket_id
				where ot.number='$VarExport1'
				order by otth.created asc";

 
      $resultado=mysqli_query($conexion, $query);
                  foreach ($resultado as $clave => $key) 
                           {  
?>                       
  	<style>
  table.tabla {
   width: 80%;
   max-width:600px;
   min-width: 300px; 
   margin: 0 auto; /* centrado */

 
   background: white;
 
   /* sombra interior */
   
   box-shadow: inset 1px 1px 1px 0px #999999;
    
   /* esquinas redondeadas */
  
   border-radius: 10px;
  }
  table.tabla > tbody > tr:first-child > td:first-child { /* celda superior izquierda */
   border-top-left-radius: 10px;
  }
  table.tabla > tbody > tr > td:first-child { /* celdas de la primera columna  */
   border-left: 1px solid #999999;
  }
  table.tabla > tbody > tr:last-child > td:first-child { /* celda inferior izquierda */
   border-bottom-left-radius: 10px;
  }
  table.tabla > tbody > tr:last-child > td:last-child { /* celda inferior derecha */
   border-bottom-right-radius: 10px;
  }
  table.tabla > tbody > tr:nth-child(even) { /* celdas de los renglones pares */
   background: #e7e7e7;
  }
 </style>
</head>
<body>

		 <table cellpadding=0 cellspacing=0 class="tabla">
		  <tr>
		   <td><strong>&nbsp;&nbsp;<?php echo $key['created'];?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><strong><?php echo $key['title'];?></td>
		 	<td><strong><?php echo $key['poster'];?></strong></td>
		  </tr>

		  <tr>
		<td ><?php echo $key['body'];?> </td>
	<td></td>
    
		  </tr>
		  <tr>
		  </br>
		  
		 </table>

	

		</body>
		</html>   
	        <?php  }   ?>


<?php ?>