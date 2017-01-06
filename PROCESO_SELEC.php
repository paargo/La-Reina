 <html lang="esp">
 <head>
	 <title>SELECCION DE FORMULARIO</title>
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
	      </td><td></td>
	      </tr>
	      <tr><td></td>
		  <td>
			 <form action=<?php echo '"'.$_POST["ACCION"].'"'; ?> method= <?php echo '"'.$_POST["METHOD"].'"'; ?>>
				<input type ="hidden" name = "Usuario" value = <?php echo $usuario['USUARIO']; ?>> 
			</form>
			<meta http-equiv="Refresh" content="0;url=<?php echo '"'.$_POST["ACCION"].'"'; ?>">
		  </td>
		  <td></td></tr>
	     </table>
	    </form>
	   <?php
			mysqli_close($result_coneccion);
	   ?> 
	 </body>
 </html>
