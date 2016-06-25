 <html lang="esp">
 <head>
	 <title>PRINCIPAL</title>
	 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	 <link rel="stylesheet" href="" type="text/css"/>
 </head>
 	 <body>
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
				}
		?>
		
  	 <table align='center' valign='middle'>
  	 <tr><td></td><td></td><td></td></tr>
  	 <tr>
  	   <td></td><td>
	   
		<iframe src="PRINCIPAL.php" frameborder = 1 scrolling = "auto" align ='center' height=800 width=800 name="PRINCIPAL">
			No se encuentra la información a mostrar.
		</iframe>

	   </td>
	   <td>
	   <iframe src="RESUMEN.php" frameborder = 1 scrolling = "auto" align ='center' height=800 width=300>
			No se encuentra la información a mostrar.
		</iframe>
	   </td>
	      </tr>
	      <tr>
		  <td></td>
		  <td></td>
		  <td></td>
		  </tr>
	     </table>

	 </body>
 
 
	 <body>

	 </body>
 </html>
