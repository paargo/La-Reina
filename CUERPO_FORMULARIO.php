<html lang="esp">
 <head>
	 <title>SELECCION DE FORMULARIO</title>
	 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	 <link rel="stylesheet" href="" type="text/css"/>
 </head>
	 <body>
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
/*							$_SESSION['Usuario']=$_POST['Usuario'];
							$_SESSION['Clave']=$_POST['Clave'];					
							
							$sql="SELECT USUARIO FROM u845291486_reina.USUARIOS WHERE NOMBRE='".$_POST[Usuario]."'";
							$result=mysqli_query($result_coneccion,$sql);
							$usuario=mysqli_fetch_array($result, MYSQLI_ASSOC);	*/
						}
		?>
		 <table align='center' valign='middle'>
			<tr>
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
								$query="SELECT NOMBRE_CAMPO,TIPO,PREDETERMINADO,REQUERIDO,MIN,ID_LOV FROM u845291486_reina.RENFORM WHERE ID_FORM=".$_POST['FORMULARIO']." ORDER BY ORDEN";
								$resultado=mysqli_query($result_coneccion,$query);
								while ($form = mysqli_fetch_assoc($resultado)) {
									$requerido='';
									$min=$form["MIN"];
									if ($form["REQUERIDO"] = 'V') {$requerida = 'required';};
									echo $form["NOMBRE_CAMPO"].': ';
									if ($form["TIPO"] == "SELECT") {
										$qry_fin = "SELECT ";
										echo '<select name="'.$form["NOMBRE_CAMPO"].'">';
										
									/*Arma query de seleccion*/
										/*Obtiene campos a seleccionar*/
										$qry_camp = "SELECT OPERACION,ID_TABLA,CAMPO,OPERANDO,ID_TABLA_2,CAMPO2,NOMENCLATURA FROM u845291486_reina.LOV_CAMPOS WHERE ID_LOV =".$form["ID_LOV"]." ORDER BY ORDEN ASC";
										$qry_campos=mysqli_query($result_coneccion,$qry_camp);
										$res_campos = mysqli_fetch_assoc($qry_campos);
												/*Ver en no data found*/
										$qry_fin = $qry_fin.$res_campos["OPERACION"]."(".$res_campos["ID_TABLA"].$res_campos["CAMPO"]." ".$res_campos["OPERANDO"]." ".$res_campos["ID_TABLA_2"].$res_campos["CAMPO2"].") AS ".$res_campos["NOMENCLATURA"].", "."CONCAT(";
										$res_campos = mysqli_fetch_assoc($qry_campos); //FALTA VALIDAR CANTIDAD DE REGISTROS
										$qry_fin = $qry_fin.$res_campos["OPERACION"]."(".$res_campos["ID_TABLA"].$res_campos["CAMPO"]." ".$res_campos["OPERANDO"]." ".$res_campos["ID_TABLA_2"].$res_campos["CAMPO2"].") ";
										while ($res_campos = mysqli_fetch_assoc($qry_campos)){
											$qry_fin = $qry_fin.","."' - ',";										
											$qry_fin = $qry_fin.$res_campos["OPERACION"]."(".$res_campos["ID_TABLA"].$res_campos["CAMPO"]." ".$res_campos["OPERANDO"]." ".$res_campos["ID_TABLA_2"].$res_campos["CAMPO2"].") ";
										};
										/*Fin Obtiene campos a seleccionar*/									
										/*Obtiene tablas de los campos a seleccionar*/
										$qry_fin = $qry_fin.") AS DETALLE FROM ";
										$qry_tabla_lov = "SELECT B.OWNER, B.NOMBRE, A.ID_TABLA, B.ID_PARA_TABLA FROM u845291486_reina.LOV_TABLAS A, u845291486_reina.TABLAS_QRY B WHERE A.ID_TABLA = B.ID_TABLA AND A.ID_LOV =".$form["ID_LOV"];
										$qry_tablas=mysqli_query($result_coneccion,$qry_tabla_lov);
										$res_tablas = mysqli_fetch_assoc($qry_tablas);
												/*Ver en no data found*/
										$qry_fin = $qry_fin.$res_tablas["OWNER"].".".$res_tablas["NOMBRE"]." ".$res_tablas["ID_PARA_TABLA"];

										while ($res_tablas = mysqli_fetch_assoc($qry_tablas)){
											$qry_fin = $qry_fin.", ";										
											$qry_fin = $qry_fin.$res_tablas["OWNER"].".".$res_tablas["NOMBRE"]." ".$res_tablas["ID_PARA_TABLA"];
										};
										/*Fin obtiene tablas de los campos a seleccionar*/
										/*Obtiene clausulas a seleccionar*/
										$qry_fin = $qry_fin." WHERE ";
										$qry_camp = "SELECT ID_TABLA_1,CAMPO_1,OPERADOR,ID_TABLA_2,CAMPO_2,VALOR_FIJO_INT,VALOR_FIJO_CHAR,VALOR_FIJO_DATE FROM u845291486_reina.LOV_CLAUSULAS WHERE ID_LOV =".$form["ID_LOV"];
										$qry_campos=mysqli_query($result_coneccion,$qry_camp);
										$res_campos = mysqli_fetch_assoc($qry_campos);
												/*Ver en no data found*/
										$qry_fin = $qry_fin.$res_campos["ID_TABLA_1"].$res_campos["CAMPO_1"].$res_campos["OPERADOR"].$res_campos["ID_TABLA_2"].$res_campos["CAMPO_2"].$res_campos["VALOR_FIJO_INT"].$res_campos["VALOR_FIJO_CHAR"].$res_campos["VALOR_FIJO_DATE"];
										while ($res_campos = mysqli_fetch_assoc($qry_campos)){
											$qry_fin = $qry_fin." AND ";										
											$qry_fin = $qry_fin.$res_campos["ID_TABLA_1"].$res_campos["CAMPO_1"].$res_campos["OPERADOR"].$res_campos["ID_TABLA_2"].$res_campos["CAMPO_2"].$res_campos["VALOR_FIJO_INT"].$res_campos["VALOR_FIJO_CHAR"].$res_campos["VALOR_FIJO_DATE"];
										};
										/*Fin Obtiene clausulas a seleccionar*/				
										
										/*ORDEN MOMENTANEO*/
										$qry_fin = $qry_fin." ORDER BY DETALLE";
										echo $qry_fin;
										
										$qry_res_fin=mysqli_query($result_coneccion,$qry_fin);
										while ($seleccion = mysqli_fetch_assoc($qry_res_fin)) {
											$valor = $seleccion["COD"];
											$desc = $seleccion["DETALLE"];
											echo '<option value="'.$valor.'">'.$desc."</option>"; 	
										};
										echo '</select>';
									}	
									else {
										echo '<input type = "'.$form["TIPO"].'" name="'.$form["NOMBRE_CAMPO"].'"'.$requerida.' min="'.$min.'"'.'>'; 
									};
									echo '<br><br>';
									echo $_POST['ID_FORM'];
								}
							?>		
						</p>	
						<br>
					<!--	<input type ="hidden" name = "Usuario" value = <?php echo $usuario['USUARIO']; ?>> -->
						<p align="center">
							<input type="submit" value="Ingresar">
							<input type="reset" value="Cancelar">
						</p>
					</form>
					<br><br>
					<form action="SELECCION_FORMULARIO.php" method="post">
					<!--	<input type ="hidden" name = "Usuario" value = <?php echo $_POST['Usuario']; ?> > -->
						<input type="submit" value="Volver a la seleccion de Formulario">
					</form>
				</td>
			</tr>
		 </table>
		   <?php
				mysqli_close($result_coneccion);
		   ?> 
	 </body>
 </html>