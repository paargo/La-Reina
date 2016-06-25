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
			<table  align='center' valign='middle' border=1>
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
					echo "<tr><td>";
					
					//Nombre cliente
					//Fecha
					//Venta
					//Item
					//Monto
					//Descuento
					//Total
					
					//Movimientos por cuenta corriente Ingresos
					//Desde
					//Fecha
					//Concepto
					//Monto
					
					//Movimientos por cuenta corriente Egresos
					//Hasta
					//Fecha
					//Concepto
					//Monto
					
					//Saldos diferenciados por concepto
					
					//SALDOS (Pagina derecha)
					//Saldo cta cte (monto neto)
					//Total Ventas
					//Total Gastos
					//Total Egresos 
					//Total Ingresos 
					
					echo "</tr>";

					}
				?>	
			</table>		
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
