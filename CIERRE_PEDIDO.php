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
	    <?php
		 //Conexion
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
			
			$entidad = $_POST['Entidad'];
			echo "<br>entidad:".$entidad;
			
			$item1 = $_POST['Item1'];
			echo "<br>Item 1:".$item1;
			
			$cant1 = $_POST['Unidades1'];
			echo "<br>Cantidad 1:".$cant1;
			
			$item1 = $_POST['Item2'];
			echo "<br>Item 1:".$item1;
			
			$cant1 = $_POST['Unidades2'];
			echo "<br>Cantidad 2:".$cant1;
			
			$item1 = $_POST['Item3'];
			echo "<br>Item 3:".$item3;
			
			$cant1 = $_POST['Unidades3'];
			echo "<br>Cantidad 3:".$cant3;			
			
			echo "<br>usuario:".$_POST['Usuario'];
			echo "<br><br>";
		
			$estado = 'N';
			
//Insert en VENTAS_CAB 
			
			$query="INSERT INTO u845291486_reina.PEDIDOS (ID_PEDIDO,ENTIDAD,FECHA_PED,ITEM,CANTIDAD,ESTADO) 
					VALUES( ".$pedido.",".$entidad.","."'".$fecha."'".",".$item1.",".$cant1.","."'".$estado."'".")";
	        $resultado=mysqli_query($result_coneccion,$query);
			
			$query="INSERT INTO u845291486_reina.PEDIDOS (ID_PEDIDO,ENTIDAD,FECHA_PED,ITEM,CANTIDAD,ESTADO) 
					VALUES( ".$pedido.",".$entidad.","."'".$fecha."'".",".$item2.",".$cant2.","."'".$estado."'".")";
	        $resultado=mysqli_query($result_coneccion,$query);
			
			$query="INSERT INTO u845291486_reina.PEDIDOS (ID_PEDIDO,ENTIDAD,FECHA_PED,ITEM,CANTIDAD,ESTADO) 
					VALUES( ".$pedido.",".$entidad.","."'".$fecha."'".",".$item3.",".$cant3.","."'".$estado."'".")";
	        $resultado=mysqli_query($result_coneccion,$query);
//Fin insercion
		?>	
		<form action="CARGA_PED.php" method="post">
		
		<input type ="hidden" name = "Usuario" value = <?php echo $_POST['Usuario']; ?>>
		<input type="submit" value="Cargar otra Pedido">
		
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