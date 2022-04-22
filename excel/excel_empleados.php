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



$query = mysqli_real_escape_string($conexion,(strip_tags($_REQUEST['query'], ENT_QUOTES)));

$consulta = "SELECT p.product_code,p.note,p.status,p.buying_price,m.name as empleado,u.name as ubicacion FROM products p, manufacturers m,ubicacion u WHERE p.manufacturer_id=m.id AND p.ubicaciones_id = u.id AND m.name LIKE '%".$query."%' order by m.name ASC";

$resultado = $conexion->query($consulta);

if($resultado->num_rows > 0 ){



$spreadsheet = new Spreadsheet();



$spreadsheet->getActiveSheet(0)

->setCellValue('A1','Empleados')

	->setCellValue('B1','Descripcion')

	->setCellValue('C1','Ubicacion')

	->setCellValue('D1','Estatus')

	->setCellValue('E1','Costo');



    //Tamaño de la campo A2 y aliniacion

    $spreadsheet->getActiveSheet()->getStyle('A1:E1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);



    $i=2;

    while ($fila = $resultado->fetch_array()) {

        $status = $fila['status'];

        $buying_price=$fila['buying_price'];

        //$buying_price=number_format($buying_price,$currency_format['precision_currency'],'.','');



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

            ->setCellValue('A'.$i, $fila['empleado'])

            ->setCellValue('B'.$i, $fila['note'])

            ->setCellValue('C'.$i, $fila['ubicacion'])

            ->setCellValue('D'.$i, $lbl_status)

            ->setCellValue('E'.$i, number_format($buying_price,2));



        //increment i

        $i++;

     }



    $writer = new Xlsx($spreadsheet);

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

    header('Content-Disposition: attachment; filename="Reporte_Empleados.xlsx"');

    $writer->save("php://output");

    //$writer->save('hello world.xlsx');

    exit;

}

else{

    print_r('No hay resultados para mostrar');

}