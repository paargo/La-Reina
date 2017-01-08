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
				<?php 	
					$query_cab="SELECT NOMBRE,ACCION FROM u845291486_reina.CABFORM WHERE ID_FORM=".$_POST['FORMULARIO'];
					$resultado_cab=mysqli_query($result_coneccion,$query_cab);
					$form_cab = mysqli_fetch_array($resultado_cab, MYSQLI_ASSOC);	
				?>		
			
				<form <?php echo 'action='.'"'.$form_cab["accion"].'"'.'method='.'"'.$form_cab["accion"].'"'.'>'?> 
					<p> FORMULARIO <?php echo $form_cab["NOMBRE"]?> </p> 			
					<p align="right">
						<?php 	
							$query="SELECT NOMBRE_CAMPO,TIPO,PREDETERMINADO FROM u845291486_reina.RENFORM WHERE ID_FORM=".$_POST['FORMULARIO'];
							$resultado=mysqli_query($result_coneccion,$query);
							/*echo $_POST['NOMBRE'].'<br><br>';*/
							while ($form = mysqli_fetch_assoc($resultado)) {
								echo $form["NOMBRE_CAMPO"].': ';
								echo '<input type = "'.$form["TIPO"].'" name="'.$form["NOMBRE_CAMPO"].'">'; 
								echo '<br><br>';
								echo $_POST['ID_FORM'];
							}
						?>		
					</p>	
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