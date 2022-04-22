<?php



require 'vendor/autoload.php';



use PhpOffice\PhpSpreadsheet\Style\Alignment;

use PhpOffice\PhpSpreadsheet\Style\Border;

use PhpOffice\PhpSpreadsheet\Style\Fill;

use PhpOffice\PhpSpreadsheet\Spreadsheet;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use PhpOffice\PhpSpreadsheet\IOFactory;

$conexion = new mysqli('localhost','cruphi','nacholibre12345','invenSorteosUabc',3306);

if (mysqli_connect_errno()) {

    printf("La conexion con el servidor de base de datos fallo: %s\n", mysqli_connect_error());

    exit();

 }



 $fecha_inicio   = mysqli_real_escape_string($conexion,(strip_tags($_REQUEST['fecha_inicio'], ENT_QUOTES)));

 $fecha_fin      = mysqli_real_escape_string($conexion,(strip_tags($_REQUEST['fecha_fin'], ENT_QUOTES)));

$consulta = "SELECT * FROM inventario WHERE DATE(inventario.date)  BETWEEN '$fecha_inicio' AND '$fecha_fin' ";

$resultado = $conexion->query($consulta);

if($resultado->num_rows > 0 ){



$spreadsheet = new Spreadsheet();

$spreadsheet->getActiveSheet()

    ->mergeCells('A2:G2')

    ->mergeCells('E9:F9');

$spreadsheet->getActiveSheet(0)

->setCellValue('A2','FORMATO PARA TOMA DE INVENTARIO FÍSICO')

	->setCellValue('A4',"Nombre:")

	->setCellValue('C4',"No.Empleado:")

	->setCellValue('E4',"Ubicación:")

	->setCellValue('C5',"No.Sorteos:")

	->setCellValue('C6',"No.Matrícula:")

	->setCellValue('A9','NÚMERO DE')

	->setCellValue('E9','LOCALIZADO')

	->setCellValue('A10','CONTROL')

	->setCellValue('B10','DESCRIPCIÓN')

	->setCellValue('C10','MARCA')

	->setCellValue('D10','MODELO')

    ->setCellValue('E10','SI')

    ->setCellValue('F10','NO')

    ->setCellValue('G10','OBSERVACIONES');



    //styling arrays

//table head style

$tableHead = [

	'font'=>[

		'color'=>[

			'rgb'=>'FFFFFF'

		],

		'bold'=>true,

		'size'=>11

	],

	'fill'=>[

		'fillType' => Fill::FILL_SOLID,

		'startColor' => [

			'rgb' => '4F81BD'

		]

	],

];

//even row

$evenRow = [

	'fill'=>[

		'fillType' => Fill::FILL_SOLID,

		'startColor' => [

			'rgb' => 'FFFFFF'

		]

	]

];

//odd row

$oddRow = [

	'fill'=>[

		'fillType' => Fill::FILL_SOLID,

		'startColor' => [

			'rgb' => 'DCE6F1'

		]

	]

];



    //Tamaño de la campo A2 y aliniacion

    $spreadsheet->getActiveSheet()->getStyle('A2')->getFont()->setSize(15);

    $spreadsheet->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

    $spreadsheet->getActiveSheet()->getStyle('E9')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

    $spreadsheet->getActiveSheet()->getStyle('B4')->getBorders()->getBottom(Border::BORDER_THIN);

    

    //set font style and background color

    $spreadsheet->getActiveSheet()->getStyle('A9:G9')->applyFromArray($tableHead);

    $spreadsheet->getActiveSheet()->getStyle('A10:G10')->applyFromArray($tableHead);



    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(20);

    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(70);

    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(50);

    $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(50);

    $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(20);

    $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(20);

    $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(20);



    $i=11;

    while ($fila = $resultado->fetch_array()) {

        $spreadsheet->getActiveSheet()->getStyle('A'.$i)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

        $spreadsheet->getActiveSheet(0)

            ->setCellValue('A'.$i, $fila['codigo'])

            ->setCellValue('B'.$i, $fila['descripcion'])

            ->setCellValue('C'.$i, $fila['marca'])

            ->setCellValue('D'.$i, $fila['modelo'])

            ->setCellValue('E'.$i, '')

            ->setCellValue('F'.$i, '')

            ->setCellValue('G'.$i, '');

        

        //set row style

        if( $i % 2 == 0 ){

            //even row

            $spreadsheet->getActiveSheet()->getStyle('A'.$i.':G'.$i)->applyFromArray($evenRow);

        }else{

            //odd row

            $spreadsheet->getActiveSheet()->getStyle('A'.$i.':G'.$i)->applyFromArray($oddRow);

        }

        //increment i

        $i++;

     }





$writer = new Xlsx($spreadsheet);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

header('Content-Disposition: attachment; filename="Reporte_Inventario_Anual.xlsx"');

$writer->save("php://output");

//$writer->save('hello world.xlsx');

exit;

}

else{

    print_r('No hay resultados para mostrar');

}