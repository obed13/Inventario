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

-->
</style>
<page backtop="20mm" backbottom="15mm" backleft="15mm" backright="15mm" style="font-size: 13px; font-family: helvetica" backimg="">
	<?php 
	$title_report='Reporte de compras';
	include('page_header_footer.php');
	?>

	
	<div style='border-bottom: 3px solid #2ecc71;padding-bottom:10px'>
		Usuario:  
		<?php
		$sql1=mysqli_query($con,"select fullname from users where user_id='".$purchase_by."'");
		$rw1=mysqli_fetch_array($sql1);
		$fullname=$rw1['fullname']; 
		if (empty($fullname)){
			echo "Todos";
		}else {
			echo $fullname;
		}
		?>
	</div>

	
	
	
  
    <table class="table-bordered" style="width:100%;" cellspacing=0>
        <tr>
			<th class='top bottom'  style="width: 12%;text-align:center">Compra Nº</th>
            <th class='top bottom'  style="width: 40%;">Proveedor</th>
            <th class='top bottom'  style="width: 12%;text-align:center">Fecha</th>
            <th class='top bottom'  style="width: 12%;text-align:right">Neto</th>
			<th class='top bottom'  style="width: 12%;text-align:right">IVA</th>
			<th class='top bottom'  style="width: 12%;text-align:right">Total</th>
            
        </tr>
		<?php
		$sumador_subtotal=0;
		$sumador_tax=0;
		$sumador_total=0;
		while($row=mysqli_fetch_array($query)){
			$purchase_order_number=$row['purchase_order_number'];
			$supplier_id=$row['supplier_id'];
			$sql_supplier=mysqli_query($con,"select name from suppliers where id='".$supplier_id."'");
			$rw_supplier=mysqli_fetch_array($sql_supplier);
			$supplier_name=$rw_supplier['name'];
			$date_added=$row['purchase_date'];
			$user_fullname=$row['fullname'];
			$subtotal=$row['subtotal'];
			$tax=$row['tax'];
			$total=$row['total'];
			
			$sumador_subtotal+=$subtotal;
			$sumador_tax+=$tax;
			$sumador_total+=$total;
			
			
			list($date,$hora)=explode(" ",$date_added);
			list($Y,$m,$d)=explode("-",$date);
			$fecha=$d."-".$m."-".$Y;
			
			?>
				<tr>
					<td class='bottom' style="width: 12%;text-align:center"><?php echo $purchase_order_number;?></td>
					<td class='bottom' style="width: 40%;"><?php echo $supplier_name;?></td>
					<td class='bottom' style="width: 12%;text-align:center"><?php echo $fecha;?></td>
					<td class='bottom' style="width: 12%;text-align:right"><?php echo number_format($subtotal,$currency_format['precision_currency'],$currency_format['decimal_separator'],$currency_format['thousand_separator']);?></td>
					<td class='bottom' style="width: 12%;text-align:right"><?php echo number_format($tax,$currency_format['precision_currency'],$currency_format['decimal_separator'],$currency_format['thousand_separator']);?></td>
					<td class='bottom' style="width: 12%;text-align:right"><?php echo number_format($total,$currency_format['precision_currency'],$currency_format['decimal_separator'],$currency_format['thousand_separator']);?></td>
				</tr>
			<?php 
		}
		
		?>
		<tr>
				<td colspan=3 style='text-align:right;border-top:3px solid #2ecc71;padding:4px;padding-top:4px;font-size:14px'><strong>Totales <?php echo $moneda;?></strong></td>
				<td style='text-align:right;border-top:3px solid #2ecc71;padding:4px;padding-top:4px;font-size:14px'><?php echo number_format($sumador_subtotal,$currency_format['precision_currency'],$currency_format['decimal_separator'],$currency_format['thousand_separator']);?></td>
				<td style='text-align:right;border-top:3px solid #2ecc71;padding:4px;padding-top:4px;font-size:14px'><?php echo number_format($sumador_tax,$currency_format['precision_currency'],$currency_format['decimal_separator'],$currency_format['thousand_separator']);?></td>
				<td style='text-align:right;border-top:3px solid #2ecc71;padding:4px;padding-top:4px;font-size:14px'><?php echo number_format($sumador_total,$currency_format['precision_currency'],$currency_format['decimal_separator'],$currency_format['thousand_separator']);?></td>
		</tr>
	 </table>
</page>

