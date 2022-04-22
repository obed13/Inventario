<style type="text/css">
<!--
table { vertical-align: top; }
tr    { vertical-align: top; }
td    { vertical-align: top; }
.class-theme{
	background:#e74c3c;
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
	background-color:#e74c3c;

}

table.page_footer{
	width: 100%;
	padding:0px;
	background-color:#e74c3c;
}
.border-bottom{
	border-bottom: #e74c3c 3px;
	padding-bottom:10px
}
.orange-top{
	border-top: #e74c3c 3px;
}
.orange-left{
	border-left: #e74c3c 3px;
}
.white{
	border-bottom:white 3px;
}
table{
	color:#2c3e50;
}

-->
</style>
<page backtop="10mm" backbottom="mm" backleft="0mm" backright="0mm" style="font-size: 12pt; font-family: arial" >

	    <page_header>
        <table class="page_header" cellspacing=0 cellpadding=0 >
            


			<tr>

                
				<td style="width:100%;min-height:50px">
                   &nbsp;
                </td>
               
            </tr>
        </table>
    </page_header>
	<page_footer>
        <table class="page_footer" cellspacing=0 cellpadding=0 >
           <tr>

                
				<td style="width:100%;min-height:50px">
                   &nbsp;
                </td>
               
            </tr>


			
        </table>
    </page_footer>

	<table cellspacing="0" style="width: 100%; text-align: left; font-size:20px;">
		<tr>
			<td style="width:5%;"> </td>
			<td style="width: 30%; text-align: left;vertical-align:top" > 
                    <img style="width: 100%;" src="<?php echo $logo_url;?>" alt="Logo"><br>
            </td>
			<td style="width:60%;font-size:30px;color:#e74c3c;text-align:right;vertical-align:middle"><b>FACTURA </b></td>
			
			<td style="width:5%;"> </td>
		</tr>
		
		
	</table>
	
	    <table class="" cellspacing=0 cellpadding=0 >
            <tr>

               
				
                <td style="width: 33%; text-align: center;vertical-align:middle;" >
                    <img src="img/icon/phone.png" style="width:10%">
                </td>
				<td style="width: 34%; text-align: center;vertical-align:middle" >
                    <img src="img/icon/mail.png" style="width:10%">
                </td>
				<td style="width: 33%; text-align: center;vertical-align:middle" >
                    <img src="img/icon/home.png" style="width:10%">
                </td>
            </tr>


			<tr>

                
				
                <td style="width: 33%; text-align: center;vertical-align:middle;" class='border-bottom'>
                    <?php echo $phone;?><br>
                </td>
				<td style="width: 34%; text-align: center;vertical-align:middle;" class='border-bottom'>
                    <?php echo $email;?><br>
                </td>
				<td style="width: 33%; text-align: center;vertical-align:middle" class='border-bottom'>
                    <?php echo $address.", ". $city;?><br>
                </td>
            </tr>
        </table>
		
	
	
    
	<table cellspacing="0" style="width: 100%; text-align: left; font-size:14px;margin-top:20px;">
		<tr>
			<td style="width:5%;"> </td>
			<td style="width:45%;font-size:24px;color:#e74c3c;background-color:#ecf0f1;padding:20px"><b>FACTURAR A </b></td>
			<td style="width:45%;text-align:right;font-size:18px">
				<span style="color:#e74c3c">Factura Nº:</span> <?php echo $sale_number;?><br>
				<span style="color:#e74c3c">Fecha:</span> <?php echo $sale_date;?>
			</td>
			
			<td style="width:5%;"> </td>
		</tr>
		
		<tr>
			<td style="width:5%;"> </td>
			<td style="width:45%;background-color:#ecf0f1;padding:20px">
			<address>
              <strong><?php echo $customer_name;?></strong><br>
             <?php echo $customer_address." ". $customer_city;?><br>
             <?php echo $customer_state." ". $customer_postal_code;?><br>
              Teléfono: <?php echo $customer_work_phone;?><br>
              Email: <?php echo $customer_email;?>
            </address>
			
			</td>
			<td style="width:45%;text-align:left;">
				
			</td>
			
			<td style="width:5%;"> </td>
		</tr>
	</table>

	

	
	
   
    
	<br>
  
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 10pt;">
        <tr style="vertical-align:middle"> 
            <th style="width: 5%;text-align:center;padding:15px 0px 15px" class='class-theme'></th>
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
			<td style="width:15%;font-size:14px;text-align:right;padding:5px;background-color:#e74c3c;color:white" ><b>TOTAL <?php echo $moneda;?>  </b></td>
			<td style="width:15%;font-size:14px;text-align:right;padding:5px;background-color:#e74c3c;color:white" ><?php echo number_format($total_compra,$currency_format['precision_currency'],$currency_format['decimal_separator'],$currency_format['thousand_separator']);?></td>
			<td style="width:5%;font-size:24px;text-align:center;"></td>
		</tr>
		
		
	</table>
	
	
	
	<br>
	
    
	
	<div style="font-size:11pt;text-align:center;font-weight:bold">Gracias por su compra!</div>
	
	
	  

</page>

