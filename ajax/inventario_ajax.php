<?php
	session_start();
	/* Connect To Database*/
	require_once ("../config/db.php");
	require_once ("../config/conexion.php");
	require_once ("../libraries/inventory.php");//Contiene funcion que controla stock en el inventario
$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax'){
	$product_code = mysqli_real_escape_string($con,(strip_tags($_REQUEST['product_code'], ENT_QUOTES)));
	//$manufacturer_id=intval($_REQUEST['manufacturer_id']);
	if(strlen($product_code)>1){

		$tables="products, manufacturers, categoria, ubicacion";
		$campos="products.product_id, products.product_code, products.product_name, products.note, products.status, products.buying_price, manufacturers.name as empleado, categoria.name,ubicacion.name as ubicacion_name";
		$sWhere="products.manufacturer_id=manufacturers.id AND products.categoria_id=categoria.id AND products.ubicaciones_id=ubicacion.id AND products.product_code =".$product_code."";
		$sWhere.=" order by products.product_code DESC";

	include 'pagination.php'; //include pagination file
	//pagination variables
	$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
	$per_page = intval($_REQUEST['per_page']); //how much records you want to show
	$adjacents  = 4; //gap between pages after number of adjacents
	$offset = ($page - 1) * $per_page;
	//Count the total number of row in your table/
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
				<h3 class="box-title">Listado de Artículos</h3>
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
							<th class='text-center'>Accion</th>
						</tr>
						<?php 
						$finales=0;
						while($row = mysqli_fetch_array($query)){	
							$product_id=$row['product_id'];
							$product_code=$row['product_code'];
							$manufacturer_name=$row["empleado"];
							$note=$row['note'];
							$categoria_name=$row['name'];
							$status=$row['status'];
                            $ubicacion=$row['ubicacion_name'];
													
							$finales++;
						?>	
						<tr>
							<td class='text-center'><?php echo $product_code;?></td>
							<td><?php echo $manufacturer_name;?></td> 
							<td><?php echo $note;?></td>
							<td><?php echo $ubicacion;?></td>
							<td class='text-center'>2021</td>
							<td align="center"><a href="ajax/registro/agregar_inventory.php?product_code=<?php echo $product_code; ?>" class="btn btn-primary"><i class='fa fa-floppy-o'></i> Guardar</a></td>
						</tr>
						<?php } ?>		
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
}else{
	echo "No hay Resultado.";
}
}
?>