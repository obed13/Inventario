<style type="text/css">
<!--
table { vertical-align: top; }
tr    { vertical-align: top; }
td    { vertical-align: top; }
.class-theme{
	background:#3498db;
	padding: 5px;
	color:white;
	font-weight:bold;
	font-size:12px;
}
.silver{
	background:white;
	padding: 5px;
}
.clouds{
	background:#ecf0f1;
	padding: 5px;
}
.border-top{
	border-top: solid 2px #eee;
	
}
.border-left{
	border-left: solid 2px #eee;
}
.border-right{
	border-right: solid 2px #eee;
}
.border-bottom{
	border-bottom: solid 2px #eee;
}

table.page_header{
	width: 100%;
	padding:0px;

}

table.page_footer{
	width: 100%;
	padding:0px;
}
.orange-bottom{
	border-bottom: #3498db 3px;
}
.orange-top{
	border-top: #3498db 3px;
}
.orange-left{
	border-left: #3498db 3px;
}
.white{
	border-bottom:white 3px;
}
table{
	color:#2c3e50;
}

-->
</style>
<page backtop="0mm" backbottom="0mm" backleft="0mm" backright="0mm" style="font-size: 12pt; font-family: arial" >
    <page_header>
        <table class="page_header" cellspacing=0 cellpadding=0 >
            <tr>

                <td style="width: 39%; text-align: left;background-color:#3498db;" class='white' rowspan='2'>
                    <img style="width: 100%;" src="<?php echo $logo_url;?>" alt="Logo"><br>
                </td>
				<td style="width: 1%; text-align: left;background-color:white;" class='white'>
                    
                </td>
                <td style="width: 20%; text-align: center;vertical-align:middle;border-left:#3498db 3px;" >
                    <img src="img/icon/phone.png" style="width:15%">
                </td>
				<td style="width: 20%; text-align: center;vertical-align:middle" >
                    <img src="img/icon/mail.png" style="width:15%">
                </td>
				<td style="width: 20%; text-align: center;vertical-align:middle" >
                    <img src="img/icon/home.png" style="width:15%">
                </td>
            </tr>


			<tr>

                
				<td style="width: 1%; text-align: left;background-color:white;" class='white'>
                    
                </td>
                <td style="width: 20%; text-align: center;vertical-align:middle;border-left:#3498db 3px;" class='orange-bottom'>
                    <?php echo $phone;?><br>
                </td>
				<td style="width: 20%; text-align: center;vertical-align:middle;" class='orange-bottom'>
                    <?php echo $email;?><br>
                </td>
				<td style="width: 20%; text-align: center;vertical-align:middle" class='orange-bottom'>
                    <?php echo $address.", ". $city;?><br>
                </td>
            </tr>
        </table>
    </page_header>
	
	<page_footer>
        <table class="page_footer" cellspacing=0 cellpadding=0 >
            <tr>

                
				
                <td style="width: 25%; text-align: center;vertical-align:middle;" class='orange-top'>
					<b style="color:#333">Teléfono</b><br>
                   <?php echo $phone;?>
                </td>
				<td style="width: 25%; text-align: center;vertical-align:middle;" class='orange-top'>
					<b style="color:#333">Correo electrónico</b><br>
				  <?php echo $email;?>
                </td>
				<td style="width: 25%; text-align: center;vertical-align:middle" class='orange-top'>
					<b style="color:#333">Dirección</b><br>
				   <?php echo $address.", ". $city;?>
                </td>
				
				<td style="width: 25%; text-align: left;" class='orange-top orange-left' >
                    <img style="width: 100%;" src="<?php echo $logo_url;?>" alt="Logo"><br>
                </td>
				
				
            </tr>


			
        </table>
    </page_footer>

	
    
    
	<table cellspacing="0" style="width: 100%; text-align: left; font-size:14px;margin-top:120px">
		<tr>
			<td style="width:5%;"> </td>
			<td style="width:70%;font-size:24px;color:#3498db"><b>FACTURAR A </b></td>
			<td style="width:20%;text-align:right">
				<span style="color:#3498db">Factura Nº:</span> <?php echo $sale_number;?>
			</td>
			<td style="width:5%;"> </td>
		</tr>
		
		<tr>
			<td style="width:5%;"> </td>
			<td style="width:70%;">
			<address>
              <strong><?php echo $customer_name;?></strong><br>
             <?php echo $customer_address." ". $customer_city;?><br>
             <?php echo $customer_state." ". $customer_postal_code;?><br>
              Teléfono: <?php echo $customer_work_phone;?><br>
              Email: <?php echo $customer_email;?>
            </address>
			
			</td>
			<td style="width:20%;text-align:right;">
				<span style="color:#3498db">Fecha:</span> <?php echo $sale_date;?>
			</td>
			<td style="width:5%;"> </td>
		</tr>
	</table>



	<table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;margin-top:20px">
		<tr>
			<td style="width:5%;"> </td>
			<td style="width:70%;font-size:24px;"><b>TOTAL <?php echo $moneda;?> </b> <?php echo number_format($total_sales,$currency_format['precision_currency'],$currency_format['decimal_separator'],$currency_format['thousand_separator']);?></td>
			<td style="width:20%;font-size:24px;text-align:center;background-color:#eee;padding:10px"><b>FACTURA  </b></td>
			<td style="width:5%;font-size:24px;text-align:center;background-color:#eee;padding:10px"></td>
		</tr>
		
		
	</table>
	
   
    
	<br>
  
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 10pt;">
        <tr>
            <th style="width: 5%;text-align:center" class='class-theme'></th>
			<th style="width: 10%;text-align:center" class='class-theme'>CANT.</th>
            <th style="width: 50%" class='class-theme'>DESCRIPCION</th>
            <th style="width: 15%;text-align: right" class='class-theme'>PRECIO UNIT.</th>
            <th style="width: 15%;text-align: right" class='class-theme'>PRECIO TOTAL</th>
            <th style="width: 5%;text-align:center" class='class-theme'></th>
        </tr>

<?php
$nums=1;
$sumador_total=0;
$sql=mysqli_query($con, "select * from products, sale_product where products.product_id=sale_product.product_id and sale_product.sale_id='$sale_id'");

while ($row=mysqli_fetch_array($sql))
	{
	$product_code=$row['product_code'];
	$qty=$row['qty'];
	$product_name=$row['product_name'];
	$unit_price=number_format($row['unit_price'],$currency_format['precision_currency'],'.','');
	$precio_total=$unit_price*$qty;
	$precio_total=number_format($precio_total,$currency_format['precision_currency'],'.','');//Precio total formateado
	$sumador_total+=$precio_total;//Sumador
	if ($nums%2==0){
		$clase="clouds";
	} else {
		$clase="silver";
	}
	?>

        <tr>
			 <td class='<?php echo $clase;?>' style="width: 5%; text-align: center"></td>
            <td class='<?php echo $clase;?>' style="width: 10%; text-align: center"><?php echo $qty; ?></td>
            <td class='<?php echo $clase;?>' style="width: 50%; text-align: left"><?php echo $product_name;?></td>
            <td class='<?php echo $clase;?>' style="width: 15%; text-align: right"><?php echo $unit_price;?></td>
            <td class='<?php echo $clase;?>' style="width: 15%; text-align: right"><?php echo $precio_total;?></td>
            <td class='<?php echo $clase;?>' style="width: 5%; text-align: center"></td>
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
	  
       
    </table>
	
	
	<table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;margin-top:20px">
		<tr>
			<td style="width:5%;"> </td>
			<td style="width:35%;font-size:24px;"></td>
			<td style="width:25%;font-size:24px;"></td>
			<td style="width:15%;font-size:14px;text-align:right;padding:5px" class='border-top border-left'><b>SUBTOTAL <?php echo $moneda;?>  </b></td>
			<td style="width:15%;font-size:14px;text-align:right;padding:5px" class='border-top border-right'><?php echo number_format($total_neto,$currency_format['precision_currency'],$currency_format['decimal_separator'],$currency_format['thousand_separator']);?></td>
			<td style="width:5%;font-size:24px;text-align:center;"></td>
		</tr>
		<tr>
			<td style="width:5%;"> </td>
			<td style="width:35%;font-size:24px;"></td>
			<td style="width:25%;font-size:24px;"></td>
			<td style="width:15%;font-size:14px;text-align:right;padding:5px" class='border-left'><b><?php echo $tax_txt;?> <small><?php echo $tax;?>%</small> <?php echo $moneda;?>  </b></td>
			<td style="width:15%;font-size:14px;text-align:right;padding:5px" class='border-right'><?php echo number_format($total_iva,$currency_format['precision_currency'],$currency_format['decimal_separator'],$currency_format['thousand_separator']);?></td>
			<td style="width:5%;font-size:24px;text-align:center;"></td>
		</tr>
		<tr>
			<td style="width:5%;"> </td>
			<td style="width:35%;font-size:14px;" class=''>
			
			</td>
			<td style="width:25%;font-size:24px;" ></td>
			<td style="width:15%;font-size:14px;text-align:right;padding:5px" class='border-bottom border-left'><b>TOTAL <?php echo $moneda;?>  </b></td>
			<td style="width:15%;font-size:14px;text-align:right;padding:5px" class='border-bottom border-right'><?php echo number_format($total_compra,$currency_format['precision_currency'],$currency_format['decimal_separator'],$currency_format['thousand_separator']);?></td>
			<td style="width:5%;font-size:24px;text-align:center;"></td>
		</tr>
		
		
	</table>
	
	
	
	<br>
	
    
	
	<div style="font-size:11pt;text-align:center;font-weight:bold">Gracias por su compra!</div>
	
	
	  

</page>

