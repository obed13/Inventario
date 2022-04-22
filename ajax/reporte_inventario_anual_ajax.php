<?php
	session_start();
	/* Connect To Database*/
	require_once ("../config/db.php");
	require_once ("../config/conexion.php");
	require_once ("../libraries/inventory.php");//Contiene funcion que controla stock en el inventario
$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax'){
	$fecha_inicio   = mysqli_real_escape_string($con,(strip_tags($_REQUEST['fecha_inicio'], ENT_QUOTES)));
	$fecha_fin      = mysqli_real_escape_string($con,(strip_tags($_REQUEST['fecha_fin'], ENT_QUOTES)));
	$tables="inventario";
	$campos="inventario.id, inventario.codigo, inventario.nombre, inventario.descripcion,inventario.ubucacion,inventario.categoria,inventario.ordenCompra,inventario.costo,inventario.date";
	$sWhere=" DATE(inventario.date)  BETWEEN '$fecha_inicio' AND '$fecha_fin' ";
	$sWhere.=" order by inventario.codigo DESC";
	
	include 'pagination.php'; //include pagination file
	//pagination variables
	$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
	$per_page = intval($_REQUEST['per_page']); //how much records you want to show
	$adjacents  = 4; //gap between pages after number of adjacents
	$offset = ($page - 1) * $per_page;
	//Count the total number of row in your table*/
	$count_query   = mysqli_query($con,"SELECT count(*) AS numrows FROM $tables where $sWhere ");
	if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
	else {echo mysqli_error($con);}
	$total_pages = ceil($numrows/$per_page);
	$reload = './inventory_report.php';
	//main query to fetch the data
	$query = mysqli_query($con,"SELECT $campos FROM  $tables where $sWhere LIMIT $offset,$per_page");
	//loop through fetched data

	
	if ($numrows>0){

	?>
	
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header with-border">
				<h3 class="box-title">Reporte de Inventario Anual</h3>
				</div><!-- /.box-header -->
				<div class="box-body">
				<div class="table-responsive">
					<table class="table table-condensed table-hover table-striped ">
						<tr>
							<th class='text-center'>Código</th>
							<th>Empleado </th>
							<th>Descripción</th>
							<th>Ubicacion</th>
							<th class='text-center'>Inventario</th>
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
							<td class='text-center'><?php echo $product_code;?></td>
							<td><?php echo $manufacturer_name;?></td> 
							<td><?php echo $note;?></td>
							<td><?php echo $ubicacion;?></td>
							<td class='text-center'><?php echo $date;?></td>
						</tr>
						<?php }?>		
					</table>
				</div>	
				</div><!-- /.box-body -->
				<div class="box-footer clearfix">
				
				<?php 
				$inicios=$offset+1;
				$finales+=$inicios -1;
				echo "Mostrando $inicios al $finales de $numrows registros";
				echo paginate($reload, $page, $total_pages, $adjacents);?>
					
				</div>
			</div><!-- /.box -->
		</div><!-- /.col -->
	</div><!-- /.row -->	
	<?php	
	}	
}
?>          
		  
