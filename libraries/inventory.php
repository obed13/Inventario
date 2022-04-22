<?php
	function add_inventory($product_id,$product_quantity){
		global $con;//Variable de conexion
		$sql=mysqli_query($con,"select * from inventory where product_id='".$product_id."'");//Consulta para verificar si el producto se encuentra reguistrado en  el inventario
		$count=mysqli_num_rows($sql);
		if ($count==0){
			$insert=mysqli_query($con,"insert into inventory (product_id, product_quantity) values ('$product_id','$product_quantity')");//Ingresa un nuevo producto al inventario
		} else {
			$sql2=mysqli_query($con,"select * from inventory where product_id='".$product_id."'");
			$rw=mysqli_fetch_array($sql2);
			$old_qty=$rw['product_quantity'];//Cantidad encontrada en el inventario
			$new_qty=$old_qty+$product_quantity;//Nueva cantidad en el inventario
			$update=mysqli_query($con,"UPDATE inventory SET product_quantity='".$new_qty."' WHERE product_id='".$product_id."'");//Actualizo la nueva cantidad en el inventario
		}
	}
	
	function adjustment_inventory($product_id,$product_quantity){
		global $con;//Variable de conexion
		$sql=mysqli_query($con,"select * from inventory where product_id='".$product_id."'");//Consulta para verificar si el producto se encuentra reguistrado en  el inventario
		$count=mysqli_num_rows($sql);
		if ($count==0){
			$insert=mysqli_query($con,"insert into inventory (product_id, product_quantity) values ('$product_id','$product_quantity')");//Ingresa un nuevo producto al inventario
		} else {
			$update=mysqli_query($con,"UPDATE inventory SET product_quantity='".$product_quantity."' WHERE product_id='".$product_id."'");//Actualizo la nueva cantidad en el inventario
		}
	}
	
	function remove_inventory($product_id,$product_quantity){
		global $con;//Variable de conexion
		$sql=mysqli_query($con,"select * from inventory where product_id='".$product_id."'");
		$rw=mysqli_fetch_array($sql);
		$old_qty=$rw['product_quantity'];//Cantidad encontrada en el inventario
		$new_qty=$old_qty-$product_quantity;//Nueva cantidad en el inventario
		$update=mysqli_query($con,"UPDATE inventory SET product_quantity='".$new_qty."' WHERE product_id='".$product_id."'");//Actualizo la nueva cantidad en el inventario
	}
	function update_buying_price($product_id,$buying_price){
		global $con;//Variable de conexion
		$update=mysqli_query($con,"UPDATE products SET buying_price='".$buying_price."' WHERE product_id='".$product_id."'");
	}
	
	function update_selling_price($product_id,$buying_price){
		global $con;//Variable de conexion
		$sql=mysqli_query($con,"select profit from products where product_id='$product_id'");
		$rw=mysqli_fetch_array($sql);
		$utilidad=floatval($rw['profit']);

		
		$precio_venta=$buying_price + $utilidad;
		$selling_price=number_format($precio_venta,2,'.','');
		
		
		$update=mysqli_query($con,"UPDATE products SET selling_price='".$selling_price."' WHERE product_id='".$product_id."'");
	}
	
	function get_stock($product_id){
		global $con;//Variable de conexion
		$sql=mysqli_query($con,"SELECT 	product_quantity FROM inventory WHERE product_id='".$product_id."'");
		$rw=mysqli_fetch_array($sql);
		$stock=number_format($rw['product_quantity'],0,'.','');
		return $stock;
	}
	//Agrega un nuevo registro a la tabla product_tmp
	function add_tmp($product_id, $qty, $unit_price, $user_id){
		global $con;
		$sql=mysqli_query($con,"insert into product_tmp 
		(id_tmp, product_id, qty, unit_price, user_id)
		values (NULL, '$product_id','$qty','$unit_price','$user_id')");
	}
	//Elimina un registro de la tabla product_tmp
	function remove_tmp($id_tmp){
		global $con;
		$sql=mysqli_query($con,"DELETE FROM product_tmp WHERE id_tmp='$id_tmp'");
	}
	//Guarda una venta
	function add_sale($sale_number, $customer_id, $sale_by,$sale_date,$tax_value){
		global $con;
		$sum=mysqli_query($con,"select sum(qty*unit_price) as subtotal from product_tmp where user_id='$sale_by'");
		$rw_sum=mysqli_fetch_array($sum);
		$sumador_total=$rw_sum['subtotal'];
		$tax= $tax_value;
		
		$total_parcial=number_format($sumador_total,2,'.','');
		$total_neto=$total_parcial;
		$total_neto=number_format($total_neto,2,'.','');
		$total_iva=($total_neto*$tax) / 100;
		$total_iva=number_format($total_iva,2,'.','');
		$total_venta=$total_neto+$total_iva;
		$total_venta=number_format($total_venta,2,'.','');
		$sale_id=next_insert_id('sales');
		$sql="INSERT INTO sales
		(sale_id, sale_number, customer_id, sale_by, subtotal, tax, total, sale_date,tax_value) 
		VALUES ('$sale_id', '$sale_number', '$customer_id', '$sale_by', '$total_neto', '$total_iva', '$total_venta', '$sale_date','$tax_value');";
		$query=mysqli_query($con,$sql);
		
		
		$sql_tmp=mysqli_query($con,"select * from product_tmp where user_id='$sale_by'");
		while ($rw_tmp=mysqli_fetch_array($sql_tmp)){
			$id_tmp=$rw_tmp['id_tmp'];
			$product_id=$rw_tmp['product_id'];
			$qty=$rw_tmp['qty'];
			$unit_price=$rw_tmp['unit_price'];
			add_sale_product($sale_id,$product_id,$qty,$unit_price);//Agrego un registro  a la tabla sale_product
			
			//Inicio Kardex
				$note="Venta de mercadería";
				$type_tt=2;
				$stock=get_stock($product_id);
				$stock_total=$stock-$qty;
				$last_cost=last_cost($product_id);
				register_kardex($sale_date, $product_id, $qty, $last_cost, $last_cost,  $stock_total, $note, $type_tt );
			//Fin Kardex
			remove_inventory($product_id,$qty );//Disminuye la cantidad en el inventario;
			remove_tmp($id_tmp);//Elimina el item de la tabla temporal
		}
		
	}
	
	function get_tax(){
		global $con;
		$sql=mysqli_query($con,"SELECT tax FROM  business_profile where  business_profile.id=1");
		$row=mysqli_fetch_array($sql);
		$tax=$row["tax"];
		return $tax;
	}
	
	function next_insert_id($table){
		global $con;
		$next="SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '".DB_NAME."' AND   TABLE_NAME   = '$table'";
		$query_next=mysqli_query($con,$next);
		$rw_next=mysqli_fetch_array($query_next);
		$next_insert=$rw_next['AUTO_INCREMENT'];
	    return $next_insert;
	}
	
	function add_sale_product($sale_id,$product_id,$qty,$unit_price){
		global $con;
		$sql="INSERT INTO sale_product (sale_product_id, sale_id, product_id, qty, unit_price)
		VALUES (NULL, '$sale_id', '$product_id', '$qty', '$unit_price');";
		$query=mysqli_query($con,$sql);
	}
	
	function is_valid_sale($sale_number){
		global $con;
		$sql=mysqli_query($con,"select sale_number from sales where sale_number='$sale_number'");
		$count = mysqli_num_rows($sql);
		if ($count==0){
			return true;
		} else {
			return false;
		}
		
	}
	
	function nex_sale_number(){
		global $con;
		$sql=mysqli_query($con,"select sale_number from sales order by sale_id desc limit 0,1");
		$rw=mysqli_fetch_array($sql); 
		$sale_number=$rw['sale_number'];
		$nex_sale_number=$sale_number+1;
		
		return $nex_sale_number;
		
	}
	
	function nex_purchase_number(){
		global $con;
		$sql=mysqli_query($con,"select purchase_order_number from purchases order by purchase_id desc limit 0,1");
		$rw=mysqli_fetch_array($sql); 
		$purchase_number=$rw['purchase_order_number'];
		$nex_purchase_number=$purchase_number+1;
		
		return $nex_purchase_number;
		
	}
	
	function count_tmp($user_id){
		global $con;
		$sql=mysqli_query($con,"select product_id from product_tmp where user_id='$user_id'");
		$count=mysqli_num_rows($sql); 
		return $count;
	}
	
	//Guarda una compra
	function add_purchase($order_number, $supplier_id, $purchase_by,$purchase_date,$tax_value){
		global $con;
		$sum=mysqli_query($con,"select sum(qty*unit_price) as subtotal from product_tmp where user_id='$purchase_by'");
		$rw_sum=mysqli_fetch_array($sum);
		$sumador_total=$rw_sum['subtotal'];
		$tax= $tax_value;
		$total_parcial=number_format($sumador_total,2,'.','');
		$total_neto=$total_parcial;
		$total_neto=number_format($total_neto,2,'.','');
		$total_iva=($total_neto*$tax) / 100;
		$total_iva=number_format($total_iva,2,'.','');
		$total_compra=$total_neto+$total_iva;
		$total_compra=number_format($total_compra,2,'.','');
		$purchase_id=next_insert_id('purchases');
		
		$sql="INSERT INTO purchases
		(purchase_id, purchase_order_number	, supplier_id, purchase_by, subtotal, tax, total, purchase_date,tax_value) 
		VALUES ('$purchase_id', '$order_number', '$supplier_id', '$purchase_by', '$total_neto', '$total_iva', '$total_compra', '$purchase_date','$tax_value');";
		$query=mysqli_query($con,$sql);
		if ($query){
		 $true=1;
		} else {
			$true=0;
		}
		$sql_tmp=mysqli_query($con,"select * from product_tmp where user_id='$purchase_by'");
		while ($rw_tmp=mysqli_fetch_array($sql_tmp)){
			$id_tmp=$rw_tmp['id_tmp'];
			$product_id=$rw_tmp['product_id'];
			$qty=$rw_tmp['qty'];
			$unit_price=$rw_tmp['unit_price'];
			
			//Inicio Kardex
			
			$costo_promedio=average_cost($product_id,$qty, $unit_price);//Obtengo el costo promedio
			$note="Compra de mercadería";
			$type=1;
			$stock=get_stock($product_id);
			$stock_total=$stock+$qty;
			register_kardex($purchase_date, $product_id, $qty, $costo_promedio, $unit_price, $stock_total,$note, $type );//Registro datos en la tabla Kardex
			
			
			//Fin Kardex
			add_purchase_product($purchase_id,$product_id,$qty,$unit_price);//Agrego un registro  a la tabla purchase_product
			add_inventory($product_id,$qty);//Agrego la cantidad en el inventario;
			//update_buying_price($product_id,$unit_price);//Actualizo precio de compra
			update_selling_price($product_id,$unit_price);//Actualizo precio de venta
			remove_tmp($id_tmp);//Elimina el item de la tabla temporal
		}
		
		return $true;
		
	}
	
	
	function add_purchase_product($purchase_id,$product_id,$qty,$unit_price){
		global $con;
		$sql="INSERT INTO purchase_product (purchase_product_id, purchase_id, product_id, qty, unit_price)
		VALUES (NULL, '$purchase_id', '$product_id', '$qty', '$unit_price');";
		$query=mysqli_query($con,$sql);
	}
	//La siguiente funcion obtine un campo de la base de datos pasando como
	// parametros el nombre de la tabla, columna a retorna el campo a buscar dentro de  la dba_close
	// y el termino de bussqueda en la base de datos. Retorna solo (1) resultado
	function get_id($table,$row,$condition,$equal){
		global $con;//Variable de conexion
		$sql=mysqli_query($con,"select $row from $table where $condition='$equal' limit 0,1");
		$rw=mysqli_fetch_array($sql);
		$result= $rw[$row];
		return $result;
	}
	
	// Registra datos en el kardex
	function register_kardex($date_added, $product_id, $qty, $price, $real_price, $stock, $note, $type ){
		global $con;
		$sql="INSERT INTO kardex (id, date_added, product_id, qty, price, real_price, stock, note, type) VALUES (NULL, '$date_added', '$product_id', '$qty', '$price', '$real_price', '$stock', '$note', '$type');";
		$query=mysqli_query($con,$sql);
		//echo  mysqli_error($con);
	}
	
	//Obtengo el costo promedio
	function average_cost($product_id, $qty, $price){
		global $con;
		$sql="select * from kardex where product_id='$product_id' order by id desc limit 0,1";
		$query=mysqli_query($con,$sql);
		$rw=mysqli_fetch_array($query);
		$actual_price=$rw['price'];
		$actual_stock=get_stock($product_id);
		
		$actual_cost=$actual_stock*$actual_price;
		$new_cost=$qty*$price;
		
		$total_cost= $actual_cost + $new_cost;
		$total_qty=$actual_stock+$qty;
		
		$average_cost= $total_cost / $total_qty;
		return $average_cost=number_format($average_cost,4,'.','');
		
	}
	//Obtengo el costo de la ultima transaccion
	function last_cost($product_id){
		global $con;
		$sql="SELECT price from kardex where product_id='$product_id' order by id desc limit 0,1";
		$query=mysqli_query($con,$sql);
		$rw=mysqli_fetch_array($query);
		return $rw['price'];
	}
	
	//Obtengo el costo promedio
	function average_cost_min($product_id, $qty, $price){
		global $con;
		$sql="select * from kardex where product_id='$product_id'  order by id desc limit 0,1";
		$query=mysqli_query($con,$sql);
		$rw=mysqli_fetch_array($query);
		$actual_price=$rw['price'];
		$actual_stock=get_stock($product_id);
		
		$actual_cost=$actual_stock*$actual_price;
		$new_cost=$qty*$price;
		
		$total_cost= $actual_cost - $new_cost;
		$total_qty=$actual_stock-$qty;
		
		if ($total_qty>0){
			$average_cost= $total_cost / $total_qty;
		} else {
			$average_cost= 0;
		}
		
		return $average_cost=number_format($average_cost,4,'.','');
		
	}
	
	
	
?>	