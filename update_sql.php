<?php 
require_once("config/db.php");
/* Connect To Database*/
require_once ("config/conexion.php");
$sql="ALTER TABLE `purchases` ADD `tax_value` FLOAT(5,2) NOT NULL AFTER `purchase_date`;";
$query=mysqli_query($con,$sql);
if ($query){
	echo "<p>Tabla compras actualizada.</p>";
}
$sql="ALTER TABLE `sales` ADD `tax_value` FLOAT(5,2) NOT NULL AFTER `sale_date`;";
$query=mysqli_query($con,$sql);
if ($query){
	echo "<p>Tabla ventas actualizada.</p>";
}
$sql="CREATE TABLE `taxes` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `value` float(4,2) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
";
$query=mysqli_query($con,$sql);
if ($query){
	echo "<p>Tabla impuestos creada.</p>";
}
$sql="INSERT INTO `taxes` (`id`, `name`, `value`, `status`) VALUES(1, 'IVA', 10.00, 1);";
$query=mysqli_query($con,$sql);
if ($query){
	echo "<p>Datos ingresados a impuestos.</p>";
}
$sql="ALTER TABLE `taxes` ADD PRIMARY KEY (`id`);";
$query=mysqli_query($con,$sql);
if ($query){
	echo "<p>Llave primaria creada.</p>";
}
$sql="ALTER TABLE `taxes` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;";
$query=mysqli_query($con,$sql);
if ($query){
	echo "<p>Llave primaria modificada.</p>";
}

$sql="ALTER TABLE `products` CHANGE `profit` `profit` DOUBLE NOT NULL;";
$query=mysqli_query($con,$sql);
if ($query){
	echo "<p>Campo profit de la tabla productos modificado.</p>";
}
?>