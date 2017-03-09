 <html lang="esp">
 <head>
	 <title>PRINCIPAL</title>
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
				echo "FALLO DE CONEXION";
				}{
			//Conexion correcta
				session_start();
				$_SESSION['Usuario']=$_POST['Usuario'];
				$_SESSION['Clave']=$_POST['Clave'];					
			
				
	 /*Pruebas BKP	$sql="SELECT NOMBRE FROM u845291486_reina.USUARIOS WHERE USUARIO=".$_POST[Usuario];
					$result=mysqli_query($result_coneccion,$sql);
					$res_imprimible=mysqli_fetch_array($result, MYSQLI_ASSOC);
					echo $res_imprimible["NOMBRE"];*/
	
	     			$sql="SELECT USUARIO FROM u845291486_reina.USUARIOS WHERE NOMBRE='".$_POST[Usuario]."'"; 
					$result=mysqli_query($result_coneccion,$sql);
					$usuario=mysqli_fetch_array($result, MYSQLI_ASSOC);	
						
					
			//Inicio algoritmo resumen cuentas corrientes
					$query="SELECT DETALLE,SALDO FROM u845291486_reina.CTAS_CTES WHERE USUARIO=".$usuario["USUARIO"];
					$resultado=mysqli_query($result_coneccion,$query);
					echo "Saldos Cuentas corrientes Usuario ".$_POST['Usuario']." son:"."<br><br>";
					
					while ($saldo = mysqli_fetch_assoc($resultado)) {
					echo $saldo["DETALLE"]." : ".$saldo["SALDO"]."<br><br>";	
					}
			//Fin algoritmo resumen cuentas corrientes		
				}

			?>	
	    	      </td><td></td>
	      </tr>
	      <tr><td></td>
		  <td>
			 <p>Carga de VENTA</p>
			 <form action="CIERRE_VENTA.php" method="post">
				<p> Cliente </p>				
				<select name="Entidad">
					<?php 	
						$query="SELECT ENTIDAD,NOMBRE FROM u845291486_reina.ENTIDAD";
						$resultado=mysqli_query($result_coneccion,$query);
						while ($entidad = mysqli_fetch_assoc($resultado)) {
						echo '<option value="'.$entidad["ENTIDAD"].'">'.$entidad["NOMBRE"]."</option>";
						}
					?>				
				</select>
				<br>
				<input type ="hidden" name = "Usuario" value = <?php echo $usuario['USUARIO']; ?>> 
				<p>Items Vendidos</p>
				<select name="Item1">
				<?php 	
						$query="SELECT ITEM,NOMBRE FROM u845291486_reina.ITEMS";
						$resultado=mysqli_query($result_coneccion,$query);
						while ($item = mysqli_fetch_assoc($resultado)) {
						echo '<option value="'.$item["ITEM"].'">'.$item["NOMBRE"]."</option>";
						}
					?>
				</select>
				Unidades : <input type="text" name="Unidades1">   
				Precio : <input type="text" name="Precio_Unit1">
				<input type="checkbox" name="Entregado1" value="S">
				<br>
				

				<select name="Item2">
				<?php 	
						$query="SELECT ITEM,NOMBRE FROM u845291486_reina.ITEMS";
						$resultado=mysqli_query($result_coneccion,$query);
						while ($item = mysqli_fetch_assoc($resultado)) {
						echo '<option value="'.$item["ITEM"].'">'.$item["NOMBRE"]."</option>";
						}
					?>
				</select>	
				Unidades : <input type="text" name="Unidades2">   
				Precio : <input type="text" name="Precio_Unit2">
				<input type="checkbox" name="Entregado2" value="S">
				<br>
				
				<select name="Item3">
				<?php 	
						$query="SELECT ITEM,NOMBRE FROM u845291486_reina.ITEMS";
						$resultado=mysqli_query($result_coneccion,$query);
						while ($item = mysqli_fetch_assoc($resultado)) {
						echo '<option value="'.$item["ITEM"].'">'.$item["NOMBRE"]."</option>";
						}
					?>
				</select>
				Unidades : <input type="text" name="Unidades3">   
				Precio : <input type="text" name="Precio_Unit3">
				<input type="checkbox" name="Entregado3" value="S">
				<br>
				
				<p> Cuenta Corriente Destino </p>				
				<select name="Cta_cte">
					<?php 	
						$query="SELECT CTA_CTE,DETALLE FROM u845291486_reina.CTAS_CTES WHERE USUARIO=".$usuario["USUARIO"];
						$resultado=mysqli_query($result_coneccion,$query);
						while ($cta_cte = mysqli_fetch_assoc($resultado)) {
						echo '<option value="'.$cta_cte["CTA_CTE"].'">'.$cta_cte["DETALLE"]."</option>";
						}
					?>				
				</select>
				<br>
				<p> Monto Cobrado </p>
				<input type="text" name="Cobrado">
				<br><br>
				<input type="submit" value="Ingresar">
			</form>
		  </td>
		  <td></td></tr>
	     </table>
	    </form>
	   <?php
			mysqli_close($result_coneccion);
	   ?> 
	 </body>
 </html>
