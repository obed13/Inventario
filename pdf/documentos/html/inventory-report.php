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
<page backtop="10mm" backbottom="10mm" backleft="10mm" backright="10mm" style="font-size: 12px; font-family: helvetica" backimg="">
	<?php 
	$title_report='Reporte de inventario';
	include('page_header_footer.php');
	
	?>

	
	<div style='border-bottom: 3px solid #2ecc71;padding-bottom:-5px;text-align:center'>
		<h4>Reporte de inventario generado: <?php echo date('d/m/Y');?> </h4>
	</div>

	
	
	
  
    <table class="table-bordered" style="width:100%;" cellspacing=0>
        <tr>
			<th class='top bottom'  style="width: 15%;text-align:center">C&oacute;digo</th>
            <th class='top bottom'  style="width: 30%;">Empleado</th>
			<th class='top bottom'  style="width: 40%;">Descripción</th>
			<th class='top bottom'  style="width: 10%;text-align:right">Costo</th>
        </tr>
		<?php
			$sumador=0;//Inicializo variable
			
			while($row=mysqli_fetch_array($query)){
			
			$product_id=$row['product_id'];
			$product_code=$row['product_code'];
			$manufacturer_name=$row["empleado"];
			$product_note=$row['note'];
			$buying_price=$row['buying_price'];
			$buying_price=number_format($buying_price,$currency_format['precision_currency'],'.','');
			?>
				<tr>
					<td class='bottom' style="width: 15%;text-align:center"><?php echo $product_code;?></td>
					<td class='bottom' style="width: 30%;"><?php echo $manufacturer_name;?></td>
					<td class='bottom' style="width: 40%;"><?php echo $product_note;?></td>
					<td class='bottom' style="width: 10%;text-align:right"><?php  echo number_format($buying_price,$currency_format['precision_currency'],$currency_format['decimal_separator'],$currency_format['thousand_separator']);?></td>
					
				</tr>
			<?php 
		}
		
		?>
			
		<tr>
			<td style='text-align:right;border-top:3px solid #2ecc71;padding:4px;padding-top:4px;font-size:14px'></td>
				
		</tr>
	 </table>
</page>

