 <html lang="esp">
 <head>
	 <title>RESUMEN</title>
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
				session_start();
				$_SESSION['Usuario']=$_POST['Usuario'];
				$_SESSION['Clave']=$_POST['Clave'];					
			
				$sql="SELECT USUARIO FROM u192212072_reina.USUARIOS WHERE NOMBRE='".$_POST[Usuario]."'";
				$result=mysqli_query($result_coneccion,$sql);
				$usuario=mysqli_fetch_array($result, MYSQLI_ASSOC);	
						
			//Inicio algoritmo resumen cuentas corrientes
					$query="SELECT DETALLE,SALDO FROM u192212072_reina.CTAS_CTES WHERE USUARIO=".$usuario["USUARIO"];
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
			
		  </td>
		  <td></td></tr>
	     </table>
	    </form>
	   <?php
			mysqli_close($result_coneccion);
	   ?> 
	 </body>
 </html>
