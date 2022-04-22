<?php
	session_start();
	/* Connect To Database*/
	require_once ("../config/db.php");
	require_once ("../config/conexion.php");
	require_once ("../libraries/inventory.php");//Contiene funcion que controla stock en el inventario
	//Inicia Control de Permisos
	include("../config/permisos.php");
	$user_id = $_SESSION['user_id'];
	get_cadena($user_id);
	$modulo="Ventas";
	permisos($modulo,$cadena_permisos);
	//Finaliza Control de Permisos
	if (isset($_REQUEST["id"])){//codigo para eliminar 
	$id=$_REQUEST["id"];
	$sale_id=intval($id);
	if ($permisos_eliminar==1){//Si cuenta por los permisos bien
	$sql=mysqli_query($con, "select * from products, sale_product where products.product_id=sale_product.product_id and sale_product.sale_id='$sale_id'");
	while ($rw=mysqli_fetch_array($sql)){
		$sale_product_id=$rw['sale_product_id'];
		$product_id=$rw['product_id'];
		$qty=$rw['qty'];
		// Inicio Kardex
			$note="Eliminar venta";
			$type=1;
			$stock=get_stock($product_id);
			$stock_total=$stock+$qty;
			$last_cost=last_cost($product_id);
			$sale_date=date("Y-m-d H:i:s");
			register_kardex($sale_date, $product_id, $qty, $last_cost,$last_cost, $stock_total, $note, $type );
		// Fin Kardex
		add_inventory($product_id,$qty);//Regresa los productos al inventario
		$delete1=mysqli_query($con,"delete from sale_product where sale_product_id='".$sale_product_id."'");//Elimina el item de la tabla sale_product
	}
	if($delete=mysqli_query($con, "DELETE FROM sales WHERE sale_id='".$sale_id."'") ){
				$aviso="Bien hecho!";
				$msj="Datos eliminados satisfactoriamente.";
				$classM="alert alert-success";
				$times="&times;";	
			}else{
				$aviso="Aviso!";
				$msj="Error al eliminar los datos ".mysqli_error($con);
				$classM="alert alert-error";
				$times="&times;";					
			}
		
		
	} else {//No cuenta con los permisos
		$aviso="Acceso denegado!";
		$msj="No cuentas con los permisos necesario para acceder a este m?dulo.";
		$classM="alert alert-error";
		$times="&times;";
	}
}
$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax'){
	$query = mysqli_real_escape_string($con,(strip_tags($_REQUEST['query'], ENT_QUOTES)));
	$customer_id=intval($_REQUEST['customer_id']);
	$tables="sales, users";
	$campos="*";
	$sWhere="users.user_id=sales.sale_by";
	$sWhere.=" and sales.sale_number LIKE '%".$query."%'";
	$sWhere.=" and sales.total >0";
	if ($customer_id>0){
		$sWhere.=" and sales.customer_id='$customer_id'";
	}
		
	$sWhere.=" order by sales.sale_id desc";
	
	
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
	$reload = './permisos.php';
	//main query to fetch the data
	$query = mysqli_query($con,"SELECT $campos FROM  $tables where $sWhere LIMIT $offset,$per_page");
	//loop through fetched data
	
	if (isset($_REQUEST["id"])){
	?>
			<div class="<?php echo $classM;?>">
				<button type="button" class="close" data-dismiss="alert"><?php echo $times;?></button>
				<strong><?php echo $aviso?> </strong>
				<?php echo $msj;?>
			</div>	
	<?php
		}
	
	if ($numrows>0){

	?>
	
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header with-border">
				<h3 class="box-title">Listado de Ventas</h3>
				</div><!-- /.box-header -->
				<div class="box-body">
				<div class="table-responsive">
					<table class="table table-condensed table-hover table-striped ">
						<tr>
							<th class='text-center'>Factura Nº</th>
							<th>Cliente</th>
							<th class='text-center'>Fecha </th>
							<th>Vendedor </th>
							<th class='text-right'>Neto </th>
							<th class='text-right'>IVA</th>
							<th class='text-right'>Total</th>
							
							<th></th>
						</tr>
						<?php 
						$finales=0;
						while($row = mysqli_fetch_array($query)){	
							$sale_id=$row['sale_id'];
							$sale_number=$row['sale_number'];
							$customer_id=$row['customer_id'];
							$sql_customer=mysqli_query($con,"select name from customers where id='".$customer_id."'");
							$rw_customer=mysqli_fetch_array($sql_customer);
							$customer_name=$rw_customer['name'];
							
							$date_added=$row['sale_date'];
							$user_fullname=$row['fullname'];
							$subtotal=$row['subtotal'];
							$tax=$row['tax'];
							$total=$row['total'];
							list($date,$hora)=explode(" ",$date_added);
							list($Y,$m,$d)=explode("-",$date);
							$fecha=$d."-".$m."-".$Y;						
							$finales++;
						?>	
						<tr>
							<td class='text-center'><?php echo $sale_number;?></td>
							<td><?php echo $customer_name;?></td>
							<td class='text-center'><?php echo $fecha;?></td>
							<td><?php echo $user_fullname;?></td>
							<td class='text-right'><?php echo number_format($subtotal,$currency_format['precision_currency'],$currency_format['decimal_separator'],$currency_format['thousand_separator']);?></td>
							<td class='text-right'><?php echo number_format($tax,$currency_format['precision_currency'],$currency_format['decimal_separator'],$currency_format['thousand_separator']);?></td>
							<td class='text-right'><?php echo number_format($total,$currency_format['precision_currency'],$currency_format['decimal_separator'],$currency_format['thousand_separator']);?></td>
							
							
							<td>
							<div class="btn-group pull-right">
									<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Acciones <span class="fa fa-caret-down"></span></button>
								<ul class="dropdown-menu">
									<?php if ($permisos_editar==1){?>
									<li><a href="edit_sale.php?id=<?php echo $sale_id;?>"><i class='fa fa-edit'></i> Editar</a></li>
									<?php }
									if ($permisos_ver==1){
										?>
									<li><a href="#" onclick="view_pdf('<?php echo $sale_id;?>');"><i class='fa fa-file-pdf-o'></i> Ver PDF</a></li>	
										<?php
									}
									if ($permisos_eliminar==1){
									?>
									<li><a href="#" onclick="eliminar('<?php echo $sale_id;?>')"><i class='fa fa-trash'></i> Borrar</a></li>
									<?php }?>
								</ul>
							</div><!-- /btn-group -->
                    		</td>
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
		  
