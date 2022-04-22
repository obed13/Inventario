<?php 
session_start();
/* Connect To Database*/
require_once ("../config/db.php");
require_once ("../config/conexion.php");
require_once ("../libraries/inventory.php");//Contiene funcion que controla stock en el inventario

header("Pragma: public");
header("Expires: 0");
$filename = "Reporte_anual.xls";
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");


$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'excel'){
$fecha_inicio   = mysqli_real_escape_string($con,(strip_tags($_REQUEST['fecha_inicio'], ENT_QUOTES)));
$fecha_fin      = mysqli_real_escape_string($con,(strip_tags($_REQUEST['fecha_fin'], ENT_QUOTES)));
$tables="inventario";
$campos="inventario.id, inventario.codigo, inventario.nombre, inventario.descripcion,inventario.ubucacion,inventario.categoria,inventario.ordenCompra,inventario.costo,inventario.date";
$sWhere=" DATE_FORMAT(inventario.date , '%d-%m-%Y')  BETWEEN DATE_FORMAT('$fecha_inicio' , '%d-%m-%Y') AND DATE_FORMAT('$fecha_fin' , '%d-%m-%Y') ";
$sWhere.=" order by inventario.codigo DESC";

$query = mysqli_query($con,"SELECT $campos FROM  $tables where $sWhere");
?>
<table class="table table-condensed table-hover table-striped ">
    <tr>
        <th colspan="4">Reporte de Inventario Anual</th>
    </tr>
    <tr>
        <th>Código</th>
        <th>Empleado </th>
        <th>Descripción</th>
        <th>Ubicacion</th>
        <th>Inventario</th>
    </tr>
    <?php 
    $finales=0;
    while($row = mysqli_fetch_array($query)){	
        $product_id=$row['id'];
        $product_code=$row['codigo'];
        $manufacturer_name=$row["nombre"];
        $note=$row['descripcion'];
        $categoria_name=$row['categoria'];
        $date=$row['date'];
        $ubicacion=$row['ubucacion'];
    
        $finales++;
    ?>	
    <tr>
        <td><?php echo $product_code;?></td>
        <td><?php echo $manufacturer_name;?></td> 
        <td><?php echo $note;?></td>
        <td><?php echo $ubicacion;?></td>
        <td><?php echo $date;?></td>
    </tr>
    <?php }?>		
</table>
<?php } ?>