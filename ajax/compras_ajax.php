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
	$modulo="Compras";
	permisos($modulo,$cadena_permisos);
	//Finaliza Control de Permisos
	if (isset($_REQUEST["id"])){//codigo para eliminar 
	$id=$_REQUEST["id"];
	$purchase_id=intval($id);
	if ($permisos_eliminar==1){//Si cuenta por los permisos bien
	$sql=mysqli_query($con, "select * from products, purchase_product where products.product_id=purchase_product.product_id and purchase_product.purchase_id='$purchase_id'");
	while ($rw=mysqli_fetch_array($sql)){
		$purchase_product_id=$rw['purchase_product_id'];
		$product_id=$rw['product_id'];
		$qty=$rw['qty'];
		//Inicio Kardex
		$unit_price=get_id('purchase_product','unit_price','purchase_product_id',$purchase_product_id);
		$costo_promedio=average_cost_min($product_id, $qty, $unit_price);//Obtengo el costo promedio
		$note="Eliminar item de compra";
		$type=2;
		$stock=get_stock($product_id);
		$stock_total=$stock-$qty;
		$date_added=date("Y-m-d H:i:s");
		register_kardex($date_added, $product_id, $qty, $costo_promedio, $unit_price, $stock_total,$note, $type );//Registro datos en la tabla Kardex
		//Fin Kardex	
			
		remove_inventory($product_id,$qty);//Regresa los productos al inventario
		$delete1=mysqli_query($con,"delete from purchase_product where purchase_product_id='".$purchase_product_id."'");//Elimina el item de la tabla purchase_product
	}
	if($delete=mysqli_query($con, "DELETE FROM purchases WHERE purchase_id='".$purchase_id."'") ){
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
	$supplier_id=intval($_REQUEST['supplier_id']);
	$tables="purchases,  users";
	$campos="*";
	$sWhere="users.user_id=purchases.purchase_by";
	$sWhere.=" and purchases.purchase_order_number LIKE '%".$query."%'";
	if ($supplier_id>0){
		$sWhere.=" and purchases.supplier_id='$supplier_id'";
	}
	$sWhere.=" order by purchases.purchase_id desc";
	
	
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
							
							<th></th>
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
							
							
							<td>
							
						<div class="btn-group pull-right">
									<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Acciones <span class="fa fa-caret-down"></span></button>
								<ul class="dropdown-menu">
									<?php if ($permisos_editar==1){?>
									<li><a href="edit_purchase.php?id=<?php echo $purchase_id;?>"><i class='fa fa-edit'></i> Editar</a></li>
									<?php }
									if ($permisos_eliminar==1){
									?>
									<li><a href="#" onclick="eliminar('<?php echo $purchase_id;?>')"><i class='fa fa-trash'></i> Borrar</a></li>
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
		  
