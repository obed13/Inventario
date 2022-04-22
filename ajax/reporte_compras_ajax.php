<?php
	session_start();
	/* Connect To Database*/
	require_once ("../config/db.php");
	require_once ("../config/conexion.php");
	require_once ("../libraries/inventory.php");//Contiene funcion que controla stock en el inventario
	//Inicia Control de Permisos
	include("../config/permisos.php");
	$user_id = $_SESSION['user_id'];
$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax'){
	$daterange = mysqli_real_escape_string($con,(strip_tags($_REQUEST['range'], ENT_QUOTES)));
	$purchase_by=intval($_REQUEST['purchase_by']);
	$tables="purchases,  users";
	$campos="*";
	$sWhere="users.user_id=purchases.purchase_by";
	if ($purchase_by>0){
		$sWhere.=" and purchases.purchase_by = '".$purchase_by."'";
	}
	if (!empty($daterange)){
		list ($f_inicio,$f_final)=explode(" - ",$daterange);//Extrae la fecha inicial y la fecha final en formato espa?ol
		list ($dia_inicio,$mes_inicio,$anio_inicio)=explode("/",$f_inicio);//Extrae fecha inicial 
		$fecha_inicial="$anio_inicio-$mes_inicio-$dia_inicio 00:00:00";//Fecha inicial formato ingles
		list($dia_fin,$mes_fin,$anio_fin)=explode("/",$f_final);//Extrae la fecha final
		$fecha_final="$anio_fin-$mes_fin-$dia_fin 23:59:59";
		
		$sWhere .= " and purchases.purchase_date between '$fecha_inicial' and '$fecha_final' ";
	}
	$sWhere.=" order by purchases.purchase_id";
	
	
	include 'pagination.php'; //include pagination file
	//pagination variables
	$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
	$per_page = 10000; //how much records you want to show
	$adjacents  = 4; //gap between pages after number of adjacents
	$offset = ($page - 1) * $per_page;
	//Count the total number of row in your table*/
	$count_query   = mysqli_query($con,"SELECT count(*) AS numrows FROM $tables where $sWhere ");
	if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
	else {echo mysqli_error($con);}
	$total_pages = ceil($numrows/$per_page);
	$reload = './permisos.php';
	//main query to fetch the data
	$query = mysqli_query($con,"SELECT $campos FROM  $tables where $sWhere LIMIT $offset,$per_page");
	//loop through fetched data

	
	if ($numrows>0){

	?>
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header with-border">
				<h3 class="box-title">Listado de Compras</h3>
				</div><!-- /.box-header -->
				<div class="box-body">
				<div class="table-responsive">
					<table class="table table-condensed table-hover table-striped ">
						<tr>
							<th class='text-center'>Compra Nº</th>
							<th>Proveedor</th>
							<th class='text-center'>Fecha </th>
							<th>Usuario </th>
							<th class='text-right'>Neto </th>
							<th class='text-right'>IVA</th>
							<th class='text-right'>Total</th>
						</tr>
						<?php 
						$finales=0;
						while($row = mysqli_fetch_array($query)){	
							$purchase_id=$row['purchase_id'];
							$purchase_order_number=$row['purchase_order_number'];
							
							$date_added=$row['purchase_date'];
							$user_fullname=$row['fullname'];
							$subtotal=$row['subtotal'];
							$tax=$row['tax'];
							$total=$row['total'];
							$supplier_id=$row['supplier_id'];
							$sql_supplier=mysqli_query($con,"select name from suppliers where id='".$supplier_id."'");
							$rw_supplier=mysqli_fetch_array($sql_supplier);
							$supplier_name=$rw_supplier['name'];
							list($date,$hora)=explode(" ",$date_added);
							list($Y,$m,$d)=explode("-",$date);
							$fecha=$d."-".$m."-".$Y;						
							$finales++;
						?>	
						<tr>
							<td class='text-center'><?php echo $purchase_order_number;?></td>
							<td><?php echo $supplier_name;?></td>
							<td class='text-center'><?php echo $fecha;?></td>
							<td><?php echo $user_fullname;?></td>
							<td class='text-right'><?php echo number_format($subtotal,$currency_format['precision_currency'],$currency_format['decimal_separator'],$currency_format['thousand_separator']);?></td>
							<td class='text-right'><?php echo number_format($tax,$currency_format['precision_currency'],$currency_format['decimal_separator'],$currency_format['thousand_separator']);?></td>
							<td class='text-right'><?php echo number_format($total,$currency_format['precision_currency'],$currency_format['decimal_separator'],$currency_format['thousand_separator']);?></td>
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
		  
