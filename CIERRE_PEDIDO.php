 <html lang="esp">
 <head>
	 <title>Inicio</title>
	 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	 <link rel="stylesheet" href="" type="text/css"/>
 </head>
	 <body>
  	 <table align='center' valign='middle'>
  	 <tr><td></td><td></td><td></td></tr>
  	 <tr>
  	   <td></td><td>
	    <?php //Conexion
					$host="mysql.hostinger.com.ar";
					$user="u845291486_pablo";
					$password="895895";
					
					$result_coneccion=mysqli_connect($host,$user,$password);
					$sql="show status";
					$result=mysqli_query($result_coneccion,$sql);
					if ($result==0) {
					//Falla conexion
						echo "<b>Error".mysql_errno.": ".mysql_error()."</b>";
						}{
					//Conexion correcta
						session_start();
						$_SESSION['Usuario']=$_POST['Usuario'];
						$_SESSION['Clave']=$_POST['Clave'];					
						
						$sql="SELECT USUARIO FROM u845291486_reina.USUARIOS WHERE NOMBRE='".$_POST[Usuario]."'";
						$result=mysqli_query($result_coneccion,$sql);
						$usuario=mysqli_fetch_array($result, MYSQLI_ASSOC);	
					}
				?>	
			
			<?php
			//Conexion correcta
// Variables a llenar para insert
		//Muestra PEDIDO
			$pedido = 1;
			$query="SELECT MAX(ID_PEDIDO) as maxped FROM u845291486_reina.PEDIDOS";
			$resultado=mysqli_query($result_coneccion,$query);
			$qry_pedido=mysqli_fetch_array($resultado, MYSQLI_ASSOC);	
				
			$pedido = $pedido + $qry_pedido["maxped"];
			echo "<br>Pedido:".$pedido;
			
			$fecha = date("Y-m-d");
			echo "<br>fecha:".$fecha;
			
			$cliente = $_POST['CLIENTE'];
			echo "<br>CLIENTE:".$cliente;
			
			$item = $_POST['ITEM'];
			echo "<br>Item:".$item;
			
			$cant = $_POST['CANTIDAD'];
			echo "<br>Cantidad:".$cant;
			
			echo "<br>usuario:".$_POST['Usuario'];
			echo "<br><br>";
		
			$estado = 'N';
			
//Insert en VENTAS_CAB 
			
			$query="INSERT INTO u845291486_reina.PEDIDOS (ID_PEDIDO,ENTIDAD,FECHA_PED,ITEM,CANTIDAD,ESTADO) 
					VALUES( ".$pedido.",".$cliente.","."'".$fecha."'".",".$item.",".$cant.","."'".$estado."'".")";
	        $resultado=mysqli_query($result_coneccion,$query);

//Fin insercion
		?>	
		<form action="SELECCION_FORMULARIO.php" method="post">
		
		<input type ="hidden" name = "Usuario" value = <?php echo $_POST['Usuario']; ?> >
		<input type="submit" value="Volver a la seleccion de Formulario">
		
		</form>
		
	      </td><td></td>
	      </tr>
	      <tr><td></td>
		  <td>
			
		  </td>
		  <td></td></tr>
	     </table>
	    </form>
	 </body>
 </html>