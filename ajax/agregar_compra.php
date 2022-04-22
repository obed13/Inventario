<?php
	/*-------------------------
	Autor: Obed Alvarado
	Web: obedalvarado.pw
	Mail: info@obedalvarado.pw
	---------------------------*/
session_start();
$purchase_id= $_SESSION['purchase_id'];
if (isset($_POST['id'])){$id=$_POST['id'];}
if (isset($_POST['cantidad'])){$qty=intval($_POST['cantidad']);}
if (isset($_POST['precio_venta'])){floatval($unit_price=$_POST['precio_venta']);}


	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	require_once ("../libraries/inventory.php");//Contiene funcion que controla stock en el inventario
	
if (!empty($id) and !empty($qty) and !empty($unit_price))
{
$insert=mysqli_query($con, "INSERT INTO purchase_product (purchase_id,product_id,qty,unit_price) VALUES ('$purchase_id','$id','$qty','$unit_price')");

//Inicio Kardex
$costo_promedio=average_cost($id, $qty, $unit_price);//Obtengo el costo promedio
$note="Agregar item a compra";
$type=1;
$stock=get_stock($id);
$stock_total=$stock+$qty;
$purchase_date=date("Y-m-d H:i:s");
register_kardex($purchase_date, $id, $qty, $costo_promedio, $unit_price, $stock_total,$note, $type );//Registro datos en la tabla Kardex
//Fin Kardex
add_inventory($id, $qty);//Agrego producto al inventario
update_buying_price($id,$unit_price);//Actualizo precio de compra
update_selling_price($id,$unit_price);//Actualizo precio de venta
}
if (isset($_GET['id']))//codigo elimina un elemento de la DB
{
$purchase_product_id=intval($_GET['id']);	
$sql_purchase=mysqli_query($con,"select product_id, qty from  purchase_product where purchase_product_id='".$purchase_product_id."'");
$rw_purchase=mysqli_fetch_array($sql_purchase);
$product_id_remove=$rw_purchase['product_id'];
$qty_remove=$rw_purchase['qty'];
//Inicio Kardex
$product_id=get_id('purchase_product','product_id','purchase_product_id',$purchase_product_id);
$qty=get_id('purchase_product','qty','purchase_product_id',$purchase_product_id);
$unit_price=get_id('purchase_product','unit_price','purchase_product_id',$purchase_product_id);


$costo_promedio=average_cost_min($product_id, $qty, $unit_price);//Obtengo el costo promedio
$note="Eliminar item de compra";
$type=2;
$stock=get_stock($product_id);
$stock_total=$stock-$qty;
$date_added=date("Y-m-d H:i:s");
register_kardex($date_added, $product_id, $qty, $costo_promedio, $unit_price, $stock_total,$note, $type);//Registro datos en la tabla Kardex
//Fin Kardex
$delete=mysqli_query($con, "DELETE FROM purchase_product WHERE purchase_product_id='".$purchase_product_id."'");
remove_inventory($product_id_remove,$qty_remove );//Disminuye la cantidad en el inventario;
}
if (isset($_POST['campo'])){
	$campo=intval($_POST['campo']);
	
	if ($campo==1){
		$valor=intval($_POST['valor']);
	$term="supplier_id='$valor'";	
	} else if ($campo==2){
		$valor=mysqli_real_escape_string($con,(strip_tags($_POST["valor"],ENT_QUOTES)));
		list($dia,$mes,$anio)=explode("/", $valor);
		$purchase_date="$anio-$mes-$dia ".date("H:i:s");
		$term="	purchase_date='$purchase_date'";	
	} else if ($campo==3){
		$valor=intval($_POST['valor']);
		$term="	purchase_order_number='$valor'";	
	} else if ($campo==4){
		$valor=floatval($_POST['valor']);
		$term="	tax_value='$valor'";	
	}
	$update_purchase=mysqli_query($con,"update purchases set $term where purchase_id='$purchase_id'");
}
	/*Datos de la empresa*/
		$sql_empresa=mysqli_query($con,"SELECT * FROM  business_profile, currencies where business_profile.currency_id=currencies.id and business_profile.id=1");
		$rw_empresa=mysqli_fetch_array($sql_empresa);
		$moneda=$rw_empresa["symbol"];
		
	/*Fin datos empresa*/
	$sql_taxes=mysqli_query($con,"select * from taxes where status=1");	
	$tax=get_id("purchases","tax_value","purchase_id",$purchase_id);
	
	
?>
<div class="table-responsive">
<table class="table">
<tr>
	<th>CODIGO</th>
	<th class='text-center'>CANT.</th>
	<th>DESCRIPCION</th>
	<th><span class="pull-right">PRECIO UNIT.</span></th>
	<th><span class="pull-right">PRECIO TOTAL</span></th>
	<th></th>
</tr>
<?php
	$sumador_total=0;
	$sql=mysqli_query($con, "select * from products, purchase_product where products.product_id=purchase_product.product_id and purchase_product.purchase_id='$purchase_id'");
	while ($row=mysqli_fetch_array($sql))
	{
	$product_id=$row['product_id'];
	$purchase_product_id=$row["purchase_product_id"];
	$product_code=$row['product_code'];
	$qty=$row['qty'];
	$product_name=$row['product_name'];
	$unit_price=number_format($row['unit_price'],$currency_format['precision_currency'],'.','');

	$precio_total=$unit_price*$qty;
	$precio_total=number_format($precio_total,$currency_format['precision_currency'],'.','');//Precio total formateado
	$sumador_total+=$precio_total;//Sumador
	
		?>
		<tr>
			<td><?php echo $product_code;?></td>
			<td class='text-center'><?php echo $qty;?></td>
			<td><?php echo $product_name;?></td>
			<td><span class="pull-right"><?php echo number_format($unit_price,$currency_format['precision_currency'],$currency_format['decimal_separator'],$currency_format['thousand_separator']);?></span></td>
			<td><span class="pull-right"><?php echo number_format($precio_total,$currency_format['precision_currency'],$currency_format['decimal_separator'],$currency_format['thousand_separator']);?></span></td>
			<td ><span class="pull-right"><a href="#" onclick="eliminar('<?php echo $purchase_product_id ?>')"><i class="glyphicon glyphicon-trash"></i></a></span></td>
		</tr>		
		<?php
		
	}
	$total_parcial=number_format($sumador_total,$currency_format['precision_currency'],'.','');
	$total_neto=$total_parcial;
	$total_neto=number_format($total_neto,$currency_format['precision_currency'],'.','');
	$total_iva=($total_neto*$tax) / 100;
	$total_iva=number_format($total_iva,$currency_format['precision_currency'],'.','');
	$total_compra=$total_neto+$total_iva;
	$total_compra=number_format($total_compra,$currency_format['precision_currency'],'.','');
	$update=mysqli_query($con,"update purchases set subtotal='$total_neto', tax='$total_iva', total='$total_compra' where purchase_id='$purchase_id'");
?>


<tr>
	<td colspan=4><span class="pull-right">NETO <?php echo $moneda;?></span></td>
	<td><span class="pull-right"><?php echo number_format($total_neto,$currency_format['precision_currency'],$currency_format['decimal_separator'],$currency_format['thousand_separator']);?></span></td>
	<td></td>
</tr>
<tr>
	<td colspan=4 class='text-right'>
		<select name="taxes" id="taxes" onchange="update_purchase(this.value,4);">
		<?php
			foreach ($sql_taxes as $valor){
				if ($tax==$valor['value']){
					$selected="selected";
				} else{
					$selected="";
				} 
				echo '<option value="'.$valor['value'].'" '.$selected.'>'.$valor['name']." ".$valor['value'].' %</option>';
			}
		?>
			
		</select>
	</td>
	<td><span class="pull-right"><?php echo number_format($total_iva,$currency_format['precision_currency'],$currency_format['decimal_separator'],$currency_format['thousand_separator']);?></span></td>
	<td></td>
</tr>
<tr>
	<td colspan=4><span class="pull-right">TOTAL <?php echo $moneda;?></span></td>
	<td><span class="pull-right"><?php echo number_format($total_compra,$currency_format['precision_currency'],$currency_format['decimal_separator'],$currency_format['thousand_separator']);?></span></td>
	<td></td>
</tr>
</table>
</div>
<div class="col-xs-12">
	<a href="purchase-print.php?id=<?php echo $purchase_id;?>" target="_blank" class="btn btn-primary pull-right"><i class="fa fa-print"></i> Imprimir</a>
</div>
