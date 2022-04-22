<style type="text/css">
<!--
div.zone
{
    border: solid 0.5mm red;
    border-radius: 2mm;
    padding: 1mm;
    background-color: #FFF;
    color: #440000;
}
div.zone_over
{
    width: 30mm;
    height: 20mm;
    
}
.bordeado
{
	border: solid 0.5mm #eee;
	border-radius: 1mm;
	padding: 0mm;
	font-size:12px;
}
.table {
  border-spacing: 0;
  border-collapse: collapse;
}
.table-bordered td, .table-bordered th {
  padding: 3px;
  text-align: left;
  vertical-align: top;
}
.table-bordered {
  border: 0px solid #eee;
  border-collapse: separate;
  
  -webkit-border-radius: 4px;
     -moz-border-radius: 4px;
          border-radius: 4px;
}
.left{
	border-left: 1px solid #eee;
	
}
.top{
	border-top: 1px solid #eee;
}
.bottom{
	border-bottom: 1px solid #eee;
}
table.page_footer {width: 100%; border: none; background-color: white; padding: 2mm;border-collapse:collapse; border: none;}
.page-header {
    margin: 10px 0 20px 0;
    font-size: 16px;
}
-->
</style>
<page backtop="15mm" backbottom="15mm" backleft="15mm" backright="15mm" style="font-size: 13px; font-family: helvetica" backimg="">
		<div>
			<img src="<?php echo $logo_url;?>" style="width: 175px;">
		</div>
       <table style="width:100%" class='page-header' cellspacing=0>
        <tr style="vertical-align: top">
            <td style="width:70%;border-bottom: 3px solid #2ecc71;padding:4px">
				
				 <?php echo $bussines_name;?>
			</td>
            <td style="width:30%;text-align:right;border-bottom: 3px solid #2ecc71;">
               	<small>Fecha: <?php echo $sale_date;?></small>
			</td>
            
        </tr>
        
    </table>
	<br>
	
	<table style="width:100%">
        <tr style="vertical-align: top">
            <td style="width:40%;">
				Proveedor<br>
			<address>
              <strong><?php echo $bussines_name;?></strong><br>
              <?php echo $address.", ". $city;?><br>
              <?php echo $state.", ". $postal_code;?><br>
              Teléfono: <?php echo $phone;?><br>
              Email: <?php echo $email;?>
            </address> 
			</td>
            <td style="width:40%;">
               Cliente<br>
             <address>
              <strong><?php echo $customer_name;?></strong><br>
             <?php echo $customer_address." ". $customer_city;?><br>
             <?php echo $customer_state." ". $customer_postal_code;?><br>
              Teléfono: <?php echo $customer_work_phone;?><br>
              Email: <?php echo $customer_email;?>
            </address>	
			</td>
			<td style="width:20%;text-align:right;font-size:16px;">
               	<b>Factura # <?php echo $sale_number;?></b><br>
			</td>
            
        </tr>
        
    </table>
   
    <br>
	
	
	
  
    <table class="table-bordered" style="width:100%;" cellspacing=0>
        <tr>
			<th class='top bottom'  style="width: 15%;text-align:center"><small>CODIGO</small></th>
            <th class='top bottom'  style="width: 10%;text-align:center"><small>CANT.</small></th>
            <th class='top bottom'  style="width: 50%"><small>DESCRIPCION</small></th>
            <th class='top bottom'  style="width: 12%;text-align:right"><small>PRECIO UNIT.</small></th>
		    <th class='top bottom'  style="width: 12%;text-align:right"><small>TOTAL</small></th>
            
        </tr>
		<?php
		$sumador_total=0;
		$sql=mysqli_query($con, "select * from products, sale_product where products.product_id=sale_product.product_id and sale_product.sale_id='$sale_id'");
		while ($row=mysqli_fetch_array($sql)){
			$product_code=$row['product_code'];
			$qty=$row['qty'];
			$product_name=$row['product_name'];
			$unit_price=number_format($row['unit_price'],$currency_format['precision_currency'],'.','');
			$precio_total=$unit_price*$qty;
			$precio_total=number_format($precio_total,$currency_format['precision_currency'],'.','');//Precio total formateado
			$sumador_total+=$precio_total;//Sumador
			?>
			<tr>
                 <td class='bottom' style='width: 15%;text-align:center'><?php echo $product_code;?></td>
				 <td class='bottom' style='width: 10%;text-align:center'><?php echo $qty;?></td>
				 <td class='bottom' style='width: 50%;text-align:left'><?php echo $product_name;?></td>
				 <td class='bottom' style='width: 12%;text-align:right'><?php echo number_format($unit_price,$currency_format['precision_currency'],$currency_format['decimal_separator'],$currency_format['thousand_separator']);?></td>
				 <td class='bottom' style='width: 12%;text-align:right;'><?php echo number_format($precio_total,$currency_format['precision_currency'],$currency_format['decimal_separator'],$currency_format['thousand_separator']);?></td>
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
			<tr><td> </td></tr>
			<tr>
				<td  colspan=4 style='text-align:right'><strong>Subtotal <?php echo $moneda;?></strong></td>
				<td style='text-align:right'><?php echo number_format($total_neto,$currency_format['precision_currency'],$currency_format['decimal_separator'],$currency_format['thousand_separator']);?></td>
			</tr>
			<tr>
				<td colspan=4 style='text-align:right'><strong><?php echo $tax_txt;?> <small><?php echo $tax;?>%</small> <?php echo $moneda;?></strong></td>
				<td style='text-align:right'><?php echo number_format($total_iva,$currency_format['precision_currency'],$currency_format['decimal_separator'],$currency_format['thousand_separator']);?></td>
			</tr>
			<tr>
				<td colspan=4 style='text-align:right;border-top:3px solid #2ecc71;padding:4px;padding-top:4px;font-size:16px'><strong>Total <?php echo $moneda;?></strong></td>
				<td style='text-align:right;border-top:3px solid #2ecc71;padding:4px;padding-top:4px;font-size:16px'><?php echo number_format($total_compra,$currency_format['precision_currency'],$currency_format['decimal_separator'],$currency_format['thousand_separator']);?></td>
			</tr>

	
	 </table>
    
	
	
	
	
	
	  

</page>

