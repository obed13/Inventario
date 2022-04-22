<?php $logos ='img/logo_chico.png'?>
<page backtop="10mm" backbottom="10mm" backleft="10mm" backright="10mm" style="font-size: 12px; font-family: helvetica" backimg="">

    <table border="1">
        <tr align="center">
            <td rowspan="4"><img src="<?php echo $logos;?>" alt="Logo" width="100"></td>
            <td rowspan="2">DESARROLLO Y VINCULACIÓN UNIVERSITARIA, S. C.</td>
            <td>Pagina 1 de 1</td>
        </tr>
        <tr align="center">
            <td>DA-N4-007   Rev. 0   13/12/21</td>
        </tr>
        <tr align="center">
            <td>RESGUARDO INTERNO DE ACTIVOS</td>
            <td>S/N/C = Sin número de control</td>
        </tr>
        <tr align="center">
            <td>Departamento Administrativo</td>
            <td>S/V/R = Sin valor registrado</td>
        </tr>
        <tr>
            <td colspan="3"><br></td>
        </tr>
        <tr>
            <td colspan="3">
                <table border="1" align="center">
                    <tr>
                        <td>No. DE EMPLEADO</td>
                        <td>NOMBRE DE EMPLEADO</td>
                        <td>DEPARTAMENTO</td>
                        <td>RESGUARDO No. </td>
                    </tr>
                    <tr>
                        <td><br></td>
                        <td><br></td>
                        <td><br></td>
                        <td><br></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <table border="1" align="center">
                    <tr>
                        <td>#</td>
                        <td>FECHA ADQUIS.</td>
                        <td>No. CONTROL</td>
                        <td>CANT.</td>
                        <td>DESCRIPCIÓN</td>
                        <td>MARCA</td>
                        <td>SERIE</td>
                        <td>UBICACIÓN</td>
                        <td>No. DE O. C.</td>
                        <td>No. DE PÓLIZA</td>
                        <td>IMPORTE</td>
                        <td>OBSERVACIONES</td>
                    </tr>
                    <?php

                    while($row=mysqli_fetch_array($query)){
                        $count = 1;
                        $product_id=$row['product_id'];
                        $product_code=$row['product_code'];
                        $manufacturer_name=$row["product_name"];
                        $note=$row['note'];
                        $buying_price=$row['buying_price'];
                        $status=$row['status'];
                        $marca = $row['marca'];
                        $modelo = $row['modelo'];
                        $serie = $row['serie'];
                        $fecha = $row['fecha_adquisicion'];
                        $ubicacion = $row['ubi_name'];
                        $nocontrol = $row['numero_control'];
                        $num_poliza = $row['num_poliza'];
                        $num_factura = $row['num_factura'];
                        $buying_price=number_format($buying_price,$currency_format['precision_currency'],'.','');
                    ?>
                        <tr style='font-size: 12px'>
                            <td><?php echo $count;?></td>
                            <td><?php echo $fecha;?></td>
                            <td><?php echo $nocontrol;?></td>
                            <td>1</td>
                            <td><?php echo $note;?></td>
                            <td><?php echo $marca;?></td>
                            <td><?php echo $serie;?></td>
                            <td><?php echo $ubicacion;?></td>
                            <td><?php echo $num_factura;?></td>
                            <td><?php echo $num_poliza;?></td>
                            <td><?php echo $buying_price;?></td>
                            <td></td>
                        </tr>
                    <?php $count++; } ?>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="3" style="font-size: 10px;">
            “EL EMPLEADO ES RESPONSABLE DEL ACTIVO ANTES DESCRITO, RESPONSABILIZANDOSE DE LA INTEGRIDAD DEL MISMO HASTA QUE SE REQUIERA SER TRASPASADO, DADO DE BAJA O DEVUELTO, EN EL ENTENDIDO DE QUE, EN EL CASO DE HACER MAL MANEJO, USO INADECUADO O PÉRDIDA SIN JUSTIFICACIÓN, SE LE DESCONTARÁ EL VALOR DEL EQUIPO VÍA NÓMINA”.
            </td>
        </tr>
        <tr>
            <td colspan="3" align="center" style="font-size:8px;">
            MEXICALI, B. C. A	(DÍA)______ DE	(MES)_____	DEL	(AÑO)_____
            </td>
        </tr>
        <tr align="center">
            <td colspan="3">
                <table border="1" align="center">
                    <tr >
                        <td>ACEPTO Y ME HAGO RESPONSABLE</td>
                        <td>AUTORIZÓ</td>
                    </tr>
                    <tr>
                        <td><br><br></td>
                        <td><br><br></td>
                    </tr>
                    <tr>
                        <td>(NOMBRE DEL EMPLEADO)</td>
                        <td>RESPONSABLE DE RESGUARDO EN DEPARTAMENTO</td>
                    </tr>
                    <tr>
                        <td>DÍA:______ MES:_______AÑO:______</td>
                        <td>DÍA:______ MES:_______AÑO:______</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</page>
