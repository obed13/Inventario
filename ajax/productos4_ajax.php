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
	$modulo="Productos";
	permisos($modulo,$cadena_permisos);
	//Finaliza Control de Permisos
	if (isset($_REQUEST["id"])){//codigo para eliminar 
	$id=$_REQUEST["id"];
	$id=intval($id);
	if ($permisos_eliminar==1){//Si cuenta por los permisos bien
	$query_validate=mysqli_query($con,"select product_id from inventory where product_id='".$id."'");
	$count=mysqli_num_rows($query_validate);
	
	if ($count==0){
		if($delete=mysqli_query($con, "DELETE FROM products WHERE product_id='$id'") ){
				$aviso="Bien hecho!";
				$msj="Datos eliminados satisfactoriamente.";
				$classM="alert alert-success";
				$times="&times;";	
			}
			else
			{
				$aviso="Aviso!";
				$msj="Error al eliminar los datos ".mysqli_error($con);
				$classM="alert alert-error";
				$times="&times;";					
			}
	} 
	else 
		{
			$aviso="Aviso!";
			$msj="Error al eliminar los datos. El artículo se encuentra vinculado al inventario";
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
	$tables="products, manufacturers";
	$campos="products.product_id, products.model, products.product_name, products.status, products.note, products.image_path, products. product_code, products.selling_price, manufacturers.name as empleado";
	$sWhere="products.manufacturer_id=manufacturers.id";
	$sWhere.=" and products.status=4";
	$sWhere.=" and (manufacturers.name LIKE '%".$query."%' OR products.note LIKE '%".$query."%' OR products.product_code LIKE '%".$query."%')";
	$sWhere.=" order by products.product_id desc";
	
	 
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
	$reload = './products.php';
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
				<h3 class="box-title">Listado de Bienes</h3>
				</div><!-- /.box-header -->
				<div class="box-body">
				<div class="table-responsive">
					<table class="table table-condensed table-hover table-striped ">
						<tr>
							<th class='text-center'>Código</th>
							<th class='text-center'>Imagen</th>
							<th>Empleado</th>
							<th>Descripción</th>
							<th class='text-center'>Estado</th>
							<th class='text-right'>Precio</th>
							<th></th>
						</tr>
						<?php 
						$finales=0;
						while($row = mysqli_fetch_array($query)){	
							$product_id=$row['product_id'];
							$product_code=$row['product_code'];
							$manufacturer_name=$row['empleado'];
							$note=$row['note'];
							$status=$row['status'];
							$selling_price=$row['selling_price'];
							$image_path=$row['image_path'];
							if ($status==4){
								$lbl_status="No Inventaribles";
								$lbl_class='label label-default';
							}							
							$finales++;
						?>	
						<tr>
							<td class='text-center'><?php echo $product_code;?></td>
							<td class='text-center'>
								<img src="<?php echo $image_path;?>" alt="Product Image" class='img-rounded' width="60">
							</td>
							<td><?php echo $manufacturer_name;?></td>
							<td><?php echo $note;?></td>
							<td class='text-center'>
								<span class="<?php echo $lbl_class;?>"><?php echo $lbl_status;?></span>
							</td>
							
							<td class='text-right'><?php echo number_format($selling_price,$currency_format['precision_currency'],$currency_format['decimal_separator'],$currency_format['thousand_separator']);?></td>
							
							
							<td>
							<div class="btn-group pull-right">
									<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Acciones <span class="fa fa-caret-down"></span></button>
								<ul class="dropdown-menu">
									<?php if ($permisos_editar==1){?>
									<li><a href="edit4_product.php?id=<?php echo $product_id;?>"><i class='fa fa-edit'></i> Editar</a></li>
									<li><a href="detalle_product4.php?id=<?php echo $product_id;?>"><i class='fa fa-folder'></i> Detalle</a></li>
									<li><a href="#"  data-toggle="modal" data-target="#barcodeModal" data-id='<?php echo $product_id;?>' data-product_code='<?php echo $product_code?>' data-product_name='<?php echo $product_name;?>'><i class='fa fa-barcode'></i> Código de barra</a></li>
									<?php }
									if ($permisos_eliminar==1){
									?>
									<li><a href="#" onclick="eliminar('<?php echo $product_id;?>')"><i class='fa fa-trash'></i> Borrar</a></li>
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
		  
