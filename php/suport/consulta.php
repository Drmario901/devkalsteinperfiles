<?php
require_once("conexion.php");


include 'translateText.php';
translateText();


$conexion=mysqli_connect($servidor, $usuario, $contraseña);
if (mysqli_connect_errno()) {
	echo "Conexion fallida";
}
mysqli_select_db($conexion, $bd_nombre);
$consulta="SELECT * FROM wp_reportes";
$producto=mysqli_query($conexion, $consulta);
while($fila=mysqli_fetch_row($producto)){ 
    echo "<tr>";
    echo "<td>" . $fila[0] . "</td>";
	echo "<td>" . $fila[1] . "</td>";
	echo "<td>" . $fila[2] . "</td>";
	echo "<td>" . $fila[3] . "</td>";
	echo "<td>" . $fila[4] . "</td>";
	echo "<td>" . $fila[5] . "</td>";
	echo "<td>" . $fila[6] . "</td>";
	echo "<td>" . $fila[7] . "</td>";
   echo '<td><a href="#" class="btn btn-sm btn-primary button" data-i17n="client:eligeOpcion"  >Vista</a></td>
   </tr>';
}
mysqli_close($conexion);
?>