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
			$user="u192212072_pablo";
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
		//cabecera
			
			$query="SELECT MAX(VENTA)+1 FROM u192212072_reina.VENTAS_REN";
			$resultado=mysqli_query($result_coneccion,$query);
			$qry_venta=mysqli_fetch_array($resultado, MYSQLI_ASSOC);	
				
			$venta = $qry_venta["MAX(VENTA)+1"];
			echo "<br>venta:".$venta;
			
			$fecha = date("Y-m-d");
			echo "<br>fecha:".$fecha;
			
			$entidad = $_POST['Entidad'];
			echo "<br>entidad:".$entidad;
			
			$monto = $_POST['Precio_Unit1'] + $_POST['Precio_Unit2'] + $_POST['Precio_Unit3'] + $_POST['Precio_Unit4'] + $_POST['Precio_Unit5'] + $_POST['Precio_Unit6'];
			echo "<br>monto:".$monto;
			
			$descuento = 0;
			echo "<br>descuento:".$descuento;
			
			$total = $monto - $descuento;
			echo "<br>total:".$total;
			
			$cobrado = $_POST['Cobrado'];
			echo "<br>cobrado:".$cobrado;
			
			$cta_cte = $_POST['Cta_cte'];
			echo "<br>cuenta corriente:".$cta_cte;

			echo "<br>usuario:".$_POST['Usuario'];
			echo "<br><br>";
		
		//renglones
			$venta_ren = $venta;
			
			$query="SELECT RENGLON FROM u192212072_reina.VENTAS_REN WHERE VENTA = ".$venta;
			$resultado=mysqli_query($result_coneccion,$query);
			$cant_filas = mysqli_num_rows($resultado);
			if ($cant_filas > 0) {
			$qry_renglon=mysqli_fetch_array($resultado, MYSQLI_ASSOC);
			$renglon = $qry_renglon['RENGLON'];
			}{
			$renglon = 1;	
			}
			echo "<br>renglon:".$renglon;
		
			$item = $_POST['Item1']; //ver varios items
			echo "<br>iteM:".$item;
			
			$query="SELECT COD_UNIDAD FROM u192212072_reina.ITEMS WHERE ITEM = '".$_POST['Item1']."'";
			$resultado=mysqli_query($result_coneccion,$query);
			$qry_unidad=mysqli_fetch_array($resultado, MYSQLI_ASSOC);	
			$cod_uni = $qry_unidad['COD_UNIDAD'];
			echo "<br>codigo unidad:".$cod_uni;
			
			$unidades = $_POST['Unidades1']; //ver varios items
			echo "<br>unidades:".$unidades;
		
			$precio_unit = $_POST['Precio_Unit1'];
			echo "<br>precio unitario:".$precio_unit;
			
			$descuento = 0;
			echo "<br>descuento:".$descuento;
			
			$total_item = $precio_unit * $unidades - $descuento;
			echo "<br>total:".$total;
			
			$entregado = $_POST['Entregado1'];
			echo "<br>entregado:".$entregado;
			
			$total = $total_item; // hasta que tenga mas de 1 item
			
			$query="SELECT SALDO FROM u192212072_reina.CTAS_CTES WHERE CTA_CTE = ".$_POST['Cta_cte']."AND".$_POST['Usuario']; 
			$resultado=mysqli_query($result_coneccion,$query);
			$qry_saldo=mysqli_fetch_array($resultado, MYSQLI_ASSOC);	
			$saldo = $qry_unidad['SALDO'];
			echo "<br>Saldo:".$saldo;
			$saldo = $saldo + $cobrado;
			echo "<br>Saldo total:".$saldo;	
			
//Insert en VENTAS_CAB 
			
			$query="INSERT INTO u192212072_reina.VENTAS_CAB (VENTA,FECHA,ENTIDAD,MONTO,DESCUENTO,TOTAL,COBRADO,CTA_CTE,USUARIO_CTA_CTE) VALUES(".$venta.",'".$fecha."',".$entidad.",".$monto.",".$descuento.",".$total.",".$cobrado.",".$cta_cte.",".$_POST['Usuario'].")";
			$resultado=mysqli_query($result_coneccion,$query);

//Insert en VENTAS_REN			
			
			$query="INSERT INTO u192212072_reina.VENTAS_REN (`VENTA`, `RENGLON`, `ITEM`, `COD_UNI`, `UNIDADES`, `PRECIO_UNIT`, `DESCUENTO`, `TOTAL`, `ENTREGADO`) VALUES(".$venta.",'".$renglon."',".$item.",1,".$unidades.",".$precio_unit.",0,".$total_item.",'".$entregado."')";
			$resultado=mysqli_query($result_coneccion,$query);
				
//Update de saldo en cta_cte

			$query="UPDATE u192212072_reina.CTAS_CTES SET SALDO = ".$saldo."WHERE  CTA_CTE = ".$_POST['Cta_cte']."AND".$_POST['Usuario'];
			$resultado=mysqli_query($result_coneccion,$query);
			
//Fin insercion
				}
		?>	
		<form action="PRINCIPAL.php" method="post">
		
		<input type ="hidden" name = "Usuario" value = <?php echo $_POST['Usuario']; ?>>
		<input type="submit" value="Cargar otra Venta">
		
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
