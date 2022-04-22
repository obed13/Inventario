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
	$code = mysqli_real_escape_string($con,(strip_tags($_REQUEST['code'], ENT_QUOTES)));
	
	$product_id=get_id("products","product_id","product_code",$code);
	$tables="kardex";
	$campos="*";
	$sWhere="kardex.product_id='$product_id' ";
	if (!empty($daterange)){
		list ($f_inicio,$f_final)=explode(" - ",$daterange);//Extrae la fecha inicial y la fecha final en formato espa?ol
		list ($dia_inicio,$mes_inicio,$anio_inicio)=explode("/",$f_inicio);//Extrae fecha inicial 
		$fecha_inicial="$anio_inicio-$mes_inicio-$dia_inicio 00:00:00";//Fecha inicial formato ingles
		list($dia_fin,$mes_fin,$anio_fin)=explode("/",$f_final);//Extrae la fecha final
		$fecha_final="$anio_fin-$mes_fin-$dia_fin 23:59:59";
		
		$sWhere .= " and kardex.date_added between '$fecha_inicial' and '$fecha_final' ";
	}
	$sWhere.=" order by kardex.id";
	
	
	include 'pagination.php'; //include pagination file
	//pagination variables
	$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
	$per_page = 100000; //how much records you want to show
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
			<div class="box" >
				<div class="box-header with-border">
				<h3 class="box-title">LIBRO DE ALMACEN O KARDEX-VALORADO</h3>
				</div><!-- /.box-header -->
				<div class="box-body">
				<div class="table-responsive" id='print'>
					<table class="table table-bordered ">
						<tr>
							<td colspan='12'><b>Producto:</b> <?php  echo get_id('products','product_name','product_id',$product_id);?>. <b>Código:</b> <?php echo $code;?> </td>
						<tr>
						<tr>
							<th class='text-center' rowspan=2>Ítem</th>
							<th class='text-center' rowspan=2>Fecha </th>
							<th rowspan=2>Detalle</th>
							<th class='text-center' colspan='3'>Entradas </th>
							<th class='text-center' colspan='3'>Salidas </th>
							<th class='text-center' colspan='3'>Saldo </th>
						</tr>
						<tr>
							<th class='text-center' >CANT.</th>
							<th class='text-center' >P.U.</th>
							<th class='text-center' >P.T.</th>
							<th class='text-center' >CANT.</th>
							<th class='text-center' >P.U.</th>
							<th class='text-center' >P.T.</th>
							<th class='text-center' >CANT.</th>
							<th class='text-center' >P.U.</th>
							<th class='text-center' >P.T.</th>
						</tr>
						<?php 
						$finales=0;
						$item=1;
						$total_entradas=0;
						$total_real_price=0;
						$total_salidas=0;
						$total_salidas_price=0;
						while($row = mysqli_fetch_array($query)){	
							$fecha=date("d/m/Y H:i:s",strtotime($row['date_added']));
							$note=$row['note'];
							$type=$row['type'];	
							if ($type==1){
								$unidades_entrantes=$row['qty'];
								$precio_entrante=$row['real_price'];
								$total_entrante=$unidades_entrantes*$precio_entrante;
								$real_price=number_format($total_entrante,4,'.','');
								$total_real_price+=$real_price;
								$total_entrante=number_format($total_entrante,4);
								$unidades_salientes="";
								$precio_saliente="";
								$total_saliente="";
								$total_entradas+=$unidades_entrantes;
								
							} else {
								$unidades_salientes=$row['qty'];
								$precio_saliente=$row['real_price'];
								$total_saliente=$unidades_salientes*$precio_saliente;
								$real_price=number_format($total_saliente,4,'.','');
								$total_salidas_price+=$real_price;
								$total_saliente=number_format($total_saliente,4);
								$total_salidas+=$unidades_salientes;
								$unidades_entrantes="";
								$precio_entrante="";
								$total_entrante="";
								
							}
							$stock=$row['stock'];
							$stock_price=$row['price'];
							$price_total=$stock*$stock_price;
							$finales++;
						?>	
						<tr>
							<td class='text-center' ><?php echo $item;?></td>
							<td class='text-center' ><?php echo $fecha;?></td>
							<td ><?php echo $note;?></td>
							<td class='text-center'><?php echo $unidades_entrantes;?></td>
							<td class='text-center'><?php echo $precio_entrante;?></td>
							<td class='text-center'><?php echo $total_entrante;?></td>
							<td class='text-center'><?php echo $unidades_salientes;?></td>
							<td class='text-center'><?php echo $precio_saliente;?></td>
							<td class='text-center'><?php echo $total_saliente;?></td>
							<td class='text-center'><?php echo $stock;?></td>
							<td class='text-center'><?php echo $stock_price;?></td>
							<td class='text-center'><?php echo number_format($price_total,4);?></td>
						</tr>
						<?php
						$item++;							
							}
						?>
						<tr>
							<th colspan='3' class='text-right'>TOTALES</th>
							<th class='text-center'><?php echo $total_entradas; ?></th>
							<th class='text-center'></th>
							<th class='text-center'><?php echo number_format($total_real_price,4); ?></th>
							<th class='text-center'><?php echo $total_salidas; ?></th>
							<th class='text-center'></th>
							<th class='text-center'><?php echo number_format($total_salidas_price,4); ?></th>
							<th class='text-center'><?php echo $stock; ?></th>
							<th class='text-center'></th>
							<th class='text-center'><?php echo number_format($price_total,4);?></th>
						</tr>						
					</table>
				</div>	
				</div><!-- /.box-body -->
			
			</div><!-- /.box -->
		</div><!-- /.col -->
	</div><!-- /.row -->	
	<?php	
	}	
}
?>          
		  
