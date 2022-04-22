<?php
	$_SESSION['purchase_id']=intval($_GET['id']);
	$purchase_id=$_SESSION['purchase_id'];
	$sql_purchase=mysqli_query($con,"select * from purchases, suppliers where purchases.supplier_id=suppliers.id and purchase_id='".$_SESSION['purchase_id']."'");
	$count=mysqli_num_rows($sql_purchase);
	$rw_purchase=mysqli_fetch_array($sql_purchase);
	$purchase_order_number=$rw_purchase['purchase_order_number'];
	$supplier_id=$rw_purchase['supplier_id'];
	$purchase_date=$rw_purchase['purchase_date'];
	$purchase_date= date('d/m/Y', strtotime($rw_purchase['purchase_date']));
	$supplier_name=$rw_purchase['name'];
	$supplier_address=$rw_purchase['address1'];
	$supplier_city=$rw_purchase['city'];
	$supplier_state=$rw_purchase['state'];
	$supplier_postal_code=$rw_purchase['postal_code'];
	$supplier_work_phone=$rw_purchase['work_phone'];
	$supplier_id=$rw_purchase['id'];
	
	if (!isset($_GET['id']) or $count!=1){
		echo "<script>window.close();</script>";
		exit;
	}
	
	$sql_contact=mysqli_query($con,"select email from  contacts_supplier where supplier_id='".$supplier_id."'");
	$rw_contact=mysqli_fetch_array($sql_contact);
	$supplier_email=$rw_contact['email'];
	
	/*Datos de la empresa*/
		$sql_empresa=mysqli_query($con,"SELECT business_profile.name, business_profile.tax, business_profile.address,  currencies.symbol, business_profile.city, business_profile.state, business_profile.postal_code, business_profile.phone, business_profile.email FROM  business_profile, currencies where business_profile.currency_id=currencies.id and business_profile.id=1");
		$rw_empresa=mysqli_fetch_array($sql_empresa);
		$moneda=$rw_empresa["symbol"];
		
		$bussines_name=$rw_empresa["name"];
		$address=$rw_empresa["address"];
		$city=$rw_empresa["city"];
		$state=$rw_empresa["state"];
		$postal_code=$rw_empresa["postal_code"];
		$phone=$rw_empresa["phone"];
		$email=$rw_empresa["email"];
		
	/*Fin datos empresa*/
	
	$tax=get_id("purchases","tax_value","purchase_id",$purchase_id);
	$tax_txt=get_id("taxes","name","value",$tax);
?>
<!DOCTYPE html>
<html>
  <head>
  
	<?php include("head.php");?>
  </head>
	
  <body onload="window.print();">
    <div class="wrapper">
      <!-- Main content -->
      <section class="invoice">
        <!-- title row -->
        <div class="row">
          <div class="col-xs-12">
            <h2 class="page-header">
              <?php echo $bussines_name;?>
              <small class="pull-right">Fecha: <?php echo $purchase_date;?></small>
            </h2>
          </div><!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
          <div class="col-sm-5 invoice-col">
            Proveedor
            <address>
              <strong><?php echo $supplier_name;?></strong><br>
             <?php echo $supplier_address." ". $supplier_city;?><br>
             <?php echo $supplier_state." ". $supplier_postal_code;?><br>
              Teléfono: <?php echo $supplier_work_phone;?><br>
              Email: <?php echo $supplier_email;?>
            </address>
          </div><!-- /.col -->
          <div class="col-sm-5 invoice-col">
            Para
            <address>
              <strong><?php echo $bussines_name;?></strong><br>
              <?php echo $address.", ". $city;?><br>
              <?php echo $state.", ". $postal_code;?><br>
              Teléfono: <?php echo $phone;?><br>
              Email: <?php echo $email;?>
            </address>
          </div><!-- /.col -->
          <div class="col-sm-2 invoice-col">
            <b>Compra # <?php echo $purchase_order_number;?></b><br>
            <br>
            
            
          </div><!-- /.col -->
        </div><!-- /.row -->

        <!-- Table row -->
        <div class="row">
          <div class="col-xs-12 table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>CODIGO</th>
                  <th class='text-center'>CANT.</th>
                  <th>DESCRIPCION</th>
                  <th><span class="pull-right">PRECIO UNIT.</span></th>
				  <th><span class="pull-right">PRECIO TOTAL</span></th>
                </tr>
              </thead>
              <tbody>
			  <?php
				$sumador_total=0;
				$sql=mysqli_query($con, "select * from products, purchase_product where products.product_id=purchase_product.product_id and purchase_product.purchase_id='$purchase_id'");
				while ($row=mysqli_fetch_array($sql)){
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
			  ?>
                
                
              </tbody>
            </table>
          </div><!-- /.col -->
        </div><!-- /.row -->

        <div class="row">
          <!-- accepted payments column -->
          <div class="col-xs-8">
            
            
          </div><!-- /.col -->
          <div class="col-xs-4">
           
            <div class="table-responsive">
              <table class="table">
                <tr>
                  <th style="width:50%" class="text-right">Subtotal <?php echo $moneda;?></th>
                  <td class="text-right"><?php echo number_format($total_neto,$currency_format['precision_currency'],$currency_format['decimal_separator'],$currency_format['thousand_separator']);?></td>
                </tr>
                <tr>
                  <th class="text-right"><?php echo $tax_txt;?> <small><?php echo $tax;?>%</small></th>
                  <td class="text-right"><?php echo number_format($total_iva,$currency_format['precision_currency'],$currency_format['decimal_separator'],$currency_format['thousand_separator']);?></td>
                </tr>
                
                <tr>
                  <th class="text-right">Total <?php echo $moneda;?></th>
                  <td class="text-right"><?php echo number_format($total_compra,$currency_format['precision_currency'],$currency_format['decimal_separator'],$currency_format['thousand_separator']);?></td>
                </tr>
              </table>
            </div>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </section><!-- /.content -->
    </div><!-- ./wrapper -->

    
    
  </body>
</html>
