<?php
	/*-------------------------
	Autor: Obed Alvarado
	Web: obedalvarado.pw
	Mail: info@obedalvarado.pw
	---------------------------*/
session_start();
$user_id=$_SESSION['user_id'];
if (isset($_POST['id'])){$id=$_POST['id'];}
if (isset($_POST['cantidad'])){$qty=intval($_POST['cantidad']);}
if (isset($_POST['precio_venta'])){floatval($unit_price=$_POST['precio_venta']);}


	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	require_once ("../libraries/inventory.php");//Contiene funcion que controla stock en el inventario
	
if (!empty($id) and !empty($qty) and !empty($unit_price))
{
	$stock=get_stock($id);
	if ($stock<$qty){
		?>
		<script>alert('No cuenta con suficiente stock para realizar la venta');</script>
		<?php	
	} else{
	
	add_tmp($id, $qty, $unit_price, $user_id);
	
	}
}
if (isset($_POST['barcode'])){
	$barcode=mysqli_real_escape_string($con,$_POST['barcode']);
	$barcode_qty=intval($_POST['barcode_qty']);
	$product_id=get_id('products','product_id','product_code',$barcode);
	$unit_price=get_id('products','selling_price','product_id',$product_id);
	if ($product_id>0){
		$stock=get_stock($product_id);
		if ($stock<$barcode_qty){
			?>
			<script>alert('No cuenta con suficiente stock para realizar la venta');</script>
			<?php	
		} else{
		
		add_tmp($product_id, $barcode_qty, $unit_price, $user_id);
		
		}
	
	} else {
		echo "<script>alert('Producto no encontrado.')</script>";
	}
}
if (isset($_GET['id']))//codigo elimina un elemento de la DB
{
$id_tmp=intval($_GET['id']);	
remove_tmp($id_tmp);
}

	/*Datos de la empresa*/
		$sql_empresa=mysqli_query($con,"SELECT * FROM  business_profile, currencies where business_profile.currency_id=currencies.id and business_profile.id=1");
		$rw_empresa=mysqli_fetch_array($sql_empresa);
		$moneda=$rw_empresa["symbol"];
		
	/*Fin datos empresa*/
	$tax=floatval($_REQUEST['tax']);
	
	
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
	$sql_taxes=mysqli_query($con,"select * from taxes where status=1");
	$sumador_total=0;
	$sql=mysqli_query($con, "select * from products, product_tmp where products.product_id=product_tmp.product_id and product_tmp.user_id='$user_id'");
	$nums=0;
	while ($row=mysqli_fetch_array($sql))
	{
	$product_id=$row['product_id'];
	$id_tmp=$row["id_tmp"];
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
			<td ><span class="pull-right"><a href="#" onclick="eliminar('<?php echo $id_tmp; ?>')"><i class="glyphicon glyphicon-trash"></i></a></span></td>
		</tr>		
		<?php
		$nums++;
	}
	$total_parcial=number_format($sumador_total,$currency_format['precision_currency'],'.','');
	$total_neto=$total_parcial;
	$total_neto=number_format($total_neto,$currency_format['precision_currency'],'.','');
	$total_iva=($total_neto*$tax) / 100;
	$total_iva=number_format($total_iva,$currency_format['precision_currency'],'.','');
	$total_compra=$total_neto+$total_iva;
	$total_compra=number_format($total_compra,$currency_format['precision_currency'],'.','');
	
?>

<tr>
	<td colspan=4><span class="pull-right">NETO <?php echo $moneda;?></span></td>
	<td><span class="pull-right"><?php echo number_format($total_neto,$currency_format['precision_currency'],$currency_format['decimal_separator'],$currency_format['thousand_separator']);?></span></td>
	<td></td>
</tr>
<tr>
	<td colspan=4 class='text-right'>
		<select name="taxes" id="taxes" onchange="tax_value(this.value)">
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


