<?php
// get the HTML
ob_start();

	session_start();
	if (!isset($_SESSION['user_id'])){
			header("location: index.php");//Redirecciona
			exit;
	}
	/* Connect To Database*/
	include("config/db.php");
	include("config/conexion.php");
	require_once ("libraries/inventory.php");//Contiene funcion que controla stock en el inventario
	//Ontengo variables pasadas por GET
	//$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	//if($action == 'ajax'){
    $query = mysqli_real_escape_string($con,(strip_tags($_REQUEST['code'], ENT_QUOTES)));
	$tables="products,ubicacion";
	$campos="*,ubicacion.name as ubi_name";
	$sWhere="products.ubicaciones_id = ubicacion.id";
	$sWhere="products.product_code = ".$query."";

	$query = mysqli_query($con,"SELECT $campos FROM  $tables where $sWhere ");
	//var_dump($query);


	require_once(dirname(__FILE__).'/pdf/html2pdf.class.php');

	require_once (dirname(__FILE__).'/pdf/documentos/html/resguardo_empleado.php');
	$content = ob_get_clean();

    try
    {
        // init HTML2PDF
        $html2pdf = new HTML2PDF('L', 'LETTER', 'es', true, 'UTF-8');
        // display the full page
        $html2pdf->pdf->SetDisplayMode('fullpage');
        // convert
        $html2pdf->writeHTML($content);
        // send the PDF
        $html2pdf->Output('usuarios.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
//}
