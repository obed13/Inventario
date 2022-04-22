<?php



$conexion = new mysqli('localhost','cruphi','nacholibre12345','invenSorteosUabc',3306);

if (mysqli_connect_errno()) {

    printf("La conexion con el servidor de base de datos fallo: %s\n", mysqli_connect_error());

    exit();

 }

$consulta = "select * from inventario";

$resultado = $conexion->query($consulta);

if($resultado->num_rows > 0 ){



date_default_timezone_set('America/Mexico_City');

require_once 'lib/Classes/PHPExcel.php';



$objPHPExcel = new PHPExcel();

$objPHPExcel->getProperties()->setCreator("Inventario Fisico")

    ->setLastModifiedBy("CCentral")

    ->setTitle("Inventario Fisico")

    ->setSubject("Inventario Fisico")

    ->setDescription("Reporte de Inventario Fisico")

    ->setKeywords("Inventario Fisico")

    ->setCategory("Inventario Fisico");



$tituloReporte = "FORMATO PARA TOMA DE INVENTARIO FÍSICO";

$textreporte1="Nombre:";

$textreporte2="No.Empleado:";

$textreporte3="Ubicación:";

$textreporte4="No.Sorteos:";

$textreporte5="No.Matrícula:";

$textreporte6="NÚMERO DE";

$textreporte7="LOCALIZADO";

$textreporte8="CONTROL";

$textreporte9="DESCRIPCIÓN";

$textreporte10="DIA";

$titulosColumnas = array('NÚMERO DE','CONTROL', 'DESCRIPCIÓN', 'MARCA', 'MODELO', 'SERIE', 'LOCALIZADO', 'SI', 'NO','OBSERVACIONES');

$objPHPExcel->setActiveSheetIndex(0)

    ->mergeCells('A2:G2')

	->mergeCells('A4')

	->mergeCells('C4')

	->mergeCells('E4:F4')

	->mergeCells('C5')

	->mergeCells('C6')

	->mergeCells('A9')

    ->mergeCells('E9:F9')

    ->mergeCells('A10')

    ->mergeCells('B10')

    ->mergeCells('C10')

    ->mergeCells('D10')

    ->mergeCells('E10')

    ->mergeCells('F10')

    ->mergeCells('G10');

$objPHPExcel->setActiveSheetIndex(0)

    ->setCellValue('A2',$tituloReporte)

	->setCellValue('A4',$textreporte1)

	->setCellValue('C4',$textreporte2)

	->setCellValue('E4',$textreporte3)

	->setCellValue('C5',$textreporte4)

	->setCellValue('C6',$textreporte5)

	->setCellValue('A9',$titulosColumnas[0])

	->setCellValue('E9',$titulosColumnas[6])

	->setCellValue('A10',$$titulosColumnas[1])

	->setCellValue('B10',$titulosColumnas[2])

	->setCellValue('C10',$titulosColumnas[3])

	->setCellValue('D10',$titulosColumnas[5])

    ->setCellValue('E10',$titulosColumnas[7])

    ->setCellValue('F10',$titulosColumnas[8])

    ->setCellValue('G10',$titulosColumnas[9]);



    while ($fila = $resultado->fetch_array()) {

        $objPHPExcel->setActiveSheetIndex(0)

            ->setCellValue('A'.$i, $fila['codigo'])

            ->setCellValue('B'.$i, $fila['descripcion'])

            ->setCellValue('C'.$i, $fila['marca'])

            ->setCellValue('D'.$i, $fila['serie'])

            ->setCellValue('E'.$i, 'd')

            ->setCellValue('F'.$i, 'd')

            ->setCellValue('G'.$i, 'd');

     }



$objPHPExcel->getActiveSheet()->setTitle('Reporte Inventario Fisico');

$objPHPExcel->setActiveSheetIndex(0);

$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,12);

header('Content-Type: application/vnd.ms-excel');

header('Content-Disposition: attachment;filename="01simple.xls"');

header('Cache-Control: max-age=0');



$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

$objWriter->save('php://output');

exit;

}

else{

    print_r('No hay resultados para mostrar');

}

?>