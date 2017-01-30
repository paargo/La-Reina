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
					$query_cab="SELECT NOMBRE,ACCION,METHOD FROM u845291486_reina.CABFORM WHERE ID_FORM=".$_POST['FORMULARIO'];
					$resultado_cab=mysqli_query($result_coneccion,$query_cab);
					$form_cab = mysqli_fetch_array($resultado_cab, MYSQLI_ASSOC);	
				?>		
				<form <?php echo 'action='.'"'.$form_cab["ACCION"].'" '.'method='.'"'.$form_cab["METHOD"].'"'?>> 
					<p> FORMULARIO <?php echo $form_cab["NOMBRE"]?> </p> 			
					<p align="right">
						<?php 	
							$query="SELECT NOMBRE_CAMPO,TIPO,PREDETERMINADO,REQUERIDO,ID_LOV FROM u845291486_reina.RENFORM WHERE ID_FORM=".$_POST['FORMULARIO']." ORDER BY ORDEN";
							$resultado=mysqli_query($result_coneccion,$query);
							while ($form = mysqli_fetch_assoc($resultado)) {
								$requerido='';
								if ($form["REQUERIDO"] = 'V') {$requerida = 'required';};
								echo $form["NOMBRE_CAMPO"].': ';
								if ($form["TIPO"] == "SELECT") {
									$qry_fin = "SELECT ";
									echo '<select name="'.$form["NOMBRE_CAMPO"].'">';
									
								/*Arma query de seleccion*/
									
									/*Obtiene campos a seleccionar*/
									$qry_camp = "SELECT CAMPO FROM u845291486_reina.LOV_CAMPOS WHERE ID_LOV =".$form["ID_LOV"];
									$qry_campos=mysqli_query($result_coneccion,$qry_camp);
									$res_campos = mysqli_fetch_assoc($qry_campos);
											/*Ver en no data found*/
									$qry_fin = $qry_fin.$res_campos["CAMPO"];
									while ($res_campos = mysqli_fetch_assoc($qry_campos)){
										$qry_fin = $qry_fin.", ";										
										$qry_fin = $qry_fin.$res_campos["CAMPO"];
									};
									/*Fin Obtiene campos a seleccionar*/									
									
									/*Obtiene tablas de los campos a seleccionar*/
									$qry_fin = $qry_fin." FROM ";
									
									$qry_tabla_lov = "SELECT B.OWNER, B.NOMBRE, A.ID_TABLA FROM LOV_TABLAS A, TABLAS_QRY B WHERE A.ID_TABLA = B.ID_TABLA A.ID_LOV =".$form["ID_LOV"];
									$qry_tablas=mysqli_query($result_coneccion,$qry_tabla_lov);
									$res_tablas = mysqli_fetch_assoc($qry_tablas);
											/*Ver en no data found*/
									$qry_fin = $qry_fin.$res_tablas["OWNER"].".".$res_tablas["NOMBRE"]." ".$res_tablas["ID_TABLA"];
									while ($res_campos = mysqli_fetch_assoc($qry_tablas)){
										$qry_fin = $qry_fin.", ";										
										$qry_fin = $qry_fin.$res_tablas["OWNER"].".".$res_tablas["NOMBRE"]." ".$res_tablas["ID_TABLA"];
									};
									/*Fin obtiene tablas de los campos a seleccionar*/
									
									$qry_fin = $qry_fin." WHERE ";
				
				
									$qry_res_fin=mysqli_query($result_coneccion,$qry_fin);
									while ($seleccion = mysqli_fetch_assoc($qry_res_fin)) {
									
									/*	$valor = ;
										$desc = ;*/
										echo '<option value="'.$valor.'">'.$desc."</option>"; 	
									
									echo '</select>';
									};
								}	
								else {
									echo '<input type = "'.$form["TIPO"].'" name="'.$form["NOMBRE_CAMPO"].'"'.$requerida.'>'; 
								};
								echo '<br><br>';
								echo $_POST['ID_FORM'];
								
							}
						?>		
					</p>	
					<br>
					<input type ="hidden" name = "Usuario" value = <?php echo $usuario['USUARIO']; ?>> 
					<br><br>
					<input type="submit" value="Ingresar">
					<input type="reset" value="Cancelar">
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