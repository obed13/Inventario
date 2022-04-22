
<page backtop="10mm" backbottom="10mm" backleft="10mm" backright="10mm" style="font-size: 12px; font-family: helvetica" backimg="">
	<?php
	$title_report='Reporte de inventario';
	include('page_header_footer.php');
	?>
	<div style='border-bottom: 3px solid #2ecc71;padding-bottom:-5px;text-align:center'>
		<h4>DESARROLLO Y VICULACION UNIVERSITARIA, S. C.</h4>
	</div>

    <table border="1">
        <tr align="center">
            <th>CONTROL DE ACTIVOS</th>
        </tr>
        <tr>
            <td>
                <table border="1">
                    <tr>
                        <td colspan="2">FECHA DE ELABORACION:</td>
                        <td colspan="2">ELABORO:</td>
                        <td colspan="2" rowspan="2"> N° _ _ _</td>
                    </tr>
                    <tr>
                        <td colspan="2"><br><br><br></td>
                        <td colspan="2"><br><br><br></td>
                    </tr>
                    <tr style='background-color: #E29587;'>
                        <td colspan="3">UNIDAD QUE ENTREGA: </td>
                        <td colspan="3">CIUDAD: Mexicali</td>
                    </tr>
                    <tr>
                        <td colspan="2">NOMBRE:</td>
                        <td colspan="2"># EMPLEADO:</td>
                        <td colspan="2">PUESTO:</td>
                    </tr>
                    <tr>
                        <td colspan="2">DEPARTAMENTO:</td>
                        <td colspan="2">OFICINA:</td>
                        <td colspan="2">AREA:</td>
                    </tr>
                    <tr style='background-color: #38ef7d;'>
                        <td colspan="3">UNIDAD QUE RECIBE: </td>
                        <td colspan="3">CIUDAD: </td>
                    </tr>
                    <tr>
                        <td colspan="2">NOMBRE:</td>
                        <td colspan="2"># EMPLEADO:</td>
                        <td colspan="2">PUESTO:</td>
                    </tr>
                    <tr>
                        <td colspan="2">DEPARTAMENTO:</td>
                        <td colspan="2">OFICINA:</td>
                        <td colspan="2">AREA:</td>
                    </tr>
                    <tr>
                        <td>__RESG PERMANENTE</td>
                        <td>__RESG TEMPORAL</td>
                        <td>__TRASPASO</td>
                        <td>__BAJA</td>
                        <td>__ENVIADO AL ALMACEN</td>
                        <td>__DEVOLUCION</td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <table border="1">
                                <tr>
                                    <td>#</td>
                                    <td>NO. CONTROL</td>
                                    <td>DESCRIPCION</td>
                                    <td>SERIE</td>
                                    <td>MODELO</td>
                                    <td>MARCA</td>
                                    <td>VALOR</td>
                                </tr>
                                <?php

                                while($row=mysqli_fetch_array($query)){

                                    $product_id=$row['product_id'];
                                    $product_code=$row['product_code'];
                                    $manufacturer_name=$row["product_name"];
                                    $note=$row['note'];
                                    $buying_price=$row['buying_price'];
                                    $status=$row['status'];
                                    $marca = $row['marca'];
                                    $modelo = $row['modelo'];
                                    $serie = $row['serie'];
                                    $buying_price=number_format($buying_price,$currency_format['precision_currency'],'.','');	

                                    if ($status==1){
                                        $lbl_status="Alta";
                                        $lbl_class='label label-success';
                                    }elseif ($status==3){
                                        $lbl_status="Prestamo";
                                        $lbl_class='label label-warning';
                                    }else {
                                        $lbl_status="Baja";
                                        $lbl_class='label label-danger';
                                    }
                                ?>
                                    <tr style='font-size: 12px'>
                                        <td><?php echo $product_code;?></td>
                                        <td><?php echo $manufacturer_name;?></td>
                                        <td><?php echo $note;?></td>
                                        <td><?php echo $serie;?></td>
                                        <td class='text-center'><?php echo $modelo;?></td>
                                        <td class='text-right'><?php echo $marca;?></td>
                                        <td class='text-right'><?php echo number_format($buying_price,$currency_format['precision_currency'],$currency_format['decimal_separator'],$currency_format['thousand_separator']);?></td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" align="center">
                        “A partir de esta fecha recibí el equipo arriba enlistado, el cual quedara bajo mi custodia,<br> responsabilizándome de la integridad del mismo hasta que se requiera ser traspasado, dado de baja o devuelto,<br> en el entendido de que, en el caso de hacer mal manejo, uso inadecuado o perdida sin justificación, se me des contara el valor del equipo vía nomina”.
                        </td>
                    </tr>
                    <tr align="center">
                        <td>RESPONSABLE<br> QUE ENTREGA EQUIPO</td>
                        <td>JEFE DEL DEPTO.<br> QUE ENTREGA EQUIPO</td>
                        <td>RESPONSABLE <br>QUE RECIBE EQUIPO</td>
                        <td colspan="2">JEFE DEL DEPTO.<br> QUE RECIBE EQUIPO</td>
                        <td>VERIFICA AUDITOR</td>
                    </tr>
                    <tr>
                        <td><br><br><br></td>
                        <td><br><br><br></td>
                        <td><br><br><br></td>
                        <td colspan="2"><br><br><br></td>
                        <td><br><br><br></td>
                    </tr>
                    <tr align="center">
                        <td>(NOMBRE Y FIRMA)<br/> (PUESTO)  </td>
                        <td>(NOMBRE Y FIRMA)<br/> (PUESTO)  </td>
                        <td>(NOMBRE Y FIRMA)<br/> (PUESTO)  </td>
                        <td colspan="2">(NOMBRE Y FIRMA)<br/> (PUESTO)  </td>
                        <td>(NOMBRE Y FIRMA)<br/> (PUESTO)  </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</page>
