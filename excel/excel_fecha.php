<?php



require 'vendor/autoload.php';



use PhpOffice\PhpSpreadsheet\Style\Alignment;

use PhpOffice\PhpSpreadsheet\Spreadsheet;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;



$conexion = new mysqli('localhost','cruphi','nacholibre12345','invenSorteosUabc',3306);

if (mysqli_connect_errno()) {

    printf("La conexion con el servidor de base de datos fallo: %s\n", mysqli_connect_error());

    exit();

 }



 $fecha_inicio   = mysqli_real_escape_string($conexion,(strip_tags($_REQUEST['fecha_inicio'], ENT_QUOTES)));

 $fecha_fin      = mysqli_real_escape_string($conexion,(strip_tags($_REQUEST['fecha_fin'], ENT_QUOTES)));

$consulta = "SELECT p.product_code, p.note, p.status, p.buying_price, m.name as empleado, c.name AS cat FROM products p,manufacturers m,categoria c WHERE p.manufacturer_id=m.id AND p.categoria_id=c.id AND p.created_at  BETWEEN '$fecha_inicio' AND '$fecha_fin' order by p.product_name";

$resultado = $conexion->query($consulta);

if($resultado->num_rows > 0 ){



$spreadsheet = new Spreadsheet();



$spreadsheet->getActiveSheet(0)

->setCellValue('A1','Codigo')

	->setCellValue('B1','Empleados')

	->setCellValue('C1','Descripcion')

	->setCellValue('D1','Categoria')

	->setCellValue('E1','Estatus')

    ->setCellValue('F1','Costo');



    //Tamaño de la campo A2 y aliniacion

    $spreadsheet->getActiveSheet()->getStyle('A1:E1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);



    $i=2;

    while ($fila = $resultado->fetch_array()) {

        $status = $fila['status'];

        $buying_price=$fila['buying_price'];



        if ($status==1){

            $lbl_status="Alta";

        }elseif ($status==3){

            $lbl_status="Prestamo";

        }elseif ($status==2){

            $lbl_status="Traspaso";

        }elseif ($status==4){

            $lbl_status="No Inventariables";

        }else {

            $lbl_status="Baja";

        }



        $spreadsheet->getActiveSheet(0)

            ->setCellValue('A'.$i, $fila['product_code'])

            ->setCellValue('B'.$i, $fila['empleado'])

            ->setCellValue('C'.$i, $fila['note'])

            ->setCellValue('D'.$i, $fila['cat'])

            ->setCellValue('E'.$i, $lbl_status)

            ->setCellValue('F'.$i, number_format($buying_price,2));



        //increment i

        $i++;

     }



    $writer = new Xlsx($spreadsheet);

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

    header('Content-Disposition: attachment; filename="Reporte_Fecha.xlsx"');

    $writer->save("php://output");

    //$writer->save('hello world.xlsx');

    exit;

}

else{

    print_r('No hay resultados para mostrar');

}