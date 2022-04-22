<?php
	session_start();
	/* Connect To Database*/
	require_once ("../config/db.php");
	require_once ("../config/conexion.php");
	require_once ("../libraries/inventory.php");//Contiene funcion que controla stock en el inventario
$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax'){
	$query = mysqli_real_escape_string($con,(strip_tags($_REQUEST['query'], ENT_QUOTES)));
	$product_code = mysqli_real_escape_string($con,(strip_tags($_REQUEST['product_code'], ENT_QUOTES)));
	$manufacturer_id=intval($_REQUEST['manufacturer_id']);
	$tables="products, manufacturers, categoria";
	$campos="products.product_id, products.product_code, products.product_name, products.note, products.status, products.buying_price, manufacturers.name as empleado, categoria.name";
	$sWhere="products.manufacturer_id=manufacturers.id AND products.categoria_id=categoria.id";
	$sWhere.=" and products.product_name LIKE '%".$query."%'";
	if (!empty($product_code)){
		$sWhere.=" and products.product_code LIKE '%".$product_code."%'";
	}
	if ($manufacturer_id>0){
		$sWhere.=" and products.manufacturer_id = '".$manufacturer_id."'";
	}
	$sWhere.=" order by products.product_code DESC";
	
	
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
				<h3 class="box-title">Reporte por Fecha</h3>
				</div><!-- /.box-header -->
				<div class="box-body">
				<div class="table-responsive">
					<table class="table table-condensed table-hover table-striped ">
						<tr>
							<th class='text-center'>Código</th>
							<th>Empleado </th>
							<th>Descripción</th>
							<th>Categoria</th>
							<th class='text-center'>Estatus</th>
							<th class='text-right'>Costo</th>
							
							
						</tr>
						<?php 
						$finales=0;
						while($row = mysqli_fetch_array($query)){	
							$product_id=$row['product_id'];
							$product_code=$row['product_code'];
							$manufacturer_name=$row["empleado"];
							$note=$row['note'];
							$categoria_name=$row['name'];
							$buying_price=$row['buying_price'];
							$status=$row['status'];
							$buying_price=number_format($buying_price,$currency_format['precision_currency'],'.','');
							
							if ($status==1){

								$lbl_status="Alta";

								$lbl_class='label label-success';

							}elseif ($status==3){

								$lbl_status="Prestamo";

								$lbl_class='label label-warning';

							}elseif ($status==2){

								$lbl_status="Traspaso";

								$lbl_class='label label-default';

							}elseif ($status==4){

								$lbl_status="No Inventariables";

								$lbl_class='label label-default';

							}else {

								$lbl_status="Baja";

								$lbl_class='label label-danger';

							}	

							$finales++;
						?>	
						<tr>
							<td class='text-center'><?php echo $product_code;?></td>
							<td><?php echo $manufacturer_name;?></td> 
							<td><?php echo $note;?></td>
							<td><?php echo $categoria_name;?></td>
							<td class='text-center <?php echo $lbl_class;?>'><?php echo $lbl_status;?></td>
							<td class='text-right'><?php echo number_format($buying_price,$currency_format['precision_currency'],$currency_format['decimal_separator'],$currency_format['thousand_separator']);?></td>
							
							
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
		  
