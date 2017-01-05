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
				<form action="CIERRE_PEDIDO.php" method="post">
					<p> FORMULARIO </p>				
						<?php 	
							$query="SELECT NOMBRE_CAMPO,TIPO,PREDETERMINADO FROM u845291486_reina.RENFORM WHERE ID_FORM=1";
							/*$_POST['ID_FORM']*/
							$resultado=mysqli_query($result_coneccion,$query);
							while ($form = mysqli_fetch_assoc($resultado)) {
								echo '<input type = "'.$form["TIPO"].'" name="'.$form["NOMBRE_CAMPO"].'">'; 
							/*<input type="TEXT" name="CANTIDAD">*/
	/*						echo '<input type = "'.$form["TIPO"].'" name="'."$form["NOMBRE_CAMPO"]".'>'; */
							echo '<br> entra 1 <br>';
							}
						?>				
					<br>
					<input type ="hidden" name = "Usuario" value = <?php echo $usuario['USUARIO']; ?>> 
					<br><br>
					<input type="submit" value="Ingresar">
				</form>
			</td>
			<td></td>
		</tr>
	 </table>
	   <?php
			mysqli_close($result_coneccion);
	   ?> 
	 </body>
 </html>